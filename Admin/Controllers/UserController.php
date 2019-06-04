<?php
namespace Ext\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Mail;
use Session;
use App\Models\User;
use App\Models\Mailnoti;
use App\Models\Province;
use App\Models\City;
use Carbon\Carbon;
use App\Helpers\AuthLuu;

class UserController extends Controller
{
	public function nUser(Request $requests) {
        $nusers = User::where('roles',2); 
        if($requests->id){
            $nusers = $nusers->where('id',$requests->id); 
        }
        if($requests->name){
            $nusers = $nusers->where('name','LIKE','%'.$requests->name.'%'); 
        }
        if($requests->email){
            $nusers = $nusers->where('email',$requests->email); 
        }
        if($requests->phone){
            $nusers = $nusers->where('phone',$requests->phone); 
        }
        if($requests->confirmed){
            $nusers = $nusers->whereIn('confirmed',$requests->confirmed); 
        }
        $nusers = $nusers->paginate(20);
    	return view('Admin::users.nuser', compact('nusers'));
	}
    public function getnUserEdit(Request $requests) {
        $nuser = User::find($requests->id); 
        return view('Admin::users.nuseredit', compact('nuser'));
    }
    public function postnUserConfirm(Request $requests) {
        $nuser = (object) $requests->data;
        return view('Admin::users.nuserconf', compact('nuser'));
    }
    public function postnUserEdit($id, Request $request) {
        $user = User::find($id)->update($request->data);
        return redirect(route('admin.nUser'));
    }
    public function getnUserview($id) {
        $nuser = User::find($id);
        return view('Admin::users.nuserview', compact('nuser'));
    }
    public function userDelete($id) {
        $user = User::destroy($id);
        return back();  
    }
    public function userLoginto($id) {
        Session::forget('users');
        Session::forget('roles');
        $user = User::find($id);
        session(['users' => ['id'=>$user->id,'email'=>$user->email,'companyname'=>$user->name]]);
        if($user->roles==2) {
            session(['roles' => 2]);
            return redirect(route('home'));
        }elseif($user->roles==1) {
            session(['roles' => 1]);
            return redirect(route('business'));
        }else{
            session(['roles' => 0]);
            return redirect(route('admin'));
        }
        return back();  
    }
    
	public function cUser(Request $requests) {
        $cusers = User::where('roles',1); 
        if($requests->id){
            $cusers = $cusers->where('id',$requests->id); 
        }
        if($requests->name){
            $cusers = $cusers->where('name','LIKE','%'.$requests->name.'%'); 
        }
        if($requests->email){
            $cusers = $cusers->where('email',$requests->email); 
        }
        if($requests->phone){
            $cusers = $cusers->where('phone',$requests->phone); 
        }
        if($requests->confirmed){
            $cusers = $cusers->whereIn('confirmed',$requests->confirmed); 
        }
        $cusers = $cusers->paginate(20);
        $provinces = Province::where('order_by','<',2)->get()->pluck('province_name','id');
        return view('Admin::users.cuser', compact(['cusers','provinces']));
	}

    public function getcUserEdit(Request $requests) {
        $cuser = User::find($requests->id); 
        $provinces = Province::where('order_by','<',2)->get()->pluck('province_name','id');
        $cities = City::where('province_id',$cuser->province_id)->get()->pluck('city_name','id');
        return view('Admin::users.cuseredit', compact(['cuser','provinces','cities']));
    }
    public function postcUserConfirm(Request $requests) {
        $cuser = $requests; 
        $provinces = Province::where('order_by','<',2)->get()->pluck('province_name','id');
        $cities = City::where('province_id',$cuser->province_id)->get()->pluck('city_name','id');
        return view('Admin::users.cuserconf', compact(['cuser','provinces','cities']));
    }
    public function postcUserEdit($id, Request $request) {
        $user = User::find($id)->update($request->all());
        return redirect(route('admin.cUser'));
    }
    public function getcUserview($id) {
        $cuser = User::find($id);
        $provinces = Province::where('order_by','<',2)->get()->pluck('province_name','id');
        $cities = City::where('province_id',$cuser->province_id)->get()->pluck('city_name','id');
        return view('Admin::users.cuserview', compact(['cuser','provinces','cities']));
    }
    public function mUser(Request $requests) {
        $musers = Mailnoti::where('id','>',0); 
        if($requests->id){
            $musers = $musers->where('id',$requests->id); 
        }
        if($requests->email){
            $musers = $musers->where('email',$requests->email); 
        }
        if($requests->notification){
            $musers = $musers->whereIn('notification',$requests->notification); 
        }
        if($requests->incentives){
            $musers = $musers->whereIn('incentives',$requests->incentives); 
        }
        $musers = $musers->paginate(20);
        return view('Admin::users.muser', compact(['musers']));
    }

    public function getmUserEdit(Request $requests) {
        $muser = Mailnoti::find($requests->id); 
        return view('Admin::users.museredit', compact(['muser']));
    }
    public function postmUserConfirm(Request $requests) {
        $muser = $requests; 
        return view('Admin::users.muserconf', compact(['muser']));
    }
    public function postmUserEdit($id, Request $request) {
        $user = Mailnoti::find($id)->update($request->all());
        return redirect(route('admin.mUser'));
    }
}
