<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*SEO Tool*/
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd; // OR with multi
//use Artesaos\SEOTools\Facades\JsonLdMulti;// OR
//use Artesaos\SEOTools\Facades\SEOTools;
/*### END SEO Tool*/

use Helper;

class CategoryController extends Controller
{
    private $model, $view, $model_question;

    public function ShowItems($response, Request $request)
    {
        //### gọi model
        $lang = (isset($response->lang)) ? $response->lang : 'vi';
        $field = (isset($response->field)) ? $response->field : '';
        $slug = (isset($response->slug)) ? $response->slug : '';
        $type = (isset($response->type)) ? $response->type : '';
        $category = (isset($response->category)) ? $response->category : '';
        $title_main = (isset($response->title)) ? $response->title : '';
        $arr_childCategory = $arr_parentCategory = $arr_categorylist = $arr_brandlist = array();
        $model_question = 'category';

        $array_category_id = $request->category_query;
        $array_brand_id = $request->brand_query;

        $row_seo = $banner = $this->seopageRepo->GetItem(['type' => $type]);

        //### lấy ds brand và category filter
        if ($array_brand_id) {
            $arr_brandlist = explode(',', $array_brand_id);
        }

        if ($array_category_id) {
            $arr_categorylist = explode(',', $array_category_id);
        }


        //### xử lý mảng url level
        $params = null;
        if (isset($response->arr_level)) {
            $arr_level = $response->arr_level;
            $arr_level_ids = $arr_breadcum = array();

            foreach ($arr_level as $k => $v) {
                $row = $this->categoryRepo->Query()->select('id', 'tenvi', 'tenkhongdauvi')->where('tenkhongdauvi', $v)->first();
                if ($row) {
                    $params[$k] = $row['id'];
                    $arr_breadcum[$row['tenkhongdauvi']] = $row['tenvi'];
                }
            }
        }


        //### code xử lý
        $row_detail = $this->categoryRepo->GetOneItem($field, $this->relations);

        if ($row_detail['banner'] != '') {
            $banner['banner'] = $row_detail['banner'];
        }

        //### Lấy thông tin filter
        //# thông tin ds cấp 1
        $arr_level = $response->arr_level;
        $row_lv1 = $this->categoryRepo->GetItem(['level' => 0, 'tenkhongdau' . $lang => $arr_level['level_1']]);

        //# Ds danh mục con
        $level_child = $row_detail['level'] + 1;
        $category_child = $this->categoryRepo->GetAllItems('product', ['level' => $level_child, 'ids_level_' . $level_child => $row_detail['id']]);

        //# Ds nhóm thuộc tính theo danh mục
        $thuoctinh_of_category = $this->categoryPropertyRepo->GetAllItemsByParamsPluck('id_property', ['id_category' => $row_lv1['id']]);
        $thuoctinhs = $this->categoryRepo->GetAllItemByIds($thuoctinh_of_category);
        $query = $request->request->all();

        if ($field) {
            //lấy ds category con
            /*array_push($arr_childCategory, (int)$field);
            $arr_childCategory = array_merge($arr_childCategory, $this->categoryRepo->GetChildCategory($type,$field));
            $params['id_category'] = $arr_childCategory;*/

            //lấy ds category cha
            /*array_push($arr_parentCategory, $row_detail['id_parent']);
            $arr_parentCategory = array_merge($arr_parentCategory, $this->categoryRepo->GetParentCategory($type,$row_detail['id_parent']));
            $arr_parentCategory = array_reverse($arr_parentCategory);*/
        }
        $list_ids_level_1 = [];
        $list_ids_level_2 = [];

        $this->CallModel($type);
        if ($array_category_id || $array_brand_id) {
            $items = $this->GetFilterProduct($array_category_id, $array_brand_id);
        } else {

            if ($request->ids_level_1) {
                $list_ids_level_1 = $params['list_ids_level_1'] = explode(',', $request->ids_level_1);
            }

            if ($request->ids_level_2) {
                $list_ids_level_2 = $params['list_ids_level_2'] = explode(',', $request->ids_level_2);
            }
            $params['hienthi'] = '1';

            if($request->page == null || $request->page == 1) {
                $this->model->SetNumberPerPage(7);
            }
            $items = $this->model->GetAllItems($type, $params, null, true);
        }


        $title = ($row_detail['title' . $lang] != '') ? $row_detail['title' . $lang] : $row_detail['ten' . $lang];
        $keywords = ($row_detail['keywords' . $lang] != '') ? $row_detail['keywords' . $lang] : $row_detail['ten' . $lang];
        $description = ($row_detail['description' . $lang] != '') ? $row_detail['description' . $lang] : $row_detail['ten' . $lang];
        $title_crumb = ($row_detail['ten' . $lang]) ? $row_detail['ten' . $lang] : $title_main;
        $photo = ($row_detail['photo'] != '') ? Helper::GetConfigBase() . UPLOAD_CATEGORY . $row_detail['photo'] : '';
        $img_json_bar = ($row_detail['photo'] != '') ? Helper::getImgSize($row_detail['photo'], UPLOAD_PRODUCT . $row_detail['photo']) : '';
        $published_time = date('c', $row_detail['ngaytao']);
        $modified_time = date('c', $row_detail['ngaysua']);

        /* breadCrumbs */
        if ($arr_breadcum) {
            foreach ($arr_breadcum as $k => $v) {
                Helper::setBreadCrumbs($k, $v);
            }
        } else {
            foreach ($arr_parentCategory as $k => $v) {
                $row_breadcum = $this->categoryRepo->GetOneItem($v, $this->relations);
                Helper::setBreadCrumbs($row_breadcum['tenkhongdauvi'], $row_breadcum['ten' . $lang]);
            }
        }

        if (!$arr_breadcum) {
            if (isset($title_crumb) && $title_crumb != '') Helper::setBreadCrumbs($slug, $title_main);
            Helper::setBreadCrumbs($row_detail['tenkhongdauvi'], $row_detail['ten' . $lang]);
            $breadcrumbs = Helper::getBreadCrumbs();
        }


        $breadcrumbs = Helper::getBreadCrumbs();

        /*### SEO TOOL */
        SEOMeta::setCanonical(url()->current());
        SEOMeta::setTitle($title);
        SEOMeta::setKeywords($keywords);
        SEOMeta::setDescription($description);

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl($request->url());
        if ($field) {
            OpenGraph::addProperty('type', 'article');
            SEOMeta::addMeta('article:published_time', $published_time, 'property');
            SEOMeta::addMeta('article:modified_time', $modified_time, 'property');
        } else {
            OpenGraph::addProperty('type', 'object');
        }
        if ($img_json_bar != '' && count($img_json_bar) > 0) {
            OpenGraph::addImage($photo, ['height' => $img_json_bar['h'], 'width' => $img_json_bar['w'], 'type' => $img_json_bar['m'], 'alt' => $title]);
        } else {
            OpenGraph::addImage($photo, ['alt' => $title]);
        }

        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        TwitterCard::setImage($photo);

        //### Lấy thông tin category level 1
        $danhmuc1 = $this->categoryRepo->GetItem(['tenkhongdauvi' => $request->slug]);

        //### lấy danh sách câu hỏi
        $question = $this->questionRepo->GetQuestions(['type' => $type, 'model' => $model_question, 'id_item' => $row_detail['id'], 'duyettin' => 1, 'hienthi' => 1], null, true, false);

        //### lấy ds thương hiệu
        $thuonghieus = $this->brandRepo->GetAllItems('product');

        //### list categories
        $categories = $this->categoryRepo->GetAllItems($type, ['hienthi' => 1, 'level' => 0]);

        //### lấy ds danh mục cấp 3
        $danhmuc3 = (isset($danhmuc1)) ? $this->categoryRepo->GetAllItems('product', ['ids_level_1' => $danhmuc1['id'], 'level' => 1]) : null;

        //### lấy ds danh mục blog
        $cateBlog = $this->categoryRepo->GetAllItems('blog', ['hienthi' => 1, 'noibat' => 1]);


        //### trả dữ liệu -> blade view
        $response = array(
            "row_detail" => $row_detail,
            "products" => $items,
            "posts" => $items,
            "albums" => $items,
            "title_crumb" => $title_crumb,
            "breadcrumbs" => $breadcrumbs,
            "question" => $question,
            "type_question" => $type,
            "model_question" => $model_question,
            "id_item" => $row_detail['id'],
            "background_category" => $row_detail['background'],
            "danhmuc1" => $danhmuc1,
            "danhmuc3" => $danhmuc3,
            "thuonghieus" => $thuonghieus,
            "brandlist" => $arr_brandlist,
            "categorylist" => $arr_categorylist,
            "categories" => $categories,
            "banner" => $banner,
            "folder_upload" => ($row_detail['banner'] != '') ? UPLOAD_CATEGORY : UPLOAD_SEOPAGE,
            "category_child" => $category_child,
            'thuoctinhs' => $thuoctinhs,
            'level_child' => $level_child,
            'query' => $query,
            'cateBlog' => $cateBlog,
            'slug' => $slug,
            "list_ids_level_1" => $list_ids_level_1,
            "list_ids_level_2" => $list_ids_level_2
        );
        // dd($this->view);

        return view($this->view)->with($response);
    }


    public function CallModel($type)
    {
        $arr_product = config('config_type.product');
        $arr_post = config('config_type.post');
        $arr_album = config('config_type.album');

        if (array_key_exists($type, $arr_product)) {
            $this->model = $this->productRepo;
            $this->view = 'desktop.templates.product.products';
        } else if (array_key_exists($type, $arr_post)) {
            $this->model = $this->postRepo;
            if($type == 'news'){
                $this->view = 'desktop.templates.post.news';
            }else{
                $this->view = 'desktop.templates.post.posts';

            }
        } else if (array_key_exists($type, $arr_album)) {
            $this->model = $this->albumRepo;
            $this->view = 'desktop.templates.album.albums';
        }
    }


    public function GetFilterProduct($array_category_id, $array_brand_id)
    {
        $str_category = $str_brand = '';
        $arr_category = $arr_brand = array();


        if ($array_category_id != '') {
            $str_tmp = '';
            $array_category_id = explode(',', $array_category_id);

            foreach ($array_category_id as $k => $v) {
                $row = $this->categoryRepo->GetItem(['tenkhongdauvi' => $v]);

                if ($row) {
                    array_push($arr_category, $row['id']);
                }
            }
        }


        if ($array_brand_id != '') {
            $str_tmp = '';
            $array_brand_id = explode(',', $array_brand_id);

            foreach ($array_brand_id as $k => $v) {
                $row = $this->brandRepo->GetItem(['tenkhongdauvi' => $v]);

                if ($row) {
                    array_push($arr_brand, $row['id']);
                }
            }
        }

        $run = $this->productRepo->Query();
        if ($arr_category) {
            $str_tmp = '';
            foreach ($arr_category as $k => $v) {
                if ($k > 0 && $k < count($arr_category)) {
                    $str_tmp .= ' or ';
                }
                $str_tmp .= 'FIND_IN_SET(' . $v . ',ids_level_3)';
            }
            if ($str_tmp != '') {
                $str_category .= '(' . $str_tmp . ')';
            }
            $run = $run->whereRaw($str_category);
        }

        if ($arr_brand) {
            $str_tmp = '';
            foreach ($arr_brand as $k => $v) {
                if ($k > 0 && $k < count($arr_brand)) {
                    $str_tmp .= ' or ';
                }
                $str_tmp .= 'id_brand=' . $v;
            }
            if ($str_tmp != '') {
                $str_brand .= '(' . $str_tmp . ')';
            }
            $run = $run->whereRaw($str_brand);
        }

        return $run->where('hienthi', 1)->orderBy('stt', 'asc')->paginate(21)->withQueryString();
    }
}
