@extends('user.layouts.HFlayout')
@section('title','Orders')
@section('content')
    <div class="orders">
        @foreach($items as $itemOrder)
            @include('user.components.order-item', ['item' => $itemOrder['item'], 'order' => $itemOrder['order']])
        @endforeach

        <div class="order-info">
            <span>
            {{ __('messages.Total price') }}  <span class="p">{{ !empty($items) ? array_sum(array_map(function ($element)
             { return $element['item']['price']; }, $items)) : 0 }} $</span>
           </span>
        </div>
    </div>

@endsection
