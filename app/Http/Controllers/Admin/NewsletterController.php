<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Traits\SupportTrait;

use App\Jobs\SendEmail;
use App\Mail\MailNotify;

use App\Models\User;

use Helper;
use Mail;

class NewsletterController extends Controller
{
    //
    use SupportTrait;

    private $type, $table, $config, $permissionShow, $permissionAdd, $permissionEdit, $permissionDelete, $page_error;
    private $routeShow = 'admin.newsletter.show';
    private $routeEdit = 'admin.newsletter.edit';
    private $viewShow = 'admin.templates.newsletter.man.newsletter'; // admin/templates/color/man/color.blade.php
    private $viewEdit = 'admin.templates.newsletter.man.newsletter_add'; // admin/templates/color/man/color_add.blade.php
    private $folder = "file";
    private $alert = "Hệ thống báo lỗi : Bạn không có quyền truy cập !";

    /*
    |--------------------------------------------------------------------------
    | Khởi tạo dữ liệu
    |--------------------------------------------------------------------------
    */
    public function initialization(Request $request){
        $this->category = $request->category;
        $this->type = $request->type;
        $this->config = config('config_type.newsletter');
        $this->page_error = redirect()->route('admin.dashboard');
        $this->permissionShow = 'newsletter_man_'.$this->type;
        $this->permissionAdd = 'newsletter_add_'.$this->type;
        $this->permissionEdit = 'newsletter_edit_'.$this->type;
        $this->permissionDelete = 'newsletter_delete_'.$this->type;
        $this->permissionSend = 'newsletter_send_'.$this->type; 
    }


    /*
    |--------------------------------------------------------------------------
    | Hiển thị danh sách dữ liệu : tags
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
        $params = array();
        $params['keyword'] = ($request->keyword) ? $request->keyword : '';

        //### Code xử lý...
        $itemShow = $this->newsletterRepo->GetAllItems($type,$params,$this->relations,$this->pagination);

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
        $type = $request->type;
        $id = $request->id;

        //### Code xử lý...
        $rowItem = $this->newsletterRepo->GetOneItem($id);

        //### Trả về giao diện
        $response = array(
            'request'=>$request,
            'rowItem'=> $rowItem,
            'type'=> $type,
            'config'=>$this->config,
            'folder_upload'=>$this->folder
        );
        //dd($this->folder);
        //dd(Helper::GetFolder($response['folder_upload'],false));
        return view($this->viewEdit)->with($response);
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
        $data['type'] = $type;
        $data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		if($id){
			$data['ngaysua'] = time();
		}else{
			$data['ngaytao'] = $data['ngaysua'] = time();
		}

        $getimage='';
        if($request->hasFile('file-taptin')){
            $folder = Helper::GetFolder("file");
            $row = $this->newsletterRepo->GetOneItem($id);
            $oldimage = $row['taptin'];
            $newimage = $request->file('file-taptin');
            if($newimage){ $data['taptin'] = Helper::UploadImageToFolder($newimage, $oldimage, $folder); }
        }


        //### xử lý khi nạp rút xu
        $row = $this->newsletterRepo->GetOneItem($id);   

        if($row['tinhtrang']==2 && $data['tinhtrang']!=2){
            $data['tinhtrang'] = $row['tinhtrang'];
        }

        if($type=='naprutxu'){                     
            $setting_opt = $this->GetSettingOption('setting');
            $giatrixu = $setting_opt['giatrixu'];

            $xuquydoi = $row['giatrixunap'];//round($row['giatrixunap'] / $giatrixu);

            if($row['tinhtrang']!=2 && $data['tinhtrang']==2){
                $update = User::find($row['id_user']);
                if($row['hinhthuc']==0){ //### nạp xu
                    $update->tongxu = $update->tongxu + $xuquydoi;
                    $update->save();

                    //### tạo thông báo
                    $data_thongbao['tieude'] = 'Nạp xu';
                    $data_thongbao['sub_tieude'] = 'Nạp xu';
                    $data_thongbao['noidung'] = 'Quản trị viên đã xác nhận việc nạp xu của bạn. Vui lòng kiểm tra số xu trong tài khoản';
                    $data_thongbao['ngaytao'] = time();
                    $data_thongbao['id_user'] = $row['id_user'];
                    $this->thongbaoRepo->SaveItem($data_thongbao);

                }else if($row['hinhthuc']==1 && $update->tongxu>=$xuquydoi){ //### rút xu
                    $update->tongxu = $update->tongxu - $xuquydoi;
                    $update->save();

                    //### tạo thông báo
                    $data_thongbao['tieude'] = 'Rút xu';
                    $data_thongbao['sub_tieude'] = 'Rút xu';
                    $data_thongbao['noidung'] = 'Quản trị viên đã xác nhận việc rút xu của bạn. Vui lòng kiểm tra số xu trong tài khoản';
                    $data_thongbao['ngaytao'] = time();
                    $data_thongbao['id_user'] = $row['id_user'];
                    $this->thongbaoRepo->SaveItem($data_thongbao);
                }
            }
        }

        //### Code xử lý...
        $row = $this->newsletterRepo->SaveItem($data,$id);

        //### Hiển thị giao diện
        return redirect()->route($this->routeShow,[$category,$type]);
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

        $row = $this->newsletterRepo->GetOneItem($id);
        if($row['id']){
            $this->newsletterRepo->DeleteOneItem($id);
            $image_path = $this->folder.$row['taptin'];
            Helper::DeleteImage($image_path);
            return redirect()->route($this->routeShow,[$category,$type]);
        }
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

        if($listid!=''){
            $ids = explode(",", $listid);
            foreach($ids as $i=>$item){
                $row = $this->newsletterRepo->GetOneItem($item);
                $image_path = $this->folder.$row['taptin'];
                Helper::DeleteImage($image_path);
            }
            $this->newsletterRepo->DeleteMultiItem($listid);
        }

        return redirect()->route($this->routeShow,[$category,$type]);
    }


    /*
    |--------------------------------------------------------------------------
    | gửi dữ liệu tới nhiều email
    |--------------------------------------------------------------------------
    */
    public function Send(Request $request){
        //### khởi tạo giá trị cho model
        $this->initialization($request);
        
        //### check auth permission
        if(!$this->IsPermission($this->permissionSend)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }

        //### Code xử lý
        // get user mail
        $setting_opt = $this->GetSettingOption('setting');
        Helper::SetConfigMail($setting_opt);

        $category = $request->category;
        $type = $request->type;
        $message = array();
        $message['tieude'] = $request->tieude;
        $message['noidung'] = $request->noidung;
        $message['fromEmail'] = $setting_opt['email'];
        $message['file']='';
        $message['setting'] = $setting_opt;

        if($request->hasFile('file')){
            $file = Helper::UploadImageToFolder($request->file('file'), '' , Helper::GetFolder("file"));
            $message['file'] = public_path('upload/file/'.$file);
        }

        $listemail = $request->listemail;
        if($listemail!=''){
            $user_arr = explode(",", $listemail);
            $users = $this->newsletterRepo->GetAllItemByIds($user_arr);
            foreach ($users as $user) {
                Mail::to($user['email'])->send(new MailNotify($message,$user));
            }
            //SendEmail::dispatch($message,$users);

            $request->session()->flash('alertSuccess', "Đã thực hiện gửi mail !");
            return redirect()->route($this->routeShow,[$category,$type]);
        }
    }
}
