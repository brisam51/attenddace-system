@extends('admin.layouts.app')

@section('title')
    New Attendance
@endsection
@section('dashboard')
    ثبت حضور و غیاب جدید
@endsection
@section('my-style')
    <script></script>
@endsection
@section('content')
    <div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

    </div>
    <div class="card">
        <div class="card-header">
            <a href="{{route('manual-attendance.details',['project_id'=>$project_id,'user_id'=>$user_id,'task_id'=>$task_id])}}" class="btn btn-primary" onclick="history.back()" style="width:120px; "> بازگشت</a>
        </div>
        <div class="card-body">
            <form action="{{ route('manual-attendance.createManualAttendance') }}" method="POST">
                @csrf
                <input type="text" name="project_id" id="project_id" class="form-control" value="{{ $project_id }}"
                    hidden>
                <input type="text" name="user_id" id="user_id" class="form-control" value="{{ $user_id }}" hidden>
                <input type="text" name="task_id" id="task_id" class="form-control" value="{{ $user_id }}" hidden>
                <div class="form-group">
                    <label for="work_date">تاریخ:</label>
                    <input id="work_date" type="text" name="work_date" class="form-control"
                        value="{{ old('work_date') }}">
                    @error('work_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="start_time">زمان شروع</label>
                    <input id="start_time" type="text" name="start_time" class="form-control"
                        value="{{ old('start_time') }}" placeholder="لطفا زمان شروع را وارد کنید">
                    @error('start_time')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end_time">زمان پایان</label>
                    <input id="end_time" type="text" name="end_time" class="form-control" value="{{ old('end_time') }}"
                        placeholder="لطفا زمان پایان را وارد کنید">
                    @error('end_time')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary px-4">ذخیره</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
