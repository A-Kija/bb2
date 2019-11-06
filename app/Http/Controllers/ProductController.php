<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductGroup;
use App\ProductTag;
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
        $_tags = Tag::all()->sortBy('type');
        $tags = collect();// tuscias lagaminas
        foreach ($_tags as $tag) {
            $type = Tag::TYPES[$tag->type];
            $tag->type_name = $type;
            $tags->add($tag);
        }


        



        return view('product.create',
            [
                'product_groups' => $product_groups,
                'tags' => $tags,
               
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
       
    //    dd($request->all());
       
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

        //tagu lentele

        $product_tags = ProductTag::where('product_id', $product->id)->get();
        


        $product_tags_array =  $product_tags->pluck('tag_id') ?? [];

        // pridejimas
        foreach ($request->tag ?? [] as $post_tag) {
            if (!in_array($post_tag, $product_tags_array->all())) {
                $pt = new ProductTag;
                $pt->tag_id = $post_tag;
                $pt->product_id = $product->id;
                $pt->save();
            }
        }

        //trinimas
        foreach ($product_tags as $product_tag) {
            if (!in_array($product_tag->tag_id, $request->tag ?? [])) {
                $product_tag->delete(); // trinam
            }
        }

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
    $product_tags = ProductTag::where('product_id', $product->id)->get();
    $product_tags_array =  $product_tags->pluck('tag_id')->all() ?? [];
        
        $product_groups = ProductGroup::all();// nerusiuoja
        $_tags = Tag::all()->sortBy('type');
        $tags = collect();// tuscias lagaminas
        foreach ($_tags as $tag) {
            $type = Tag::TYPES[$tag->type];
            $tag->type_name = $type;
            $tag->checked = (in_array($tag->id, $product_tags_array)) ? 1 : 0;
            $tags->add($tag);
        }
        
        
        
        
        return view('product.edit', 
        [
            'product' => $product,
            'product_groups' => $product_groups,
            'tags' => $tags,

        ]);
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

         $product->name = $request->name;
         $product->price = $request->price;
         $product->discount = $request->discount ?? $request->price;
         $product->photo = $fileName ?? '';
         $product->product_group_id = $request->product_group_id;
         $product->about = $request->about ?? '';
         $product->save();
 
         //tagu lentele
 
         $product_tags = ProductTag::where('product_id', $product->id)->get();
         
 
 
         $product_tags_array =  $product_tags->pluck('tag_id') ?? [];
 
         // pridejimas
         foreach ($request->tag ?? [] as $post_tag) {
             if (!in_array($post_tag, $product_tags_array->all())) {
                 $pt = new ProductTag;
                 $pt->tag_id = $post_tag;
                 $pt->product_id = $product->id;
                 $pt->save();
             }
         }
 
         //trinimas
         foreach ($product_tags as $product_tag) {
             if (!in_array($product_tag->tag_id, $request->tag ?? [])) {
                 $product_tag->delete(); // trinam
             }
         }
 
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
