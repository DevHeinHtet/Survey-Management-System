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
                <a href="{{route('manager.survey.list', ['status' => 'pending'])}}" class="ml-1 text-sm text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">survey</a>
            </div>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <span class="ml-1 text-sm text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400">
                update
                </span>
            </div>
      </li>
    </ol>
</nav>

<div class="font-serif p-4 md:p-8">
    <form action="{{url("/manager/survey/update/$survey->hash") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4">

            <div class="bg-white rounded-md drop-shadow-md shadow-gray-400 p-4" >
                <div class="text-2xl font-bold">
                    Survey Update Form
                </div>
                <div class="p-1 md:p-4">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="business_name" class="block mb-2 text-lg font-medium text-gray-900">Business Name</label>
                            <input type="text" name="business_name" value="{{$survey->business_name}}" id="owner_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="owner name" required>
                        </div>
                        <div>
                            <label for="business_type" class="block mb-2 text-lg font-medium text-gray-900">Business Type</label>
                            <input type="text" name="business_type" value="{{$survey->business_type}}" id="business_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="business name" required>
                        </div>
                        <div>
                            <label for="owner_name" class="block mb-2 text-lg font-medium text-gray-900">Owner Name</label>
                            <input type="text" name="owner_name" value="{{$survey->owner_name}}" id="business_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="business type" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-md drop-shadow-md shadow-gray-400 p-4" >
                <div class="text-2xl font-bold">
                    Detail
                </div>
                <div class="p-1 md:p-4">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="address" class="block mb-2 text-lg font-medium text-gray-900">Address</label>
                            <input type="text" name="address" value="{{$survey->address}}" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="address" required>
                        </div>

                        <div>
                            <label for="phone_no" class="block mb-2 text-lg font-medium text-gray-900">Phone No</label>
                            <input type="number" name="phone_no" value="{{$survey->phone_no}}" id="phone_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="phone number" required>
                        </div>

                        <div>
                            <label for="latitude_logitude" class="block mb-2 text-lg font-medium text-gray-900">Location (latitude-logitude)</label>
                            <input type="text" name="latitude_logitude" value="{{$survey->latitude_logitude}}" id="latitude_logitude" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="location" required>
                        </div>

                        <div>
                            <label for="file" class="block mb-2 text-lg font-medium text-gray-900">File</label>
                            <input id="file" accept="image/*" name="photo" type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">    
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-md drop-shadow-md shadow-gray-400 p-4" >
                <div class="text-2xl font-bold">
                    Surveyor
                </div>
                <div class="p-1 md:p-4">
                    <div class="grid md:grid-cols-2 gap-4">

                        <div>
                            <label for="suveyor_name" class="block mb-2 text-lg font-medium text-gray-900">Suveyor Name</label>
                            <input type="text" id="suveyor_name" value="{{$survey->staff->name}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="suveyor name" disabled required>
                        </div>

                        <div>
                            <label for="date" class="block mb-2 text-lg font-medium text-gray-900">Date</label>
                            <input type="text" id="date" value="{{ date('d-m-Y  h:i A',strtotime($survey->created_at)) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="date" disabled required>
                        </div>

                        <div class="md:col-span-2">
                            <label for="remark" class="block mb-2 text-lg font-medium text-gray-900">Remark</label>
                            <div class="max-h-60 overflow-y-auto rounded-lg bg-gray-50 p-2.5 border border-gray-300">
                                {{$survey->staff_remark}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end p-4">
                    <button type="submit" class="bg-blue-600 px-6 md:px-12 py-2 rounded-md transition duration-300 ease ring-1 ring-offset-2 ring-indigo-300 ring-offset-indigo-200 hover:ring-offset-indigo-500 focus:outline-none">
                        <span class="text-white text-sm font-bold">Update Now</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    const menuItems = document.querySelector('.side_bar_survey').classList.add('text-white');   
</script>
@endsection