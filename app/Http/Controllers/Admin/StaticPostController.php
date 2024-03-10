<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Traits\SupportTrait;

use Helper;

class StaticPostController extends Controller
{
    use SupportTrait;
    private $type, $table, $viewShow, $viewEdit, $config, $folder, $permissionShow, $permissionAdd, $permissionEdit, $permissionDelete, $page_error;
    private $routeShow = 'admin.staticpost.show';
    private $routeEdit = 'admin.staticpost.edit';
    private $folder_upload = "staticpost";
    private $alert = "Hệ thống báo lỗi : Bạn không có quyền truy cập !";


    /*
    |--------------------------------------------------------------------------
    | Khởi tạo dữ liệu
    |--------------------------------------------------------------------------
    */
    public function initialization(Request $request){
        $this->config = config('config_type.staticpost');
        $this->folder = Helper::GetFolder($this->folder_upload);
        $this->viewShow = 'admin.templates.staticpost.man.staticpost_add';
        $this->page_error = redirect()->back();

        //permission check option
        $this->permissionShow = 'staticpost_show_'.$this->type;
        $this->permissionEdit = 'staticpost_capnhat_'.$this->type;
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
        $type = $request->type;
        $category = $request->category;
        $array_product = array();

        //### Code xử lý...
        $params = array(
            'type'=>$request->type,
        );
        $rowItem = $this->staticRepo->GetItem($params);
        if(!$rowItem){
            $params['hienthi']=1;
            $params['ngaytao'] = $data['ngaysua'] = time();
            $rowItem = $this->staticRepo->SaveItem($params);
        }
        $gallery = $this->galleryRepo->GetAllGallery($type,$rowItem['id'],'staticpost');

        //### Trả về giao diện
        $response = array(
            'request'=>$request,
            'rowItem'=> $rowItem,
            'type'=> $type,
            'category'=>$category,
            'config'=>$this->config,
            'gallery'=>$gallery,
            'folder_upload'=>$this->folder_upload
        );
        return view($this->viewShow)->with($response);
    }


    /*
    |--------------------------------------------------------------------------
    | Lưu mới - cập nhật 1 dòng dữ liệu
    |--------------------------------------------------------------------------
    */
    public function Save(Request $request){
        //### khởi tạo giá trị cho model
        $this->initialization($request);

        //### check auth permission
        if(!$this->IsPermission($this->permissionEdit)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }

        //### Thiết lập giá trị thuộc tính
        $type = $request->type;
        $category = $request->category;
        $id = $request->id;
        $data = $request->data;
        $params = array(
            'type'=>$type
        );

        $rowItem = $this->staticRepo->GetItem($params);
        $data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
        $data['ngaytao'] = time();

        if($id)
        {
            if($request->hasFile('file'))
            {
                $oldimage = $rowItem['photo'];
                $newimage = $request->file('file');
                if($newimage){ $data['photo'] = Helper::UploadImageToFolder($newimage, $oldimage, $this->folder); }
            }

            if($request->hasFile('file2'))
            {
                $oldimage = $rowItem['photo2'];
                $newimage = $request->file('file2');
                if($newimage){ $data['photo2'] = Helper::UploadImageToFolder($newimage, $oldimage, $this->folder); }
            }

            if($request->hasFile('video'))
            {
                $oldimage = $rowItem['video'];
                $newimage = $request->file('video');
                if($newimage){ $data['video'] = Helper::UploadVideoToFolder($newimage, $oldimage, $this->folder); }
            }

            if($request->hasFile('banner'))
            {
                $oldimage = $rowItem['banner'];
                $newimage = $request->file('banner');
                if($newimage){ $data['banner'] = Helper::UploadImageToFolder($newimage, $oldimage, $this->folder); }
            }

            if($request->hasFile('file-taptin'))
            {
                $oldimage = $rowItem['taptin'];
                $newimage = $request->file('file-taptin');
                $folder = Helper::GetFolder('file');
                if($newimage){ $data['taptin'] = Helper::UploadFileToFolder($newimage, $oldimage, $folder); }
            }

            //### Cập nhật
            $rowItem = $this->staticRepo->SaveItem($data,$id);
        }

        //### Trả về giao diện
        $response = array(
            'request'=>$request,
            'rowItem'=> $rowItem,
            'type'=> $type,
            'category'=>$category,
            'config'=>$this->config,
            'folder_upload'=>$this->folder_upload
        );
        return redirect()->route($this->routeShow,[$category,$type]);
    }
}
