@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center h-14 bg-white px-8">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center font-bold space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
            <span class="inline-flex items-center text-sm text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                home
            </span>
            </li>
            <li>
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <span class="ml-1 text-sm text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                    dashboard
                </span>
            </div>
            </li>
        </ol>
    </nav>
    <div>
       <form action="{{route('manager.home')}}" method="get">
            <input type="month" onkeydown="return false" name="format" value="{{$year.'-'.$monthNo}}" onchange="this.form.submit()" id="monthYear" class="border-2 border-gray-500 rounded-md text-sm">
       </form>
    </div>
</div>
<div class="p-4 md:p-8 space-y-3">
    <div class="grid lg:grid-cols-7 gap-3">
        <div class="flex-col lg:col-span-5 space-y-3">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
    
                {{-- Current month total survey count card --}}
                <div class="flex items-center bg-white rounded-md drop-shadow-md px-6 py-8 space-x-3">
                    <div class="w-12 h-12 flex justify-center items-center bg-gray-200 rounded-full shadow-inner shadow-blue-400">
                        <i class="fa-solid fa-list text-blue-600" style="font-size: 20px"></i>       
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold">{{ $dashboard->sum('count'); }}</span>
                        <span class="text-xs font-bold text-gray-500">Survey</span>
                    </div>
                </div>
    
                {{-- Current day total survey count card --}}
                <div class="flex items-center bg-white rounded-md drop-shadow-md px-4 py-6 space-x-3">
                    <div class="w-12 h-12 flex justify-center items-center bg-gray-200 rounded-full shadow-inner shadow-green-400">
                        <i class="fa-solid fa-calendar-day text-green-600" style="font-size: 20px"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold">{{ $dashboard->whereDate('date',Carbon\Carbon::now())->sum('count'); }}</span>
                        <span class="text-xs font-bold text-gray-500">Today</span>
                    </div>
                </div>
    
                {{-- Current day total surveyor count card --}}
                <div class="flex items-center bg-white rounded-md drop-shadow-md px-4 py-6 space-x-3">
                    <div class="w-12 h-12 flex justify-center items-center bg-gray-200 rounded-full shadow-inner shadow-green-400">
                        <i class="fa-solid fa-user text-yellow-600" style="font-size: 20px"></i>            
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold">{{ $common[2] }}</span>
                        <span class="text-xs font-bold text-gray-500">Surveyor</span>
                    </div>
                </div>
    
                {{-- Total rejected survey for current month --}}
                <div class="flex items-center bg-white rounded-md drop-shadow-md px-4 py-6 space-x-3">
                    <div class="w-12 h-12 flex justify-center items-center bg-gray-200 rounded-full shadow-inner shadow-red-400">
                        <i class="fa-solid fa-trash text-red-500" style="font-size: 20px"></i>          
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold">{{ $dashboard->where('status','rejected')->sum('count'); }}</span>
                        <span class="text-xs font-bold text-gray-500">Rejected</span>
                    </div>
                </div>
    
            </div>
    
            <div class="grid md:col-span-3">
                <div class="grid md:grid-cols-5 gap-3">
                    <div class="grid md:col-span-3 bg-white h-80 overflow-x-auto rounded-md p-4 drop-shadow-md">
                        <p class="text-md text-gray-900 font-bold px-2">Monthly Overview</p>
                        <div class="px-4">
                            @include('components.overall_bar_chart')
                        </div>
                    </div>
                    <div class="grid md:col-span-2 space-y-3 h-80 bg-white rounded-md p-4 drop-shadow-md">
                        <div class="flex items-center">
                            <span class="text-md font-bold">Survey Details</span>
                        </div>
                        <div class="p-4 h-60 flex justify-center items-center">
                            @include('components.year_pie')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="grid lg:col-span-2 bg-white rounded-md p-2 drop-shadow-md">
            @include('components.home_map')
        </div>
    </div>
    <div class="bg-white rounded-md p-4 drop-shadow-md">
        <p class="text-md text-gray-900 font-bold px-2">Online Status</p>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-4">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Email
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Position
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staffs as $staff)
                    @if ($staff->isStaffOnline())
                    <tr class="bg-white border-b dark:bg-gray-800 hover:bg-gray-50">
                        <td class="py-4 px-6">
                            {{ $staff->name }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $staff->email }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $staff->position }}
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"></div> 
                                Online
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">

    const menuItems = document.querySelector('.side_bar_home').classList.add('text-white');
    
</script>

@endsection