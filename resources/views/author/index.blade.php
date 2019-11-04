@extends('layouts.app')

@section('title') Der AuthorS !!! @endsection

@section('content')

<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">
                Der AuthorS
              <a href="{{route('author.index',['sortby'=>'surname','direction'=>'desc'])}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M3 12v1.5l11 4.75v-2.1l-2.2-.9v-5l2.2-.9v-2.1L3 12zm7 2.62l-5.02-1.87L10 10.88v3.74zm8-10.37l-3 3h2v12.5h2V7.25h2l-3-3z"/><path fill="none" d="M0 0h24v24H0z"/></svg>
              </a>
              <a href="{{route('author.index',['sortby'=>'surname','direction'=>'asc'])}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 12v-1.5L10 5.75v2.1l2.2.9v5l-2.2.9v2.1L21 12zm-7-2.62l5.02 1.87L14 13.12V9.38zM6 19.75l3-3H7V4.25H5v12.5H3l3 3z"/><path fill="none" d="M0 0h24v24H0z"/></svg>
              </a>
              <form action="{{route('author.index')}}" method="GET">
              <select name="sortby">
                <option value="sd">Pavarde Mazejanciai</option>
                <option value="sa">Pavarde Didejanciai</option>
                <option value="nd">Vardas Mazejanciai</option>
                <option value="na">Vardas Didejanciai</option>
              </select>
              <button type="submit">rusiuot</button>
              </form>
              <br>
              <form action="{{route('author.index')}}" method="GET">
                <input type="text" name="name_search">
                <button type="submit">ieskoti</button>
              </form>
              </div>
               <div class="card-body">
                  <ul class="list-group">
                @foreach ($authors as $author)
                <li class="list-group-item">
                <a href="{{route('author.edit',[$author])}}">{{$author->name}} {{$author->surname}}</a>
                <a href="{{route('author.show',[$author])}}"> Show </a>
                <a href="{{route('author.pdf',[$author])}}"> PDF </a>
                <form method="POST" action="{{route('author.destroy', [$author])}}">
                 @csrf
                 <button type="submit"  class="btn btn-danger">DELETE</button>
                </form>
                @if($author->portret)
                <img src="{{asset('img/'.$author->portret)}}">
                @endif
              </li>
              @endforeach
                  </ul>
              </div>
          </div>
      </div>
  </div>
</div>




@endsection