<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistanceController extends Controller
{
    
    public function enter()
    {
        return view('distance.enter');
    }

    public function count(Request $request)
    {
        
        $stops = $request->stop1.'|'.$request->stop2;

        // dd($stops);
        
        //plain PHP
        $ch = curl_init(); // susikuriam curl

        curl_setopt($ch, CURLOPT_URL, 'https://www.distance24.org/route.json?stops='.$stops);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 0);


        // curl_setopt_array($ch, $curlConfig);// konfiguruojam pagal nustatymus
        $result = curl_exec($ch); // vyksta siuntimas



        // dd(curl_getinfo($ch));

        // kodas cia lauks atsakymo
        curl_close($ch);

        $result = json_decode($result);

        $request->flash();

        return redirect()->back()->with(['distance_count' => $result->distance]);


        // dd($result);
    }
    
}
