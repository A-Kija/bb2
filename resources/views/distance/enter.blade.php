@extends('layouts.app')

@section('title') Atstumų skaičiuoklė @endsection

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Atstumų skaičiuoklė</div>
                <div class="card-body">
                   <form method="POST" action="{{route('distance.count')}}">

                       <div class="form-group">
                           <label>Iš: </label>
                           <input type="text" class="form-control" name="stop1" value="{{old('stop1')}}">
                           <small class="form-text text-muted">Miestas nuo kurio.</small>
                       </div>
                       <div class="form-group">
                           <label>Į: </label>
                           <input type="text" class="form-control" name="stop2" value="{{old('stop2')}}">
                           <small class="form-text text-muted">Miestas iki kurio.</small>
                       </div>
                       @csrf
                       <button type="submit" class="btn btn-primary">Skaičiuoti</button>
                   </form>
                   @if(session()->has('distance_count'))
                    <div class="alert alert-success" role="alert">
                            {{old('stop1')}} {{old('stop2')}} Atstumas:
                        {{session()->get('distance_count')}}
                    </div>
                    @endif
               </div>
           </div>
       </div>
   </div>
</div>

@endsection
