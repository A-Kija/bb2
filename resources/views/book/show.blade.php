@extends('layouts.app')

@section('title') Der Author !!! @endsection

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{$book->title}} Book By: {{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}</div>
                <div class="card-body">

                Title: {{$book->title}}<br>
                ISBN: {{$book->isbn}}<br>
                Pages: {{$book->pages}}<br>
                About:<br><small> {!!$book->about!!}</small><br>
                   
               </div>
           </div>
       </div>
   </div>
</div>

@endsection
