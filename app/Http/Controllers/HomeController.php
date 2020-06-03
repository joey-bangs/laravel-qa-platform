<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use Illuminate\Http\Request;
use App\Question;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $six_weeks = collect([
            Carbon::now()->format('W'),
            Carbon::now()->subDays(7)->format('W'),
            Carbon::now()->subDays(14)->format('W'),
            Carbon::now()->subDays(21)->format('W'),
            Carbon::now()->subDays(28)->format('W'),
            Carbon::now()->subDays(35)->format('W'),
            Carbon::now()->subDays(42)->format('W'),
        ]);
        $questions_for_six_weeks = Question::lastSixWeeks()->get();
        $questions_count_for_six_weeks = $six_weeks->map(function ($week) use ($questions_for_six_weeks) {
            return $questions_for_six_weeks->filter(function ($question) use ($week) {
                $now = Carbon::now();

                return Carbon::parse($question->created_at)->format('W') === $week && $now->year ===  Carbon::parse($question->created_at)->year;
            })->count();
        })->toArray();

        $line_chart = new DashboardChart;
        $line_chart->labels([
            'This week',
            'Last week',
            'Last 2 weeks',
            'Last 3 weeks',
            'Last 4 weeks',
            'Last 5 weeks'
        ]);
        $line_chart->dataset('Questions over six weeks', 'line', $questions_count_for_six_weeks)
            ->color([
                "rgba(255, 99, 132, 1.0)",
            ])->backgroundcolor([
                "rgba(255, 99, 132, 0.2)",
            ]);

        $bar_chart = new DashboardChart;
        $bar_chart->labels(['Today', 'This week', 'This month']);
        $bar_chart->dataset('Questions over time', 'bar', [
            Question::mostRecent('today')->get()->count(),
            Question::mostRecent('week')->get()->count(),
            Question::mostRecent('month')->get()->count()
        ])->color([
            "#320e29",
            "#872705",
            "#435858",
        ])->backgroundcolor([
            "#974f85",
            "#E14209",
            "#7f9e9e",
        ]);

        return view('home', [
            'line_chart' => $line_chart,
            'bar_chart' => $bar_chart,
        ]);
    }
}
