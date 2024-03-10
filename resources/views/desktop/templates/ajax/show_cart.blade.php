<form method="post" action="" enctype="multipart/form-data" class="w-full h-full">

    <div class="wrap-cart">

        @if(count($row_cart)>0)

        <div class="top-cart">

            <div class="top-cart-top">

                @for($i=0;$i<count($row_cart);$i++)

                    @php

                    $pid = $row_cart[$i]['id_product'];

                    $quantity = $row_cart[$i]['soluong'];

                    $mau = ($row_cart[$i]['mau'])?$row_cart[$i]['mau']:0;

                    $size = ($row_cart[$i]['size'])?$row_cart[$i]['size']:0;

                    $code = ($row_cart[$i]['code'])?$row_cart[$i]['code']:"";

                    $km = ($row_cart[$i]['km'])?$row_cart[$i]['km']:"";

                    $proinfo = CartHelper::get_product_info($pid,$size,$mau);

                    

                    $pro_price = $proinfo['gia'];

                    $pro_price_new = $proinfo['giamoi'];

                    $pro_price_qty = $pro_price*$quantity;

                    $pro_price_new_qty = $pro_price_new*$quantity;

                    @endphp

                    <div class="procart procart-{{$code}} flex align-items-start justify-content-between">

                        <div class="pic-procart">

                            <a class="text-decoration-none" href="{{$proinfo['tenkhongdauvi']}}" target="_blank" title="{{$proinfo['ten'.$lang]}}"><img src="{{ (isset($proinfo['photo']))?Thumb::Crop(UPLOAD_PRODUCT,$proinfo['photo'],85,0,1,$proinfo['type']):'' }}" alt="{{$proinfo['tenkhongdau'.$lang]}}" onerror=src="{{Thumb::Crop('img/','noimage.png',85,0,1)}}" /></a>                            

                        </div>

                        <div class="info-procart">

                            <h3 class="name-procart"><a class="text-decoration-none" href="{{$proinfo['tenkhongdauvi']}}" target="_blank" title="{{$proinfo['ten'.$lang]}}">{{$proinfo['ten'.$lang]}}</a></h3>

                            <div class="properties-procart">

                                @if($mau)

                                    @php

                                        $maudetail = CartHelper::get_mau_info($mau);

                                    @endphp

                                    <p class="//change-prop-btn change-prop-btn-css" data-code="{{$code}}"><strong>{{$maudetail['ten'.$lang]}} {{--<i class="fal fa-chevron-down">--}}</i></strong></p>

                                @endif

                                @if($size) 

                                    @php

                                        $sizedetail = CartHelper::get_size_info($size);

                                    @endphp 

                                    <p class="//change-prop-btn change-prop-btn-css" data-code="{{$code}}">Phân loại: <strong>{{$sizedetail['ten'.$lang]}} {{--<i class="fal fa-chevron-down">--}}</strong></p>

                                @endif

                                <a class="del-procart text-decoration-none" data-code="{{$code}}">x</a>

                                <div class="mt-2 price-procart">

                                    @if($proinfo['giamoi'])

                                        <p class="price-new-cart load-price-new-{{$code}}">

                                            {!!Helper::Format_Money($pro_price_new_qty)!!}

                                        </p>



                                        @if($proinfo['giamoi']<$proinfo['gia'])

                                        <p class="price-old-cart load-price-{{$code}}">

                                            {!!Helper::Format_Money($pro_price_qty)!!}

                                        </p>

                                        @endif

                                    @else

                                        <p class="price-new-cart load-price-{{$code}}">

                                            {!!Helper::Format_Money($pro_price_qty)!!}

                                        </p>

                                    @endif

                                </div>

                            </div>

                            <div class="price-procart hide-price">

                                @if($proinfo['giamoi'])

                                    <p class="price-new-cart load-price-new-{{$code}}">

                                        {!!Helper::Format_Money($pro_price_new_qty)!!}

                                    </p>



                                    @if($proinfo['giamoi']<$proinfo['gia'])

                                    <p class="price-old-cart load-price-{{$code}}">

                                        {!!Helper::Format_Money($pro_price_qty)!!}

                                    </p>

                                    @endif

                                @else

                                    <p class="price-new-cart">

                                        Giá: <b class="load-price-{{$code}}">{!!Helper::Format_Money($pro_price_qty)!!}</b>

                                    </p>

                                @endif

                            </div>

                        </div>

                        <div class="quantity-procart">                            

                            <div class="quantity-counter-procart quantity-counter-procart-{{$code}} flex align-items-stretch justify-content-between">

                                <span class="counter-procart-minus counter-procart">-</span>

                                <input type="number" class="quantity-procat" min="1" value="{{$quantity}}" data-pid="{{$pid}}" data-code="{{$code}}"/>

                                <span class="counter-procart-plus counter-procart">+</span>

                            </div>

                            <div class="pic-procart pic-procart-rp">

                                <a class="text-decoration-none" href="{{$proinfo['tenkhongdauvi']}}" target="_blank" title="{{$proinfo['ten'.$lang]}}"><img src="{{ (isset($proinfo['photo']))?Thumb::Crop(UPLOAD_PRODUCT,$proinfo['photo'],85,0,1,$proinfo['type']):'' }}" alt="{{$proinfo['tenkhongdau'.$lang]}}" onerror=src="{{Thumb::Crop('img/','noimage.png',85,0,1)}}" /></a>

                                <a class="del-procart text-decoration-none" data-code="{{$code}}">

                                    <i class="fa fa-times-circle"></i>

                                </a>                        

                            </div>

                        </div>                              

                    </div>

                @endfor

            </div>

            <div class="top-cart-bot">

                <div class="money-procart">

                    @if(config('config_all.order.ship')==true)

                    <div class="flex items-center justify-between total-procart ">

                        <p>{{__('Tổng thanh toán')}}:</p>

                        <p class="total-price load-price-temp">{!!Helper::Format_Money(CartHelper::get_order_total($id_login,$token_member_cart))!!}</p>

                    </div>

                    @endif

                </div>            

                <div class="modal-footer">

                    <a class="flex items-center justify-center text-lg font-semibold uppercase align-middle btn-cart btn btn-danger btn-cart-buy" href="gio-hang" title="{{__('Thanh toán')}}">{{__('Thanh toán')}} <i class="ml-2 far fa-arrow-right"></i></a>

                </div>

            </div>

        </div>

        @else

            <a href="khoa-hoc" class="empty-cart text-decoration-none">

                {{-- <i class="fal fa-shopping-cart"></i> --}}
                <svg width="80" height="80"" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M20.71 16.71L18.29 14.29C18.197 14.1963 18.0864 14.1219 17.9646 14.0711C17.8427 14.0203 17.712 13.9942 17.58 13.9942C17.448 13.9942 17.3173 14.0203 17.1954 14.0711C17.0736 14.1219 16.963 14.1963 16.87 14.29L13.29 17.87C13.1973 17.9634 13.124 18.0743 13.0742 18.1961C13.0245 18.3179 12.9992 18.4484 13 18.58V21C13 21.2652 13.1054 21.5196 13.2929 21.7071C13.4804 21.8946 13.7348 22 14 22H16.42C16.5516 22.0008 16.6821 21.9755 16.8039 21.9258C16.9257 21.876 17.0366 21.8027 17.13 21.71L20.71 18.13C20.8037 18.037 20.8781 17.9264 20.9289 17.8046C20.9797 17.6827 21.0058 17.552 21.0058 17.42C21.0058 17.288 20.9797 17.1573 20.9289 17.0354C20.8781 16.9136 20.8037 16.803 20.71 16.71ZM16 20H15V19L17.58 16.42L18.58 17.42L16 20ZM10 20H6C5.73478 20 5.48043 19.8946 5.29289 19.7071C5.10536 19.5196 5 19.2652 5 19V5C5 4.73478 5.10536 4.48043 5.29289 4.29289C5.48043 4.10536 5.73478 4 6 4H11V7C11 7.79565 11.3161 8.55871 11.8787 9.12132C12.4413 9.68393 13.2044 10 14 10H17V11C17 11.2652 17.1054 11.5196 17.2929 11.7071C17.4804 11.8946 17.7348 12 18 12C18.2652 12 18.5196 11.8946 18.7071 11.7071C18.8946 11.5196 19 11.2652 19 11V9C19 9 19 9 19 8.94C18.9896 8.84813 18.9695 8.75763 18.94 8.67V8.58C18.8919 8.47718 18.8278 8.38267 18.75 8.3L12.75 2.3C12.6673 2.22222 12.5728 2.15808 12.47 2.11C12.4402 2.10576 12.4099 2.10576 12.38 2.11L12.06 2H6C5.20435 2 4.44129 2.31607 3.87868 2.87868C3.31607 3.44129 3 4.20435 3 5V19C3 19.7956 3.31607 20.5587 3.87868 21.1213C4.44129 21.6839 5.20435 22 6 22H10C10.2652 22 10.5196 21.8946 10.7071 21.7071C10.8946 21.5196 11 21.2652 11 21C11 20.7348 10.8946 20.4804 10.7071 20.2929C10.5196 20.1054 10.2652 20 10 20ZM13 5.41L15.59 8H14C13.7348 8 13.4804 7.89464 13.2929 7.70711C13.1054 7.51957 13 7.26522 13 7V5.41ZM8 14H14C14.2652 14 14.5196 13.8946 14.7071 13.7071C14.8946 13.5196 15 13.2652 15 13C15 12.7348 14.8946 12.4804 14.7071 12.2929C14.5196 12.1054 14.2652 12 14 12H8C7.73478 12 7.48043 12.1054 7.29289 12.2929C7.10536 12.4804 7 12.7348 7 13C7 13.2652 7.10536 13.5196 7.29289 13.7071C7.48043 13.8946 7.73478 14 8 14ZM8 10H9C9.26522 10 9.51957 9.89464 9.70711 9.70711C9.89464 9.51957 10 9.26522 10 9C10 8.73478 9.89464 8.48043 9.70711 8.29289C9.51957 8.10536 9.26522 8 9 8H8C7.73478 8 7.48043 8.10536 7.29289 8.29289C7.10536 8.48043 7 8.73478 7 9C7 9.26522 7.10536 9.51957 7.29289 9.70711C7.48043 9.89464 7.73478 10 8 10ZM10 16H8C7.73478 16 7.48043 16.1054 7.29289 16.2929C7.10536 16.4804 7 16.7348 7 17C7 17.2652 7.10536 17.5196 7.29289 17.7071C7.48043 17.8946 7.73478 18 8 18H10C10.2652 18 10.5196 17.8946 10.7071 17.7071C10.8946 17.5196 11 17.2652 11 17C11 16.7348 10.8946 16.4804 10.7071 16.2929C10.5196 16.1054 10.2652 16 10 16Z" fill="black"></path> </svg>

                <p>{{__('Chưa có sản phẩm nào được chọn')}}</p>

                <span class="rounded-md">{{__('Mua sản phẩm')}}</span>

            </a>

        @endif

    </div>

</form>