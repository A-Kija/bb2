<form method="POST" action="{{route('author.update',[$author])}}"  enctype="multipart/form-data">
    Name: <input type="text" name="author_name" value="{{$author->name}}">
    Surname: <input type="text" name="author_surname" value="{{$author->surname}}">
    <div class="form-group">
            @if($author->portret)
            <img src="{{asset('img/'.$author->portret)}}">
            @endif
        <label>Der portret: </label>
        <input type="file" class="form-control" name="author_portret">
        <small class="form-text text-muted">Der portret.</small>

    </div>
    @csrf
    <button type="submit">EDIT</button>
 </form>
 <form method="POST" action="{{route('author.destroy.photo', [$author])}}">
@csrf
<button type="submit"  class="btn btn-danger">DELETE PHOTO</button>
</form>