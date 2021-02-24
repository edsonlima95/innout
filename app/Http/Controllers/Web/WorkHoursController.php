<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\WorkHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkHoursController extends Controller
{

    public function home()
    {

        $workHours = WorkHours::where('work_date', date('Y-m-d'))->where('user_id',Auth::id())->first();
        if (!$workHours) {
            $data = [
                'work_date' => date('Y-m-d'),
                'user_id' => Auth::id(),
                'worked_time' => 0
            ];
            DB::table('work_hours')->insert($data);
        }

        $workingHours = WorkHours::where('user_id', Auth::id())
            ->where('work_date', date('Y-m-d'))
            ->first();

        if ($workingHours->time_1 && !$workingHours->time_2) {
            $activeClock = 'workedHours';
        } elseif ($workingHours->time_2 && !$workingHours->time_3) {
            $activeClock = 'exitTime';
        } elseif ($workingHours->time_3 && !$workingHours->time_4) {
            $activeClock = 'workedHours';
        } elseif ($workingHours->time_4) {
            $activeClock = null;
        } else {
            $activeClock = 'exitTime';
        }

        return view('web.home', [
            'workingHours' => $workingHours,
            'workedHours' => $workingHours->workedHours()->format('%H:%I:%S'),
            'exitTime' => $workingHours->exitTime()->format('H:i:s'),
            'activeClock' => $activeClock
        ]);
    }

    public function lunch()
    {
        //Faz uma busca pelo usuario e a data de hoje.
        $time = WorkHours::where('user_id', Auth::id())
            ->where('work_date', date('Y-m-d'))
            ->first();

        //Verifica se o ponto ainda nao foi batido e bate o ponto e seta o valor das horas
        switch ($time) {
            case !$time->time_1:
                $time->time_1 = date('H:i:s');
                $time->worked_time = convertSecondsToDateInterval($time->workedHours());
                $time->save();
                notify()->success('Você bateu o primeiro ponto do dia', '1º batimento');
                break;
            case !$time->time_2:
                $time->time_2 = date('H:i:s');
                $time->worked_time = convertSecondsToDateInterval($time->workedHours());
                $time->save();
                notify()->success('Você bateu o segundo ponto do dia', '2º batimento');
                break;
            case !$time->time_3:
                $time->time_3 = date('H:i:s');
                $time->worked_time = convertSecondsToDateInterval($time->workedHours());
                $time->save();
                notify()->success('Você bateu o terceiro ponto do dia', '3º batimento');
                break;
            case !$time->time_4:
                $time->time_4 = date('H:i:s');
                $time->worked_time = convertSecondsToDateInterval($time->workedHours());
                $time->save();
                notify()->success('Você bateu o quarto ponto do dia', '4º batimento');
                break;
            default:
                notify()->info('Você já bateu todos os pontos do dia', 'Batimento encerrado');

        }

        return redirect()->route('app.home');
    }

}
