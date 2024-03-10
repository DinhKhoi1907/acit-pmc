@if(isset($listTragop))
<div class="mt-5 bortop">
    <p class="title-cart">Ngân hàng hỗ trợ trả góp</p>
    <div class="flex flex-wrap information-cart domestic-list">
        @foreach($listTragop as $k=>$v)
            @php
                $paymentMethods = $v['paymentMethods'];
            @endphp
            @if($paymentMethods)
            <div class="relative domestic-item" title="{{$v['bankName']}}">
                <label for="paymentMethods-{{$v['bankCode']}}">
                    {{-- {{$v['bankCode']}} --}}
                    @if(file_exists('img/bank_icon/'.strtolower($v['bankCode']).'.jpg'))
                    <img class="rounded-md" src="img/bank_icon/{{strtolower($v['bankCode'])}}.jpg">
                    @else
                    {{$v['bankCode']}}
                    @endif
                    <input id="paymentMethods-{{$v['bankCode']}}" type="radio" name="bankCode" value="{{$v['bankCode']}}" class="absolute opacity-0 domestic-bankCode" required>
                </label>
            </div>
            @endif
        @endforeach
    </div>
</div>


<div class="mt-5 bortop">
    <p class="title-cart">Kỳ hạn trả góp</p>
    <div class="relative flex flex-col flex-wrap gap-3 information-cart">
        @foreach($listTragop as $k=>$v)
            @php
                $paymentMethods = $v['paymentMethods'];
            @endphp
            @if($paymentMethods)
            <div id="domestic-payment-{{$v['bankCode']}}" class="absolute hidden opacity-0 domestic-payment">
                @foreach($paymentMethods as $payment)
                    @php
                        $periods = $payment['periods'];
                    @endphp
                    <div class="relative pl-5 mb-5 paymentMethod-type last-border-none" style="padding-bottom:10px;border-bottom: 1px dashed #ebebeb;">
                        <label for="paymentMethod-{{$payment['paymentMethod']}}" class="flex flex-wrap gap-3 paymentMethod-label">
                            <p class="font-bold flex items-center justify-center" style="width:95px; height:45px;"><img src="img/debit/{{$payment['paymentMethod']}}.png"></p>
                            <div class="flex flex-wrap gap-3 pl-5">
                                @foreach($periods as $period)
                                <label for="period-{{$period['feeId']}}" class="flex items-center justify-content-center"> 
                                    <input id="period-{{$period['feeId']}}" type="radio" name="month" value="{{$period['month']}}" class="domestic-period" required> <span class="ml-2">{{$period['month']}} tháng</span>
                                </label>
                                @endforeach
                            </div>
                            <input type="radio" name="paymentMethod" value="{{$payment['paymentMethod']}}" id="paymentMethod-{{$payment['paymentMethod']}}" class="absolute opacity-0" required>
                        </label>
                        
                    </div>
                @endforeach
            </div>
            @endif
        @endforeach
    </div>
</div>


@elseif($json['text']!='')
    <div class="mt-5 alert-data" role="alert">
        <strong><i class="mr-1 far fa-exclamation-circle"></i>{{$json['text']}}</strong>
    </div>
    <input type="hidden" name="false-domestic" class="false-domestic">
@endif