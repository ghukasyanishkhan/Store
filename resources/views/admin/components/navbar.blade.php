
<a href="{{ route('dashboard.categories') }}" class="a">{{__('messages.Categories')}}</a>
<a href="{{ route('dashboard.users') }}" class="a">{{__('messages.Users')}}</a>
<a href="{{ route('users.order') }}" class="a">{{__('messages.Orders')}}</a>
<a href="{{ route('admin.profile.edit') }}" class="a"> {{__('messages.Edit Profile')}}  </a>
<a href="{{ route('sign-out') }}" class="a">{{__('messages.Log out')}}</a>
<div>
    <p>  {{ __('messages.Create New category') }}</p>
    <form action="{{ route('category.create') }}" method="post">
        @csrf
        <input type="text" name="type">
        <button type="submit">{{__('messages.Create')}}</button>
    </form>
</div>
