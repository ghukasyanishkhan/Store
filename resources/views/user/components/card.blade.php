@extends('user.layouts.HFlayout')
@section('title','Card')
@section('content')

    <div class="card">
        @if(isset($cardItems) )
            @foreach($cardItems as $item)
                @include('user.components.card-item')
            @endforeach
        @endif
        <div class="card-info">
<span>
   {{ __('messages.Total price') }}  <span class="p">{{ !empty($cardItems) ? array_sum(array_map(function ($element)
    { return $element['price']; }, $cardItems->toArray())) : 0 }} $</span>
</span>
            <form action="{{ route('order.card') }}" method="post">
                @csrf
                @if(isset($cardItems) )
                @foreach($cardItems as $item)
                    <input type="hidden" name="item_ids[]" value="{{ $item->id }}">
                @endforeach
                @endif
                <button type="submit">{{ __('messages.To Order') }}</button>
            </form>
        </div>
    </div>
@endsection
