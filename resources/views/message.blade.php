@if(session('success') || session('error'))
    <div class="message">
        @if(session('success'))
            <div class="message success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="message error">
                {{ session('error') }}
            </div>
        @endif
    </div>
@endif
