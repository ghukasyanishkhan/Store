
<div class="edit-profile">
    @include('message')

    <form action="{{ route('profile.update') }}" method="post">
        @csrf
        @method('PATCH')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label>
           {{ __('messages.First name') }}
            <input type="text" name="first_name" value="{{ $user->first_name }}">
        </label>
        <label>
            {{ __('messages.Last name') }}
            <input type="text" name="last_name" value="{{ $user->last_name }}">
        </label>
        <label>
            {{ __('messages.Phone') }}
            <input type="number" name="phone" value="{{ $user->phone }}">
        </label>
        <label>
            {{ __('messages.Email') }}
            <input type="email" name="email" value="{{ $user->email }}">
        </label>
        <label>
            {{ __('messages.Password') }}
            <input type="password" name="password">
        </label>
        <button type="submit">{{ __('messages.Submit') }}</button>
    </form>
    <form action="{{ route('profile.destroy') }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">{{ __('messages.Delete Profile') }}</button>
    </form>
</div>
