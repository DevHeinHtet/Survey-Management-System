<div class="w-full md:w-[70%] h-full bg-white rounded-md shadow-md shadow-gray-400 p-3">
	<form action="{{route('manager.report.surveyor.export')}}" class="md:p-4" method="post">
		@csrf
		<h1 class="text-3xl mb-6 text-center">Surveyor Report</h1>

		<div class=" mt-3">
			<ul class="items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex">
				<li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
					<div class="flex items-center pl-3">
						<input id="excel" value="excel" type="radio" checked name="report_type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
						<label for="excel" class="py-3 ml-2 w-full text-sm font-medium text-gray-900">Excel</label>
					</div>
				</li>
				<li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
					<div class="flex items-center pl-3">
						<input id="print" value="print" type="radio" name="report_type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
						<label for="print" class="py-3 ml-2 w-full text-sm font-medium text-gray-900">Print</label>
					</div>
				</li>
			</ul>

		</div>

		<div class="grid grid-cols-2 space-x-2 text-sm mt-3">
			<div class="space-y-2">
				<label for="small" class="">Surveyor Name</label>
				<select name="staff_id" class="p-2.5 w-full bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
					@foreach ($staffs as $staff)
						<option value="{{$staff['id']}}">{{$staff['name']}}</option>
					@endforeach
				</select>
			</div>
			<div class="space-y-2">
				<label for="small" class="">Status</label>
				<select name="status" class="p-2.5 w-full bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
					<option value="all">All</option>
					<option value="pending">Pending</option>
					<option value="accepted">Accepted</option>
					<option value="rejected">Rejected</option>
				</select>
			</div>
		</div>

		<div class="space-y-2 mt-3 text-sm">
			<label for="small" class="">Business Type</label>
			<select name="business_type" class="p-2.5 w-full bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
				<option value="all">All</option>
				@foreach ($types as $type)
					<option value="{{$type['business_type']}}">{{$type['business_type']}}</option>
				@endforeach
			</select>
		</div>
		<div class="space-y-2 mt-3 text-sm">
			<label for="">Period</label>
			<select name="period" class="period p-2.5 w-full bg-gray-50 rounded-md border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
				<option id="radio-day-range" value="range">Day Range</option>
				<option id="radio-month" value="month">Month</option>
				<option id="radio-day" value="day">Day</option>
				<option id="radio-year" value="year">Year</option>
			</select>
		</div>

		<div class=" my-4 space-y-2">
			<input type="date" id="first_date" name="first_date" max="{{ Carbon\Carbon::now()->toDateString() }}" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm w-full pl-10 p-2.5">
			<input type="date" id="second_date" name="second_date" max="{{ Carbon\Carbon::now()->toDateString() }}" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm  w-full pl-10 p-2.5">
			<select id="year" name="choose_year" class="hidden bg-gray-50 border border-gray-300 text-gray-900 rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full text-sm p-2.5 pl-8">
				@foreach ($years as $year)
				<option value="{{$year}}">{{$year}}</option>
				@endforeach
			  </select>
		</div>

		<div class="mt-4">
			<button type="submit" class="w-full text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-sm font-bold text-center p-3">Export</button>
		</div>
	</form>
</div>