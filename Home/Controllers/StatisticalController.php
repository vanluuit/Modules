<?php
namespace Ext\Home\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Models\Fudousan;
use App\Models\Ads;
use App\Models\Statistical;

use DB;

class StatisticalController extends Controller
{

	public function index(Request $request) {
        if(!$request->id){
            return back();
        }
        $fud = Fudousan::find($request->id);
        if(!$fud) {
            return back();
        }
        return redirect($fud->url);
	}
    public function statisticalads(Request $request) {
        if(!$request->id){
            return back();
        }
        $ads = Ads::find($request->id);
        if(!$ads) {
            return back();
        }else{
            $t = strtotime(date('Y-m-d H:i:s'))-10;
            $ts = date('Y-m-d H:i:s',$t);
            $checkip = Statistical::where('ipaddress', get_client_ip())->whereDate('datetimeclick','>',$ts)->where('ads_id', $request->id)->count();
            if(!$checkip) {
                $statistical = new Statistical;
                $statistical->ads_id = $request->id;
                $statistical->ipaddress = get_client_ip();
                $statistical->yearclick = date('Y');
                $statistical->mounthclick = date('m');
                $statistical->dayclick = date('d');
                $statistical->dateclick = date('Y-m-d');
                $statistical->datetimeclick = date('Y-m-d H:i:s');
                $statistical->save();
            }
            if(checkexit($ads->url)){
                return redirect($ads->url);
            }else{
                return back();
            } 
        }
    }
    
    
}
