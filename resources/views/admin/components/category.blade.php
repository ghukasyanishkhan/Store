<div class="category">
    <table>
        <tr>
            <td>{{ __('messages.Type') }}</td>
            <td>{{ $category->type }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.Quantity') }}</td>
            <td>{{ $category->items()->count() }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.Total price') }}</td>
            <td>{{ $category->items()->sum('price') }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.Created at') }}</td>
            <td>{{ $category->created_at }}</td>
        </tr>
        <tr>
            <td>{{ __('messages.Updated at') }}</td>
            <td>{{ $category->updated_at }}</td>
        </tr>

    </table>

    <div class="buttons">
        <a class="view-button" href="{{ route('dashboard.items',$category) }}">{{ __('messages.Items') }}</a>
        <a class="view-button" href="{{ route('item.create',$category) }}">{{ __('messages.Add Item') }}</a>
        <form action="{{ route('category.destroy',$category) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">{{ __('messages.Delete') }}</button>
        </form>
    </div>
</div>
