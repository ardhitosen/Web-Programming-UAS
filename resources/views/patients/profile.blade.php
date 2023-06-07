<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
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

        .doctor-card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .doctor-card img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 16px;
        }

        .doctor-card h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .doctor-card p {
            margin-bottom: 4px;
        }

        .doctor-card .buttons {
            display: flex;
            justify-content: space-between;
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

        .profile-details {
            margin-bottom: 20px;
        }

        .profile-detail {
            font-size: 18px;
            margin-bottom: 10px;
        }

    </style>
</head>

<body>
    <div class="flex">
        <div class="sidebar">
            <ul>
                <li><a href="{{ route('patients.dashboard', ['id' => $patient->id,'type'=>'all']) }}">Dashboard</a></li>
                <li><a href="{{ route('patients.profile', ['id' =>$patient->id]) }}">Profile</a></li>
                <li>
                    <form action="{{ route('patients.logout') }}" method="POST">
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
                    <h2>Welcome, {{$patient->name}}</h2>
                    <p>This is your profile.</p>
                </div>
            </div>
            <div class="profile-details">
                <h2 class="profile-detail">Nama: {{ $patient->name }}</h2>
                <h2 class="profile-detail">Email: {{ $patient->email }}</h2>
                <h2 class="profile-detail">Phone: {{ $patient->phone_number }}</h2>
                <h2 class="profile-detail">Recovery Code: {{ $patient->recovery_code }}</h2>
            </div>


            <h1>List Reservasi:</h1>
            <div class="max-w-md w-full bg-white p-8 border border-gray-200 rounded shadow-md">
                @if($reservations->count() > 0)
                    @foreach($reservations as $reservation)
                    <div class="reservation-card mb-4">
                        <img src="{{ asset('storage/' . $reservation->doctor->doctor_photo) }}" alt="Doctor Photo" class="rounded-full w-40 h-40 object-cover mx-auto mb-4">
                        <p>Doctor: {{ $reservation->doctor->name}}</p>
                        <p>Reserved At: {{ $reservation->reserved_at }}</p>
                        <p>Keluhan: {{ $reservation->keluhan }}</p>
                        <p>Status: {{ $reservation->status }}</p>
                    </div>
                    @endforeach
                @else
                    <p>Tidak ada reservasi.</p>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
