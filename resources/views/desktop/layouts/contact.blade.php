<div class="ourprocess-container">
	<div class="center-layout ourprocess-flex">
		<div class="ourprocess-left">
			<div class="ourprocess-left-info">
				<p class="ourprocess-left-title">{{lienhe}}</p>
			</div>
		</div>
		<div class="ourprocess-right">
			<form id="frm_contact" class="form-contact frm_check_recaptcha validation-contact" novalidate method="post" action="{{ route('sendContact') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <input type="hidden" name="type" value="lienhe" />
                <div class="row">
                	<div class="mb-3 col-sm-6 contact-formbox-left">
                		<div class="input-contact">
                            <label for="ten" class="inp">
                                <input type="text" class="form-control" name="ten" id="ten" placeholder="&nbsp;" required>
                                <span class="label">Họ tên</span>
                                <span class="focus-bg"></span>
                                <div class="invalid-feedback">{{vuilongnhaphoten}}</div>
                            </label>
                        </div>
                        <div class="input-contact">
                            <label for="dienthoai" class="inp">
                                <input type="number" class="form-control" name="dienthoai" id="dienthoai" placeholder="&nbsp;" required>
                                <span class="label">Điện thoại</span>
                                <span class="focus-bg"></span>
                                <div class="invalid-feedback">{{vuilongnhapsodienthoai}}</div>
                            </label>                                        
                        </div>
                        <div class="input-contact">
                            <label for="diachi" class="inp">
                                <input type="text" class="form-control" name="diachi" id="diachi" placeholder="&nbsp;" required>
                                <span class="label">Địa chỉ</span>
                                <span class="focus-bg"></span>
                                <div class="invalid-feedback">{{vuilongnhapdiachi}}</div>
                            </label>
                        </div>
                        <div class="input-contact">
                            <label for="email" class="inp">
                                <input type="email" class="form-control" name="email" id="email" placeholder="&nbsp;" required>
                                <span class="label">Email</span>
                                <span class="focus-bg"></span>
                                <div class="invalid-feedback">{{vuilongnhapdiachiemail}}</div>
                            </label>
                        </div>
                	</div>

                	<div class="col-sm-6 contact-formbox-right">
                		<div class="input-contact contact-form-bottom">
	                        <label for="noidung" class="inp">
	                            <textarea class="form-control" id="noidung" rows="8" name="noidung" placeholder="&nbsp;" required></textarea>
	                            <span class="label">Lời nhắn</span>
	                            <span class="focus-bg"></span>
	                            <div class="invalid-feedback">{{vuilongnhapnoidung}}</div>
	                        </label>
	                    </div>
	                    <input type="submit" class="btn btn-contact" name="submit-contact" value="Gửi" disabled />
                	</div>
                </div>
                
            </form>
		</div>
	</div>

	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>

</div>