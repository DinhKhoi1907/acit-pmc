<div class="row col-xl-12">    
    <div class="col-xl-4">
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Hình 1</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="photoUpload-zone">
                    <div class="photoUpload-detail" id="model-preview"><img class="rounded" src="{{ Helper::GetFolder($folder_upload,true).$rowItem['photo1'] }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>
                    <label class="photoUpload-file" id="photo-model-zone" for="model-zone">
                        <input type="file" name="photo1" id="model-zone">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                        <p class="photoUpload-or">hoặc</p>
                        <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                    </label>

                    <div class="form-group">
                        <label for="hienthi1" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                        <div class="custom-control custom-checkbox d-inline-block align-middle">
                            @if($rowItem['hienthi1']==1 || !isset($rowItem))
                            <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi1]" id="hienthi-hienthi1" checked>
                            @else
                            <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi1]" id="hienthi-hienthi1">
                            @endif                            
                            <label for="hienthi-hienthi1" class="custom-control-label"></label>
                        </div>
                    </div>

                    <div class="photoUpload-dimension">{{ "Width: 205px - Height: 175px (".$config[$type]['img_type'].")" }}</div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-xl-4">
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Hình 2</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="photoUpload-zone">
                    <div class="photoUpload-detail" id="banner-preview"><img class="rounded" src="{{ Helper::GetFolder($folder_upload,true).$rowItem['photo2'] }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>
                    <label class="photoUpload-file" id="photo-banner-zone" for="banner-zone">
                        <input type="file" name="photo2" id="banner-zone">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                        <p class="photoUpload-or">hoặc</p>
                        <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                    </label>

                    <div class="form-group">
                        <label for="hienthi2" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                        <div class="custom-control custom-checkbox d-inline-block align-middle">
                            @if($rowItem['hienthi2']==1 || !isset($rowItem))
                            <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi2]" id="hienthi-hienthi2" checked>
                            @else
                            <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi2]" id="hienthi-hienthi2">
                            @endif                            
                            <label for="hienthi-hienthi2" class="custom-control-label"></label>
                        </div>
                    </div>

                    <div class="photoUpload-dimension">{{ "Width: 230px - Height: 180px (".$config[$type]['img_type'].")" }}</div>
                </div>
            </div>
        </div> 
    </div>

    <div class="col-xl-4">
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Hình 3</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="photoUpload-zone">
                    <div class="photoUpload-detail" id="descript-preview"><img class="rounded" src="{{ Helper::GetFolder($folder_upload,true).$rowItem['photo3'] }}" onerror=src="{{asset('img/noimage1.png')}}" alt="Alt Photo"/></div>
                    <label class="photoUpload-file" id="photo-descript-zone" for="descript-zone">
                        <input type="file" name="photo3" id="descript-zone">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                        <p class="photoUpload-or">hoặc</p>
                        <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                    </label>

                    <div class="form-group">
                        <label for="hienthi3" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                        <div class="custom-control custom-checkbox d-inline-block align-middle">
                            @if($rowItem['hienthi3']==1 || !isset($rowItem))
                            <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi3]" id="hienthi-hienthi3" checked>
                            @else
                            <input type="checkbox" class="custom-control-input hienthi-checkbox" name="data[hienthi3]" id="hienthi-hienthi3">
                            @endif                            
                            <label for="hienthi-hienthi3" class="custom-control-label"></label>
                        </div>
                    </div>

                    <div class="photoUpload-dimension">{{ "Width: 355px - Height: 180px (".$config[$type]['img_type'].")" }}</div>
                </div>
            </div>
        </div> 
    </div>
</div>