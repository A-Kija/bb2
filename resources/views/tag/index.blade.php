@extends('layouts.app')

@section('title') All Tags @endsection

@section('content')

<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">
                Tags
              </div>
               <div class="card-body">
                  <ul class="list-group">
                @foreach ($tags as $tag)
                <li class="list-group-item">
                <a href="{{route('tag.edit',[$tag])}}">{{$tag->name}}</a>
                               
                <form method="POST" action="{{route('tag.destroy', [$tag])}}">
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