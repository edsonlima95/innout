<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\WorkHours;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Calculo os dias trabalhados durante o mês.
     * report = Todos os registros do mês
     * sumWorkedTime = Soma de todas as horas já trabalhadas
     * balance = Retorna se trabalhou mais ou menos e retorna o saldo.
     */
    public function monthReport()
    {
        //Retorna todos os registros do mês atual.
        $monthReport = WorkHours::MonthReport('2019-09');
        $workday = 0;
        $sumWorkedTime = $monthReport->sum('worked_time');

        $lastDayOfMonth = lastDayOfMonth('2019-09')->format('d');
        for ($day = 1; $day <= $lastDayOfMonth; $day++) {
            $allDates = (new \DateTime('2019-09'))->format('Y-m') . '-' . sprintf("%02d", $day);
            if (!isWeekend($allDates)) $workday++;
        }

        $expectedTime = $workday * 28800;
        $balance = convertTimeToHour(abs($sumWorkedTime - $expectedTime));
        $positiveNegative = ($sumWorkedTime >= $expectedTime ? '+' : '-');

        return view('web.report', [
            'monthReport' => $monthReport ?? null,
            'sumWorkedTime' => $sumWorkedTime,
            'balance' => "{$positiveNegative}{$balance}",
            'sign' => $positiveNegative
        ]);
    }
}
