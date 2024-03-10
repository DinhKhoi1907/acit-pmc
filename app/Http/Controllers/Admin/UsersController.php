<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Traits\SupportTrait;

use App\Models\NhaCungCap;
use App\Models\Admins;
use App\Models\User;

use Helper;
use DB;

class UsersController extends Controller
{
    use SupportTrait;

    private $type, $table, $viewShow, $viewEditChange, $model, $config, $routeError, $permissionShow, $permissionAdd, $permissionEdit, $permissionDelete, $page_error;
    private $routeShow = 'admin.users.show';
    private $routeEdit = 'admin.users.editchange';
    private $folder = "nhacungcap";
    private $alert = "Hệ thống báo lỗi : Bạn không có quyền truy cập !";
    private $places = array();

    /*
    |--------------------------------------------------------------------------
    | Khởi tạo dữ liệu
    |--------------------------------------------------------------------------
    */
    public function initialization(Request $request){
        $this->category = $request->category;
        //check Auth role
        $this->model = new User();
        $this->viewEdit = 'admin.templates.users.edit';
        $this->viewEditChange = 'admin.templates.users.editchange';
        $this->viewShow = 'admin.templates.users.show';
        $this->routeError = redirect()->route('admin.error.show','403');
        $this->config = config('config_all');
        $this->page_error = redirect()->route('admin.dashboard');
        //$this->page_error = redirect()->back();

        $this->folder = Helper::GetFolder("nhacungcap");

        $this->permissionShow = 'users_man';
        $this->permissionAdd = 'users_add';
        $this->permissionEdit = 'users_edit';
        $this->permissionDelete = 'users_delete';
    }


    /*
    |--------------------------------------------------------------------------
    | Show ds tài khoản admin
    |--------------------------------------------------------------------------
    */
    public function Show(Request $request){
        $this->initialization($request);

        //### check auth permission
        if(!$this->IsPermission($this->permissionShow)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }

        //### Thiết lập giá trị thuộc tính
        $type = $request->type;
        $params = array();
        $params['keyword'] = ($request->keyword) ? $request->keyword : '';


        //### Code xử lý...
        $itemShow = $this->model->GetAllItems($params,true);

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
        $this->initialization($request);

        //### check auth permission
        if(!$this->IsPermission($this->permissionShow)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }

        //### Thiết lập giá trị thuộc tính
        $type = $request->type;
        $id = $request->id;

        //### Code xử lý...
        $rowItem = $this->model->GetOneItem($id);


        //### Trả về giao diện
        $response = array(
            'request'=>$request,
            'rowItem'=> $rowItem,
            'type'=> $type,
            'config'=>$this->config            
        );
        return view($this->viewEdit)->with($response);
    }


    /*
    |--------------------------------------------------------------------------
    | Lưu mới - cập nhật 1 dòng dữ liệu
    |--------------------------------------------------------------------------
    */
    public function Save(Request $request){
        $this->initialization($request);

        //### Thiết lập giá trị thuộc tính
        $id = $request->id;

        //### check auth permission
        if($id){
        	$rowItem = $this->model->GetOneItem($id);
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


        //### Code xử lý...
        $data_input = $request->data;
        $data_input['hienthi'] = 1;
        $data_input['kichhoat'] = (isset($data_input['kichhoat'])) ? 1 : 0;
        $data_input['lastlogin'] = 0;

        if(isset($data_input['password']) && $data_input['password']!='' && $data_input['password']==$data_input['confirm_password']){
            $data_input['password'] = bcrypt($data_input['password']);
        }else if($rowItem){
            //$data_input['password'] = $rowItem->password;
        }

        //### tạo mã thành viên
        if($id){
            $data_input['mathanhvien'] = ($rowItem['mathanhvien']=='') ? 'TH_'.time() : $rowItem['mathanhvien'];
        }else{
            $data_input['mathanhvien'] = 'TH_'.time();
        }

        // kiểm tra username đã tồn tại?
        if($id && !$this->checkUsername($id,$data_input['username'])){
            $request->session()->flash('alert', $this->alert);
            return redirect()->route($this->routeShow);
        }
        $row = $this->model->SaveItem($data_input,$id);        

        
        //### Hiển thị giao diện
        return redirect()->route($this->routeShow);
    }


    public function checkUsername($id,$username){
        $itemOthers = $this->model->GetItemOther($id);
        foreach($itemOthers as $k=>$v){
            if($v['username']==$username){
                return false;
                break;
            }
        }
        return true;
    }



    /*
    |--------------------------------------------------------------------------
    | Xóa 1 dòng dữ liệu
    |--------------------------------------------------------------------------
    */
    public function Delete(Request $request){
        $this->initialization($request);

        //### check auth permission
        if(!$this->IsPermission($this->permissionDelete)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }

        $id = $request->id;
        $this->model->DeleteOneItem($id);
        return redirect()->route($this->routeShow);
    }


    /*
    |--------------------------------------------------------------------------
    | Xóa nhiều dòng dữ liệu
    |--------------------------------------------------------------------------
    */
    public function DeleteAll(Request $request){
        $this->initialization($request);
        
        //### check auth permission
        if(!$this->IsPermission($this->permissionDelete)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }

        $id = $request->id;
        $listid = $request->listid;

        if($listid!=''){
            $this->model->DeleteMultiItem($listid);
            return redirect()->route($this->routeShow);
        }else{
            return $this->page_error;
        }
    }
}
