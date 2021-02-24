<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class WorkHours extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_date',
        'time1',
        'time2',
        'time3',
        'time4',
        'worked_time',
    ];

    /**
     * @return String
     * Este metodo calcula a soma total das horas trabalhadas
     */
    public function workedHours()
    {
        //Converte a string data em um data do tipo DATETIME
        $t1 = convertStringToDate($this->time_1);
        $t2 = convertStringToDate($this->time_2);
        $t3 = convertStringToDate($this->time_3);
        $t4 = convertStringToDate($this->time_4);

        //Zera o intervalo de tempo
        $part1 = new \DateInterval('PT0S');
        $part2 = new \DateInterval('PT0S');

        //Verifica a hora do batimento e pega a diferença do hororio atual.
        if ($this->time_1) {
           $part1 = $t1->diff(new \DateTime());

        }

        if ($this->time_2) {
            $part1 = $t1->diff($t2);
        }

        if ($this->time_3) {
            $part2 = $t3->diff(new \DateTime());
        }

        if ($this->time_4) {
            $part2 = $t3->diff($t4);

        }

        return sumDateFromInterval($part1, $part2);
    }

    /**
     * @return String
     * Este metodo calcula o intervalo de almoção
     */
    public function lunchHours(): \DateInterval
    {
        $t2 = convertStringToDate($this->time_2);
        $t3 = convertStringToDate($this->time_3);

        $lunchTime = new \DateInterval('PT0S');

        if ($this->time_2) {
            $lunchTime = $t2->diff(new \DateTime());
        }

        if ($this->time_3) {
            $lunchTime = $t2->diff($t3);
        }

        return $lunchTime;
    }

    /**
     * @return \DateTime
     * Esse metodo calcula a hora estimada de saida.
     */
    public function exitTime(): \DateTime
    {
        $t1 = convertStringToDate($this->time_1);
        $t4 = convertStringToDate($this->time_4);

        $period = \DateInterval::createFromDateString('8 hours');

        if (!$t1) {
            return (new \DateTime())->add($period);
        } elseif ($t4) {
            return $t4;
        } else {
            $total = sumDateFromInterval($period, $this->lunchHours());
            return $t1->add($total);
        }
    }

    /**
     * @param $param //recebe uma data inicial
     * @param $param2 //recebe um usuario
     * @return mixed
     */
    public function scopeMonthReport($query, $param, $param2)
    {
        $firstDay = firstDayOfMonth($param)->format('Y-m-d');
        $lastDay = lastDayOfMonth($param)->format('Y-m-d');

        return $query->where('user_id', $param2)
            ->whereBetween('work_date', [$firstDay, $lastDay])
            ->get();
    }

    public function dayBalance()
    {
        $balance = $this->worked_time - 28800;
        $timeTotal = convertTimeToHour(abs($balance));
        $timeTotal = ($timeTotal === '00:00:00' ? 'positivo' : $timeTotal);
        $positiveNegative = $this->worked_time >= 28800 ? '+' : '-';
        return "{$positiveNegative}{$timeTotal}";
    }

    public function scopeUsersAbsent($query)
    {
        $allUsers = $query->where('work_date', date('Y-m-d'))
                    ->where('time_1','!=',null)->get();

        if($allUsers->count() == 0){
           $usersAbsent = User::all();
        }

        foreach ($allUsers as $user) {
            $arrAbsent[] = $user->user_id;
            $usersAbsent = User::whereNotIn('id', $arrAbsent)->get();
        }

        return $usersAbsent;
    }

    public function scopeSumWorkedTime($query)
    {

        $timeTotal = $query->whereMonth('work_date', date('m'))->sum('worked_time');

       return convertTimeToHour($timeTotal);

    }

}
