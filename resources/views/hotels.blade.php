<Style>
.hotels-container {
    padding: 20px;
}

.city-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 20px;
}

.city-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    text-align: center;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    background: #fff;
}

.city-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.city-info {
    padding: 10px;
}

.city-name {
    font-weight: bold;
    margin-bottom: 5px;
}

.city-country {
    color: #555;
}

.selected-city {
    margin-top: 10px;
    font-size: 1.25rem;
    color: #2c3e50;
}
</style>
<div class="hotels-container">
    <h2 class="hotels-deal-title">Best Hotel Deals</h2>

    @if(!empty($cityFromUrl))
        <h3 class="selected-city">You selected: {{ $cityFromUrl }}</h3>
    @endif

    <div class="city-grid">
        @foreach ($cities as $city)
            <div class="city-card">
                <img src="{{ $city['image'] }}" alt="{{ $city['name'] }}">
                <div class="city-info">
                    <p class="city-name">{{ $city['name'] }}</p>
                    <p class="city-country">{{ $city['country'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
