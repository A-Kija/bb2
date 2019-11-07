@extends('layouts.front')

@section('title')
Sveiki parduotuveje
@endsection

@section('content')
Sveiki parduotuveje



@foreach ($product_groups as $products)



    @foreach ($products as $product)

    <br>
<a href="{{route('pizza',[$product->groupIs])}}">
    {{$product->groupIs->name}} <img src="{{asset('img/'.$product->photo)}}">
</a>
    @break

    @endforeach

    <br><br>

@endforeach

@endsection