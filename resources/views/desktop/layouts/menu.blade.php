@php
    $mangxahoi = app('mangxahoi');
@endphp


<div id="menu" class="fixed w-full top-0 z-[1000] hidden lg:block transition-all duration-500 bg-white">
    <div class="relative flex">
        <div class="w-full @yield('menu')">
            <div class="flex items-center justify-between w-full py-[14px] content-page-layout">
                <div class="flex items-center">
                    <a href=""><img
                            src="{{ Thumb::Crop(UPLOAD_PHOTO, $photo_static['logo']['photo'], 59, 59, 1) }}"
                            alt="" width="59" height="auto"></a>
                    <a href="">
                        <img src="img/logo_3.png" alt="">
                    </a>
                </div>
                <div class="flex items-center gap-[60px]">
                    <div class="relative flex items-center">
                        {{-- <span class="absolute -right-[40px] top-0 border-0 border-solid border-gray-200 h-full border-r"></span> --}}
                        <p class="w-[40px]">
                        <div class="px-3 pt-3 pb-[6px] bg-cmain8 rounded-[50%]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M20 15.5C18.75 15.5 17.55 15.3 16.43 14.93C16.08 14.82 15.69 14.9 15.41 15.17L13.21 17.37C10.38 15.93 8.06 13.62 6.62 10.78L8.82 8.57C9.1 8.31 9.18 7.92 9.07 7.57C8.7 6.45 8.5 5.25 8.5 4C8.5 3.45 8.05 3 7.5 3H4C3.45 3 3 3.45 3 4C3 13.39 10.61 21 20 21C20.55 21 21 20.55 21 20V16.5C21 15.95 20.55 15.5 20 15.5ZM19 12H21C21 7.03 16.97 3 12 3V5C15.87 5 19 8.13 19 12ZM15 12H17C17 9.24 14.76 7 12 7V9C13.66 9 15 10.34 15 12Z"
                                    fill="white" />
                            </svg>
                        </div>
                        </p>
                        <div class="w-[calc(100%-40px)] pl-2 capitalize">
                            <p class="text-xs font-bold text-gray-500">Hotline</p>
                            <a href="tel:" class="font-bold text-cmain2">{{ $settingOption['hotline'] }}</a>
                        </div>
                    </div>
                    <div class="relative flex items-center">
                        {{-- <span class="absolute -right-[40px] top-0 border-0 border-solid border-gray-200 h-full border-r"></span> --}}
                        <p class="w-[40px]">
                        <div class="px-3 pt-3 pb-[6px] bg-cmain8 rounded-[50%]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                    d="M16.6667 3.33337H3.33341C2.41675 3.33337 1.67508 4.08337 1.67508 5.00004L1.66675 15C1.66675 15.9167 2.41675 16.6667 3.33341 16.6667H16.6667C17.5834 16.6667 18.3334 15.9167 18.3334 15V5.00004C18.3334 4.08337 17.5834 3.33337 16.6667 3.33337ZM16.6667 6.66671L10.0001 10.8334L3.33341 6.66671V5.00004L10.0001 9.16671L16.6667 5.00004V6.66671Z"
                                    fill="white" />

                            </svg>
                        </div>
                        </p>
                        <div class="w-[calc(100%-40px)] pl-2">
                            <p class="text-xs font-bold text-gray-500 capitalize">Tư vấn kĩ thuật</p>
                            <a href="tel:" class="font-bold text-cmain2">{{ $settingOption['email'] }}</a>
                        </div>
                    </div>
                    <div class="relative flex flex-col items-center gap-1">
                        <a onclick="doGoogleLanguageTranslator('en|vi'); return false;" title="Việt Nam">
                            <img class="cursor-pointer rounded-sm" src="img/vi.jpg" alt="">
                        </a>
                        <a onclick="doGoogleLanguageTranslator('en|en'); return false;" title="English"
                            class="cursor-pointer" data-lang="en">
                            <img class="cursor-pointer rounded-sm" src="img/en.jpg" alt="">
                        </a>



                    </div>
                </div>
            </div>
            <div class="w-full bg-cmain8">
                {{-- <span class="navigation-destop absolute w-[1442px] h-[595px] z-1 bg-blue-300 opacity-25"></span> --}}
                <div class="flex items-center justify-between content-page-layout">
                    <div>
                        <ul id="menu-main" class="justify-between menu__hidden_li menu-main">
                            {{-- <li class="{{ Helper::currentMenu('') }}">
                                <a href="">{{ __('Trang Chủ') }}</a>
                                <span
                                    class="absolute right-0 top-[25px] border-0 border-solid border-gray-200 h-[40%] border-r opacity-50"></span>
                            </li> --}}
                            <li class="{{ Helper::currentMenu('ve-chung-toi') }}">
                                <a href="ve-chung-toi">{{ __('Giới Thiệu') }}</a>
                                <span
                                    class="absolute right-0 top-[25px] border-0 border-solid border-gray-200 h-[40%] border-r opacity-50"></span>
                                {{-- <ul>
                                    <li><a href="ve-chung-toi">Introduce</a></li>
                                    <li><a href="catalogue" target="_blank">Catalogue</a></li>
                                </ul> --}}
                            </li>
                            <li class="{{ Helper::currentMenu('san-pham') }}">
                                <a href="san-pham">{{ __('Sản phẩm') }}</a>
                                <span
                                    class="absolute right-0 top-[25px] border-0 border-solid border-gray-200 h-[40%] border-r opacity-50"></span>
                                {!! Helper::showCategoryMenuMulty('', 'product', $lang) !!}
                            </li>
                            <li class="{{ Helper::currentMenu('dich-vu') }}">
                                <a href="dich-vu">{{ __('Dịch Vụ') }}</a>
                                <span
                                    class="absolute right-0 top-[25px] border-0 border-solid border-gray-200 h-[40%] border-r opacity-50"></span>
                            </li>
                            <li class="{{ Helper::currentMenu('catalogue') }}"><a href="catalogue">{{ __('Tài Liệu') }}
                                </a>
                                <span
                                    class="absolute right-0 top-[25px] border-0 border-solid border-gray-200 h-[40%] border-r opacity-50"></span>
                            </li>
                            <li class="{{ Helper::currentMenu('tin-tuc') }}"><a href="tin-tuc">{{ __('Tin Tức') }}</a>
                                <span
                                    class="absolute right-0 top-[25px] border-0 border-solid border-gray-200 h-[40%] border-r opacity-50"></span>
                                {!! Helper::showCategoryMenuMulty('', 'news', $lang) !!}

                            </li>
                            <li class="{{ Helper::currentMenu('lien-he') }}">
                                <a href="lien-he">{{ __('Liên hệ') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="flex items-center gap-7">
                        <div
                            class="relative px-9 border-0 border-solid rounded-full border-cmain w-[250px] bg-white overflow-hidden">
                            <input type="text" id="keyword" value=""
                                placeholder="{{ __('Tìm kiếm thông tin...') }}" onkeypress="doEnter(event,'keyword');"
                                class="w-full h-[40px] bg-transparent placeholder:text-black placeholder:opacity-80 outline-hidden border-solid border-0 ring-0 focus:ring-transparent text-black text-xs transition-all duration-500 indent-0 px-0 placeholder:font-body placeholder:font-medium placeholder:transition-all placeholder:duration-300 placeholder:delay-150 py-0">
                            <button type="button" onclick="onSearch('keyword');"
                                class="absolute top-[5px] left-[5px] p-0 border-transparent bg-inherit opacity-80">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                        stroke="#000" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M20.9999 20.9999L16.6499 16.6499" stroke="#000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    {{-- <div class="langCon" style="">
                        <div class="execphpwidget">
                            <div id="flags" class="flex">
                                <a onclick="doGoogleLanguageTranslator('en|vi'); return false;" title="Việt Nam"
                                    class="flex items-center font-medium cursor-pointer flag ps text-cmain hover:text-cmain2 lang-btn"
                                    data-lang="vi"><img src="img/vi.png" width="30px" height="30px"
                                        class="mr-2 rounded-md" /></a>
                                <a onclick="doGoogleLanguageTranslator('en|en'); return false;" title="English"
                                    class="flex items-center font-medium cursor-pointer flag fa text-cmain hover:text-cmain2 lang-btn"
                                    data-lang="en"><img src="img/en.png" width="30px" height="30px"
                                        class="mr-2 rounded-md" /></a>
                                <a onclick="doGoogleLanguageTranslator('en|zh-TW'); return false;" title="China"
                                    class="flex items-center font-medium cursor-pointer flag fa text-cmain hover:text-cmain2 lang-btn"
                                    data-lang="cn"><img src="img/cn.png" width="30px" height="30px"
                                        class="rounded-md" /></a>
                            </div>
                            <div id="google_language_translator"></div>
                        </div>
                    </div> --}}
                </div>
            </div>

            {{-- <div class="relative flex items-center">
                <div class="relative" id="search-btn">
                    <svg class="transition-all duration-500 opacity-100 cursor-pointer search-open" width="35" height="35" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.71 20.29L18 16.61C19.4401 14.8144 20.1375 12.5353 19.9488 10.2413C19.7601 7.94733 18.6997 5.81281 16.9855 4.27667C15.2714 2.74053 13.0338 1.91954 10.7329 1.9825C8.43207 2.04546 6.24275 2.98759 4.61517 4.61517C2.98759 6.24275 2.04546 8.43207 1.9825 10.7329C1.91954 13.0338 2.74053 15.2714 4.27667 16.9855C5.81281 18.6997 7.94733 19.7601 10.2413 19.9488C12.5353 20.1375 14.8144 19.4401 16.61 18L20.29 21.68C20.383 21.7738 20.4936 21.8482 20.6154 21.8989C20.7373 21.9497 20.868 21.9758 21 21.9758C21.132 21.9758 21.2627 21.9497 21.3846 21.8989C21.5065 21.8482 21.6171 21.7738 21.71 21.68C21.8903 21.4936 21.991 21.2444 21.991 20.985C21.991 20.7257 21.8903 20.4765 21.71 20.29ZM11 18C9.61556 18 8.26218 17.5895 7.11103 16.8203C5.95989 16.0511 5.06268 14.9579 4.53287 13.6788C4.00306 12.3997 3.86443 10.9923 4.13453 9.63439C4.40463 8.27653 5.07131 7.02925 6.05028 6.05028C7.02925 5.07131 8.27653 4.40463 9.63439 4.13453C10.9923 3.86443 12.3997 4.00306 13.6788 4.53287C14.9579 5.06268 16.0511 5.95989 16.8203 7.11103C17.5895 8.26218 18 9.61556 18 11C18 12.8565 17.2625 14.637 15.9498 15.9498C14.637 17.2625 12.8565 18 11 18Z" fill="#FFCF01"/>
                    </svg>
                    <p class="absolute top-0 left-0 flex items-center justify-center w-full h-full transition-all duration-500 opacity-0 cursor-pointer search-close"><i class="fal fa-times text-[28px] text-white"></i></p>
                </div>
                <div id="view-btn" class="w-[45px] h-[45px] rounded-full ml-8 flex flex-col items-start justify-center px-[15px] cursor-pointer relative"> <p class="absolute top-0 left-0 flex items-center justify-center w-full h-full transition-all duration-500 opacity-0 cursor-pointer view-close"><i class="fal fa-times text-[28px] text-white"></i></p> <div class="flex flex-col items-center justify-center opacity-100 cursor-pointer view-open gap-[6px] group hover:text-right transition-all duration-500 w-full relative"> <svg fill="#FFCF01" height="33" width="33" version="1.1" id="XMLID_275_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" xml:space="preserve"> <g id="language"> <g> <path d="M12,24C5.4,24,0,18.6,0,12S5.4,0,12,0s12,5.4,12,12S18.6,24,12,24z M9.5,17c0.6,3.1,1.7,5,2.5,5s1.9-1.9,2.5-5H9.5z M16.6,17c-0.3,1.7-0.8,3.3-1.4,4.5c2.3-0.8,4.3-2.4,5.5-4.5H16.6z M3.3,17c1.2,2.1,3.2,3.7,5.5,4.5c-0.6-1.2-1.1-2.8-1.4-4.5H3.3 z M16.9,15h4.7c0.2-0.9,0.4-2,0.4-3s-0.2-2.1-0.5-3h-4.7c0.2,1,0.2,2,0.2,3S17,14,16.9,15z M9.2,15h5.7c0.1-0.9,0.2-1.9,0.2-3 S15,9.9,14.9,9H9.2C9.1,9.9,9,10.9,9,12C9,13.1,9.1,14.1,9.2,15z M2.5,15h4.7c-0.1-1-0.1-2-0.1-3s0-2,0.1-3H2.5C2.2,9.9,2,11,2,12 S2.2,14.1,2.5,15z M16.6,7h4.1c-1.2-2.1-3.2-3.7-5.5-4.5C15.8,3.7,16.3,5.3,16.6,7z M9.5,7h5.1c-0.6-3.1-1.7-5-2.5-5 C11.3,2,10.1,3.9,9.5,7z M3.3,7h4.1c0.3-1.7,0.8-3.3,1.4-4.5C6.5,3.3,4.6,4.9,3.3,7z"></path> </g> </g> </svg> </div> </div>
                <div id="search-box" class="absolute p-3 bg-cmain w-[300px] -right-5 transition-all duration-500 top-[85px] opacity-0 -z-[1] shadow-shadow1">
                    <div class="relative border-0 border-b border-solid border-cmain border-opacity-10">
                        <input type="text" id="keyword" value="" placeholder="{{ __('Tìm giao dịch...') }}"
                            onkeypress="doEnter(event,'keyword');"
                            class="w-full h-[24px] bg-transparent placeholder:text-black outline-hidden border-solid border-0 ring-0 focus:ring-transparent text-black text-xs transition-all duration-500 indent-0 px-0 placeholder:font-body placeholder:font-medium placeholder:transition-all placeholder:duration-300 placeholder:delay-150">
                        <button type="button" onclick="onSearch('keyword');"
                            class="absolute top-0 -right-[2px] p-0 border-transparent bg-inherit">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                    stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M20.9999 20.9999L16.6499 16.6499" stroke="black" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div id="view-box" class="absolute p-3 bg-cmain2 w-[300px] -right-5 transition-all duration-500 top-[85px] opacity-0 -z-[1] shadow-shadow1 invisible">
                    <div class="relative p-5">
                        @desktop
                        <div class="flex items-center ">
                            <div class="langCon" style="">
                                <div class="execphpwidget">
                                    <div id="flags" class="flex gap-x-3">
                                        <a onclick="doGoogleLanguageTranslator('vi|vi'); return false;" title="Việt Nam" class="flex items-center font-medium cursor-pointer flag ps text-cmain hover:text-cmain2"><img src="img/vi.png" width="50" height="50" class="rounded-md" /></a>
                                        <a onclick="doGoogleLanguageTranslator('vi|en'); return false;" title="Việt Nam" class="flex items-center font-medium cursor-pointer flag fa text-cmain hover:text-cmain2 font-el"><img src="img/en.png" width="50" height="50" class="rounded-md" /></a>
                                    </div>
                                    <div id="google_language_translator"></div>
                                </div>
                            </div>
                        </div>
                        @enddesktop
                    </div>
                    <div class="w-full p-5 mt-3 border-0 border-t border-dashed border-opacity-30 border-cmain">
                        <div class="flex items-center mb-5">
                            <p class="w-[30px]"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="#FFCF01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="#FFCF01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            </p>
                            <span class="ml-2 text-cmain">{{$setting['diachi'.$lang]}}</span>
                        </div>
                        <div class="flex items-center mb-5">
                            <p class="w-[30px]"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.0499 5C16.0267 5.19057 16.9243 5.66826 17.628 6.37194C18.3317 7.07561 18.8094 7.97326 18.9999 8.95M15.0499 1C17.0792 1.22544 18.9715 2.13417 20.4162 3.57701C21.8608 5.01984 22.7719 6.91101 22.9999 8.94M21.9999 16.92V19.92C22.0011 20.1985 21.944 20.4742 21.8324 20.7293C21.7209 20.9845 21.5572 21.2136 21.352 21.4019C21.1468 21.5901 20.9045 21.7335 20.6407 21.8227C20.3769 21.9119 20.0973 21.9451 19.8199 21.92C16.7428 21.5856 13.7869 20.5341 11.1899 18.85C8.77376 17.3147 6.72527 15.2662 5.18993 12.85C3.49991 10.2412 2.44818 7.27099 2.11993 4.18C2.09494 3.90347 2.12781 3.62476 2.21643 3.36162C2.30506 3.09849 2.4475 2.85669 2.6347 2.65162C2.82189 2.44655 3.04974 2.28271 3.30372 2.17052C3.55771 2.05833 3.83227 2.00026 4.10993 2H7.10993C7.59524 1.99522 8.06572 2.16708 8.43369 2.48353C8.80166 2.79999 9.04201 3.23945 9.10993 3.72C9.23656 4.68007 9.47138 5.62273 9.80993 6.53C9.94448 6.88792 9.9736 7.27691 9.89384 7.65088C9.81408 8.02485 9.6288 8.36811 9.35993 8.64L8.08993 9.91C9.51349 12.4135 11.5864 14.4864 14.0899 15.91L15.3599 14.64C15.6318 14.3711 15.9751 14.1858 16.3491 14.1061C16.723 14.0263 17.112 14.0555 17.4699 14.19C18.3772 14.5286 19.3199 14.7634 20.2799 14.89C20.7657 14.9585 21.2093 15.2032 21.5265 15.5775C21.8436 15.9518 22.0121 16.4296 21.9999 16.92Z" stroke="#FFCF01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            </p>
                            <span class="ml-2 text-cmain">{{$settingOption['hotline']}}</span>
                        </div>
                        <div class="flex items-center">
                            <p class="w-[30px]"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="#FFCF01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 6L12 13L2 6" stroke="#FFCF01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            </p>
                            <span class="ml-2 text-cmain">{{$settingOption['email']}}</span>
                        </div>
                    </div>
                </div>

            </div> --}}
        </div>
    </div>
</div>

{{--
<div id="menu" class="fixed w-full top-0 z-[999999] bg-white hidden lg:block transition-all duration-500 h-[97px]">
    <!-- Error -->
    @include('desktop.layouts.error')
    <div class="flex items-center justify-between bg-white content-page-layout">
        <a href="" class="block w-[96px] relative himg">
            <img src="{{ Thumb::Crop(UPLOAD_PHOTO, $photo_static['logo']['photo'], 192, 194, 1) }}" alt=""
                width="96px" height="97px">
        </a>
        <div class="">
            <div class="flex items-center justify-between @yield('menu')">
                <ul id="menu-main" class="justify-between menu__hidden_li menu-main">
                    <li class="{{ Helper::currentMenu('') }}"><a href="">{{ __('Trang chủ') }}</a></li>
                    <li class="{{ Helper::currentMenu('gioi-thieu') }}">
                        <a href="gioi-thieu">{{ __('Giới thiệu') }}</a>
                    </li>
                    <li class="menu-li find-current">
                        <a href="khoa-hoc" class="flex items-center">{{ __('Khóa học') }} <svg class="ml-[10px]"
                                width="11" height="7" viewBox="0 0 11 7" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.399902 0.500001L5.3999 5.5L10.3999 0.5" stroke="#161616" />
                            </svg>
                        </a>
                        {!! Helper::showCategoryMenuMulty('', 'product', $lang) !!}
                    </li>
                    <li class="menu-li find-current"><a href="nhuong-quyen">{{ __('Nhượng quyền') }}</a></li>
                    <li class="menu-li find-current">
                        <a href="tin-tuc">{{ __('Tin tức') }}</a>
                        {!! Helper::showCategoryMenuMulty('', 'news', $lang) !!}
                    </li>
                    <li class="{{ Helper::currentMenu('contact') }}"><a href="contact">{{ __('Liên hệ') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="flex items-center w-[245px]">
            <div class="relative border-0 border-b border-black border-solid pb-[6px]">
                <input type="text" id="keyword" value="" placeholder="{{ __('Tìm kiếm nhanh') }}"
                    onkeypress="doEnter(event,'keyword');"
                    class="w-full h-[24px] bg-transparent placeholder:text-cmain2 outline-hidden border-solid border-white ring-0 focus:ring-transparent text-cmain text-xs transition-all duration-500 indent-0 px-0 placeholder:font-body placeholder:font-medium placeholder:transition-all placeholder:duration-300 placeholder:delay-150">
                <button type="button" onclick="onSearch('keyword');"
                    class="absolute top-0 -right-[2px] p-0 border-transparent bg-inherit">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                            stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M20.9999 20.9999L16.6499 16.6499" stroke="black" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="ml-[30px]">
                @if (!Login::isLogin())

                    <a class="cursor-pointer" href="{{route('account.login')}}">

                        <svg width="30" height="30" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M16.6667 17.5V15.8333C16.6667 14.9493 16.3155 14.1014 15.6904 13.4763C15.0653 12.8512 14.2174 12.5 13.3334 12.5H6.66671C5.78265 12.5 4.93481 12.8512 4.30968 13.4763C3.68456 14.1014 3.33337 14.9493 3.33337 15.8333V17.5" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                            <path d="M9.99996 9.16667C11.8409 9.16667 13.3333 7.67428 13.3333 5.83333C13.3333 3.99238 11.8409 2.5 9.99996 2.5C8.15901 2.5 6.66663 3.99238 6.66663 5.83333C6.66663 7.67428 8.15901 9.16667 9.99996 9.16667Z" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                        </svg>

                    </a>

                @else

                    <a class="cursor-pointer header-open-account">

                        <svg width="30" height="30" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M16.6667 17.5V15.8333C16.6667 14.9493 16.3155 14.1014 15.6904 13.4763C15.0653 12.8512 14.2174 12.5 13.3334 12.5H6.66671C5.78265 12.5 4.93481 12.8512 4.30968 13.4763C3.68456 14.1014 3.33337 14.9493 3.33337 15.8333V17.5" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                            <path d="M9.99996 9.16667C11.8409 9.16667 13.3333 7.67428 13.3333 5.83333C13.3333 3.99238 11.8409 2.5 9.99996 2.5C8.15901 2.5 6.66663 3.99238 6.66663 5.83333C6.66663 7.67428 8.15901 9.16667 9.99996 9.16667Z" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                        </svg>

                    </a>

                @endif
            </div>

            <a class="relative ml-[25px] fix_cart_count">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.71 16.71L18.29 14.29C18.197 14.1963 18.0864 14.1219 17.9646 14.0711C17.8427 14.0203 17.712 13.9942 17.58 13.9942C17.448 13.9942 17.3173 14.0203 17.1954 14.0711C17.0736 14.1219 16.963 14.1963 16.87 14.29L13.29 17.87C13.1973 17.9634 13.124 18.0743 13.0742 18.1961C13.0245 18.3179 12.9992 18.4484 13 18.58V21C13 21.2652 13.1054 21.5196 13.2929 21.7071C13.4804 21.8946 13.7348 22 14 22H16.42C16.5516 22.0008 16.6821 21.9755 16.8039 21.9258C16.9257 21.876 17.0366 21.8027 17.13 21.71L20.71 18.13C20.8037 18.037 20.8781 17.9264 20.9289 17.8046C20.9797 17.6827 21.0058 17.552 21.0058 17.42C21.0058 17.288 20.9797 17.1573 20.9289 17.0354C20.8781 16.9136 20.8037 16.803 20.71 16.71ZM16 20H15V19L17.58 16.42L18.58 17.42L16 20ZM10 20H6C5.73478 20 5.48043 19.8946 5.29289 19.7071C5.10536 19.5196 5 19.2652 5 19V5C5 4.73478 5.10536 4.48043 5.29289 4.29289C5.48043 4.10536 5.73478 4 6 4H11V7C11 7.79565 11.3161 8.55871 11.8787 9.12132C12.4413 9.68393 13.2044 10 14 10H17V11C17 11.2652 17.1054 11.5196 17.2929 11.7071C17.4804 11.8946 17.7348 12 18 12C18.2652 12 18.5196 11.8946 18.7071 11.7071C18.8946 11.5196 19 11.2652 19 11V9C19 9 19 9 19 8.94C18.9896 8.84813 18.9695 8.75763 18.94 8.67V8.58C18.8919 8.47718 18.8278 8.38267 18.75 8.3L12.75 2.3C12.6673 2.22222 12.5728 2.15808 12.47 2.11C12.4402 2.10576 12.4099 2.10576 12.38 2.11L12.06 2H6C5.20435 2 4.44129 2.31607 3.87868 2.87868C3.31607 3.44129 3 4.20435 3 5V19C3 19.7956 3.31607 20.5587 3.87868 21.1213C4.44129 21.6839 5.20435 22 6 22H10C10.2652 22 10.5196 21.8946 10.7071 21.7071C10.8946 21.5196 11 21.2652 11 21C11 20.7348 10.8946 20.4804 10.7071 20.2929C10.5196 20.1054 10.2652 20 10 20ZM13 5.41L15.59 8H14C13.7348 8 13.4804 7.89464 13.2929 7.70711C13.1054 7.51957 13 7.26522 13 7V5.41ZM8 14H14C14.2652 14 14.5196 13.8946 14.7071 13.7071C14.8946 13.5196 15 13.2652 15 13C15 12.7348 14.8946 12.4804 14.7071 12.2929C14.5196 12.1054 14.2652 12 14 12H8C7.73478 12 7.48043 12.1054 7.29289 12.2929C7.10536 12.4804 7 12.7348 7 13C7 13.2652 7.10536 13.5196 7.29289 13.7071C7.48043 13.8946 7.73478 14 8 14ZM8 10H9C9.26522 10 9.51957 9.89464 9.70711 9.70711C9.89464 9.51957 10 9.26522 10 9C10 8.73478 9.89464 8.48043 9.70711 8.29289C9.51957 8.10536 9.26522 8 9 8H8C7.73478 8 7.48043 8.10536 7.29289 8.29289C7.10536 8.48043 7 8.73478 7 9C7 9.26522 7.10536 9.51957 7.29289 9.70711C7.48043 9.89464 7.73478 10 8 10ZM10 16H8C7.73478 16 7.48043 16.1054 7.29289 16.2929C7.10536 16.4804 7 16.7348 7 17C7 17.2652 7.10536 17.5196 7.29289 17.7071C7.48043 17.8946 7.73478 18 8 18H10C10.2652 18 10.5196 17.8946 10.7071 17.7071C10.8946 17.5196 11 17.2652 11 17C11 16.7348 10.8946 16.4804 10.7071 16.2929C10.5196 16.1054 10.2652 16 10 16Z" fill="black"/>
                </svg>
                <span
                    class="absolute bottom-0 right-0 text-white text-xs count-cart ajax-count-cart bg-cmain rounded-full w-[20px] h-[20px] flex items-center justify-center border border-solid border-white font-normal">{{ app('share_all_cart') }}</span>
            </a>
        </div>
    </div>
</div> --}}
