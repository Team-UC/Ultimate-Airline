<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ultimate Airline</title>
    <link rel="stylesheet" href="css/homepage.css">
    <!--

Tooplate 2095 Level

https://www.tooplate.com/view/2095-level

-->
    <x-header />

    <div class="tm-section tm-bg-img" id="tm-section-1">
        <div class="tm-bg-white ie-container-width-fix-2">
            <div class="container ie-h-align-center-fix">
                <div class="row">
                    <div class="col-xs-12 ml-auto mr-auto ie-container-width-fix">
                        <!-- <form action="index.html" method="get" class="tm-search-form tm-section-pad-2"> -->
                        <form id="flightForm" action="#" method="get" class="tm-search-form tm-section-pad-2">
                            <div class="form-row tm-search-form-row">
                                <div class="form-group tm-form-element tm-form-element-100">
                                    <i class="fa fa-map-marker fa-2x tm-form-element-icon"></i>
                                    <input value="" required name="origin" type="text" class="form-control"
                                        id="inputCity1" placeholder="Enter Origin...">
                                    <div id="cityResults" class="dropdown-menu show w-100" style="display: none;"></div>
                                    <!-- <input type="hidden" name="inputCity1_code" id="inputCity1_code" value="KTM"> -->
                                </div>

                                <div class="form-group tm-form-element tm-form-element-100">
                                    <i class="fa fa-map-marker fa-2x tm-form-element-icon"></i>
                                    <input value="" required name="destination" type="text"
                                        class="form-control" id="inputCity2" placeholder="Enter Destination...">
                                    <div id="cityResults" class="dropdown-menu show w-100" style="display: none;"></div>
                                    <!-- <input type="hidden" name="inputCity2_code" id="inputCity2_code" value="KTM"> -->
                                </div>

                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

                                <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
                                
                               <script>
                                setupCityAutocomplete('inputCity1');
                                setupCityAutocomplete('inputCity2');

                                function setupCityAutocomplete(inputId) {
                                    const defaultCities = [
                                        { city: "Kolkata", country: "India", airport: "Netaji Subhas Chandra Bose Intl", value: "CCU" },
                                        { city: "Delhi", country: "India", airport: "Indira Gandhi Intl", value: "DEL" },
                                        { city: "Kathmandu", country: "Nepal", airport: "Tribhuvan Intl", value: "KTM" },
                                        { city: "Pokhara", country: "Nepal", airport: "Pokhara Intl", value: "PKR" },
                                        { city: "Bagdogra", country: "India", airport: "Bagdogra Airport", value: "IXB" }
                                    ];

                                    const $input = $('#' + inputId);
                                    const $results = $('<div class="dropdown-menu show w-100 city-results" style="display: none; position: absolute; z-index: 1050;"></div>')
                                        .insertAfter($input)
                                        .attr('id', inputId + '_results');

                                    let currentRequest = null;

                                    $input.on('input', function () {
                                        const query = $input.val().trim().toLowerCase();

                                        // If input is short, show default cities
                                        if (query.length < 2) {
                                            const filteredDefaults = defaultCities.filter(item =>
                                                item.city.toLowerCase().includes(query) ||
                                                item.country.toLowerCase().includes(query) ||
                                                item.airport.toLowerCase().includes(query) ||
                                                item.value.toLowerCase().includes(query)
                                            );

                                            renderResults(filteredDefaults);
                                            return;
                                        }

                                        // Abort previous AJAX if needed
                                        if (currentRequest) {
                                            currentRequest.abort();
                                        }

                                        currentRequest = $.ajax({
                                            url: "{{ config('services.restapi_url') }}/autocomplete/cities",
                                            data: { q: query },
                                            success: function (data) {
                                                if (data.length === 0) {
                                                    $results.hide();
                                                    return;
                                                }
                                                renderResults(data);
                                            },
                                            error: function (xhr, status) {
                                                if (status !== 'abort') {
                                                    console.error('City autocomplete failed:', status);
                                                }
                                            }
                                        });
                                    });

                                    function renderResults(data) {
                                        let html = '';
                                        data.forEach(item => {
                                            html += `
                                                <div class="city-result-item clearfix p-2" data-label="${item.city}, ${item.country} – ${item.airport} (${item.value})">
                                                    <div class="city-name">${item.city}, ${item.country}<span class="iata-code float-end">${item.value}</span></div>
                                                    <div class="airport-name text-muted">${item.airport}</div>
                                                </div>`;
                                        });
                                        $results.html(html).show();
                                    }

                                    // On select
                                    $(document).on('click', '#' + inputId + '_results .city-result-item', function () {
                                        const selectedLabel = $(this).data('label');
                                        $input.val(selectedLabel);
                                        $results.hide();
                                    });

                                    $input.on('blur', function () {
                                        setTimeout(() => $results.hide(), 200);
                                    });
                                }
                            </script>




                                <div class="form-group tm-form-element tm-form-element-50">
                                    <i class="fa fa-calendar fa-2x tm-form-element-icon"></i>
                                    <input required name="departure-date" type="date" class="form-control"
                                        id="inputCheckOut" placeholder="Departure Date">
                                </div>
                                <script>
                                    const today = new Date().toISOString().split('T')[0];
                                    document.getElementById("inputCheckOut").setAttribute("min", today);
                                </script>
                            </div>
                            <div class="form-row tm-search-form-row">
                                <div class="form-group tm-form-element tm-form-element-2">
                                    <select required name="adult" class="form-control tm-select" id="adult">
                                        <option value="">Adult</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                    <i class="fa fa-2x fa-user tm-form-element-icon"></i>
                                </div>
                                <div class="form-group tm-form-element tm-form-element-2">
                                    <select required name="children" class="form-control tm-select" id="children">
                                        <option value="">Children</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                    <i class="fa fa-user tm-form-element-icon tm-form-element-icon-small"></i>
                                </div>
                                <!-- <div class="form-group tm-form-element tm-form-element-2">
                                            <select name="room" class="form-control tm-select" id="room">
                                                <option value="">Room</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                            <i class="fa fa-2x fa-bed tm-form-element-icon"></i>
                                        </div> -->
                                <div class="form-group tm-form-element tm-form-element-2">
                                    <!-- <a href="{{ route('flight.search', ['from' => 1, 'to' => 1, 'date' => 2, 'id' =>3]) }}">
                                        Book Now
                                    </a> -->
                                   
                                    <!-- <button type="submit" class="btn btn-primary tm-btn-search">Check
                                        Availability</button> -->
                                </div>
                            </div>
                            <div class="form-row clearfix pl-2 pr-2 tm-fx-col-xs">
                                <!-- <p class="tm-margin-b-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
                                <a href="#"
                                    class="ie-10-ml-auto ml-auto mt-1 tm-font-semibold tm-color-primary">Need Help?</a>
                            </div>
                            <div id="responseMessage" class="mt-3"></div>
                             <button  type="submit" class="btn btn-primary tm-btn-search">Book
                                        Now</button>
                            <!-- <button type="button" onclick="redirectToSearch()" class="btn btn-primary tm-btn-search">Book Now</button> -->

                                        <script>
                                            function redirectToSearch() {
                                                const from = document.getElementById('inputCity1').value.trim();
                                                const to = document.getElementById('inputCity2').value.trim();
                                                const date = document.getElementById('inputCheckOut').value;
                                                const uuid = self.crypto.randomUUID(); // Or use from backend if needed

                                                if (!from || !to || !date) {
                                                    alert("Please fill all fields");
                                                    return;
                                                }

                                                // Format date like Jul-8-2025
                                                const options = { month: 'short', day: 'numeric', year: 'numeric' };
                                                const formattedDate = new Date(date).toLocaleDateString('en-US', options).replace(/ /g, '-');

                                                // Build URL
                                                const url = `/search/flight-tickets-from-${from}-to-${to}-${formattedDate}/${uuid}`;
                                                window.location.href = url;
                                            }
                                        </script>

                        </form>



                    </div>
                </div>
            </div>
        </div>


        <!-- <p>Please wait while we fetch your results...</p> -->
      </div>
    </div>
  </div>
</div>


   
   

    <div class="tm-section-2">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="tm-section-title">We are here to help you?</h2>
                    <p class="tm-color-white tm-section-subtitle">Subscribe to get our newsletters</p>
                    <a href="#" class="tm-color-white tm-btn-white-bordered">Subscribe Newletters</a>
                </div>
            </div>
        </div>
    </div>
     
    <div class="tm-section tm-position-relative">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"
            class="tm-section-down-arrow">
            <polygon fill="#ee5057" points="0,0  0,0  50,60"></polygon>
        </svg>
     <div class="container my-5">
        <!-- Carousel Code by ABdul Samad 20/07/2025-->
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
   <style>
        /* Custom styles to complement Bootstrap */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
        }

        .slider-container {
            padding: 0 rem 0;
            background-color: #f0f2f5;
        }

        .destination-slider-wrapper {
            position: relative;
        }
        
        .destination-slider {
            display: flex;
            gap: 1.5rem;
            padding: 0.25rem;
            overflow-x: scroll;
            
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        
        .destination-slider::-webkit-scrollbar {
            display: none;
        }

        .destination-card {
            flex: 0 0 270px;
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.4s ease;
            border-radius: 1.5rem;
        }

        .destination-card:hover {
            transform: scale(1.05) translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            z-index: 10;
        }
        
        .card-img-overlay::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0) 50%);
            border-radius: 0.5rem;
        }
        
        .card-img-overlay .content-container {
            position: relative;
            z-index: 1;
        }

        .duration-badge {
            background-color: #FFD700;
            color: #333;
            font-weight: bold;
            padding: 0.25rem 0.5rem;
            border-radius: 0.5rem;
            font-size: 0.8rem;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 20;
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            font-size: 1.5rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .slider-btn:hover {
            background-color: white;
            transform: translateY(-50%) scale(1.1);
        }

        #prev-btn { left: -20px; }
        #next-btn { right: -20px; }
        
        @media (max-width: 768px) {
            .destination-card { flex-basis: 240px; }
            #prev-btn { left: -10px; }
            #next-btn { right: -10px; }
        }
    </style>
</head>
    <div class="slider-container">
        <div class="container destination-slider-wrapper">
            <button id="prev-btn" class="slider-btn">&lt;</button>
            <div class="destination-slider" id="destinationSlider">
                <!-- Cards will be dynamically populated by JS -->
            </div>
            <button id="next-btn" class="slider-btn">&gt;</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('destinationSlider');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');

            let scrollAmount = 0;
            let isScrolling = false;
            let totalCardWidth = 0;

            const destinations = [
                { name: 'Vietnam', duration: '4N 5D', price: 'NPR 38,920', img: '{{ asset("img/cities/veitnam.jpeg") }}', flag: 'https://flagcdn.com/w20/vn.png' },
                { name: 'Bangkok', duration: '3N 4D', price: 'NPR 18,048', img: '{{ asset("img/cities/bangkok.jpeg") }}', flag: 'https://flagcdn.com/w20/th.png' },
                { name: 'Dubai', duration: '4N 5D', price: 'NPR 34,520', img: '{{ asset("img/cities/dubai.jpg") }}', flag: 'https://flagcdn.com/w20/ae.png' },
                { name: 'Kuala Lumpur', duration: '5N 6D', price: 'NPR 24,233', img: '{{ asset("img/cities/cairo.jpg") }}', flag: 'https://flagcdn.com/w20/my.png' },
                { name: 'Delhi', duration: '2N 3D', price: 'NPR 11,103', img: '{{ asset("img/cities/delhi.jpeg") }}', flag: 'https://flagcdn.com/w20/in.png' },
                { name: 'Paris', duration: '6N 7D', price: 'NPR 85,500', img: '{{ asset("img/cities/paris.jpg") }}', flag: 'https://flagcdn.com/w20/fr.png' },
            ];

            function createCard(dest) {
                return `
                
                 <div class="card text-white destination-card" data-destination="${dest.name}" data-duration="${dest.duration}">
                  <a href="hotels?city=${dest.name}" class="destination-card-link" target="_blank">
                    <img src="${dest.img}" class="card-img h-100" alt="${dest.name}" style="object-fit: cover;">
                    <div class="card-img-overlay d-flex flex-column justify-content-end">
                        <div class="content-container">
                            <span class="duration-badge">${dest.duration}</span>
                            <h5 class="card-title fs-4 d-flex align-items-center gap-2">
                                <img src="${dest.flag}" alt="${dest.name} Flag"> ${dest.name}
                            </h5>
                            <p class="card-text fw-bold">${dest.price}</p>
                        </div>
                    </div>
                </div>
                </a>
                `;
            }

            function setupLoop() {
                slider.innerHTML = '';
                const allCardsHtml = destinations.map(createCard).join('');
                slider.innerHTML = allCardsHtml + allCardsHtml; // Original + Clones
                
                const cardGap = parseFloat(window.getComputedStyle(slider).gap) || 20;
                totalCardWidth = (slider.querySelector('.destination-card').offsetWidth + cardGap) * destinations.length;
            }

            function calculateScrollAmount() {
                const firstCard = slider.querySelector('.destination-card');
                if (firstCard) {
                    const cardGap = parseFloat(window.getComputedStyle(slider).gap) || 20;
                    scrollAmount = firstCard.offsetWidth + cardGap;
                }
            }

            function easeInOutQuad(t, b, c, d) {
                t /= d / 2;
                if (t < 1) return c / 2 * t * t + b;
                t--;
                return -c / 2 * (t * (t - 2) - 1) + b;
            }

            function smoothScrollTo(element, to, duration) {
                if (isScrolling) return;
                isScrolling = true;
                const start = element.scrollLeft;
                const change = to - start;
                let startTime = null;

                function animateScroll(currentTime) {
                    if (startTime === null) startTime = currentTime;
                    const timeElapsed = currentTime - startTime;
                    let run = easeInOutQuad(timeElapsed, start, change, duration);
                    element.scrollLeft = run;
                    if (timeElapsed < duration) {
                        requestAnimationFrame(animateScroll);
                    } else {
                        element.scrollLeft = to;
                        isScrolling = false;
                        if (element.scrollLeft >= totalCardWidth) {
                             element.scrollLeft -= totalCardWidth;
                        }
                    }
                }
                requestAnimationFrame(animateScroll);
            }

            nextBtn.addEventListener('click', function() {
                if (slider.scrollLeft >= totalCardWidth) {
                    slider.scrollLeft -= totalCardWidth;
                }
                const targetScroll = slider.scrollLeft + scrollAmount;
                smoothScrollTo(slider, targetScroll, 500);
            });

            prevBtn.addEventListener('click', function() {
                if (slider.scrollLeft <= 0) {
                    slider.scrollLeft += totalCardWidth;
                }
                const targetScroll = slider.scrollLeft - scrollAmount;
                smoothScrollTo(slider, targetScroll, 500);
            });
            
            // Initial Setup
            setupLoop();
            calculateScrollAmount();
            window.addEventListener('resize', () => {
                setupLoop();
                calculateScrollAmount();
            });
        });
    </script>
    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <div class="container tm-pt-5 tm-pb-4"> 
            <div class="row text-center">
                <article class="col-sm-12 col-md-4 col-lg-4 col-xl-4 tm-article">
                    <i class="fa tm-fa-6x fa-legal tm-color-primary tm-margin-b-20"></i>
                    <h3 class="tm-color-primary tm-article-title-1">Level HTML Template by Tooplate website</h3>
                    <p>You are allowed to download, edit and use this template for your business or client websites.</p>
                    <a href="#" class="text-uppercase tm-color-primary tm-font-semibold">Continue reading...</a>
                </article>
                <article class="col-sm-12 col-md-4 col-lg-4 col-xl-4 tm-article">
                    <i class="fa tm-fa-6x fa-plane tm-color-primary tm-margin-b-20"></i>
                    <h3 class="tm-color-primary tm-article-title-1">Original Website Template Producer</h3>
                    <p>You are NOT allowed to re-distribute the downloadable template ZIP file on any website.</p>
                    <a href="#" class="text-uppercase tm-color-primary tm-font-semibold">Continue reading...</a>
                </article>
                <article class="col-sm-12 col-md-4 col-lg-4 col-xl-4 tm-article">
                    <i class="fa tm-fa-6x fa-life-saver tm-color-primary tm-margin-b-20"></i>
                    <h3 class="tm-color-primary tm-article-title-1">Contact us if you have any question</h3>
                    <p>If you see this template being distributed on any other site, that is an illegal copy.</p>
                    <a href="#" class="text-uppercase tm-color-primary tm-font-semibold">Continue reading...</a>
                </article>
            </div>
        </div>
    </div>

    <div class="tm-section tm-section-pad tm-bg-gray" id="tm-section-4">
        <div class="container">
            <div class="row">
                <div id="responseMessage"></div>
                <div id="flightResults"></div>

                <!-- <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                            <div class="tm-article-carousel">
                                <article class="tm-bg-white mr-2 tm-carousel-item">
                                    <img src="img/img-01.jpg" alt="Image" class="img-fluid">
                                    <div class="tm-article-pad">
                                        <header><h3 class="text-uppercase tm-article-title-2">Nunc in felis aliquet metus luctus iaculis</h3></header>
                                        <p>Aliquam ac lacus volutpat, dictum risus at, scelerisque nulla. Nullam sollicitudin at augue venenatis eleifend. Nulla ligula ligula, egestas sit amet viverra id, iaculis sit amet ligula.</p>
                                        <a href="#" class="text-uppercase btn-primary tm-btn-primary">Get More Info.</a>
                                    </div>
                                </article>
                                <article class="tm-bg-white mr-2 tm-carousel-item">
                                    <img src="img/img-02.jpg" alt="Image" class="img-fluid">
                                    <div class="tm-article-pad">
                                        <header><h3 class="text-uppercase tm-article-title-2">Sed cursus dictum nunc quis molestie</h3></header>
                                        <p>Pellentesque quis dui sit amet purus scelerisque eleifend sed ut eros. Morbi viverra blandit massa in varius. Sed nec ex eu ex tincidunt iaculis. Curabitur eget turpis gravida.</p>
                                        <a href="#" class="text-uppercase btn-primary tm-btn-primary">View Detail</a>
                                    </div>
                                </article>
                                <article class="tm-bg-white mr-2 tm-carousel-item">
                                    <img src="img/img-01.jpg" alt="Image" class="img-fluid">
                                    <div class="tm-article-pad">
                                        <header><h3 class="text-uppercase tm-article-title-2">Eget diam pellentesque interdum ut porta</h3></header>
                                        <p>Aenean finibus tempor nulla, et maximus nibh dapibus ac. Duis consequat sed sapien venenatis consequat. Aliquam ac lacus volutpat, dictum risus at, scelerisque nulla.</p>
                                        <a href="#" class="text-uppercase btn-primary tm-btn-primary">More Info.</a>
                                    </div>
                                </article>
                                <article class="tm-bg-white mr-2 tm-carousel-item">
                                    <img src="img/img-02.jpg" alt="Image" class="img-fluid">
                                    <div class="tm-article-pad">
                                        <header><h3 class="text-uppercase tm-article-title-2">Lorem ipsum dolor sit amet, consectetur</h3></header>
                                        <p>Suspendisse molestie sed dui eget faucibus. Duis accumsan sagittis tortor in ultrices. Praesent tortor ante, fringilla ac nibh porttitor, fermentum commodo nulla.</p>
                                        <a href="#" class="text-uppercase btn-primary tm-btn-primary">Detail Info.</a>
                                    </div>
                                </article>
                                <article class="tm-bg-white mr-2 tm-carousel-item">
                                    <img src="img/img-01.jpg" alt="Image" class="img-fluid">
                                    <div class="tm-article-pad">
                                        <header><h3 class="text-uppercase tm-article-title-2">Orci varius natoque penatibus et</h3></header>
                                        <p>Pellentesque quis dui sit amet purus scelerisque eleifend sed ut eros. Morbi viverra blandit massa in varius. Sed nec ex eu ex tincidunt iaculis. Curabitur eget turpis gravida.</p>
                                        <a href="#" class="text-uppercase btn-primary tm-btn-primary">Read More</a>
                                    </div>
                                </article>
                                <article class="tm-bg-white tm-carousel-item">
                                    <img src="img/img-02.jpg" alt="Image" class="img-fluid">
                                    <div class="tm-article-pad">
                                        <header><h3 class="text-uppercase tm-article-title-2">Nullam sollicitudin at augue venenatis eleifend</h3></header>
                                        <p>Aenean finibus tempor nulla, et maximus nibh dapibus ac. Duis consequat sed sapien venenatis consequat. Aliquam ac lacus volutpat, dictum risus at, scelerisque nulla.</p>
                                        <a href="#" class="text-uppercase btn-primary tm-btn-primary">More Details</a>
                                    </div>
                                </article>
                            </div>
                        </div>
                        
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-recommended-container">
                            <div class="tm-bg-white">
                                <div class="tm-bg-primary tm-sidebar-pad">
                                    <h3 class="tm-color-white tm-sidebar-title">Recommended Places</h3>
                                    <p class="tm-color-white tm-margin-b-0 tm-font-light">Enamel pin cliche tilde, kitsch and VHS thundercats</p>
                                </div>
                                <div class="tm-sidebar-pad-2">
                                    <a href="#" class="media tm-media tm-recommended-item">
                                        <img src="img/tn-img-01.jpg" alt="Image">
                                        <div class="media-body tm-media-body tm-bg-gray">
                                            <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">Europe</h4>
                                        </div>
                                    </a>
                                    <a href="#" class="media tm-media tm-recommended-item">
                                        <img src="img/tn-img-02.jpg" alt="Image">
                                        <div class="media-body tm-media-body tm-bg-gray">
                                            <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">Asia</h4>
                                        </div>
                                    </a>
                                    <a href="#" class="media tm-media tm-recommended-item">
                                        <img src="img/tn-img-03.jpg" alt="Image">
                                        <div class="media-body tm-media-body tm-bg-gray">
                                            <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">Africa</h4>
                                        </div>
                                    </a>
                                    <a href="#" class="media tm-media tm-recommended-item">
                                        <img src="img/tn-img-04.jpg" alt="Image">
                                        <div class="media-body tm-media-body tm-bg-gray">
                                            <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">South America</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>-->
            </div>
        </div>
    </div>     </div>
    </div>
    {{-- toggling chat Menu --}}
<div class="chat-container">
    <div class="chat-button" onclick="toggleChatMenu()">Chat Here !</div>
    <div class="chat-icons" id="chatIcons">
        {{-- will be replaced to relavant links once reviewed --}}
        <a href="https://wa.me/+919330795119" class="icon whatsapp" title="WhatsApp"></a> 
        <a href="#" class="icon x" title="X.com"></a>
        <a href="#" class="icon facebook" title="Facebook"></a>
        <a href="#" class="icon instagram" title="Instagram"></a>

    </div>
    <!-- Bootstrap Loading Modal -->
    <div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-body">
                    <div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 5rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h5 class="modal-title mb-2">Searching for best airfares</h5>
                    <img src="img/loadingAnimation.gif" alt="Loading Animation" class="img-fluid mb-3"
                        style="max-width: 100px;">
                    <div class="mb-2 small" id="searchDetails">
                        <!-- Dynamic search info goes here -->
                    </div>
                    <p>Please wait while we fetch your results...</p>
                </div>
            </div>
        </div>
    </div>
</div>
 
    <!-- Hotels -->
    @include('hotels', ['cities' => $data])

    <div class="tm-bg-video">
        <div class="overlay">
            <i class="fa fa-5x fa-play-circle tm-btn-play"></i>
            <i class="fa fa-5x fa-pause-circle tm-btn-pause"></i>
        </div>
        <video controls="" loop="" class="tmVideo">
            <source src="videos/video.mp4" type="video/mp4">
            <source src="videos/video.ogg" type="video/ogg">
            Your browser does not support the video tag.
        </video>
        <div class="tm-section tm-section-pad tm-bg-img" id="tm-section-5">
            <div class="container ie-h-align-center-fix">
                <div class="row tm-flex-align-center">
                    <div class="col-xs-12 col-md-12 col-lg-3 col-xl-3 tm-media-title-container">
                        <h2 class="text-uppercase tm-section-title-2">ASIA</h2>
                        <h3 class="tm-color-primary tm-font-semibold tm-section-subtitle-2">Singapore</h3>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-9 col-xl-9 mt-0 mt-sm-3">
                        <div class="ml-auto tm-bg-white-shadow tm-pad tm-media-container">
                            <article class="media tm-margin-b-20 tm-media-1">
                                <img src="img/img-03.jpg" alt="Image">
                                <div class="media-body tm-media-body-1 tm-media-body-v-center">
                                    <h3 class="tm-font-semibold tm-color-primary tm-article-title-3">Suspendisse vel
                                        est libero sem phasellus ac laoreet</h3>
                                    <p>Vivamus eget tellus ornare, sollicitudin quam id, dictum nulla. Phasellus finibus
                                        rhoncus justo, tempus eleifend neque dictum ac. Aenean metus leo, consectetur
                                        non.
                                        <br><br>
                                        Etiam aliquam arcu at mauris consectetur scelerisque. Integer elementum justo in
                                        orci facilisis ultricies. Pellentesque at velit ante. Duis scelerisque metus vel
                                        felis porttitor gravida.
                                    </p>
                                </div>
                            </article>
                            <article class="media tm-margin-b-20 tm-media-1">
                                <img src="img/img-04.jpg" alt="Image">
                                <div class="media-body tm-media-body-1 tm-media-body-v-center">
                                    <h3 class="tm-font-semibold tm-article-title-3">Suspendisse vel est libero sem
                                        phasellus ac laoreet</h3>
                                    <p>Duis accumsan sagittis tortor in ultrices. Praesent tortor ante, fringilla ac
                                        nibh porttitor, fermentum commodo nulla.</p>
                                    <a href="#"
                                        class="text-uppercase tm-color-primary tm-font-semibold">Continue
                                        reading...</a>
                                </div>
                            </article>
                            <article class="media tm-margin-b-20 tm-media-1">
                                <img src="img/img-05.jpg" alt="Image">
                                <div class="media-body tm-media-body-1 tm-media-body-v-center">
                                    <h3 class="tm-font-semibold tm-article-title-3">Faucibus dolor ligula nisl metus
                                        auctor aliquet</h3>
                                    <p>Nunc in felis aliquet metus luctus iaculis vel et nisi. Nulla venenatis nisl
                                        orci, laoreet ultricies massa tristique id.</p>
                                    <a href="#"
                                        class="text-uppercase tm-color-primary tm-font-semibold">Continue
                                        reading...</a>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                            
    <div class="tm-section tm-section-pad tm-bg-img tm-position-relative" id="tm-section-6">
        <div class="container ie-h-align-center-fix">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-7">
                    <div id="google-map"></div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-5 mt-3 mt-md-0">
                    <div class="tm-bg-white tm-p-4">
                        <form action="index.html" method="post" class="contact-form">
                            <div class="form-group">
                                <input type="text" id="contact_name" name="contact_name" class="form-control"
                                    placeholder="Name" required />
                            </div>
                            <div class="form-group">
                                <input type="email" id="contact_email" name="contact_email" class="form-control"
                                    placeholder="Email" required />
                            </div>
                            <div class="form-group">
                                <input type="text" id="contact_subject" name="contact_subject"
                                    class="form-control" placeholder="Subject" required />
                            </div>
                            <div class="form-group">
                                <textarea id="contact_message" name="contact_message" class="form-control" rows="9" placeholder="Message"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary tm-btn-primary">Send Message Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    </div>
    <script>
        $(document).ready(function() {
            const loadingModalEl = document.getElementById('loadingModal');
            const loadingModal = new bootstrap.Modal(loadingModalEl, {
                backdrop: 'static',
                keyboard: false
            });
            $('#flightForm').on('submit', function(e) {
                e.preventDefault();

                const origin = $('#inputCity1').val();
                const destination = $('#inputCity2').val();
                const date = $('#inputCheckOut').val();
                const adult = $('#adult').val();
                const children = $('#children').val();

                // Update modal content
                $('#searchDetails').html(`
                    <div class="text-black">
                        <strong>From:</strong> ${origin} <br>
                        <strong>To:</strong> ${destination} <br>
                        <strong>Adults:</strong> ${adult}, <strong>Children:</strong> ${children} <br>
                        <strong>Departure:</strong> ${date}
                    </div>
                `);

                loadingModal.show(); // Show loading modal

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ config('services.restapi_url') }}/flight-check",
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#responseMessage').html(
                            '<div class="alert alert-success">Flights found!</div>');
                        console.log(response);
                        const flights = response.data || [];
                        let html = '';

                        if (flights.length === 0) {
                            html =
                                '<div class="alert alert-warning">No flights available.</div>';
                        } else {
                            flights.forEach((flight, i) => {
                                const segments = flight.itineraries[0].segments;
                                const dep = segments[0].departure;
                                const arr = segments[segments.length - 1].arrival;
                                const eurToNpr = 145; // example fixed conversion rate
                                const priceNpr = (parseFloat(flight.price.total) *
                                    eurToNpr).toFixed(2);
                                const message = `
                                    ✈️ *Flight Offer*
                                    Airline: ${flight.validatingAirlineCodes[0]}
                                    Departure: ${new Date(dep.at).toLocaleString()}
                                    Arrival: ${new Date(arr.at).toLocaleString()}
                                    Duration: ${flight.itineraries[0].duration.replace('PT','')}
                                    Price: ${flight.price.currency} ${flight.price.total} (Approx. NPR ${priceNpr})

                                    Please Book this Flight for Me
                                `;

                                html += `
                                    <div class="card mb-3 shadow-sm border-start border-danger border-3 p-3 w-100">
                                        <div class="row align-items-center text-center text-md-start">

                                            <!-- Airline logo and name -->
                                            <div class="col-md-2 mb-2 mb-md-0 d-flex flex-column align-items-center">
                                                <img src="https://s1.apideeplink.com/images/airlines/${flight.validatingAirlineCodes[0]}.png" alt="Airline Logo" style="max-height: 40px;">
                                                <div class="fw-semibold mt-2">${flight.validatingAirlineCodes[0]}</div>
                                            </div>

                                            <!-- Flight info -->
                                            <div class="col-md-6">
                                                <div class="d-flex flex-column flex-md-row justify-content-around align-items-center gap-3">
                                                    <div>
                                                        <div class="fw-bold fs-5">${new Date(dep.at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                                                        <div>${dep.city || 'Departure'} (${dep.iataCode})</div>
                                                        <div class="text-muted small">${new Date(dep.at).toLocaleDateString()}</div>
                                                    </div>
                                                    <div class="text-center">
                                                        <div class="fw-medium">${flight.itineraries[0].duration.replace('PT','').replace('H',' Hr ').replace('M',' Min')}</div>
                                                        <div class="text-danger mt-1">
                                                            <i class="bi bi-person-walking"></i> 5 Kg &nbsp;
                                                            <i class="bi bi-suitcase"></i> 15 Kg
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold fs-5">${new Date(arr.at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                                                        <div>${arr.city || 'Arrival'} (${arr.iataCode})</div>
                                                        <div class="text-muted small">${new Date(arr.at).toLocaleDateString()}</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Price and CTA -->
                                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                                <div class="text-danger fw-bold fs-5">NPR ${priceNpr}</div>
                                                <a href="#" class="btn btn-primary btn-sm mt-1">Book Now</a>
                                                <a href="https://wa.me/+9779808041246?text=${encodeURIComponent(message)}" class="btn btn-success btn-sm mt-1" target="_blank">Book on WhatsApp</a>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            });
                        }

                        $('#flightResults').html(html); // Display inside this container

                        loadingModal.hide(); // Hide loading modal after processing
                    },
                    // },
                    error: function(xhr) {
                        $('#responseMessage').html(
                            '<div class="alert alert-danger">Something went wrong.</div>');

                        loadingModal.hide(); // Hide loading modal on error
                    }
                });
            });
        });

        //function for toggling chat menu
        function toggleChatMenu() {
            document.getElementById('chatIcons').classList.toggle('show');

        }
        const a = document.querySelector('.chat-button');

        a.addEventListener('mouseover', () => {
            a.textContent = 'Click';
        });
        a.addEventListener('mouseout', () => {
            a.textContent = 'Chat';
        });
    </script>
    <!-- load JS files -->
    <script src="js/jquery-1.11.3.min.js"></script> <!-- jQuery (https://jquery.com/download/) -->
    <script src="js/popper.min.js"></script> <!-- https://popper.js.org/ -->
    <script src="js/bootstrap.min.js"></script> <!-- https://getbootstrap.com/ -->
    <script src="js/datepicker.min.js"></script> <!-- https://github.com/qodesmith/datepicker -->
    <script src="js/jquery.singlePageNav.min.js"></script> <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
    <script src="slick/slick.min.js"></script> <!-- http://kenwheeler.github.io/slick/ -->
    <script>
        /* Google map
                ------------------------------------------------*/
        var map = '';
        var center;

        function initialize() {
            var mapOptions = {
                zoom: 13,
                center: new google.maps.LatLng(-23.013104, -43.394365),
                scrollwheel: false
            };

            map = new google.maps.Map(document.getElementById('google-map'), mapOptions);

            google.maps.event.addDomListener(map, 'idle', function() {
                calculateCenter();
            });

            google.maps.event.addDomListener(window, 'resize', function() {
                map.setCenter(center);
            });
        }

        function calculateCenter() {
            center = map.getCenter();
        }

        function loadGoogleMap() {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src =
                'https://maps.googleapis.com/maps/api/js?key=AIzaSyDVWt4rJfibfsEDvcuaChUaZRS5NXey1Cs&v=3.exp&sensor=false&' +
                'callback=initialize';
            document.body.appendChild(script);
        }

        function setCarousel() {

            if ($('.tm-article-carousel').hasClass('slick-initialized')) {
                $('.tm-article-carousel').slick('destroy');
            }

            if ($(window).width() < 438) {
                // Slick carousel
                $('.tm-article-carousel').slick({
                    infinite: false,
                    dots: true,
                    slidesToShow: 1,
                    slidesToScroll: 1
                });
            } else {
                $('.tm-article-carousel').slick({
                    infinite: false,
                    dots: true,
                    slidesToShow: 2,
                    slidesToScroll: 1
                });
            }
        }

        function setPageNav() {
            if ($(window).width() > 991) {
                $('#tm-top-bar').singlePageNav({
                    currentClass: 'active',
                    offset: 79
                });
            } else {
                $('#tm-top-bar').singlePageNav({
                    currentClass: 'active',
                    offset: 65
                });
            }
        }

        function togglePlayPause() {
            vid = $('.tmVideo').get(0);

            if (vid.paused) {
                vid.play();
                $('.tm-btn-play').hide();
                $('.tm-btn-pause').show();
            } else {
                vid.pause();
                $('.tm-btn-play').show();
                $('.tm-btn-pause').hide();
            }
        }

        $(document).ready(function() {

            $(window).on("scroll", function() {
                if ($(window).scrollTop() > 100) {
                    $(".tm-top-bar").addClass("active");
                } else {
                    //remove the background property so it comes transparent again (defined in your css)
                    $(".tm-top-bar").removeClass("active");
                }
            });

            // Google Map
            loadGoogleMap();

            // Date Picker
            const pickerCheckIn = datepicker('#inputCheckIn');
            const pickerCheckOut = datepicker('#inputCheckOut');

            // Slick carousel
            setCarousel();
            setPageNav();

            $(window).resize(function() {
                setCarousel();
                setPageNav();
            });

            // Close navbar after clicked
            $('.nav-link').click(function() {
                $('#mainNav').removeClass('show');
            });

            // Control video
            $('.tm-btn-play').click(function() {
                togglePlayPause();
            });

            $('.tm-btn-pause').click(function() {
                togglePlayPause();
            });

            // Update the current year in copyright
            $('.tm-current-year').text(new Date().getFullYear());
        });
    </script>
    </body>
</html>