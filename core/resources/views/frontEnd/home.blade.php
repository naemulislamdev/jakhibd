@extends('frontEnd.layout')

@section('content')
    <style>
        .section-box>p {
            color: #fff;
        }

        .site-top {
            background: #2e3e4e;
        }

        header .navbar {
            min-height: 90px;
            background: #353866;
        }

        .navbar .nav>li>a {
            color: #fff !important;
            text-shadow: none;
        }

        .flexslider .slides img {
            width: 100%;
            display: block;
            height: 57vh;
        }

        .bangla-clander {
            text-align: center;
            background: #2e3e4e;
            padding: 0px 0px;
            color: #fff;
        }

        .bangla-clander>marquee>h2 {
            color: #fff;
            font-size: 28px;
        }

        .clander-col {
            width: 100%;
            margin: 0 auto;
        }

        .clander-section {
            margin-top: 10px;
        }
    </style>

    <!-- start Home Slider -->
    @include('frontEnd.includes.slider')
    <!-- end Home Slider -->
    @php
        use Rakibhstu\Banglanumber\NumberToBangla;

        $numto = new NumberToBangla();
        $englishDate = \Carbon\Carbon::parse(now())->translatedFormat('j F Y');
        $englishDay = \Carbon\Carbon::parse(now())->translatedFormat('l');
        $timeTo = \Carbon\Carbon::now();
        $timeG = date('g', strtotime($timeTo));
        $timeM = date('i', strtotime($timeTo));
        $months = [
            'Jan' => 'জানয়িারি',
            'Feb' => 'ফেব্রুয়ারী',
            'Mar' => 'মার্চ',
            'Apr' => 'এপ্রিল',
            'May' => 'মে',
            'Jun' => 'জুন',
            'Jul' => 'জুলাই',
            'Aug' => 'আগস্ট',
            'Sep' => 'সেপ্টেম্বর',
            'Oct' => 'অক্টোবর',
            'Nov' => 'নভেম্বর',
            'Dec' => 'ডিসেম্বর',
        ];
        $your_date = date('y-m-d'); // The Current Date
        $en_month = date('M', strtotime($your_date));
        foreach ($months as $en => $ar) {
            if ($en == $en_month) {
                $ar_month = $ar;
            }
        }

        $find = ['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
        $replace = ['শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার'];
        $ar_day_format = date('D'); // The Current Day
        $ar_day = str_replace($find, $replace, $ar_day_format);

        header('Content-Type: text/html; charset=utf-8');
        $standard = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $eastern_arabic_symbols = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        $current_date = date('d') . ' ' . $ar_month . ' ' . date('Y');
        $englishToBanglaDate = str_replace($standard, $eastern_arabic_symbols, $current_date);

        // return $arabic_date;

    @endphp
    <section class="clander-section">
        <div class="clander-col">
            <div class="bangla-clander">
                <marquee onmouseover="this.stop();" onmouseout="this.start();">
                    <h2><span class="hijriDate"></span>, {{ $englishToBanglaDate }}, <span id="bongabdo"></span>,
                        সময়ঃ{{ $numto->bnNum($timeG) . ':' . $numto->bnNum($timeM) . 'মিনিট' }}</h2>
                </marquee>
            </div>
        </div>
    </section>
    <section class="my-3">
        <div class="container">
            <div class="row hilight-section">
                <div class="col-md-3">
                    <a href="{{ route('result.page') }}">
                        <div class="section-box">
                            <h4>ফলাফল</h4>
                            <p>For individuals</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('getDepartments') }}">
                        <div class="section-box">
                            <h4>বিভাগসমূহ</h4>
                            <p>For individuals</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#documents">
                        <div class="section-box">
                            <h4>ডকুমেন্টসমূহ</h4>
                            <p>For individuals</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#registration">
                        <div class="section-box">
                            <h4>রেজিস্ট্রেশন শাখা</h4>
                            <p>যোগাযোগ করুন</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    @if (!empty($HomePage))
        @if (@$HomePage->{'details_' . @Helper::currentLanguage()->code} != '')
            <section class="content-row-no-bg home-welcome">
                <div class="container">
                    {!! @$HomePage->{'details_' . @Helper::currentLanguage()->code} !!}
                </div>
            </section>
        @endif
    @endif

    @if (count($TextBanners) > 0)
        @foreach ($TextBanners->slice(0, 1) as $TextBanner)
            <?php
            try {
                $TextBanner_type = $TextBanner->webmasterBanner->type;
            } catch (Exception $e) {
                $TextBanner_type = 0;
            }
            ?>
        @endforeach
        <?php
        $title_var = 'title_' . @Helper::currentLanguage()->code;
        $title_var2 = 'title_' . env('DEFAULT_LANGUAGE');
        $details_var = 'details_' . @Helper::currentLanguage()->code;
        $details_var2 = 'details_' . env('DEFAULT_LANGUAGE');
        $file_var = 'file_' . @Helper::currentLanguage()->code;
        $file_var2 = 'file_' . env('DEFAULT_LANGUAGE');

        $col_width = 12;
        if (count($TextBanners) == 2) {
            $col_width = 6;
        }
        if (count($TextBanners) == 3) {
            $col_width = 4;
        }
        if (count($TextBanners) > 3) {
            $col_width = 3;
        }
        ?>
        <section class="homepage-event">
            <div class="container">
                <div class="row pt-3">
                    <div class="col enent-title">
                        <h3> ইভেন্টসমূহ</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="event-box">
                            <h4>লক্ষ্য ও আদর্শ অনুযায়ী জামিয়ায় বর্তমানে
                                নিম্নোক্ত বিভাগসমূহ সূচারুরূপে পরিচালিত হচ্ছে</h4>
                            <div class="event-list">
                                <ul>
                                    @foreach ($events as $event)
                                        <li>{{ $event->title_bd }}</li>
                                    @endforeach
                                    {{-- <li>হিফজুল কুরআন বিভাগ</li>
                                    <li>কিতাব বিভাগ</li>
                                    <li>ফতওয়া ও ফারায়েয বিভাগ</li>
                                    <li>তাফসীরুল কুরআন প্রশিক্ষণ কোর্স</li>
                                    <li>ক্বেরাত বিভাগ</li>
                                    <li>মাসিক দেয়ালিকা</li>
                                    <li>বক্তৃতা প্রশিক্ষণ মজলিস</li>
                                    <li>ইয়াতিমখানা ও লিল্লাহ বোর্ডিং</li> --}}
                                </ul>
                                <a href="{{ url('/events') }}" class="btn btn-info event-btn">বিস্তারিত</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Start Counter section-->
        <section class="py-5 Counter-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="counter-box text-center">
                            <i class="fa fa-thumbs-o-up"></i><br>
                            <span class="counter" style="display: inline-block; width: 32%">313</span>
                            <h4>বদরী কাফেলা</h4>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-box text-center">
                            <i class="fa fa-male"></i><br>
                            <span class="counter" style="display: inline-block; width: 32%">50</span>
                            <h4>শিক্ষক ও কর্মচারী</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-box text-center">
                            <i class="fa fa-graduation-cap"></i><br>
                            <span class="counter" style="display: inline-block; width: 32%">400</span>
                            <h4>শিক্ষার্থী</h4>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-box text-center">
                            <i class="fa fa-graduation-cap"></i><br>
                            <span class="counter" style="display: inline-block; width: 32%">34</span>
                            <h4>বছরের অভিজ্ঞ</h4>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--end Counter section-->
        <section class="content-row-no-bg p-b-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" style="margin-bottom: 0;">
                            @foreach ($TextBanners as $TextBanner)
                                <?php
                                if ($TextBanner->$title_var != '') {
                                    $BTitle = $TextBanner->$title_var;
                                } else {
                                    $BTitle = $TextBanner->$title_var2;
                                }
                                if ($TextBanner->$details_var != '') {
                                    $BDetails = $TextBanner->$details_var;
                                } else {
                                    $BDetails = $TextBanner->$details_var2;
                                }
                                if ($TextBanner->$file_var != '') {
                                    $BFile = $TextBanner->$file_var;
                                } else {
                                    $BFile = $TextBanner->$file_var2;
                                }
                                ?>
                                <div class="col-lg-{{ $col_width }}">
                                    <div class="box">
                                        <div class="box-gray aligncenter">
                                            @if ($TextBanner->code != '')
                                                {!! $TextBanner->code !!}
                                            @else
                                                @if ($TextBanner->icon != '')
                                                    <div class="icon">
                                                        <i class="fa {{ $TextBanner->icon }} fa-3x"></i>
                                                    </div>
                                                @elseif($BFile != '')
                                                    <img src="{{ URL::to('uploads/banners/' . $BFile) }}"
                                                        alt="{{ $BTitle }}" />
                                                @endif
                                                <h4>{!! $BTitle !!}</h4>
                                                @if ($BDetails != '')
                                                    <p>{!! nl2br($BDetails) !!}</p>
                                                @endif
                                            @endif

                                        </div>
                                        @if ($TextBanner->link_url != '')
                                            <div class="box-bottom">
                                                <a href="{!! $TextBanner->link_url !!}">{{ __('frontend.moreDetails') }}</a>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <style>
        .owl-carousel .owl-item img {
            display: block;
            width: 130px !important;
            margin: 0 auto;
        }

        .item {
            font-size: 18px;
            line-height: 30px;
            font-weight: 500;
            justify-content: center;

        }
    </style>
    <section class="student-say-section">
        <div class="container">
            <div class="row">
                <div class="col student-say-title text-center">
                    <h3>মতামত</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="student-say-box">
                        <div class="owl-carousel owl-theme">
                            @foreach ($HomeOpinions as $HomeOpinion)
                                <div class="item">
                                    <div class="say-tex">
                                        <p>{!! $HomeOpinion->details_bd !!}</p>
                                    </div>
                                    <div class="student-image">
                                        <img src="{{ asset('uploads/topics/' . $HomeOpinion->photo_file) }}"
                                            alt="">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Life member form section --}}
    <section class="memberShipForm" style="
    background: #4D4D4D;
    padding: 30px 0px;color:#fff;
" id="registration">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="member-form-left" style="text-align: center;">
                        <h2 class="text-center text-white">জামিয়া আরাবিয়া খাদিমুল ইসলাম মাদ্রাসা</h2>
                        @if (Helper::GeneralSiteSettings('style_logo_' . @Helper::currentLanguage()->code) != '')
                            <img alt=""
                                src="{{ URL::to('uploads/settings/' . Helper::GeneralSiteSettings('style_logo_' . @Helper::currentLanguage()->code)) }}">
                        @else
                            <img alt="" src="{{ URL::to('uploads/settings/nologo.png') }}">
                        @endif
                        <div class="address">
                            @if (Helper::GeneralSiteSettings('contact_t1_' . @Helper::currentLanguage()->code) != '')
                                <address class="text-center text-white">
                                    {{ Helper::GeneralSiteSettings('contact_t1_' . @Helper::currentLanguage()->code) }}
                                </address>
                            @endif
                        </div>
                        <div class="phone">
                            @if (Helper::GeneralSiteSettings('contact_t3') != '')
                                <p class="text-center text-white">
                                    <strong>মোবাইল:</strong><a href="tel:{{ Helper::GeneralSiteSettings('contact_t3') }}"
                                        class="text-white"><span
                                            dir="ltr">{{ Helper::GeneralSiteSettings('contact_t3') }}</span></a>
                                </p>
                            @endif
                        </div>
                        <img src="{{ asset('assets/frontend/img/form1.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    @if (Session::has('message'))
                        <p class="alert alert-success" style="font-size: 16px;
font-weight: 700;
text-align: center;">
                            {{ Session::get('message') }}</p>
                    @endif
                    <div class="member-form-right">
                        <form action="{{ route('frontend.life.member') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="সম্পুর্ন নাম *">
                                <span class="text-danger">
                                    {{ $errors->has('name') ? $errors->first('name') : '' }}
                                </span>
                                {{-- @error('name')
                                <span>{{$message}}</span>
                                @error --}}
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="father_name" placeholder="পিতার নাম *">
                                <span class="text-danger">
                                    {{ $errors->has('name') ? $errors->first('name') : '' }}
                                </span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="years" placeholder="বয়স *">
                                <span class="text-danger">
                                    {{ $errors->has('years') ? $errors->first('years') : '' }}
                                </span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="designation" placeholder="পেশা *">
                                <span class="text-danger">
                                    {{ $errors->has('designation') ? $errors->first('designation') : '' }}
                                </span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" placeholder="টেলিফোন *">
                                <span class="text-danger">
                                    {{ $errors->has('phone') ? $errors->first('phone') : '' }}
                                </span>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="address" placeholder="স্থায়ী ঠিকানা *"></textarea>
                                <span class="text-danger">
                                    {{ $errors->has('address') ? $errors->first('address') : '' }}
                                </span>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="donate_type">
                                    <option selected disabled>দানের ধরন নির্বাচন করুন</option>
                                    <option value="year">বাৎসরিক</option>
                                    <option value="month">মাসিক</option>
                                </select>
                                <span class="text-danger">
                                    {{ $errors->has('donate_type') ? $errors->first('donate_type') : '' }}
                                </span>
                            </div>
                            <style>
                                .form-check-label {
                                    color: #fff;
                                    margin-right: 20px;
                                    font-size: 17px;
                                }

                                .form-check {
                                    margin: 20px 8px;
                                }
                            </style>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="amount1" value="১০০০০">
                                <label class="form-check-label" for="amount1">১০০০০</label>

                                <input type="checkbox" class="form-check-input" id="amount2" value="৫০০০">
                                <label class="form-check-label" for="amount2">৫০০০</label>

                                <input type="checkbox" class="form-check-input" id="amount3" value="২০০০">
                                <label class="form-check-label" for="amount3">২০০০</label>

                                <input type="checkbox" class="form-check-input" id="amount4" value="১০০০">
                                <label class="form-check-label" for="amount4">১০০০</label>

                                <input type="checkbox" class="form-check-input" id="amount5" value="৫০০">
                                <label class="form-check-label" for="amount5">৫০০</label>

                                <input type="checkbox" class="form-check-input" id="amount6" value="১০০">
                                <label class="form-check-label" for="amount6">১০০</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="donate_amount"
                                    placeholder="দানের পরিমাণ *" id="donateAmount">
                                <span class="text-danger">
                                    {{ $errors->has('donate_amount') ? $errors->first('donate_amount') : '' }}
                                </span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="refarence" placeholder="রেফারেন্স *">
                                <span class="text-danger">
                                    {{ $errors->has('refarence') ? $errors->first('refarence') : '' }}
                                </span>
                            </div>
                            <div class="form-group">
                                <button
                                    style="
                                    padding: 6px 28px;
                                    background: #51ab51;
                                    color: #fff;
                                    border: 0px;
                                    font-size: 18px;
                                    font-weight: 600;
                                "
                                    type="submit" class="btn btn-primary">সাবমিট</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Life member form section end --}}
    <style>
        .notice-section {
            margin: 30px 0;
        }

        .welcome-text {}

        .welcome-text>h5 {
            margin-bottom: 10px;
            color: #646363;
            /* padding-left: 35px; */
            text-align: center;
        }

        .welcome-text>h2 {
            margin: 0;
            font-size: 23px;
            font-weight: 600;
            text-align: center;
        }

        .notice-title>h4 {
            color: #000;
            line-height: 26px;
            font-weight: 500;
        }

        .n-box1 {
            background: linear-gradient(0deg, rgba(15, 4, 10, 0.413), rgba(15, 4, 10, 0.413)), url("{{ asset('assets/frontend/img/notice-1.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .n-box2 {
            background: linear-gradient(0deg, rgba(15, 4, 10, 0.413), rgba(15, 4, 10, 0.413)), url("{{ asset('assets/frontend/img/notice-2.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .n-box3 {
            background: linear-gradient(0deg, rgba(15, 4, 10, 0.413), rgba(15, 4, 10, 0.413)), url("{{ asset('assets/frontend/img/notice-3.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;

        }

        .notice-box {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            height: 290px;
            padding: 100px 0px;
            border-radius: 15px;
            margin-bottom: 15px;
        }

        .notice-box>h3 {
            text-align: center;
            color: #fff;
        }
    </style>
    {{-- Notice Section --}}
    <section class="notice-section" id="documents">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="welcome-text">
                        <h5>মাদরাসার পক্ষ থেকে</h5>
                        <h2>সবাইকে স্বাগতম</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="notice-title">
                        <h4>১২ বছর এই ঢাকারই একটি গুরুত্বপূর্ণ অংশ ‘মিরপুর’। বৃহত্তর মিরপুরের ১৩ নং সেকশন টিনশেড কলোনী
                            এলাকায় আপন ঐতিহ্য নিয়ে স্বগৌরবে জামিয়া আরাবিয়া খাদিমুল ইসলাম (মাদরাসা) অবস্থিত।</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <a href="{{ route('getDepartments') }}">
                        <div class="notice-box n-box1">
                            <h3>বিভাগসমূহ</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="{{ url('/notices') }}">
                        <div class="notice-box n-box2">
                            <h3>নোটিশ বোর্ড</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="{{ url('/gallerys') }}">
                        <div class="notice-box n-box3">
                            <h3>গ্যালারী</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    {{-- Notice Section end --}}
    <style>
        .video-gallery {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            background: #fff;
            padding: 5px 5px;
            border: 3px solid #353866;
        }
    </style>
    <section class="my-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col">
                    <div class="welcome-text">
                        <h2>ভিডিও গ্যালারী</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($HomeVides != null)
                    @foreach ($HomeVides as $HomeVides)
                        <div class="col-md-4">
                            <div class="video-gallery">
                                @if ($HomeVides->video_type == 1)
                                    <?php
                                    $Youtube_id = Helper::Get_youtube_video_id($HomeVides->video_file);
                                    ?>
                                    @if ($Youtube_id != '')
                                        <iframe width="100%" height="315"
                                            src="https://www.youtube.com/embed/{{ $Youtube_id }}?si=kyuP7xQCwhvzZenO"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                    @endif
                                @elseif($Topic->video_type == 2)
                                    <?php
                                    $Vimeo_id = Helper::Get_vimeo_video_id($HomeVides->video_file);
                                    ?>
                                    @if ($Vimeo_id != '')
                                        {{-- Vimeo Video --}}
                                        <iframe allowfullscreen
                                            src="https://player.vimeo.com/video/{{ $Vimeo_id }}?title=0&amp;byline=0">
                                        </iframe>
                                    @endif
                                @elseif($HomeVides->video_type == 3)
                                    @if ($HomeVides->video_file != '')
                                        {{-- Embed Video --}}
                                        {!! $HomeVides->video_file !!}
                                    @endif
                                @else
                                    <video width="100%" height="450" controls>
                                        <source src="{{ URL::to('uploads/topics/' . $HomeVides->video_file) }}"
                                            type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <h5>এখনো ভিডিও যোগ করা হয়নি</h5>
                @endif
            </div>
        </div>
    </section>

    @if (count($HomeTopics) > 0)
        <section class="content-row-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-row-head">
                            <h2 class="heading">{{ __('frontend.homeContents1Title') }}</h2>
                            <small>{{ __('frontend.homeContents1desc') }}</small>
                        </div>
                        <div id="owl-slider" class="owl-carousel owl-theme listing">
                            <?php
                            $title_var = 'title_' . @Helper::currentLanguage()->code;
                            $title_var2 = 'title_' . env('DEFAULT_LANGUAGE');
                            $details_var = 'details_' . @Helper::currentLanguage()->code;
                            $details_var2 = 'details_' . env('DEFAULT_LANGUAGE');
                            $section_url = '';
                            ?>
                            @foreach ($HomeTopics as $HomeTopic)
                                <?php
                                if ($HomeTopic->$title_var != '') {
                                    $title = $HomeTopic->$title_var;
                                } else {
                                    $title = $HomeTopic->$title_var2;
                                }
                                if ($HomeTopic->$details_var != '') {
                                    $details = $details_var;
                                } else {
                                    $details = $details_var2;
                                }
                                if ($section_url == '') {
                                    $section_url = Helper::sectionURL($HomeTopic->webmaster_id);
                                }
                                ?>
                                <div class="item">
                                    <h4>
                                        @if ($HomeTopic->icon != '')
                                            <i class="fa {!! $HomeTopic->icon !!} "></i>&nbsp;
                                        @endif
                                        {{ $title }}
                                    </h4>
                                    @if ($HomeTopic->photo_file != '')
                                        <img src="{{ URL::to('uploads/topics/' . $HomeTopic->photo_file) }}"
                                            alt="{{ $title }}" />
                                    @endif

                                    {{-- Additional Feilds --}}
                                    @if (count($HomeTopic->webmasterSection->customFields->where('in_listing', true)) > 0)
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div>
                                                    <?php
                                                    $cf_title_var = 'title_' . @Helper::currentLanguage()->code;
                                                    $cf_title_var2 = 'title_' . env('DEFAULT_LANGUAGE');
                                                    ?>
                                                    @foreach ($HomeTopic->webmasterSection->customFields->where('in_listing', true) as $customField)
                                                        <?php
                                                        // check permission
                                                        $view_permission_groups = [];
                                                        if ($customField->view_permission_groups != "") {
                                                            $view_permission_groups = explode(",", $customField->view_permission_groups);
                                                        }
                                                        if (in_array(0, $view_permission_groups) || $customField->view_permission_groups == "") {
                                                        // have permission & continue
                                                        ?>
                                                        @if ($customField->in_listing)
                                                            <?php
                                                            if ($customField->$cf_title_var != '') {
                                                                $cf_title = $customField->$cf_title_var;
                                                            } else {
                                                                $cf_title = $customField->$cf_title_var2;
                                                            }

                                                            $cf_saved_val = '';
                                                            $cf_saved_val_array = [];
                                                            if (count($HomeTopic->fields) > 0) {
                                                                foreach ($HomeTopic->fields as $t_field) {
                                                                    if ($t_field->field_id == $customField->id) {
                                                                        if ($customField->type == 7) {
                                                                            // if multi check
                                                                            $cf_saved_val_array = explode(', ', $t_field->field_value);
                                                                        } else {
                                                                            $cf_saved_val = $t_field->field_value;
                                                                        }
                                                                    }
                                                                }
                                                            }

                                                            ?>

                                                            @if (
                                                                ($cf_saved_val != '' || count($cf_saved_val_array) > 0) &&
                                                                    ($customField->lang_code == 'all' || $customField->lang_code == @Helper::currentLanguage()->code))
                                                                @if ($customField->type == 12)
                                                                    {{-- Vimeo Video Link --}}
                                                                @elseif($customField->type == 11)
                                                                    {{-- Youtube Video Link --}}
                                                                @elseif($customField->type == 10)
                                                                    {{-- Video File --}}
                                                                @elseif($customField->type == 9)
                                                                    {{-- Attach File --}}
                                                                @elseif($customField->type == 8)
                                                                    {{-- Photo File --}}
                                                                @elseif($customField->type == 7)
                                                                    {{-- Multi Check --}}
                                                                    <div class="row field-row">
                                                                        <div class="col-lg-3">
                                                                            {!! $cf_title !!} :
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            <?php
                                                                            $cf_details_var = 'details_' . @Helper::currentLanguage()->code;
                                                                            $cf_details_var2 = 'details_en' . env('DEFAULT_LANGUAGE');
                                                                            if ($customField->$cf_details_var != '') {
                                                                                $cf_details = $customField->$cf_details_var;
                                                                            } else {
                                                                                $cf_details = $customField->$cf_details_var2;
                                                                            }
                                                                            $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
                                                                            $line_num = 1;
                                                                            ?>
                                                                            @foreach ($cf_details_lines as $cf_details_line)
                                                                                @if (in_array($line_num, $cf_saved_val_array))
                                                                                    <span class="badge">
                                                                                        {!! $cf_details_line !!}
                                                                                    </span>
                                                                                @endif
                                                                                <?php
                                                                                $line_num++;
                                                                                ?>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @elseif($customField->type == 6)
                                                                    {{-- Select --}}
                                                                    <div class="row field-row">
                                                                        <div class="col-lg-3">
                                                                            {!! $cf_title !!} :
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            <?php
                                                                            $cf_details_var = 'details_' . @Helper::currentLanguage()->code;
                                                                            $cf_details_var2 = 'details_en' . env('DEFAULT_LANGUAGE');
                                                                            if ($customField->$cf_details_var != '') {
                                                                                $cf_details = $customField->$cf_details_var;
                                                                            } else {
                                                                                $cf_details = $customField->$cf_details_var2;
                                                                            }
                                                                            $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
                                                                            $line_num = 1;
                                                                            ?>
                                                                            @foreach ($cf_details_lines as $cf_details_line)
                                                                                @if ($line_num == $cf_saved_val)
                                                                                    {!! $cf_details_line !!}
                                                                                @endif
                                                                                <?php
                                                                                $line_num++;
                                                                                ?>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @elseif($customField->type == 5)
                                                                    {{-- Date & Time --}}
                                                                    <div class="row field-row">
                                                                        <div class="col-lg-3">
                                                                            {!! $cf_title !!} :
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            {!! date('Y-m-d H:i:s', strtotime($cf_saved_val)) !!}
                                                                        </div>
                                                                    </div>
                                                                @elseif($customField->type == 4)
                                                                    {{-- Date --}}
                                                                    <div class="row field-row">
                                                                        <div class="col-lg-3">
                                                                            {!! $cf_title !!} :
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            {!! date('Y-m-d', strtotime($cf_saved_val)) !!}
                                                                        </div>
                                                                    </div>
                                                                @elseif($customField->type == 3)
                                                                    {{-- Email Address --}}
                                                                    <div class="row field-row">
                                                                        <div class="col-lg-3">
                                                                            {!! $cf_title !!} :
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            {!! $cf_saved_val !!}
                                                                        </div>
                                                                    </div>
                                                                @elseif($customField->type == 2)
                                                                    {{-- Number --}}
                                                                    <div class="row field-row">
                                                                        <div class="col-lg-3">
                                                                            {!! $cf_title !!} :
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            {!! $cf_saved_val !!}
                                                                        </div>
                                                                    </div>
                                                                @elseif($customField->type == 1)
                                                                    {{-- Text Area --}}
                                                                @else
                                                                    {{-- Text Box --}}
                                                                    <div class="row field-row">
                                                                        <div class="col-lg-3">
                                                                            {!! $cf_title !!} :
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            {!! $cf_saved_val !!}
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endif
                                                        <?php
                                                        }
                                                        ?>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- End of -- Additional Feilds --}}
                                    <p class="text-justify">{!! mb_substr(strip_tags($HomeTopic->$details), 0, 300) . '...' !!}
                                        &nbsp; <a
                                            href="{{ Helper::topicURL($HomeTopic->id) }}">{{ __('frontend.readMore') }}
                                            <i class="fa fa-caret-{{ @Helper::currentLanguage()->right }}"></i></a>
                                    </p>

                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="more-btn">
                            <a href="{{ url($section_url) }}" class="btn btn-theme"><i
                                    class="fa fa-angle-left"></i>&nbsp; {{ __('frontend.viewMore') }}
                                &nbsp;<i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    @endif

    @if (count($HomePhotos) > 0)
        <section class="content-row-no-bg">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-row-head">
                            <h2 class="heading">{{ __('frontend.homeContents2Title') }}</h2>
                            <small>{{ __('frontend.homeContents2desc') }}</small>
                        </div>
                        <div class="row">
                            <section id="projects">
                                <ul id="thumbs" class="portfolio">
                                    <?php
                                    $title_var = 'title_' . @Helper::currentLanguage()->code;
                                    $title_var2 = 'title_' . env('DEFAULT_LANGUAGE');
                                    $details_var = 'details_' . @Helper::currentLanguage()->code;
                                    $details_var2 = 'details_' . env('DEFAULT_LANGUAGE');
                                    $section_url = '';
                                    $ph_count = 0;
                                    ?>
                                    @foreach ($HomePhotos as $HomePhoto)
                                        <?php
                                        if ($HomePhoto->$title_var != '') {
                                            $title = $HomePhoto->$title_var;
                                        } else {
                                            $title = $HomePhoto->$title_var2;
                                        }

                                        if ($section_url == '') {
                                            $section_url = Helper::sectionURL($HomePhoto->webmaster_id);
                                        }
                                        ?>
                                        @foreach ($HomePhoto->photos as $photo)
                                            @if ($ph_count < 12)
                                                <li class="col-lg-2 design" data-id="id-0" data-type="web">
                                                    <div class="relative">
                                                        <div class="item-thumbs">
                                                            <a class="hover-wrap fancybox" data-fancybox-group="gallery"
                                                                title="{{ $title }}"
                                                                href="{{ URL::to('uploads/topics/' . $photo->file) }}">
                                                                <span class="overlay-img"></span>
                                                                <span class="overlay-img-thumb"><i
                                                                        class="fa fa-search-plus"></i></span>
                                                            </a>
                                                            <!-- Thumb Image and Description -->
                                                            <img src="{{ URL::to('uploads/topics/' . $photo->file) }}"
                                                                alt="{{ $title }}">
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            <?php
                                            $ph_count++;
                                            ?>
                                        @endforeach
                                    @endforeach

                                </ul>
                            </section>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="more-btn">
                                    <a href="{{ url($section_url) }}" class="btn btn-theme"><i
                                            class="fa fa-angle-left"></i>&nbsp; {{ __('frontend.viewMore') }}
                                        &nbsp;<i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (count($HomePartners) > 0)
        <section class="content-row-no-bg top-line">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-row-head">
                            <h2 class="heading">{{ __('frontend.partners') }}</h2>
                            <small>{{ __('frontend.partnersMsg') }}</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="partners_carousel slide" id="myCarousel" style="direction: ltr">
                        <div class="carousel-inner">
                            <div class="item active">
                                <ul class="thumbnails">
                                    <?php
                                    $ii = 0;
                                    $title_var = 'title_' . @Helper::currentLanguage()->code;
                                    $title_var2 = 'title_' . env('DEFAULT_LANGUAGE');
                                    $details_var = 'details_' . @Helper::currentLanguage()->code;
                                    $details_var2 = 'details_' . env('DEFAULT_LANGUAGE');
                                    $section_url = '';
                                    ?>

                                    @foreach ($HomePartners as $HomePartner)
                                        <?php
                                        if ($HomePartner->$title_var != '') {
                                            $title = $HomePartner->$title_var;
                                        } else {
                                            $title = $HomePartner->$title_var2;
                                        }

                                        if ($section_url == '') {
                                            $section_url = Helper::sectionURL($HomePartner->webmaster_id);
                                        }

                                        if ($ii == 6) {
                                            echo "
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </ul>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div><!-- /Slide -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class='item'>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <ul class='thumbnails'>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ";
                                            $ii = 0;
                                        }
                                        ?>
                                        <li class="col-sm-2">
                                            <div>
                                                <div class="thumbnail">
                                                    <img src="{{ URL::to('uploads/topics/' . $HomePartner->photo_file) }}"
                                                        data-placement="bottom" title="{{ $title }}"
                                                        alt="{{ $title }}">
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                        </li>
                                        <?php
                                        $ii++;
                                        ?>
                                    @endforeach

                                </ul>
                            </div><!-- /Slide -->
                        </div>
                        <nav>
                            <ul class="control-box pager">
                                <li><a data-slide="prev" href="#myCarousel" class=""><i
                                            class="fa fa-angle-left"></i></a></li>
                                {{-- <li><a href="{{ url($section_url) }}">{{ __('frontend.viewMore') }}</a> --}}
                                {{-- </li> --}}
                                <li><a data-slide="next" href="#myCarousel" class=""><i
                                            class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </nav>
                        <!-- /.control-box -->

                    </div><!-- /#myCarousel -->
                </div>

            </div>

        </section>
    @endif

@endsection
@push('script')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })
    </script>
    <script>
        $('#amount1').on('click', function() {
            var amount1 = $(this).val();
            $('#donateAmount').val(amount1);
        });
        $('#amount2').on('click', function() {
            var amount2 = $(this).val();
            $('#donateAmount').val(amount2);
        });
        $('#amount3').on('click', function() {
            var amount3 = $(this).val();
            $('#donateAmount').val(amount3);
        });
        $('#amount4').on('click', function() {
            var amount4 = $(this).val();
            $('#donateAmount').val(amount4);
        });
        $('#amount5').on('click', function() {
            var amount5 = $(this).val();
            $('#donateAmount').val(amount5);
        });
        $('#amount6').on('click', function() {
            var amount6 = $(this).val();
            $('#donateAmount').val(amount6);
        });
    </script>
@endpush
