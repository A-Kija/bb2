<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductGroup;

class FrontController extends Controller
{
    public function index()
    {
        

        $pgs = ProductGroup::all();

        $product_groups = collect();
        
        foreach($pgs as $pg) {
            $products = Product::where('product_group_id', $pg->id)->get();
            $product_groups->add($products);
        }
        
        
        return view('front.index',
        [
            'product_groups' => $product_groups
        ]
        );
    }

    public function group($pg)
    {
        $pg = ProductGroup::where('id', $pg)->first();// pats asmeniskai pasiima pagal id

        $products = Product::where('product_group_id', $pg->id)->get();
        
        
        
        return view('front.group',
        [
            'product_group' => $pg,
            'products' =>  $products
        ]
        );
    }
}
