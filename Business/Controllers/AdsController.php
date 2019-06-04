<?php
namespace Ext\Business\Controllers;

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
        $ads = Ads::with(['users','province','city'])->where('user_id',$user_id);
        if(!empty($request->keyword)) {
            $ads = $ads->where('title','LIKE', '%'.$request->keyword.'%');
        }
        if(!empty($request->permission)) {
            $ads = $ads->whereIn('permission',$request->permission);
        }
        if(!empty($request->publish)) {
            $ads = $ads->whereIn('publish',$request->publish);
        }
        $ads = $ads->orderby('id','DESC')->paginate(10);
        // dd($ads);
        return view('Business::ads.index',['ads'=>$ads]);
    }
    public function getAdd(Request $request) {
    	$provinces = Province::where('order_by','<',2)->get()->pluck('province_name','id');
        return view('Business::ads.add', ['provinces'=> $provinces]);
    }
    public function confAdd(Request $request) {
        $provinces = Province::where('order_by','<',2)->get()->pluck('province_name','id');
        $cities = City::where('province_id', $request->data['province_id'])->where('city_name', '<>', 'すべて')->pluck('city_name', 'id');
        $ads = (object) $request->data;
        return view('Business::ads.confadd',compact('ads','provinces','cities'));
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
        return redirect(route('addfinish'));
        
    }
    public function addfinish(Request $request) {
        return view('Business::ads.addfinish');
    }
    
    public function getEdit(Request $request) {
        $user_id = session('users')['id'];
        $provinces = Province::where('order_by','<',2)->get()->pluck('province_name','id');
        $ads = Ads::with(['users','province','city'])->where('user_id',$user_id)->where('id',$request->id)->first();
        $cities = City::where('province_id', $ads->province_id)->where('city_name', '<>', 'すべて')->pluck('city_name', 'id');
        $ads->date = date('Y年m月d日', strtotime($ads->date));
        return view('Business::ads.edit', ['provinces'=> $provinces,'cities'=> $cities, 'ads'=>$ads]);
    }

    public function confEdit(Request $request) {
        $provinces = Province::where('order_by','<',2)->get()->pluck('province_name','id');
        $cities = City::where('province_id', $request->data['province_id'])->where('city_name', '<>', 'すべて')->pluck('city_name', 'id');
        $ads = (object) $request->data;
        return view('Business::ads.confedit',compact('ads','provinces','cities'));
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
        return redirect(route('editfinish'));
    }

    public function editfinish(Request $request) {
        return view('Business::ads.editfinish');
    }

    public function getview(Request $request) {
        $user_id = session('users')['id'];
        $ads = Ads::with(['users','province','city'])->where('user_id',$user_id)->where('id',$request->id)->first();
        return view('Business::ads.view', ['ads'=>$ads]);
    }  
}
