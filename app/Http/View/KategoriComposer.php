<?php

namespace App\Http\View;

use Illuminate\View\View;
use App\Kategori;

class KategoriComposer
{
    public function compose(View $view)
    {
        //JADI QUERY TADI KITA PINDAHKAN KESINI
        $kategori = Kategori::with(['child'])->withCount(['child'])->getParent()->orderBy('nama', 'ASC')->get();
      	//KEMUDIAN PASSING DATA TERSEBUT DENGAN NAMA VARIABLE kATEGORI
        $view->with('kategori', $kategori);
    }
}
