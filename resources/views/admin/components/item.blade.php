<div class="item">
    @if ($item->photos->isNotEmpty())
        <img src="{{ asset('storage/' . $item->photos->first()->path) }}" alt="item">
    @endif

    <table>
        <tr>
            <td>{{ __('messages.Name') }}</td>
            <td>{{ $item->name }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.Price') }}</td>
            <td>{{ $item->price }}</td>
        </tr>

        <tr>
            <td>{{ __('messages.Views') }}</td>
            <td>{{ $item->views }}</td>
        </tr>

        <tr>
            <td>{{ __('messages.Created at') }}</td>
            <td>{{ $item->created_at }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.Updated at') }}</td>
            <td>{{ $item->updated_at }}</td>
        </tr>
        <tr>
            <td>{{ $item->description }}</td>
        </tr>
    </table>
    <div class="buttons">

        <a class="view-button" href="{{ route('item.edit',$item) }}">{{ __('messages.Edit') }}</a>

        <form action="{{ route('item.destroy',$item) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">{{ __('messages.Delete') }}</button>
        </form>
    </div>
</div>
