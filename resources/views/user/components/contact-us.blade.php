@extends('user.layouts.HFlayout')
@section('content')
    <link rel="stylesheet" href="/user.css">
    <div class="contact-form-container">
        <form action="{{ route('contact.send') }}" method="post">
            @csrf
            <label>
                {{ __('messages.Your Email') }}
                <input type="email" name="email">
            </label>
            <label>
                {{ __('messages.Your Message') }}
                <textarea name="message"></textarea>
            </label>
            <button type="submit">{{ __('messages.Send') }}</button>
        </form>
        <a href="{{ route('home') }}">{{ __('messages.cancel') }}</a>
    </div>
@endsection


