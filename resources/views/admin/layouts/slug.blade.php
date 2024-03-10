<div class="card card-primary card-outline text-sm">
    <div class="card-header">
        <h3 class="card-title">{{__('Đường dẫn')}}</h3>
        <span class="pl-2 text-danger">({{__('Vui lòng không nhập trùng tiêu đề')}})</span>
    </div>
    <div class="card-body card-slug">
        <?php //if(isset($slugchange) && $slugchange == 1) { ?>
            <div class="form-group mb-2">
                <label for="slugchange" class="d-inline-block align-middle text-info mb-0 mr-2">{{__('Thay đổi đường dẫn theo tiêu đề mới')}}:</label>
                <div class="custom-control custom-checkbox d-inline-block align-middle">
                    <input type="checkbox" class="custom-control-input" name="slugchange" id="slugchange">
                    <label for="slugchange" class="custom-control-label"></label>
                </div>
            </div>
        <?php //} ?>

        <input type="hidden" class="slug-id" value="{{ (isset($rowItem['id'])) ? $rowItem['id'] : 0}}">
        <input type="hidden" class="slug-copy" value="{{(isset($copy) && $copy == true) ? 1 : 0}}">

        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                    @foreach(config('config_all.slug') as $k => $v)
                        <li class="nav-item">
                            <a class="nav-link {{($k==$lang)?'active':''}}" id="tabs-lang" data-toggle="pill" href="#tabs-sluglang-{{$k}}" role="tab" aria-controls="tabs-sluglang-{{$k}}" aria-selected="true">{{$v}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content dev-tab-slug" id="custom-tabs-three-tabContent-lang">
                    @foreach(config('config_all.slug') as $k => $v)
                        <div class="tab-pane fade show {{($k==$lang)?'active':''}}" id="tabs-sluglang-{{$k}}" role="tabpanel" aria-labelledby="tabs-lang">
                            <div class="form-gourp mb-0">
                                <label class="d-block">{{__('Đường dẫn mẫu')}} ({{$k}}):<span class="pl-2 font-weight-normal" id="slugurlpreview{{$k}}">{{config('app.url')}}/<strong class="text-info">{{ (isset($rowItem)) ? $rowItem['tenkhongdau'.$k] : '' }}</strong></span></label>
                                <input type="text" class="form-control slug-input no-validate" name="data[slug{{$k}}]" id="slug{{$k}}" placeholder="{{__('Đường dẫn')}} ({{$k}})" value="{{ (isset($rowItem))?$rowItem['tenkhongdau'.$k]:'' }}">
                                <input type="hidden" id="slug-default{{$k}}" value="">
                                <p class="alert-slug{{$k}} text-danger d-none mt-2 mb-0" id="alert-slug-danger{{$k}}">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    <span>{{__('Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.')}}</span>
                                </p>
                                <p class="alert-slug{{$k}} text-success d-none mt-2 mb-0" id="alert-slug-success{{$k}}">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    <span>{{__('Đường dẫn hợp lệ.')}}</span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
