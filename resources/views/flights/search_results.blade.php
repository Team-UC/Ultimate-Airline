<title>Flight Result</title>
<x-header/>
<!-- Add this in <head> or right before your custom scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</div>

<!-- @section('content') -->
<div class="container mt-4">
    <h2>Flight Search Results</h2>

</div>
<!-- @endsection -->
    <div class="tm-section tm-section-pad tm-bg-gray" id="tm-section-4">
        <div class="container">
            <div class="row">
                <div id="responseMessage"></div>
                <div id="flightResults"></div>

            </div>
        </div>
    </div>
<!-- Modal container for loading -->
<div class="modal fade" id="loadingModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-5 text-center">
            <div class="spinner-border text-primary" role="status"></div>
            <div class="mt-3">Fetching available flights...</div>
        </div>
    </div>
</div>

<!-- Where results will be shown -->
<div id="flightResults"></div>

<script>
    $(document).ready(function () {
        const loadingModalEl = document.getElementById('loadingModal');
        const loadingModal = new bootstrap.Modal(loadingModalEl, {
            backdrop: 'static',
            keyboard: false
        });

        const urlPath = window.location.pathname;

        const regex = /from-(.*?)-to-(.*?)-([A-Za-z]{3}-\d{1,2},-\d{4})\/([a-f0-9\-]+)/;
        const match = urlPath.match(regex);

        if (!match) {
            $('#flightResults').html(`<div class="alert alert-danger">Invalid URL format.</div>`);
            return;
        }

        const origin = decodeURIComponent(match[1]).replace(/-/g, ' ');
        const destination = decodeURIComponent(match[2]).replace(/-/g, ' ');
        const rawDate = decodeURIComponent(match[3]);
        // const uuid = match[4];
        const departureDate = formatDate(rawDate); // "YYYY-MM-DD"

        const adult = 1;
        const children = 0;

        $('#searchDetails').html(`
            <div class="text-black">
                <strong>From:</strong> ${origin} <br>
                <strong>To:</strong> ${destination} <br>
                <strong>Adults:</strong> ${adult}, <strong>Children:</strong> ${children} <br>
                <strong>Departure:</strong> ${departureDate}
            </div>
        `);

        loadingModal.show();
console.log(JSON.stringify({
  origin,
  destination,
  departureDate,
  adult,
  children,
//   uuid
}, null, 2));

const originFormatted = extractIATACode(origin);
const destinationFormatted = extractIATACode(destination);

        $.ajax({
            url: "{{ config('services.restapi_url') }}/flight-check",
            method: 'POST',
                contentType: "application/json",
            data: JSON.stringify({
  origin: origin.trim(),
  destination: destination.trim(),
  departureDate: departureDate,
  adult: parseInt(adult),
  children: parseInt(children)
}),

        // uuid: uuid
                // uuid: uuid
          
            success: function (response) {
                $('#responseMessage').html('<div class="alert alert-success">Flights found!</div>');
                const flights = response.data || [];
                let html = '';

                if (flights.length === 0) {
                    html = '<div class="alert alert-warning">No flights available.</div>';
                } else {
                    flights.forEach((flight) => {
                        const segments = flight.itineraries[0].segments;
                        const dep = segments[0].departure;
                        const arr = segments[segments.length - 1].arrival;
                        const eurToNpr = 145;
                        const priceNpr = (parseFloat(flight.price.total) * eurToNpr).toFixed(2);
                        const message = `
✈️ *Flight Offer*
Airline: ${flight.validatingAirlineCodes[0]}
Departure: ${new Date(dep.at).toLocaleString()}
Arrival: ${new Date(arr.at).toLocaleString()}
Duration: ${flight.itineraries[0].duration.replace('PT','')}
Price: ${flight.price.currency} ${flight.price.total} (Approx. NPR ${priceNpr})

Please Book this Flight for Me`;

                        html += `
                            <div class="card mb-3 shadow-sm border-start border-danger border-3 p-3 w-100">
                                <div class="row align-items-center text-center text-md-start">
                                    <div class="col-md-2 d-flex flex-column align-items-center">
                                        <img src="https://s1.apideeplink.com/images/airlines/${flight.validatingAirlineCodes[0]}.png" alt="Airline Logo" style="max-height: 40px;">
                                        <div class="fw-semibold mt-2">${flight.validatingAirlineCodes[0]}</div>
                                    </div>
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

                $('#flightResults').html(html);
                loadingModal.hide();
            },
            error: function () {
                $('#flightResults').html('<div class="alert alert-danger">Something went wrong.</div>');
                loadingModal.hide();
            }
        });

        // Helper: convert Jul-16,-2025 to YYYY-MM-DD
        function formatDate(raw) {
            const months = {
                Jan: '01', Feb: '02', Mar: '03', Apr: '04',
                May: '05', Jun: '06', Jul: '07', Aug: '08',
                Sep: '09', Oct: '10', Nov: '11', Dec: '12'
            };
            const parts = raw.replace(',', '').split('-'); // e.g., ["Jul", "16", "2025"]
            const yyyy = parts[2];
            const mm = months[parts[0]];
            const dd = parts[1].padStart(2, '0');
            return `${yyyy}-${mm}-${dd}`;
        }
    });
function extractIATACode(label) {
    const match = label.match(/\((\w{3})\)/);
    return match ? match[1].toUpperCase() : '';
}

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
}

</script>
