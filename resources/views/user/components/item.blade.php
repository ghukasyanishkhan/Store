@extends('user.layouts.HFlayout')
@section('title', 'Item')
@php
    $imageArray = $item->photos->toArray();
@endphp
@section('content')

    <div class="item">
        <div class="item-img">
            <img id="item-image" src="{{ asset('storage/' . $item->photos->first()->path) }}" alt="Item Image">
            <button id="prev-btn"> < </button>
            <button id="next-btn"> > </button>
        </div>

        <div class="item-info">
            <div class="name">{{ $item->name }}</div>
            <div class="description">{{ $item->description }}</div>
            <div class="price">{{ $item->price.' $' }}</div>

            <div class="to-card" onclick="submitForm()">
               {{ __('messages.Add to card') }}
            </div>
            <form id="myForm" action="{{ route('card.add',$item) }}" method="post" style="display: none;">
                @csrf

            </form>

            <script>
                const imageData = {!! json_encode($imageArray) !!};

                function submitForm() {
                    document.getElementById("myForm").submit();
                }

                let currentImageIndex = 0;
                const itemImage = document.getElementById('item-image');
                const prevBtn = document.getElementById('prev-btn');
                const nextBtn = document.getElementById('next-btn');

                // Function to update the item image
                function updateImage() {
                    itemImage.src = "{{ asset('storage/') }}/" + imageData[currentImageIndex]['path'];
                }

                // Event listener for previous button
                prevBtn.addEventListener('click', () => {
                    currentImageIndex = (currentImageIndex === 0) ? imageData.length - 1 : currentImageIndex - 1;
                    updateImage();
                });

                // Event listener for next button
                nextBtn.addEventListener('click', () => {
                    currentImageIndex = (currentImageIndex === imageData.length - 1) ? 0 : currentImageIndex + 1;
                    updateImage();
                });
                // Initial image update
                updateImage();
                console.log(imageData[currentImageIndex]['path'])
            </script>


        </div>
    </div>
@endsection
