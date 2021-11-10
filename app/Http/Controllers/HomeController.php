<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'checkUser']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $final_data = $this->getActualData(date('Y'));

        return view('home', compact('final_data'));
    }

    public function getdata()
    {

        $data_per_year = $this->getActualData(request()->year);

        return $data_per_year;
    }

    private function getActualData($year)
    {
        $orders = Order::select( DB::raw("COUNT(*) as count, MONTH(created_at) as month") )
        ->whereYear('created_at', $year)
        ->groupBy('month')
        ->get()
        ->toArray();

        $count_month = [];

        foreach($orders as $order) {
            $count_month[ $order['month'] ] = $order['count'];
        }

        // we need to make array of 12 index with its value if exist or null if there is no data
        $months = [1,2,3,4,5,6,7,8,9,10,11,12];
        $final_data = [];
        foreach($months as $month) {
            if(key_exists($month, $count_month)) {
                $final_data[$month] = $count_month[$month];
            }else {
                $final_data[$month] = null;
            }
        }

        return $final_data;
    }
}
