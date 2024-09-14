@extends('layouts.app')

@section('content')
@include('layouts.message')

<div class="flex flex-col md:flex-row">
    <aside class="w-full md:w-80 h-40 md:min-h-screen bg-white shadow-md">
        <div class="overflow-y-auto py-4 px-3 rounded">
            <h1 class="px-3 py-4 text-lg font-bold">
                Control Panel
            </h1>
           <ul class="md:space-y-2 mt-4 flex flex-row md:flex-col">
              <li>
                 <a href="{{route('manager.index')}}" class="panel1 flex items-center p-2.5 text-sm font-normal text-gray-900 rounded-md hover:bg-gray-100">
                    <span class="mx-3">Profile</span>
                 </a>
              </li>
              @if (auth()->user()->position == 'manager')
               <li>
                  <a href="{{route('manager.list')}}" class="panel2 flex items-center p-2.5 text-sm font-normal text-gray-900 rounded-md hover:bg-gray-100">
                     <span class="flex-1 mx-3 whitespace-nowrap">Manager List</span>
                  </a>
               </li>
               <li>
                  <a href="{{route('manager.createAccount')}}" class="panel3 flex items-center p-2.5 text-sm font-normal text-gray-900 rounded-md hover:bg-gray-100">
                     <span class="flex-1 mx-3 whitespace-nowrap">Create Account</span>
                  </a>
               </li>
              @endif
           </ul>
        </div>
    </aside>
    <div class="w-full">
        @yield('manager_content')
    </div>
</div>
<script type="text/javascript">
    const menuItems = document.querySelector('.side_bar_profile').classList.add('text-white');
</script>
@endsection