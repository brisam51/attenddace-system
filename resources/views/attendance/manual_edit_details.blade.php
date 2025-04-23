@extends('admin.layouts.app')

@section('title')
Update Attendance
@endsection
@section('dashboard')
Update Attendance 
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
        <a href="{{route("manual-attendance.activeProjects",$attendance['userId'])}}" class="btn btn-primary" style="width: 100px; float: right; margin: 5px;" >بازگشت</a>
    </div>
    <div class="card-body">
        <form  action="{{route('attendance-details.update',$attendance['id'])}}"  method="POST" >
            @csrf
            
            <div class="form-group">
                <label for="work_date">تاریخ:</label>
                <input id="work_date"  type="text" name="work_date" class="form-control" value="{{ $attendance['work_date']}}">
                @error('work_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="start_time">زمان شروع</label>
                <input id="start_time"  type="text" name="start_time" class="form-control" value="{{  $attendance['start_time']}}" placeholder="لطفا زمان شروع را وارد کنید">
                @error('start_time')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="end_time">زمان پایان</label>
                <input id="end_time"  type="text" name="end_time" class="form-control" value="{{ $attendance['end_time'] }}" placeholder="لطفا زمان پایان را وارد کنید">
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

