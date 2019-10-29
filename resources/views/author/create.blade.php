 @extends('layouts.app')

 @section('title') Create Der Author !!! @endsection

 @section('content')
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Der Author</div>
                 <div class="card-body">
                    <form method="POST" action="{{route('author.store')}}" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Name: </label>
                            <input type="text" class="form-control" name="author_name" value="{{old('author_name')}}">
                            <small class="form-text text-muted">Der name.</small>
                        </div>
                        <div class="form-group">
                            <label>Sur-Name: </label>
                            <input type="text" class="form-control" name="author_surname" value="{{old('author_surname')}}">
                            <small class="form-text text-muted">Der surname.</small>
                        </div>
                        <div class="form-group">
                            <label>Der portret: </label>
                            <input type="file" class="form-control" name="author_portret">
                            <small class="form-text text-muted">Der portret.</small>
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
 