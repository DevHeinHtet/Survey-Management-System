<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="max-w-[1920px] mx-auto">
    <div class="h-screen flex flex-col justify-center items-center">
        <span class="text-[8rem] text-green-600 animate-pulse">404</span>
        <span class="text-3xl">Error - Page Not Found</span>
        <i class="fa-regular fa-face-sad-tear mt-8" style="font-size: 3rem"></i>
        <span class="text-xl font-bold text-gray-700 mt-2">Please check the url</span>
        <span class="text-xl mt-4 text-gray-600">
            Otherwise, 
            <a href="{{ route('manager.home') }}" class="text-blue-700 hover:underline">click here</a>
            to be redirect to the homepage.</span>
    </div>
</body>
</html>