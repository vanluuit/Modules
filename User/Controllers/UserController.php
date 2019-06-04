<?php
namespace Ext\User\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Validator;
use Mail;
use Session;
use App\Models\User;
use App\Models\Province;
use Carbon\Carbon;

class UserController extends Controller
{
    public function edituser() {
        $user = User::find(session('users')['id']);
        return view('User::users.edituser',['user'=>$user]);
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
