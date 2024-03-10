@if ($chungnhan_bangkhen)
    <div>
        <div class="doitac-section pt-20">
            <h1 class="text-center">Chứng nhận và bằng khen</h1>
            <div class="content-page-layout">
                <div class="p-10">
                    <div class="chungnhan__owl owl-carousel owl-theme">
                        @foreach ($chungnhan_bangkhen as $k => $v)
                            <div class="relative overflow-hidden group revealOnScroll cursor-pointer bg-white"
                                data-animation="animate__fadeInUp" data-timeout="{{ ($k + 1) * 200 }}">
                                <a class="item-partner">
                                    <img class="transition-all duration-700 object-cover"
                                        src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 707, 1000, 1, $v['type']) }}"
                                        alt="">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($videos && isset($videos[0]['video']))
    <div class="section-vechungtoi">
        <div
            class="flex flex-col gap-6 justify-center items-center lg:pt-32 pt-12 pb-20 px-4 lg:px-20 dichvu-title \\uppercase">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="70" viewBox="0 0 80 70"
                    fill="none">
                    <path opacity="0.5"
                        d="M78.9948 1.72357L79.0649 1.24052L78.5837 1.15884C67.635 -0.699663 59.2792 1.36498 53.6568 7.49485C48.0721 13.496 45.3213 22.3199 45.3213 33.879V69V69.5H45.8213H78.5H79V69V35.1944V34.6944H78.5H62.0052C61.5492 30.9763 61.7009 27.6815 62.4451 24.8011C63.3004 21.7429 64.8707 19.4367 67.144 17.8462L67.1441 17.8463L67.1539 17.8391C69.406 16.1805 72.4904 15.4858 76.4724 15.83L76.9425 15.8707L77.0103 15.4037L78.9948 1.72357ZM34.6735 1.72357L34.7436 1.24052L34.2624 1.15884C23.3138 -0.699659 14.9579 1.36497 9.33552 7.49481C3.75076 13.496 1 22.3199 1 33.879V69V69.5H1.5H34.1787H34.6787V69V35.1944V34.6944H34.1787H17.6839C17.2279 30.9763 17.3795 27.6815 18.1238 24.8011C18.9791 21.7429 20.5494 19.4367 22.8227 17.8462L22.8228 17.8463L22.8326 17.8391C25.0847 16.1805 28.1691 15.4858 32.1511 15.83L32.6212 15.8707L32.689 15.4037L34.6735 1.72357Z"
                        stroke="#FF0000" />
                </svg>
                <span class="pl-5 text-[24px] font-semibold leading-[110%] text-black">Video về chúng tôi</span>
            </div>
            <h1 class="text-center">{{ $vechungtoi['ten' . $lang] }}</h1>
            {{-- <p class="text-center text-sm leading-[160%] opacity-70">
                {{ $videos[0]['mota' . $lang] }}
            </p> --}}
        </div>
        <div id="show-video" class="overflow-hidden">
            <div class="videos__owl owl-carousel owl-theme">
                @foreach ($videos as $k => $v)
                    <iframe class="block h-[350px] md:h-[550px] item-video mx-auto"
                        src="//www.youtube.com/embed/{{ Helper::getYoutube($v['video']) }}" height="500px"
                        frameborder="0" allowfullscreen width="80%">
                    </iframe>
                @endforeach
            </div>
        </div>
    </div>
@endif

@push('css_page')
    <style>
        .zoomed-image {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            z-index: 9999;
            background-color: rgba(0, 0, 0, 0.8);
            cursor: pointer;
            transition: all 0.5s;
            opacity: 0;
            visibility: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .zoomed-image img {
            max-width: 90%;
            max-height: 90%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50%;
            height: auto;
        }

        @media screen and (max-width: 768px) {
            .zoomed-image img {
                top: 40%;
                width: 90%;
                /* Adjust the width for smaller screens */
            }
        }

        .owl-dots {
            text-align: center !important;
        }

        .history>h1 {
            text-align: center;
            font-size: 42px;
            font-weight: 700;
            line-height: 110%;
            text-transform: uppercase;
        }

        .owl-theme .owl-dots .owl-dot.active span,
        .owl-theme .owl-dots .owl-dot:hover span {
            background: #076C40;
        }

        .owl-theme .owl-nav {
            margin-top: -10px !important;
        }

        .arrow-left-product {
            left: 8.5em;
        }

        .arrow-right-product {
            right: 8.5em;
        }
    </style>
@endpush

@push('js_page')
    <script>
        $(document).ready(function() {
            $('.item-partner img').click(function() {
                let src = $(this).attr('src');
                let overlay = $('<div class="zoomed-image"></div>');
                let zoomedImg = $('<img src="' + src + '">');
                overlay.append(zoomedImg);
                $('body').append(overlay);
                overlay.css({
                    'opacity': '1',
                    'visibility': 'visible'
                });

                overlay.click(function() {
                    $(this).css({
                        'opacity': '0',
                        'visibility': 'hidden'
                    });
                    $(this).remove();
                });
            });
        });
    </script>

    <script>
        if ($(".chungnhan__owl").exists()) {
            var owl_list_chungnhan = $('.chungnhan__owl');
            owl_list_chungnhan.owlCarousel({
                autoplay: true,
                margin: 15,
                items: 5,
                dots: false,
                autoplayHoverPause: true,
                autoplaySpeed: 1000,
                autoplayTimeout: 3000,
                smartSpeed: 3000,
                loop: true,
                responsive: {
                    0: {
                        items: 1,
                        spaceBetween: 20,
                    },

                    600: {
                        items: 2,
                        spaceBetween: 20,
                    },

                    750: {
                        items: 3,
                        spaceBetween: 20,

                    },
                    1028: {
                        items: 4,
                        spaceBetween: 20,
                    }
                }
            });
        }
    </script>

    <script>
        if ($(".videos__owl").exists()) {
            var owl_list_videos = $('.videos__owl');
            owl_list_videos.owlCarousel({
                video: true,
                autoplay: true,
                items: 1,
                dots: true,
                autoplayHoverPause: true,
                autoplaySpeed: 1000,
                autoplayTimeout: 3000,
                smartSpeed: 3000,
                loop: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 1,
                    },

                    750: {
                        items: 1,

                    },
                    1028: {
                        items: 1,
                        nav: true,
                        navText: [
                            "<button class='arrow-left-product'><i class = 'fas fa-arrow-left'></i></button>",
                            "<button class='arrow-right-product'><i class='fas fa-arrow-right'></i></button>"
                        ]
                    }
                }
            });
        }
    </script>
@endpush
