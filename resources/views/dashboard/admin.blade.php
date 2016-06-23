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
                    <h2 class="panel-title">Update Employee Time</h2>
                </div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <form action="{{ url('admin/updateHours') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="employee">Employee</label>
                                <select name="employee" id="employee" class="form-control">
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->username }}</option>
                                    @endforeach
                                </select>
                                <span id="employeeError" class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="workDate">Date</label>
                                <input id="workDate" type="text" class="form-control" name="workDate">
                                <span id="workDateError" class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="regularHours">Regular Hours</label>
                                <input id="regularHours" type="text" class="form-control" name="regularHours">
                            </div>
                            <div class="form-group">
                                <label for="overtimeHours">Overtime Hours</label>
                                <input type="text" id="overtimeHours" class="form-control" name="overtimeHours">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Add New Employee</h2>
                </div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <form action="{{ url('admin/createUser') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="username" class="control-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" />
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <label for="regularRate">Regular Rate</label>
                                <input type="text" class="form-control" id="regularRate" name="regularRate" placeholder="Regular Rate">
                            </div>
                            <div class="form-group">
                                <label for="overtimeRate">Overtime Rate</label>
                                <input type="text" class="form-control" id="overtimeRate" name="overtimeRate" placeholder="Overtime Rate">
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Update Employee Rate(s)</h2>
                </div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <form action="{{ url('admin/updateRates') }}" method="POST" id="employeeUpdate">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="employeeRateId">Employee</label>
                                <select name="employee" id="employeeRateId" class="form-control">
                                    <option value="0">SELECT</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="regularRate">Regular Rate</label>
                                <input type="text" name="regularRate" class="form-control" id="regularRate">
                            </div>
                            <div class="form-group">
                                <label for="overtimeRate">Overtime Rate</label>
                                <input type="text" name="overtimeRate" class="form-control" id="overtimeRate">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

    <script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('js/scheduleTime.js') }}"></script>
    <script src="{{ asset('js/updateEmployee.js') }}"></script>
    <script src="{{ asset('js/updateTime.js') }}"></script>

@endsection