@extends('layouts.app')

@section('title') Product Group Edit @endsection

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Edit Manufacture</div>
                <div class="card-body">
                   <form method="POST" action="{{route('product_group.update',[$product_group])}}">
                       <div class="form-group">
                           <label>Name: </label>
                           <input type="text" class="form-control" name="name" value="{{old('name', $product_group->name)}}">
                           <small class="form-text text-muted">Der name.</small>
                       </div>
                       @csrf
                       <button type="submit" class="btn btn-primary">ADD</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
