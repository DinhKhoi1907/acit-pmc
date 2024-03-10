<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*SEO Tool*/
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;// OR with multi
//use Artesaos\SEOTools\Facades\JsonLdMulti;// OR
//use Artesaos\SEOTools\Facades\SEOTools;
/*### END SEO Tool*/

use Helper;

class StaticPostController extends Controller
{

    public function ShowStatic($response, Request $request){
        //### gọi model
        $model = $this->staticRepo;//new StaticPost();
        $model_post = $this->postRepo;
        $model_photo = $this->photoRepo;
        $model_gallery = $this->galleryRepo;
        $lang = (isset($response->lang))?$response->lang:'vi';
        $type = (isset($response->type))?$response->type:'';
        $title_main = (isset($response->title))?$response->title:'';
        $slug = (isset($response->slug))?$response->slug:'';
        $model_question = 'static';

        $is_fix_menu = '';

        //### xử lý
        $row_detail = $model->GetItem(['type'=>$type]);
        $title = ($row_detail['title'.$lang]!='') ? $row_detail['title'.$lang] : $row_detail['ten'.$lang];
        $keywords = ($row_detail['keywords'.$lang]!='') ? $row_detail['keywords'.$lang] : $row_detail['ten'.$lang];
        $description = ($row_detail['description'.$lang]!='') ? $row_detail['description'.$lang] : $row_detail['ten'.$lang];
        $title_crumb = $title_main;//($row_detail['ten'.$lang]) ? $row_detail['ten'.$lang] : $title_main;
        $photo = ($row_detail['photo']!='')?Helper::GetConfigBase().UPLOAD_STATICPOST.$row_detail['photo']:'';
        $img_json_bar = ($row_detail['photo']!='')?Helper::getImgSize($row_detail['photo'],UPLOAD_STATICPOST.$row_detail['photo']):'';
        $hinhanhsp = $model_gallery->GetAllItems($type,['id_photo'=>$row_detail['id'], 'kind'=>'man', 'val'=>$type, 'com'=>'staticpost'], null, false, false, 3);
        /* breadCrumbs */
        if(isset($title_crumb) && $title_crumb != '') Helper::setBreadCrumbs($slug,$title_main);
        $breadcrumbs = Helper::getBreadCrumbs();

        //### lấy danh sách câu hỏi
        $question = $this->questionRepo->GetQuestions(['type'=>$type,'model'=>$model_question,'duyettin'=>1,'hienthi'=>1], null, true, false);

        $row_seo = $banner = $this->seopageRepo->GetItem(['type'=>$type]);

        if($row_detail['banner']!=''){
            $banner['banner'] = $row_detail['banner'];
        }


        $posts = $chungnhan = null;
        if($type=='vechungtoi' || $type=='linhvuckinhdoanh'){
            $posts = $this->postRepo->GetAllItems($type,['hienthi'=>1]);
        }

        if($type=='linhvuckinhdoanh'){
            $chungnhan = $this->photoRepo->GetAllItems('chungnhan',['hienthi'=>1]);

            if(config('config_all.data_demo')){
                //### test duplicate array customer
                $arr_tmp = array();
                for($i=0;$i<4;$i++){
                    $arr_tmp = array_merge($chungnhan, $arr_tmp);
                }
                $chungnhan = $arr_tmp;
            }
        }

        if($type=='goi-y'){
            $is_fix_menu = FIX_MENU;
        }

        $videos = $this->postRepo->GetAllItems('video',['hienthi'=>1],null,false,false,10,['ngaytao'=>'desc']);

        $lichsuhinhthanh = $model_post->GetAllItems('lichsuhinhthanh',['hienthi'=>1]);
        $sodotochuc = $model_photo->GetAllItems('sodotochuc',['hienthi'=>1]);
        // $doitac = $this->postRepo->GetAllItems('corevalue',['hienthi'=>1]);

        //### trả dữ liệu -> blade view
        $response = array(
            "row_detail" => $row_detail,
            "title_crumb" => $title_crumb,
            "breadcrumbs" => $breadcrumbs,
            "question" => $question,
            "type_question" => $type,
            "model_question" => $model_question,
            "banner" => $banner,
            "folder_upload" => UPLOAD_STATICPOST,
            "posts" => $posts,
            "chungnhan" => $chungnhan,
            "videos" => $videos,
            // "doitac" => $doitac,
            "is_fix_menu" => $is_fix_menu,
            "sodotochuc" => $sodotochuc,
            "hinhanhsp" => $hinhanhsp,
            "lichsuhinhthanh" => $lichsuhinhthanh
        );


        /*### SEO TOOL */
        SEOMeta::setCanonical(url()->current());
        SEOMeta::setTitle($title);
        SEOMeta::setKeywords($keywords);
        SEOMeta::setDescription($description);

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl($request->url());
        OpenGraph::addProperty('type', 'object');
        if($img_json_bar!='' && count($img_json_bar)>0){
            OpenGraph::addImage($photo, ['height' => $img_json_bar['h'], 'width' => $img_json_bar['w'], 'type' => $img_json_bar['m'], 'alt' =>$title]);
        }else{
            OpenGraph::addImage($photo, ['alt' =>$title]);
        }

        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        TwitterCard::setImage($photo);

        //### view
        if($type=='huongdanmuahang'){
            $params['hienthi'] = 1;
            $chinhsach = $this->postRepo->GetAllItems('chinhsach',$params,null,true,true);
            $response['chinhsach'] = $chinhsach;
            $response['e_active'] = 'huongdanmuahang';
            $response['slug'] = $slug;

            $view = view('desktop.templates.post.chinhsach_detail')->with($response);
        }else if($type=='catalogue'){
            $view = view('desktop.templates.static.catalogue')->with($response);
        }else{
            // dd($response);
            $view = view('desktop.templates.static.static')->with($response);
        }

        return $view;
    }

    public function ShowOrder($response, Request $request){
        //### gọi model
        $model = $this->staticRepo;//new StaticPost();

        $lang = (isset($response->lang))?$response->lang:'vi';
        $type = (isset($response->type))?$response->type:'';
        $title_main = (isset($response->title))?$response->title:'';
        $slug = (isset($response->slug))?$response->slug:'';
        $model_question = 'static';

        //### xử lý
        $row_detail = $model->GetItem(['type'=>$type]);
        $title = ($row_detail['title'.$lang]!='') ? $row_detail['title'.$lang] : $row_detail['ten'.$lang];
        $keywords = ($row_detail['keywords'.$lang]!='') ? $row_detail['keywords'.$lang] : $row_detail['ten'.$lang];
        $description = ($row_detail['description'.$lang]!='') ? $row_detail['description'.$lang] : $row_detail['ten'.$lang];
        $title_crumb = $title_main;//($row_detail['ten'.$lang]) ? $row_detail['ten'.$lang] : $title_main;
        $photo = ($row_detail['photo']!='')?Helper::GetConfigBase().UPLOAD_STATICPOST.$row_detail['photo']:'';
        $img_json_bar = ($row_detail['photo']!='')?Helper::getImgSize($row_detail['photo'],UPLOAD_STATICPOST.$row_detail['photo']):'';

        /* breadCrumbs */
        if(isset($title_crumb) && $title_crumb != '') Helper::setBreadCrumbs($slug,$title_main);
        $breadcrumbs = Helper::getBreadCrumbs();

        //### lấy danh sách câu hỏi
        $question = $this->questionRepo->GetQuestions(['type'=>$type,'model'=>$model_question,'duyettin'=>1,'hienthi'=>1], null, true, false);

        $row_seo = $banner = $this->seopageRepo->GetItem(['type'=>$type]);

        if($row_detail['banner']!=''){
            $banner['banner'] = $row_detail['banner'];
        }


        $client = $trial = $category = null;
        if($type=='order'){
            $client = $this->staticRepo->GetItem(['type'=>'client']);
            $trial = $this->staticRepo->GetItem(['type'=>'trial']);
            $category = $this->categoryRepo->GetAllItems('product',['hienthi'=>1, 'level'=>0]);
        }


        //### trả dữ liệu -> blade view
        $response = array(
            "row_detail" => $row_detail,
            "title_crumb" => $title_crumb,
            "breadcrumbs" => $breadcrumbs,
            "question" => $question,
            "type_question" => $type,
            "model_question" => $model_question,
            "banner" => $banner,
            "folder_upload" => UPLOAD_SEOPAGE,
            "client" => $client,
            "trial" => $trial,
            "category" => $category
        );

        /*### SEO TOOL */
        SEOMeta::setCanonical(url()->current());
        SEOMeta::setTitle($title);
        SEOMeta::setKeywords($keywords);
        SEOMeta::setDescription($description);

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl($request->url());
        OpenGraph::addProperty('type', 'object');
        if($img_json_bar!='' && count($img_json_bar)>0){
            OpenGraph::addImage($photo, ['height' => $img_json_bar['h'], 'width' => $img_json_bar['w'], 'type' => $img_json_bar['m'], 'alt' =>$title]);
        }else{
            OpenGraph::addImage($photo, ['alt' =>$title]);
        }

        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        TwitterCard::setImage($photo);

        //### view
        $view = view('desktop.templates.static.order')->with($response);
        return $view;
    }
}
