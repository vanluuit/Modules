<?php
namespace Ext\User\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Mail;
use Session;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\Fudousan;
use Carbon\Carbon;

class UserAdminController extends Controller
{
    public function mail_alert() {
        $user_id = session('users')['id'];
        $alert = User::where('id',$user_id)->first();
        return view('User::usersadmin.mailalert',compact('alert'));
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

        return view('User::usersadmin.bookmark', compact('data','canonical', 'title','key', 'location'));
    }
}
