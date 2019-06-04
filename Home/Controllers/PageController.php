<?php
namespace Ext\Home\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use DB;

class PageController extends Controller
{
	public function advertise() {
    	return view('Home::pages.advertise');
	}
}
