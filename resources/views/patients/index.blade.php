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

    .image-container {
      position: relative;
      display: inline-block;
    }

    .image-overlay {
      position: absolute;
      top: 30%;
      right: 25%;
      transform: translate(-50%, -50%);
      text-align: justify-left;
      padding: 20px;
      animation: slide-in 1s ease-out;
      animation-fill-mode: forwards;
      opacity: 0;
    }

    @keyframes slide-in {
      0% {
        transform: translateX(-100%);
        opacity: 0;
      }
      100% {
        transform: translateX(0);
        opacity: 1;
      }
    }

    .image-overlay h1 {
      font-size: 60px;
      margin-bottom: 10px;
      color: #2AB1E4;
      font-weight: bold;
      font-family: 'Roboto', sans-serif;
      text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.3);
    }

    .image-overlay p {
      font-size: 14px;
      font-family: 'Roboto', sans-serif;
      letter-spacing: 2px;
      margin-bottom: 10px;
      color: #104558;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }

    .image-overlay button {
      background-color: #2AB1E4;
      color: #ffffff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-family: 'Roboto', sans-serif;
      letter-spacing: 2px;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }
  </style>
</head>
<body>
  <nav class="navbar flex justify-between items-center bg-white py-4 px-6">
    <div class="navbar-left space-x-6">
      <img src="{{asset('images/logo1.png')}}" alt="Logo 1" height="10" width="5%">
    </div>
    <div class="navbar-right space-x-4">
      <a href="/" class="inline-block px-4 py-2 rounded-md text-blue-300">Home</a>
      <a href="/patients/login" class="inline-block px-4 py-2 rounded-md text-gray-500 hover:text-blue-300 transition-colors">Login</a>
      <a href="/patients/create" class="inline-block px-4 py-2 rounded-md text-gray-500 hover:text-blue-300 transition-colors">Register</a>
    </div>
  </nav>
  <div class="image-container" style="padding-top:20px">
    <img src="{{ asset('images/indexpicture.png') }}" alt="indeximg">
    <div class="image-overlay">
      <h1 class="font-roboto font-bold text-8xl md:text-9xl lg:text-10xl tracking-wider">Your health is an investment not an expense.</h1>
      <p class="font-roboto text-xl tracking-wider">juan terro juan terro juan terro</p>
      <button class="font-roboto text-lg tracking-wider bg-blue-500 text-white px-4 py-2 mt-4" onclick="window.location.href='/patients/login'">Book Now</button>
    </div>
  </div>

  <script>
    window.addEventListener('load', function() {
      var overlay = document.querySelector('.image-overlay');
      overlay.style.opacity = '1';
    });
  </script>
</body>
</html>
