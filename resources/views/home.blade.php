<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sasta Tickets</title>
<style>
    .site-name {
        font-size: 1.5em;
        font-weight: bold;
        color: #333;
        margin-left: 10px;
    }
    #cityResults {
        max-height: 300px;
        overflow-y: auto;
        z-index: 1050;
    }

    .city-result-item {
        padding: 10px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
    }

    .city-result-item:hover {
        background-color: #f8f9fa;
    }

    .city-name {
        font-weight: bold;
    }

    .iata-code {
        float: right;
        font-weight: bold;
        color: #333;
    }

    .airport-name {
        font-size: 0.9em;
        color: #777;
        margin-top: 2px;
    }

    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }

    #loadingModal {
        z-index: 1200 !important; /* Ensure it appears above other content */
    }

    .tm-bg-video {
    position: relative;
    overflow: hidden;
    width: 100%;
    height: auto;
}

.tm-bg-video video.tmVideo {
    width: 100%;
    height: auto;
    object-fit: cover;
    display: block;
}

.tm-bg-video .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 2;
    pointer-events: none;
}

.tm-bg-video .overlay i {
    margin: 0 10px;
    color: white;
    opacity: 0.8;
    transition: opacity 0.3s;
    pointer-events: auto;
    cursor: pointer;
}

.tm-bg-video .overlay i:hover {
    opacity: 1;
}
/*floating chat button styling*/
.chat-container {
    position: fixed;
    bottom: 30px;
    right: 38px;
    z-index: 9999;
}

.chat-button {
    position: relative;
    left: 5px;
    background:linear-gradient(45deg,#dcb909,#bc5f70,#1b31a0);
    color: white;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    text-align: center;
    line-height: 60px;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}

.chat-icons {
    position: absolute;
    bottom: 70px;
    right: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.5s ease-in-out;
}

.chat-icons.show {
    opacity: 1;
    pointer-events: auto;
}

.icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-size: 60%;
    background-repeat: no-repeat;
    background-position: center;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
}

.icon.whatsapp {
    background-color: #25d366;
    background-image: url('https://cdn-icons-png.flaticon.com/512/733/733585.png');
}

.icon.x {
    background-color: #fafafa;
    background-image: url('https://cdn-icons-png.flaticon.com/512/5968/5968830.png');
}

.icon.facebook {
    background-color: #0084ff;
    background-image: url('https://cdn-icons-png.flaticon.com/512/1384/1384005.png');
}

.icon.instagram {
    background-color: #bc5f70;
    background-image: url('https://cdn-icons-png.flaticon.com/512/2111/2111463.png');
}

/* Responsive spacing and layout for content inside video section */
@media (max-width: 768px) {
    .navbar-title{
        font-size: 0.5em;
    }
    .tm-media-container {
        padding: 1rem;
    }

    .tm-media-title-container {
        text-align: center;
        margin-bottom: 1rem;
    }

    .tm-media-1 {
        flex-direction: column;
        text-align: center;
    }

    .tm-media-1 img {
        width: 100%;
        height: auto;
        margin-bottom: 1rem;
    }

    .tm-media-body-1 {
        text-align: left;
    }

    .tm-bg-video .overlay i {
        font-size: 3rem;
    }
}
</style>

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
                                             <input value="" required name="origin" type="text" class="form-control" id="inputCity1" placeholder="Enter Origin...">
                                             <div id="cityResults" class="dropdown-menu show w-100" style="display: none;"></div>
                                             <!-- <input type="hidden" name="inputCity1_code" id="inputCity1_code" value="KTM"> -->

                                        </div>
                                        
                                         <div class="form-group tm-form-element tm-form-element-100">
                                            <i class="fa fa-map-marker fa-2x tm-form-element-icon"></i>
                                           <input value="" required name="destination" type="text" class="form-control" id="inputCity2" placeholder="Enter Destination...">
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
                                                const $input = $('#' + inputId);
                                                const $results = $('<div class="dropdown-menu show w-100 city-results" style="display: none; position: absolute; z-index: 1050;"></div>')
                                                    .insertAfter($input)
                                                    .attr('id', inputId + '_results');

                                                let currentRequest = null; // Store the last AJAX request

                                                $input.on('input', function () {
                                                    const query = $input.val();
                                                    if (query.length < 2) {
                                                        $results.hide();
                                                        return;
                                                    }

                                                    // Abort previous request if still ongoing
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

                                                            let html = '';
                                                            data.forEach(item => {
                                                                html += `
                                                                    <div class="city-result-item clearfix p-2" data-label="${item.city}, ${item.country} – ${item.airport} (${item.value})">
                                                                        <div class="city-name">${item.city}, ${item.country}<span class="iata-code float-end">${item.value}</span></div>
                                                                        <div class="airport-name text-muted">${item.airport}</div>
                                                                    </div>
                                                                `;
                                                            });

                                                            $results.html(html).show();
                                                        },
                                                        error: function (xhr, status) {
                                                            if (status !== 'abort') {
                                                                console.error('City autocomplete failed:', status);
                                                            }
                                                        }
                                                    });
                                                });

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
                                            <input required name="departure-date" type="date" class="form-control" id="inputCheckOut" placeholder="Departure Date">
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
                                            <button type="submit" class="btn btn-primary tm-btn-search">Check Availability</button>
                                        </div>
                                      </div>
                                      <div class="form-row clearfix pl-2 pr-2 tm-fx-col-xs">
                                          <p class="tm-margin-b-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                          <a href="#" class="ie-10-ml-auto ml-auto mt-1 tm-font-semibold tm-color-primary">Need Help?</a>
                                      </div>
                                      <div id="responseMessage" class="mt-3"></div>

                                </form>

                        

                            </div>                        
                        </div>      
                    </div>
                </div>                  
            </div>
             <!-- Bootstrap Loading Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-body">
        <div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 5rem;">
          <span class="visually-hidden">Loading...</span>
        </div>
        <h5 class="modal-title mb-2">Searching for best airfares</h5>
        <img src="img/loadingAnimation.gif" alt="Loading Animation" class="img-fluid mb-3" style="max-width: 100px;">
         <div class="mb-2 small" id="searchDetails">
          <!-- Dynamic search info goes here -->
        </div>
        <p>Please wait while we fetch your results...</p>
      </div>
    </div>
  </div>
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
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" class="tm-section-down-arrow">
                    <polygon fill="#ee5057" points="0,0  100,0  50,60"></polygon>                   
                </svg> 
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
            </div>

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
                                            <h3 class="tm-font-semibold tm-color-primary tm-article-title-3">Suspendisse vel est libero sem phasellus ac laoreet</h3>
                                            <p>Vivamus eget tellus ornare, sollicitudin quam id, dictum nulla. Phasellus finibus rhoncus justo, tempus eleifend neque dictum ac. Aenean metus leo, consectetur non. 
                                            <br><br>
											Etiam aliquam arcu at mauris consectetur scelerisque. Integer elementum justo in orci facilisis ultricies. Pellentesque at velit ante. Duis scelerisque metus vel felis porttitor gravida.</p>
                                        </div>                                
                                    </article>
                                    <article class="media tm-margin-b-20 tm-media-1">
                                        <img src="img/img-04.jpg" alt="Image">
                                        <div class="media-body tm-media-body-1 tm-media-body-v-center">
                                            <h3 class="tm-font-semibold tm-article-title-3">Suspendisse vel est libero sem phasellus ac laoreet</h3>
                                            <p>Duis accumsan sagittis tortor in ultrices. Praesent tortor ante, fringilla ac nibh porttitor, fermentum commodo nulla.</p>
                                            <a href="#" class="text-uppercase tm-color-primary tm-font-semibold">Continue reading...</a>
                                        </div>                                
                                    </article>
                                    <article class="media tm-margin-b-20 tm-media-1">
                                        <img src="img/img-05.jpg" alt="Image">
                                        <div class="media-body tm-media-body-1 tm-media-body-v-center">
                                            <h3 class="tm-font-semibold tm-article-title-3">Faucibus dolor ligula nisl metus auctor aliquet</h3>
                                            <p>Nunc in felis aliquet metus luctus iaculis vel et nisi. Nulla venenatis nisl orci, laoreet ultricies massa tristique id.</p>
                                            <a href="#" class="text-uppercase tm-color-primary tm-font-semibold">Continue reading...</a>
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
                                        <input type="text" id="contact_name" name="contact_name" class="form-control" placeholder="Name"  required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" id="contact_email" name="contact_email" class="form-control" placeholder="Email"  required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="contact_subject" name="contact_subject" class="form-control" placeholder="Subject"  required/>
                                    </div>
                                    <div class="form-group">
                                        <textarea id="contact_message" name="contact_message" class="form-control" rows="9" placeholder="Message" required></textarea>
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
        $(document).ready(function () {
             const loadingModalEl = document.getElementById('loadingModal');
    const loadingModal = new bootstrap.Modal(loadingModalEl, {
        backdrop: 'static',
        keyboard: false
    });
            $('#flightForm').on('submit', function (e) {
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
                    success: function (response) {
                        $('#responseMessage').html('<div class="alert alert-success">Flights found!</div>');
                        console.log(response);
                        const flights = response.data || [];
                    let html = '';

                    if (flights.length === 0) {
                        html = '<div class="alert alert-warning">No flights available.</div>';
                    } else {
                        flights.forEach((flight, i) => {
                            const segments = flight.itineraries[0].segments;
                            const dep = segments[0].departure;
                            const arr = segments[segments.length - 1].arrival;
                            const eurToNpr = 145; // example fixed conversion rate
                            const priceNpr = (parseFloat(flight.price.total) * eurToNpr).toFixed(2);
                            const message = `
                                ✈️ *Flight Offer*
                                Airline: ${flight.validatingAirlineCodes[0]}
                                Departure: ${new Date(dep.at).toLocaleString()}
                                Arrival: ${new Date(arr.at).toLocaleString()}
                                Duration: ${flight.itineraries[0].duration.replace('PT','')}
                                Price: ${flight.price.currency} ${flight.price.total} (Approx. NPR ${priceNpr})

                                Reply to confirm booking.
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
                    error: function (xhr) {
                        $('#responseMessage').html('<div class="alert alert-danger">Something went wrong.</div>');

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
        <script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
        <script src="js/popper.min.js"></script>                    <!-- https://popper.js.org/ -->       
        <script src="js/bootstrap.min.js"></script>                 <!-- https://getbootstrap.com/ -->
        <script src="js/datepicker.min.js"></script>                <!-- https://github.com/qodesmith/datepicker -->
        <script src="js/jquery.singlePageNav.min.js"></script>      <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
        <script src="slick/slick.min.js"></script>                  <!-- http://kenwheeler.github.io/slick/ -->
        <script>

            /* Google map
            ------------------------------------------------*/
            var map = '';
            var center;

            function initialize() {
                var mapOptions = {
                    zoom: 13,
                    center: new google.maps.LatLng(-23.013104,-43.394365),
                    scrollwheel: false
                };

                map = new google.maps.Map(document.getElementById('google-map'),  mapOptions);

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

            function loadGoogleMap(){
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDVWt4rJfibfsEDvcuaChUaZRS5NXey1Cs&v=3.exp&sensor=false&' + 'callback=initialize';
                document.body.appendChild(script);
            } 

            function setCarousel() {
                
                if ($('.tm-article-carousel').hasClass('slick-initialized')) {
                    $('.tm-article-carousel').slick('destroy');
                } 

                if($(window).width() < 438){
                    // Slick carousel
                    $('.tm-article-carousel').slick({
                        infinite: false,
                        dots: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    });
                }
                else {
                 $('.tm-article-carousel').slick({
                        infinite: false,
                        dots: true,
                        slidesToShow: 2,
                        slidesToScroll: 1
                    });   
                }
            }

            function setPageNav(){
                if($(window).width() > 991) {
                    $('#tm-top-bar').singlePageNav({
                        currentClass:'active',
                        offset: 79
                    });   
                }
                else {
                    $('#tm-top-bar').singlePageNav({
                        currentClass:'active',
                        offset: 65
                    });   
                }
            }

            function togglePlayPause() {
                vid = $('.tmVideo').get(0);

                if(vid.paused) {
                    vid.play();
                    $('.tm-btn-play').hide();
                    $('.tm-btn-pause').show();
                }
                else {
                    vid.pause();
                    $('.tm-btn-play').show();
                    $('.tm-btn-pause').hide();   
                }  
            }
       
            $(document).ready(function(){

                $(window).on("scroll", function() {
                    if($(window).scrollTop() > 100) {
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
                $('.nav-link').click(function(){
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