<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produk;
use App\Provinsi;
use Session;
use App\Kota;
use App\Kabupaten;
use App\Customer;
use App\Order;
use App\OrderDetail;
use Illuminate\Support\Str;
use DB;
use App\Mail\CustomerRegisterMail;
use Mail;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $this->validate($request, [
            'produk_id' => 'required|exists:produks,id',
            'qty' => 'required|integer'
        ]);

        $carts = $this->getCarts();

        //CEK JIKA CARTS TIDAK NULL DAN PRODUk_ID ADA DIDALAM ARRAY CARTS
        if ($carts && array_key_exists($request->produk_id, $carts)) {
            //MAKA UPDATE QTY-NYA BERDASARKAN PRODUk_ID YANG DIJADIKAN KEY ARRAY
            $carts[$request->produk_id]['qty'] += $request->qty;
        } else {
            //SELAIN ITU, BUAT QUERY UNTUK MENGAMBIL PRODUK BERDASARKAN PRODUk_ID
            $produk = Produk::find($request->produk_id);
            //TAMBAHKAN DATA BARU DENGAN MENJADIKAN PRODUk_ID SEBAGAI KEY DARI ARRAY CARTS
            $carts[$request->produk_id] = [
                'qty' => $request->qty,
                'produk_id' => $produk->id,
                'produk_nama' => $produk->nama,
                'produk_harga' => $produk->harga,
                'produk_gambar' => $produk->gambar
            ];
        }

        //BUAT COOKIE-NYA DENGAN NAME DW-CARTS
        //JANGAN LUPA UNTUK DI-ENCODE KEMBALI, DAN LIMITNYA 2800 MENIT ATAU 48 JAM
        $cookie = cookie('ac-carts', json_encode($carts), 2880);

        //STORE KE BROWSER UNTUK DISIMPAN
        return redirect()->back()->cookie($cookie);
    }

    public function listCart()
    {
        $carts = $this->getCarts();
        //UBAH ARRAY MENJADI COLLECTION, KEMUDIAN GUNAKAN METHOD SUM UNTUK MENGHITUNG SUBTOTAL
        $subtotal = collect($carts)->sum(function($q) {
            return $q['qty'] * $q['produk_harga']; //SUBTOTAL TERDIRI DARI QTY * harga
        });
        //LOAD VIEW CART.BLADE.PHP DAN PASSING DATA CARTS DAN SUBTOTAL
        return view('ecommerce.cart', compact('carts', 'subtotal'));
    }

    public function updateCart(Request $request)
    {
        //AMBIL DATA DARI COOKIE
        $carts = $this->getCarts();
        //KEMUDIAN LOOPING DATA PRODUk_ID, KARENA NAMENYA ARRAY PADA VIEW SEBELUMNYA
        //MAKA DATA YANG DITERIMA ADALAH ARRAY SEHINGGA BISA DI-LOOPING
        foreach ($request->produk_id as $key => $row) {
            //DI CHECK, JIKA QTY DENGAN KEY YANG SAMA DENGAN PRODUk_ID = 0
            if ($request->qty[$key] == 0) {
                //MAKA DATA TERSEBUT DIHAPUS DARI ARRAY
                unset($carts[$row]);
            } else {
                //SELAIN ITU MAKA AKAN DIPERBAHARUI
                $carts[$row]['qty'] = $request->qty[$key];
            }
        }
        //SET KEMBALI COOKIE-NYA SEPERTI SEBELUMNYA
        $cookie = cookie('ac-carts', json_encode($carts), 2880);
        //DAN STORE KE BROWSER.
        return redirect()->back()->cookie($cookie);
    }

    private function getCarts()
    {
        $carts = json_decode(request()->cookie('ac-carts'), true);
        $carts = $carts != '' ? $carts:[];
        return $carts;
    }

    public function checkout()
    {
        //QUERY UNTUK MENGAMBIL SEMUA DATA PROPINSI
        $provinsis = Provinsi::orderBy('created_at', 'DESC')->get();
        $carts = $this->getCarts(); //MENGAMBIL DATA CART
        //MENGHITUNG SUBTOTAL DARI KERANJANG BELANJA (CART)
        $subtotal = collect($carts)->sum(function($q) {
            return $q['qty'] * $q['produk_harga'];
        });
        //ME-LOAD VIEW CHECKOUT.BLADE.PHP DAN PASSING DATA PROVINsiS, CARTS DAN SUBTOTAL
        return view('ecommerce.checkout', compact('provinsis', 'carts', 'subtotal'));
    }

    public function getKota()
    {
        //QUERY UNTUK MENGAMBIL DATA KOTA / KABUPATEN BERDASARKAN PROVINsi_ID
        $kotas = Kota::where('provinsi_id', request()->provinsi_id)->get();
        //KEMBALIKAN DATANYA DALAM BENTUK JSON
        return response()->json(['status' => 'success', 'data' => $kotas]);
    }

    public function getKabupaten()
    {
        //QUERY UNTUK MENGAMBIL DATA KECAMATAN BERDASARKAN kota_ID
        $kabupatens = Kabupaten::where('kota_id', request()->kota_id)->get();
        //KEMUDIAN KEMBALIKAN DATANYA DALAM BENTUK JSON
        return response()->json(['status' => 'success', 'data' => $kabupatens]);
    }

    public function processCheckout(Request $request)
    {
        //VALIDASI DATANYA
        $this->validate($request, [
            'customer_nama' => 'required|string|max:100',
            'customer_phone' => 'required',
            'email' => 'required|email',
            'customer_alamat' => 'required|string',
            'provinsi_id' => 'required|exists:provinsis,id',
            'kota_id' => 'required|exists:kotas,id',
            'kabupaten_id' => 'required|exists:kabupatens,id'
        ]);

        //INISIASI DATABASE TRANSACTION
        //DATABASE TRANSACTION BERFUNGSI UNTUK MEMASTIKAN SEMUA PROSES SUKSES UNTUK KEMUDIAN DI COMMIT AGAR DATA BENAR BENAR DISIMPAN, JIKA TERJADI ERROR MAKA KITA ROLLBACK AGAR DATANYA SELARAS
        DB::beginTransaction();
        try {
            //CHECK DATA CUSTOMER BERDASARKAN EMAIL
            $customer = Customer::where('email', $request->email)->first();
            //JIKA DIA TIDAK LOGIN DAN DATA CUSTOMERNYA ADA
            if (!auth()->check() && $customer) {
                //MAKA REDIRECT DAN TAMPILKAN INSTRUKSI UNTUK LOGIN
                return redirect()->back()->with(['error' => 'Silahkan Login Terlebih Dahulu']);
            }

            //AMBIL DATA KERANJANG
            $carts = $this->getCarts();
            //HITUNG SUBTOTAL BELANJAAN
            $subtotal = collect($carts)->sum(function($q) {
                return $q['qty'] * $q['produk_harga'];
            });

            //SIMPAN DATA CUSTOMER BARU
            $password = Str::random(8);
            $customer = Customer::create([
                'nama' => $request->customer_nama,
                'email' => $request->email,
                'password' => $password,
                'phone_number' => $request->customer_phone,
                'alamat' => $request->customer_alamat,
                'kabupaten_id' => $request->kabupaten_id,
                'activate_token' => Str::random(30),
                'status' => false
            ]);

            //SIMPAN DATA ORDER
            $order = Order::create([
                'invoice' => Str::random(4) . '-' . time(), //INVOICENYA KITA BUAT DARI STRING RANDOM DAN WAKTU
                'customer_id' => $customer->id,
                'customer_nama' => $customer->nama,
                'customer_phone' => $request->customer_phone,
                'customer_alamat' => $request->customer_alamat,
                'kabupaten_id' => $request->kabupaten_id,
                'subtotal' => $subtotal
            ]);

            //LOOPING DATA DI CARTS
            foreach ($carts as $row) {
                //AMBIL DATA PRODUK BERDASARKAN PRODUk_ID
                $produk = Produk::find($row['produk_id']);
                //SIMPAN DETAIL ORDER
                OrderDetail::create([
                    'order_id' => $order->id,
                    'produk_id' => $row['produk_id'],
                    'harga' => $row['produk_harga'],
                    'qty' => $row['qty'],
                    'berat' => $produk->berat
                ]);
            }

            //TIDAK TERJADI ERROR, MAKA COMMIT DATANYA UNTUK MENINFORMASIKAN BAHWA DATA SUDAH FIX UNTUK DISIMPAN
            DB::commit();

            $carts = [];
            //KOSONGKAN DATA KERANJANG DI COOKIE
            $cookie = cookie('ac-carts', json_encode($carts), 2880);
            Mail::to($request->email)->send(new CustomerRegisterMail($customer, $password));
            //REDIRECT KE HALAMAN FINISH TRANSAKSI
            return redirect(route('front.finish_checkout', $order->invoice))->cookie($cookie);
        } catch (\Exception $e) {
            //JIKA TERJADI ERROR, MAKA ROLLBACK DATANYA
            DB::rollback();
            //DAN KEMBALI KE FORM TRANSAKSI SERTA MENAMPILKAN ERROR
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function checkoutFinish($invoice)
    {
        //AMBIL DATA PESANAN BERDASARKAN INVOICE
        $order = Order::with(['kabupaten.kota'])->where('invoice', $invoice)->first();
        //LOAD VIEW checkout_finish.blade.php DAN PASSING DATA ORDER
        return view('ecommerce.checkout_finish', compact('order'));
    }
}
