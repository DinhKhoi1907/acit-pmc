@if ($tintuc_nb)
    <div class="vc_row wpb_row vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner">
                <div class="wpb_wrapper">
                    <div class="pageBanner">
                        <div class="contentTop bg-cmain8 px-[60px] lg:px-[120px] pt-10 pb-16">
                            <div class="flex items-center gap-5 flex-wrap lg:flex-nowrap">
                                <div class="text-[32px] lg:min-w-[387px] font-bold capitalize text-white">DỰ ÁN NỔI BẬT</div>
                                <div class="text-[14px] opacity-70 leading-[160%] text-white">
                                    {{ $seopage_static['news']['mota' . $lang] }}</div>
                            </div>
                        </div>
                        <div class="boxContent d-flex">
                            @foreach ($tintuc_nb as $k => $v)
                                <div class="itemBanner"
                                    style="background-image: url({{ Thumb::Crop(UPLOAD_POST, $v['photo'], 313, 600, 1) }})"
                                    >
                                    <a href="{{ $v['tenkhongdau' . $lang] }}">
                                        <article class="info">
                                            <h3>{{ $v['ten' . $lang] }}</h3>
                                        </article>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="wpb_text_column wpb_content_element ">
                        <div class="wpb_wrapper">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@push('css_page')
    <style>
        .pageBanner::before {
            content: '';
            left: 0;
            bottom: 39rem;
            position: absolute;
            height: 2px;
            background-color: #fff;
            opacity: 1;
            width: 100%;
        }

        .d-flex {
            display: flex !important;
        }

        .vc_column-inner::before {
            content: " ";
            display: table;
        }

        .wpb_wrapper {
            position: relative;
        }

        .pageBanner .contentTop .container {
            max-width: 1236px;
        }

        .pageBanner .contentTop .container {
            position: relative;
        }

        .pageBanner .boxContent .itemBanner {
            position: relative;
            color: #171717;
            white-space: nowrap;
            -webkit-flex: 1;
            -ms-flex: 1;
            flex: 1;
            cursor: pointer;
            -webkit-transition: all 200ms ease;
            -moz-transition: all 200ms ease;
            -ms-transition: all 200ms ease;
            -o-transition: all 200ms ease;
            transition: all 200ms ease;
            padding-top: 600px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .pageBanner .boxContent .itemBanner:first-child:after {
            display: none;
        }

        .pageBanner .boxContent .itemBanner::after {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            background-color: #fff;
            border-radius: 50%;
            top: -2.255rem;
            left: -5px;
        }

        .wpb_wrapper:after {
            content: "";
            display: block;
            clear: both;
        }

        .vc_column-inner::after {
            clear: both;
        }

        .vc_column-inner::after {
            clear: both;
        }

        .vc_column-inner::after,
        .vc_column-inner::before {
            content: " ";
            display: table;
        }

        .pageBanner .boxContent .itemBanner:hover {
            -webkit-flex-grow: 2;
            flex-grow: 2;
        }

        .pageBanner .boxContent .itemBanner:hover {
            white-space: normal;
        }

        .pageBanner .boxContent .itemBanner:hover .info {
            padding-left: 30px;
            padding-right: 30px;
            color: #39B54A;
        }

        .pageBanner .boxContent .itemBanner:hover:after {
            background-color: #D93832;
        }


        .pageBanner .boxContent .itemBanner:hover .info p {
            color: #fff;
        }

        .pageBanner .boxContent .itemBanner::after {}

        .pageBanner .boxContent .itemBanner:first-child:after {
            display: none;
        }

        .pageBanner .boxContent .itemBanner h3 a {
            font-family: 'Averta-Bold';
            color: #171717;
            font-style: normal;
            font-weight: 700;
            font-size: 24px;
            line-height: 140%;
        }

        .pageBanner .boxContent .itemBanner .info {
            position: absolute;
            bottom: 0;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0) 53.48%, rgba(255, 255, 255, 0.73) 100%);
            padding-bottom: 32px;
            padding-left: 98px;
            padding-right: 98px;
            padding-top: 50%;
            left: 0;
            right: 0;
            margin-bottom: 0;
            color: #000;
        }

        .itemBanner .info h3 {
            font-size: 24px;
            font-weight: 600;
            line-height: 160%;
            text-transform: capitalize;
        }

        .pageBanner .contentTop .h2 {
            max-width: 100%;
            color: white;
        }

        @media (max-width: 640px) {
            .pageBanner .boxContent .itemBanner {
                padding-top: 350px;
            }

            .pageBanner::before {
                bottom: 30.5rem !important;
            }
        }


        @media (max-width: 768px) {
            .pageBanner::before {
                bottom: 51.5rem;
            }
        }

        @media (max-width: 1180px) {
            .container {
                max-width: 100%;
            }
        }

        @media (max-width: 1180px) {
            .pageBanner .boxContent .itemBanner .info {
                padding-left: 20px;
                padding-right: 20px;
            }
        }
    </style>
@endpush
