@extends('layouts.app')
@section('content')

<nav class="flex h-14 bg-white px-8">
  <ol class="inline-flex font-bold items-center space-x-1 md:space-x-3">
    <li class="inline-flex items-center">
      <span class="inline-flex items-center text-sm text-gray-700 hover:text-gray-900 dark:text-gray-400">
        home
      </span>
    </li>
    <li>
      <div class="flex items-center">
        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        <span class="ml-1 text-sm text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400">
          survey
        </span>
      </div>
    </li>
    <li>
      <div class="flex items-center">
        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        <span class="ml-1 text-sm text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400">
          {{$status}}
        </span>
      </div>
    </li>
  </ol>
</nav>

<div class="shadow-md shadow-gray-400 rounded-md bg-white m-4 md:m-8">
  <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
    <ul class="flex flex-wrap -mb-px">
        <li class="mr-2 ml-4">
            <a href="{{route('manager.survey.list', ['status' => 'pending'])}}" class="inline-block p-4 border-b-4 border-transparent {{ ($status == 'pending') ? 'text-gray-800 border-b-gray-800 hover:border-b-gray-800' : '' }} hover:text-gray-600 hover:border-gray-300">Pending</a>
        </li>
        <li class="mr-2">
          <a href="{{route('manager.survey.list', ['status' => 'accepted'])}}" class="inline-block p-4 border-b-4 border-transparent {{ ($status == 'accepted') ? 'text-gray-800 border-b-gray-800 hover:border-b-gray-800' : '' }} hover:text-gray-600 hover:border-gray-300">Accepted</a>
        </li>
        <li class="mr-2">
            <a href="{{route('manager.survey.list', ['status' => 'rejected'])}}" class="inline-block p-4 border-b-4 border-transparent {{ ($status == 'rejected') ? 'text-gray-800 border-b-gray-800 hover:border-b-gray-800' : '' }} hover:text-gray-600 hover:border-gray-300">Rejected</a>
        </li>
    </ul>
  </div>
  <div class="flex space-x-2 py-3 px-4">
    <div class="grid justify-items-end relative">
      <button class="select-btn text-white bg-gray-700 hover:bg-gray-800 focus:ring-2 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm px-4 py-2.5" type="button">
        <span>Filters</span>
      </button>

      <div id="dropdown" class="absolute left-0 top-10 hidden mt-1 z-10 w-24 bg-white rounded divide-y divide-gray-100 shadow">
        <ul class="py-1 text-sm text-gray-700">
          <li class="items">
            <a href="{{route("manager.survey.list", ['status' => $status])}}" class="block py-2 px-4 hover:bg-gray-100">Default</a>
          </li>
          <li class="items">
            <a href="{{route("manager.survey.list", ['status' => $status, 'orderby' => 'business_name'])}}" class="block py-2 px-4 hover:bg-gray-100">Name</a>
          </li>
          <li class="items">
            <a href="{{route("manager.survey.list", ['status' => $status, 'orderby' => 'business_type'])}}" class="block py-2 px-4 hover:bg-gray-100">Type</a>
          </li>
          <li class="items">
            <a href="{{route("manager.survey.list", ['status' => $status, 'orderby' => 'created_at'])}}" class="block py-2 px-4 hover:bg-gray-100">Time</a>
          </li>
        </ul>
      </div>
    </div>

    <form action="{{route('manager.survey.list', ['status' => $status])}}" method="get"  autocomplete="off"> 
        <div class="">
          <input type="text" name="search" onchange="searchChange()" value="{{ Request('search') }}" placeholder="Search ..." class="font-serif bg-white border border-gray-500 text-gray-900 text-md rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full px-4 py-2 shadow">
        </div>
    </form>
  </div>
  <div class="px-4">
    {{-- Mobile View --}}
    <div class="md:hidden">
      @foreach ($surveys as $survey)
      <div class="mt-4 cursor-pointer relative p-4 overflow-hidden transition-all bg-gray-200 rounded-lg shadow-xl group">
        <a href="{{ url("/manager/survey/detail/$survey->hash") }}">
          <div>
            <p class="text-gray-800 text-md truncate">{{ $survey->business_name }}</p>
            <p class="text-gray-800 text-sm truncate">{{ $survey->business_type }}</p>
            <div class="flex justify-between items-center mt-1">
              <span class="text-gray-800 text-sm">{{ $survey->staff->name }}</span>
              <span class="text-xs text-gray-500">{{date('d-m-Y', strtotime($survey->created_at))}}</span>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>

    {{-- Other View --}}
    <div class="overflow-auto rounded-md shadow hidden md:block mt-4">
      <table class="w-full text-sm text-left mb-4">
        <thead class="text-gray-700 bg-gray-50 border-b border-gray-500">
          <tr>
            <th class="py-4 px-6 whitespace-nowrap">
              No
            </th>
            <th class="py-4 px-6 whitespace-nowrap">
              <div class="flex items-center">
                Date
              </div>
            </th>
            <th class="py-4 px-6 whitespace-nowrap">
              <div class="flex items-center">
                Business Name
              </div>
            </th>
            <th class="py-4 px-6 whitespace-nowrap">
              <div class="flex items-center">
                Owner Name
              </div>
            </th>
            <th class="py-4 px-6 whitespace-nowrap">
              <div class="flex items-center">
                Surveyor Name
              </div>
            </th>
            <th class="py-4 px-6 whitespace-nowrap">
              
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($surveys as $survey)
          <tr class="bg-white border-b cursor-pointer hover:bg-gray-100 hover:shadow-md">
            <th class="whitespace-nowrap py-4 px-8 font-medium">
              {{ $loop->index+1 }}
            </th>
            <td class="whitespace-nowrap py-4 px-6">
              {{date('d-m-Y', strtotime($survey->created_at))}}
            </td>
            <td class="whitespace-nowrap py-4 px-6">
              {{ $survey->business_name }}
            </td>
            <td class="whitespace-nowrap py-4 px-6">
              {{ $survey->owner_name }}
            </td>
            <td class="whitespace-nowrap py-4 px-6">
              {{ $survey->staff->name }}
            </td>
            <td class="whitespace-nowrap py-4 px-6 space-x-4">
              @if ($status == 'rejected')
                <a title="restore" href="{{ url("/manager/survey/restore/$survey->hash") }}" class="text-green-600 hover:text-green-700">
                  <i class="fa-sharp fa-solid fa-rotate-left" style="font-size: 20px"></i>
                </a>
              @endif
              
              <a title="detail" href="{{ url("/manager/survey/detail/$survey->hash") }}" class="text-blue-600 hover:text-blue-700">
                <i class="fa-sharp fa-solid fa-eye" style="font-size: 20px"></i>
              </a>
            </td>
          </tr>
          @endforeach
          @if ( count($surveys) == 0)
              <tr>
                <th colspan="5">
                  <div class="flex justify-center items-center h-16">
                    <span>
                      No Data Found
                    </span>
                  </div>
                </th>
              </tr>
          @endif
              <tr>
                <td colspan="6" class="p-2">
                  {{$surveys->links()}}
                </td>
              </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
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
    const menuItems = document.querySelector('.side_bar_survey').classList.add('text-white');

</script>

@endsection