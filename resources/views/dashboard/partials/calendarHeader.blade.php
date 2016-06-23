<div class="row date-buffer">
    <div class="col-md-1 text-center arrow">
        <a href="{{ route($route, ['month' => $calendar['prevMonth'], 'year' => $calendar['prevYear']]) }}"><h2 class="glyphicon glyphicon-arrow-left" aria-hidden="true"></h2></a>
    </div>
    <div class="col-md-10 text-center">
        <h2>{{ $calendar['monthAndYear'] }}</h2>
    </div>
    <div class="col-md-1 text-center arrow">
        <a href="{{ route($route, ['month' => $calendar['nextMonth'], 'year' => $calendar['nextYear']]) }}"><h2 class="glyphicon glyphicon-arrow-right" aria-hidden="true"></h2></a>
    </div>
</div>