@extends('frontEnd.layout')
@section('title', 'Student')
@section('content')
    <style>
        .heading-title>h3 {
            text-align: center;
            font-size: 20px;
            color: #fff;
            margin: 0;
            padding: 7px 0px;
            background: #353866;
            border-radius: 5px;
        }

        .table-striped>tbody>tr:nth-child(odd)>td,
        .table-striped>tbody>tr:nth-child(odd)>th {
            color: #000;
            font-size: 15px;
        }

        table>thead>tr>th {
            text-align: center;
        }

        .heading-title {}
    </style>
    <section id="inner-headline">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('Home') }}"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i>
                        </li>
                        @if ($WebmasterSection->id != 1)
                            <?php
                            $title_var = 'title_' . @Helper::currentLanguage()->code;
                            $title_var2 = 'title_' . env('DEFAULT_LANGUAGE');
                            if (@$WebmasterSection->$title_var != '') {
                                $WebmasterSectionTitle = @$WebmasterSection->$title_var;
                            } else {
                                $WebmasterSectionTitle = @$WebmasterSection->$title_var2;
                            }
                            ?>
                            <li class="active">{!! $WebmasterSectionTitle !!}</li>
                        @else
                            <li class="active">{{ __('Student') }}</li>
                        @endif
                        @if (!empty($CurrentCategory))
                            <?php
                            $title_var = 'title_' . @Helper::currentLanguage()->code;
                            $title_var2 = 'title_' . env('DEFAULT_LANGUAGE');
                            if (@$CurrentCategory->$title_var != '') {
                                $CurrentCategoryTitle = @$CurrentCategory->$title_var;
                            } else {
                                $CurrentCategoryTitle = @$CurrentCategory->$title_var2;
                            }
                            ?>
                            <li class="active"><i class="icon-angle-right"></i>{{ $CurrentCategoryTitle }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <h3>ছাত্রদের তালিকা</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="heading-title">
                        <h3>শ্রেণি . {{ $department->name }}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ক্রমিক</th>
                                <th>নাম</th>
                                <th>শ্রেণি</th>
                                <th>রোল নং</th>
                                <th>ঠিকানা</th>
                                <th>মোবাইল নম্বর</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->department->name }}</td>
                                    <td>{{ $student->roll }}</td>
                                    <td>{{ $student->address }}</td>
                                    <td>{{ $student->phone }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('footerInclude')
    @if (count($Topic->maps) > 0)
        @foreach ($Topic->maps->slice(0, 1) as $map)
            <?php
            $MapCenter = $map->longitude . ',' . $map->latitude;
            ?>
        @endforeach
        <?php
        $map_title_var = 'title_' . @Helper::currentLanguage()->code;
        $map_details_var = 'details_' . @Helper::currentLanguage()->code;
        ?>
        <script type="text/javascript" src="//maps.google.com/maps/api/js?key={{ env('GOOGLE_MAPS_KEY') }}"></script>

        <script type="text/javascript">
            // var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';
            var iconURLPrefix = "{{ asset('assets/dashboard/images/') . '/' }}";
            var icons = [
                iconURLPrefix + 'marker_0.png',
                iconURLPrefix + 'marker_1.png',
                iconURLPrefix + 'marker_2.png',
                iconURLPrefix + 'marker_3.png',
                iconURLPrefix + 'marker_4.png',
                iconURLPrefix + 'marker_5.png',
                iconURLPrefix + 'marker_6.png'
            ]

            var locations = [
                @foreach ($Topic->maps as $map)
                    ['<?php echo '<strong>' . $map->$map_title_var . '</strong>' . '<br>' . $map->$map_details_var; ?>', <?php echo $map->longitude; ?>, <?php echo $map->latitude; ?>, <?php echo $map->id; ?>,
                        <?php echo $map->icon; ?>
                    ],
                @endforeach
            ];

            var map = new google.maps.Map(document.getElementById('google-map'), {
                zoom: 6,
                draggable: false,
                scrollwheel: false,
                center: new google.maps.LatLng(<?php echo $MapCenter; ?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    icon: icons[locations[i][4]],
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        </script>
    @endif
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            "use strict";

            @if ($WebmasterSection->comments_status)
                //Comment
                $('form.commentForm').submit(function() {

                    var f = $(this).find('.form-group'),
                        ferror = false,
                        emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;

                    f.children('input').each(function() { // run all inputs

                        var i = $(this); // current input
                        var rule = i.attr('data-rule');

                        if (rule !== undefined) {
                            var ierror = false; // error flag for current input
                            var pos = rule.indexOf(':', 0);
                            if (pos >= 0) {
                                var exp = rule.substr(pos + 1, rule.length);
                                rule = rule.substr(0, pos);
                            } else {
                                rule = rule.substr(pos + 1, rule.length);
                            }

                            switch (rule) {
                                case 'required':
                                    if (i.val() === '') {
                                        ferror = ierror = true;
                                    }
                                    break;

                                case 'minlen':
                                    if (i.val().length < parseInt(exp)) {
                                        ferror = ierror = true;
                                    }
                                    break;

                                case 'email':
                                    if (!emailExp.test(i.val())) {
                                        ferror = ierror = true;
                                    }
                                    break;

                                case 'checked':
                                    if (!i.attr('checked')) {
                                        ferror = ierror = true;
                                    }
                                    break;

                                case 'regexp':
                                    exp = new RegExp(exp);
                                    if (!exp.test(i.val())) {
                                        ferror = ierror = true;
                                    }
                                    break;
                            }
                            i.next('.validation').html('<i class=\"fa fa-info\"></i> &nbsp;' + (
                                ierror ? (i.attr('data-msg') !== undefined ? i.attr(
                                    'data-msg') : 'wrong Input') : '')).show();
                            !ierror ? i.next('.validation').hide() : i.next('.validation').show();
                        }
                    });
                    f.children('textarea').each(function() { // run all inputs

                        var i = $(this); // current input
                        var rule = i.attr('data-rule');

                        if (rule !== undefined) {
                            var ierror = false; // error flag for current input
                            var pos = rule.indexOf(':', 0);
                            if (pos >= 0) {
                                var exp = rule.substr(pos + 1, rule.length);
                                rule = rule.substr(0, pos);
                            } else {
                                rule = rule.substr(pos + 1, rule.length);
                            }

                            switch (rule) {
                                case 'required':
                                    if (i.val() === '') {
                                        ferror = ierror = true;
                                    }
                                    break;

                                case 'minlen':
                                    if (i.val().length < parseInt(exp)) {
                                        ferror = ierror = true;
                                    }
                                    break;
                            }
                            i.next('.validation').html('<i class=\"fa fa-info\"></i> &nbsp;' + (
                                ierror ? (i.attr('data-msg') != undefined ? i.attr(
                                    'data-msg') : 'wrong Input') : '')).show();
                            !ierror ? i.next('.validation').hide() : i.next('.validation').show();
                        }
                    });
                    if (ferror) return false;
                    else var str = $(this).serialize();
                    var xhr = $.ajax({
                        type: "POST",
                        url: "{{ route('commentSubmit') }}",
                        data: str,
                        success: function(msg) {
                            if (msg == 'OK') {
                                $("#sendmessage").addClass("show");
                                $("#errormessage").removeClass("show");
                                $("#comment_name").val('');
                                $("#comment_email").val('');
                                $("#comment_message").val('');
                            } else {
                                $("#sendmessage").removeClass("show");
                                $("#errormessage").addClass("show");
                                $('#errormessage').html(msg);
                            }

                        }
                    });
                    console.log(xhr);
                    return false;
                });
            @endif

            @if ($WebmasterSection->order_status)

                //Order
                $('form.orderForm').submit(function() {

                    var f = $(this).find('.form-group'),
                        ferror = false,
                        emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;

                    f.children('input').each(function() { // run all inputs

                        var i = $(this); // current input
                        var rule = i.attr('data-rule');

                        if (rule !== undefined) {
                            var ierror = false; // error flag for current input
                            var pos = rule.indexOf(':', 0);
                            if (pos >= 0) {
                                var exp = rule.substr(pos + 1, rule.length);
                                rule = rule.substr(0, pos);
                            } else {
                                rule = rule.substr(pos + 1, rule.length);
                            }

                            switch (rule) {
                                case 'required':
                                    if (i.val() === '') {
                                        ferror = ierror = true;
                                    }
                                    break;

                                case 'minlen':
                                    if (i.val().length < parseInt(exp)) {
                                        ferror = ierror = true;
                                    }
                                    break;

                                case 'email':
                                    if (!emailExp.test(i.val())) {
                                        ferror = ierror = true;
                                    }
                                    break;

                                case 'checked':
                                    if (!i.attr('checked')) {
                                        ferror = ierror = true;
                                    }
                                    break;

                                case 'regexp':
                                    exp = new RegExp(exp);
                                    if (!exp.test(i.val())) {
                                        ferror = ierror = true;
                                    }
                                    break;
                            }
                            i.next('.validation').html('<i class=\"fa fa-info\"></i> &nbsp;' + (
                                ierror ? (i.attr('data-msg') !== undefined ? i.attr(
                                    'data-msg') : 'wrong Input') : '')).show();
                            !ierror ? i.next('.validation').hide() : i.next('.validation').show();
                        }
                    });
                    if (ferror) return false;
                    else var str = $(this).serialize();
                    var xhr = $.ajax({
                        type: "POST",
                        url: "{{ route('orderSubmit') }}",
                        data: str,
                        success: function(msg) {
                            if (msg == 'OK') {
                                $("#ordersendmessage").addClass("show");
                                $("#ordererrormessage").removeClass("show");
                                $("#order_name").val('');
                                $("#order_phone").val('');
                                $("#order_email").val('');
                                $("#order_message").val('');
                            } else {
                                $("#ordersendmessage").removeClass("show");
                                $("#ordererrormessage").addClass("show");
                                $('#ordererrormessage').html(msg);
                            }

                        }
                    });
                    //console.log(xhr);
                    return false;
                });
            @endif
        });
    </script>

@endsection
