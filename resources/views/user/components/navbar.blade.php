<span>{{ __('messages.Categories') }} </span>
<br>
<br>
@if(isset($categories))
    <ol>
        @foreach($categories as $category)
            <li>
                @include('user.components.category')
            </li>
        @endforeach
    </ol>
@endif


