@php
    $mangxahoi = app('mangxahoi');
@endphp
<div id="header" class="xs:w-full xs:transition xs:p-0 bg-[#fafafa] shadow-shadow1 duration-300 z-[9999] fixed w-full">
    <p class="block lg:hidden">
        {{-- <a href="{{$photo_static['bannertop']['link']}}" target="_blank" class="text-center himg">
			<img class="block m-auto" src="{{Thumb::Crop(UPLOAD_PHOTO,$photo_static['bannertop']['photo'],1440,0,2)}}" alt="" width="1440" height="40">
		</a> --}}
    </p>
    <div class="header-contain xs:justify-center xs:relative xs:bg-white xs:z-[99999999] lg:hidden shadow-shadow1">
        <div class="px-3 py-1 bg-white md:px-4 center-layout header-flex">
            <div class="flex-row items-center header-res-left ww-auto md:w-[122px]">
                <a class="flex flex-col items-center justify-center p-0 ml-0 text-cmain md:py-2 header-menu-btn menu-footer-item w-[50px] h-[50px] rounded-full"
                    data-id="#modal-menu">
                    {{-- <svg class="block" width="60%" height="60%" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M24 18v1h-24v-1h24zm0-6v1h-24v-1h24zm0-6v1h-24v-1h24z" fill="#fff"/><path d="M24 19h-24v-1h24v1zm0-6h-24v-1h24v1zm0-6h-24v-1h24v1z" fill="#fff"/></svg> --}}
                    <svg width="50px" height="50px" viewBox="0 0 24 24" clip-rule="evenodd" fill-rule="evenodd"
                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m13 16.745c0-.414-.336-.75-.75-.75h-9.5c-.414 0-.75.336-.75.75s.336.75.75.75h9.5c.414 0 .75-.336.75-.75zm9-5c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75zm-4-5c0-.414-.336-.75-.75-.75h-14.5c-.414 0-.75.336-.75.75s.336.75.75.75h14.5c.414 0 .75-.336.75-.75z"
                            fill-rule="nonzero" fill="#4AAC46" />
                    </svg>
                    {{-- <span class="text-[10px] text-white font-bold">MENU</span> --}}
                </a>
            </div>

            <a href="" class="flex items-center justify-center py-2 text-center header-logo himg">
                {{-- <img class="inline-block"
                    src="{{ Thumb::Crop(UPLOAD_PHOTO, $photo_static['logo']['photo'], 59, 59, 1) }}" alt="logo"
                    width="59" height="auto"> --}}
                    <img src="img/logo_main.png" alt="" width="61px">
            </a>

            <div class="header-res-right">
                <div class="items-center hidden md:flex w-[122px]">
                    <svg class="mr-2" width="22" height="22" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.0499 5C16.0267 5.19057 16.9243 5.66826 17.628 6.37194C18.3317 7.07561 18.8094 7.97326 18.9999 8.95M15.0499 1C17.0792 1.22544 18.9715 2.13417 20.4162 3.57701C21.8608 5.01984 22.7719 6.91101 22.9999 8.94M21.9999 16.92V19.92C22.0011 20.1985 21.944 20.4742 21.8324 20.7293C21.7209 20.9845 21.5572 21.2136 21.352 21.4019C21.1468 21.5901 20.9045 21.7335 20.6407 21.8227C20.3769 21.9119 20.0973 21.9451 19.8199 21.92C16.7428 21.5856 13.7869 20.5341 11.1899 18.85C8.77376 17.3147 6.72527 15.2662 5.18993 12.85C3.49991 10.2412 2.44818 7.27099 2.11993 4.18C2.09494 3.90347 2.12781 3.62476 2.21643 3.36162C2.30506 3.09849 2.4475 2.85669 2.6347 2.65162C2.82189 2.44655 3.04974 2.28271 3.30372 2.17052C3.55771 2.05833 3.83227 2.00026 4.10993 2H7.10993C7.59524 1.99522 8.06572 2.16708 8.43369 2.48353C8.80166 2.79999 9.04201 3.23945 9.10993 3.72C9.23656 4.68007 9.47138 5.62273 9.80993 6.53C9.94448 6.88792 9.9736 7.27691 9.89384 7.65088C9.81408 8.02485 9.6288 8.36811 9.35993 8.64L8.08993 9.91C9.51349 12.4135 11.5864 14.4864 14.0899 15.91L15.3599 14.64C15.6318 14.3711 15.9751 14.1858 16.3491 14.1061C16.723 14.0263 17.112 14.0555 17.4699 14.19C18.3772 14.5286 19.3199 14.7634 20.2799 14.89C20.7657 14.9585 21.2093 15.2032 21.5265 15.5775C21.8436 15.9518 22.0121 16.4296 21.9999 16.92Z"
                            stroke="#4AAC46" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <a href="tel:{{ $settingOption['hotline'] }}"
                        class="text-sm font-semibold text-cmain">{{ $settingOption['hotline'] }}</a>
                </div>
                <p class="md:hidden w-[40px] h-[40px] bg-cmain8 inline-flex items-center justify-center rounded-full"><a
                        href="tel:{{ $settingOption['hotline'] }}" class="text-sm font-semibold text-white"><svg
                            class="mt-2" width="22" height="22" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.0499 5C16.0267 5.19057 16.9243 5.66826 17.628 6.37194C18.3317 7.07561 18.8094 7.97326 18.9999 8.95M15.0499 1C17.0792 1.22544 18.9715 2.13417 20.4162 3.57701C21.8608 5.01984 22.7719 6.91101 22.9999 8.94M21.9999 16.92V19.92C22.0011 20.1985 21.944 20.4742 21.8324 20.7293C21.7209 20.9845 21.5572 21.2136 21.352 21.4019C21.1468 21.5901 20.9045 21.7335 20.6407 21.8227C20.3769 21.9119 20.0973 21.9451 19.8199 21.92C16.7428 21.5856 13.7869 20.5341 11.1899 18.85C8.77376 17.3147 6.72527 15.2662 5.18993 12.85C3.49991 10.2412 2.44818 7.27099 2.11993 4.18C2.09494 3.90347 2.12781 3.62476 2.21643 3.36162C2.30506 3.09849 2.4475 2.85669 2.6347 2.65162C2.82189 2.44655 3.04974 2.28271 3.30372 2.17052C3.55771 2.05833 3.83227 2.00026 4.10993 2H7.10993C7.59524 1.99522 8.06572 2.16708 8.43369 2.48353C8.80166 2.79999 9.04201 3.23945 9.10993 3.72C9.23656 4.68007 9.47138 5.62273 9.80993 6.53C9.94448 6.88792 9.9736 7.27691 9.89384 7.65088C9.81408 8.02485 9.6288 8.36811 9.35993 8.64L8.08993 9.91C9.51349 12.4135 11.5864 14.4864 14.0899 15.91L15.3599 14.64C15.6318 14.3711 15.9751 14.1858 16.3491 14.1061C16.723 14.0263 17.112 14.0555 17.4699 14.19C18.3772 14.5286 19.3199 14.7634 20.2799 14.89C20.7657 14.9585 21.2093 15.2032 21.5265 15.5775C21.8436 15.9518 22.0121 16.4296 21.9999 16.92Z"
                                stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg></a></p>
            </div>
        </div>
    </div>
</div>



<!--SHOW TAB LOGIN-->
@if (Login::isLogin())
    @php
        $user = Auth::guard()
            ->user()
            ->toArray();
        //dd($user);
    @endphp
    <div class="login-account-contain">
        <div
            class="relative flex flex-col items-center justify-between pt-12 bg-white login-account-box shadow-shadow3">
            <span
                class="login-account-close absolute top-0 right-0 w-[50px] h-[50px] flex items-center justify-center text-[13px] cursor-pointer underline text-[#666]">{{ __('Đóng') }}</span>
            <div class="relative flex flex-col items-center px-4 login-account-top">
                <p
                    class="login-account-img w-[200px] h-[200px] rounded-full bg-[#ebebeb] border-4 border-solid border-[#ddd] relative overflow-hidden">
                    <img src="{{ $user['photo'] ? Thumb::Crop(UPLOAD_USER, $user['photo'], 200, 200, 1) : '' }}"
                        alt="logo">
                    <svg style="{{ $user['photo'] ? 'opacity: 0;' : '' }}" class="login-account-iconphoto"
                        width="60" height="60" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                        fill-rule="evenodd" clip-rule="evenodd">
                        <path
                            d="M16.983 2l1.406 2.109c.371.557.995.891 1.664.891h3.93v17h-24v-17h5.93c.669 0 1.293-.334 1.664-.891l1.406-2.109h8zm3.07 4c-1.006 0-1.938-.5-2.496-1.337l-1.109-1.663h-6.93l-1.109 1.664c-.557.836-1.49 1.336-2.496 1.336h-4.93v15h22v-15h-2.93zm-7.053 1c3.311 0 6 2.689 6 6s-2.689 6-6 6-6-2.689-6-6 2.689-6 6-6zm0 1c2.76 0 5 2.24 5 5s-2.24 5-5 5-5-2.24-5-5 2.24-5 5-5zm0 2c1.656 0 3 1.344 3 3s-1.344 3-3 3-3-1.344-3-3 1.344-3 3-3zm0 1c1.104 0 2 .896 2 2s-.896 2-2 2-2-.896-2-2 .896-2 2-2zm-8-2c0-.552-.447-1-1-1-.553 0-1 .448-1 1s.447 1 1 1c.553 0 1-.448 1-1zm-3-6h3.001v1h-3.001v-1z" />
                    </svg>
                    <a href="{{ route('account.manage') }}" class="login-account-edit">{{ __('Chỉnh sửa') }}</a>
                </p>
                <p class="mt-4 text-xl font-bold uppercase md:text-base login-account-name text-cmain">
                    {{ $user['name'] }}</p>
                @if ($user['mathanhvien'])
                    <p class="mb-2 text-sm font-bold uppercase login-account-name text-cmain"
                        style="font-size:13px;color: #999;">({{ $user['mathanhvien'] }})</p>
                @endif

                <a class="text-base text-gray-400 md:text-sm login-account-passnew"
                    href="{{ route('account.editpass') }}">{{ __('Tạo mật khẩu mới') }}</a>

                <div
                    class="login-account-list group border-0 border-t border-solid border-[#D1D1D1] mt-8 pt-8 flex flex-col">
                    <a class="mx-2 mb-3 flex items-center text-xl md:text-base text-[#333] font-medium hover:text-cmain2"
                        href="{{ route('account.manage') }}"><i
                            class="mr-2 far fa-user-cog"></i>{{ __('Thông tin tài khoản') }}</a>
                    <a class="mx-2 mb-3 flex items-center text-xl md:text-base text-[#333] font-medium hover:text-cmain2"
                        href="{{ route('account.ordermanage') }}"><i
                            class="mr-2 far fa-shopping-basket"></i>{{ __('Quản lý khóa học') }}</a>
                </div>
            </div>
            <div class="login-account-bottom w-full justify-center flex bg-[#ebebeb] hover:bg-cmain2 group">
                <a class="block w-full px-2 py-3 font-bold text-center uppercase login-account-logout group-hover:text-white text-cmain"
                    href="{{ route('account.logout') }}"><i class="mr-2 fas fa-sign-out"></i>{{ __('Đăng xuất') }}</a>
            </div>
        </div>
    </div>
@endif


<div id="modal-menu">
    <div class="bg-white modal-menu-full">
        <div class="justify-between modal-menu-close-main bg-cmain">
            <span class="modal-menu-close"></span>
            <div class="langCon" style="">
                <div class="execphpwidget">
                    <div id="flags" class="flex">
                        <a onclick="doGoogleLanguageTranslator('en|vi'); return false;" title="Việt Nam"
                            class="flex items-center font-medium flag ps text-cmain hover:text-cmain2 "><img
                                src="img/vi.png" width="30px" height="30px" class="mr-2 rounded-md" /></a>
                        <a onclick="doGoogleLanguageTranslator('en|en'); return false;" title="English"
                            class="flex items-center font-medium flag fa text-cmain hover:text-cmain2 font-el"><img
                                src="img/en.png" width="30px" height="30px" class="mr-2 rounded-md" /></a>
                        {{-- <a onclick="doGoogleLanguageTranslator('en|zh-TW'); return false;" title="China"
                            class="flex items-center font-medium flag fa text-cmain hover:text-cmain2 font-el"><img
                                src="img/cn.png" width="30px" height="30px" class="rounded-md" /></a> --}}
                    </div>
                    <div id="google_language_translator"></div>
                </div>
            </div>
        </div>
        <div class="modal-menu-container @yield('menu')">
            <div class="menu-side-header">
                <div class="menu-side-info">
                    <p class="menu-side-logo himg">
                        <a href="">
                            <img src="{{ Thumb::Crop(UPLOAD_PHOTO, $photo_static['logo']['photo'], 59, 59, 1) }}"
                                alt="logo" width="59" height="auto"></a>
                    </p>
                </div>

                <div class="relative px-5 mb-3">
                    <input type="text" id="keyword_mobile" value=""
                        placeholder="{{ __('Tìm sản phẩm') }}..." onkeypress="doEnter(event,'keyword_mobile');"
                        class="w-full rounded-[30px] placeholder:text-sm placeholder:font-body border transition-all p-1 indent-3 h-[38px] border-[#999] border-solid">
                    <button type="button" onclick="onSearch('keyword_mobile');"
                        class="absolute border-0 outline-none bg-inherit top-[0.3rem] right-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.3385 19.6769C15.9437 19.6769 19.6769 15.9437 19.6769 11.3385C19.6769 6.73326 15.9437 3 11.3385 3C6.73326 3 3 6.73326 3 11.3385C3 15.9437 6.73326 19.6769 11.3385 19.6769Z"
                                stroke="#232323" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M21 21L18 18" stroke="#232323" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <ul id="menu-side-mobile" class="menu-main">
                    <li>
                        <div class="menu-side-title"><a href="ve-chung-toi">{{ __('Giới thiệu') }}</a></div>
                    </li>
                    <li>
                        <div class="menu-side-title"><a href="san-pham">{{ __('Sản phẩm') }}</a><span><i
                                    class="text-black fal fa-chevron-down"></i></span></div>
                        {!! Helper::showCategoryMenuMulty('', 'product', $lang, true, true) !!}
                    </li>
                    <li>
                        <div class="menu-side-title"><a href="dich-vu">{{ __('Dịch vụ') }}</a></div>
                    </li>
                    <li>
                        <div class="menu-side-title"><a href="catalogue">{{ __('Tài liệu') }}</a></div>
                    </li>
                    <li>
                        <div class="menu-side-title"><a href="tin-tuc">{{ __('Tin tức') }}</a>
                            <span><i class="text-black fal fa-chevron-down"></i></span>
                        </div>
                        {!! Helper::showCategoryMenuMulty('', 'news', $lang, true, true) !!}
                    </li>
                    <li>
                        <div class="menu-side-title"><a href="lien-he">{{ __('Liên hệ') }}</a></div>
                    </li>
                </ul>
            </div>
            <div class="menu-side-footer">
                <div class="menu-side-footer-copyright">Copyright © 2023 <span
                        class="uppercase">{{ $setting['ten' . $lang] }}</span></div>
            </div>
        </div>
    </div>
</div>
