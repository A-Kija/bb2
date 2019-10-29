@foreach ($books as $book)
  <a href="{{route('book.edit',[$book])}}">
    {{$book->title}}
    
    
  </a>
  Autorius: {{$book->bookAuthor->name}} {{$book->bookAuthor->surname}} 


  <form method="POST" action="{{route('book.destroy', [$book])}}">
   @csrf
   <button type="submit">DELETE</button>
  </form>
  <br>
@endforeach



