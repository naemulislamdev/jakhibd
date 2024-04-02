@extends('dashboard.layouts.master')
@section('title', 'Search')
@section('content')
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            margin: 0;
        }


        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #030303;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #030303;
        }

        .heading-row {
            text-align: center;
            color: #000;
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

        .sheet-heading-box {
            width: 100%;
            display: flex;
            padding: 15px 12px;
            border: 1px solid #000;
        }

        .sheet-heading-box>.logo>img {
            width: 100px;
            padding: 6px;
        }

        .sheet-heading-box>.logo {
            width: 15%;
        }

        .sheet-heading-box>.seet-heading {
            width: 80%;
            text-align: center;
        }

        .sheet-heading-box>.seet-heading>h3 {}

        .sheet-heading-box>.seet-heading>h4 {}

        .sheet-heading-box>.seet-heading>h5 {}
    </style>
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <button class="btn btn-fw primary" id="printButton">
                    <i class="fa fa-chevron-left"></i>
                    Print
                </button>
            </div>

            <div class="box-body" id="printResult">
                <div class="sheet-heading-box">
                    <div class="logo">
                        <img src="{{ asset('assets/default/print-logo.png') }}" alt="">
                    </div>
                    @php
                        use Rakibhstu\Banglanumber\NumberToBangla;

                        $numto = new NumberToBangla();
                    @endphp
                    <div class="seet-heading">
                        <h3><b>জামিয়া আরাবিয়া খদিমুল ইসলাম মাদরাসা ও এতিমখানা</b></h3>
                        <h5>মিরপুর-১৩, ঢাকা-১২১৬, বাংলাদেশ</h5>
                        <h4>{{ $results->first()->exam_type }}</h4>
                        <h3>নম্বরপত্র - {{ $numto->bnNum($results->first()->year) }}</h3>

                    </div>
                </div>
                <div class="table-responsive">
                    <table>

                        <tbody>
                            <tr>
                                <td colspan="4" class="heading-row">শ্রেণি .
                                    {{ $results->first()->student->department->name }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">রোল নং: {{ $numto->bnNum($results->first()->student->roll) }}</td>
                                <td colspan="1">সিট নং:
                                    @if ($results->first()->student->reg)
                                        {{ $numto->bnNum(@$results->first()->student->reg) }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                            </tr>
                            <tr>
                                <td style="" colspan="2">নাম: {{ $results->first()->student->name }}</td>
                                <td colspan="1">জন্ম তারিখ:
                                    {{ $results->first()->student->date_of_birth }}</td>

                            </tr>
                            <tr>
                                <td colspan="4">জন্ম তারিখ: {{ $results->first()->student->date_of_birth }}</td>
                            </tr>
                            <tr>
                                <td colspan="4">পিতার নাম: {{ $results->first()->student->father_name }}</td>
                            </tr>
                            <tr>
                                <td colspan="4">মাদরাসার নাম: জামিয়া আরাবিয়া খদিমুল ইসলাম মাদরাসা ও এতিমখানা</td>
                            </tr>
                            <tr>
                                <td colspan="4">ঠিকানা: ব্লক-এ (টিনশেড কলোনী), সেকশন-১৩, থানা: কাফরুল, মিরপুর, ঢাকা-১২১৬।
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                            <tr>
                                <th style="width:20%; text-align:center;">ক্রমিক নং</th>
                                <th style="width:45%; text-align:center;">বিষয়</th>
                                <th style="width:30%; text-align:center;">প্রাপ্ত নম্বর</th>
                            </tr>

                            @foreach ($results as $result)
                                <tr style="width: 100%;">
                                    <td style="width:20%; text-align:center;">{{ $numto->bnNum($loop->index + 1) }}</td>
                                    <td style="width:45%">{{ $result->subject->name }}</td>
                                    <td style="width:30%; text-align:center;">{{ $numto->bnNum($result->mark) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th style=" text-align:right;" colspan="2">মোট প্রাপ্ত নম্বর</th>
                                <th style="width:50%; text-align:center;">{{ $numto->bnNum($total_marks) }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('after-scripts')
    <script src="{{ asset('assets/frontend/js/printThis.js') }}"></script>
    <script type="text/javascript">
        $('#printButton').click(function() {
            $('#printResult').printThis();
        })
    </script>
@endpush
