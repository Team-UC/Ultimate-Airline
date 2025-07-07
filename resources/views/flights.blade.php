<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flight Results</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>  
    {{-- tailwind added --}}

    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-weight: 400;

        }
        
    </style>
</head>
<body>
    <div class="container py-5 bg-blue-900 text-yellow-500 rounded-lg shadow-lg">  
        <h2 class="text-center mb-4 font-extrabold tracking-tighter text-4xl">Available Flights</h2>
        <div id="flightResults"></div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const flights = @json($flights);
            const container = document.getElementById('flightResults');

            if (!flights || flights.length === 0) {
                container.innerHTML = `<div class="alert alert-warning text-center">No flights found.</div>`;
                return;
            }

            let html = '';
            const eurToNpr = 145;

            flights.forEach((flight) => {
                const segments = flight.itineraries[0].segments;
                const dep = segments[0].departure;
                const arr = segments[segments.length - 1].arrival;
                const priceNpr = (parseFloat(flight.price.total) * eurToNpr).toFixed(2);
                const airline = flight.validatingAirlineCodes[0];

                html += `
                <div class="card mb-3 p-3 border border-danger rounded hover:bg-blue-400 hover:text-white transition-colors duration-300">
                    <div class="row align-items-center text-center text-md-start g-3">
                        <div class="col-md-2 d-flex flex-column align-items-center justify-content-center">
                            <img src="https://s1.apideeplink.com/images/airlines/${airline}.png" style="max-height: 40px;">
                            <div class="fw-semibold mt-2">${airline}</div>
                        </div>
                        <div class="col-md-6 d-flex flex-column flex-md-row justify-content-around align-items-center gap-3">
                            <div>
                                <div class="fw-bold fs-5">${new Date(dep.at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</div>
                                <div>Departure (${dep.iataCode})</div>
                                <div class="text-muted small">${new Date(dep.at).toLocaleDateString()}</div>
                            </div>
                            <div class="text-center">
                                <div class="fw-medium">${flight.itineraries[0].duration.replace('PT', '').replace('H', ' Hr ').replace('M', ' Min')}</div>
                                <div class="text-danger mt-1"><span class="fw-bold">5 Kg</span> &nbsp; <span class="fw-bold">15 Kg</span></div>
                            </div>
                            <div>
                                <div class="fw-bold fs-5">${new Date(arr.at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</div>
                                <div>Arrival (${arr.iataCode})</div>
                                <div class="text-muted small">${new Date(arr.at).toLocaleDateString()}</div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="text-danger fw-bold fs-5 mb-2">NPR ${priceNpr}</div>
                            <a href="#" class="btn btn-danger btn-sm mb-1 w-75 fw-semibold">BOOK NOW</a>
                            <a href="https://wa.me/+9779808041246?text=${encodeURIComponent(`✈️ Flight Offer\nAirline: ${airline}\nPrice: NPR ${priceNpr}`)}" target="_blank" class="btn btn-success btn-sm w-75">Book on WhatsApp</a>
                        </div>
                    </div>
                </div>`;
            });

            container.innerHTML = html;
        });
    </script>
</body>
</html>
