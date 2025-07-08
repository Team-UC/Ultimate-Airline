<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Flight Result</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-900 text-yellow-500 min-h-screen flex items-center justify-center p-4">
    <div class="container bg-white text-black rounded-lg shadow-lg p-5 max-w-2xl">
        <h2 class="text-3xl font-extrabold text-center mb-4">Flight Search Result</h2>
        @if (!$flight)
            <div class="alert alert-danger text-center">Flight not found or session expired.</div>
        @else
            <div
                class="card p-4 border border-danger rounded hover:bg-blue-400 hover:text-white transition-colors duration-300">
                <div class="mb-3">
                    <strong>From:</strong> {{ $from }}
                </div>
                <div class="mb-3">
                    <strong>To:</strong> {{ $to }}
                </div>
                <div class="mb-3">
                    <strong>Date:</strong> {{ $date }}
                </div>
                <div class="mb-3">
                    <strong>Airline:</strong> {{ $flight['validatingAirlineCodes'][0] ?? 'N/A' }}
                </div>
                <div class="mb-3 text-danger fw-bold fs-5">
                    <strong>Price:</strong> NPR {{ number_format(($flight['price']['total'] ?? 0) * 145, 2) }}
                </div>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-danger w-100 fw-semibold">BOOK NOW</a>
                    <a href="https://wa.me/+9779808041246?text={{ urlencode("✈️ Flight Offer\nAirline: " . ($flight['validatingAirlineCodes'][0] ?? 'N/A') . "\nPrice: NPR " . number_format(($flight['price']['total'] ?? 0) * 145, 2)) }}"
                        target="_blank" class="btn btn-success w-100 fw-semibold">Book on WhatsApp</a>
                </div>
            </div>
        @endif
    </div>
</body>

</html>
