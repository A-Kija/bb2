@extends('layouts.app')

@section('title') All Manufactures @endsection

@section('content')

<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">
                Manufactures
              </div>
               <div class="card-body">
                  <ul class="list-group">
                @foreach ($manufactures as $manufacture)
                <li class="list-group-item">
                <a href="{{route('manufacture.edit',[$manufacture])}}">{{$manufacture->name}}</a>
                               
                <form method="POST" action="{{route('manufacture.destroy', [$manufacture])}}">
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