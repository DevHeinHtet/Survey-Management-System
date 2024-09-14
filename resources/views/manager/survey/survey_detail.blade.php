@extends('layouts.app')
@section('content')
@include('layouts.message')

<div class="flex justify-between items-center h-14 bg-white px-8">
    <nav class="flex">
        <ol class="inline-flex font-bold items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
            <span class="inline-flex items-center text-sm text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                home
            </span>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <a href="{{route('manager.survey.list', ['status' => 'pending'])}}" class="ml-1 text-sm text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">survey</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <span class="ml-1 text-sm text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                detail
                </span>
            </div>
            </li>
        </ol>
    </nav>
    <div class="flex space-x-4">
        @if ($survey->status != "accepted")
            <button title="accept" type="button" onclick="accept()" class="flex justify-center text-white px-6 py-2.5 space-x-2 rounded-md transition duration-300 ease bg-green-500 ring-1 ring-offset-2 ring-green-500 ring-offset-green-200 hover:ring-offset-green-500">
                <i class="fa-sharp fa-solid fa-check" style="font-size: 14px"></i>
            </button>
        @endif

        @if ($survey->status != "rejected")
            <button title="reject" type="button" onclick="reject()" class="flex justify-center text-white px-6 py-2.5 space-x-2 rounded-md transition duration-300 ease bg-red-500 ring-1 ring-offset-2 ring-red-500 ring-offset-red-200 hover:ring-offset-red-500">
                <i class="fa-sharp fa-solid fa-ban" style="font-size: 14px"></i>
            </button>
        @endif
    </div>
</div>

<div class="p-4 md:p-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 font-serif">
        {{-- Survey Detail --}}
        <div class="flex-col md:col-span-2 bg-white rounded-md drop-shadow-md shadow-gray-400 p-4 md:p-8">
    
            <div class="font-bold p-1">
                <div class="text-3xl">
                    {{$survey->business_name}}
                </div>
                <div class="text-xl mt-2 italic">
                    {{$survey->business_type}}
                </div>
            </div>
            <div class="px-4">
                <div class="text-lg font-bold mt-4 md:mt-8">
                    {{$survey->owner_name}}
                </div>
                <div class="text-md mt-4">
                    <span class="font-bold">Address: </span>
                    <span class="text-gray-600">{{$survey->address}}</span>
                </div>
                <div class="text-md mt-3">
                    <span class="font-bold">Phone No: </span>
                    <span class="text-gray-600"><a href="tel:+9509429041141">{{ $survey->phone_no }}</a></span>
                </div>
                <div class="text-md mt-3">
                    <span class="font-bold">Surveyor: </span>
                    <span class="text-gray-600">{{$survey->staff->name}}</span>
                </div>
                <div class="text-lg font-semibold mt-3">
                    Remark
                </div>
                <div class="max-h-80 overflow-auto text-md mt-2 p-1">
                    {{$survey->staff_remark}}
                </div>
            </div>
    
        </div>
        {{-- Survey Photo --}}
        <div class="flex justify-center items-center h-full bg-white p-4 rounded-md drop-shadow-md shadow-gray-400">
            <img src="{{asset('/storage/images/'.$survey->photo)}}" class="max-h-[30rem]" alt="picture">
        </div>
    </div>
    
    <div class="grid md:grid-cols-2 gap-3 mt-3 ">
        <div class="flex justify-center items-center bg-white rounded-md drop-shadow-md shadow-gray-400 p-2">
            <div id="map" class="h-[350px] w-full z-10 rounded-md"></div>
        </div>
        <div class="bg-white rounded-md drop-shadow-md shadow-gray-400 p-4 md:p-8">
            <form action="{{url("/manager/survey/update/$survey->hash/manager-remark") }}" 
                method="post" autocomplete="off"> 
                @csrf
                <h1 class="text-lg font-bold mb-3">Manager Remark</h1>
                <textarea id="manager_remark" name="manager_remark" rows="10" class="block outline-none p-2.5 w-full mb-6 text-sm rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Manager Remark...">{{$survey->manager_remark}}</textarea>
                <div class="flex justify-between items-center">
                    <button type="submit" 
                        class="px-6 py-1.5 rounded-md bg-blue-500 ring-1 ring-offset-2 ring-blue-500 ring-offset-blue-200 hover:ring-offset-blue-500 text-white transition ease duration-300">
                        <span class="text-xs font-bold">Update Remark</span>
                    </button>
                    @if (auth()->user()->position == 'manager')
                    <a 
                        href="{{ url("/manager/survey/update-form/$survey->hash") }}"
                        class="px-6 py-1.5 rounded-md ring-2 ring-offset-4 ring-blue-500 ring-offset-blue-200 hover:ring-offset-blue-500 transition ease duration-300">
                        <span class="text-xs text-blue-500 font-bold">Update >></span>
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const menuItems = document.querySelector('.side_bar_survey').classList.add('text-white');

    function accept(){
        text.innerHTML = "Are you sure you want to accept this survey?";
        link.href = "{{ url("/manager/survey/accept/$survey->hash") }}";
        link.classList.add("bg-green-600")
        link.classList.add("hover:bg-green-800");
        promp.classList.toggle('hidden');
    }

    function reject(){
        text.innerHTML = "Are you sure you want to reject this survey?";
        link.href = "{{ url("/manager/survey/reject/$survey->hash") }}";
        link.classList.add("bg-red-600")
        link.classList.add("hover:bg-red-800");
        promp.classList.toggle('hidden');
    }
    
</script>

<script>
    var map = L.map('map');
    map.setView([{{$survey->latitude_logitude}}],16);
    var marker = L.marker([{{$survey->latitude_logitude}}]).addTo(map);
    var circle = L.circle([{{$survey->latitude_logitude}}], {
        fillOpacity: 0.5,
        radius: 300
    }).addTo(map);
    marker.bindPopup("{{$survey->business_name}}").openPopup();
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 50,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
</script>
@endsection