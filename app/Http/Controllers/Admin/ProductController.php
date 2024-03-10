<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Traits\SupportTrait;

use Illuminate\Support\Str;

use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

use Helper, Thumb, TableManipulation, DB;

class ProductController extends Controller
{
    use SupportTrait;

    private $type, $table, $viewShow, $viewEdit, $config, $config_tags, $permissionShow, $permissionAdd, $permissionEdit, $permissionDelete, $permissionImport, $permissionExport, $page_error, $folder_upload;
    private $viewImport = 'admin.imports.product.man.import';
    private $viewImportImages = 'admin.imports.product.man.importImages';
    private $routeShow = 'admin.product.show';
    private $routeEdit = 'admin.product.edit';
    private $folder = "product";
    private $alert = "Hệ thống báo lỗi : Bạn không có quyền truy cập !";


    /*
    |--------------------------------------------------------------------------
    | Khởi tạo dữ liệu
    |--------------------------------------------------------------------------
    */
    public function initialization(Request $request){
        //### set request value
    	$this->category = $request->category;
    	$this->type = $request->type;
        $this->config = config('config_type.product');
        $this->config_tags = config('config_type.tags');
        $this->page_error = redirect()->back();
        $this->folder_upload = config('config_upload.UPLOAD_PRODUCT');

        //### set repo relation
    	$this->relations = $this->productRepo->GetRelationsRepo(); //['HasProductOptions', 'HasProductOptionsAll', 'HasAllChild'];
        $this->relationsOpt = $this->productOptRepo->GetRelationsRepo(); //['ProductParent', 'ColorOption', 'SizeOption'];
        $this->relationsCate = $this->categoryRepo->GetRelationsRepo(); //['CategoryParent'];

        $this->viewShow = 'admin.templates.product.man.product';
        $this->viewEdit = 'admin.templates.product.man.product_add';

        $this->permissionShow = 'product_man_'.$this->type;
        $this->permissionAdd = 'product_add_'.$this->type;
        $this->permissionEdit = 'product_edit_'.$this->type;
        $this->permissionDelete = 'product_delete_'.$this->type;
        $this->permissionImport = 'product_import_'.$this->type;
        $this->permissionExport = 'product_export_'.$this->type; 
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
        $params = array();
        $arr_childCategory = array();

        //### Code xử lý: lấy category        
        $row_category = ($request->id_category) ? $this->categoryRepo->GetOneItem($request->id_category,$this->relationsCate) : null; 
        $category = array(
            'id' => ($row_category) ? $row_category['id'] : 0,
            'id_parent' => ($row_category) ? $row_category['id'] : 0,
            'tenvi' => ($row_category) ? $row_category['tenvi'] : '',
            'tenvi_parent' => ($row_category) ? $row_category['tenvi'] : ''
        );
        $danhmucparent = $this->categoryRepo->GetAll($type);
        if($request->id_category){
            array_push($arr_childCategory, (int)$request->id_category);
            $arr_childCategory = array_merge($arr_childCategory, $this->categoryRepo->GetChildCategory($type,$request->id_category));
        }

        //### Code xử lý: 
        $params['id_list'] = ($request->id_list) ? $request->id_list : 0;
        $params['id_cat'] = ($request->id_cat) ? $request->id_cat : 0;
        $params['id_item'] = ($request->id_item) ? $request->id_item : 0;
        $params['id_sub'] = ($request->id_sub) ? $request->id_sub : 0;
        $params['keyword'] = ($request->keyword) ? $request->keyword : '';
        if($request->id_category){$params['id_category'] = $arr_childCategory;}

        //### Code xử lý...
        $itemShow = $this->productRepo->GetAllItems($type,$params,$this->relations,$this->pagination);
        $query_str = Helper::SetQuery($request->query);


        //### kiểm tra và cập nhật lại những hình đính kèm đang sai id_photo
        $product_miss_image = $this->galleryRepo->Query()->whereRaw('id_photo!=id_photo_old')->count();
        if($product_miss_image>0){
            DB::statement("UPDATE gallery SET id_photo = id_photo_old where id_photo != id_photo_old and id_photo_old>0 ");
            //$this->galleryRepo->whereRaw('id_photo!=id_photo_old')->update(['id_photo'=>'id_photo_old','hash'=>'']);
        }

        //### Trả về giao diện
        $response = array(
            'request'=>$request,
            'itemShow'=> $itemShow,
            'type'=> $type,
            'config'=>$this->config,
            'query_str'=>$query_str,
            'category' => $category,
            'danhmucparent' => $danhmucparent
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


        //### Tạo bản nháp
        if(!$id){
            $id = Helper::CreateDraft('product',$type);
            return redirect()->route($this->routeEdit,[$this->category,$type,$id]);
        }


        //### Code xử lý...
        $rowItem = $this->productRepo->GetOneItem($id,$this->relations);
        $gallery = $this->galleryRepo->GetAllGallery($type,$id,'product');
        $numberOption = ($id && isset($rowItem['has_product_options']))?count($rowItem['has_product_options']):0;

        //### Code xử lý: lấy category
        $row_category = $this->categoryRepo->GetOneItem($rowItem['id_category'],$this->relationsCate);
        $category = array(
            'id' => $rowItem['id'],
            'id_parent' => $rowItem['id_category'],
            'tenvi' => (isset($row_category)) ? $row_category['tenvi']: '',
            'tenvi_parent' => (isset($row_category)) ? $row_category['tenvi']: ''
        );

        $danhmucparent = $this->categoryRepo->GetAll($type);

        //### lấy ds gallery_multy
        $gallery_multy = $this->galleryRepo->GetAllItemByIds(explode(',',$rowItem['gallery']));
        

        //### Lấy ds thuộc tính của KIM CƯƠNG
        $thuoctinhKC = $values_of_thuoctinh = array();
        if($type=='kimcuong'){
            $thuoctinhKC = $this->categoryRepo->GetAllItems($type);
		    $values_of_thuoctinh = $this->productPropertyRepo->GetAllItemsByParamsPluck('id_value',['id_product'=>$id]);
        }


        //### Trả về giao diện
        $response = array(
            'request'=>$request,
            'rowItem'=> $rowItem,
            'category' => $category,
            'type'=> $type,
            'config'=>$this->config,
            'gallery'=>$gallery,
            'folder_upload'=>$this->folder,
            'numberOption'=>$numberOption,
            'config_tags'=>$this->config_tags,
            'danhmucparent' => $danhmucparent,
            'gallery_multy' => $gallery_multy,
            "thuoctinhKC" => $thuoctinhKC,
            "values_of_thuoctinh" => $values_of_thuoctinh
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

        //### Delete product con
        $rows_child = $this->productOptRepo->GetAllItems($type,['id_product'=>$id], $this->relationsOpt,false);
        foreach($rows_child as $k=>$v){
            $this->productOptRepo->DeleteOneItem($v['id'],$this->folder);
            $this->galleryRepo->DeleteGallery($v['id'],$category,$type,'product','productOption');
        }

        //### Delete product cha
        $this->productRepo->DeleteOneItem($id, $this->folder);        
        $this->galleryRepo->DeleteGallery($id,$category,$type,'product','product');

        //### xóa các giá trị thuộc tính theo id
        $this->productPropertyRepo->Query()->where('id_product',$id)->delete();

    	return redirect()->route($this->routeShow,[$category,$type]);
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

        //### Delete product con
        $arr_child = explode(",",$listid);
        foreach($arr_child as $pro=>$productParent){
            $rows_child = $this->productOptRepo->GetAllItems($type,['id_product'=>$productParent],$this->relationsOpt,false);
            foreach($rows_child as $k=>$v){
                $this->productOptRepo->DeleteOneItem($v['id'],$this->folder);
                $this->galleryRepo->DeleteGallery($v['id'],$category,$type,'product','product');
            }
        }


        if($listid!=''){
            $this->productRepo->DeleteMultiItem($listid, $this->folder);
            $this->galleryRepo->DeleteMultiGallery($listid,$category,$type,'product','product');
        }

        //### xóa các giá trị thuộc tính theo id
        $this->productPropertyRepo->Query()->whereIn('id_product',explode(",", $listid))->delete();

        return redirect()->route($this->routeShow,[$category,$type]);
    }


    /*
    |--------------------------------------------------------------------------
    | Lưu mới - cập nhật 1 dòng dữ liệu
    |--------------------------------------------------------------------------
    */
    public function Save(Request $request){
        //### khởi tạo giá trị cho model
        $this->initialization($request);
        //dd('ok');

        //### Thiết lập giá trị thuộc tính
        $category = $request->category;
        $id_parent = $request->id_parent;
        $type = $request->type;
        $id = $request->id;
        $hash = $request->hash;
        $hash_color = $request->hash_color;
        $savehere = ($request->has('savehere'))?true:false;     
        $savedraft = ($request->has('savedraft'))?true:false;   

        $data = $request->data;
        $dataOption = $request->dataOption;
        $dataColor = $request->dataColor;
        $deleteOptionItems = (isset($request->option_delete)) ? $request->option_delete : '';
        $width = ($request->width)?$request->width:null;
        $height = ($request->height)?$request->width:null;

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

        if($dataColor){
            $data['masp_color'] = json_encode($dataColor);
        }

        if($data){
            $data['type'] = $type;

            if ($this->config[$type]['slug']) {
                $slug_array = config('config_all.slug');
                foreach($slug_array as $k=>$v){
                    $data['tenkhongdau'.$k] = (isset($data['slug'.$k]) && $data['slug'.$k]!='') ? $data['slug'.$k] : ((isset($data['ten'.$k])) ? Str::slug($data['ten'.$k], '-') : '');
                }                
            } else {
                $slug_array = config('config_all.slug');
                foreach($slug_array as $k=>$v){
                    $data['tenkhongdau'.$k] = (isset($data['slug'.$k]) && $data['slug'.$k]!='') ? $data['slug'.$k] : '';
                }
            }

            $data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;

            $data['dai'] = (isset($data['dai']) && $data['dai'] != '') ? str_replace(",","",$data['dai']) : 0;
    		$data['rong'] = (isset($data['rong']) && $data['rong'] != '') ? str_replace(",","",$data['rong']) : 0;
    		$data['cao'] = (isset($data['cao']) && $data['cao'] != '') ? str_replace(",","",$data['cao']) : 0;
    		//$data['khoiluong'] = (isset($data['khoiluong']) && $data['khoiluong'] != '') ? str_replace(",","",$data['khoiluong']) : 0;
            $data['soluong_website'] = (isset($data['soluong_website']) && $data['soluong_website'] != '') ? str_replace(",","",$data['soluong_website']) : 0;

    		$data['giacu'] = (isset($data['giacu']) && $data['giacu'] != '') ? str_replace(",","",$data['giacu']) : 0;
    		$data['gia'] = (isset($data['gia']) && $data['gia'] != '') ? str_replace(",","",$data['gia']) : 0;
    		$data['giamoi'] = (isset($data['giamoi']) && $data['giamoi'] != '') ? str_replace(",","",$data['giamoi']) : 0;
    		$data['giakm'] = (isset($data['giakm']) && $data['giakm'] != '') ? $data['giakm'] : 0;
            $data['id_size'] = $data['id_mau'] = "";

            //### Lấy thông tin category parent
            $data['id_category'] = ($id_parent) ? $id_parent : 0;

            if($id){
                $data['ngaysua'] = time();
    		}else{
    			$data['ngaytao'] = $data['ngaysua'] = time();
    		}


            //### kiểm tra lưu nháp ?
            $data['draft'] = 0;
            if($savedraft){
                $data['draft'] = 1;
                $data['hienthi'] = 0;
            }


            //### lấy ids theo level
            $level_cate_max = $this->categoryRepo->Query()->max('level')+1;
            if($level_cate_max){
                for($i=1;$i<=$level_cate_max;$i++){
                    TableManipulation::AddFieldToTable('product','ids_level_'.$i,'string');
                    $data['ids_level_'.$i] = (isset($request->ids_level[$i])) ? implode(',', $request->ids_level[$i]) : '';
                }
            }

            // ### cập nhật group color - size
            if(isset($this->config[$type]['size']) && $this->config[$type]['size'] == true)
    		{
    			if(isset($request->size_group) && ($request->size_group != '')) $data['id_size'] = implode(",", $request->size_group);
    			else $data['id_size'] = "";
    		}

    		if(isset($this->config[$type]['mau']) && $this->config[$type]['mau'] == true)
    		{
    			if(isset($request->mau_group) && ($request->mau_group != '')) $data['id_mau'] = implode(",", $request->mau_group);
    			else $data['id_mau'] = "";
    		}

            if(isset($this->config[$type]['tags']) && $this->config[$type]['tags'] == true)
    		{
    			if(isset($request->tags_group) && ($request->tags_group != '')) $data['id_tags'] = implode(",", $request->tags_group);
    			else $data['id_tags'] = "";
    		}


            //### Lưu hình ảnh vào thư mục public/upload/product
            $getimage='';
            if($request->hasFile('file')){
                $row = $this->productRepo->GetOneItem($id, $this->relations);
                $oldimage = $row['photo'];
                $folder = Helper::GetFolder($this->folder);
                $newimage = $request->file('file');
                if($newimage){ $data['photo'] = Helper::UploadImageToFolder($newimage, $oldimage, $folder); }
            }

            if($request->hasFile('photo2')){
                $row = $this->productRepo->GetOneItem($id, $this->relations);
                $oldimage = $row['photo2'];
                $folder = Helper::GetFolder($this->folder);
                $newimage = $request->file('photo2');
                if($newimage){ $data['photo2'] = Helper::UploadImageToFolder($newimage, $oldimage, $folder); }
            }

            if($request->hasFile('banner')){
                $row = $this->productRepo->GetOneItem($id, $this->relations);
                $oldimage = $row['banner'];
                $folder = Helper::GetFolder($this->folder);
                $newimage = $request->file('banner');
                if($newimage){ $data['banner'] = Helper::UploadImageToFolder($newimage, $oldimage, $folder); }
            }


            ///### set options
            $lang_array = config('config_all.lang');
            // foreach($lang_array as $k=>$v){
            //     $data['options'.$k] = json_encode($data['options'.$k]);
            // }
            
            //### Code xử lý : lưu thông tin sản phẩm chính
            $row = $this->productRepo->SaveItem($data,$id);


            //### Code xử lý: lưu thông tin sản phẩm con. Nếu id_size và id_mau == '' ====> tạo 1 phiên bản mãu (thuộc phiên bản con) với thông tin của phiên bản cha , ngược lại nếu có cập nhật màu hoặc size thì ẩn phiên bản mẫu đi
            //if($data['id_size']=='' && $data['id_mau']==''){
                $row_opt = $this->productOptRepo->GetItem(['phienbanmau'=>1, 'id_product'=>$row->id]);

                $idOpt = ($row_opt) ? $row_opt['id'] : null;
                $dataOpt['tenvi'] = $row['tenvi'];
                $dataOpt['dai'] = $row['dai'];
                $dataOpt['rong'] = $row['rong'];
                $dataOpt['cao'] = $row['cao'];
                $dataOpt['khoiluong'] = $row['khoiluong'];
                $dataOpt['soluong_website'] = $row['soluong_website'];
                $dataOpt['photo'] = $row['photo'];
                $dataOpt['giacu'] = $row['giacu'];
                $dataOpt['gia'] = $row['gia'];
                $dataOpt['giamoi'] = $row['giamoi'];
                $dataOpt['giakm'] = $row['giakm'];
                $dataOpt['hienthi'] = $row['hienthi'];
                $dataOpt['type'] = $type;
                $dataOpt['phienbanmau'] = 1; // Phiên bản mẫu
                $dataOpt['id_product'] = $row['id'];
                $dataOpt['masp'] = $row['masp'];
                $dataOpt['gallery'] = $row['gallery'];
                $this->productOptRepo->SaveItem($dataOpt,$idOpt);
            //}

              
            //### Code xử lý: watermark
            if($width!=null){
                Thumb::Crop($this->folder_upload,$row->photo,$width,$height,1,$type);
            }


            //### Code xử lý: hash photo
            if(!$id && $id==null){
                if($hash!='' && isset($row->id)){$this->galleryRepo->UpdateHashGallery($row->id,$hash);}
                if($hash_color){ //### $hash_color = $request->hash_color;
                    foreach($hash_color as $k=>$v){
                        if($v!='' && isset($row->id)){$this->galleryRepo->UpdateHashGallery($row->id,$v);}
                    }
                }
            }


            // ### cập nhật product_option
            if(isset($dataOption)){              
                foreach($dataOption as $k=>$v){
                    $param = $v;
                    $idOption = $param['id'];
                    $param['id_product']=$row['id'];
                    $param['dai'] = (isset($param['dai']) && $param['dai'] != '') ? str_replace(",","",$param['dai']) : 0;
            		$param['rong'] = (isset($param['rong']) && $param['rong'] != '') ? str_replace(",","",$param['rong']) : 0;
            		$param['cao'] = (isset($param['cao']) && $param['cao'] != '') ? str_replace(",","",$param['cao']) : 0;
            		// $param['khoiluong'] = (isset($param['khoiluong']) && $param['khoiluong'] != '') ? str_replace(",","",$param['khoiluong']) : 0;
                    $param['soluong_website'] = (isset($param['soluong_website']) && $param['soluong_website'] != '') ? str_replace(",","",$param['soluong_website']) : 0;
                    
            		$param['giacu'] = (isset($param['giacu']) && $param['giacu'] != '' && $param['giacu']!=0) ? str_replace(",","",$param['giacu']) : 0;//$row->giacu;
            		$param['gia'] = (isset($param['gia']) && $param['gia'] != '' && $param['gia']!=0) ? str_replace(",","",$param['gia']) : 0;//$row->gia;
            		$param['giamoi'] = (isset($param['giamoi']) && $param['giamoi'] != '' && $param['giamoi']!=0) ? str_replace(",","",$param['giamoi']) : 0;//$row->giamoi;
            		$param['giakm'] = (isset($param['giakm']) && $param['giakm'] != '' && $param['giakm']!=0) ? $param['giakm'] : 0;//$row->giakm;
                    $param['xoatam'] = $param['xoatam'];
                    $param['hienthi'] = $data['hienthi'];
                    $param['type'] = $type;

                    $getimage='';
                    if($request->hasFile('file-'.$k)){
                        $row_option = $this->productOptRepo->GetOneItem($idOption,$this->relationsOpt);
                        $oldimage = $row_option['photo'];
                        $folder = Helper::GetFolder($this->folder);
                        $newimage = $request->file('file-'.$k);

                        if($newimage){ $param['photo'] = Helper::UploadImageToFolder($newimage, $oldimage, $folder); }
                    }

                    $row_op = $this->productOptRepo->SaveItem($param,$idOption);

                    //### Code xử lý: watermark
                    if($width!=null){
                        Thumb::Crop($this->folder_upload,$row_op->photo,$width,$height,1,$type);
                    }
                }
            }


            //### Code xóa những product option
            if($deleteOptionItems!=''){
                $ids = explode(",", $deleteOptionItems);
                //dd($deleteOptionItems);
                foreach($ids as $i=>$item){
                    $rowOption = $this->productOptRepo->GetOneItem($item,$this->relationsOpt);
                    $image_path = Helper::GetFolder($this->folder).$rowOption['photo'];
                    Helper::DeleteImage($image_path);
                }
                $this->productOptRepo->DeleteMultiItem($deleteOptionItems,$this->folder);
            }


            //### lưu giá trị thuộc tính
            if($row){
                $id_product = $row['id'];
                $dataProperty = $request->dataProperty;

                if($dataProperty){
                    //### xóa các rows đã lưu trước đó
                    $this->productPropertyRepo->Query()->where('id_product',$id_product)->delete();

                    //### lưu các rows mới
                    if($row['level']==0){
                        foreach($dataProperty as $k=>$v){
                            if($v!=null){
                                $this->productPropertyRepo->SaveItem(['id_product'=>$id_product, 'id_property'=>$k, 'id_value'=>$v]);
                            }
                        }
                    }
                }
            }


            //### Hiển thị giao diện
            if($savehere){
                return redirect()->route($this->routeEdit,[$category,$type,$row->id]);
            }else{
                return redirect()->route($this->routeShow,[$category,$type]);
            }
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Xuất excel tất cả đơn hàng
    |--------------------------------------------------------------------------
    */
    public function ExportProduct(Request $request)
    {
        //### khởi tạo giá trị cho model
        $this->initialization($request);

        //### check auth permission
        if(!$this->IsPermission($this->permissionExport)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }

        $category = $request->category;
        $params = array();
        $params['listid'] = ($request->listid) ? $request->listid : '';
        $params['type'] = ($request->type) ? $request->type : '';
        //dd($params);

        return Excel::download(new ProductExport($params,$category), 'danhsach_sanpham_'.time().'.xlsx');
    }


    /*
    |--------------------------------------------------------------------------
    | Nhập excel sản phẩm
    |--------------------------------------------------------------------------
    */
    public function ImportProduct(Request $request)
    {
        //### khởi tạo giá trị cho model
        $this->initialization($request);

        //### check auth permission
        if(!$this->IsPermission($this->permissionImport)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }

        if($request->hasFile('import_file')){
            $import = Excel::import(new ProductImport($request), request()->file('import_file'));
            $request->session()->flash('alertSuccess', 'Nhập dữ liệu thành công !');
            return $this->page_error;
        }else{
            $request->session()->flash('alert', 'Hệ thống báo lỗi: bạn chưa chọn file !');
            return $this->page_error;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Giao diện nhập excel sản phẩm
    |--------------------------------------------------------------------------
    */
    public function ImportView(Request $request){
        //### khởi tạo giá trị cho model
        $this->initialization($request);

        //### check auth permission
        if(!$this->IsPermission($this->permissionImport)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }

        $other_title = "Import sản phẩm";
        $response = array(
            'other_title'=>$other_title ,
            'category'=>$this->category,
            'type'=>$this->type
        );
        return view($this->viewImport)->with($response);
    }


    /*
    |--------------------------------------------------------------------------
    | Giao diện nhập excel sản phẩm
    |--------------------------------------------------------------------------
    */
    public function ImportImages(Request $request){
        //### khởi tạo giá trị cho model
        $this->initialization($request);
        
        //### check auth permission
        if(!$this->IsPermission($this->permissionImport)){
            $request->session()->flash('alert', $this->alert);
            return $this->page_error;
        }

        $other_title = "Upload hình ảnh";
        $response = array(
            'other_title'=>$other_title ,
            'category'=>$this->category,
            'type'=>$this->type
        );
        return view($this->viewImportImages)->with($response);
    }
}
