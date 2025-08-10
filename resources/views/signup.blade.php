<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* --- Main Page & Form Styles --- */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1a202c;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .signup-card {
            background-color: rgba(17, 24, 39, 0.85);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .form-control, .form-select {
            background-color: rgba(255, 255, 255, 0.05);
            border-color: #718096;
            color: white;
        }
        .form-control::placeholder { color: #a0aec0; }
        .form-control:focus, .form-select:focus {
            background-color: #4a5568;
            border-color: #4299e1;
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(66, 153, 225, 0.25);
        }
        .form-label { color: #cbd5e0; }
        .btn-primary {
            background-color: #2563eb;
            border-color: #2563eb;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }

        /* --- Calendar Styles (Consolidated) --- */
        #calendar-container {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            width: 100%;
            background-color: #2d3748;
            border: 1px solid #4a5568;
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
            text-align: center;
        }
        .calendar-day {
            color: white;
            padding: 0.5rem;
            cursor: pointer;
            background-color: #333c4dff;
             border-radius: 50%; 
            transition: background-color 0.2s ease-in-out;
        }
        .calendar-day:hover {
            background-color: #3b82f6;
            color: white;
        }
        .calendar-header-arrow {
            background-color: #3b82f6;
        }
        .calendar-header-arrow:hover {
            background-color: #4a5568;
        }
        .selected-day {
            background-color: #2563eb;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 p-4">

    <div class="w-100 signup-card p-5" style="max-width: 570px;">
        
        <div class="text-center mb-4">
            <div class="d-inline-block p-2 rounded-circle mb-2">
                <img src="https://ultimatecoder.in/images/logo.png" alt="Ultimate Airlines Logo" style="height: 80px;">
            </div>
            <h1 class="h3 fw-bold mb-2">Create Your Account</h1>
            <p style="color: #a0aec0;">Please fill in the details to sign up.</p>
        </div>

        <form action="{{ route('signup.handle') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="John Doe" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="johndoe99" required>
            </div>
            
            
            <div class="mb-3 position-relative">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="text" class="form-control" id="dob" name="dob" placeholder="Select a date" readonly style="cursor: pointer;" required>
                
                
                <div id="calendar-container" class="d-none">
                    <div id="calendar-header" class="d-flex align-items-center justify-content-between mb-3">
                        <button type="button" id="prev-month" class="btn btn-sm rounded-circle calendar-header-arrow text-white">&lt;</button>
                        <div id="month-year" class="fw-semibold fs-5"></div>
                        <button type="button" id="next-month" class="btn btn-sm rounded-circle calendar-header-arrow text-white">&gt;</button>
                    </div>
                    <div class="d-grid text-center text-secondary mb-2" style="grid-template-columns: repeat(7, 1fr);">
                        <div>Su</div><div>Mo</div><div>Tu</div><div>We</div><div>Th</div><div>Fr</div><div>Sa</div>
                    </div>
                    <div id="calendar-grid" class="calendar-grid"></div>
                </div>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                    <option>Prefer not to say</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact Information</label>
                <input type="tel" class="form-control" id="contact" name="contact" placeholder="123-456-7890" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" placeholder="123 Main St, Anytown, USA" required></textarea>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg fw-bold">Sign Up</button>
            </div>
        </form>

        <div class="text-center mt-4">
            <p class="text-sm" style="color: #a0aec0;">
                Already have an account? 
                <a href="{{-- Assuming you have a route named 'login' --}}" class="text-decoration-none" style="color: #63b3ed;">Log In</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS & Calendar Script (Consolidated) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    // --- Element References ---
    const dobInput = document.getElementById('dob');
    const calendarContainer = document.getElementById('calendar-container');
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');
    const monthYearDisplay = document.getElementById('month-year');
    const calendarGrid = document.getElementById('calendar-grid');

    // --- Calendar State ---
    let currentDate = new Date();
    let selectedDate = null; // Keep track of the selected date

    // --- Event Listeners ---
    dobInput.addEventListener('click', (event) => {
        event.stopPropagation(); // Prevents other click events from firing
        calendarContainer.classList.toggle('d-none');
        if (!calendarContainer.classList.contains('d-none')) {
            renderCalendar(currentDate);
        }
    });

    prevMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate);
    });

    nextMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate);
    });

    // --- Main Calendar Function ---
    function renderCalendar(date) {
        const year = date.getFullYear();
        const month = date.getMonth();
        
        monthYearDisplay.textContent = new Intl.DateTimeFormat('en-US', { month: 'long', year: 'numeric' }).format(date);
        calendarGrid.innerHTML = ''; // Clear old dates

        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Add blank spaces for the start of the month
        for (let i = 0; i < firstDayOfMonth; i++) {
            calendarGrid.appendChild(document.createElement('div'));
        }

        // Create a button for each day
        for (let day = 1; day <= daysInMonth; day++) {
            const dayCell = document.createElement('button'); // Use a button for better accessibility
            dayCell.type = 'button'; // Prevent form submission
            dayCell.textContent = day;
           dayCell.classList.add('calendar-day'); // Use button classes

            
            dayCell.addEventListener('click', function() {
                // 1. Set the selected date
                selectedDate = new Date(year, month, day);

                // 2. Format the date as DD-MM-YYYY
                const formattedDay = selectedDate.getDate().toString().padStart(2, '0');
                const formattedMonth = (selectedDate.getMonth() + 1).toString().padStart(2, '0');
                const formattedYear = selectedDate.getFullYear();
                
                // 3. Update the input box value
                dobInput.value = `${formattedDay}-${formattedMonth}-${formattedYear}`;

                // 4. Hide the calendar
                calendarContainer.classList.add('d-none');
            });

            calendarGrid.appendChild(dayCell);
        }
    }

    // Hide calendar if user clicks outside of it
    document.addEventListener('click', function(event) {
        if (!calendarContainer.contains(event.target) && !dobInput.contains(event.target)) {
            calendarContainer.classList.add('d-none');
        }
    });
});
</script>
</body>
</html>