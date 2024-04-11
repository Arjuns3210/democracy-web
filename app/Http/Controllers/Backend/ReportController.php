<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\CorrectAnswer;
use App\Models\EnrolledContest;
use App\Models\User;
use App\Exports\UserExport;
use App\Exports\EnrolledUsersExport;
use App\Models\Winner;
use App\Models\Contest;
use App\Exports\WinnersExport;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('backend/report/user');
    }

    public function enrolledReport(){
        $data['contests'] = Contest::all();
        return view('backend/report/enrolled_user')->with($data);
    }
    public function winnersReport(){
        $data['contests'] = Contest::all();
        return view('backend/report/winners')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function userReportExport(Request $request){
        $input = $request->all();
        $dateRange = explode(' - ', $input['user_date']);
        $startDate = null;
        $endDate = null;

        if (isset($dateRange[0])) {
            $startDate = Carbon::createFromFormat('d/m/Y', trim($dateRange[0]))->startOfDay()->format('Y-m-d H:i:s');
        }

        if (isset($dateRange[1])) {
            $endDate = Carbon::createFromFormat('d/m/Y', trim($dateRange[1]))->endOfDay()->format('Y-m-d H:i:s');
        }

        $data['userData'] = User::whereBetween('created_at', [$startDate ,$endDate])->get();
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        return (new UserExport($data))
            ->download('Customer report '. Carbon::now()->format('d-m-Y').'.xlsx');

    }

    public function enrolledUserExport(Request $request){
        $input = $request->all();
        $dateRange = explode(' - ', $input['user_date']);
        $startDate = null;
        $endDate = null;

        if (isset($dateRange[0])) {
            $startDate = Carbon::createFromFormat('d/m/Y', trim($dateRange[0]))->startOfDay()->format('Y-m-d H:i:s');
        }

        if (isset($dateRange[1])) {
            $endDate = Carbon::createFromFormat('d/m/Y', trim($dateRange[1]))->endOfDay()->format('Y-m-d H:i:s');
        }
        $data['userData'] = [];
        $enrolledUsersQuery = EnrolledContest::whereBetween('created_at', [$startDate, $endDate]);

        if (!empty($input['contest_ids'])) {
            $contestIds = $input['contest_ids'] ?? [];
            $enrolledUsersQuery->whereIn('contest_id', $contestIds);
        }

        $data['userData'] = $enrolledUsersQuery->get();
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        return (new EnrolledUsersExport($data))
            ->download('Enrolled Users report '. Carbon::now()->format('d-m-Y').'.xlsx');

    }

    public function winnersExport(Request $request){
        $input = $request->all();
        $dateRange = explode(' - ', $input['user_date']);
        $startDate = null;
        $endDate = null;

        if (isset($dateRange[0])) {
            $startDate = Carbon::createFromFormat('d/m/Y', trim($dateRange[0]))->format('Y-m-d');
        }

        if (isset($dateRange[1])) {
            $endDate = Carbon::createFromFormat('d/m/Y', trim($dateRange[1]))->format('Y-m-d');
        }
        $startDate = Carbon::parse($startDate)->format('Y-m-d');
        $endDate = Carbon::parse($endDate)->format('Y-m-d');
        $answers = Answer::with('contest')
            ->whereHas('contest', function ($query) use($startDate,$endDate){
                $query->whereRaw("(CONCAT(contest_date, ' ', end_time) < ?)", [Carbon::now()->format('Y-m-d H:i:s')])
                        ->whereBetween('contest_date', [$startDate ,$endDate]);
            })
            ->orderBy('answer_timing');

            if (!empty($input['contest_ids'])) {
                $contestIds = $input['contest_ids'] ?? [];
                $answers->whereIn('contest_id', $contestIds);

            }

            $answers = $answers->get()->groupBy(['contest_id', 'user_id']);
        $data = [];
        foreach ($answers as $contestId => $contest) {
            $data[$contestId] = [];
            foreach ($contest as $userId => $userQuestions) {
                $data[$contestId][$userId] = [];
                $totalQuestions = count($userQuestions);
                $trueQuestions = 0;

                $questionsAndOptionsForExcel = [];
                foreach ($userQuestions as $key => $question) {
                    $majorityQuestionAnswer = CorrectAnswer::where('contest_id',
                        $question->contest_id)->where('question_id', $question->question_id)->orderBy('answer_count',
                        'desc')->first();
                    if ($majorityQuestionAnswer->option_id == $question->option_id ?? 0) {
                        $trueQuestions += 1;
                    }
                    $questionsAndOptionsForExcel[] =[
                        'question'=>$question->question->question ?? '',
                        'option'=>$question->option->option ?? '',
                        'majority_option'=>$majorityQuestionAnswer->option->option ?? '',
                    ];
                    $data[$contestId][$userId] = [
                        'contest_name' => $question->contest->name ?? '',
                        'user_name'    => $question->user->name ?? '',
                        'phone_number'    => $question->user->phone ?? '',
                    ];
                }
                $totalPercentage = $trueQuestions * 100 / $totalQuestions;
                $totalPercentage = (double) number_format($totalPercentage, 2);
                $data[$contestId][$userId]['percentage'] = $totalPercentage;
                $data[$contestId][$userId]['total_questions'] = $totalQuestions;
                $data[$contestId][$userId]['question_details'] = $questionsAndOptionsForExcel;
            }
        }

        $results = [];
        foreach ($data as $newData){
            $prepareRankData = collect($newData)->sortByDesc('percentage')->take(4);
            $rank = 0;
            foreach ($prepareRankData as $rankData) {
                $rankData['rank'] = ++$rank;
                $results[] = $rankData;
            }
        }


        $resultData['results'] = $results;
        $resultData['startDate'] = $startDate;
        $resultData['endDate'] = $endDate;
        return (new winnersExport($resultData))
            ->download('Winners report '. Carbon::now()->format('d-m-Y').'.xlsx');

    }

}
