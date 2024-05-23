

@extends('layouts.Hlayout')
@section('title','Dashboard')
@section('content')
    <div class="container">
        <nav>
            @include('admin.components.navbar')
        </nav>
        <main>
            @if(isset($users))
                @foreach($users as $user)
                    @include('admin.components.user')
                @endforeach
            @elseif(isset($categories))
                @foreach($categories as $category)
                    @include('admin.components.category')
                @endforeach
            @elseif(isset($items))
                @foreach($items as $item)
                    @include('admin.components.item')
                @endforeach
            @elseif(isset($orders))
                @foreach($orders as $order)
                    @include('admin.components.order')
                @endforeach
            @else
                {{ 'empty' }}
            @endif
        </main>
    </div>
@endsection
