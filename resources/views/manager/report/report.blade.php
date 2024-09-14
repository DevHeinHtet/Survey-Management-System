@extends('layouts.app')

@section('content')
<nav class="flex h-14 bg-white px-8">
	<ol class="inline-flex items-center font-bold space-x-1 md:space-x-3">
		<li class="inline-flex items-center">
			<span class="inline-flex items-center text-sm text-gray-700 hover:text-gray-900 dark:text-gray-400">
			home
			</span>
		</li>
		<li>
			<div class="flex items-center">
			<svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
			<span class="ml-1 text-sm text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">
			report
			</span>
		</div>
		</li>
		<li>
			<div class="flex items-center">
			<svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
			<span class="ml-1 text-sm text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400">
				{{$type}}
			</span>
			</div>
		</li>
	</ol>
</nav>

<div class="m-4 md:m-8 md:flex space-y-4 md:space-x-4 md:space-y-0">
	<div class="w-full md:w-[30%] bg-white rounded-md shadow-md shadow-gray-400">	
		<ul class="flex justify-center md:block space-x-2 md:space-y-2 md:space-x-0 p-2 md:p-4">
			<li>
			   <a href="{{ route('manager.report', ['type' => 'business']) }}" class="report flex items-center p-4 text-sm font-normal rounded-lg hover:bg-gray-700 hover:text-white {{ ($type=='business') ? 'bg-gray-700 text-white' : 'text-gray-900'}}">
				<i class="fa-solid fa-business-time"></i>
				  <span class="ml-3">Business</span>
			   </a>
			</li>
			<li>
				<a href="{{ route('manager.report', ['type' => 'surveyor']) }}" class="report flex items-center p-4 text-sm font-normal rounded-lg hover:bg-gray-700 hover:text-white {{ ($type=='surveyor') ? 'bg-gray-700 text-white' : 'text-gray-900'}}">
					<i class="fa-solid fa-user-clock"></i>
				   <span class="ml-3">Surveyor</span>
				</a>
			 </li>
		</ul>
	</div>

	@if ($type == 'business')
		@include('manager.report.business')
	@endif
	@if ($type == 'surveyor')
		@include('manager.report.surveyor')
	@endif
</div>

<script src="https://unpkg.com/flowbite@1.5.3/dist/datepicker.js"></script>

<script>
	const range = document.querySelector("#radio-day-range");
	const month = document.querySelector("#radio-month");
	const day = document.querySelector("#radio-day");
	const year = document.querySelector("#radio-year");
	const first = document.getElementById("first_date");
	const second = document.getElementById("second_date");
	const choose_year = document.getElementById("year");
	const period = document.querySelector(".period");
	period.addEventListener('change',function(){
		if(period.value == "range"){
			first.type = "date";
			first.classList.remove('hidden');
			second.classList.remove('hidden');
			choose_year.classList.add('hidden')
		}else if(period.value == 'month'){
			first.type = "month";
			first.classList.remove('hidden');
			second.classList.add('hidden');
			choose_year.classList.add('hidden')
		}else if(period.value == 'day'){
			first.type = "date";
			first.classList.remove('hidden');
			second.classList.add('hidden');
			choose_year.classList.add('hidden')
		}else{
			first.classList.add('hidden');
			second.classList.add('hidden');
			choose_year.classList.remove('hidden')
		}
	})
	const menuItems = document.querySelector('.side_bar_report').classList.add('text-white');

</script>
@endsection
