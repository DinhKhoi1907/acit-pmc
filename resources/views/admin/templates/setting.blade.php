@extends('admin.master')

@section('content')
	<form class="validation-form" novalidate method="post" action="{{route('admin.setting.save',['man',$type])}}" enctype="multipart/form-data">
		@csrf
		<div class="text-sm card-footer sticky-top">
			<button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="mr-2 far fa-save"></i>Lưu</button>
			<button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="mr-2 fas fa-redo"></i>Làm lại</button>
		</div>

		<div class="card card-primary card-outline text-sm {{(config('config_all.debug_developer')==true) ?'d-block' :'d-none'}}">
			<div class="card-header">
				<h3 class="card-title">Cấu hình mailer</h3>
			</div>
			<div class="card-body">
				<div class="form-group">
					<div class="mr-3 custom-control custom-radio d-inline-block text-md">
						<input class="custom-control-input mailertype" type="radio" id="mailertype-host" name="data[options][mailertype]" value="1" {{($options['mailertype']==1 || $options['mailertype']==0)?'checked':''}}>
						<label for="mailertype-host" class="custom-control-label font-weight-normal">Host email</label>
					</div>
					<div class="mr-3 custom-control custom-radio d-inline-block text-md">
						<input class="custom-control-input mailertype" type="radio" id="mailertype-gmail" name="data[options][mailertype]" value="2" {{($options['mailertype']==2 || $options['mailertype']==0)?'checked':''}}>
						<label for="mailertype-gmail" class="custom-control-label font-weight-normal">Gmail email</label>
					</div>
				</div>
				<div class="host-email {{ ($options['mailertype']==1 || $options['mailertype']==0)?'d-block':'d-none' }}">
					<div class="row">
						<div class="mb-4 form-group col-md-4 col-sm-6">
							<label for="ip_host" class="inp">
								<input type="text" class="form-control for-seo" name="data[options][ip_host]" id="ip_host" placeholder="&nbsp;" value="{{$options['ip_host']}}">
                                <span class="label">Host</span>
							</label>
						</div>
						<div class="mb-4 form-group col-md-4 col-sm-6">
							<label for="port_host" class="inp">
								<input type="text" class="form-control for-seo" name="data[options][port_host]" id="port_host" placeholder="&nbsp;" value="{{$options['port_host']}}">
                                <span class="label">Port</span>
							</label>
						</div>
						<div class="mb-4 form-group col-md-4 col-sm-6">
							<label for="secure_host" class="inp">
								<select class="form-control" name="data[options][secure_host]" id="secure_host" placeholder="&nbsp;">
									<option {{($options['secure_host']=='tls')?'selected':''}} value="tls">TLS</option>
									<option {{($options['secure_host']=='ssl')?'selected':''}} value="ssl">SSL</option>
								</select>
                                <span class="label">Secure</span>
							</label>
						</div>
						<div class="mb-4 form-group col-md-4 col-sm-6">
							<label for="email_host" class="inp">
								<input type="text" class="form-control for-seo" name="data[options][email_host]" id="email_host" placeholder="&nbsp;" value="{{$options['email_host']}}">
                                <span class="label">Email host</span>
							</label>
						</div>
						<div class="mb-4 form-group col-md-4 col-sm-6">
							<label for="password_host" class="inp">
								<input type="password" class="form-control for-seo" name="data[options][password_host]" id="password_host" placeholder="&nbsp;" value="{{$options['password_host']}}">
                                <span class="label">Password host</span>
							</label>
						</div>
					</div>
				</div>
				<div class="gmail-email {{ ($options['mailertype']==2)?'d-block':'d-none' }}">
					<div class="row">
						<div class="mb-4 form-group col-md-4 col-sm-6">
							<label for="host_gmail" class="inp">
								<input type="text" class="form-control for-seo" name="data[options][host_gmail]" id="host_gmail" placeholder="&nbsp;" value="{{$options['host_gmail']}}">
                                <span class="label">Host</span>
							</label>
						</div>
						<div class="mb-4 form-group col-md-4 col-sm-6">
							<label for="port_gmail" class="inp">
								<input type="text" class="form-control for-seo" name="data[options][port_gmail]" id="port_gmail" placeholder="&nbsp;" value="{{$options['port_gmail']}}">
                                <span class="label">Port</span>
							</label>
						</div>
						<div class="mb-4 form-group col-md-4 col-sm-6">
							<label for="secure_gmail" class="inp">
								<select class="form-control" name="data[options][secure_gmail]" id="secure_gmail" placeholder="&nbsp;">
									<option {{($options['secure_gmail']=='tls')?'selected':''}} value="tls">TLS</option>
									<option {{($options['secure_gmail']=='ssl')?'selected':''}} value="ssl">SSL</option>
								</select>
                                <span class="label">Secure</span>
							</label>
						</div>
						<div class="mb-4 form-group col-md-4 col-sm-6">
							<label for="email_gmail" class="inp">
								<input type="text" class="form-control for-seo" name="data[options][email_gmail]" id="email_gmail" placeholder="&nbsp;" value="{{$options['email_gmail']}}">
                                <span class="label">Email</span>
							</label>
						</div>
						<div class="mb-4 form-group col-md-4 col-sm-6">
							<label for="password_gmail" class="inp">
								<input type="password" class="form-control for-seo" name="data[options][password_gmail]" id="password_gmail" placeholder="&nbsp;" value="{{$options['password_gmail']}}">
                                <span class="label">Password</span>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
        	<div class="col-xl-8">
        		@if(config('config_all.menus')==true)
        		<div class="text-sm card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">Menu thể hiện ngoài website</h3>
					</div>
					<div class="card-body">
						<div class="form-group">
							@foreach($menus as $k=>$v)
								<div class="mr-3 custom-control custom-radio d-inline-block text-md">
									<input class="custom-control-input mailertype" type="radio" id="menu-select-{{$v['id']}}" name="data[menu]" value="{{$v['id']}}" {{(isset($rowItem['menu']) && $rowItem['menu']==$v['id'])?'checked':''}}>
									<label for="menu-select-{{$v['id']}}" class="custom-control-label font-weight-normal">{{$v['title']}}</label>
								</div>
							@endforeach
						</div>
					</div>
				</div>
				@endif

        		<div class="text-sm card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">Thông tin chung</h3>
					</div>
					<div class="card-body">
						@if(count(config('config_all.lang'))>1)
							<div class="form-group">
								<label>Ngôn ngữ mặc định:</label>
								<div class="form-group">
									@foreach(config('config_all.lang') as $k=>$v)
										<div class="mr-3 custom-control custom-radio d-inline-block text-md">
											<input class="custom-control-input" type="radio" id="lang_default-{{$k}}" name="data[options][lang_default]" value="{{$k}}" {{($options['lang_default']==$k)?'checked':''}}>
											<label for="lang_default-{{$k}}" class="custom-control-label font-weight-normal">{{$v}}</label>
										</div>
									@endforeach
								</div>
							</div>
						@endif

						<div class="row">
							@if(config('config_all.setting.diachi'))
								<div class="mb-4 form-group col-md-4 col-sm-6">
									<label for="hoten" class="inp">
										<input type="text" class="form-control for-seo" name="data[options][hoten]" id="hoten" placeholder="&nbsp;" value="{{ (isset($options['hoten']))?$options['hoten']:'' }}">
	                                    <span class="label">Họ tên</span>
									</label>
								</div>

								<div class="mb-4 form-group col-md-4 col-sm-6">
									<label for="diachi" class="inp">
										<input type="text" class="form-control for-seo" name="data[options][diachi]" id="diachi" placeholder="&nbsp;" value="{{ (isset($options['diachi']))?$options['diachi']:'' }}">
	                                    <span class="label">Địa chỉ</span>
									</label>
								</div>
							@endif
                            @if(config('config_all.setting.tenchinh'))
								<div class="mb-4 form-group col-md-4 col-sm-6">
									<label for="tenchinh" class="inp">
										<input type="text" class="form-control for-seo" name="data[options][tenchinh]" id="tenchinh" placeholder="&nbsp;" value="{{ (isset($options['tenchinh']))?$options['tenchinh']:'' }}">
	                                    <span class="label">Tên hiển thị</span>
									</label>
								</div>
							@endif
							@if(config('config_all.setting.email'))
								<div class="mb-4 form-group col-md-4 col-sm-6">
									<label for="email" class="inp">
										<input type="text" class="form-control for-seo" name="data[options][email]" id="email" placeholder="&nbsp;" value="{{ (isset($options['email']))?$options['email']:'' }}">
	                                    <span class="label">Email</span>
									</label>
								</div>
							@endif
							@if(config('config_all.setting.hotline'))
								<div class="mb-4 form-group col-md-4 col-sm-6">
									<label for="hotline" class="inp">
										<input type="text" class="form-control for-seo" name="data[options][hotline]" id="hotline" placeholder="&nbsp;" value="{{ (isset($options['hotline']))?$options['hotline']:'' }}">
	                                    <span class="label">Hotline 1</span>
									</label>
								</div>
							@endif
							@if(config('config_all.setting.dienthoai'))
								<div class="mb-4 form-group col-md-4 col-sm-6">
									<label for="dienthoai" class="inp">
										<input type="text" class="form-control for-seo" name="data[options][dienthoai]" id="dienthoai" placeholder="&nbsp;" value="{{ (isset($options['dienthoai']))?$options['dienthoai']:'' }}">
	                                    <span class="label">Hotline 2</span>
									</label>
								</div>
							@endif
							@if(config('config_all.setting.zalo'))
								<div class="mb-4 form-group col-md-4 col-sm-6">
									<label for="zalo" class="inp">
										<input type="text" class="form-control for-seo" name="data[options][zalo]" id="zalo" placeholder="&nbsp;" value="{{ (isset($options['zalo']))?$options['zalo']:'' }}">
	                                    <span class="label">Zalo</span>
									</label>
								</div>
							@endif
							@if(config('config_all.setting.oaidzalo'))
								<div class="mb-4 form-group col-md-4 col-sm-6">
									<label for="oaidzalo" class="inp">
										<input type="text" class="form-control for-seo" name="data[options][oaidzalo]" id="oaidzalo" placeholder="&nbsp;" value="{{ (isset($options['oaidzalo']))?$options['oaidzalo']:'' }}">
	                                    <span class="label">OAID Zalo</span>
									</label>
								</div>
							@endif
							@if(config('config_all.setting.website'))
								<div class="mb-4 form-group col-md-4 col-sm-6">
									<label for="website" class="inp">
										<input type="text" class="form-control for-seo" name="data[options][website]" id="website" placeholder="&nbsp;" value="{{ (isset($options['website']))?$options['website']:'' }}">
	                                    <span class="label">Website</span>
									</label>
								</div>
							@endif

							<div class="mb-4 form-group col-md-4 col-sm-6 d-none">
								<label for="tax" class="inp">
									<input type="text" class="form-control for-seo" name="data[options][tax]" id="tax" placeholder="&nbsp;" value="{{ (isset($options['tax']))?$options['tax']:'' }}">
									<span class="label">Tax ID</span>
								</label>
							</div>

							@if(config('config_all.setting.fanpage'))
								<div class="mb-4 form-group col-md-4 col-sm-6">
									<label for="fanpage" class="inp">
										<input type="text" class="form-control for-seo" name="data[options][fanpage]" id="fanpage" placeholder="&nbsp;" value="{{ (isset($options['fanpage']))?$options['fanpage']:'' }}">
	                                    <span class="label">Fanpage</span>
									</label>
								</div>
							@endif
							<div class="mb-4 form-group col-md-4 col-sm-6 d-none">
								<label for="instagram" class="inp">
									<input type="text" class="form-control for-seo" name="data[options][instagram]" id="instagram" placeholder="&nbsp;" value="{{ (isset($options['instagram']))?$options['instagram']:'' }}">
									<span class="label">Link Instagram</span>
								</label>
							</div>
							@if(config('config_all.setting.toado'))
								<div class="mb-4 form-group col-md-4 col-sm-6 d-none">
									<label for="toado" class="inp">
										<input type="text" class="form-control for-seo" name="data[options][toado]" id="toado" placeholder="&nbsp;" value="{{ (isset($options['toado']))?$options['toado']:'' }}">
	                                    <span class="label">Link google map</span>
									</label>
								</div>
							@endif
							<div class="mb-4 form-group col-md-4 col-sm-6 d-none">
								<label for="namthanhlap" class="inp">
									<input type="text" class="form-control for-seo" name="data[options][namthanhlap]" id="namthanhlap" placeholder="&nbsp;" value="{{ (isset($options['namthanhlap']))?$options['namthanhlap']:'' }}">
                                    <span class="label">Năm thành lập</span>
								</label>
							</div>
							<div class="mb-4 form-group col-md-12 col-sm-12 d-none">
								<label for="giohoatdong" class="inp">
									{{-- <input type="text" class="form-control for-seo" name="data[options][giohoatdong]" id="giohoatdong" placeholder="&nbsp;" value="{{ (isset($options['giohoatdong']))?$options['giohoatdong']:'' }}"> --}}
									<textarea class="form-control for-seo" name="data[options][giohoatdong]" id="giohoatdong" rows="8" placeholder="&nbsp;">{{ (isset($options['giohoatdong']))?$options['giohoatdong']:'' }}</textarea>
                                    <span class="label">Lịch làm việc</span>
								</label>
							</div>
							<div class="mb-4 form-group col-12">
								<label for="channel" class="inp">
									<input type="text" class="form-control for-seo" name="data[options][channel]" id="channel" placeholder="&nbsp;" value="{{ (isset($options['channel']))?$options['channel']:'' }}">
                                    <span class="label">Youtube channel</span>
								</label>
							</div>
							<div class="mb-4 form-group col-12">
								<label for="slogan" class="inp">
									<input type="text" class="form-control for-seo" name="data[options][slogan]" id="slogan" placeholder="&nbsp;" value="{{ (isset($options['slogan']))?$options['slogan']:'' }}">
                                    <span class="label">Slogan chính</span>
								</label>
							</div>
							<div class="mb-4 form-group col-12">
								<label for="sloganmota" class="inp">
									<input type="text" class="form-control for-seo" name="data[options][sloganmota]" id="sloganmota" placeholder="&nbsp;" value="{{ (isset($options['sloganmota']))?$options['sloganmota']:'' }}">
                                    <span class="label">Slogan Mô tả</span>
								</label>
							</div>

							<div class="mb-4 form-group col-md-12 col-sm-6">
								<label for="diachi" class="inp">
									<input type="text" class="form-control for-seo" name="data[options][diachi]" id="diachi" placeholder="&nbsp;" value="{{ (isset($options['diachi']))?$options['diachi']:'' }}">
                                    <span class="label">Địa chỉ</span>
								</label>
							</div>
							<div class="mb-4 form-group col-md-12 col-sm-6">
								<label for="tinhthanh" class="inp">
									<input type="text" class="form-control for-seo" name="data[options][tinhthanh]" id="tinhthanh" placeholder="&nbsp;" value="{{ (isset($options['tinhthanh']))?$options['tinhthanh']:'' }}">
                                    <span class="label">Tỉnh thành</span>
								</label>
							</div>

							{{-- <div class="mb-4 form-group col-12">
								<label for="messenger" class="inp">
									<input type="text" class="form-control for-seo" name="data[options][messenger]" id="messenger" placeholder="&nbsp;" value="{{ (isset($options['messenger']))?$options['messenger']:'' }}">
									<span class="label">Link Messenger</span>
								</label>
							</div> --}}

							{{-- <div class="mb-4 form-group col-md-4 col-sm-6">
								<label for="shopee" class="inp">
									<input type="text" class="form-control for-seo" name="data[options][shopee]" id="shopee" placeholder="&nbsp;" value="{{ (isset($options['shopee']))?$options['shopee']:'' }}">
                                    <span class="label">Link shopee</span>
								</label>
							</div>

							<div class="mb-4 form-group col-md-4 col-sm-6">
								<label for="lazada" class="inp">
									<input type="text" class="form-control for-seo" name="data[options][lazada]" id="lazada" placeholder="&nbsp;" value="{{ (isset($options['lazada']))?$options['lazada']:'' }}">
                                    <span class="label">Link lazada</span>
								</label>
							</div> --}}

							{{-- <div class="mb-4 form-group col-md-4 col-sm-6">
								<label for="telegram" class="inp">
									<input type="text" class="form-control for-seo" name="data[options][telegram]" id="telegram" placeholder="&nbsp;" value="{{ (isset($options['telegram']))?$options['telegram']:'' }}">
                                    <span class="label">Telegram</span>
								</label>
							</div>
							<div class="mb-4 form-group col-md-4 col-sm-6">
								<label for="telegram_chanel" class="inp">
									<input type="text" class="form-control for-seo" name="data[options][telegram_chanel]" id="telegram_chanel" placeholder="&nbsp;" value="{{ (isset($options['telegram_chanel']))?$options['telegram_chanel']:'' }}">
                                    <span class="label">Telegram Chanel</span>
								</label>
							</div>
							<div class="mb-4 form-group col-md-4 col-sm-6">
								<label for="sellermql" class="inp">
									<input type="text" class="form-control for-seo" name="data[options][sellermql]" id="sellermql" placeholder="&nbsp;" value="{{ (isset($options['sellermql']))?$options['sellermql']:'' }}">
                                    <span class="label">Seller MQL5</span>
								</label>
							</div> --}}
						</div>
						{{-- <div class="form-group">
							<label for="marquee" class="inp">
                            	<textarea class="form-control for-seo" name="data[options][marquee]" id="marquee" rows="8" placeholder="&nbsp;">{{ (isset($options['marquee']))?$options['marquee']:'' }}</textarea>
                            	<span class="label">Slogan Footer</span>
								<span class="focus-bg"></span>
                            </label>
						</div> --}}
						@if(config('config_all.setting.toado_iframe'))
							<div class="form-group">
								<a class="mb-2 ml-1 text-sm font-weight-normal d-block" style="color:#26b99a" href="https://www.google.com/maps" target="_blank" title="Lấy mã nhúng google map"><b><i class="fas fa-map-marked-alt"></i> (Lấy mã nhúng)</b></a>
								<label for="toado_iframe" class="inp">
	                            	<textarea class="form-control for-seo" name="data[options][toado_iframe]" id="toado_iframe" rows="5" placeholder="&nbsp;">{{ (isset($options['toado_iframe']))?$options['toado_iframe']:'' }}</textarea>
	                            	<span class="label">Tọa độ google map iframe</span>
									<span class="focus-bg"></span>
	                            </label>
							</div>
						@endif
						<div class="form-group">
							<label for="analytics" class="inp">
                            	<textarea class="form-control for-seo" name="data[options][annalytics]" id="analytics" rows="5" placeholder="&nbsp;">{{ (isset($options['annalytics']))?$options['annalytics']:'' }}</textarea>
                            	<span class="label">Google analytics</span>
								<span class="focus-bg"></span>
                            </label>
						</div>
						<div class="form-group">
							<label for="mastertool" class="inp">
                            	<textarea class="form-control for-seo" name="data[options][mastertool]" id="mastertool" rows="5" placeholder="&nbsp;">{{ (isset($options['mastertool']))?$options['mastertool']:'' }}</textarea>
                            	<span class="label">Google Webmaster Tool</span>
								<span class="focus-bg"></span>
                            </label>
						</div>
					</div>
				</div>

				<div class="text-sm card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">Thông tin khác</h3>
					</div>
					<div class="card-body">
						<div class="card card-primary card-outline card-outline-tabs">
							<div class="p-0 card-header border-bottom-0">
								<ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
									@foreach(config('config_all.lang') as $k=>$v)
										<li class="nav-item">
											<a class="nav-link {{($k=='vi')?'active':''}}" id="tabs-lang" data-toggle="pill" href="#tabs-lang-{{$k}}" role="tab" aria-controls="tabs-lang-{{$k}}" aria-selected="true">{{$v}}</a>
										</li>
									@endforeach
								</ul>
							</div>
							<div class="card-body card-article">
								<div class="tab-content" id="custom-tabs-three-tabContent-lang">
									@foreach(config('config_all.lang') as $k=>$v)
										@php
	                                        TableManipulation::AddFieldToTable('setting','ten'.$k, 'string');
	                                    @endphp
										<div class="tab-pane fade show {{($k=='vi')?'active':''}}" id="tabs-lang-{{$k}}" role="tabpanel" aria-labelledby="tabs-lang">
											<div class="form-group">
												<label for="ten{{$k}}" class="inp">
													<input type="text" class="form-control for-seo" name="data[ten{{$k}}]" id="ten{{$k}}" placeholder="&nbsp;" value="{{ (isset($rowItem['ten'.$k]))?$rowItem['ten'.$k]:'' }}" require="{{($k=='vi')?'required':''}}">
				                                    <span class="label">Tiêu đề ({{$k}})</span>
												</label>
											</div>
											<div class="form-group d-none">
												<label for="diachi{{$k}}" class="inp">
													<input type="text" class="form-control for-seo" name="data[diachi{{$k}}]" id="diachi{{$k}}" placeholder="&nbsp;" value="{{ (isset($rowItem['diachi'.$k]))?$rowItem['diachi'.$k]:'' }}" require="{{($k=='vi')?'required':''}}">
				                                    <span class="label">Địa chỉ ({{$k}})</span>
												</label>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="linkadmin" class="inp">
								<input type="text" class="form-control for-seo" name="data[options][linkadmin]" id="linkadmin" placeholder="&nbsp;" value="{{ (isset($options['linkadmin']))?$options['linkadmin']:'admin' }}" required>
	                            <span class="label">[Link admin] - {{config('config_all.config_all_url')}}</span>
							</label>
						</div>
						<div class="form-group">
							<label for="headjs" class="inp">
                            	<textarea class="form-control for-seo" name="data[headjs]" id="headjs" rows="5" placeholder="&nbsp;">{{ (isset($rowItem['headjs']))?$rowItem['headjs']:'' }}</textarea>
                            	<span class="label">Head JS</span>
								<span class="focus-bg"></span>
                            </label>
						</div>
						<div class="form-group">
							<label for="bodyjs" class="inp">
                            	<textarea class="form-control for-seo" name="data[bodyjs]" id="bodyjs" rows="5" placeholder="&nbsp;">{{ (isset($rowItem['bodyjs']))?$rowItem['bodyjs']:'' }}</textarea>
                            	<span class="label">Body JS</span>
								<span class="focus-bg"></span>
                            </label>
						</div>
						<div class="form-group">
							<label for="fanpagejs" class="inp">
                            	<textarea class="form-control for-seo" name="data[fanpagejs]" id="fanpagejs" rows="5" placeholder="&nbsp;">{{ (isset($rowItem['fanpagejs']))?$rowItem['fanpagejs']:'' }}</textarea>
                            	<span class="label">Fanpage JS</span>
								<span class="focus-bg"></span>
                            </label>
						</div>
					</div>
				</div>
        	</div>

        	<div class="col-xl-4">
        		{{--
        		@if(config('config_all.order.soluong'))
        		<div class="text-sm card card-primary card-outline">
					<div class="mt-4 card-body">
						<div class="form-group">
	                        <label for="hienthi" class="mb-0 mr-2 align-middle d-inline-block">Đặt hàng giới hạn số lượng:</label>
	                        <div class="align-middle custom-control custom-checkbox d-inline-block">
	                            @if($rowItem['isSoluong']==1 || !isset($rowItem))
	                            <input type="checkbox" class="custom-control-input soluong-checkbox" name="data[isSoluong]" id="soluong-checkbox" checked>
	                            @else
	                            <input type="checkbox" class="custom-control-input soluong-checkbox" name="data[isSoluong]" id="soluong-checkbox">
	                            @endif
	                            <label for="soluong-checkbox" class="custom-control-label"></label>
	                        </div>
	                    </div>
	                    <div style="background: #f5f5f5; padding: 10px; border-radius: 5px; font-style: italic;">
	                    	<i class="far fa-question-square"></i> Chọn thiết lập này sẽ giúp quản lý số lượng sản phẩm, khách hàng chỉ có thể mua và tạo đơn hàng khi số lượng sản phẩm còn cho phép. Quản trị viên quản lý số lượng sản phẩm tại mục 'Số lượng' trong mỗi sản phẩm.</br>
	                    	<i class="far fa-question-square"></i> Bỏ chọn thiết lập đồng nghĩa với việc <strong>không cho phép</strong> quản lý số lượng sản phẩm.
	                    </div>
					</div>
				</div>
				@endif
				--}}


                {{-- <div class="text-sm card card-primary card-outline d-none">
					<div class="card-header">
						<h3 class="card-title">Quy ước xu</h3>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label for="giatrixu" class="inp">
								<input type="text" class="form-control for-seo" name="data[options][giatrixu]" id="giatrixu" placeholder="&nbsp;" value="{{ (isset($options['giatrixu']))?$options['giatrixu']:'0' }}" required>
	                            <span class="label">Giá trị xu: 1 xu tương ứng ? vnđ</span>
							</label>
						</div>
						<div class="form-group">
							<label for="phantramhoahong" class="inp">
								<input type="number" class="form-control for-seo" name="data[options][phantramhoahong]" id="phantramhoahong" placeholder="&nbsp;" value="{{ (isset($options['phantramhoahong']))?$options['phantramhoahong']:'0' }}" required>
	                            <span class="label">% xu sẽ nhận từ người xem tin</span>
							</label>
						</div>

						<div class="form-group">
							<label for="tongxu" class="inp">
								<input type="text" class="form-control for-seo" id="tongxu" placeholder="&nbsp;" value="{{ (isset($rowItem['tongxu']))?$rowItem['tongxu']:'0' }}" readonly>
	                            <span class="label">Tổng xu hiện có</span>
							</label>
						</div>

						<div class="form-group">
							<label for="goitheothang" class="inp">
								<input type="text" class="form-control for-seo" name="data[options][goitheothang]" id="goitheothang" placeholder="&nbsp;" value="{{ (isset($options['goitheothang']))?$options['goitheothang']:'0' }}">
	                            <span class="label">Phí tin theo tháng (xu)</span>
							</label>
						</div>

					</div>
				</div> --}}


				{{-- <div class="text-sm card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">Lịch sử xu nhận</h3>
					</div>
					<div class="card-body">
						<div class="historypay-main">
							@if($history_coin)
								@foreach($history_coin as $k=>$v)
									@php
										$user_nhan = $v['user_nhan'];
										$user_tra = $v['user_tra'];
										$post = $v['has_post'];
									@endphp
									<div class="historypay-item">
										<div class="historypay-top"><i class="mr-1 fal fa-history"></i> {{date('H:i d/m/Y', $v['ngaytao'])}}</div>
										<div class="historypay-bottom">
											<strong>+{{$v['soxu']}} xu</strong> từ tài khoản <span>{{'@'.$user_tra['name']}}</span>
											@if($v['typepage']=='goitinthang')
												<p>Đăng ký <a>'Gói tin theo tháng'</a></p>
											@else
												<p>Xem tin đăng <a>'{{$post['tenvi']}}'</a></p>
											@endif
										</div>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				</div> --}}


        		@if(isset($config[$type]['seo']) && $config[$type]['seo'] == true)
				<div class="text-sm card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">Nội dung SEO</h3>
						<a class="float-right text-white btn btn-sm bg-gradient-success d-inline-block create-seo" title="Tạo SEO">Tạo SEO</a>
					</div>
					<div class="card-body">
						@include('admin.layouts.seo')
					</div>
				</div>
				@endif
        	</div>
        </div>

		<div class="text-sm card-footer">
			<input type="hidden" name="id" value="{{ (isset($rowItem['id']))?$rowItem['id']:'' }}">
		</div>
	</form>
@endsection

<!--js thêm cho mỗi trang-->
@section('js_page')
	<script type="text/javascript">
		$(document).ready(function(){
			$(".mailertype").click(function(){
				var value = parseInt($(this).val());

				if(value == 1)
				{
					$(".host-email").removeClass("d-none");
					$(".host-email").addClass("d-block");
					$(".gmail-email").removeClass("d-block");
					$(".gmail-email").addClass("d-none");
				}
				if(value == 2)
				{
					$(".gmail-email").removeClass("d-none");
					$(".gmail-email").addClass("d-block");
					$(".host-email").removeClass("d-block");
					$(".host-email").addClass("d-none");
				}
			})
		})
	</script>
@endsection
