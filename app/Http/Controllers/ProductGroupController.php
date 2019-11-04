<?php
namespace App\Http\Controllers;

use App\ProductGroup;
use Illuminate\Http\Request;
use Validator;
use Str;

class ProductGroupController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $product_groups = ProductGroup::all();// nerusiuoja
        return view('product_group.index', ['product_groups' => $product_groups]);
    }

    public function create()
    {
        return view('product_group.create');
    }

    public function store(Request $request)
    {
        $product_group = new ProductGroup;
        $product_group->name = $request->name;
        $product_group->save();
        return redirect()->route('product_group.index')->with('success_message', 'Der product_group '.$product_group->name.' was added.');
    }

    public function edit(ProductGroup $product_group)
    {
        return view('product_group.edit', ['product_group' => $product_group]);
    }

    public function update(Request $request, ProductGroup $product_group)
    {
        $product_group->name = $request->name;
        $product_group->save();
        return redirect()->route('product_group.index');
    }

    public function destroy(ProductGroup $product_group)
    {
        // if($product_group->product_groupBooks->count()){

        //     return redirect()->back()->with('info_message', 'Trinti negalima, nes turi knygų.');
        // }

        $product_group->delete();
        return redirect()->route('product_group.index')->with('success_message', 'Viskas - nėra.');;
    }

}
