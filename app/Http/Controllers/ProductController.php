<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Support\Basket\Basket;
use App\Support\Storage\Contracts\StorageInterface;

class ProductController extends Controller
{
    public function index(){ 

        //dump(resolve(Basket::class)->itemCount());

        $products=Product::all();

        $sessionStorage=resolve(StorageInterface::class);

        //$sessionStorage->set('item',5);
        //$sessionStorage->set('test', 1);
        //dd($sessionStorage->get('product'));

        //dd($sessionStorage->count());

       // dump(session()->all());
       //dd(session()->all());

        return view('products.index',compact(['products']));
    }
}
