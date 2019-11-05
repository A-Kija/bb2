@extends('layouts.app')

@section('title') Product Edit @endsection

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Edit Product</div>
                <div class="card-body">
                   <form method="POST" action="{{route('product.update',[$product])}}">
                       <div class="form-group">
                           <label>Name: </label>
                           <input type="text" class="form-control" name="name" value="{{old('name', $product->name)}}">
                           <small class="form-text text-muted">Der name.</small>
                       </div>
                       <div class="form-group">
                           <label>About: </label>
                           <textarea name="about" id="summernote">{{old('about', $product->about)}}</textarea>
                           <small class="form-text text-muted">About.</small>
                       </div>
                       <div class="form-group">
                            <label>Type: </label>
                            <select name="type" class="form-control">
                            <option value="1">Priedas Būtinas</option>
                            <option value="2">Priedas Nebūtinas</option>
                            <option value="3">Nuolaida</option>
                        </select>
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
<script>
$(document).ready(function() {
   $('#summernote').summernote();
   });
</script>
@endsection
