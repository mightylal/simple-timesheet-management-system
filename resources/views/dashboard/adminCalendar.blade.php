@extends('dashboard.master')

@section('content')

    <div id="content-container">
        <div class="container">
            @include('dashboard.partials.calendarHeader', ['route' => 'admin.overview'])
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
                                        <td class="day-cell">
                                            <div>{{ $i - $calendar['dayOfTheWeek'] }}</div>
                                            @if (isset($calendar['time'][$i - $calendar['dayOfTheWeek']]) && is_array($calendar['time'][$i - $calendar['dayOfTheWeek']]))
                                                @foreach ($calendar['time'][$i - $calendar['dayOfTheWeek']] as $time)
                                                    <div>
                                                        <span class="label label-info">{{ $time['username'] }}</span>
                                                        <small>{{ $time['regularHours'] }} reg., {{ $time['overtimeHours'] }} ovr.</small>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </td>
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