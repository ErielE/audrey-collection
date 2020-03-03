<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produk;

class FrontendController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('created_at', 'DESC')->paginate(6);



        return response()->json($produk, 200);
    }

}
