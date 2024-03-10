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

class SearchController extends Controller
{

    public function Search($response, Request $request){
        //### lấy dữ liệu
        $model = $this->productRepo;//new Product('man');
        $model_seo = $this->seopageRepo;//new SeoPage();
        $lang = (isset($response->lang))?$response->lang:'vi';
        $field = (isset($response->field))?$response->field:'';
        $slug = (isset($response->slug))?$response->slug:'';
        $type = (isset($response->type))?$response->type:'';
        $category = (isset($response->category))?$response->category:'';
        $title_main = (isset($response->title))?$response->title:'';

        $keyword = $request->keyword;
        $params = array(
            'keyword'=> $keyword
        );
        $items = $model->GetAllItems($type,$params,null,true);
        $row_seo = $model_seo->GetItem(['type'=>$type]);
        $title = (isset($row_seo) && $row_seo['title'.$lang]!='') ? $row_seo['title'.$lang] : ((isset($row_seo)) ? $row_seo['ten'.$lang] : '');
        $keywords = (isset($row_seo) && $row_seo['keywords'.$lang]!='') ? $row_seo['keywords'.$lang] : ((isset($row_seo)) ? $row_seo['ten'.$lang] : '');
        $description = (isset($row_seo) && $row_seo['description'.$lang]!='') ? $row_seo['description'.$lang] : ((isset($row_seo)) ? $row_seo['ten'.$lang] : '');
        $title_crumb = $title_main;
        $photo = (isset($row_seo) && $row_seo['photo']!='')?Helper::GetConfigBase().UPLOAD_SEOPAGE.$row_seo['photo']:'';
        $img_json_bar = (isset($row_seo) && $row_seo['photo']!='')?Helper::getImgSize($row_seo['photo'],UPLOAD_SEOPAGE.$row_seo['photo']):'';

        $row_seo = $banner = $this->seopageRepo->GetItem(['type'=>$type]);


        /* breadCrumbs */
        if(isset($title_crumb) && $title_crumb != '') Helper::setBreadCrumbs($slug,$title_main);
        $breadcrumbs = Helper::getBreadCrumbs();

        //### danh mục 
        $danhmucparent = $this->categoryRepo->GetAllItems($type);

        //### trả dữ liệu -> blade view
        $response = array(
            "products" => $items,
            "title" => $title,
            "keywords" => $keywords,
            "description" => $description,
            "title_crumb" => $title_crumb,
            "breadcrumbs" => $breadcrumbs,
            "banner" => $banner,
            "folder_upload" => UPLOAD_SEOPAGE,
            "categories" => ($danhmucparent) ? $danhmucparent : null,
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

        return view('desktop.templates.product.products')->with($response);
    }



    public function SearchBlog($response, Request $request){
        //### lấy dữ liệu
        $model = $this->postRepo;//new Product('man');
        $model_seo = $this->seopageRepo;//new SeoPage();
        $lang = (isset($response->lang))?$response->lang:'vi';
        $field = (isset($response->field))?$response->field:'';
        $slug = (isset($response->slug))?$response->slug:'';
        $type = (isset($response->type))?$response->type:'';
        $category = (isset($response->category))?$response->category:'';
        $title_main = (isset($response->title))?$response->title:'';

        $keyword = $request->keyword;
        $params = array(
            'keyword'=> $keyword
        );

        $items = $model->GetAllItems($type,$params,null,true);
        $row_seo = $model_seo->GetItem(['type'=>$type]);
        $title = (isset($row_seo) && $row_seo['title'.$lang]!='') ? $row_seo['title'.$lang] : ((isset($row_seo)) ? $row_seo['ten'.$lang] : '');
        $keywords = (isset($row_seo) && $row_seo['keywords'.$lang]!='') ? $row_seo['keywords'.$lang] : ((isset($row_seo)) ? $row_seo['ten'.$lang] : '');
        $description = (isset($row_seo) && $row_seo['description'.$lang]!='') ? $row_seo['description'.$lang] : ((isset($row_seo)) ? $row_seo['ten'.$lang] : '');
        $title_crumb = $title_main;
        $photo = (isset($row_seo) && $row_seo['photo']!='')?Helper::GetConfigBase().UPLOAD_SEOPAGE.$row_seo['photo']:'';
        $img_json_bar = (isset($row_seo) && $row_seo['photo']!='')?Helper::getImgSize($row_seo['photo'],UPLOAD_SEOPAGE.$row_seo['photo']):'';

        $row_seo = $banner = $this->seopageRepo->GetItem(['type'=>$type]);


        /* breadCrumbs */
        if(isset($title_crumb) && $title_crumb != '') Helper::setBreadCrumbs($slug,$title_main);
        $breadcrumbs = Helper::getBreadCrumbs();


        $cateBlog = $this->categoryRepo->GetAllItems('blog',['hienthi'=>1,'noibat'=>1]);

        //### trả dữ liệu -> blade view
        $response = array(
            "posts" => $items,
            "title" => $title,
            "keywords" => $keywords,
            "description" => $description,
            "title_crumb" => $title_crumb,
            "breadcrumbs" => $breadcrumbs,
            "banner" => $banner,
            "cateBlog" => $cateBlog,
            "folder_upload" => UPLOAD_SEOPAGE,
            "is_fix_menu" => FIX_MENU
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

        return view('desktop.templates.post.blog')->with($response);
    }



    public function ShowBlog($response, Request $request){
        //### lấy dữ liệu
        $model = $this->productRepo;//new Product('man');
        $model_seo = $this->seopageRepo;//new SeoPage();
        $lang = (isset($response->lang))?$response->lang:'vi';
        $field = (isset($response->field))?$response->field:'';
        $slug = (isset($response->slug))?$response->slug:'';
        $type = (isset($response->type))?$response->type:'';
        $category = (isset($response->category))?$response->category:'';
        $title_main = (isset($response->title))?$response->title:'';

        $keyword = $request->keyword;
        $params = array(
            'keyword'=> $keyword
        );
        $items = $model->GetAllItems($type,$params,null,true);
        $row_seo = $model_seo->GetItem(['type'=>$type]);
        $title = (isset($row_seo) && $row_seo['title'.$lang]!='') ? $row_seo['title'.$lang] : ((isset($row_seo)) ? $row_seo['ten'.$lang] : '');
        $keywords = (isset($row_seo) && $row_seo['keywords'.$lang]!='') ? $row_seo['keywords'.$lang] : ((isset($row_seo)) ? $row_seo['ten'.$lang] : '');
        $description = (isset($row_seo) && $row_seo['description'.$lang]!='') ? $row_seo['description'.$lang] : ((isset($row_seo)) ? $row_seo['ten'.$lang] : '');
        $title_crumb = $title_main;
        $photo = (isset($row_seo) && $row_seo['photo']!='')?Helper::GetConfigBase().UPLOAD_SEOPAGE.$row_seo['photo']:'';
        $img_json_bar = (isset($row_seo) && $row_seo['photo']!='')?Helper::getImgSize($row_seo['photo'],UPLOAD_SEOPAGE.$row_seo['photo']):'';

        $row_seo = $banner = $this->seopageRepo->GetItem(['type'=>$type]);


        /* breadCrumbs */
        if(isset($title_crumb) && $title_crumb != '') Helper::setBreadCrumbs($slug,$title_main);
        $breadcrumbs = Helper::getBreadCrumbs();

        //### trả dữ liệu -> blade view
        $response = array(
            "products" => $items,
            "title" => $title,
            "keywords" => $keywords,
            "description" => $description,
            "title_crumb" => $title_crumb,
            "breadcrumbs" => $breadcrumbs,
            "banner" => $banner,
            "folder_upload" => UPLOAD_SEOPAGE,
            "is_fix_menu" => FIX_MENU
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

        return view('desktop.templates.post.mucluc')->with($response);
    }
}
