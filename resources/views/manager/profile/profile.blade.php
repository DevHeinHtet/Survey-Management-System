@extends('manager.profile.index')
@section('manager_content')
@include('layouts.change_password')

<div class="p-8">
    <div class="flex items-center space-x-4">
        <span class="text-3xl font-bold">My Profile</span>
        @if ($manager->detail && $manager->detail->url != null)
            <a href="{{ $manager->detail->url }}" class="text-blue-600 hover:underline text-sm cursor-pointer" target="_blank">website</a>
        @endif
    </div>
    <div class="flex justify-between items-center md:mr-20">
        <div class="flex flex-col md:flex-row items-center py-8 space-x-4">
            <div class="relative">
                <img src="{{$manager->getProfile()}}" class="w-28 h-28 object-contain bg-white rounded-full ring-1 ring-offset-2 ring-blue-500 mb-2" alt="Logo">
                <label for="profile">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-7 h-7 cursor-pointer bg-blue-500 rounded-full p-1 text-white absolute bottom-2 right-2 ring ring-white ring-offset-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                    </svg>
                </label> 
                <form action="{{ route('manager.changeProfile',['id' => $manager->hash]) }}" id="upload" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" accept="image/*" name="profile" id="profile" class="hidden">
                </form>
            </div>
            {{-- Name and Email --}}
            <div class="flex flex-col">
                <span class="text-xl font-bold mt-1">{{$manager->name}} (Dev)</span>
                <span class="text-md text-gray-500 font-bold">{{$manager->position}}</span>
                <a onclick="openChange()" class="text-blue-600 hover:underline text-sm cursor-pointer">Change password</a>
            </div>
        </div>
        <button type="submit" form="profile-data-form" class="flex items-center space-x-1 border-2 border-blue-500 rounded-full px-4 py-1.5 text-blue-500 hover:bg-blue-500 hover:text-white">
            <i class="fa-solid fa-check"></i>
            <span class="text-sm">save</span>
        </button>
    </div>
    <form id="profile-data-form" action="{{ route('manager.changeData', ['id' => $manager->hash]) }}" method="POST">
        @csrf
        @if(count($errors) > 0)
        <div id="form-error" class="text-red-800 bg-gray-200 p-4 m-2 text-xs rounded-sm">
            @foreach($errors->all() as $error)
                <span class="py-1 text-red-500">{{ $error }}</span><br>
            @endforeach
            </div>
        @endif
        <div class="grid grid-cols-1 gap-3 mb-6 md:grid-cols-2 md:mr-20">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2" placeholder="Enter name" required>
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email address</label>
                <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2" placeholder="Enter email" required>
            </div>
            <div>
                <label for="phone_no" class="block mb-2 text-sm font-medium text-gray-900">Phone no</label>
                <input type="number" name="phone_no" id="phone_no" value="{{ ($manager->detail) ? $manager->detail->phone_no : old('phone_no') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2" placeholder="Enter phone no">
            </div>
            <div>
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                <input type="text" name="address" id="address" value="{{ ($manager->detail) ? $manager->detail->address : old('address') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2" placeholder="Enter address">
            </div>
            <div>
                <label for="city" class="block mb-2 text-sm font-medium text-gray-900">City</label>
                <select id="city" name="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                    <option selected>Choose a city</option>
                    <option value="ygn" {{ ($manager->detail && $manager->detail->city == 'ygn') ? 'selected' : ''}}>Yangon</option>
                    <option value="mdy" {{ ($manager->detail && $manager->detail->city == 'mdy') ? 'selected' : ''}}>Mandalay</option>
                    <option value="npw" {{ ($manager->detail && $manager->detail->city == 'npw') ? 'selected' : ''}}>Nay Pyi Daw</option>
                    <option value="bgo" {{ ($manager->detail && $manager->detail->city == 'bgo') ? 'selected' : ''}}>Bago</option>
                </select>
            </div>
            <div>
                <label for="country" class="block mb-2 text-sm font-medium text-gray-900">Country</label>
                <select id="countries" name="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                    <option selected>Choose a country</option>
                    <option value="my" {{ ($manager->detail && $manager->detail->country == 'my') ? 'selected' : ''}}>Myanmar</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label for="url" class="block mb-2 text-sm font-medium text-gray-900">Website</label>
                <input type="text" name="url" id="url" value="{{ ($manager->detail) ? $manager->detail->url : old('url') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2" placeholder="Enter your website url">
            </div>
        </div>
    </form>
</div>

<script>
    document.querySelector('.panel1').classList.add('bg-gray-100');
    document.getElementById("profile").onchange = function() {
        document.getElementById("upload").submit();
    };
    var url = document.getElementById("url").innerHTML;
    function copyUrl(){
        navigator.clipboard.writeText(url);
    }
    const changeForm = document.querySelector('#change-form');
    function openChange(){
        changeForm.classList.toggle('hidden');
    }
</script>

@endsection