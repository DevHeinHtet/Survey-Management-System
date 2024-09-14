<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <script src="https://cdn.tailwindcss.com"></script>
        <title>Login</title>
    </head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
    </style>
    <body style="font-family: 'Roboto', sans-serif;">
        <div class="flex justify-center items-center text-gray-800 h-screen bg-cover bg-center p-4 md:p-10" style="background-image: url('{{asset('src/login_bg.jpg')}}');">
            <div class="bg-white p-8 shadow-xl w-[340px] rounded-md">
                <form action="{{ route('manager.check') }}" method="POST">
                    @csrf
                    <div class="flex flex-col items-center">
                        <img src="{{asset('src/logo.svg')}}" class="p-1 w-14 mb-2 animate-bounce" alt="Logo">
                        <p class="text-center text-xl font-bold mb-8 uppercase">Manager Login</p>
                    </div>

                    @if (Session::get('fail'))
                        <div class="bg-red-500 px-3 py-2 rounded text-gray-100 mb-3">
                            <span>{{ Session::get('fail') }}</span>
                        </div>
                    @endif 
                    <div class="relative z-0 w-full group mb-6">
                        <input type="email" name="email" class="block py-1 px-0 w-full text-md bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label class="peer-focus absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                        @error('email')
                        <span class="text-xs text-red-800">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="relative z-0  w-full group mb-6">
                        <input type="password" name="password" class="block py-1 px-0 w-full text-md bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label class="peer-focus absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-2 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                        @error('password')
                        <span class="text-xs text-red-800">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="flex items-center mb-12">
                        <input id="remember_me" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500">
                        <label for="remember_me" class="ml-2 text-xs">Remember Me</label>
                    </div>

                    <button type="submit" class="w-full text-white uppercase bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Login</button>
                </form>   
            </div>
        </div>
    </body>
</html>
