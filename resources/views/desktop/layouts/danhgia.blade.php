{{-- <div class="home-news bortop padlr">
	<h2 class="home-title"><span>Đánh giá</span></h2>
	<div class="center-layout danhgia-layout">
		<div class="danhgia-layout-left">
			<div class="danhgia-layout-total">
				<div class="danhgia-layout-score">{{$average_score}}.0</div>
				<div class="danhgia-layout-stars">
					<div class="danhgia-list-stars">
						@for($i=1;$i<=$average_score;$i++)
							<i class="fas fa-star"></i>
						@endfor
						@for($i=$average_score+1;$i<=5;$i++)
							<i class="far fa-star"></i>
						@endfor
					</div>					
				</div>
				<div class="danhgia-count-stars">({{($info_rating['allrating']) ?? 0}} lượt đánh giá)</div>
			</div>
			<div class="danhgia-layout-detail">
				<div class="danhgia-layout-box">
					<div class="danhgia-layout-row gx-3 gy-12">
						<div class="row col-12">
							<div class="col-3 danhgia-formlist-stars">1 <i class="fas fa-star"></i></div>
							<div class="col-9">
								<div class="row align-items-center gx-3">
									<div class="col-9">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="{{$phantram_onestar}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$phantram_onestar}}%;"></div>
										</div>
									</div>
									<div class="col-3 fw-medium">{{$phantram_onestar}}% </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="danhgia-layout-box">
					<div class="danhgia-layout-row gx-3 gy-12">
						<div class="row col-12">
							<div class="col-3 danhgia-formlist-stars">2 <i class="fas fa-star"></i></div>
							<div class="col-9">
								<div class="row align-items-center gx-3">
									<div class="col-9">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="{{$phantram_twostar}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$phantram_twostar}}%;"></div>
										</div>
									</div>
									<div class="col-3 fw-medium">{{$phantram_twostar}}% </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="danhgia-layout-box">
					<div class="danhgia-layout-row gx-3 gy-12">
						<div class="row col-12">
							<div class="col-3 danhgia-formlist-stars">3 <i class="fas fa-star"></i></div>
							<div class="col-9">
								<div class="row align-items-center gx-3">
									<div class="col-9">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="{{$phantram_threestar}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$phantram_threestar}}%;"></div>
										</div>
									</div>
									<div class="col-3 fw-medium">{{$phantram_threestar}}% </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="danhgia-layout-box">
					<div class="danhgia-layout-row gx-3 gy-12">
						<div class="row col-12">
							<div class="col-3 danhgia-formlist-stars">4 <i class="fas fa-star"></i></div>
							<div class="col-9">
								<div class="row align-items-center gx-3">
									<div class="col-9">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="{{$phantram_fourstar}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$phantram_fourstar}}%;"></div>
										</div>
									</div>
									<div class="col-3 fw-medium">{{$phantram_fourstar}}% </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="danhgia-layout-box">
					<div class="danhgia-layout-row gx-3 gy-12">
						<div class="row col-12">
							<div class="col-3 danhgia-formlist-stars">5 <i class="fas fa-star"></i></div>
							<div class="col-9">
								<div class="row align-items-center gx-3">
									<div class="col-9">
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="{{$phantram_fivestar}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$phantram_fivestar}}%;"></div>
										</div>
									</div>
									<div class="col-3 fw-medium">{{$phantram_fivestar}}% </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="mt-3 row danhgia-button-tool">
		<div class="col-7 col-sm-12 danhgia-button-left">
			<div class="row danhgia-button-sort">
				<div class="mr-2 col-12 d-none">Sắp xếp theo:</div>
				<div class="col">
					<div class="row row-cols-auto">
						<div class="px-0 mr-2 col danhgia-btn-sm"><span class="danhgia-type-select danhgia-type-check" data-type="all" data-idproduct="{{$row_detail['id']}}">Tất cả</span></div>
						<div class="px-0 mr-2 col danhgia-btn-sm"><span class="danhgia-type-select" data-type="text" data-idproduct="{{$row_detail['id']}}">Bình luận bằng chữ</span></div>
						<div class="px-0 mr-2 col danhgia-btn-sm"><span class="danhgia-type-select" data-type="photo" data-idproduct="{{$row_detail['id']}}">Bình luận có hình ảnh</span></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-5 col-sm-12 danhgia-button-right"><button type="button" class="btn btn-dark rounded-3 btn-danhgia-submit"> Gửi đánh giá của bạn </button></div>
	</div> --}}

	<!--Form Thông tin-->
	<div class="form-danhgia">
		<form method="POST" action="" id="form-danhgia">
			@csrf
			<div class="form-danhgia-content">
				<span class="form-danhgia-close"><i class="fal fa-times"></i></span>
				<div class="form-danhgia-title">{{__('Đánh giá')}}</div>
				<div class="form-danhgia-value">
					<div class="form-danhgia-product">
						<img src="" alt="" width="69" height="77" class="bg-cmain4">
						<div class="ml-2 form-danhgia-product-name"></div>
					</div>
					<div class="form-danhgia-rating">
						<p class="form-danhgia-rating-ask">{{__('Bạn đánh giá sản phẩm thế nào')}} ?</p>
						<div class="form-danhgia-rating-star">
							<div class="form-star-item" data-value="1"><i class="far fa-star"></i><span>{{__('Rất tệ')}}</span></div>
							<div class="form-star-item" data-value="2"><i class="far fa-star"></i><span>{{__('Tệ')}}</span></div>
							<div class="form-star-item" data-value="3"><i class="far fa-star"></i><span>{{__('Bình thường')}}</span></div>
							<div class="form-star-item" data-value="4"><i class="far fa-star"></i><span>{{__('Tốt')}}</span></div>
							<div class="form-star-item" data-value="5"><i class="far fa-star"></i><span>{{__('Rất Tốt')}}</span></div>
						</div>					
					</div>
					<textarea name="rating_content" placeholder="{{__('Cảm nhận của bạn')}}..." class="form-rating-content"></textarea>
					<div class="rating-input-file">
						<input type="file" class="my-pond" name="photos[]" id="rating-file" multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="4">
					</div>
					<div class="form-danhgia-infomation">
						<input type="text" name="rating_name" placeholder="{{__('Họ và tên')}} (*)" value="{{$user['name']}}" required>
						<input type="text" name="rating_phone" placeholder="{{__('Số điện thoại')}} (*)" value="{{$user['phonenumber']}}" required>
						<input type="email" name="rating_email" placeholder="Email (*)" value="{{$user['email']}}" required>						
					</div>
					<p class="form-danhgia-submit"><input type="submit" name="" id="form-rating-submit" class="form-rating-submit" value="{{__('Gửi đánh giá')}}"></p>
					<input type="hidden" name="rating_count_star" value="1" id="rating-count-star">
					<input type="hidden" name="rating_id_product" value="">
				</div>
			</div>
		</form>
	</div>
</div>



@push('css_page')
	<link rel="stylesheet" href="{{ asset('css/filepond/filepond.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/filepond/filepond-plugin-image-preview.min.css') }}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"
    />
	<link rel="stylesheet" href="{{ asset('css/danhgia.css') }} ">
@endpush


@push('js_page')
	<script src="{{asset('js/uuidv4.min.js')}}"></script>
	<script src="{{asset('js/filepond/filepond.min.js')}}"></script>
	<script src="{{asset('js/filepond/filepond-plugin-image-preview.min.js')}}"></script>
	<script src="{{asset('js/filepond/filepond-plugin-file-encode.min.js')}}"></script>
	<script src="{{asset('js/filepond/filepond-plugin-image-resize.js')}}"></script>
	<script src="{{asset('js/filepond/filepond-plugin-file-rename.js')}}"></script>
	<script src="{{asset('js/filepond/filepond-plugin-file-validate-size.js')}}"></script>
	<script src="{{asset('js/filepond/filepond-plugin-file-validate-type.js')}}"></script>
	<script src="{{asset('js/filepond/filepond-plugin-image-validate-size.js')}}"></script>
	<script src="{{asset('js/filepond/filepond-plugin-image-transform.js')}}"></script>
	<script src="{{asset('js/filepond/filepond-plugin-image-crop.js')}}"></script>
	<script src="{{asset('js/filepond/filepond.jquery.js')}}"></script>

	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

	<script>
		$('.form-danhgia-close').click(function(){
			$('.form-danhgia').removeClass('form-danhgia-active');
		});


		$('.btn-danhgia-submit').click(function(){
			var id = $(this).attr('data-idpro');
			var photo = $(this).attr('data-imgpro');
			var name = $(this).attr('data-namepro');
			$('.form-danhgia-product').find('img').attr('src',photo);
			$('.form-danhgia-product-name').text(name);
			$('input[name="rating_id_product"]').val(id);
			$('.form-danhgia').addClass('form-danhgia-active');
		});
		

		$('.form-star-item').click(function(){
			var value = parseInt($(this).attr('data-value'));

			$('.form-star-item').find('i').removeClass('far fa-star fas');
			for(var i = 1; i<=value; i++){
				$('.form-star-item').eq(i-1).find('i').addClass('fas fa-star');
			}
			for(var i = (value+1); i<=5; i++){
				$('.form-star-item').eq(i-1).find('i').addClass('far fa-star');				
			}

			$('#rating-count-star').val(value);
		});
	</script>

	<script>
		// First register any plugins
	    $.fn.filepond.registerPlugin(
	    	FilePondPluginFileEncode,
      		FilePondPluginFileRename,
      		FilePondPluginFileValidateSize,
	      	FilePondPluginFileValidateType,
	      	FilePondPluginImageValidateSize,
	      	FilePondPluginImageResize,
	      	FilePondPluginImageTransform,
	      	FilePondPluginImageCrop,
	      	FilePondPluginImagePreview
	    );

	    $.fn.filepond.setDefaults({
	      labelIdle: '+ '+LANG_KEY['themhinhanhminhhoa'],
	      acceptedFileTypes: ['image/png', 'image/jpeg', 'video/quicktime', 'video/mp4'],
	      imageValidateSizeMinWidth: 200,
	      imageValidateSizeMaxWidth: 2000,
	      imageValidateSizeMinHeight: 200,
	      imageValidateSizeMaxHeight: 2000,
	      imageResizeMode: 'force',
	      imageCropAspectRatio: '1:1'
	    });

	    $('.my-pond').filepond();

	    FilePond.setOptions({
	      fileRenameFunction: (file) => {
	        return uuidv4() + `${file.extension}`;
	      }
	    })

	    $('.my-pond-reply').filepond();
	    FilePond.setOptions({
	      fileRenameFunction: (file) => {
	        return uuidv4() + `${file.extension}`;
	      }
	    })

	    FilePond.create({
	      imageResizeTargetWidth: 1000,
	      imageCropAspectRatio: 1,
	      imageTransformVariants: {
	        thumb_medium_: (transforms) => {
	          transforms.resize = {
	            size: {
	              width: 1000,
	              height: 1000,
	            },
	          };
	          return transforms;
	        }
	      },
	    });


		// $('.form-rating-submit').click(function(){
		// 	$('#form-danhgia').trigger('submit');
		// });


	    $('#form-danhgia').submit(function(e){
			e.preventDefault();
			//console.log('ok');return false;
			$('#loading_order').show();

			var formData = new FormData($('#form-danhgia')[0]);

			$.ajax({
				url:'{{route('ajax.add.danhgia')}}',
				type: "POST",
				dataType: 'json',				
				data: formData,
				processData: false,
		    	contentType: false,
				success: function(result){
					if(result) {
						Swal.fire({
						  position: 'top',
						  icon: result.icon,
						  title: '<p class="h6">'+result.text+'</p>',
						  showConfirmButton: false,
						  timer: 2500,
						  toast: true
					  	});
						$('.form-danhgia').removeClass('form-danhgia-active');
						$('.form-star-item').find('i').removeClass('fas fa-star');
						$('.form-star-item').find('i').addClass('far fa-star');
						$('#form-danhgia')[0].reset();
						location.reload(true);
					}
				},
				complete: function(){}
			});
		});


		$('.danhgia-type-select').click(function(){
			var type = $(this).attr('data-type');
			var id_product = $(this).attr('data-idproduct');

			$('.danhgia-type-select').removeClass('danhgia-type-check');
			$(this).addClass('danhgia-type-check');

			pagination_danhgia(type,id_product);
		});


		//### click page number button
		$(document).on('click', '#show_danhgia_ajax .pagination a', function(event){
			event.preventDefault();
				var page = $(this).attr('href').split('page=')[1];
				var type = $('.danhgia-type-select').attr('data-type');
				var id_product = $('.danhgia-type-select').attr('data-idproduct');

				pagination_danhgia(type,id_product,page);
		});


		function pagination_danhgia(type,id_product,page=0)
		{
			$.ajax({
				url:'{{route('ajax.change.danhgia')}}',
				type: "GET",
				dataType: 'html',
				async: true,
				data: {type:type,id_product:id_product,page:page},
				success: function(result){
					$('#show_danhgia_ajax').html(result);
				},
				complete: function(){}
			});
		}


		//### Cut thumb video
		/*$('.danhgia-load-canvas').each(function(){
			var id = $(this).attr('data-id');
			//var video = $('#video-'+id);
			let video = document.querySelector('#video-'+id);
			let canvas = document.querySelector("#video-canvas-"+id);
			let ctx = canvas.getContext("2d");

			let width = 0;
			let height = 0;				

			video.load();
			video.currentTime = 0;

		    video.addEventListener("loadedmetadata", function () {//loadedmetadata pause		    	
		    	$('#video-'+id).trigger('click');
		        width = this.videoWidth;
		        height = this.videoHeight;	

		        // Set canvas dimensions same as video dimensions
   				canvas.width = width;
				canvas.height = height;
				ctx.drawImage(video, 0, 0);
		    });
		});*/
	</script>
@endpush