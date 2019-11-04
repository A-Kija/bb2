 @extends('layouts.app')

 @section('title') Manufacture @endsection

 @section('content')
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Manufacture</div>
                 <div class="card-body">
                    <form method="POST" action="{{route('manufacture.store')}}">
                        <div class="form-group">
                            <label>Name: </label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                            <small class="form-text text-muted">Der name.</small>
                        </div>
                        <div class="form-group">
                            <label>About: </label>
                            <textarea name="about" id="summernote">{{old('about')}}</textarea>
                            <small class="form-text text-muted">About.</small>
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
 