@extends('admin.layouts.app')

@section('title')
    
@endsection
@section('dashboard')
   
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
    <h3>   : {{ $project->title }}</h3>
    <form  id="manual_attendance_form"   >
        @csrf
        <div class="form-group">
            <input  id="project_id" class="form-control" type="hidden" name="project_id" value="{{ $project->id }}">
        </div>
        
        <div class="container-fluid">
            <div class="row justify-content-center mb-4">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="work_date">تاریخ:</label>
                        <input id="work_date"  type="text" name="work_date" class="form-control" value="{{ old('work_date') }}">
                        @error('work_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="start_time">زمان شروع</label>
                        <input id="start_time"  type="text" name="start_time" class="form-control" value="{{ old('start_time') }}" placeholder="لطفا زمان شروع را وارد کنید">
                        @error('start_time')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="end_time">زمان پایان</label>
                        <input id="end_time"  type="text" name="end_time" class="form-control" value="{{ old('end_time') }}" placeholder="لطفا زمان پایان را وارد کنید">
                        @error('end_time')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <label for="list_users">لیست کاربران</label>
                        <div class="table-responsive">
                            <table id="manual_attendance_table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">ردیف</th>
                                        <th scope="col">انتخاب</th>
                                        <th scope="col">نام</th>
                                        <th scope="col">نام خانوادگی</th>
                                        <th scope="col">کد ملی</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($members as $member)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><input type="checkbox" name="user_ids[]" value="{{ $member->id }}"></td>
                                            <td>{{ $member->first_name }}</td>
                                            <td>{{ $member->last_name }}</td>
                                            <td>{{ $member->national_id }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary px-4">ذخیره</button>
                </div>
            </div>
        </div>
    </form>
@endsection

