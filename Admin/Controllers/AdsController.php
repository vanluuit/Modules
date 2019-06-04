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
use App\Models\City;
use App\Models\Ads;
use Carbon\Carbon;

class AdsController extends Controller
{
    public function getIndex(Request $request) {
        $user_id = session('users')['id'];
        $ads = Ads::with(['users','province','city']);
        if(!empty($request->keyword)) {
            $ads = $ads->where('title','LIKE', '%'.$request->keyword.'%');
        }
        if(!empty($request->id)) {
            $ads = $ads->where('id',$request->id);
        }
        if(!empty($request->title)) {
            $ads = $ads->where('title',$request->title);
        }

        if(!empty($request->user_id)) {
            $ads = $ads->where('user_id',$request->user_id);
        }
        if(!empty($request->user_name)) {
            $ads = $ads->whereHas('users',function($qr)use($request){
                $qr->where('name','LIKE', '%'.$request->user_name.'%');
            });
        }
        if($request->date_yearA) {
            $date = $request->date_yearA .'-'. $request->date_monthA .'-'. $request->date_dayA;
            $ads = $ads->whereDate('created_at','>=',$date);
        }
        if($request->date_yearB) {
            $date = $request->date_yearB.'-'.$request->date_monthB.'-'.$request->date_dayB;
            $ads = $ads->whereDate('created_at','<=',$date);
        }
        if(!empty($request->permission)) {
            $ads = $ads->whereIn('permission',$request->permission);
        }
        if(!empty($request->publish)) {
            $ads = $ads->whereIn('publish',$request->publish);
        }
        $ads = $ads->orderby('id','DESC')->paginate(10);
        // dd($ads);
        return view('Admin::ads.index',['ads'=>$ads]);
    }
    public function getAdd(Request $request) {
    	$provinces = Province::where('order_by','<',2)->get()->pluck('province_name','id');
        return view('Admin::ads.add', ['provinces'=> $provinces]);
    }
    public function confAdd(Request $request) {
        $provinces = Province::where('order_by','<',2)->get()->pluck('province_name','id');
        $cities = City::where('province_id', $request->data['province_id'])->where('city_name', '<>', 'すべて')->pluck('city_name', 'id');
        $ads = (object) $request->data;
        return view('Admin::ads.confadd',compact('ads','provinces','cities'));
    }
    public function postAdd(Request $request) {
        $user_id = session('users')['id'];
        $ads = new Ads;
        $ads->user_id = $user_id;
        foreach ($request->data as $key => $value) {
            $ads->$key = $value;
        }
        $provinces = Province::where('id',$request->data['province_id'])->first();
        $cities = City::where('id', $request->data['city_id'])->first();
        // $ads->addressfull = $provinces->province_name.$cities->city_name.$request->data['address'].$request->data['building'];
        $ads->date = str_replace(['年', '月', '日'], ['-', '-', ''], $ads->date);
        $ads->addressfull = $provinces->province_name.$cities->city_name;
        // dd($ads);
        $ads->save();
        return redirect(route('admin.addfinish'));
        
    }
    public function addfinish(Request $request) {
        return view('Admin::ads.addfinish');
    }
    
    public function getEdit(Request $request) {
        $user_id = session('users')['id'];
        $provinces = Province::where('order_by','<',2)->get()->pluck('province_name','id');
        $ads = Ads::with(['users','province','city'])->where('id',$request->id)->first();
        $cities = City::where('province_id', $ads->province_id)->where('city_name', '<>', 'すべて')->pluck('city_name', 'id');
        $ads->date = date('Y年m月d日', strtotime($ads->date));
        return view('Admin::ads.edit', ['provinces'=> $provinces,'cities'=> $cities, 'ads'=>$ads]);
    }

    public function confEdit(Request $request) {
        $provinces = Province::where('order_by','<',2)->get()->pluck('province_name','id');
        $cities = City::where('province_id', $request->data['province_id'])->where('city_name', '<>', 'すべて')->pluck('city_name', 'id');
        $ads = (object) $request->data;
        return view('Admin::ads.confedit',compact('ads','provinces','cities'));
    }

    public function postEdit(Request $request) {
        $user_id = session('users')['id'];
        $ads = Ads::where('user_id',$user_id)->where('id',$request->id)->first();
        $provinces = Province::where('id',$request->data['province_id'])->first();
        $cities = City::where('id', $request->data['city_id'])->first();
        // dd($request->data);
        $dt = $request->data;
        $dt['addressfull'] = $provinces->province_name.$cities->city_name;
        $dt['date'] = str_replace(['年', '月', '日'], ['-', '-', ''], $dt['date']);
        // dd($dt);
        $ads->update($dt);
        return redirect(route('admin.editfinish'));
    }

    public function editfinish(Request $request) {
        return view('Admin::ads.editfinish');
    }

    public function getview(Request $request) {
        $user_id = session('users')['id'];
        $ads = Ads::with(['users','province','city'])->where('id',$request->id)->first();
        // dd($ads);
        return view('Admin::ads.view', ['ads'=>$ads]);
    }  

    public function adsDelete(Request $request) {
        Ads::destroy($request->id);
        return redirect(route('admin.ads'));
    }  
    
}
