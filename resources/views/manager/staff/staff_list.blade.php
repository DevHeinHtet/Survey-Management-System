@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center h-14 bg-white px-8">
    <nav class="flex">
        <ol class="inline-flex items-center font-bold space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
            <span class="inline-flex items-center text-sm text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                home
            </span>
            </li>
            <li>
                <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
				@if ($status == 'list')
				<span class="ml-1 text-sm text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">
					staff
					</span>
				@else
				<a href="{{route('manager.staff', ['status' => 'list'])}}" class="ml-1 text-sm text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">staff</a>
				@endif
            </div>
            </li>
			<li>
                <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <span class="ml-1 text-sm text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                {{$status}}
                </span>
            </div>
            </li>
        </ol>
    </nav>
    <div class="flex space-x-4">
        @if ($status == 'list')
		<a title="suspended list" href="{{ route('manager.staff', ['status' => 'suspended']) }}" 
			class="text-white flex items-center px-6 py-2 bg-red-500 space-x-2 rounded-md ring-1 ring-offset-2 ring-red-500 hover:ring-offset-red-500">
			<i class="fa-sharp fa-solid fa-ban"></i>
		</a>
		@endif
		<a title="add staff" href="{{ route('manager.staff.add') }}" 
			class="text-white flex items-center px-6 py-2 bg-green-500 space-x-2 rounded-md ring-1 ring-offset-2 ring-green-500 hover:ring-offset-green-500">
			<i class="fa-sharp fa-solid fa-plus"></i>
		</a>
    </div>
</div>

<div class="p-8">
	<div class="flex space-x-2">
		<div class="grid justify-items-end relative">
			<button class="select-btn text-white bg-gray-700 hover:bg-gray-700 focus:ring-2 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm px-4 py-2.5 text-center inline-flex items-center space-x-2" type="button">
				<span>Filters</span>
				
			</button>
			<div id="dropdown" class="absolute left-0 top-10 hidden mt-1 z-10 w-22 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
				<ul class="py-1 text-sm text-gray-700">
					<li class="items">
					<a href="{{route("manager.staff", ['status' => 'list'])}}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Default</a>
					</li>
					<li class="items">
					
					<a href="{{route('manager.staff', ['status' => $status, 'orderby' => 'name'])}}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Name</a>
					</li>
					<li class="items">
					<a href="{{route('manager.staff', ['status' => $status, 'orderby' => 'phone_no'])}}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ph No</a>
					</li>
					<li class="items">
					<a href="{{route('manager.staff', ['status' => $status, 'orderby' => 'position'])}}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Position</a>
					</li>
				</ul>
			</div>
		</div>
		<form action="{{route("manager.staff", ['status' => $status])}}" method="get"  autocomplete="off"> 
			<div class="">
				<input type="text" name="search" onchange="searchChange()" value="{{ Request('search') }}" placeholder="Search by name/position" class="font-serif bg-white border border-gray-500 text-gray-900 text-md rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full px-4 py-2 shadow">
			</div>
		</form>
	</div>

	{{-- Other View --}}
	<div class="hidden md:block">
		<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-4">
			@foreach ($staffs as $staff)
			<div class="p-2 bg-white rounded-md drop-shadow-md shadow-gray-400">

				<div class="py-2">
					<div class="flex justify-center">
						<img src="{{ $staff->profile_name }}" class="w-24 h-24 object-contain rounded-full border border-gray-400" alt="image">
					</div>
					<div>
						<p class="flex justify-center text-md font-bold truncate text-gray-800 mt-2">{{ $staff->name }}</p>
						<p class="flex justify-center text-sm text-gray-500">{{ $staff->position }}</p>
					</div>
				</div>

				<div class="bg-gray-100 border px-3 py-4 rounded-md text-xs text-gray-900">
					
					<div class="flex justify-between items-center">
						<div>
							<p class="text-gray-500">Gender</p>
							<p>{{$staff->gender}}</p>
						</div>
						<div>
							<p class="text-gray-500">Hired Date</p>
							<p>{{$staff->created_at->format('d/m/Y')}}</p>
						</div>
					</div>

					<div class="flex items-center space-x-2 mt-4">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
						</svg>
						<span>
							{{ str_replace(substr($staff->email,3,strlen($staff->email)-15), '...', $staff->email) }}
						</span>
					</div>

					<div class="flex items-center space-x-2 mt-1">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
						</svg>								  
						<span>
							{{ $staff->phone_no }}
						</span>
					</div>
				</div>

				<div class="flex justify-center my-2">
					<div class="flex justify-between space-x-4 mt-2">
						@if ($status == 'list')
						<button title="suspend" type="button" onclick="suspend({{$staff->id}})" class="bg-red-500 text-white px-4 py-1 rounded-lg ring-1 ring-offset-2 ring-red-500 hover:ring-offset-red-500">
							<span class="text-xs">Suspend</span>
						</button>
						@else
						<a title="reactive" href="{{ url("/manager/staff/reactive/$staff->hash") }}" class="bg-green-500 text-white px-4 py-1 rounded-lg ring-1 ring-offset-2 ring-green-500 hover:ring-offset-green-500">
							<span class="text-xs">Reactive</span>
						</a>
						@endif	
						<a title="detail" href="{{ url("/manager/staff/detail/$staff->hash") }}" class="bg-blue-500 text-white px-4 py-1 rounded-lg ring-1 ring-offset-2 ring-blue-500 hover:ring-offset-blue-500">
							<span class="text-xs">Detail</span>
						</a>
					</div>  
				</div>

			</div>
			@endforeach
		</div>
	</div>

	{{-- Mobile View --}}
	<div class="mt-3 md:hidden space-y-2">
		@foreach ($staffs as $staff)
		<div class="bg-white p-3 rounded-md shadow-md shadow-gray-400">
			<div class="flex justify-between">
				<div class="flex items-center space-x-3">
					<a href="{{ url("/manager/staff/detail/$staff->hash") }}">
						<div class="relative">
							<svg xmlns="http://www.w3.org/2000/svg"  class="absolute bottom-0.5 right-0.5 bg-white border border-gray-700 w-4 h-4 p-0.5 rounded-full" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
								@if ($staff->position == 'supervisor')
									<path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
								@else
									<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
								@endif
							</svg>	
								
							<img src="{{ $staff->profile_name }}" class="w-16 h-16 rounded-full p-1 border border-gray-800" alt="image">
						</div>
					</a>
					<div class="space-y-1">
						<div class="text-md overflow-x-hidden">{{ $staff->name }}</div>
						<div class="text-xs">{{ $staff->phone_no }}</div>
					</div>
				</div>
				<div class="flex items-center">
					<div class="mr-3">
						@if ($status == 'list')
							<button title="suspend" type="button" onclick="suspend({{$staff->id}})" class="text-red-700">
								<i class="fa-sharp fa-solid fa-ban" style="font-size: 22px"></i>
							</button>
						@else
							<a title="reactive" href="{{ url("/manager/staff/reactive/$staff->hash") }}" class="text-green-700">
								<i class="fa-sharp fa-solid fa-rotate-left" style="font-size: 22px;"></i>
							</a>
						@endif
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>

	@if (count($staffs) == 0)
	<div class="h-60 flex justify-center items-center">
		<span class="text-3xl font-bold">No Data Found</span>
	</div>
	@endif

	<div class="justify-items-end py-4"">
		{{ $staffs->links() }}
	</div>
</div>

<script>
	const selectBtn = document.querySelector(".select-btn"),
	items = document.querySelectorAll(".items"),
	listItem = document.querySelector("#dropdown");
	selectBtn.addEventListener("click",()=>{
		listItem.classList.toggle('hidden');
	})
	items.forEach(item => {
		item.addEventListener("click", () => {
			listItem.classList.toggle('hidden');
		});
	});

    const menuItems = document.querySelector('.side_bar_staff').classList.add('text-white');

	function suspend($id){
		var url = '{{ url("manager/staff/suspend/:id") }}';
		url = url.replace(':id', $id);
		text.innerHTML = "Are you sure you want to suspend this surveyor?";
		link.href = url;
		link.classList.add("bg-red-600")
		link.classList.add("hover:bg-red-800");
		promp.classList.toggle('hidden');
	}
</script>
@endsection