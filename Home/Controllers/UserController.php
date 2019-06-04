<?php
namespace Ext\Home\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Mail;
// use Session;
use App\Models\User;
use App\Models\Province;
use Carbon\Carbon;
use App\Helpers\AuthLuu;

class UserController extends Controller
{
    public function logout() {
        return view('Home::users.login');
    }
    public function login() {
        return view('Home::users.login');
    }
    public function dologin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = new User;
        $check_cf = $user->where('email', $email)->first();
        if($check_cf) {
            if($check_cf->confirmed == 1) {
                if($email==$check_cf->email && $password==Crypt::decryptString($check_cf->password)) {
                    session(['users' => ['id'=>$check_cf->id,'email'=>$check_cf->email,'companyname'=>$check_cf->name]]);
                    // AuthLuu::dologin($check_cf);
                    if($check_cf->roles==2) {
                        session(['roles' => 2]);
                        return redirect(route('home'));
                    }elseif($check_cf->roles==1) {
                        session(['roles' => 1]);
                        return redirect(route('business'));
                    }else{
                        session(['roles' => 0]);
                        return redirect(route('admin'));
                    }
                    
                    
                }else{
                    return redirect()->back()->withInput()->with('flash',['class'=>'error-box', 'mes'=>'email address or password is incorrect']);
                }
            }else{
                return redirect()->back()->withInput()->with('flash',['class'=>'error-box', 'mes'=>'ログインするためには、メール認証を完了してください。']);
            }
        }
        return redirect()->back()->withInput()->with('flash',['class'=>'error-box', 'mes'=>'email address or password is incorrect']);
    }
	public function nUser() {
    	return view('Home::users.nuser');
	}
	public function postnUser(Request $request) {
        $check = User::where('email',$request->email)->count();
        if($check) {
            return redirect()->back()->withInput()->with('flash',['class'=>'error-box', 'mes'=>'そのメールアドレスは既に利用されています。']);
        }

        $confirmation_code = Crypt::encryptString(date('ymdhis'));
        $user = new User;
        $user->email = $request->email;
        $user->password = Crypt::encryptString($request->password);
        // $decrypted = Crypt::decryptString($encrypted);
        $user->confirmation_code = $confirmation_code;
        $user->confirmed = 0;
        $user->notification = $request->notification;
        $user->incentives = $request->incentives;
        $user->roles = 2;

        $rs = $user->save();

        if($rs) {
            $mail_data = [
                'mail_address' => $request->email,
                'mail_name' => 'From:',
                'subject' => 'メールアドレスの認証を行ってください'
            ];
            $url['verify_user'] = route('verify_user',['token'=>$confirmation_code]);
            $url['email'] = $request->email;
            $url['home'] = route('home');
            $mail_rs = Mail::send('mailtemp.register', ['url' => $url], function ($m) use ($mail_data) {
                return $m->to($mail_data['mail_address'], $mail_data['mail_name'])->subject($mail_data['subject']);
            });
            return redirect(route('register_completed'));
        }
	}
	public function cUser() {
        $provinces = Province::where('order_by','<',2)->get()->pluck('province_name','id');
    	return view('Home::users.cuser', ['provinces'=> $provinces]);
	}
    public function postcUser(Request $request) {
        $check = User::where('email',$request->email)->count();
        if($check) {
            return redirect()->back()->withInput()->with('flash',['class'=>'error-box', 'mes'=>'そのメールアドレスは既に利用されています。']);
        }

        $confirmation_code = Crypt::encryptString(date('ymdhis'));
        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Crypt::encryptString($request->password);
        // $decrypted = Crypt::decryptString($encrypted);
        $user->confirmation_code = $confirmation_code;
        $user->confirmed = 0;
        $user->zip1 = $request->zip1;
        $user->zip2 = $request->zip2;
        $user->phone = $request->tel;
        $user->fax = $request->fax;
        $user->province_id = $request->province_id;
        $user->city_id = $request->city_id;
        $user->address = $request->address;
        $user->building = $request->building;
        $user->notification = $request->notification;
        $user->incentives = $request->incentives;
        $user->roles = 1;

        $rs = $user->save();

        if($rs) {
            $mail_data = [
                'mail_address' => $request->email,
                'mail_name' => 'From:',
                'subject' => 'メールアドレスの認証を行ってください'
            ];
            $url['verify_user'] = route('verify_user',['token'=>$confirmation_code]);
            $url['email'] = $request->email;
            $url['home'] = route('home');
            $mail_rs = Mail::send('mailtemp.register', ['url' => $url], function ($m) use ($mail_data) {
                return $m->to($mail_data['mail_address'], $mail_data['mail_name'])->subject($mail_data['subject']);
            });
            return redirect(route('register_completed'));
        }
    }
	public function register_completed() {
    	return view('Home::users.registercompleted');
	}
    public function getVerifyUser(Request $request)
    {
        $confirmation_code = $request->token;
        $user = new User;
        $user_s = $user->where('confirmation_code',$confirmation_code)->first();
        if($user_s) {
            $user = $user->find($user_s->id);
            $user->confirmed = 1;
            $rs = $user->save();
            return redirect(route('login'))->with('flash',['class'=>'', 'mes'=>'メールアドレスの認証が完了し、ログインが可能となりました']);
        }
        return redirect(route('login'))->withInput()->with('flash',['class'=>'error-box', 'mes'=>'ログインするためには、メール認証を完了してください。']);
    }
    public function edituser() {
        $user = User::find(session('users')['id']);
        return view('Home::users.edituser',['user'=>$user]);
    }
    public function postedituser(Request $request) {
        $check = User::where('id',session('users')['id'])->count();
        if(!$check) {
            return redirect()->back();
        }
        $user = User::where('id',session('users')['id']);
        $data['email'] = $request->email;
        $data['password'] = Crypt::encryptString($request->password);
        $data['notification'] = $request->notification;
        $data['incentives'] = $request->incentives;
        $rs = $user->update($data);
        return redirect(route('home'));
    }
}
