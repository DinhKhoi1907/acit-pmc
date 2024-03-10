@if ($doitac)
    <div>
        <div class="doitac-section py-20">
            <h1 class="text-center">Đối tác của chúng tôi</h1>
            <div class="content-page-layout">
                <div class="p-10">
                    <div class="doitac__owl owl-carousel owl-theme">
                        @foreach ($doitac as $k => $v)
                            <div class="relative overflow-hidden group revealOnScroll cursor-pointer bg-white w-[148px] h-[132px]"
                                data-animation="animate__fadeInUp" data-timeout="{{ ($k + 1) * 200 }}">
                                <a href="#" class="item-partner">
                                    <img class="transition-all duration-700 object-cover"
                                        src="{{ Thumb::Crop(UPLOAD_POST, $v['photo'], 168, 132, 1, $v['type']) }}"
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


@push('css_page')
    <style>
        .doitac-section h1 {
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            line-height: 110%;
            text-transform: uppercase;
            background: linear-gradient(159deg, #39B54A 2.34%, #076C40 82.55%);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .item-partner img {
            /* filter: contrast(0); */
        }

        .item-partner:hover img {
            filter: contrast(1);
        }

        @media screen and (max-width: 768px) {
            .doitac-section h1 {
                font-size: 24px;
            }
        }
    </style>
@endpush


@push('js_page')
    <script>
        if ($(".doitac__owl").exists()) {
            var owl_list_doitac = $('.doitac__owl');
            owl_list_doitac.owlCarousel({
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
                        items: 2,
                        spaceBetween: 20,
                    },

                    600: {
                        items: 3,
                        spaceBetween: 20,
                    },

                    750: {
                        items: 5,
                        spaceBetween: 20,

                    },
                    1028: {
                        items: 6,
                        spaceBetween: 30,
                    }
                }
            });
        }
    </script>
@endpush
