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
                    <p>This is where you can view reservations and approve/decline them.</p>
                </div>
            </div>
            <div class="content bg-white flex">
                <div class="max-w-md w-full bg-white p-8 border border-gray-200 rounded shadow-md">
                    @foreach($reservations as $reservation)
                    <div class="reservation-card mb-4">
                        <img src="{{ asset('storage/' . $reservation->doctor->doctor_photo) }}" alt="Doctor Photo" class="rounded-full w-40 h-40 object-cover mx-auto mb-4">
                        <p>Doctor: {{ $reservation->doctor->name}}</p>
                        <p>Patient: {{ $reservation->patient->name}}</p>
                        <p>Reserved At: {{ $reservation->reserved_at }}</p>
                        <p>Keluhan: {{ $reservation->keluhan }}</p>
                        <p>Status: {{ $reservation->status }}</p>
                        <form action="{{ route('admins.reservations.approve', ['id' => $reservation->id]) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Approve</button>
                        </form>
                        <form action="{{ route('admins.reservations.decline', ['id' => $reservation->id]) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Decline</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>

</html>
