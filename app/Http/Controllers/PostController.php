<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

/*SEO Tool*/
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;// OR with multi
//use Artesaos\SEOTools\Facades\JsonLdMulti;// OR
//use Artesaos\SEOTools\Facades\SEOTools;
/*### END SEO Tool*/

use App\Models\User;

use Helper, TableManipulation;

class PostController extends Controller
{

    public function ShowPosts($response, Request $request){
        //### gọi model
        $model = $this->postRepo;//new Post('man');

        $lang = (isset($response->lang))?$response->lang:'vi';
        $field = (isset($response->field))?$response->field:'';
        $slug = (isset($response->slug))?$response->slug:'';
        $type = (isset($response->type))?$response->type:'';
        $category = (isset($response->category))?$response->category:'';
        $title_main = (isset($response->title))?$response->title:'';
        $comment = (isset($request->comment))?$request->comment:'';
        $model_question = 'post';

        $is_fix_menu = '';

        $row_seo = $banner = $this->seopageRepo->GetItem(['type'=>$type]);

        $cateBlog = $this->categoryRepo->GetAllItems('blog',['hienthi'=>1,'noibat'=>1]);

        //### xử lý
        if($field!=''){
            $setting = app('setting');
            $settingOptions = app('settingOptions');

            //### lấy dữ liệu
            $row_detail = $model->GetOneItem($field);

            //### tăng lượt xem
            $luotxem = $row_detail['luotxem'] + 1;
            $this->postRepo->SaveItem(['luotxem'=>$luotxem],$row_detail['id']);

            //### lấy ds ids category
            if($row_detail['id_category']!=0){

                $id_cate  = $row_detail['id_category'];
                $arr_childCategory = $arr_parentCategory = array();
                $row_detail_cate = $this->categoryRepo->GetOneItem($id_cate,null);

                //lấy ds category con
                array_push($arr_childCategory, (int)$id_cate);
                $arr_childCategory = array_merge($arr_childCategory, $this->categoryRepo->GetChildCategory($type,$id_cate));
                $params['id_category'] = $arr_childCategory;

                //lấy ds category cha
                array_push($arr_parentCategory, $row_detail_cate['id_parent']);
                $arr_parentCategory = array_merge($arr_parentCategory, $this->categoryRepo->GetParentCategory($type,$row_detail_cate['id_parent']));
                $arr_parentCategory = array_reverse($arr_parentCategory);
            }


            //### Lấy ds tags của sản phẩm hiện tại
            $tags = array();
            if($row_detail['id_tags']!=''){
                $tag_arr = explode(',',$row_detail['id_tags']);
                $tags = $this->tagRepo->Query()->whereIn('id',$tag_arr)->where('hienthi',1)->get();
                if($tags){
                    $tags = $tags->toArray();
                }
            }


            //### lấy ds bài viết theo ids_level
            if(TableManipulation::CheckFieldToTable('post', 'ids_level_1') && $row_detail['ids_level_1']!=''){
                $id_cate  = $row_detail['ids_level_1'];
                $params['ids_level_1'] = explode(',',$id_cate);
            }

            if($type!='chinhsach'){$params['id'] = $field;}
            $params['hienthi'] = 1;
            //dd($params);

            $posts = $model->GetAllItemsExceptId($type,$params,null,true,true);
            $posts_newest = $model->GetAllItems('news',['hienthi'=>1],null,false,false,5,['ngaytao'=>'desc']);

            $title = ($row_detail['title'.$lang]!='') ? $row_detail['title'.$lang] : $row_detail['ten'.$lang];
            $keywords = ($row_detail['keywords'.$lang]!='') ? $row_detail['keywords'.$lang] : $row_detail['ten'.$lang];
            $description = ($row_detail['description'.$lang]!='') ? $row_detail['description'.$lang] : $row_detail['ten'.$lang];
            $title_crumb = $title_main; //($row_detail['ten'.$lang]) ? $row_detail['ten'.$lang] : $title_main;
            $photo = ($row_detail['photo']!='')?Helper::GetConfigBase().UPLOAD_POST.$row_detail['photo']:'';
            $img_json_bar = ($row_detail['photo']!='')?Helper::getImgSize($row_detail['photo'],UPLOAD_POST.$row_detail['photo']):'';
            $published_time = date('c',$row_detail['ngaytao']);
            $modified_time = date('c',$row_detail['ngaysua']);

            //### Thiết lập breadcum
            $arr_parentCategory = array();
            array_push($arr_parentCategory, $row_detail['id_category']);
            $arr_parentCategory = array_merge($arr_parentCategory, $this->categoryRepo->GetParentCategory($type,$row_detail['id_category']));
            $arr_parentCategory = array_reverse($arr_parentCategory);

            if(isset($title_crumb) && $title_crumb != '') Helper::setBreadCrumbs($slug,__($title_main));
            if($arr_parentCategory){
                foreach($arr_parentCategory as $k=>$v){
                    $row_breadcum = $this->categoryRepo->GetOneItem($v);
                    if($row_breadcum){Helper::setBreadCrumbs($row_breadcum['tenkhongdauvi'],$row_breadcum['ten'.$lang]);}
                }
            }
            Helper::setBreadCrumbs($row_detail['tenkhongdauvi'],$row_detail['ten'.$lang]);
            $breadcrumbs = Helper::getBreadCrumbs();


            //### lấy danh sách câu hỏi
            $question = $this->questionRepo->GetQuestions(['type'=>$type,'model'=>$model_question,'id_item'=>$row_detail['id'],'duyettin'=>1,'hienthi'=>1], null, true, false);


            //### lấy thông tin nguồn tin
            $nguontin = '';
            if(isset($row_detail['nguon'])){
                $nguontin = $this->postRepo->GetItem(['type'=>'nguontin', 'id'=>$row_detail['nguon']]);
            }


            //### lấy danh sách bình luận
            $comment_relation = $this->commentRepo->GetRelationsRepo();
            $binhluans = $this->commentRepo->GetItems(['id_parent'=>0, 'id_post'=>$row_detail['id'], 'hienthi'=>1], $comment_relation, ['ngaytao'=>'desc']);
            //dd($binhluans);

            if($type=='media'){
                $is_fix_menu = FIX_MENU;
            }


            //### trả dữ liệu -> blade view
            $response = array(
                "row_detail" => $row_detail,
                "posts" => $posts,
                "posts_newest" => $posts_newest,
                "title" => $title,
                "keywords" => $keywords,
                "description" => $description,
                "title_crumb" => $title_crumb,
                "breadcrumbs" => $breadcrumbs,
                "question" => $question,
                "type_question" => $type,
                "model_question" => $model_question,
                "id_item" => $row_detail['id'],
                "tags" => $tags,
                "nguontin" => $nguontin,
                "binhluans" => $binhluans,
                "comment" => ($comment) ? $comment : 0,
                "banner" => $banner,
                "folder_upload" => UPLOAD_SEOPAGE,
                "cateBlog" => $cateBlog,
                "is_fix_menu" => $is_fix_menu
            );


            //### view
            if( $type=='chinhsach' || $type=='kienthuc' || $type=='lienket'){
                $view = view('desktop.templates.post.other_detail')->with($response);
            }else if($type=='forex'){
                $view = view('desktop.templates.post.forex_detail')->with($response);
            }else if($type=='sanforex'){
                $view = view('desktop.templates.post.sanforex_detail')->with($response);
            }else if($type=='video'){
                $view = view('desktop.templates.post.video_detail')->with($response);
            }else if($type=='dichvu'){
                $view = view('desktop.templates.post.dichvu_detail')->with($response);
            }else{
                // dd($response);
                $view = view('desktop.templates.post.post_detail')->with($response);
            }

        }else{
            //### lấy dữ liệu
            $model_seo = $this->seopageRepo;//new SeoPage();
            $params['hienthi'] = 1;
            if($request->page == null || $request->page == 1) {
                $model->SetNumberPerPage(7);
            }

            $posts = $model->GetAllItems($type,$params,null, true);

            if($type=='chinhsach'){
                return redirect()->route('slug', [$posts[0]['tenkhongdauvi']]);
            }
            if($type=='media'){
                $is_fix_menu = FIX_MENU;
            }

            $title = (isset($row_seo) && $row_seo['title'.$lang]!='') ? $row_seo['title'.$lang] : ((isset($row_seo)) ? $row_seo['ten'.$lang] : '');
            $keywords = (isset($row_seo) && $row_seo['keywords'.$lang]!='') ? $row_seo['keywords'.$lang] : ((isset($row_seo)) ? $row_seo['ten'.$lang] : '');
            $description = (isset($row_seo) && $row_seo['description'.$lang]!='') ? $row_seo['description'.$lang] : ((isset($row_seo)) ? $row_seo['ten'.$lang] : '');
            $title_crumb = $title_main;
            $photo = (isset($row_seo) && $row_seo['photo']!='')?Helper::GetConfigBase().UPLOAD_SEOPAGE.$row_seo['photo']:'';
            $img_json_bar = (isset($row_seo) && $row_seo['photo']!='')?Helper::getImgSize($row_seo['photo'],UPLOAD_SEOPAGE.$row_seo['photo']):'';

            /* breadCrumbs */
            if(isset($title_crumb) && $title_crumb != '') Helper::setBreadCrumbs($slug,__($title_main));
            $breadcrumbs = Helper::getBreadCrumbs();

            //### danh mục
            $danhmucparent = $this->categoryRepo->GetAllItems($type);

            $doitac = $this->postRepo->GetAllItems('doitac', ['hienthi'=>1]);
            $hethong = $this->categoryRepo->GetAllItems('hethongphanphoi', ['hienthi'=>1, 'level'=>0]);
            $hethongcuahang = $model->GetAllItems('hethongphanphoi');

            //### trả dữ liệu -> blade view
            $response = array(
                "posts" => $posts,
                "title" => $title,
                "keywords" => $keywords,
                "description" => $description,
                "title_crumb" => $title_crumb,
                "breadcrumbs" => $breadcrumbs,
                "danhmucparent" => ($danhmucparent) ? $danhmucparent : null,
                "banner" => $banner,
                "folder_upload" => UPLOAD_SEOPAGE,
                "cateBlog" => $cateBlog,
                "is_fix_menu" => $is_fix_menu
            );

            //### view
            if($type=='forex'){
                $view = view('desktop.templates.post.forex')->with($response);
            }else if($type=='sanforex'){
                $view = view('desktop.templates.post.sanforex')->with($response);
            }else if($type=='video'){
                $view = view('desktop.templates.post.video')->with($response);
            }else if($type=='giaodich'){
                $view = view('desktop.templates.post.giaodich')->with($response);
            }else if($type=='news'){
                $view = view('desktop.templates.post.news')->with($response);
            }else if($type == 'catalogue') {
                $view = view('desktop.templates.post.catalogue')->with($response);
            }else{
                $view = view('desktop.templates.post.posts')->with($response);
            }

        }

        /*### SEO TOOL */
        SEOMeta::setCanonical(url()->current());
        SEOMeta::setTitle($title);
        SEOMeta::setKeywords($keywords);
        SEOMeta::setDescription($description);

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl($request->url());
        if($field){
            OpenGraph::addProperty('type', 'article');
            SEOMeta::addMeta('article:published_time', $published_time, 'property');
            SEOMeta::addMeta('article:modified_time', $modified_time, 'property');
        }else{
            OpenGraph::addProperty('type', 'object');
        }
        if($img_json_bar!='' && count($img_json_bar)>0){
            OpenGraph::addImage($photo, ['height' => $img_json_bar['h'], 'width' => $img_json_bar['w'], 'type' => $img_json_bar['m'], 'alt' =>$title]);
        }else{
            OpenGraph::addImage($photo, ['alt' =>$title]);
        }

        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        TwitterCard::setImage($photo);

        return $view;
    }

}
