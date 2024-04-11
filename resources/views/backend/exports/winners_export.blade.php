<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Winner User Data</title>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th colspan="6" style="text-align: center;width: 100%;border: 1px solid black; background-color: #bdd7ee"><b>{{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} / {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</b></th>
        </tr>
        <tr>
            <th style="text-align: center;width: 100%;border: 1px solid black; background-color: #bdd7ee"><b>SR.No.</b></th>
            <th style="text-align: center;width: 250%;border: 1px solid black; background-color: #bdd7ee"><b>Contest Name</b></th>
            <th style="text-align: center;width: 250%;border: 1px solid black; background-color: #bdd7ee"><b>User Name</b></th>
            <th style="text-align: center;width: 250%;border: 1px solid black; background-color: #bdd7ee"><b>Phone Number</b></th>
            <th style="text-align: center;width: 150%;border: 1px solid black; background-color: #bdd7ee"><b>Ranking</b></th>
            <th style="text-align: center;width: 250%;border: 1px solid black; background-color: #bdd7ee"><b>Overall (%)</b></th>
        </tr>
        </thead>
        <tbody>
        @php
            $srNo = 1;
        @endphp
        @foreach($results as $key => $data)
            @php
                $rowspan = $data['total_questions'] ?? 1;
            @endphp
{{--            @foreach($data['question_details'] as $detail)--}}
            <tr>
{{--                @if($loop->first)--}}
                <td style="text-align: center;border: 1px solid black">{{$srNo++ }}</td>
                <td style="text-align: center;border: 1px solid black">{{$data['contest_name'] ?? '' }}</td>
                <td style="text-align: center;border: 1px solid black">{{$data['user_name'] ?? '' }}</td>
                <td style="text-align: center;border: 1px solid black">{{$data['phone_number'] ?? '' }}</td>
                <td style="text-align: center;border: 1px solid black">{{$data['rank'] ?? '' }}</td>
{{--                @endif--}}
{{--                @if($loop->first)--}}
                <td style="text-align: center;border: 1px solid black">{{$data['percentage'] ?? '' }}</td>
{{--                 @endif--}}
            </tr>
{{--        @endforeach--}}
        @endforeach
        </tbody>
    </table>
    </body>
</html>

