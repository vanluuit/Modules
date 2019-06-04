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
use Carbon\Carbon;

class CardController extends Controller
{
    public function addcard() {
        return view('Business::cards.addcard');
    }
    public function bill() {
        return view('Business::cards.bill');
    }
    
}
