<div class="photo">
    <form action="{{ route('photo.destroy',$photo) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">x</button>
    </form>
    <img src="{{ asset('storage/' . $photo->path) }}" alt="photo">

</div>
