@if ($chungnhan_bangkhen)
    <div>
        <div class="doitac-section pt-20">
            <h1 class="text-center">CHỨNG NHẬN VÀ BẰNG KHEN</h1>
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
            class="flex flex-col gap-6 justify-center items-center lg:pt-32 pt-12 pb-20 px-4 lg:px-20 dichvu-title \\uppercase doitac-section">
            <h1 class="text-center">VIDEO</h1>
            {{-- <h1 class="text-center">{{ $vechungtoi['ten' . $lang] }}</h1> --}}
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

        .section-vechungtoi .arrow-left-product {
            left: 8.5em;
        }

        .section-vechungtoi .arrow-right-product {
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
