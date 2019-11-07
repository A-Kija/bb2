@extends('layouts.front')

@section('title')
Sveiki parduotuveje
@endsection

@section('content')
Sveiki parduotuveje






    @foreach ($products as $product)



    {{$product->groupIs->name}} {{$product->name}} <img src="{{asset('img/'.$product->photo)}}">


    @endforeach



@endsection