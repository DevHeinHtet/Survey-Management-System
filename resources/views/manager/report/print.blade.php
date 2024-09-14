<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/svg" sizes="16x16" href="{{asset('src/logo.svg')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js">
    </script><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>{{ $type }}</title>
</head>
<body class="font-serif p-3">
    <div class="text-center text-3xl py-1">
        <span>{{$type}}</span>
    </div>
    @if (!empty($staff))
        <div class="text-center text-2xl py-1">
            <span>Surveyor - {{ $staff->name }}</span>
        </div>
    @endif
    <div class="text-center text-xl py-1">
        <span>{{ $titleDate }}</span>
    </div>
    <div class="px-10 py-6">
        <table class="w-full text-base text-left text-gray-700">
            <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        No
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Business Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Business type
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Owner Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Phone No
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Address
                    </th>
                    @if ($type == "Business Report")
                    <th scope="col" class="py-3 px-6">
                        Surveyor
                    </th>
                    @endif
                    <th scope="col" class="py-3 px-6">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1;
                @endphp
                @foreach ($data as $report)
                    <tr class="bg-white border-b">
                        <td class="py-4 px-6">
                            {{ $count }}
                        </td>
                        @php
                            $count ++;
                        @endphp
                        <td class="py-4 px-6">
                            {{ $report->business_name }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $report->business_type }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $report->owner_name }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $report->phone_no }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $report->address }}
                        </td>
                        @if ($type == "Business Report")
                        <td scope="col" class="py-3 px-6">
                            {{$report->staff->name}}
                        </td>
                        @endif
                        <td class="py-4 px-6">
                            @if ($report->status == 'accepted')
                            <i class="fa-regular fa-circle-check" style="font-size: 18px"></i>
                            @endif
                            @if ($report->status == 'rejected')
                            <i class="fa-regular fa-circle-xmark" style="font-size: 18px"></i>
                            @endif
                            @if ($report->status == 'pending')
                            <i class="fa-sharp fa-solid fa-spinner" style="font-size: 18px"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>