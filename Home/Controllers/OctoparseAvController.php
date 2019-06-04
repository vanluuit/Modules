<?php

namespace Ext\Home\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Fudousan;
use DB;

class OctoparseAvController extends Controller
{
    private function convertDate($string) {
    	if(strpos($string,'日')) {
        	$date_a = explode('日', $string)[0];
        }else{
        	$date_a = explode('月', $string)[0];
        }
        $date_s= str_replace('年', '-', $date_a);
        if(strpos($string,'日')) {
        	$date_s= str_replace('月', '-', $date_s);
        }else{
        	$date_s= str_replace('月', '', $date_s);
        }
        $date_s= str_replace('日', '', $date_s);
        return date("Y-m-d", strtotime($date_s));
    } 
    private function convertPrice($string) {
    	$result = array();
    	if(strpos($string, '万円')) {
    		$result['cur'] = '万円';
    	}else{
    		$result['cur'] = '円';
    	}
    	$result['price'] = (float)$string;
    	return $result;
    } 
    private function convertarea($string) {
    	$result = (float)$string;
    	return $result;
    } 
    private function curlOctoparsePost($url, $param) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$param);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return json_decode($server_output, true);
    } 
    private function curlOctoparseGet($url, $token) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token));
        $output = curl_exec($ch); 
        curl_close($ch);    
        return json_decode($output, true);
    }
	private function getToken() {
        $url = "https://advancedapi.octoparse.com/token";
        $param = "username=fukuba298&password=5rnk75HUX5CEDsW&grant_type=password";
        $tokenArray = $this->curlOctoparsePost($url, $param);
        return $tokenArray;
	}
    private function refreshToken($refresh_token) {
        $url = "https://advancedapi.octoparse.com/token";
        $param = "refresh_token=".$refresh_token."&grant_type=refresh_token";
        $token = $this->curlOctoparsePost($url, $param);
        return $token;
    }
    public function getGruoup($token) {
        $url = "https://advancedapi.octoparse.com/api/TaskGroup";
        $groupArray = $this->curlOctoparseGet($url, $token);
        return $groupArray;
    }

    public function getTask($token) {
        $taskMutil = [];
        $groupArray = $this->getGruoup($token);
        foreach ($groupArray['data'] as $key => $group) {
            $url = "https://advancedapi.octoparse.com/api/Task?taskGroupId=".$group['taskGroupId'];
            $taskArray = $this->curlOctoparseGet($url, $token);
            foreach ($taskArray['data'] as $keyt => $task) {
                $taskMutil[] = $task;
            }
        }
        return $taskMutil;
    }
    private function GetTaskRulePropertyByName($token, $taskid, $name){
        $url = "https://advancedapi.octoparse.com/api/task/GetTaskRulePropertyByName?taskId=".$taskid."&name=".$name;
        $param['taskId'] = $taskid;
        $param['name'] = $name;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$param);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return $server_output;
    }

    private function StartTask($token, $taskid){
        $url = "https://advancedapi.octoparse.com/api/task/StartTask?taskId=".$taskid;
        $param['taskId'] = $taskid;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$param);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return $server_output;
    }


    private function UpdateTaskRule($token, $taskid, $name, $value){
        $url = "https://advancedapi.octoparse.com/api/task/UpdateTaskRule";
        $param['taskId'] = $taskid;
        $param['name'] = $name;
        $param['value'] = $value;
        $data_string = json_encode($param);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                          
            'Content-Type: application/json',  
            'Authorization: Bearer '.$token ,                                             
            'Content-Length: ' . strlen($data_string))                                                        
        ); 
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return $server_output;
    }
    public function exportData($token, $taskid) {
        $url = "https://advancedapi.octoparse.com/api/notexportdata/gettop?taskId=".$taskid."&size=1000";
        $data = $this->curlOctoparseGet($url, $token);
        return $data;
    }
    public function getData($token, $taskid, $offset) {
        $url = "https://advancedapi.octoparse.com/api/alldata/GetDataOfTaskByOffset?taskId=".$taskid."&offset=".$offset."&size=1000";
        $data = $this->curlOctoparseGet($url, $token);
        return $data;
    }
    public function getDataCount($token, $taskid) {
        $url = "https://advancedapi.octoparse.com/api/alldata/GetDataOfTaskByOffset?taskId=".$taskid."&offset=0&size=1000";
        $data = $this->curlOctoparseGet($url, $token);
        $rs = array();
        $rs['count'] = ceil($data['data']['total']/1000);
        $rs['offset'] = $data['data']['offset'];
        return $rs;
    }
    public function gettop($token, $taskid) {
        $url = "https://advancedapi.octoparse.com/api/notexportdata/gettop?taskId=".$taskid."&size=1000";
        $data = $this->curlOctoparseGet($url, $token);
        return $data;
    }
    private function updateTask($token, $taskid){
        $url = "https://advancedapi.octoparse.com/api/notexportdata/update?taskId=".$taskid;
        $param['taskId'] = $taskid;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$param);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return $server_output;
    }
    private function removeTask($token, $taskid){
        $url = "https://advancedapi.octoparse.com/api/task/RemoveDataByTaskId?taskId=".$taskid;
        $param['taskId'] = $taskid;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$param);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return $server_output;
    }
    private function checkAndInsert($data){
        $fudousan = new Fudousan;
        $check = $fudousan->where('url','=', $data['url'])->count();
        if(!$check) {
            Fudousan::create($data);
            return true;
        }
        return false;
    }
    private function getAddress($str){
        $a = explode('分', $str);
        $ar['address'] = $a[count($a)-1];

        $ar['traffic'] = '';
        for ($i=0; $i < count($a)-1 ; $i++) { 
            $ar['traffic'] .= $a[$i].'分';
        }
        // $ar['traffic'] .= '分';
        return $ar;
    }
    public function main(){
    	set_time_limit(0);
        $tokenArray = $this->getToken();
        $token = $this->refreshToken($tokenArray['refresh_token']);
        $taskMutil = $this->getTask($token['access_token']);    
        // $remove = $this->removeTask($token['access_token'], 'dff45b79-4a2e-4ab0-9c69-459838ca66ba');
        // dd($remove);
        // $datas = $this->getData($token['access_token'], 'e0642c86-a75c-443f-b98f-906922db1ab7', -1);
        // dd($datas);
        foreach ($taskMutil as $key => $task) {
            $info = explode('_', $task['taskName']);
            // Fudousan::where('from_site',$info[0])->where('tag',$info[2])->delete();
        	// $datas = $this->gettop($token['access_token'], $task['taskId']);
            $offset = -1;
            $check = 1;
            while ($check>0) {
                $tokenArray = $this->getToken();
                $token = $this->refreshToken($tokenArray['refresh_token']);
                $datas = $this->getData($token['access_token'], $task['taskId'], $offset);
                // dd($datas);
                $offset = $datas['data']['offset'];
                if(@$datas['data'] && @$datas['data']['dataList']) {
                    foreach ($datas['data']['dataList'] as $keyL => $dataL) {
                        $dataL['from_site'] = $info[0];
                        $dataL['cate'] = $info[1];
                        $dataL['tag'] = $info[2];
                        $dataL['price'] = $this->convertPrice($dataL['price_string'])['price'];
                        $dataL['currency'] = $this->convertPrice($dataL['price_string'])['cur'];
                        $dataL['housearea'] = $this->convertarea($dataL['housearea_string']);
                        $dataL['banconyarea'] = $this->convertarea($dataL['banconyarea_string']);
                        $dataL['date'] = $this->convertDate($dataL['date_string']);
                        $add = $dataL['address'];
                        if($add) {
                            if($dataL['address'] == $dataL['traffic']) {
                                $dataL['address'] = $this->getAddress($add)['address'];
                                $dataL['traffic'] = $this->getAddress($add)['traffic'];
                            }
                        }
                        $dataL['nabi'] = rand(1,10);
                        $dataL['chang_time'] = date('Y-m-d H:i:s');
                        $dl=['url'=>$dataL['url']];
                        unset($dataL['url']);
                        // Fudousan::insert($dataL);
                        $rs = Fudousan::updateOrCreate($dl,$dataL);
                        // dd($rs);
                    }   
                }
                if(@$datas['data']['restTotal'] == 0) {
                    $check = 0;
                }
            }
            
            $remove = $this->removeTask($token['access_token'], $task['taskId']);
            $update = $this->updateTask($token['access_token'], $task['taskId']);
        }
    }
    public function oct_site(Request $request){
        set_time_limit(0);
        $id = @$request->taskid;
        

        $task = DB::table('tasks')->where('id',$id)->first();
        $tokenArray = $this->getToken();    
        $token = $this->refreshToken($tokenArray['refresh_token']);  
        // if($id==3 || $id==4){
        //     $remove = $this->removeTask($token['access_token'], $task->taskid);
        //     $update = $this->updateTask($token['access_token'], $task->taskid);
        //     die();
        // } 
        if( $task ) {
            $info = explode('_', $task->taskname);
            $offset = -1;
            $check = 1;
            while ($check>0) {
                $datas = $this->getData($token['access_token'], $task->taskid, $offset);
                $offset = $datas['data']['offset'];

                if(@$datas['data'] && @$datas['data']['dataList']) {
                    foreach ($datas['data']['dataList'] as $keyL => $dataL) {

                        $dataL['from_site'] = $info[0];
                        $dataL['cate'] = $info[1];
                        $dataL['tag'] = $info[2];
                        if($id==3){
                            $cc = @explode('/', @$dataL['housearea_string']);
                            $dataL['housearea_string'] = @$cc[1];
                            $dataL['floor_map'] = @$cc[0];
                        }
                        if($id==4){
                            $cc = @explode('円', @$dataL['floor_map']);
                            $dataL['floor_map'] = @$cc[1];
                        }
                        $dataL['price'] = $this->convertPrice($dataL['price_string'])['price'];
                        $dataL['currency'] = $this->convertPrice($dataL['price_string'])['cur'];
                        $dataL['housearea'] = $this->convertarea($dataL['housearea_string']);
                        $dataL['banconyarea'] = $this->convertarea($dataL['banconyarea_string']);
                        $dataL['date'] = $this->convertDate($dataL['date_string']);
                        $add = $dataL['address'];

                        if($add) {
                            if($dataL['address'] == $dataL['traffic']) {
                                $dataL['address'] = $this->getAddress($add)['address'];
                                $dataL['traffic'] = $this->getAddress($add)['traffic'];
                            }
                        }
                        $dataL['nabi'] = rand(1,10);
                        $dataL['chang_time'] = date('Y-m-d H:i:s');
                        $dataL['order_time'] = date('Y-m-d');
                        $dl=['url'=>$dataL['url']];
                        unset($dataL['url']);
                        // Fudousan::insert($dataL);
                        $rs = Fudousan::updateOrCreate($dl,$dataL);
                        
                    }   
                }
                if(@$datas['data']['restTotal'] == 0) {
                    $check = 0;
                }
            }
            $remove = $this->removeTask($token['access_token'], $task->taskid);
            $update = $this->updateTask($token['access_token'], $task->taskid);
        } 
    }
    public function sql_delete_die(Request $request){
        set_time_limit(0);
        Fudousan::whereDate('updated_at','<',date('Y-m-d'))->delete();
    }

    // public function getParam(){

    //     $taskid = 'dff85665-0a36-4215-8f1b-6cd88cb5ebdf';
    //     $tokenArray = $this->getToken();    
    //     $token = $this->refreshToken($tokenArray['refresh_token']); 
    //     $url_ar = [];
    //     for ($i=1; $i <= 34000; $i++) { 
    //         $url_ar[] = 'https://www.homes.co.jp/mansion/b-16000070000324/';
    //     }
    //     // dd($url_ar);
        
    //     $data = $this->UpdateTaskRule($token['access_token'], $taskid, 'loopAction1.UrlList', $url_ar);
    //     dd($data);
    //     return $token;
    // }
    public function getPage($url, $referer, $agent, $header, $timeout) {
        // $proxyinfo=explode(':',$proxy);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_PROXY, $proxyinfo[0]);
        // curl_setopt($ch, CURLOPT_PROXYPORT, $proxyinfo[1]);
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
     
        $result['EXE'] = curl_exec($ch);
        $result['INF'] = curl_getinfo($ch);
        $result['ERR'] = curl_error($ch);
     
        curl_close($ch);
        return $result;
    }
    public function getParam(){
        $url = 'https://suumo.jp/ms/chuko/miyagi/sc_sendaishiaoba/nc_91851995/?suit=STkr20180612200';
        $result = $this->getPage(
            '91.106.94.49:80', // Dùng 1 proxy hợp lệ
            $url,
            'https://suumo.jp', 
            'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8',
            '',
            5
        );
         
        if (empty($result['ERR'])) {
            // Nếu quá trình CURL ko có lỗi nào
            // Xuất kết quả get đc
            echo $result['EXE'];
        } else {
             // Xảy ra lỗi ?
            // Xuất lỗi
            echo 'Error: '.$result['ERR'];
        }
    }
}


    