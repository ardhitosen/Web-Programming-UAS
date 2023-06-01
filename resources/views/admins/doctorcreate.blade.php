<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css">
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

        .content {
            margin-left: 240px;
            padding: 20px;
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

        <div class="content bg-white flex justify-center items-center">

            <form action="{{ route('doctors.store') }}" method="POST" class="max-w-md w-full bg-white p-8 border border-gray-200 rounded shadow-md" enctype="multipart/form-data">
                @csrf
            
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name:</label>
                    <input type="text" id="name" name="name" required class="w-full border border-gray-300 rounded-md focus:ring focus:ring-blue-300 focus:border-blue-300">
                    @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            
                <div class="mb-4">
                    <label for="doctor_photo" class="block text-gray-700">Doctor Photo:</label>
                    <input type="file" id="doctor_photo" name="doctor_photo" accept="image/*" required class="w-full border border-gray-300 rounded-md focus:ring focus:ring-blue-300 focus:border-blue-300">
                    @error('doctor_photo')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            
                <div class="mb-4">
                    <label for="type" class="block text-gray-700">Type:</label>
                    <select id="type" name="type" required class="w-full border border-gray-300 rounded-md focus:ring focus:ring-blue-300 focus:border-blue-300">
                        <option value="Dokter Spesialis">Dokter Spesialis</option>
                        <option value="Dokter Umum">Dokter Umum</option>
                    </select>
                    @error('type')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                
            
                <div id="schedule-inputs" class="mb-4">
                    <div class="schedule-input mb-2">
                        <label for="schedule" class="block text-gray-700">Schedule:</label>
                        <input type="datetime-local" id="schedule" name="schedules[]" required class="w-full border border-gray-300 rounded-md focus:ring focus:ring-blue-300 focus:border-blue-300">
                        @error('schedules.*')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            
                <button type="button" id="add-schedule-btn" class="mb-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Add Schedule</button>
            
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Add Doctor</button>
            </form>
            
        </div>
    </div>

    <script>
        const addScheduleButton = document.getElementById('add-schedule-btn');
        const scheduleInputsContainer = document.getElementById('schedule-inputs');

        addScheduleButton.addEventListener('click', function () {
            const scheduleInput = document.createElement('div');
            scheduleInput.classList.add('schedule-input', 'mb-2');

            const label = document.createElement('label');
            label.setAttribute('for', 'schedule');
            label.classList.add('block', 'text-gray-700');
            label.textContent = 'Schedule:';

            const input = document.createElement('input');
            input.type = 'datetime-local';
            input.name = 'schedules[]';
            input.required = true;
            input.classList.add('w-full', 'border', 'border-gray-300', 'rounded-md', 'focus:ring', 'focus:ring-blue-300', 'focus:border-blue-300');

            scheduleInput.appendChild(label);
            scheduleInput.appendChild(input);

            scheduleInputsContainer.appendChild(scheduleInput);
        });
    </script>
    </div>
</body>

</html>