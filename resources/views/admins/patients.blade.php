<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 240px;
            background-color: #f7f7f7;
            color: #fff;
        }

        .sidebar ul {
            padding-top: 20px;
        }

        .sidebar ul li {
            padding: 10px 20px;
            cursor: pointer;
        }
        .sidebar ul li a {
            color: #303030;
            text-decoration: none;
        }

        /* Content area styles */
        .content {
            margin-left: 240px;
            padding: 20px;
        }

        .welcome-box {
            background-color: #2AB1E4;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            animation: slideIn 0.5s ease-out;
            animation-fill-mode: forwards;
            opacity: 0;
        }

        .welcome-box h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .welcome-box p {
            font-size: 16px;
            margin-bottom: 0;
        }

        .patient-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .patient-card .name {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .patient-card .email {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .patient-card .phone {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .patient-card .more-details {
            display: none;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
        }

        .patient-card .more-details p {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .patient-card .more-details .toggle-button {
            cursor: pointer;
            color: #2AB1E4;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="flex">
        <div class="sidebar">
            <ul>
                <li><a href="{{ route('admins.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admins.doctors') }}">View Doctors</a></li>
                <li><a href="{{ route('admins.reservations') }}">View Reservations</a></li>
                <li><a href="{{ route('admins.patients') }}">View Patients</a></li>
                <li>
                    <form action="{{ route('admins.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-1 py-1 text-left"
                            style="color: #303030; background-color: #f7f7f7;">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        <div class="content bg-white">
            <div class="p-6">
                <div class="welcome-box">
                    <h2>Welcome, Admin</h2>
                    <p>Here you can view patient's information.</p>
                </div>

                @foreach ($patients as $patient)
                <div class="patient-card mt-5">
                    <div class="name">{{ $patient->name }}</div>
                    <div class="email">Email: {{ $patient->email }}</div>
                    <div class="phone">Phone: {{ $patient->phone_number }}</div>
                    <div class="more-details">
                        <p>Address: {{ $patient->address }}</p>
                        <p>Place of Birth: {{ $patient->place_of_birth }}</p>
                        <p>Date of Birth: {{ $patient->date_of_birth }}</p>
                    </div>
                    <a class="toggle-button" href="#" onclick="toggleDetails(this)">View More</a>
                </div>
                @endforeach

                <script>
                    function toggleDetails(button) {
                        var moreDetails = button.parentElement.querySelector('.more-details');
                        if (moreDetails.style.display === 'none') {
                            moreDetails.style.display = 'block';
                            button.innerHTML = 'View Less';
                        } else {
                            moreDetails.style.display = 'none';
                            button.innerHTML = 'View More';
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</body>

</html>
