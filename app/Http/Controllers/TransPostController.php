<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Traits\SupportTrait;

use App\Models\Places;

use App\Transpost\DeliveryAPI;

use Helper, CartHelper;

class TransPostController extends Controller
{
    use SupportTrait;

    private $transpost;

    /*
    |--------------------------------------------------------------------------
    | Lấy ds tỉnh thành theo loại phương thức vận chuyển
    |--------------------------------------------------------------------------
    */
    public function GetCity(Request $request){      
        // $city = $response = array();
        // $transpost_type = $request->type;
        // $this->transpost = new DeliveryAPI();

        // switch ($transpost_type) {
        //     case 'ViettelPost':
        //         $result = $this->transpost->getListProvinceViettelPost();
        //         if($result['status']==200){
        //             $city = $result['data'];
        //         }

        //         $response = array(
        //             'city' => $city,
        //             'transpost_type' => $transpost_type
        //         );
        //         break;
            
        //     default:
        //         // code...
        //         break;
        // }


        //### thường
        $city = new Places('list');
        $city = $city->GetAllItems(['type'=>'']);

        $response = array(
            'city' => $city,
            //'transpost_type' => $transpost_type
        );

        return view('desktop.templates.transpost.city')->with($response);
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy ds quận huyện theo loại phương thức vận chuyển
    |--------------------------------------------------------------------------
    */
    public function GetDistrict(Request $request){
        // $district = $response = array();
        // $id = $request->id;
        // $transpost_type = $request->type;
        // $this->transpost = new DeliveryAPI();

        // switch ($transpost_type) {
        //     case 'ViettelPost':
        //         $result = $this->transpost->getListDistrictViettelPost($id);
        //         if($result['status']==200){
        //             $district = $result['data'];
        //         }

        //         $response = array(
        //             'district' => $district,
        //             'transpost_type' => $transpost_type
        //         );
        //         break;
            
        //     default:
        //         // code...
        //         break;
        // }

        $id_city = (isset($request->id) && $request->id > 0) ? $request->id : 0;
        $model = new Places('cat');
        $district = $model->select('ten', 'id')->where('id_delivery',0)->where('id_city',$id_city)->get()->toArray();

        $response = array(
            'district' => $district,
            //'transpost_type' => $transpost_type
        );

        return view('desktop.templates.transpost.district')->with($response);
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy ds phường xã theo loại phương thức vận chuyển
    |--------------------------------------------------------------------------
    */
    public function GetWard(Request $request){
        // $ward = $response = array();
        // $id = $request->id;
        // $transpost_type = $request->type;
        // $this->transpost = new DeliveryAPI();

        // switch ($transpost_type) {
        //     case 'ViettelPost':
        //         $result = $this->transpost->getListWardViettelPost($id);
        //         if($result['status']==200){
        //             $ward = $result['data'];
        //         }

        //         $response = array(
        //             'ward' => $ward,
        //             'transpost_type' => $transpost_type
        //         );
        //     break;
        // }


        $id_district = (isset($request->id) && $request->id > 0) ? $request->id : 0;
        $model = new Places('item');
        $wards = $model->select('ten', 'id')->where('id_delivery',0)->where('id_district',$id_district)->get()->toArray();
        $response = array(
            'ward' => $wards,
            //'transpost_type' => $transpost_type
        );


        return view('desktop.templates.transpost.ward')->with($response);
    }


    /*
    |--------------------------------------------------------------------------
    | Lấy phí ship
    |--------------------------------------------------------------------------
    */
    public function ServiceShip(Request $request){
        // //### khai báo
        // $config_delivery = config('delivery.transpost_method');
        // $city = $district = $ward = $response = $data = array();
        // $weight = $tonggia = 0;

        // $transpost_type = $request->type;
        // $city = $request->city;
        // $district = $request->district;
        // $ward = $request->ward;
        // $this->transpost = new DeliveryAPI();

        // //### lấy thông tin kho hàng
        // $inventory = $this->transpost->getListInventoryViettelPost();
        // $inventory = $inventory['data'][0];

        // //### xử lý
        // $tonggia = CartHelper::get_order_total();
        // $infoShip = CartHelper::GetInfoShip();
        // $weight = $infoShip['khoiluong'];

        // switch ($transpost_type) {
        //     case 'ViettelPost':
        //         $data = array(
        //             "SENDER_PROVINCE" => $inventory['provinceId'], //$config_delivery[$transpost_type]['SENDER_PROVINCE'],
        //             "SENDER_DISTRICT" => $inventory['districtId'], //$config_delivery[$transpost_type]['SENDER_DISTRICT'],
        //             "RECEIVER_PROVINCE" => $city,
        //             "RECEIVER_DISTRICT" => $district,
        //             "PRODUCT_TYPE" => "HH",
        //             "PRODUCT_WEIGHT" => $weight,
        //             "PRODUCT_PRICE" => $tonggia,
        //             "MONEY_COLLECTION" => $tonggia,
        //             "TYPE" => 1
        //         );
        //         $result = $this->transpost->getPriceAllViettelPost($data);
        //     break;
        // }

        // $response = array(
        //     'result' => $result,
        //     'transpost_type' => $transpost_type
        // );

        // return view('desktop.templates.transpost.serviceprice')->with($response);

    }


    /*
    |--------------------------------------------------------------------------
    | Lấy thông tin giá
    |--------------------------------------------------------------------------
    */
    public function InfoPrice(Request $request){
        //### Khởi tạo
        $config_delivery = config('delivery.transpost_method');
        $city = $district = $ward = $response = $data = $json = array();
        $weight = $tonggia = 0;

        $transpost_type = $request->type;
        $city = $request->city;
        $district = $request->district;
        $ward = $request->ward;
        $order_service = $request->order_service;
        $this->transpost = new DeliveryAPI();

        //### lấy thông tin kho hàng
        $inventory = $this->transpost->getListInventoryViettelPost();
        $inventory = $inventory['data'][0];

        //### xử lý
        $tonggia = CartHelper::get_order_total();
        $infoShip = CartHelper::GetInfoShip();
        $weight = $infoShip['khoiluong'];
        
        
        $data = array(
            "SENDER_PROVINCE" => $inventory['provinceId'],
            "SENDER_DISTRICT" => $inventory['districtId'],
            "RECEIVER_PROVINCE" => $city,
            "RECEIVER_DISTRICT" => $district,
            "PRODUCT_TYPE" => "HH",
            "PRODUCT_WEIGHT" => $weight,
            "PRODUCT_PRICE" => $tonggia,
            "MONEY_COLLECTION" => $tonggia,
            "TYPE" => 1
        );

        $result = $this->transpost->getPriceAllViettelPost($data);

        foreach($result as $k=>$v){
            if($v['MA_DV_CHINH']==$order_service){
                $ship = $v['GIA_CUOC'];
            }
        }

        if($result){
            $json['phiship'] = $ship;
            $json['phiship_text'] = Helper::Format_Money($ship);
        }

        return json_encode($json);

    }

}
