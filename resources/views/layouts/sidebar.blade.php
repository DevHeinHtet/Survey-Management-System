<div class="sidebar fixed top-0 bottom-0 z-40 left-[-270px] xl:left-0 w-[270px] bg-gray-800 shadow-xl shadow-[#3d4d66]">
   <div class="relative h-screen text-white">
      <div class="h-56 flex flex-col relative justify-center items-center border-b border-b-gray-50 dark:border-b-white">
         <img src="{{Auth::user()->getProfile()}}" class="w-20 h-20 object-contain rounded-full bg-white mb-2" alt="Logo">
         <span class="text-lg font-bold">{{Auth::user()->name}}</span>
         <span class="text-sm font-bold">{{Auth::user()->email}}</span>
         <i class="fa-sharp fa-solid absolute top-4 right-4 fa-xmark ml-20 cursor-pointer xl:hidden" onclick="Open()"></i>
      </div>
      <ul class="mt-4 text-gray-400 space-y-1">
         <li>
            <a href="{{route('manager.home')}}" class="side_bar_home flex items-center hover:translate-x-2 w-full px-6 py-3 space-x-3 duration-300">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
               </svg>                
               <span class="text-[12px] font-bold">Dashboard</span>
            </a>
         </li>
         <li>
            <a href="{{route('manager.index')}}" class="side_bar_profile flex items-center hover:translate-x-2 w-full px-6 py-3 space-x-3 duration-300">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
               </svg>                               
               <span class="text-[12px] font-bold">Profile</span>
            </a>
         </li>
         <li>
            <a href="{{route('manager.survey.list', ['status' => 'pending'])}}" class="side_bar_survey flex items-center hover:translate-x-2 w-full px-6 py-3 space-x-3 duration-300">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
               </svg>
               <span class="text-[12px] font-bold">Survey</span>
            </a>
         </li>
         <li>
            <a href="{{route('manager.staff', ['status' => 'list'])}}" class="side_bar_staff flex items-center hover:translate-x-2 w-full px-6 py-3 space-x-3 duration-300">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
               </svg> 
               <span class="text-[12px] font-bold">Staff</span>
            </a>
         </li>
         <li>
            <a href="{{route('manager.report', ['type' => 'business'])}}" class="side_bar_report flex items-center hover:translate-x-2 w-full px-6 py-3 space-x-3 duration-300">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
               </svg>
               <span class="text-[12px] font-bold">Report</span>
            </a>
         </li>
      </ul>
      <button onclick="logout()" class="absolute bottom-4 left-0 right-0 flex text-gray-800 items-center space-x-2 px-6 py-3 bg-white mx-2 rounded-md">
         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
         </svg>
         <span class="text-[14px] font-bold" >Logout</span>
      </button>
   </div>
</div>

<script>
   function logout(){
			text.innerHTML = "Are you sure you want to logout?";
			link.href = "{{ route('manager.logout') }}";
			link.classList.add("bg-gray-600")
			link.classList.add("hover:bg-gray-800");
			promp.classList.toggle('hidden');
		}
</script>

