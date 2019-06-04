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
use App\Models\Mailnoti;
use Carbon\Carbon;

class UserAdminController extends Controller
{
    public function mail_alert() {
        $user_id = session('users')['id'];
        $alert = User::where('id',$user_id)->first();
        return view('Home::usersadmin.mailalert',compact('alert'));
    }
    public function post_mail_alert(Request $request) {
        $user_id = session('users')['id'];
        $alert = User::where('id',$user_id)->update([
                'area_mail'=>$request->area_mail,
                'keyword_mail'=>$request->keyword_mail
            ]);
        if($alert){
            return redirect()->back()->with('flash',['class'=>'success-box', 'mes'=>'インポートが完了しました。']);
        }else{
            return redirect()->back()->withInput();
        }
    }
    public function ajaxbookmark(Request $request) {
    	$user_id = session('users')['id'];
    	$fudousan_id = $request->id;
    	$bm = Bookmark::where('user_id',$user_id)->where('fudousan_id',$fudousan_id)->first();
        if($bm) {
            Bookmark::where('user_id',$user_id)->where('fudousan_id',$fudousan_id)->delete();
        }else{
            $dt = new Bookmark;  
            $dt->user_id = $user_id;
            $dt->fudousan_id = $fudousan_id;
            $dt->save();
        }
    	echo json_encode('ok');die();
    }
    public function bookmark(Request $request) {
        $data = new Fudousan;
        if(session('users')) {
            $ids = session('users')['id'];
            $data = $data->with(['bookmarks' => function($qr)use($ids){
                return $qr->where('user_id',$ids);
            }]);
            $data->has('bookmarks');
        }
        $data = $data->whereDate('updated_at','>=',date('Y-m-d'));
        $data = $data->orderby('order_time','DESC')->orderby('nabi','DESC')->paginate(30);
        $title="bookmarks";
        $canonical="canonical";
        $key="key";
        $location="location";
        // $data = $data->orderby('nabi','DESC')->paginate(30);
        // dd($data);

        return view('Home::usersadmin.bookmark', compact('data','canonical', 'title','key', 'location'));
    }
    public function ajaxCheckUserExit(Request $request) {
        $check = User::where('email',$request->email)->count();
        $dl = [];
        if($check){
            $dl['status'] = 'error';
            $dl['mes'] = 'このメールアドレスは他の会員ユーザーと重複します。';
        }else{
            $check = User::where('email',$request->email)->where('roles',2)->where('confirmed','<>',1)->count();
            if($check){
                $dl['status'] = 'error';
                $dl['mes'] = 'このメールアドレスは<br>この条件のメールアラートの認証完了待ちです。';
            }else{
                $dl['status'] = 'success';
                $dl['mes'] = $request->email;
            }
        }
        echo json_encode( $dl);die();
    }
    public function ajaxReceiveMail(Request $request) {

        $check = User::where('email',$request->email)->count();
        $dl = [];
        if($check){
            $dl['status'] = 'error';
            $dl['mes'] = 'このメールアドレスは他の会員ユーザーと重複します。';
        }else{
            $check1 = Mailnoti::where('email',$request->email)->count();
            if($check1){
                $dl['status'] = 'error';
                $dl['mes'] = 'このメールアドレスは他の会員ユーザーと重複します。';
            }else{
                $user = new Mailnoti;
                $confirmation_code = Crypt::encryptString(date('ymdhis'));
                $user->confirmation_code = $confirmation_code;
                $user->email = $request->email;
                $user->keyword_mail = $request->keyword_mail;
                $user->area_mail = $request->area_mail;
                $user->incentives = @$request->incentives;
                $user->notification = @$request->notification;
                // $user->roles = 3;

                $user->save();
                $mail_data = [
                    'mail_address' => $request->email,
                    'mail_name' => 'From:',
                    'subject' => 'メールアドレスの認証を行ってください'
                ];
                $url['verify_user'] = route('very_mail_alert',['token'=>$confirmation_code]);
                $url['email'] = $request->email;
                $url['home'] = route('home');
                $mail_rs = Mail::send('mailtemp.register', ['url' => $url], function ($m) use ($mail_data) {
                    return $m->to($mail_data['mail_address'], $mail_data['mail_name'])->subject($mail_data['subject']);
                });

                $dl['status'] = 'success';
                $dl['mes'] = $request->email;
            }
        }
        echo json_encode($dl);die();
    }
    public function very_mail_alert(Request $request) {
        $check = Mailnoti::where('confirmation_code',$request->token)->count();
        if($check){
            Mailnoti::where('confirmation_code',$request->token)->update(['confirmed'=>1]);
            return redirect(route('home'));
        }else{
            return redirect(route('home'));
        }
    }
}
