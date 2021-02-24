<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WorkHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Calculo os dias trabalhados durante o mês.
     * report = Todos os registros do mês
     * sumWorkedTime = Soma de todas as horas já trabalhadas
     * balance = Retorna se trabalhou mais ou menos e retorna o saldo.
     */
    public function monthReport(Request $request)
    {
        $date = $request->date ?? new \DateTime();
        $user = $request->user_id ?? Auth::id();

        //Retorna todos os registros do mês atual.
        $monthReport = WorkHours::monthReport($date, $user);
        $workday = 0;
        $sumWorkedTime = $monthReport->sum('worked_time');

        $lastDayOfMonth = lastDayOfMonth(new \DateTime())->format('d');
        for ($day = 1; $day <= $lastDayOfMonth; $day++) {
            $allDates = (new \DateTime())->format('Y-m') . '-' . sprintf("%02d", $day);
            if (!isWeekend($allDates)) $workday++;
        }

        $expectedTime = $workday * 28800;
        $balance = convertTimeToHour(abs($sumWorkedTime - $expectedTime));
        $positiveNegative = ($sumWorkedTime >= $expectedTime ? '+' : '-');

        return view('web.monthly_report', [
            'monthReport' => $monthReport ?? null,
            'sumWorkedTime' => $sumWorkedTime,
            'balance' => "{$positiveNegative}{$balance}",
            'sign' => $positiveNegative
        ]);
    }

    public function generalReport()
    {
        $usersAbsent = WorkHours::usersAbsent();
        $timeTotal = WorkHours::sumWorkedTime();
        $usersActive = User::where('end_date',null)->count();
        return view('web.general_report',[
                'usersAbsent' => $usersAbsent,
                'timeTotal' => $timeTotal,
                'usersActive' => $usersActive
            ]);
    }
}
