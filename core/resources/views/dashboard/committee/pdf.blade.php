<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta charset="UTF-8"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Design</title>
    {{-- <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bangla-font.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/SolaimanLipi_22-02-2012.ttf')}}"> --}}
    <style>
        /* Basic reset */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            margin: 0;
        }
        @font-face{
            src : url("asset('assets/dashboard/css/SolaimanLipi_22-02-2012.ttf')")
            font-family:"SolaimanLipiNormal" !important;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #030303;
            background-color: #fdfd5c;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #030303;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }

        .heading-row {
            background-color: #4f87db;
            text-align: center;
            color: #fff;
            font-size: 20px;
        }

        /* Responsive table */
        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            thead {
                display: none;
            }

            tr {
                border-bottom: 2px solid #ddd;
                display: block;
                margin-bottom: 10px;
            }

            td {
                border-bottom: none;
                display: block;
                text-align: right;
                /* Align text to the right for better readability */
            }

            td:before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
        }
    </style>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th colspan="5" class="heading-row">{{$type->name}}</th>
            </tr>
            <tr>
                <td>নং</td>
                <td>পদবী</td>
                <td>নাম</td>
                <td>ঠিকানা</td>
                <td>মোবাইল</td>
            </tr>
        </thead>
        <tbody>
            @foreach($committees as $committee)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$committee->title}}</td>
                <td>{{$committee->name}}</td>
                <td>{{$committee->address}}</td>
                <td>{{$committee->phone}}</td>
            </tr>
            @endforeach
            <!-- Add more rows as needed -->
        </tbody>
    </table>

</body>

</html>
