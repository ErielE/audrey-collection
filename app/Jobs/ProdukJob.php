<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Imports\ProdukImport; //IMPORT CLASS PRODUkIMPORT YANG AKAN MENG-HANDLE FILE EXCEL
use Illuminate\Support\Str;
use App\Produk;
use File;

class ProdukJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $kategori;
    protected $filename;

    public function __construct($kategori, $filename)
    {
        $this->kategori = $kategori;
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
     public function handle()
    {
        //KEMUDIAN KITA GUNAKAN PRODUkIMPORT YANG MERUPAKAN CLASS YANG AKAN DIBUAT SELANJUTNYA
      	//IMPORT DATA EXCEL TADI YANG SUDAH DISIMPAN DI STORAGE, KEMUDIAN CONVERT MENJADI ARRAY
        $files = (new ProdukImport)->toArray(storage_path('app/public/uploads/' . $this->filename));

      	//KEMUDIAN LOOPING DATANYA
        foreach ($files[0] as $row) {
            // if ($row[4] != '' && filter_var($row[4], FILTER_VALIDATE_URL)) {

          	//FORMATTING URLNYA UNTUK MENGAMBIL FILE-NAMENYA BESERTA EXTENSION
          	//JADI PASTIKAN PADA TEMPLATE MASS UPLOADNYA NANTI PADA BAGIAN URL
          	//HARUS DIAKHIRI DENGAN NAMA FILE YANG LENGKAP DENGAN EXTENSION
            $explodeURL = explode('/', $row[4]);
            $explodeExtension = explode('.', end($explodeURL));
            $filename = time() . Str::random(6) . '.' . end($explodeExtension);

          	//DOWNLOAD GAMBAR TERSEBUT DARI URL TERKAIT
            file_put_contents(storage_path('app/public/produks') . '/' . $filename, file_get_contents($row[4]));

          	//KEMUDIAN SIMPAN DATANYA DI DATABASE
            Produk::create([
                'nama' => $row[0],
                'slug' => $row[0],
                'kategori_id' => $this->kategori,
                'deskripsi' => $row[1],
                'harga' => $row[2],
                'berat' => $row[3],
                'gambar' => $filename,
                'status' => true
            ]);
            // }
        }
      	//JIKA PROSESNYA SUDAH SELESAI MAKA FILE YANG ADA DISTORAGE AKAN DIHAPUS
        File::delete(storage_path('app/public/uploads/' . $this->filename));
    }
}
