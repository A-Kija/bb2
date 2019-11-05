@extends('layouts.app')

@section('title') All Products @endsection

@section('content')

<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">
                Products
              </div>
               <div class="card-body">
                  <ul class="list-group">
                @foreach ($products as $product)
                <li class="list-group-item">
                <a href="{{route('product.edit',[$product])}}">{{$product->name}}</a>
                               
                <form method="POST" action="{{route('product.destroy', [$product])}}">
                 @csrf
                 <button type="submit"  class="btn btn-danger">DELETE</button>
                </form>
              </li>
              @endforeach
                  </ul>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection