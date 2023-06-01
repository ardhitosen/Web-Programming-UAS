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
                    <p>Here, you can do CRUD on doctors.</p>
                </div>
            </div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold mx-">Doctors</h2>
                <a href="{{ route('admins.doctors.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Doctors</a>
            </div>

            <div class="flex flex-wrap mx-4">
                @foreach ($doctors as $doctor)
                    <div class="doctor-card mx-4">
                        <img src="{{ asset('storage/' . $doctor->doctor_photo) }}" alt="Doctor Photo" class="rounded-full w-40 h-40 object-cover mx-auto mb-4">
                        <h3 class="text-lg font-bold mb-2">{{ $doctor->name }}</h3>
                        <p class="mb-2">Type: {{ $doctor->type }}</p>
                        <p class="mb-2">Schedule:</p>
                        <ul>
                            @php
                                $schedules = json_decode($doctor->schedule);
                            @endphp
                            @foreach ($schedules as $schedule)
                                @php
                                    $formattedSchedule = \Carbon\Carbon::parse($schedule)->format('d F Y H:i');
                                @endphp
                                <li>{{ $formattedSchedule }}</li>
                            @endforeach
                        </ul>
                        <div class="buttons mt-4">
                            <a href="{{route('doctors.edit',$doctor->id)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-2 rounded">Edit</a>
                            <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            
            
        </div>
    </div>
</body>

</html>
