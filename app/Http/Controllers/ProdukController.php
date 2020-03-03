<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Produk;
use App\Kategori;
use App\Jobs\ProdukJob;
use File;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with(['kategori'])->orderBy('created_at', 'DESC');
        //JIKA TERDAPAT PARAMETER PENCARIAN DI URL ATAU Q PADA URL TIDAK SAMA DENGAN KOSONG
        if (request()->q != '') {
            //MAKA LAKUKAN FILTERING DATA BERDASARKAN NAME DAN VALUENYA SESUAI DENGAN PENCARIAN YANG DILAKUKAN USER
            $produk = $produk->where('nama', 'LIKE', '%' . request()->q . '%');
        }
        //TERAKHIR LOAD 10 DATA PER HALAMANNYA
        $produk = $produk->paginate(10);
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        $kategori = Kategori::orderBy('nama', 'DESC')->get();
        return view('produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        //VALIDASI REQUESTNYA
        $this->validate($request, [
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required',
            'kategori_id' => 'required|exists:kategoris,id', //CATEGORY_ID KITA CEK HARUS ADA DI TABLE kATEGORIES DENGAN FIELD ID
            'harga' => 'required|integer',
            'berat' => 'required|integer',
            'gambar' => 'required|image|mimes:png,jpeg,jpg' //GAMBAR DIVALIDASI HARUS BERTIPE PNG,JPG DAN JPEG
        ]);

        //JIKA FILENYA ADA
        if ($request->hasFile('gambar')) {
            //MAKA KITA SIMPAN SEMENTARA FILE TERSEBUT KEDALAM VARIABLE FILE
            $file = $request->file('gambar');
            //KEMUDIAN NAMA FILENYA KITA BUAT CUSTOMER DENGAN PERPADUAN TIME DAN SLUG DARI NAMA PRODUK. ADAPUN EXTENSIONNYA KITA GUNAKAN BAWAAN FILE TERSEBUT
            $filename = time() . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            //SIMPAN FILENYA KEDALAM FOLDER PUBLIC/PRODUkS, DAN PARAMETER KEDUA ADALAH NAMA CUSTOM UNTUK FILE TERSEBUT
            $file->storeAs('public/produks', $filename);

            //SETELAH FILE TERSEBUT DISIMPAN, KITA SIMPAN INFORMASI PRODUKNYA KEDALAM DATABASE
            $produk = Produk::create([
                'nama' => $request->nama,
                'slug' => $request->nama,
                'kategori_id' => $request->kategori_id,
                'deskripsi' => $request->deskripsi,
                'gambar' => $filename, //PASTIKAN MENGGUNAKAN VARIABLE FILENAM YANG HANYA BERISI NAMA FILE SAJA (STRING)
                'harga' => $request->harga,
                'berat' => $request->berat,
                'status' => $request->status
            ]);
            //JIKA SUDAH MAKA REDIRECT KE LIST PRODUK
            return redirect(route('produk.index'))->with(['success' => 'Produk Baru Ditambahkan']);
        }
    }

    public function edit($id)
    {
        $produk = Produk::find($id); //AMBIL DATA PRODUK TERKAIT BERDASARKAN ID
        $kategori = Kategori::orderBy('nama', 'DESC')->get(); //AMBIL SEMUA DATA KATEGORI
        return view('produk.edit', compact('produk', 'kategori')); //LOAD VIEW DAN PASSING DATANYA KE VIEW
    }

    public function update(Request $request, $id)
    {
    //VALIDASI DATA YANG DIKIRIM
        $this->validate($request, [
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|integer',
            'berat' => 'required|integer',
            'gambar' => 'nullable|image|mimes:png,jpeg,jpg' //gambar BISA NULLABLE
        ]);

        $produk = Produk::find($id); //AMBIL DATA PRODUK YANG AKAN DIEDIT BERDASARKAN ID
        $filename = $produk->gambar; //SIMPAN SEMENTARA NAMA FILE gambar SAAT INI

        //JIKA ADA FILE GAMBAR YANG DIKIRIM
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            //MAKA UPLOAD FILE TERSEBUT
            $file->storeAs('public/produks', $filename);
            //DAN HAPUS FILE GAMBAR YANG LAMA
            File::delete(storage_path('app/public/produks/' . $produk->gambar));
        }

    //KEMUDIAN UPDATE PRODUK TERSEBUT
        $produk->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'berat' => $request->berat,
            'gambar' => $filename
        ]);
        return redirect(route('produk.index'))->with(['success' => 'Data Produk Diperbaharui']);
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        File::delete(storage_path('app/public/produks/' . $produk->gambar));
        $produk->delete();
        return redirect(route('produk.index'))->with(['success' => 'Produk Sudah Dihapus']);
    }

    public function massUploadForm()
    {
        $kategori = Kategori::orderBy('nama', 'DESC')->get();
        return view('produk.bulk', compact('kategori'));
    }

    public function massUpload(Request $request)
    {
    //VALIDASI DATA YANG DIKIRIM
        $this->validate($request, [
            'kategori_id' => 'required|exists:kategoris,id',
            'file' => 'required|mimes:xlsx' //PASTIKAN FORMAT FILE YANG DITERIMA ADALAH XLSX
        ]);

        //JIKA FILE-NYA ADA
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '-produk.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads', $filename); //MAKA SIMPAN FILE TERSEBUT DI STORAGE/APP/PUBLIC/UPLOADS

            //BUAT JADWAL UNTUK PROSES FILE TERSEBUT DENGAN MENGGUNAKAN JOB
            //ADAPUN PADA DISPATCH KITA MENGIRIMKAN DUA PARAMETER SEBAGAI INFORMASI
            //YAKNI KATEGORI ID DAN NAMA FILENYA YANG SUDAH DISIMPAN
            ProdukJob::dispatch($request->kategori_id, $filename);
            return redirect()->back()->with(['success' => 'Upload Produk Dijadwalkan']);
        }
    }
}
