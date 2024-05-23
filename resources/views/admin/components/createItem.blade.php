@extends('layouts.Hlayout')
@section('title','Create item')
@section('content')
    @include('message')
    <div class="create-item">
        <form action="{{ route('item.store',$category) }}" method="post" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="file" name="photo">
            <label>
                {{ __('messages.Name') }}
                <input type="text" name="name">
            </label>
            <label>
                {{ __('messages.Price') }}
                <input type="number" name="price">
            </label>
            <label>
                {{ __('messages.Description') }}
                <textarea name="description" placeholder="{{ __('messages.about item') }}"></textarea>
            </label>
            <button type="submit">{{ __('messages.Create') }}</button>
        </form>
    </div>
@endsection

