<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produk;
use App\Kategori;
use App\Customer;
use App\Provinsi;

class FrontController extends Controller
{
    public function index()
    {
        //MEMBUAT QUERY UNTUK MENGAMBIL DATA PRODUK YANG DIURUTKAN BERDASARKAN TGL TERBARU
        //DAN DI-LOAD 6 DATA PER PAGENYA
        $produk = Produk::orderBy('created_at', 'DESC')->paginate(6);
        //LOAD VIEW INDEX.BLADE.PHP DAN PASSING DATA DARI VARIABLE PRODUk
        return view('ecommerce.index', compact('produk'));
    }

    public function produk()
    {
        //BUAT QUERY UNTUK MENGAMBIL DATA PRODUK, LOAD PER PAGENYA KITA GUNAKAN 12 AGAR PRESISI PADA HALAMAN TERSEBUT KARENA DALAM SEBARIS MEMUAT 4 BUAH PRODUK
        $produk = Produk::orderBy('created_at', 'DESC')->paginate(12);
        //LOAD VIEW PRODUk.BLADE.PHP DAN PASSING KEDUA DATA DIATAS
        return view('ecommerce.produk', compact('produk'));
    }

     public function kategoriProduk($slug)
    {
    //JADI QUERYNYA ADALAH KITA CARI DULU KATEGORI BERDASARKAN SLUG, SETELAH DATANYA DITEMUKAN
    //MAKA SLUG AKAN MENGAMBIL DATA PRODUCT YANG BERELASI MENGGUNAKAN METHOD PRODUCT() YANG TELAH DIDEFINISIKAN PADA FILE CATEGORY.PHP SERTA DIURUTKAN BERDASARKAN CREATED_AT DAN DI-LOAD 12 DATA PER SEKALI LOAD
        $produk = Kategori::where('slug', $slug)->first()->produk()->orderBy('created_at', 'DESC')->paginate(12);
        //LOAD VIEW YANG SAMA YAKNI PRODUCT.BLADE.PHP KARENA TAMPILANNYA AKAN KITA BUAT SAMA JUGA
        return view('ecommerce.produk', compact('produk'));
    }

    public function show($slug)
    {
        //QUERY UNTUK MENGAMBIL SINGLE DATA BERDASARKAN SLUG-NYA
        $produk = Produk::with(['kategori'])->where('slug', $slug)->first();
        //LOAD VIEW SHOW.BLADE.PHP DAN PASSING DATA PRODUk
        return view('ecommerce.show', compact('produk'));
    }

    public function verifyCustomerRegistration($token)
    {
        //JADI KITA BUAT QUERY UNTUK MENGMABIL DATA USER BERDASARKAN TOKEN YANG DITERIMA
        $customer = Customer::where('activate_token', $token)->first();
        if ($customer) {
            //JIKA ADA MAKA DATANYA DIUPDATE DENGNA MENGOSONGKAN TOKENNYA DAN STATUSNYA JADI AKTIF
            $customer->update([
                'activate_token' => null,
                'status' => 1
            ]);
            //REDIRECT KE HALAMAN LOGIN DENGAN MENGIRIMKAN FLASH SESSION SUCCESS
            return redirect(route('customer.login'))->with(['success' => 'Verifikasi Berhasil, Silahkan Login']);
        }
        //JIKA TIDAK ADA, MAKA REDIRECT KE HALAMAN LOGIN
        //DENGAN MENGIRIMKAN FLASH SESSION ERROR
        return redirect(route('customer.login'))->with(['error' => 'Invalid Verifikasi Token']);
    }

    public function customerSettingForm()
    {
        //MENGAMBIL DATA CUSTOMER YANG SEDANG LOGIN
        $customer = auth()->guard('customer')->user()->load('kabupaten');
        //GET DATA PROPINSI UNTUK DITAMPILKAN PADA SELECT BOX
        $provinsis = Provinsi::orderBy('nama', 'ASC')->get();
        //LOAD VIEW setting.blade.php DAN PASSING DATA CUSTOMER - PROVINCES
        return view('ecommerce.setting', compact('customer', 'provinsis'));
    }

    public function customerUpdateProfile(Request $request)
    {
        //VALIDASI DATA YANG DIKIRIM
        $this->validate($request, [
            'nama' => 'required|string|max:100',
            'phone_number' => 'required|max:15',
            'alamat' => 'required|string',
            'kabupaten_id' => 'required|exists:kabupatens,id',
            'password' => 'nullable|string|min:6'
        ]);

        //AMBIL DATA CUSTOMER YANG SEDANG LOGIN
        $user = auth()->guard('customer')->user();
        //AMBIL DATA YANG DIKIRIM DARI FORM
        //TAPI HANYA 4 COLUMN SAJA SESUAI YANG ADA DI BAWAH
        $data = $request->only('nama', 'phone_number', 'alamat', 'kabupaten_id');
        //ADAPUN PASSWORD KITA CEK DULU, JIKA TIDAK KOSONG
        if ($request->password != '') {
            //MAKA TAMBAHKAN KE DALAM ARRAY
            $data['password'] = $request->password;
        }
        //TERUS UPDATE DATANYA
        $user->update($data);
        //DAN REDIRECT KEMBALI DENGAN MENGIRIMKAN PESAN BERHASIL
        return redirect()->back()->with(['success' => 'Profil berhasil diperbaharui']);
    }
}
