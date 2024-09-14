@extends('manager.profile.index')
@section('manager_content')

<div class="p-8 overflow-y-auto">
    <span class="text-3xl font-bold">Create Account</span>
   <div class="mt-4">
    <form action="{{ route('manager.accountCreate') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(count($errors) > 0)
        <div id="form-error" class="text-red-800 bg-gray-200 p-4 mb-4 text-xs rounded-sm">
            @foreach($errors->all() as $error)
                    <span>{{ $error }}</span><br>
                @endforeach
            </div>
        @endif
        <div class="grid grid-cols-1 gap-3 md:gap-6 my-8 md:grid-cols-2 md:mr-20">
            <div class="row-span-2 flex justify-center">
                <div class="flex">
                    <div class="bg-gray-300 rounded-xl shadow-md">
                        <label for="file" class="">
                            <img  id="img-preview" class="w-40 h-40 bg-white rounded-xl cursor-pointer hover:border-2 hover:border-gray-300" src="{{ asset('src/camera.jpg') }}" alt="Profile Image">      
                        </label>
                    </div>
                    <input type="file" multiple="false" onchange="profileImage()" accept="image/*" name="file" id="file" class="hidden">
                </div>
            </div>
            
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2" placeholder="Enter name" required>
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2" placeholder="Enter email" required>
            </div>
            <div>
                <label for="phone_no" class="block mb-2 text-sm font-medium text-gray-900">Phone no</label>
                <input type="number" name="phone_no" id="phone_no" value="{{ old('phone_no') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2" placeholder="Enter phone no">
            </div>
            <div>
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2" placeholder="Enter address">
            </div>
            <div>
                <label for="city" class="block mb-2 text-sm font-medium text-gray-900">City</label>
                <select id="city" name="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                    <option selected>Choose a city</option>
                    <option value="ygn">Yangon</option>
                    <option value="mdy">Mandalay</option>
                    <option value="npw">Nay Pyi Daw</option>
                    <option value="bgo">Bago</option>
                </select>
            </div>
            <div>
                <label for="country" class="block mb-2 text-sm font-medium text-gray-900">Country</label>
                <select id="countries" name="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                    <option selected>Choose a country</option>
                    <option value="my">Myanmar</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label for="url" class="block mb-2 text-sm font-medium text-gray-900">Website</label>
                <input type="text" name="url" id="url" value="{{ old('url') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full py-2" placeholder="Enter your website url">
            </div>
        </div>
        <div>
            <button type="submit" class="flex items-center justify-center w-full md:w-auto space-x-1 border-2 border-blue-500 rounded-full px-6 py-1.5 text-blue-700 hover:bg-blue-500 hover:text-white">
                <i class="fa-solid fa-check"></i>
                <span class="text-sm">Register</span>
            </button>
        </div>
    </form>
   </div>
    
</div>
<script type="text/javascript">
    document.querySelector('.panel3').classList.add('bg-gray-100');
    const imgPreview = document.getElementById("img-preview");

    function profileImage() {
        var file = document.getElementById('file').files;
        if(file.length > 0){
            var fileReader = new FileReader();
            fileReader.onload = function(event){
                imgPreview.setAttribute('src',event.target.result)
            };
            fileReader.readAsDataURL(file[0]);
        }
    }
</script>
@endsection