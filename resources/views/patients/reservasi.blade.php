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

        .reviews {
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
    </div>
    <div class="content bg-white">
    <form action="{{ route('patients.storeReservasi', ['id_doctor' => $doctor->id, 'id_patient' => $patient->id])}}" method="post">
        @csrf
        <div class="mb-4">
            <label for="dokter" class="block text-gray-700">Nama Dokter</label>
            <input type="input" name="nama_doctor" id="nama_doctor"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-300" value="{{$doctor->name}}" readonly>
        </div>

        <div class="mb-4">
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

        </div>

        <div class="mb-4">
            <label for="pasien" class="block text-gray-700">Nama Pasien</label>
            <input type="input" name="nama_pasien" id="nama_pasien"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-300" value="{{$patient->name}}" readonly>
        </div>
        <div class="mb-4">
            <label for="jadwal" class="block text-gray-700">Jadwal Dokter</label>
            <select name="jadwal_doctor" id="jadwal_doctor"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-300">
                @foreach (json_decode($doctor->schedule) as $schedule)
                    @php
                        $formattedSchedule = str_replace('T', ' ', $schedule);
                    @endphp
                    <option value="{{ $schedule }}">{{ date('d F Y H:i', strtotime($formattedSchedule)) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="keluhan" class="block text-gray-700">Keluhan Pasien</label>
            <textarea name="keluhan_pasien" id="keluhan_pasien"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-300"></textarea>
        </div>
        <div class="mb-4">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
        </div>
    </form>
</div>
</body>

</html>
