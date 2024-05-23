<div class="card-item">
    <br>
    {{ $item->name }}
    <br>
    {{$item->price.' $'}}
    <form action="{{ route('card.remove',$item) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">x</button>
    </form>
</div>
