<div class="hotels-container">
    <h2 class="hotels-deal-title">Best Hotel Deals</h2>
    <div class="city-grid">
        @foreach ($cities as $city)
            <div class="city">
                <img src={{$city['image']}} alt={{$city['name']}} >
                <p class="city-name "> {{$city['name']}} </p>
                <p class="city-country"> {{$city['country']}} </p>
            </div>
        @endforeach
    </div>
</div>