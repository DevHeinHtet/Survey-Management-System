@extends('manager.profile.index')
@section('manager_content')

<div class="p-8">
    <span class="text-3xl font-bold">Manager List</span>

    <div class="overflow-x-auto relative  bg-white border-2 border-gray-300 sm:rounded-lg mt-8">
        <table class="w-full text-sm text-left">
            <thead class="text-sm font-bold text-gray-800 border-b border-gray-400 uppercase ">
                <tr>
                    <th scope="col" class="py-5 px-6">
                        Name
                    </th>
                    <th scope="col" class="py-5 px-6">
                        Phone no
                    </th>
                    <th scope="col" class="py-5 px-6">
                        Address
                    </th>
                    <th scope="col" class="py-5 px-6">
                        Country
                    </th>
                    <th scope="col" class="py-5 px-6">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $manager)
                <tr class="bg-white border-b border-gray-400 text-gray-800 hover:bg-gray-200 cursor-pointer">
                    <td class="py-2 px-6 truncate">
                        <div class="flex items-center space-x-1">
                            <img src="{{$manager->getProfile()}}" class="w-12 h-12 rounded-full bg-white border" alt="">
                            <div class="flex flex-col">
                                <span>{{$manager->name}}</span>
                                <span class="text-xs">{{$manager->email}}</span>
                            </div>
                        </div>
                    </td>
                    <td class="py-2 px-6 truncate">
                        {{($manager->detail) ? $manager->detail->phone_no : ''}}
                    </td>
                    <td class="py-2 px-6 truncate">
                        {{($manager->detail) ? $manager->detail->address : ''}}
                    </td>
                    <td class="py-2 px-6 truncate">
                        {{($manager->detail) ? $manager->detail->getCountry() : ''}}
                    </td>
                    <td class="py-2 px-6">
                        <a href="{{route('manager.edit',['id'=> $manager->hash])}}" class="font-medium hover:underline"><i class="fa-regular fa-pen-to-square" style="font-size: 18px"></i></a>
                    </td>
                </tr>
                @endforeach
                @if (count($list) == 0)
                <tr>
                    <td colspan="6" class="h-40 text-3xl text-center">
                        No data found
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        <div class="justify-items-end py-4 px-6">
            {{ $list->links() }}
          </div>
    </div>

</div>
<script type="text/javascript">
    document.querySelector('.panel2').classList.add('bg-gray-100');
</script>
@endsection