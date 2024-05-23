<div class="home-item">
    <a href="{{ route('item.show',$item) }}">
        <img src="{{ asset('storage/' . $item->photos->first()->path) }}" alt="item">
    </a>
    <table>
        <tr>
            <td>{{ $item->name }}</td>
        </tr>
        <tr>
            <td>{{ $item->price.' $' }}</td>
            <td>
                <form action="{{ route('card.add',$item) }}" method="post">
                    @csrf
                    <button type="submit">{{ __('messages.Add to card') }}</button>
                </form>
            </td>
        </tr>
    </table>
</div>
