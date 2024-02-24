@extends('frontEnd.layout')
@section('title', 'বিভাগ')
@section('content')
    <style>
        .department-box{
            margin-bottom: 7px;
        }
        .d-heading-box {
            display: flex;
            background: #7c7c7c;
            padding: 6px 6px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .d-heading-box>.fa {
            padding: 3px 7px;
            font-size: 17px;
            color: #2e3e4e;
        }

        .d-heading-box>p {
            font-size: 19px;
            font-weight: 600;
            margin: 0;
            color: #fff;
        }

        .bg-heading {
            background: #ddd;
        }

        .d-sub-namue {
            background: #ddd;
            margin: 0;
            padding: 4px 31px;
        }

        .d-sub-namue>li {
            list-style: inside;
            font-size: 14px;
            font-weight: 600;
        }
    </style>
    <section id="inner-headline">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('Home') }}"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i>
                        </li>
                        <li class="active">বিভাগসমূহ</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    @foreach ($departments as $department)
                        <div class="department-box">
                            <a data-toggle="collapse" href="#collapseData_{{ $department->id }}" role="button"
                                aria-expanded="false" aria-controls="collapseData_{{ $department->id }}">
                                <div class="d-heading-box">
                                    <i class="fa fa-plus-circle"></i>
                                    <p>{{ $department->name }}</p>

                                </div>
                            </a>
                            <div class="collapse" id="collapseData_{{ $department->id }}">
                                <div class="card card-body">
                                    <ul class="d-sub-namue">
                                        @foreach ($department->subDepartment as $sub_department)
                                            <li>{{ $sub_department->name }}</li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footerInclude')
    <script>
        $(document).ready(function() {
            $('.cat-list li').addClass('fnd');

            function counter_set() {
                $('.cat-list').each(function() {
                    var cnt = $(this).children('.cat-list li.fnd').length;

                    $(this).parent().parent().parent().find('.incat-count').text(cnt);
                });
            }

            counter_set();

            $('.srch').keyup(function() {
                var txt = $(this).val().toLowerCase();
                $('.cat-list li').filter(function() {
                    var mt = $(this).text().toLowerCase().indexOf(txt) > -1;
                    $(this).toggle(mt);
                    $(this).toggleClass('fnd', mt);
                });
                counter_set();
            });



        });
    </script>
@endsection
