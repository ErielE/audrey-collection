<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        //BUAT QUERY KE DATABASE MENGGUNAKAN MODEL CATEGORY DENGAN MENGURUTKAN BERDASARKAN CREATED_AT DAN DISET DESCENDING, KEMUDIAN PAGINATE(10) BERARTI HANYA ME-LOAD 10 DATA PER PAGENYA
        $kategori = Kategori::with(['parent'])->orderBy('created_at', 'DESC')->paginate(10);
        //QUERY INI MENGAMBIL SEMUA LIST CATEGORY DARI TABLE CATEGORIES, PERHATIKAN AKHIRANNYA ADALAH GET() TANPA ADA LIMIT
        //LALU getParent() DARI MANA? METHOD TERSEBUT ADALAH SEBUAH LOCAL SCOPE
        $parent = Kategori::getParent()->orderBy('nama', 'ASC')->get();

        return view('kategori.index', compact('kategori', 'parent'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:50|unique:kategoris'
        ]);
        $request->request->add(['slug' => $request->nama]);
        Kategori::create($request->except('_token'));
        return redirect(route('kategori.index'))->with(['success' => 'Kategori Baru Ditambahkan!']);
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        $parent = kategori::getParent()->orderBy('nama', 'ASC')->get();
        return view('kategori.edit', compact('kategori', 'parent'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:50|unique:kategoris,nama,' . $id
        ]);
        $kategori = Kategori::find($id);
        $kategori->update([
            'nama' => $request->nama,
            'parent_id' => $request->parent_id
        ]);
        return redirect(route('kategori.index'))->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function destroy($id)
    {
        $kategori = Kategori::withCount(['child', 'produk'])->find($id);
        if ($kategori->child_count == 0 && $kategori->produk_count == 0) {
            $kategori->delete();
            return redirect(route('kategori.index'))->with(['success' => 'Kategori Dihapus!']);
        }
        return redirect(route('kategori.index'))->with(['error' => 'Kategori Ini Memiliki Anak Kategori!']);
    }
}
