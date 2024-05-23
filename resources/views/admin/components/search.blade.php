<div class="search">
    <form action="{{ route('admin.items.search') }}" method="get">
        <input type="text" name="query" placeholder="{{__('messages.Search')  }}">
        <button type="submit">
            <img src="{{ asset('storage/png/search.png') }}" alt="s">
        </button>
    </form>
</div>
