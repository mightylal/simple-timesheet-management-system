@extends('dashboard.master')

@section('styles')

    <link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.css') }}">

@endsection

@section('content')

    <div class="container-buffer"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Generate Employee Report</h2>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            <form action="{{ url('admin/reports/generate') }}" method="POST">
                                {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="employee">Employee</label>
                                    <select id="employee" name="employee" size="1" class="form-control">
                                        <option value="0">All</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee['id'] }}">{{ $employee['username'] }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="startDate">Start Date</label>
                                <input type="text" name="startDate" id="startDate" class="form-control">
                            </div>
                                <div class="form-group">
                                    <label for="endDate">End Date</label>
                                    <input type="text" name="endDate" id="endDate" class="form-control">
                                </div>
                            <button type="submit" class="btn btn-primary">Generate</button>
                            </form>
                        </div>
                    </div>
                </div>
                @if (isset($results))
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Employee Wages</h2>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Date</th>
                                        <th>Regular Hours</th>
                                        <th>Overtime Hours</th>
                                        <th>Regular Wage</th>
                                        <th>Overtime Wage</th>
                                        <th>Total Wage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results['entries'] as $result)
                                        <tr>
                                            <td>{{ $result->username }}</td>
                                            <td>{{ $result->workDate }}</td>
                                            <td>{{ $result->regularHours }}</td>
                                            <td>{{ $result->overtimeHours }}</td>
                                            <td>{{ $result->regularWage }} <em>({{ $result->regularRate }}/hr)</em></td>
                                            <td>{{ $result->overtimeWage }} <em>({{ $result->overtimeRate }}/hr)</em></td>
                                            <td>{{ $result->totalWage }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>{{ number_format($results['totals']['regularHoursTotal'], 2) }}</th>
                                        <th>{{ number_format($results['totals']['overtimeHoursTotal'], 2) }}</th>
                                        <th>${{ number_format($results['totals']['regularWageTotal'], 2) }}</th>
                                        <th>${{ number_format($results['totals']['overtimeWageTotal'], 2) }}</th>
                                        <th>${{ number_format($results['totals']['totalWageTotal'], 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container-buffer"></div>

@endsection

@section('scripts')

    <script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('js/generateReport.js') }}"></script>

@endsection