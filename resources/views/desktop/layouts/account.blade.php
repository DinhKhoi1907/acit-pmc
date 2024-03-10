{{--SHOW POPUP--}}
<div id="show-popup-post" class="show-popup-post">
	<div class="bg-white md:w-[1000px] w-full shadow-shadow4 relative z-50" id="show-content-ajax">
		<div class="flex items-center justify-between px-6 md:px-12 ">
			<div class="font-bold text-cmain2 md:text-[30px] uppercase text-[24px]"><span>Đăng ký - đăng nhập</span></div>
			<span class="py-2 cursor-pointer show-popup-close md:py-4"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"><path fill="#1B4932" d="M23 20.168l-8.185-8.187 8.185-8.174-2.832-2.807-8.182 8.179-8.176-8.179-2.81 2.81 8.186 8.196-8.186 8.184 2.81 2.81 8.203-8.192 8.18 8.192z"/></svg></span>
		</div>
	
		<div class="md:p-12 p-6 max-h-[88%] overflow-auto scroll-css">
			abc
		</div>
	</div>
	<span class="fixed top-0 left-0 w-full h-full opacity-0 -z-10 show-popup-blur"></span>
</div>




{{-- <div id="sign-in" class="hfancybox hfancybox--400 bg-light">
    <a href="" class="himg">
        <img src="{{UPLOAD_PHOTO.$logo['photo']}}" width="120" class="mx-auto" alt="Logo">
    </a>
    <div class="hlogin__owl owl-carousel owl-theme">
        <div class="hlogin__owl-items">
            <div class="py-3 text-center text-muted">{{dangnhaptaikhoan}}</div>
            <div id="js-sign-in-error"></div>
            <form id="login_form" class="bg-white hlogin-form js-account" method="post" action="{{route('account.login')}}">
                @csrf
                <div class="hlogin-form__input-group">
                    <div class="hlogin-form__input-group__icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <input type="text" name="username" placeholder="{{tendangnhap}}" required>
                </div>
                <div class="hlogin-form__input-group">
                    <div class="hlogin-form__input-group__icon">
                        <i class="fas fa-lock-alt"></i>
                    </div>
                    <input type="password" name="password" placeholder="{{matkhau}}" required>
                </div>
                <button type="submit" class="hlogin-form__button">{{dangnhap}}</button>
            </form>
            <div class="py-3 hlogin__option">
                <button type="button" class="custom-owl-to" data-target=".hlogin__owl" data-position="1">{{dangkytaikhoan}}</button>
                <button type="button" class="custom-owl-to" data-target=".hlogin__owl" data-position="2">{{banquenmatkhau}}</button>
            </div>
        </div>
        <div class="hlogin__owl-items">
            <div class="py-3 text-center text-muted">{{dangkytaikhoan}}</div>
            <div id="show-error"></div>
            <form id="signin_form" class="bg-white hlogin-form js-account" method="post" action="{{route('account.signin')}}">
                @csrf
                <div class="hlogin-form__input-group">
                    <div class="hlogin-form__input-group__icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <input type="text" name="username" placeholder="{{tendangnhap}}" required>
                </div>
                <div class="hlogin-form__input-group">
                    <div class="hlogin-form__input-group__icon">
                        <i class="fas fa-lock-alt"></i>
                    </div>
                    <input type="password" name="password" placeholder="{{matkhau}}" required>
                </div>
                <div class="hlogin-form__input-group">
                    <div class="hlogin-form__input-group__icon">
                        <i class="fas fa-lock-alt"></i>
                    </div>
                    <input type="password" name="repassword" placeholder="{{nhaplaimatkhau}}" required>
                </div>
                <div class="hlogin-form__input-group">
                    <div class="hlogin-form__input-group__icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <input type="text" name="name" placeholder="{{hoten}}" required>
                </div>
                <div class="hlogin-form__input-group">
                    <div class="hlogin-form__input-group__icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <input type="text" name="phonenumber" placeholder="{{sodienthoai}}" required>
                </div>
                <div class="hlogin-form__input-group">
                    <div class="hlogin-form__input-group__icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <button type="submit" class="hlogin-form__button">{{dangky}}</button>
            </form>
            <div class="py-3 hlogin__option">
                <button type="button" class="custom-owl-to" data-target=".hlogin__owl" data-position="0">{{dangnhaptaikhoan}}</button>
                <button type="button" class="custom-owl-to" data-target=".hlogin__owl" data-position="2">{{banquenmatkhau}}</button>
            </div>
        </div>
        <div class="hlogin__owl-items">
            <div class="py-3 text-center text-muted">{{quenmatkhauvataikhoan}}</div>
            <form id="resetAccount_form" class="bg-white hlogin-form js-account" method="post" action="{{route('account.resetAccount')}}">
                @csrf
                <div class="hlogin-form__input-group">
                    <div class="hlogin-form__input-group__icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <input type="text" name="username" placeholder="{{tendangnhap}}" required>
                </div>
                <div class="hlogin-form__input-group">
                    <div class="hlogin-form__input-group__icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <button type="submit" class="hlogin-form__button">{{laylaimatkhau}}</button>
            </form>
            <div class="py-3 hlogin__option">
                <button type="button" class="custom-owl-to" data-target=".hlogin__owl" data-position="0">{{dangnhaptaikhoan}}</button>
                <button type="button" class="custom-owl-to" data-target=".hlogin__owl" data-position="1">{{dangkytaikhoan}}</button>
            </div>
        </div>
        <div class="hlogin__owl-items"></div>
    </div>
    <div class="hlogin__with">
        <button type="button" onclick="SocialLogin('{{ route('social.login', 'facebook') }}')">
            <i class="fab fa-facebook-f"></i>
            <span>Facebook</span>
        </button>
        <button type="button" onclick="SocialLogin('{{ route('social.login', 'google') }}')">
            <i class="fab fa-google"></i>
            <span>{{dangnhapgoogle}}</span>
        </button>
    </div>
</div> --}}
