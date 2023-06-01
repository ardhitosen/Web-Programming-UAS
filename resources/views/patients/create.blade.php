<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-right a:hover {
            color: #2AB1E4;
        }

        /* Animation Styles */
        .form-container {
            animation: slideIn 0.5s ease-in-out forwards;
            opacity: 0;
            transform: translateY(-20px);
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <nav class="navbar flex justify-between items-center bg-white py-4 px-6">
        <div class="navbar-left space-x-6">
          <img src="{{asset('images/logo1.png')}}" alt="Logo 1" height="10" width="5%">
        </div>
        <div class="navbar-right space-x-4">
            <a href="/" class="inline-block px-4 py-2 rounded-md text-gray-500 hover:text-blue-300 transition-colors">Home</a>
            <a href="/patients/login" class="inline-block px-4 py-2 rounded-md text-gray-500 hover:text-blue-300 transition-colors">Login</a>
            <a href="/patients/create" class="inline-block px-4 py-2 rounded-md text-blue-300">Register</a>
        </div>
    </nav>
    <form action="/patients/" method="post" class="max-w-md mx-auto my-8 p-6 bg-white rounded shadow form-container">
        @if ($errors->any())
        <div class="mb-4 bg-red-100 p-4 rounded text-red-600">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input value="{{old('name')}}" type="text" name="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input value="{{old('email')}}" type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label for="address" class="block text-gray-700">Address</label>
            <input value="{{old('address')}}" type="text" name="address" id="address" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-gray-700">Phone Number</label>
            <input value="{{old('phone')}}" type="tel" name="phone" id="phone" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label for="place_of_birth" class="block text-gray-700">Place of Birth</label>
            <input value="{{old('place_of_birth')}}" type="text" name="place_of_birth" id="place_of_birth"class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label for="date_of_birth" class="block text-gray-700">Date of Birth</label>
            <input value="{{old('date_of_birth')}}" type="date" name="date_of_birth" id="date_of_birth" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-300">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-300">
        </div>

        <button type="submit" class="w-full bg-sky-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition-colors">Register</button>
    </form>
    <div class="text-center mt-4">
        <p class="text-gray-700">Got an account already? <a href="/patients/login" class="text-blue-500">Login here</a></p>
    </div>
</body>
</html>
