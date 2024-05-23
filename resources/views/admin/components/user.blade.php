<div class="user">
<table>
    <tr>
        <td>{{ __('messages.First name') }}</td>
        <td>{{ $user->first_name }}</td>
    </tr>
    <tr>
        <td>{{ __('messages.Last name') }}</td>
        <td>{{ $user->last_name }}</td>
    </tr>
    <tr>
        <td>{{ __('messages.Phone') }}</td>
        <td>{{ $user->phone }}</td>
    </tr>
    <tr>
        <td>{{ __('messages.Email') }}</td>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <td>{{ __('messages.Created at') }}</td>
        <td>{{ $user->created_at }}</td>
    </tr>
    <tr>
        <td>{{ __('messages.Updated at') }}</td>
        <td>{{ $user->updated_at }}</td>
    </tr>
    <tr>
        <td>{{ __('messages.Orders') }}</td>
        <td>{{ $user->orders()->count() }}</td>

    </tr>
</table>
    <div class="buttons">
        <a class="view-button" href="{{ route('orders.user',$user) }}">{{ __('messages.Orders') }}</a>
        <form action="{{ route('user.destroy',$user) }}" method="post">
            @csrf
            <button type="submit">{{ __('messages.Delete') }}</button>
        </form>
    </div>

</div>
