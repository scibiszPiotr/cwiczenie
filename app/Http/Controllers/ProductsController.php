<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductsController extends Controller
{
    public function get(int $id): View
    {
        return view('pages/product', ['product' => Product::findOrFail($id)]);
    }
}
