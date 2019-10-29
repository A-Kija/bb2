<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Str;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        // _dd($request->all());

        if (!empty($request->all())) {
            if ($request->sortby == 'surname') {
                if ($request->direction == 'asc') {
                    $authors = Author::all()->sortBy('surname');
                }
                elseif ($request->direction == 'desc') {
                    $authors = Author::all()->sortByDesc('surname');
                }
                else {
                    $authors = Author::all();// nerusiuoja
                }
            }
            elseif ($request->sortby == 'sd') {
                $authors = Author::all()->sortByDesc('surname');
            }
            elseif ($request->sortby == 'sa') {
                $authors = Author::all()->sortBy('surname');
            }
            elseif ($request->sortby == 'nd') {
                $authors = Author::all()->sortByDesc('name');
            }
            elseif ($request->sortby == 'na') {
                $authors = Author::all()->sortBy('name');
            }
            else {
                $authors = Author::all();// nerusiuoja
            }
        }
        else {
            $authors = Author::all();// nerusiuoja
        }
        
        
        return view('author.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(),
       [
           'author_name' => ['required', 'min:3', 'max:64'],
           'author_surname' => ['required', 'min:3', 'max:64'],
           'author_portret' => ['sometimes', 'required', 'image:jpeg', 'max:10000'],
       ],
       [
        'author_name.required' => 'autoriau vardas laukelis yra',
        'author_name.min' => 'autoriau vardas trumpokas',
       ]
       );

       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

       if ($request->has('author_portret')) {
           $img = Image::make($request->file('author_portret')); //bitu kratinys, be jokios info
           $image = $request->file('author_portret'); //failas ir jo info
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

        $author = new Author;
        $author->name = $request->author_name;
        $author->surname = $request->author_surname;
        $author->portret = $fileName ?? '';
        $author->save();
        return redirect()->route('author.index')->with('success_message', 'Der author '.$author->name.' was added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('author.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        
        if ($request->has('author_portret')) {

            if ($author->portret) {
                unlink(public_path('img/'.$author->portret));
            }

            $img = Image::make($request->file('author_portret')); //bitu kratinys, be jokios info
            $image = $request->file('author_portret'); //failas ir jo info
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
        
        $author->name = $request->author_name;
        $author->surname = $request->author_surname;

        if (isset($fileName)){ // jeigu nededame tai cia ir neiname
            $author->portret = $fileName;
        }
        //else pasilieka senas
        
        $author->save();
        return redirect()->route('author.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if($author->authorBooks->count()){

            return redirect()->back()->with('info_message', 'Trinti negalima, nes turi knygų.');
        }
        if ($author->portret) {
            unlink(public_path('img/'.$author->portret));
        }
        $author->delete();
        return redirect()->route('author.index')->with('success_message', 'Viskas - nėra.');;
    }

    public function destroyPhoto(Author $author)
    {

        if ($author->portret) {
            unlink(public_path('img/'.$author->portret));
            $author->portret = '';
            $author->save();
        }

        return redirect()->route('author.edit',[$author])->with('success_message', 'Viskas -FOTKES  nebėra.');;
    }
}
