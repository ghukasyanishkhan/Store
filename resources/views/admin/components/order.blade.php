<div class="order">
    <br>
    {{$order->item->name }}
    <br>
    {{$order->item->price.' $'}}
    <br>
    {{$order->item->id.' id'}}
    <form action="{{ route('order.remove',$order) }}" method="post">
        @csrf
        <button type="submit">{{ __('messages.cancel') }}</button>
    </form>
</div>
