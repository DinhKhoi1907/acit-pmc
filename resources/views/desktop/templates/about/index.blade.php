<div class="relative">
    <div id="ab_us"
        class="ab-us bg-[#F1FAFE] xl:h-screen w-full flex 2xl:flex-row flex-col justify-between items-center overflow-hidden relative gap-y-8">
        <div class="container grid lg:grid-cols-12 items-center lg:h-screen us_info xl:px-0 lg:px-6 px-4"
            style="margin-bottom: 25px">
            <div
                class="bg-[url('https://www.acit-pmc.online/pmc/img/Logo_ACIT.png')] w-auto h-auto xl:w-[664px] xl:h-[628px] xl:left-[500px] top-0 absolute bg-no-repeat">
            </div>
            <div class="col-span-12 lg:col-span-6 revealOnScroll" data-animation="animate__fadeInLeft" data-timeout="300">
                <div>
                    <span class="font-medium text-3xl xl:text-5xl -mb-2 mr-4 text-black">Về chúng tôi</span>
                    <span
                        class="font-extrabold text-4xl xl:text-6xl text-cmain">{{ isset($settingOption['tenchinh']) ? $settingOption['tenchinh'] : 'ACIT' }}</span>
                </div>
                <h1 class="text-cmain font-medium text-2xl">
                    {{ $vechungtoi['ten' . $lang] }}
                </h1>
                <div class="flex flex-col gap-y-6 mt-4 font-normal text-xl">
                    <div class="text-justify">
                        {!! $vechungtoi['mota' . $lang] !!}
                    </div>
                    <a href="ve-chung-toi"
                        class="py-[10px] px-5 border-0 rounded-md flex items-center cursor-pointer max-w-[222px] introduce-btn">
                        <span class="text-[16px] text-white font-extrabold leading-[24px] tracking-[2px] uppercase">Xem
                            chi tiết</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M15.586 10.657L11.636 6.70704C11.4538 6.51844 11.353 6.26584 11.3553 6.00364C11.3576 5.74144 11.4628 5.49063 11.6482 5.30522C11.8336 5.11981 12.0844 5.01465 12.3466 5.01237C12.6088 5.01009 12.8614 5.11088 13.05 5.29304L18.707 10.95C18.8002 11.0427 18.8741 11.1529 18.9246 11.2742C18.9751 11.3955 19.001 11.5256 19.001 11.657C19.001 11.7884 18.9751 11.9186 18.9246 12.0399C18.8741 12.1612 18.8002 12.2714 18.707 12.364L13.05 18.021C12.9578 18.1166 12.8474 18.1927 12.7254 18.2451C12.6034 18.2976 12.4722 18.3251 12.3394 18.3263C12.2066 18.3274 12.0749 18.3021 11.952 18.2519C11.8291 18.2016 11.7175 18.1273 11.6236 18.0334C11.5297 17.9395 11.4555 17.8279 11.4052 17.705C11.3549 17.5821 11.3296 17.4504 11.3307 17.3176C11.3319 17.1849 11.3595 17.0536 11.4119 16.9316C11.4643 16.8096 11.5405 16.6993 11.636 16.607L15.586 12.657H6C5.73478 12.657 5.48043 12.5517 5.29289 12.3641C5.10536 12.1766 5 11.9223 5 11.657C5 11.3918 5.10536 11.1375 5.29289 10.9499C5.48043 10.7624 5.73478 10.657 6 10.657H15.586Z"
                                fill="white" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @if ($hinhanhsp)
            <div
                class="skew-box lg:absolute top-0 lg:flex grid grid-cols-3 right-6 text-white xl:text-4xl text-base font-extrabold lg:w-[42%] w-full lg:h-full">
                @foreach ($hinhanhsp as $k => $v)
                    <a href="ve-chung-toi"
                        style="background-image: url({{ Thumb::Crop(UPLOAD_STATICPOST, $v['photo'], 440, 1148, 1) }})"
                        class="lg:w-44 xl:w-62 2xl:w-72 w-full h-72 lg:h-full bg-center bg-cover lg:-skew-x-6 overflow-hidden flex justify-center items-end relative skew-item">
                        <div
                            class="flex md:flex-row flex-col gap-x-2 xl:gap-x-3 items-center py-4 xl:py-16 px-0 xl:px-4 skew-text z-50">
                            <div>
                                <div
                                    class="text-base xl:text-2xl uppercase whitespace-nowrap font-bold 2xl:text-3xl opacity-100">
                                    {{ $v['ten' . $lang] }}
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-0 right-0 bottom-0 left-0 opacity-0 bg-hover skew-mask w-full">
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>


@push('css_page')
    <style>
        .introduce-btn {
            background: #D93832;
            transition: background-position 0.8s, background 0.8s;
        }

        .introduce-btn:hover {
            background-position: 100% 0;
            background: linear-gradient(180deg,
                    rgba(7, 108, 64, 0.7) 49%,
                    rgba(6, 86, 48, 0.7) 74.98%);
        }

        .skew-box a {
            color: white;
        }

        .skew-item:before {
            background: linear-gradient(186deg, rgba(57, 181, 74, 0.00) 4.46%, #39B54A 95.67%);
            position: absolute !important;
            bottom: 0px !important;
            right: 0px !important;
            left: 0px !important;
            height: 100% !important;
            width: 100% !important;
            background-size: cover !important;
            background-repeat: no-repeat !important;
            content: "" !important;
        }

        .bg-hover {
            opacity: 0;
            transition: opacity 0.5s ease;
            background: linear-gradient(183deg, rgba(57, 181, 74, 0.00) 2.19%, rgba(57, 181, 74, 0.80) 29.78%);
        }

        .skew-item:hover .bg-hover {
            opacity: 1;
        }

        .skew-item:hover .skew-text {
            margin: 100% 0;
            transition: margin 700ms ease;
        }

        .bg-center {
            background-position: center;
        }

        .bg-cover {
            background-size: cover;
        }

        @media only screen and (max-width: 600px) {
            .skew-item:hover .skew-text {
                margin: 100% 0;
                transition: margin 1s ease;
            }
        }

        @media only screen and (max-width: 768px) {
            .skew-item:hover .skew-text {
                margin: 50% 0;
                transition: margin 1s ease;
            }
        }
    </style>
@endpush

@push('js_page')
    <script></script>
@endpush
