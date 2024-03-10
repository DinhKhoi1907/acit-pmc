<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/DTD/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script LANGUAGE="JavaScript">
		window.print();
	</script>
	<style>
		*{ margin:0px ; padding:0px; box-sizing: border-box;}
		body{ font-family:Arial, Helvetica, sans-serif;	font-size:14px;	line-height:1.3; }

      /*===HEADER===*/
      .print_container{border:1px solid #000;margin:0;width:100%;height:100%;min-height:520px;font-size:12px;}
      .print_header{border-bottom:1px dotted #000;height:95px;display: flex;align-items: center;}
      .print_header_left{float:left;padding:5px 5px 0px;width:40%;text-align: center;}
      .print_header_left img{/*width:100%;*/}
      .print_header_logo{width:100%;margin-top:5px;}
      .print_header_logovandon{margin-top:2px;}
      .print_header_right{float:left;padding:5px 5px 0px;width:60%;text-align:center;margin-top:5px;}
      .print_header_right >div{vertical-align:top;}
	   .print_header_barcode{display: inline-block;height: 40px;}
      .print_header_idorder{margin:5px 0;font-size:12px;}
	   .print_header_barcode div{font-size:14px;}

      .print_header_2{border-bottom:1px dotted #000;height:95px;}


      /*===MIDDLE===*/
      .print_middle{border-bottom:1px dotted #000;height:110px;display: flex; align-items: center;}
      .print_middle_left{float:left;width:50%;padding:5px;}
      .print_middle_right{float:left;width:50%;padding:5px;}


      /*===BODY===*/
      .print_body{border-bottom:1px dotted #000;min-height:170px;padding:5px;font-size:11px;}
      .print_body_main{width:100%;padding:5px;height:150px;overflow: hidden;}


      /*===FOOTER===*/
      .print_footer{height:80px;}
      .print_footer_left{float:left;width:40%;padding:5px;}
      .print_footer_right{float:left;width:60%;padding:5px;vertical-align:top;}

	</style>
</head>
<body>
	<div class="print_container">
         <!--PRINT HEADER-->
         @if($result['is_created_order_delivery']==0)
         <div class="print_header" style="">
            <div class="print_header_left">
               <div class="print_header_logo">
                  <img src="{{($logo) ? $logo : asset('img/noimage.jpg')}}" style="//filter: grayscale(1) invert(1);" width="100px"/>
               </div>
            </div>
            <div class="print_header_right">
               <div>
                  <!--{__MA_VACH_ID_DON_HANG__}-->
                  <div class="print_header_barcode">{!! DNS1D::getBarcodeSVG($result['madonhang'], "C128", 1.2,40) !!}</div>
                  <div class="print_header_idorder">ID đơn hàng: <strong>{{$result['madonhang']}}</strong></div>
               </div>
            </div>
            <div style="clear:both;">&nbsp;</div>
         </div>
		 @else
		 <div class="print_header" style="">
            <div class="print_header_left">
               <div class="print_header_logo">
                  <img src="{{($logo) ? $logo : asset('img/noimage.jpg')}}" style="//filter: grayscale(1) invert(1);"/>
               </div>
            </div>
            <div class="print_header_right">
               <div>
                  <!--{__MA_VACH_ID_DON_HANG__}-->
                  <div class="print_header_barcode">{!! DNS1D::getBarcodeSVG($result['madonhang'], "C128", 1.2,40) !!}</div>
                  <div class="print_header_idorder">ID đơn hàng: <strong>{{$result['madonhang']}}</strong></div>
               </div>
            </div>
            <div style="clear:both;">&nbsp;</div>
         </div>
         @endif

         <!--PRINT MIDDLE-->
         <div class="print_middle">
            <div class="print_middle_left">
               <div style="padding:5px;vertical-align:top;font-size:11px;">
                  <p style="font-weight:bold;margin-bottom:5px;">Từ: {{$settingOption['website']}}</p>
                  <p>{{$setting['diachivi']}}</p>
                  <p>SĐT: {{$settingOption['dienthoai']}}</p>
               </div>
            </div>
            <div class="print_middle_right">
               <div style="padding:5px;vertical-align:top;font-size:11px;">
                  <p style="font-weight:bold;margin-bottom:5px;">Đến: {{$result['hoten']}}</p>
                  <p>{{$result['diachi']}}</p>
                  <p>SĐT: {{$result['dienthoai']}}</p>
               </div>
            </div>
            <div style="clear:both;">&nbsp;</div>
         </div>


		 <!--PRINT BODY-->
         <div class="print_body">
            <div class="print_body_main">
               <p style="margin-bottom:5px;"><strong>H&agrave;ng h&oacute;a</strong></p>
               <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:100%;margin-left:0px;">
                  <tbody>
                    @php
                        $tonggia=$tongsl=$tong_kl=0;
                    @endphp

                    @foreach($result_ctdonhang as $k => $v)
                        @php
                           $proinfo = CartHelper::get_product_info($v['id_product']);
                           $tong_kl +=((isset($proinfo['khoiluong']))?$proinfo['khoiluong']:0);
                           $q    = $v['soluong'];
                           $price = ($v['giamoi']>0) ? $v['giamoi'] : $v['gia'];
                           $productName=$v['ten'];
                           $tonggia=$tonggia+$q*$price;
                           $tongsl +=$q;
                        @endphp
                     <tr>
                        <td><span style="font-size:11px;">- {{$productName}}, SL: {{$q}}, Giá: {!!Helper::Format_Money($price)!!}</span></td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
            <p>Tổng SL sản phẩm: {{$tongsl}}</p>
            <div style="text-align:left;">Một số sản phẩm có thể bị ẩn do danh sách quá dài</div>
         </div>


         <!--PRINT FOOTER-->
         <div class="print_footer">
            <div class="print_footer_left">
               <div style="font-size:10px;">
                  <p>Tiền thu người nhận:</p>
                  <div style="padding:5px;text-align:center;margin-top:5px;height:70px;line-height:70px;font-size:16px;"><strong>{!!Helper::Format_Money($result['tonggia'])!!}</strong></div>
               </div>
            </div>
            <div class="print_footer_right">
               <p style="font-size:10px;margin-bottom:5px;"><span><span style="text-indent:10px;">Khối lượng: {{$tong_kl}} gram</span></span></p>
               <div style="padding:5px;text-align:center;margin-top:0px;border:1px solid #000;height:75px;">
                  <p style="font-size:12px;margin:0;"><strong>Chữ ký người nhận</strong></p>
                  <p style="font-size:9px;">Xác nhận hàng nguyên vẹn, không bị móp/vỡ</p>
               </div>
            </div>
            <div style="clear:both;">&nbsp;</div>
         </div>
         <p style="margin-top:5px;font-size:9px;padding:0 5px;"><strong>Chỉ dẫn giao hàng:</strong>  Không đồng kiểm; Chuyển hoàn sau 3 lần phát</p>
         <p style="margin-top:2px;font-size:9px;padding:0 5px;"><strong>Ghi chú:  Khách không nhận hàng thì shipper vui lòng liên hệ shop</strong></p>
      </div>
</body>

</html>
