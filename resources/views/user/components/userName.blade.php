
@php use Illuminate\Support\Facades\Auth; @endphp

    <span class="user-name">
        {{ Auth::user()->first_name }}
        <br>
        {{ Auth::user()->last_name }}
    </span>


