<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductGroup;
use App\Tag;
use Illuminate\Http\Request;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Str;
use PDF;

class ProductController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
    $products = Product::all();// nerusiuoja
    
        
        
        return view('product.index', [
            'products' => $products,
            
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_groups = ProductGroup::all();// nerusiuoja
        $tags = Tag::all()->sortBy('type');



        return view('product.create',
            [
                'product_groups' => $product_groups,
                'tags' => $tags
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if ($request->has('photo')) {
           $img = Image::make($request->file('photo')); //bitu kratinys, be jokios info
           $image = $request->file('photo'); //failas ir jo info
           // $fileName = $image->getClientOriginalName(); // originalas
           $fileName = Str::random(5).'.jpg';// random sugalvojau
           $folder = public_path('img');
            $img->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($folder.'/'.$fileName, 80, 'jpg');
        }
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount = $request->discount ?? $request->price;
        $product->photo = $fileName ?? '';
        $product->product_group_id = $request->product_group_id;
        $product->about = $request->about ?? '';
        $product->save();
        return redirect()->route('product.index')->with('success_message', 'Der product '.$product->name.' was added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        
        if ($request->has('photo')) {

            if ($product->portret) {
                unlink(public_path('img/'.$product->portret));
            }

            $img = Image::make($request->file('photo')); //bitu kratinys, be jokios info
            $image = $request->file('photo'); //failas ir jo info
            $fileName = $image->getClientOriginalName(); // originalas
 
            $fileName = Str::random(5).'.jpg';// random sugalvojau
 
            $folder = public_path('img');
 
             $img->resize(300, null, function ($constraint) {
                 $constraint->aspectRatio();
             });
             $img->circle(100, 50, 50, function ($draw) {
                 $draw->background('#0000ff');
             });
             $img->save($folder.'/'.$fileName, 80, 'jpg');
         }
        
        $product->name = $request->product_name;
        $product->surname = $request->product_surname;

        if (isset($fileName)){ // jeigu nededame tai cia ir neiname
            $product->portret = $fileName;
        }
        //else pasilieka senas
        
        $product->save();
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->productBooks->count()){

            return redirect()->back()->with('info_message', 'Trinti negalima, nes turi knygų.');
        }
        if ($product->portret) {
            unlink(public_path('img/'.$product->portret));
        }
        $product->delete();
        return redirect()->route('product.index')->with('success_message', 'Viskas - nėra.');;
    }

    public function destroyPhoto(Product $product)
    {

        if ($product->portret) {
            unlink(public_path('img/'.$product->portret));
            $product->portret = '';
            $product->save();
        }

        return redirect()->route('product.edit',[$product])->with('success_message', 'Viskas -FOTKES  nebėra.');;
    }


}
