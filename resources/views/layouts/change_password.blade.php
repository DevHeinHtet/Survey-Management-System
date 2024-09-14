<div id="change-form" class="bg-[#0000006b] {{ (count($errors) ? '' : 'hidden') }}  bg-blur-sm flex fixed z-50 inset-0 justify-center items-center">
    <div class="">
        <div class="relative bg-white rounded-md border-2 shadow mx-2">
            <div class="px-4 py-2.5 border-b border-gray-500">
                <span class="text-lg">Change password</span>
            </div>
            <form action="{{route('manager.changePassword')}}" method="POST">
                @csrf
                @if(count($errors) > 0)
                <div id="form-error" class="text-red-800 bg-gray-200 p-4 m-2 text-xs rounded-sm">
                @foreach($errors->all() as $error)
                            <span class="py-1 text-red-500">{{ $error }}</span><br>
                        @endforeach
                    </div>
                @endif
                <div class="flex flex-col justify-center px-4 md:px-12 py-4 space-y-2">
                    
                    <table class="w-full text-sm text-right text-gray-500">
                        <tr>
                            <th class="py-1 px-2 text-xs font-bold text-gray-900">Current password
                            </th>
                            <td class="py-1 px-2">
                                <input type="password" name="current_pass" class="text-sm w-60 text-gray-900 rounded-md" >
                            </td>
                        </tr>
                        <tr>
                            <th class="py-1 px-2 text-xs font-bold text-gray-900">New password
                            </th>
                            <td class="py-1 px-2">
                                <input type="password" name="new_pass" class="text-sm w-60 text-gray-900 rounded-md">
                            </td>
                        </tr>
                        <tr>
                            <th class="py-1 px-2 text-xs font-bold text-gray-900">Confirm new password
                            </th>
                            <td class="py-1 px-2">
                                <input type="password" name="c_new_pass" class="text-sm w-60 text-gray-900 rounded-md">
                            </td>
                        </tr>
                        <tr>
                            <th>
                            </th>
                            <td class="py-2 px-2 text-left">
                                <button type="submit" class="text-white text-xs bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-4 py-2.5">Change Password</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.getElementById('change-form').onclick = function(e) {
        if(e.target != document.getElementById('content-area')) {
            console.log('You clicked outside');
        }
    }
    var outerEl = document.getElementById("change-form"); 
    outerEl.addEventListener("click", function(e){ 
        if(e.target === outerEl){ 
            outerEl.classList.add('hidden');
        } 
    }); 
</script>