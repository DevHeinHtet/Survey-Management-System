<div class="relative">
    <div onclick="showPicker()" class="flex cursor-pointer justify-center items-center bg-gray-200 px-4 py-1.5 space-x-2 rounded-md">
        <span class="text-xs">{{ $monthName }}</span>
        <i class="fa-solid fa-caret-down"></i>
    </div>
    <div id="month-year-picker" class="">
        <div class="text-center mb-4 font-bold text-gray-800">
            <span class="cursor-pointer px-6 py-2.5 text-sm hover:bg-gray-200 rounded-md">2022</span>
        </div>
        <div class="grid grid-cols-4">
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Jan</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Feb</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Mar</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Apr</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Jan</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Feb</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Mar</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Apr</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">May</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Jun</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Jul</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Aug</span>
            <span value="1" class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Sep</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Oct</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Nov</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Dec</span>
        </div>
    </div>
    {{-- <div id="month-year-picker" class="hidden z-10 absolute mt-2 right-0 bg-gray-100 rounded shadow-md p-4">
        <div class="text-center mb-4 font-bold text-gray-800">
            <span class="cursor-pointer px-6 py-2.5 text-sm hover:bg-gray-200 rounded-md">2022</span>
        </div>
        <div class="grid grid-cols-4">
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Jan</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Feb</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Mar</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Apr</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Jan</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Feb</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Mar</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Apr</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">May</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Jun</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Jul</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Aug</span>
            <span value="1" class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Sep</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Oct</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Nov</span>
            <span class="month-name text-xs text-center w-16 py-2.5 hover:bg-gray-200 rounded-md">Dec</span>
        </div>
    </div> --}}
</div>

<script type="text/javascript">
    const d = new Date();
    let month = d.getMonth();
    const months = document.querySelectorAll(".month-name");
    months[month].classList.add("bg-gray-200");

    const removeAllColor = () => {
        months.forEach(item => {
            item.classList.remove('bg-gray-200');
        })
    }

    const monthYear = document.getElementById('month-year-picker');
    function showPicker(){
        monthYear.classList.toggle('hidden');
    }
    months.forEach(function (item, index){
        item.addEventListener('click', () => {
            var month = item.innerHTML;
            var url = '{{ url("manager/home?month=:month") }}';
		    url = url.replace(':month', index+1);
            location.href = url;
            // removeAllColor();
            // item.classList.add('bg-gray-200');
        });
    });
</script>