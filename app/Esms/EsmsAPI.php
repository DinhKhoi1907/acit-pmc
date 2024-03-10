<?php
namespace App\Esms;

class EsmsAPI{
	private $config;

	function __construct() {
		$this->config = config('esms');
	}


	public function SendSMS($phonenumber, $contentSMS){
		$APIKey = $this->config['apiKey'];
		$SecretKey = $this->config['secretKey'];
		$BrandName = $this->config['brandName'];
		
		$SendContent=urlencode('Mã xác thực của bạn là '.$contentSMS);
		//$data="http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$YourPhone&ApiKey=$APIKey&SecretKey=$SecretKey&Content=$SendContent&Brandname=$BrandName&SmsType=2";
		$data="http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$phonenumber&ApiKey=$APIKey&SecretKey=$SecretKey&Content=$SendContent&SmsType=8";

		$curl = curl_init($data); 
		curl_setopt($curl, CURLOPT_FAILONERROR, true); 
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		$result = curl_exec($curl); 
			
		$obj = json_decode($result,true);

		return $obj;
	}


	/*public function SendSMS($phonenumber, $contentSMS){
		$SendContent='Mã xác thực của bạn là '.$contentSMS;
		$postData['ApiKey'] = $this->config['apiKey'];
		$postData['SecretKey'] = $this->config['secretKey'];
		$postData['Phone'] = $phonenumber;
		$postData['Content'] = $SendContent;
		$postData['IsUnicode'] = 1;
		$postData['SmsType'] = 8;
		//$postData['Brandname'] = 'Baotrixemay';

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_post_json/",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($postData, JSON_UNESCAPED_UNICODE),
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		$obj = json_decode($response,true);

		return $obj;
	}*/


	public function SendOTP($phonenumber){
		//### url request : http://rest.esms.vn/MainService.svc/json/SendMessageAutoGenCode_V5
		$postData['ApiKey'] = $this->config['apiKey'];
		$postData['SecretKey'] = $this->config['secretKey'];
		$postData['Phone'] = $phonenumber;
		$postData['TimeAlive'] = 15;
		$postData['MultiChannelTempId'] = 'abc';
		$postData['TypeId'] = ($this->config['sandbox']==true) ? 1 : 2;

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://rest.esms.vn/MainService.svc/json/SendMessageAutoGenCode_V5/",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($postData, JSON_UNESCAPED_UNICODE),
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		//$err = curl_error($curl);
		//curl_close($curl);

		$obj = json_decode($response,true);

		return $obj;
	}



	public function SendOAZalo($phonenumber,$otp){
		//### url request : http://rest.apiesms.com/MainService.svc/xml/SendZaloMessage_V4_post_json/
		$postData['ApiKey'] = $this->config['apiKey'];
		$postData['SecretKey'] = $this->config['secretKey'];
		$postData['Phone'] = $phonenumber;
		$postData['Params'] = [$otp];		
		$postData['TempID'] = $this->config['tempID'];
		$postData['OAID'] = $this->config['oaID'];
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://rest.apiesms.com/MainService.svc/xml/SendZaloMessage_V4_post_json/",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($postData, JSON_UNESCAPED_UNICODE),
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		//$err = curl_error($curl);
		//curl_close($curl);

		$obj = json_decode($response,true);

		return $obj;
	}
}