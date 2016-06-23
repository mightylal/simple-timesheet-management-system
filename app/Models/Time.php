<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    /**
     * Table name to be used.
     */
    protected $table = 'appTime';

    /**
     * Fillable attributes for mass assignment.
     */
    protected $fillable = ['user_id', 'regularHours', 'overtimeHours', 'workDate'];
    
    /**
     * Scope the model to retrieve the time entries given user, month, and year.
     *
     * @param $query
     * @param integer $user_id
     * @param integer $month
     * @param integer $year
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetByUserMonthAndYear($query, $user_id, $month, $year)
    {
        return $query->select('regularHours', 'overtimeHours', 'workDate')->where('user_id', $user_id)->whereMonth('workDate', '=', $month)->whereYear('workDate', '=', $year);
    }

    /**
     * Scope the model to retrieve the time entries given user and date.
     *
     * @param $query
     * @param integer $user_id
     * @param string $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetByUserAndDate($query, $user_id, $date)
    {
        return $query->select('regularHours', 'overtimeHours')->where('user_id', $user_id)->whereDate('workDate', '=', $date);
    }
}
