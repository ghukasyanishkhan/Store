<a class="a" href="{{ route('home') }}">{{ __('messages.Home') }}</a>
<a class="a" href="{{ route('contact.show') }}">{{ __('messages.Contact us') }}</a>
<a class="a" href="{{ route('card.view') }}">{{ __('messages.My card') }}</a>
<a class="a" href="{{ route('order.view') }}">{{ __('messages.My orders') }}</a>
<a class="a" href="{{ route('user.profile.edit') }}">{{ __('messages.Edit Profile') }}</a>
<a class="a" href="{{ route('sign-out') }}">{{ __('messages.Log Out') }}</a>
@include('user.components.search')
@include('user.components.userName')
@include('user.components.lang')

