<?php

use Illuminate\Support\Facades\Http as GHTTP;
interface HTTPRequest{
	public function request(string $url, string  $method, array $options=[]);
}


class XMLHttpService extends XMLHTTPRequestService implements HTTPRequest{
    public function request(string $url, string  $method, array $options=[]){/* ... */}
}

Class CURLService implements HTTPRequest{
	public function request(string $url, string  $method, array $options=[]){
		$ch = curl_init($url);
			///// .........;
		return  curl_exec($ch);
	}
}	
Class GuzzleService implements HTTPRequest{


	public function request(string $url, string  $method, array $options=[]){
		if($method=='GET'){$response = GHTTP::get('http://example.com');}
		//.....
	}
}





class Http {
    private $service;

    public function __construct(HTTPRequest $HttpService) { 
		$this->service = new $HttpService;
     }

	//или динамическая фиича 
 	//public function __construct(String $HttpService=CONFIG_HTTP_SERVICE) { 
	//	if (!class_exists($HttpService)){$HttpService=CONFIG_HTTP_SERVICE;}//заглушка на случай если неверный драйвер
	//	$this->$service= new $HttpService;
	//}


    public function get(string $url, array $options) {
        $this->service->request($url, 'GET', $options);
    }

    public function post(string $url) {
        $this->service->request($url, 'GET');
    }
}
