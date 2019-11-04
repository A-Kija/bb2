<?php
namespace App\Http\Controllers;

use App\Manufacture;
use Illuminate\Http\Request;
use Validator;
use Str;

class ManufactureController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $manufactures = Manufacture::all();// nerusiuoja
        return view('manufacture.index', ['manufactures' => $manufactures]);
    }

    public function create()
    {
        return view('manufacture.create');
    }

    public function store(Request $request)
    {
        $manufacture = new Manufacture;
        $manufacture->name = $request->name;
        $manufacture->about = $request->about;
        $manufacture->save();
        return redirect()->route('manufacture.index')->with('success_message', 'Der manufacture '.$manufacture->name.' was added.');
    }

    public function edit(Manufacture $manufacture)
    {
        return view('manufacture.edit', ['manufacture' => $manufacture]);
    }

    public function update(Request $request, Manufacture $manufacture)
    {
        $manufacture->name = $request->name;
        $manufacture->about = $request->about;
        $manufacture->save();
        return redirect()->route('manufacture.index');
    }

    public function destroy(Manufacture $manufacture)
    {
        // if($manufacture->manufactureBooks->count()){

        //     return redirect()->back()->with('info_message', 'Trinti negalima, nes turi knygų.');
        // }

        $manufacture->delete();
        return redirect()->route('manufacture.index')->with('success_message', 'Viskas - nėra.');;
    }

}
