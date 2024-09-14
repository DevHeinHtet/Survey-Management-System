<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.4/dist/datepicker.js"></script>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
     integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
     crossorigin=""></script>

    <link rel="icon" type="image/svg" sizes="16x16" href="{{asset('src/logo.svg')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Manager Panel</title>
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
</style>
<body class="bg-[#f4f7fa] max-w-[1920px] mx-auto" style="font-family: 'Roboto', sans-serif;">

    @include('layouts.sidebar')

    <div class="main ml-0 xl:ml-[270px] transition duration-300 overflow-y-hidden">

        @include('layouts.header')
        <div class="">
            @include('layouts.alert')
            @yield('content')
        </div>
    </div>
</body>

<script>
  const sidebar = document.querySelector('.sidebar');
  const main = document.querySelector('.main');
  function Open(){
    sidebar.classList.toggle('xl:left-[-270px]');
    sidebar.classList.toggle('left-[-270px]');
    main.classList.toggle('xl:ml-[270px]');
  }
  const chat = document.querySelector('#chat');
  function chatBox(){
      chat.classList.toggle('hidden');
  }
</script>
</html>