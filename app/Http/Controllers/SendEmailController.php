<?php

namespace App\Http\Controllers;

//use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

use App\Http\Traits\SupportTrait;

//use App\Models\Newsletter;
//use App\Models\Contact;
use App\Jobs\SendEmail;
use App\Mail\MailNotify;

use Helper;
use Mail;

class SendEmailController extends Controller
{

    use SupportTrait;

    private $setting_opt;

    public function initialization(Request $request){
        $this->setting_opt = $this->GetSettingOption('setting');
        Helper::SetConfigMail($this->setting_opt);
    }


    public function SendClient(Request $request){
        $this->initialization($request);

        $inputs = $request->all();

        // DO: send mail contact and save contact here
        $model_contact = $this->contactRepo;//new Contact();

        $email = $this->setting_opt['email'];
        $arr_ten = $request->ten;
        $arr_email = $request->email;
        $arr_congty = $request->congty;
        $arr_service = $request->service;
        $type = $request->type;

        $check = false;

        // if($data){
        //     $data_send = $data;
        //     $data_send['setting'] = $this->setting_opt;
        // }

        if($arr_ten){
            foreach($arr_ten as $k=>$v){
                if($arr_ten[$k]!='' && $arr_email[$k]!=''){
                    $data = array();
                    $data['tenvi'] = $arr_ten[$k];
                    $data['email'] = $arr_email[$k];
                    $data['congty'] = $arr_congty[$k];
                    $data['service'] = $arr_service[$k];
                    $data['type'] = $type;
                    $data['ngaytao'] = time();
                    if($model_contact->SaveItem($data) && $check==false){
                        $check = true;
                    }
                }
            }
        }

        if($check){
            return redirect()->back()->with(['message' => camonabanchungtoidanhanduocthongtin]);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Gửi mail liên hệ (contact)
    |--------------------------------------------------------------------------
    */
    public function SendContact(Request $request)
    {
        $this->initialization($request);

        $inputs = $request->all();

        $validator = Validator::make($inputs, [
            'recaptcha_action' => ['required', 'string'],
            'recaptcha_token'  => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $result = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('recapcha.secret_key_google'),
            'response' => $inputs['recaptcha_token'],
        ])->json();

        if (!empty($result) && $result['success']==true && $result['action'] === $inputs['recaptcha_action']) {
            if ($result['score'] >= 0.5) {
                // DO: send mail contact and save contact here
                $model_contact = $this->contactRepo;//new Contact();

                $email = $this->setting_opt['email'];
                $data['tenvi'] = $data_save['ten'] = $request->ten;
                $data['dienthoai'] = $request->dienthoai;
                $data['diachi'] = $request->diachi;
                $data['email'] = $request->email;
                $data['tieude'] = $request->tieude;
                $data['noidung'] = $request->noidung;
                $data['link'] = $request->link;
                $data['linkphoto'] = $request->linkphoto;
                $data['congty'] = $request->congty;
                $data['service'] = $request->service;
                $data['type'] = $request->type;
                $data['sanpham'] = $request->sanpham;
                //$data['soluong'] = $request->soluong;
                //$data['hienthi'] = 1;
                $data['ngaytao'] = time();
                if($data){
                    $data_send = $data;
                    $data_send['setting'] = $this->setting_opt;
                }

                if($request->hasFile('file')){
                    $data['taptin'] = $request->file('file')->getClientOriginalName();
                    $file = Helper::UploadImageToFolder($request->file('file'), '' , Helper::GetFolder("file"));
                    $data_send['file'] = public_path('upload/file/'.$file);
                }

                if(config('config_all.sendmail') && config('config_all.sendmail')==true){
                    Mail::to($email)->send(new MailNotify($data_send,null,'contact'));
                }                    

                if($model_contact->SaveItem($data)){
                    return redirect()->back()->with(['message' => "Cảm ơn quý khách ! Chúng tôi đã nhận được thông tin"]);
                }
            } else {
                $validator->getMessageBag()->add('recaptcha', xacminhrecapchakhongthanhcong);
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        $validator->getMessageBag()->add('recaptcha', loirecapcha);
        return redirect()->back()->withErrors($validator)->withInput();
    }


    /*
    |--------------------------------------------------------------------------
    | Gửi mail liên hệ tư vấn (contact)
    |--------------------------------------------------------------------------
    */
    public function SendTuyendung(Request $request){
        $this->initialization($request);

        $inputs = $request->all();
        $is_recaptcha = (int)$inputs['isrecaptcha'];

        if($is_recaptcha){
            $validator = Validator::make($inputs, [
                'recaptcha_action' => ['required', 'string'],
                'recaptcha_token'  => ['required', 'string'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $result = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('recapcha.secret_key_google'),
                'response' => $inputs['recaptcha_token'],
            ])->json();

            if (!empty($result) && $result['success']==true && $result['action'] === $inputs['recaptcha_action']) {
                if ($result['score'] >= 0.5) {
                    // DO: send mail contact and save contact here
                    $model_contact = $this->contactRepo;//new Contact();

                    $email = $this->setting_opt['email'];
                    $data['tenvi'] = $data_save['ten'] = $request->ten;
                    $data['dienthoai'] = $request->dienthoai;
                    $data['diachi'] = $request->diachi;
                    $data['email'] = $request->email;
                    //$data['tieude'] = $request->loaituyendung;
                    $data['noidung'] = $request->noidung;
                    $data['type'] = $request->type;
                    $data['loaituyendung'] = $request->loaituyendung;
                    $data['ngaytao'] = time();
                    if($data){
                        $data_send = $data;
                        $data_send['setting'] = $this->setting_opt;
                    }

                    if($request->hasFile('file')){
                        $data['taptin'] = $request->file('file')->getClientOriginalName();
                        $file = Helper::UploadImageToFolder($request->file('file'), '' , Helper::GetFolder("file"));
                        $data_send['file'] = public_path('upload/file/'.$file);
                    }

                    if(config('config_all.sendmail') && config('config_all.sendmail')==true){
                        Mail::to($email)->send(new MailNotify($data_send,null,'contact'));
                    }

                    if($model_contact->SaveItem($data)){
                        return redirect()->back()->with(['message' => camonabanchungtoidanhanduocthongtin]);
                    }
                } else {
                    $validator->getMessageBag()->add('recaptcha', xacminhrecapchakhongthanhcong);
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }
            $validator->getMessageBag()->add('recaptcha', loirecapcha);
            return redirect()->back()->withErrors($validator)->withInput();

        }else{
            // DO: send mail contact and save contact here
            $model_contact = $this->contactRepo;//new Contact();

            $email = $this->setting_opt['email'];
            $data['tenvi'] = $data_save['ten'] = $request->ten;
            $data['dienthoai'] = $request->dienthoai;
            $data['diachi'] = $request->diachi;
            $data['email'] = $request->email;
            $data['tieude'] = '[Tuyển dụng] '.$request->loaituyendung;
            $data['noidung'] = $request->noidung;
            $data['type'] = $request->type;
            $data['loaituyendung'] = $request->loaituyendung;
            $data['ngaytao'] = time();
            if($data){
                $data_send = $data;
                $data_send['setting'] = $this->setting_opt;
            }

            if($request->hasFile('file')){
                $data['taptin'] = $request->file('file')->getClientOriginalName();
                $file = Helper::UploadImageToFolder($request->file('file'), '' , Helper::GetFolder("file"));
                $data_send['file'] = public_path('upload/file/'.$file);
            }

            if(config('config_all.sendmail') && config('config_all.sendmail')==true){
                Mail::to($email)->send(new MailNotify($data_send,null,'contact'));
            }

            if($model_contact->SaveItem($data)){
                return redirect()->back()->with(['message' => camonabanchungtoidanhanduocthongtin]);
            }
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Gửi mail newsletter
    |--------------------------------------------------------------------------
    */
    public function SendNewsletter(Request $request)
    {
        $this->initialization($request);

        $inputs = $request->all();
        $is_recaptcha = (int)$inputs['isrecaptcha'];

        if($is_recaptcha){
            $validator = Validator::make($inputs, [
                'recaptcha_action' => ['required', 'string'],
                'recaptcha_token'  => ['required', 'string'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $result = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('recapcha.secret_key_google'),
                'response' => $inputs['recaptcha_token'],
            ])->json();

            if (!empty($result) && $result['success']==true && $result['action'] === $inputs['recaptcha_action']) {
                if ($result['score'] >= 0.5) {
                    // DO: send mail contact and save contact here
                    $model_newsletter = $this->newsletterRepo;//new Newsletter();

                    $email = $this->setting_opt['email'];
                    $data['tenvi'] = $data_save['ten'] = ($request->ten)?$request->ten:'';
                    $data['dienthoai'] = ($request->dienthoai)?$request->dienthoai:'';
                    $data['diachi'] = ($request->diachi)?$request->diachi:'';
                    $data['email'] = ($request->email)?$request->email:'';
                    $data['chucvu'] = ($request->email)?$request->chucvu:'';
                    $data['congty'] = ($request->email)?$request->congty:'';
                    $data['chude'] = ($request->tieude)?$request->tieude:'';
                    $data['noidung'] = ($request->noidung)?$request->noidung:'';
                    $data['type'] = ($request->type)?$request->type:'';
                    $data['tinhtrang'] = 0;
                    $data['ngaytao'] = time();
                    if($data){
                        $data_send = $data;
                        $data_send['tieude'] = ($request->tieude)?'['.maildangky.'] '.$request->tieude:thongbao;
                        $data_send['setting'] = $this->setting_opt;
                    }

                    if($request->hasFile('file')){
                        //$data['taptin'] = $data['ngaytao'].'_'.$request->file('file')->getClientOriginalName();
                        $data['taptin'] = $file = Helper::UploadImageToFolder($request->file('file'), '' , Helper::GetFolder("file"));
                        $data_send['file'] = public_path('upload/file/'.$file);
                    }
                    Mail::to($email)->send(new MailNotify($data_send,null,'newsletter'));
                    if($model_newsletter->SaveItem($data)){
                        return redirect()->back()->with(['message' => camonabanchungtoidanhanduocthongtin]);
                    }
                } else {
                    $validator->getMessageBag()->add('recaptcha', xacminhrecapchakhongthanhcong);
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }
            $validator->getMessageBag()->add('recaptcha', loirecapcha);
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            if(!$this->existEmail($request->email)){
                // DO: send mail contact and save contact here
                $model_newsletter = $this->newsletterRepo;//new Newsletter();

                $email = $this->setting_opt['email'];
                $data['tenvi'] = $data_save['ten'] = ($request->ten)?$request->ten:'';
                $data['dienthoai'] = ($request->dienthoai)?$request->dienthoai:'';
                $data['diachi'] = ($request->diachi)?$request->diachi:'';
                $data['email'] = ($request->email)?$request->email:'';
                $data['chucvu'] = ($request->email)?$request->chucvu:'';
                $data['congty'] = ($request->email)?$request->congty:'';
                $data['chude'] = ($request->tieude)?$request->tieude:'';
                $data['noidung'] = ($request->noidung)?$request->noidung:'';
                $data['type'] = ($request->type)?$request->type:'';
                $data['tinhtrang'] = 0;
                $data['ngaytao'] = time();
                if($data){
                    $data_send = $data;
                    $data_send['tieude'] = ($request->tieude)?'['.maildangky.'] '.$request->tieude:thongbao;
                    $data_send['setting'] = $this->setting_opt;
                }

                if($request->hasFile('file')){
                    $data['taptin'] = $file = Helper::UploadImageToFolder($request->file('file'), '' , Helper::GetFolder("file"));
                    $data_send['file'] = public_path('upload/file/'.$file);
                }
                if($model_newsletter->SaveItem($data)){                    
                    return redirect()->back()->with(['message' => "Cảm ơn quý khách đă để lại thông tin tư vấn ! Chúng tôi sẽ liên hệ tới quý khách trong thời gian sớm nhất"]);
                }
            }else{
                return redirect()->back()->with(['message' => 'Email đã đăng ký!']);
            }
        }
    }

    private function existEmail($email){
        $row = $this->newsletterRepo->GetItem(['email'=>$email]);
        if($row){
            return true;
        }
        return false;
    }
}
