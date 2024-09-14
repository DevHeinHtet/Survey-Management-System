@if (Session::get('success') || Session::get('fail'))
<div id="toast" class="flex absolute w-full max-w-xs top-0.5 right-8 rounded-sm items-center text-white {{ (Session::get('success') ? 'bg-green-500' : 'bg-red-500') }} px-4 py-3 shadow-sm space-x-4">
    <i class="{{ (Session::get('success') ? 'fa-solid fa-check' : 'fa-solid fa-xmark') }}" style="font-size: 20px"></i>
    <div class="flex flex-col">
        <span class="text-sm font-bold">{{ (Session::get('success') ? 'Success' : 'Fail') }}</span>
        <span class="text-xs">{{ (Session::get('success') ? Session::get('success') : Session::get('fail')) }}</span>
    </div>
</div>

<script>
    setTimeout(() => {
        const toast = document.getElementById('toast');
        toast.style.display = "none";
    }, 3000);
</script>

@endif 