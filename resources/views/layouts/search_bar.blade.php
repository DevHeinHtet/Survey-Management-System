

<div id="search-form" class="hidden bg-[#0000006b] flex fixed z-50 inset-0 justify-center items-center">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative md:w-[35rem] bg-white rounded-md border-2 shadow dark:bg-gray-700 p-4">
            <form action="{{route('manager.survey.search')}}" id="search">
                <div class="relative w-full border-b-2">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="text" id="search_box" class="bg-gray-100 border-0 text-gray-900 text-md bg-transparent w-full focus:ring-0 pl-10 p-2" placeholder="Search survey">
                </div>
            </form>
            <ul class="h-80 py-4 overflow-x-auto">
                <p class="text-md">Enter a search term to find results in the survey.</p>
            </ul>
        </div>
    </div>
</div>

<script>
    const search_box = document.getElementById('search_box');
    search_box.addEventListener("keyup", function(e) {
        // document.getElementById('search').preventDefault().submit();
    });
    var outerEl = document.getElementById("search-form"); 
    outerEl.addEventListener("click", function(e){ 
        if(e.target === outerEl){ 
            outerEl.classList.add('hidden');
        } 
    }); 
</script>