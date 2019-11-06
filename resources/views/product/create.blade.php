 @extends('layouts.app')

 @section('title') Product @endsection

 @section('content')
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Product</div>
                 <div class="card-body">
                    <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Name: </label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                            <small class="form-text text-muted">Der name.</small>
                        </div>
                        <div class="form-group">
                            <label>Price: </label>
                            <input type="text" class="form-control" name="price" value="{{old('price')}}">
                            <small class="form-text text-muted">Der price.</small>
                        </div>
                        <div class="form-group">
                            <label>Discount: </label>
                            <input type="text" class="form-control" name="discount" value="{{old('discount')}}">
                            <small class="form-text text-muted">Der discount.</small>
                        </div>
                        <div class="form-group">
                            <label>Photo: </label>
                            <input type="file" class="form-control" name="photo">
                            <small class="form-text text-muted">Der photo.</small>
                        </div>
                        <div class="form-group">
                            <label>Group: </label>
                            <select name="product_group_id" class="form-control">
                                @foreach ($product_groups as $product_group)
                                    <option value="{{$product_group->id}}">{{$product_group->name}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Der group.</small>
                        </div>
                        <div class="form-group">
                            <label>About: </label>
                            <textarea name="about" id="summernote">{{old('about')}}</textarea>
                            <small class="form-text text-muted">About.</small>
                        </div>

                        <div class="container my-4">
                            
                            <ul class="list-group list-group-flush">
                                @foreach ($tags as $tag)
                                @if($tag->type_name != ($t ?? ''))
                                <br>
                                <p class="font-weight-bold">{{$t = $tag->type_name}}</p>
                                @endif
                                <li class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="tag[]" value="{{$tag->id}}" id="check_{{$tag->id}}">
                                    <label class="custom-control-label" for="check_{{$tag->id}}">{{$tag->name}}</label>
                                </div>
                                </li>
                                @endforeach
                            </ul>
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
 