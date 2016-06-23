@extends('dashboard.master')

@section('content')

    <div id="content-container">
        <div class="container">
            @include('dashboard.partials.calendarHeader', ['route' => 'dashboard'])
            <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="table-responsive">
                    <table id="calendar">
                        <tr>
                            <th>Sunday</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                        </tr>
                        @for ($i = 1; $i <= $calendar['loop']; $i++)
                            @if ($i === 1 || ($i % 7 === 1))
                                <tr>
                            @endif
                            @if ($i <= $calendar['dayOfTheWeek'])
                                <td></td>
                            @else
                                <td class="day-cell" id="{{ $i }}" data-toggle="modal" data-target="#enterTime-{{ $i }}">
                                    <div>{{ $i - $calendar['dayOfTheWeek'] }}</div>
                                    @if (isset($calendar['time'][$i - $calendar['dayOfTheWeek']][0]['regularHours'], $calendar['time'][$i - $calendar['dayOfTheWeek']][0]['overtimeHours']))
                                        <div class="hours-container show">
                                            <span class="label label-primary">Regular Hours</span>
                                            <div class="regularHours">{{ $calendar['time'][$i - $calendar['dayOfTheWeek']][0]['regularHours'] }}</div>
                                            <input type="hidden" name="regularHoursReadOnly" value="{{ $calendar['time'][$i - $calendar['dayOfTheWeek']][0]['regularHours'] }}">
                                            <span class="label label-primary">Overtime Hours</span>
                                            <div class="overtimeHours">{{ $calendar['time'][$i - $calendar['dayOfTheWeek']][0]['overtimeHours'] }}</div>
                                            <input type="hidden" name="overtimeHoursReadOnly" value="{{ $calendar['time'][$i - $calendar['dayOfTheWeek']][0]['overtimeHours'] }}">
                                        </div>
                                    @else
                                        <div class="hours-container hide">
                                            <span class="label label-primary">Regular Hours</span>
                                            <div class="regularHours"></div>
                                            <input type="hidden" name="regularHoursReadOnly" value="">
                                            <span class="label label-primary">Overtime Hours</span>
                                            <div class="overtimeHours"></div>
                                            <input type="hidden" name="overtimeHoursReadOnly" value="">
                                        </div>
                                    @endif
                                </td>
                                <div class="modal fade" id="enterTime-{{ $i }}" data-day-id="{{ $i }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Enter Time</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="enterTimeError"></div>
                                                <div class="form-group">
                                                    <label for="regularHours">Regular Hours</label>
                                                    <input type="text" id="regularHours" name="regularHours" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="overtimeHours">Overtime Hours</label>
                                                    <input type="text" id="overtimeHours" name="overtimeHours" class="form-control">
                                                </div>
                                                <input type="hidden" name="month" value="{{ $calendar['month'] }}">
                                                <input type="hidden" name="day" value="{{ $i - $calendar['dayOfTheWeek'] }}">
                                                <input type="hidden" name="year" value="{{ $calendar['year'] }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary save-time">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (($i % 7 === 0) || $i === $calendar['loop'])
                                </tr>
                            @endif
                        @endfor
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class='container-buffer'></div>

@endsection