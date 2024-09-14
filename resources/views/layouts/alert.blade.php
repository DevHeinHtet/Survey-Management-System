{{-- Confirmation Alert Promp --}}
<div class="promp hidden bg-[#0000006b] flex fixed z-50 inset-0 justify-center items-center">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow shadow-gray-700">
            <button type="button" onclick="cancel()" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                </svg>
                <h3 class="alert_text mb-5 text-lg font-normal text-gray-500"></h3>
                <a href="" class="link text-white focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </a>
                <button type="button" onclick="cancel()" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No, cancel</button>
            </div>
        </div>
    </div>
</div>
{{-- End Confirmation Alert Promp --}}

<script>
    const promp = document.querySelector('.promp');
    const link = document.querySelector('.link');
    const text = document.querySelector('.alert_text');
    function cancel(){
        promp.classList.toggle('hidden');
    }


    setTimeout(() => {
        const toast = document.getElementById('form-error');
        toast.style.display = "none";
    }, 3000);
</script>