@extends('layouts.app')

@section('content')
	@include('layouts.message')

<div class="flex justify-between items-center h-14 bg-white px-8">
	<nav class="flex">
		<ol class="inline-flex items-center font-bold space-x-1 md:space-x-3">
			<li class="inline-flex items-center">
				<span class="inline-flex items-center text-sm text-gray-700 hover:text-gray-900 dark:text-gray-400">
				home
				</span>
			</li>
			<li>
				<div class="flex items-center">
					<svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
					<a href="{{route('manager.staff', ['status' => 'list'])}}" class="ml-1 text-sm text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">staff</a>
				</div>
			</li>
			<li>
				<div class="flex items-center">
				<svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
				<span class="ml-1 text-sm text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400">
					edit
				</span>
				</div>
			</li>
		</ol>
	</nav>
	<button type="button" onclick="resetPass()" class="text-white text-sm mr-4 bg-red-500 px-6 py-2 rounded-md ring-1 ring-offset-2 ring-red-500 hover:ring-offset-red-500">Reset Password</button>

</div>

	<div class="m-4 md:m-8 p-4 md:p-8 bg-white rounded-md drop-shadow-md shadow-gray-400">
		<form action="{{route('manager.staff.update',['id' => $staff->hash])}}" method="post" autocomplete="false" enctype="multipart/form-data">
			@csrf
            <div class="flex mb-4 md:mb-8">
				<span class="text-2xl text-gray-700 font-bold md:text-3xl">Account Update</span>
			</div>

			@if(count($errors) > 0)
				<div id="form-error" class="text-red-800 bg-gray-200 p-4 mb-4 text-xs rounded-sm">
					@foreach($errors->all() as $error)
						<span>{{ $error }}</span><br>
					@endforeach
				</div>
            @endif

			<div class="grid gap-2 md:gap-6 mb-6 md:grid-cols-2 px-4">
				<div>
					<label for="name" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
					<input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Enter your name" value="{{ $staff->name }}" required>
				</div>
				<div>
					<label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Address</label>
					<input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Enter your email" value="{{ $staff->email }}" required>
				</div>
				<div>
					<label for="phone_no" class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
					<input type="number" name="phone_no" id="phone_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Enter phone no" value="{{ $staff->phone_no }}" required>
				</div>  
				<div>
					<label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Profile</label>
					<input name="profile" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none" id="file_input" type="file">	
				</div>
				<div>
					<label for="position" class="block mb-2 text-sm font-medium text-gray-900">Select position</label>
					<select id="position" name="position" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5">
						<option value="staff" {{ ($staff->position == 'staff' ? 'selected' : '')}}>Staff</option>
						<option value="supervisor" {{ ($staff->position == 'supervisor' ? 'selected' : '')}}>Supervisor</option>
					</select>
				</div>
				<div class="md:col-span-2">
					<label for="gender" class="block mb-4 text-sm font-medium text-gray-900">Gender</label>
					<div class="flex space-x-2">
						<div class="flex items-center">
							<input type="radio" {{ $staff->gender == "Male" ? 'checked' : ''}} value="Male" name="gender" class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 focus:ring-gray-500">
							<label for="male" class="ml-2 text-sm font-medium text-gray-900">Male</label>
						</div>
						<div class="flex items-center">
							<input type="radio" {{ $staff->gender == "Female" ? 'checked' : ''}} value="Female" name="gender" class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 focus:ring-gray-500">
							<label for="male" class="ml-2 text-sm font-medium text-gray-900">Female</label>
						</div>
					</div>
				</div>
			</div>
			<div class="px-4">
			<button type="submit" class="text-white bg-blue-500 text-sm py-2 w-full md:w-40 rounded-md shadow-md ring-1 ring-offset-2 ring-blue-500 hover:ring-offset-blue-500">Update Now</button>
			</div>
		</form>
	</div>

	<script>
		function loadFile(event) {
			var image = document.getElementById('output');
			image.src = URL.createObjectURL(event.target.files[0]);
		};
		const menuItems = document.querySelector('.side_bar_staff').classList.add('text-white');

        function resetPass(){
			text.innerHTML = "Are you sure you want to reset password?";
			link.href = "{{ url("/manager/staff/reset-password/$staff->hash") }}";
			link.classList.add("bg-gray-600")
			link.classList.add("hover:bg-gray-800");
			promp.classList.toggle('hidden');
		}
		
	</script>
@endsection