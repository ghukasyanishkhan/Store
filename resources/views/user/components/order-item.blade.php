<div class="order-item">
    <br>
    {{ $item->name }}
    <br>
    {{$item->price.' $'}}
    <br>
    {{$item->id.' id'}}
    <form action="{{ route('order.remove',$order) }}" method="post">
        @csrf
        <button type="submit">{{ __('messages.cancel') }}</button>
    </form>
</div>
