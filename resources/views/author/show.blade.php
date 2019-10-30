@extends('layouts.app')

@section('title') Der Author !!! @endsection

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{$author->name}} {{$author->surname}} Books: {{$author->authorBooks()->count()}}</div>
                <div class="card-body">
                        <ul class="list-group">
                                @foreach ($author->authorBooks as $book)
                                <li class="list-group-item">
                                        Title: {{$book->title}}
                                        ISBN: {{$book->isbn}}
                                        Pages: {{$book->pages}}
                                <a href="{{route('book.show',[$book])}}">SHOW</a>
                                </li>
                        @endforeach
                            </ul>
                   
               </div>
           </div>
       </div>
   </div>
</div>

@endsection
