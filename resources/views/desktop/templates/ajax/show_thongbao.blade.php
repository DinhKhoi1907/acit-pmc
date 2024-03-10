@if(Login::isLogin())

<div class="relative">
    @if($thongbao)    
        @php
            if(config('config_all.data_demo')){
                //### test duplicate array customer
                $arr_tmp = array();
                for($i=0;$i<10;$i++){
                    $arr_tmp = array_merge($thongbao, $arr_tmp);
                }
                $thongbao = $arr_tmp;
            }
        @endphp
        
        @foreach($thongbao as $k=>$v)
            @php
                $info= json_decode($v['info'], true);
            @endphp
            <div class="border border-solid border-[rgba(153,153,153,30%)] shadow-shadow4 rounded-[8px] bg-white mb-4 sidebar-tab-inform-item-{{$v['id']}} {{($v['daxem']==1) ? 'sidebar-tab-inform-item-hasview': ''}}">
                <div class="p-2 border-0 border-b border-solid border-[#ebebeb] text-xs text-black font-semibold flex justify-between items-center">
                    <p class="//sidebar-tab-inform-toptitle"><span class="w-[5px] h-[5px] rounded-full bg-cmain2 inline-block mr-2"></span>{{__('Thông báo')}} @if(($v['daxem']==0))<span class="px-2 text-xs text-white bg-red-600 rounded-sm sidebar-tab-new-{{$v['id']}}">{{__('Mới')}}</span>@endif</p>
                    <p class="text-[10px] text-gray-400 flex items-center //sidebar-tab-inform-topdate">{{Helper::GetCurrentWeekday($v['ngaytao'])}} <span class="sidebar-tab-tools text-[17px] ml-4 cursor-pointer" data-id="{{$v['id']}}" data-daxem="{{$v['daxem']}}" data-reserve="{{($v['daxem']!=1)? 'daxem' : 'chuaxem'}}"><i class="fas fa-ellipsis-h"></i></span></p>
                </div>
                <div class="p-2 //sidebar-tab-inform-botitem">
                    <p class="font-semibold text-[13px] mb-1 //sidebar-tab-inform-bottitle">{{$v['tieude'.$lang]}}</p>
                    <div class="text-[12px] text-black //sidebar-tab-inform-botcontent">{{__($v['noidung'])}}</div>
                    @if(isset($info['type']) && $info['type']=='comment')
                        @php
                            $post = Helper::GetPostById($info['id_post']);
                        @endphp
                        <a href="{{$post['tenkhongdau'.$lang]}}-{{$post['id']}}?comment={{$info['id_comment']}}" target="_blank" class="sidebar-tab-inform-view"><i class="mr-1 fal fa-hand-point-right"></i>{{__('Xem chi tiết')}}</a>
                    @endif
                    @if(isset($info['type']) && $info['type']=='vipham')<p class="sidebar-tab-inform-comment">{{__('Nội dung bình luận')}}: '{{$info['comment_info']}}'</p>@endif
                </div>
            </div>
        @endforeach
    @else
        <div class="alert-data" role="alert">
            <strong><i class="mr-1 far fa-exclamation-circle"></i>{{__('Không tìm thấy kết quả')}} !</strong>
        </div>
    @endif
</div>

@else
    <div class="alert-data" role="alert">
        <div><i class="fal fa-hand-point-right"></i> <a href="{{route('account.login')}}">{{__('Đăng nhập')}}</a> {{__('để theo dõi thông báo mỗi ngày')}} !</div>
    </div>
@endif

@if(Login::isLogin())
    <div class="sidebar-tab-showtool">
        <span class="sidebar-tab-showtool-layout"></span>
        <div class="sidebar-tab-showtool-list">
            <p class="sidebar-btn-status sidebar-btn-status-isview" data-status="" data-id=""><i class="mr-2 fas fa-check"></i> <span id="sidebar-tab-hasno"></span></p>
            {{-- <p class="sidebar-btn-status sidebar-btn-status-remove" data-status="xoa" data-id=""><i class="mr-2 fas fa-trash"></i> Xóa thông báo</p> --}}
            <p class="sidebar-btn-cancel"><i class="mr-2 fas fa-times"></i> {{__('Hủy')}}</p>
        </div>
    </div>
@endif