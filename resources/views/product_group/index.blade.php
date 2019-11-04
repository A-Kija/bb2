@extends('layouts.app')

@section('title') All Product Groups @endsection

@section('content')

<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">
                Product Groups
              </div>
               <div class="card-body">
                  <ul class="list-group">
                @foreach ($product_groups as $product_group)
                <li class="list-group-item">
                <a href="{{route('product_group.edit',[$product_group])}}">{{$product_group->name}}</a>
                               
                <form method="POST" action="{{route('product_group.destroy', [$product_group])}}">
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