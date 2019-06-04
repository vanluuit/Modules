<?php
namespace Ext\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Mail;
use Session;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\Fudousan;
use App\Models\Province;
use App\Models\Statistical;
use App\Models\City;
use App\Models\Ads;
use Carbon\Carbon;

class ManageController extends Controller
{
    public function getIndex() {
        $user_id = session('users')['id'];
        $total = Ads::where('user_id', $user_id)->count();
        $unconfirmed = Ads::where('user_id', $user_id)->Where('permission', 0)->count();
        $public = Ads::where('user_id', $user_id)->where('publish', 1)->where('permission', 1)->count();
        $nolicense = Ads::where('user_id', $user_id)->where('permission', 2)->count();

        $last_y = date("Y", strtotime('last Months'));
        $last_m = date("m", strtotime('last Months'));
        $curent_y = date("Y");
        $curent_m = date("m");
        $pay_first_mounth = Ads::with(['statistical'=>function($qr)use($last_y, $last_m){
            return $qr->where('yearclick', $last_y)->where('mounthclick', $last_m);
        }])->where('user_id',$user_id)->get();
        $first_total=0;
        foreach ($pay_first_mounth as $key => $value) {
            $first_total += count($value->statistical)*$value->click_price;
        }
        $pay_curent_mounth = Ads::with(['statistical'=>function($qr)use($curent_y, $curent_m){
            return $qr->where('yearclick', $curent_y)->where('mounthclick', $curent_m);
        }])->where('user_id',$user_id)->get();
        $curent_total=0;
        foreach ($pay_curent_mounth as $key => $value) {
            $curent_total += count($value->statistical)*$value->click_price;
        }
        
        return view('Business::index',compact('total', 'public','unconfirmed','nolicense','first_total','curent_total'));
    }
    public function crawling_wish() {
        return view('Business::crawlingwish');
    }   
}

