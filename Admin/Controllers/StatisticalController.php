<?php
namespace Ext\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Models\Fudousan;
use App\Models\Ads;
use App\Models\Statistical;

use DB;

class StatisticalController extends Controller
{
	public function MonthOwnerCount(Request $request) {

        if(!$request->y || !$request->m){
            return back();
        }
        $user_id = session('users')['id'];
        $data = Statistical::with('ads')->select('*', DB::raw('count(*) as total_click'))->where('yearclick',$request->y)->where('mounthclick',$request->m)->groupBy('ads_id', 'dateclick')->get();
        $t = date('t', strtotime($request->y.'-'.$request->m.'-01'));
        $mounth_ar = array_mounth($t);
        $dt = [];
        $arvl = [];
        $arcl = [];
        $total_price = 0;
        $total_click = 0;
        foreach ($mounth_ar as $key => $value) {
            $arvl[$mounth_ar[$key]] = 0;
            $arcl[$mounth_ar[$key]] = 0;
        }
        foreach ($data as $key => $value) {
            $arvl[$value->dayclick] += $value->total_click * $value->ads->click_price;
            $arcl[$value->dayclick] += $value->total_click;
            $total_price += $value->total_click * $value->ads->click_price;
            $total_click += $value->total_click;
        }
        $arcl = json_encode($arcl);
        $xAxis = implode(",",$mounth_ar);
        $yAxis = implode(",",$arvl);

        $ads_mounths = Ads::with(['Statistical'=>function($qr)use($request){
            return $qr->where('yearclick', $request->y)->where('mounthclick', $request->m);
        }])->has('statistical')->get();

        return view('Admin::statistical.monthownercount', compact('xAxis', 'yAxis','arcl','total_price','total_click','ads_mounths'));
	}

    public function MonthOwnerdata($y, $m) {
        $user_id = session('users')['id'];
        $data = Statistical::with('ads')->select('*', DB::raw('count(*) as total_click'))->where('yearclick',$y)->where('mounthclick',$m)->groupBy('ads_id', 'dateclick')->get();
        $t = date('t', strtotime($y.'-'.$m.'-01'));
        $mounth_ar = array_mounth($t);
        $arvl = [];
        $data_ar = [];
        $total_price = 0;
        $total_click = 0;
        foreach ($mounth_ar as $key => $value) {
            $arvl[$mounth_ar[$key]] = 0;
            $arcl[$mounth_ar[$key]] = 0;
        }
        foreach ($data as $key => $value) {
            $arvl[$value->dayclick] += $value->total_click * $value->ads->click_price;
            $total_price += $value->total_click * $value->ads->click_price;
            $total_click += $value->total_click;
        }
        $data_ar['xAxis'] = implode(",",$mounth_ar);
        $data_ar['yAxis'] = implode(",",$arvl);
        $data_ar['total_price'] = $total_price;
        $data_ar['total_click'] = $total_click;
        $data_ar['y'] = $y;
        $data_ar['m'] = $m;
        return $data_ar;
    }

    public function YearOwnerCount(Request $request) {

        (!$request->y) ? $y = date('Y') : $y = $request->y;
        (!$request->m) ? $m = date('m') : $m = $request->m;
        (!$request->num) ? $num = 12 : $num = $request->num;
        $last_y = $y.'-'.$m;
        $datas=[];
        for ($i=1; $i < $num ; $i++) { 
            $yx = date('Y', strtotime($last_y));
            $mx = date('m', strtotime($last_y));
            $datas[] = $this->MonthOwnerdata($yx, $mx);
            $last_y = date("Y-m", strtotime('last Months', strtotime($last_y)));
        }
        return view('Admin::statistical.yearownercount', compact('datas','num','y','m'));
    }

    public function AdsStatistical(Request $request) {

        if(!$request->y || !$request->m || !$request->ads){
            return back();
        }
        $user_id = session('users')['id'];

        $data = Statistical::where('yearclick',$request->y)->where('mounthclick',$request->m)->where('ads_id',$request->ads)->paginate(50);
        $ads = Ads::where('id',$request->ads)->first();

        return view('Admin::statistical.adsstatistical', compact('data','ads'));
    }
}
