<?php
namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Validator;
use Str;

class TagController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $tags = Tag::all();// nerusiuoja
        return view('tag.index', ['tags' => $tags]);
    }

    public function create()
    {
        return view('tag.create');
    }

    public function store(Request $request)
    {
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->about = $request->about;
        $tag->type = $request->type;
        $tag->save();
        return redirect()->route('tag.index')->with('success_message', 'Der tag '.$tag->name.' was added.');
    }

    public function edit(Tag $tag)
    {
        return view('tag.edit', ['tag' => $tag]);
    }

    public function update(Request $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->about = $request->about;
        $tag->type = $request->type;
        $tag->save();
        return redirect()->route('tag.index');
    }

    public function destroy(Tag $tag)
    {
        // if($tag->tagBooks->count()){

        //     return redirect()->back()->with('info_message', 'Trinti negalima, nes turi knygų.');
        // }

        $tag->delete();
        return redirect()->route('tag.index')->with('success_message', 'Viskas - nėra.');;
    }

}
