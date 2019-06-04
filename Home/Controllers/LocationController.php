<?php
namespace Ext\Home\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Mail;
use Session;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\Fudousan;
use App\Models\City;
use Carbon\Carbon;

class LocationController extends Controller
{
    public function ajaxcity(Request $request) {
    	$ar = [];
        $cities = City::where('province_id', $request->province)->where('city_name', '<>', 'すべて')->get();
        foreach ($cities as $key => $value) {
        	$a['key']=$value->id;
        	$a['value']=$value->city_name;
        	$ar[]=$a;
        }
        echo json_encode($ar);die();
    }
    
}
