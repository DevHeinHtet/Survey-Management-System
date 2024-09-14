@extends('layouts.app')

@section('content')
@include('layouts.message')
{{-- tabs nav --}}
<div class="flex justify-between items-center bg-white px-8">

	<nav class="flex h-14">
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
					detail
				</span>
				</div>
			</li>
		</ol>
	</nav>

	<a title="detail update" href="{{ route('manager.staff.edit', ['id' => $staff->hash]) }}" class="bg-blue-500 px-6 py-1 rounded-md ring-1 ring-offset-2 ring-blue-500 hover:ring-offset-blue-500">
		<span class="text-sm text-white">Update</span>
	</a>

</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 md:p-8">
	{{-- Profile Detail --}}
	<div class="flex flex-col justify-center bg-white rounded-md drop-shadow-md shadow-gray-400 space-y-4 p-8">
		<div class="flex justify-center mt-2">
			<img class="object-cover w-32 h-32 rounded-full" src="{{$staff->profile_name}}" alt="image description"> 
		</div>
		<div>
			<p class="flex justify-center text-xl font-bold text-gray-800">{{ $staff->name }}</p>
			<p class="flex justify-center text-md text-gray-500">{{ $staff->position }}</p>
		</div>

		<div class="text-sm">
			<div class="px-2 py-1">
				<p class="text-gray-900">Email</p>
				<a href="mailto:{{$staff->email}}" class="text-gray-500 text-md">{{ $staff->email }}</a>
			</div>
			<div class="px-2 py-1">
				<p class="text-gray-900">Phone No</p>
				<a class="text-gray-500 text-md" href="tel:+9509429041141">{{ $staff->phone_no }}</a>
			</div>
			<div class="px-2 py-1">
				<p class="text-gray-900">Gender</p>
				<p class="text-gray-500 text-md">{{ $staff->gender }}</p>
			</div>
			<div class="px-2 py-1">
				<p class="text-gray-900">Hired Date</p>
				<p class="text-gray-500 text-md">{{$staff->created_at->format('d/m/Y')}}</p>
			</div>
			<div class="px-2 py-1">
				<p class="text-gray-900">Status</p>
				@if ($staff->is_active)
					<p class="text-green-500 text-md">Active</p>
				@else
					<p class="text-red-500 text-sm">Blocked</p>
				@endif
			</div>
		</div>
	</div>
	<div class="flex-col md:col-span-2">
		<div class="bg-white rounded-md space-y-8 p-4 drop-shadow-md shadow-gray-400">
			<span class="text-gray-900 text-lg font-bold">Time Off Balance</span>
			<div class="hidden md:block">
				<div class="flex space-x-4 justify-center mb-4">
					<div class="flex justify-center items-center rounded-full border-2 border-gray-300 w-24 h-24">
						<div class="text-gray-900">
							<p class="flex justify-center text-xl font-bold">{{ count($staff->surveys) }}</p>
							<p class="flex justify-center text-sm text-gray-500">Surveys</p>
						</div>
					</div>
	
					<div class="flex justify-center items-center rounded-full border-2 border-gray-300 w-24 h-24">
						<div>
							<p class="flex justify-center text-xl font-bold">{{ $staff->surveys->where('status','pending')->count() }}</p>
							<p class="flex justify-center text-sm text-gray-500">Pending</p>
						</div>
					</div>
	
					<div class="flex justify-center items-center rounded-full border-2 border-gray-300 w-24 h-24">
						<div>
							<p class="flex justify-center text-xl font-bold">{{ $staff->surveys->where('status','accepted')->count() }}</p>
							<p class="flex justify-center text-sm text-gray-500">Accepted</p>
						</div>
					</div>
	
					<div class="flex justify-center items-center rounded-full border-2 border-gray-300 w-24 h-24">
						<div>
							<p class="flex justify-center text-xl font-bold">{{ $staff->surveys->where('status','rejected')->count() }}</p>
							<p class="flex justify-center text-sm text-gray-500">Rejected</p>
						</div>
					</div>
					
				</div>
			</div>

			<div class="md:hidden">
				<table>
					<tr>
						<td class="px-4 py-1">Total</td>
						<td class="px-4 py-1">- {{ $staff->surveys->count() }}</td>
					</tr>
					<tr>
						<td class="px-4 py-1">Pending</td>
						<td class="px-4 py-1">- {{ $staff->surveys->where('status','pending')->count() }}</td>
					</tr>
					<tr>
						<td class="px-4 py-1">Accepted</td>
						<td class="px-4 py-1">- {{ $staff->surveys->where('status','accepted')->count() }}</td>
					</tr>
					<tr>
						<td class="px-4 py-1">Rejected</td>
						<td class="px-4 py-1">- {{ $staff->surveys->where('status','rejected')->count() }}</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="bg-white rounded-md space-y-3 md:space-y-6 p-4 mt-4 drop-shadow-md shadow-gray-400">
			<span class="text-gray-900 text-lg font-bold">Overview</span>

			{{-- Other View --}}
			<div class="overflow-auto rounded-md shadow hidden md:block">
				<table class="w-full text-sm text-left">
					<thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-500">
						<tr>
							<th class="py-4 px-6 whitespace-nowrap">
								No
							</th>
							<th class="py-4 px-6 whitespace-nowrap">
								Date
							</th>
							<th class="py-4 px-6 whitespace-nowrap">
								Business Name
							</th>
							<th class="py-4 px-6 whitespace-nowrap">
								Status
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($surveys as $survey)
						<tr class="bg-white border-b cursor-pointer hover:bg-gray-100 hover:shadow-md">
							<th class="whitespace-nowrap py-4 px-6 font-medium">
								{{ $loop->index+1 }}
							</th>
							<td class="whitespace-nowrap py-4 px-6">
								{{ date('d-m-Y  h:i A',strtotime($survey->created_at)) }}
							</td>
							<td class="whitespace-nowrap py-4 px-6">
								{{ $survey->business_name }}
							</td>
							<td class="whitespace-nowrap py-2 px-6">
								<div class="flex justify-center items-center w-7 h-7 rounded-full border {{ ($survey->status == 'pending') ? 'bg-blue-500' : ($survey->status == 'accepted' ? 'bg-green-500' : 'bg-red-500') }}">
									<i class="{{ ($survey->status == 'pending') ? 'fa-solid fa-spinner' : ($survey->status == 'accepted' ? 'fa-solid fa-check' : 'fa-solid fa-xmark') }} text-white" style="font-size: 14px"></i>
								</div>
							</td>
						</tr>
						@endforeach
						@if ( count($surveys) == 0)
						<tr>
						<th colspan="4">
							<div class="flex justify-center items-center h-16">
							<span>
								No Data Found
							</span>
							</div>
						</th>
						</tr>
						@endif
					</tbody>
				</table>
				<div class="py-2">
					{!! $surveys->render() !!}
				</div>
			</div>

			{{-- Mobile View --}}
			<div class="grid grid-cols-1 gap-4 md:hidden">
				@foreach ( $surveys as $survey )
				<div class="space-y-3 bg-gray-200 p-4 rounded-md shadow-md">
					<div class="flex items-center space-x-2">
						<div class="text-gray-900">{{$survey->business_name}}</div>
						<div class="px-2 {{ ($survey->status == 'pending') ? 'bg-blue-400' : ($survey->status == 'accepted' ? 'bg-green-400' : 'bg-red-400') }} text-white text-sm rounded-md">{{ $survey->status }}</div>
					</div>
					<div class="text-sm text-gray-500">
						{{ date('d-m-Y  h:i A',strtotime($survey->created_at)) }}
					</div>
				</div>
				@endforeach
				<div class="py-2">
					{!! $surveys->render() !!}
				</div>
			</div>

		</div>
	</div>
</div>

<script>
	const menuItems = document.querySelector('.side_bar_staff').classList.add('text-white');
</script>
@endsection