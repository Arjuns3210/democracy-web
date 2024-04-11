<?php
/*
    *   Developed by : Ankita - Mypcot Infotech
    *   Created On : 03-07-2023
    *   https://www.mypcot.com/
*/

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Question;
use App\Models\Contest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->toDateString();
        $data['users_total'] = User::where('status', '1')->count();
        $data['question'] = Question::where('status', '1')->count();
        $data['contest'] = Contest::where('status', '1')->count();
        $data['category'] = Category::where('status', '1')->count();

        $data['users_total_todays'] = User::where('status', '1')->whereDate('created_at', $today)->count();
        $data['question_todays'] = Question::where('status', '1')->whereDate('created_at', $today)->count();
        $data['contest_todays'] = Contest::where('status', '1')->whereDate('created_at', $today)->count();
        $data['category_todays'] = Category::where('status', '1')->whereDate('created_at', $today)->count();

        if(session('data')['role_id'] != 1){
            return view('backend/dashboard/staff_dashboard', $data);
        }
        return view('backend/dashboard/index', $data);
    }

    public function userDashboardChart()
    {
		$months = [];
        $currentMonth = Carbon::now();
        for ($i = 0; $i < 6; $i++) {
            $months[] = $currentMonth->copy()->startOfMonth()->subMonths($i)->format('Y-m');
        }
        $user_data = \DB::table('users')
            ->select(\DB::raw('DATE_FORMAT(created_at, "%Y-%m") AS month'), \DB::raw('COUNT(*) AS count'))
            ->where('status', '=', 1)
            ->whereIn(\DB::raw('DATE_FORMAT(created_at, "%Y-%m")'), $months)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        // Convert the result to an associative array
        $user_data = $user_data->pluck('count', 'month')->all();
        $result = [];
        foreach ($months as $month) {
            $result[] = [
                'month' => date('M-y', strtotime($month)),
                'count' => isset($user_data[$month]) ? $user_data[$month] : 0,
            ];
        }
        return array_values(array_reverse($result));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
