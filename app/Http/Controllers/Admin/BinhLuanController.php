<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Traits\SupportTrait;

use Helper, Thumb;

class BinhLuanController extends Controller
{
    //
    use SupportTrait;
    private $type, $table, $viewShow, $viewEdit, $config, $proParent, $modelSize, $modelColor, $permissionShow, $permissionAdd, $permissionEdit, $permissionDelete, $page_error, $folder_upload;
    private $routeShow = 'admin.binhluan.show';
    private $routeEdit = 'admin.binhluan.edit';
    private $folder = "product";
    private $alert = "Hệ thống báo lỗi : Bạn không có quyền truy cập !";

    /*
    |--------------------------------------------------------------------------
    | Khởi tạo dữ liệu
    |--------------------------------------------------------------------------
    */
    public function initialization(Request $request){
        $this->category = $request->category;
        $this->type = $request->type;
        $this->viewShow = 'admin.templates.binhluan.man';
        $this->viewEdit = 'admin.templates.binhluan.add';

        //permission
        $this->page_error = redirect()->back();
        $this->permissionShow = 'binhluan_man_'.$this->type;
        $this->permissionAdd = 'binhluan_add_'.$this->type;
        $this->permissionEdit = 'binhluan_edit_'.$this->type;
        $this->permissionDelete = 'binhluan_delete_'.$this->type;

        $this->relations = $this->commentRepo->GetRelationsRepo(); //['HasProduct'];
    }


    /*
    |--------------------------------------------------------------------------
    | Hiển thị danh sách dữ liệu tương ứng với category
    |--------------------------------------------------------------------------
    */
    public function Show(Request $request){
        //### khởi tạo giá trị cho model
        $this->initialization($request);

        //### check auth permission
        if(!$this->IsPermission($this->permissionShow)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }

        //### Thiết lập giá trị thuộc tính
        $type = '';

        $params = array();
        $idParent = 0;
        
        $params['keyword_noidung'] = ($request->keyword_noidung) ? $request->keyword_noidung : '';
        $params['id_parent'] = 0;

        //### Code xử lý...
        $itemShow = $this->commentRepo->GetAllItems($type,$params,$this->relationsOpt,$this->pagination);

        //### Trả về giao diện
        $response = array(
            'request'=>$request,
            'itemShow'=> $itemShow,
            'type'=> $type,
            'config'=>$this->config
        );
        return view($this->viewShow)->with($response);
    }


    /*
    |--------------------------------------------------------------------------
    | Hiển thị trang thêm - chỉnh sửa 1 dòng dữ liệu
    |--------------------------------------------------------------------------
    */
    public function Edit(Request $request){
        //### khởi tạo giá trị cho model
        $this->initialization($request);

        //### check auth permission
        if(!$this->IsPermission($this->permissionShow)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }

        //### Thiết lập giá trị thuộc tính
        //$category = $request->category;
        $id = $request->id;
        $type = $request->type;

        //### Code xử lý...
        $rowItem = $this->commentRepo->GetOneItem($id);

        //### Trả về giao diện
        $response = array(
            'request'=>$request,
            'rowItem'=> $rowItem,
            'type'=> $type,           
            'config'=>$this->config,
        );

        return view($this->viewEdit)->with($response);
    }


    /*
    |--------------------------------------------------------------------------
    | Xóa 1 dòng dữ liệu
    |--------------------------------------------------------------------------
    */
    public function Delete(Request $request){
        //### khởi tạo giá trị cho model
        $this->initialization($request);

        //### check auth permission
        if(!$this->IsPermission($this->permissionDelete)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }

        //### Thiết lập giá trị thuộc tính
        $category = $request->category;
        $type = $request->type;
        $id = $request->id;
        $idParent = ($request->id_product) ? $request->id_product : 0;

        $this->commentRepo->DeleteOneItem($id);

        return redirect()->route($this->routeShow,[$category,$type,'id_product'=>$idParent]);
    }


    /*
    |--------------------------------------------------------------------------
    | Xóa nhiều dòng dữ liệu
    |--------------------------------------------------------------------------
    */
    public function DeleteAll(Request $request){
        //### khởi tạo giá trị cho model
        $this->initialization($request);


        //### check auth permission
        if(!$this->IsPermission($this->permissionDelete)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }

        //### Thiết lập giá trị thuộc tính
        $category = $request->category;
        $type = $request->type;
        $id = $request->id;
        $listid = $request->listid;
        $idParent = ($request->id_product) ? $request->id_product : 0;
        if($listid!=''){
            $this->commentRepo->DeleteMultiItem($listid);
        }

        return redirect()->route($this->routeShow,[$category,$type,'id_product'=>$idParent]);
    }


    /*
    |--------------------------------------------------------------------------
    | Lưu mới - cập nhật 1 dòng dữ liệu
    |--------------------------------------------------------------------------
    */
    public function Save(Request $request){
        //### khởi tạo giá trị cho model
        $this->initialization($request);
        
        //### Thiết lập giá trị thuộc tính
        $category = $request->category;
        $type = $request->type;
        $id = $request->id;
        $hash = $request->hash;
        $savehere = ($request->has('savehere'))?true:false;

        //### check auth permission
        if($id){
            if(!$this->IsPermission($this->permissionEdit)){
                $request->session()->flash('alert', $this->alert);
                return $this->page_error;
            }
        }else{
            if(!$this->IsPermission($this->permissionAdd)){
                $request->session()->flash('alert', $this->alert);
                return $this->page_error;
            }
        }


        $data = $request->data;
        $data['duyettin'] = (isset($data['duyettin'])) ? 1 : 0;

        if($id){
            $data['ngayduyet'] = time();
        }else{
            $data['ngaytao'] =  time();
        }

        //### Code xử lý...
        $row = $this->commentRepo->SaveItem($data,$id);

        //### Hiển thị giao diện
        return redirect()->route($this->routeShow,[$category,'id_product'=>$row->id_product]);
        
    }


    /*
    |--------------------------------------------------------------------------
    | Báo cáo vi phạm - gửi thông báo
    |--------------------------------------------------------------------------
    */
    public function Report(Request $request){
        //### khởi tạo giá trị cho model
        $this->initialization($request);

        //### check auth permission
        if(!$this->IsPermission($this->permissionDelete)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }

        //### Thiết lập giá trị thuộc tính
        $category = $request->category;
        $type = $request->type;
        $id = $request->id;

        if($id){
            $data['hienthi'] = 0;
            $row = $this->commentRepo->SaveItem($data,$id);

            //###Tạo thông báo
            $data_blob['comment_info'] = $row->noidungvi;
            $data_blob['type'] = 'vipham';

            $data_thongbao['tieude'] = 'Báo cáo vi phạm';
            $data_thongbao['sub_tieude'] = 'Báo cáo vi phạm';
            $data_thongbao['noidung'] = 'Hệ thống phát hiện tài khoản của bạn có nội dung bình luận sai phạm quy chuẩn. Hệ thống xác nhận xóa bình luận này !';
            $data_thongbao['info'] = json_encode($data_blob);
            $data_thongbao['ngaytao'] = time();
            $data_thongbao['id_user'] = $row->id_user;
            $this->thongbaoRepo->SaveItem($data_thongbao);
        }

        return redirect()->route($this->routeShow,[$category,$type]);
    }
}
