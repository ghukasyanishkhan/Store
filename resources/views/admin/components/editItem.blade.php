@extends('layouts.Hlayout')
@section('title','Create item')
@section('content')
    <div class="edit-item-container">
        <div class="edit-item">
            @include('message')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('item.update',$item) }}" method="post">
                @csrf
                @method('PUT')
                <label>
                    {{ __('messages.Name') }}
                    <input type="text" name="name" value={{$item->name}}>
                </label>
                <label>
                    {{ __('messages.Price') }}
                    <input type="number" name="price" value={{$item->price}}>
                </label>
                <label>
                    {{ __('messages.Description') }}
                    <textarea name="description">{{$item->description}}</textarea>
                </label>
                <button type="submit">{{ __('messages.Update') }}</button>
            </form>

            <form action="{{ route('photo.store',$item) }}" method="post" enctype="multipart/form-data">
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
                <button type="submit">{{ __('messages.Add photo') }}</button>
            </form>
        </div>

        <div class="edit-photo">
            @foreach($item->photos as $photo)
                @include('admin.components.photo')
            @endforeach
        </div>
    </div>
@endsection




