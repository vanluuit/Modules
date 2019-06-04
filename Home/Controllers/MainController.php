<?php
namespace Ext\Home\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Fudousan;
use App\Models\Mailnoti;
use App\Models\Ads;
use DB;

class MainController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }
    public function index() {
        $data = Fudousan::orderby('updated_at','DESC')->orderby('page','ASC')->paginate(30);
        return view('Home::main.index', compact('data'));
    }
    public function search(Request $requests) {
        $search = $requests->search;
        $key = @explode('の関連の不動産', $search)[0];
        $location = @explode('の関連の不動産', $search)[1];
        if($key && $location) {
            $title = $key.'の物件 - '.str_replace(' ', '-', $location);
        }else if(!$key && $location){
            $title =str_replace(' ', '-', $location);
        }else{
            $title = $key.'の物件';
        }
        $cano = $this->location_cano($location);
        $canonical = urlencode( $key.'の関連の不動産'.$cano);
        // $canonical = urlencode($search);
        $location = str_replace(' ', '', $location);
        $data = new Fudousan;
        if(session('users')) {
            $ids = session('users')['id'];
            $data = $data->with(['bookmarks' => function($qr)use($ids){
                return $qr->where('user_id',$ids);
            }]);
        }
        $data = $data->select('*',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date_order'));
        // $data = $data->where('date_order', date('Y-m-d'));
        if(!empty($key)) {
            $data = $data->where('title','LIKE', '%'.$key.'%');
        }
        if(!empty($location)) {
            // $data = $data->where('address','LIKE', '%'.$location.'%');
            $data = $data->where(function ($query)use($location)  {
                $query->orWhere('address','LIKE', '%'.$location.'%')
                    ->orWhere('traffic','LIKE', '% '.$location.' %');
            });
        }
        $data = $data->whereDate('updated_at','>=',date('Y-m-d'));
        $data = $data->orderby('date_order','DESC')->orderby('nabi','DESC')->paginate(30);
        $category = ['1'=>'nha moi', '2'=>'中古戸建', '3'=>'chung cu moi', '4'=>'中古マンション'];
        $ads=[];
        if(!$requests->page || $requests->page < 2) {
            $ads = Ads::where('publish',1)->where('permission',1)->where('main_ads',1)
            ->where(function ($query)use($key,$location) {
                $query->where('search_bg', 1)
                    ->where('title', 'LIKE', '%'.$key.'%')
                    ->where('addressfull', 'LIKE', '%'.$location.'%');
            })
            ->orWhere(function ($query)use($key,$location)  {
                $query->where('search_bg', 0)
                    ->where('title', $key)
                    ->where('addressfull', $location);
            })->orderby('click_price', 'DESC')->limit(3)->get();
        }
        return view('Home::main.search', compact('ads','data', 'category','canonical', 'title','key', 'location'));
    }

    public function fillter(Request $requests) {
        $key = $requests->search;
        $location = $requests->location;
        $tag = $requests->tag;
        $price_from = (float)($requests->price_from / 10000);
        $price_to = (float)($requests->price_to / 10000);
        $housearea_from = (float)$requests->housearea_from;
        $housearea_to = (float)$requests->housearea_to;
        $floor_map = $requests->floor_map;
        $traffic = $requests->traffic;
        $year = $requests->year;

        $today = date('Y-m-d');
        $lay = strtotime(date("Y-m-d", strtotime($today)) . " - ".$year."year");
        $y = date('Y-m-d', $lay);

        $data = new Fudousan;
        $data = $data->select('*',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date_order'));
        // $data = $data->where('date_order', date('Y-m-d'));
        if(!empty($key)) {
            $data = $data->where('title','LIKE', '%'.$key.'%');
        }
        if(!empty($location)) {
            // $data = $data->where('address','LIKE', '%'.$location.'%');
            $data = $data->where(function ($query)use($location)  {
                $query->orWhere('address','LIKE', '%'.$location.'%')
                    ->orWhere('traffic','LIKE', '% '.$location.' %');
            });
        }
        if(!empty($tag)) {
            $data = $data->whereIn('tag', $tag);
        }
        if(!empty($floor_map)) {
            $data = $data->whereIn('floor_map', $floor_map);
        }
        if(!empty($price_from)) {
            $data = $data->where('price', '>=', $price_from);
        }
        if(!empty($price_to)) {
            $data = $data->where('price', '<=', $price_to);
        }
        if(!empty($housearea_from)) {
            $data = $data->where('housearea', '>=', $housearea_from);
        }
        if(!empty($housearea_to)) {
            $data = $data->where('housearea', '<=', $housearea_to);
        }
        if(!empty($traffic)) {
            $data = $data->where(function ($query)use($traffic)  {
                for ($i=1; $i <= $traffic; $i++) { 
                    $query = $query->orWhere('traffic', 'LIKE', '%徒歩'.$i.'分%');
                }
            });
            // $data = $data->where('traffic', 'LIKE', '%徒歩'.$traffic.'分%');
        }
        if(!empty($year)) {
            $data = $data->where('date', '>', $y);
        }
        $data = $data->whereDate('updated_at','>=',date('Y-m-d'));
        
        if($key && $location) {
            $title = $key.'の物件 - '.str_replace(' ', '-', $location);
        }else if(!$key && $location){
            $title =str_replace(' ', '-', $location);
        }else{
            $title = $key.'の物件';
        }
        $cano = $this->location_cano($location);
        $canonical = urlencode( $key.'の関連の不動産'.$cano);
        $location = str_replace(' ', '', $location);
        $data = $data->orderby('date_order','DESC')->orderby('nabi','DESC')->paginate(30);
        $category = ['1'=>'nha moi', '2'=>'中古戸建', '3'=>'chung cu moi', '4'=>'中古マンション'];
        $ads=[];
        if(!$requests->page || $requests->page < 2) {
            $ads = Ads::where('publish',1)->where('permission',1)->where('fillter_ads',1)
            ->where(function ($query)use($key,$location) {
                $query->where('search_bg', 1)
                    ->where('title', 'LIKE', '%'.$key.'%')
                    ->where('addressfull', 'LIKE', '%'.$location.'%');
            })
            ->orWhere(function ($query)use($key,$location)  {
                $query->where('search_bg', 0)
                    ->where('title', $key)
                    ->where('addressfull', $location);
            })->orderby('click_price', 'DESC')->limit(3)->get();
        }
        return view('Home::main.search', compact('ads','data', 'category','canonical', 'title','key', 'location'));
    }

    public function location(Request $requests) {
        $text = urlencode($requests->text);
        $ar = [];
        $url = 'https://jp.indeed.com/m/rpc/suggest/where?caret=1&hp2=true&q='.$text.'&escapeHtml=false&from=home&mobtk=1cpt6k3fh7ibs800';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $output = curl_exec($ch); 
        curl_close($ch); 
        $dlar = json_decode($output, true);
        foreach ($dlar as $key => $value) {
            $a = str_replace('<b>', '', $value);
            $a = str_replace('</b>', '', $a);
            $a = str_replace(' ', '', $a);
            $ar[] = $a; 
        }
        echo json_encode($ar);die();
    }
    public static function location_cano($text) {
        $text = urlencode($text);
        $url = 'https://jp.indeed.com/m/rpc/suggest/where?caret=1&hp2=true&q='.$text.'&escapeHtml=false&from=home&mobtk=1cpt6k3fh7ibs800';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $output = curl_exec($ch); 
        curl_close($ch); 
        $dlar = json_decode($output, true);

        $a = str_replace('<b>', '', @$dlar[0]);
        $a = str_replace('</b>', '', $a);
        $a = str_replace(' ', '', $a);
        return $a;
    }
}