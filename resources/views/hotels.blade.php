<div class="hotels-container">
    <h2>Best Hotel Deals</h2>
    <div class="city-grid grid grid-cols-3">
        @foreach ($cities as $city)
            <div class="city">
                <img src={{$city['image']}} alt={{$city['name']}} >
                <p class="city-name"> {{$city['name']}} </p>
                <p class="country-name"> {{$city['country']}} </p>
            </div>
        @endforeach
    </div>
</div>