@extends('admin.layouts.app')

@section('title')
    بروز رسانی اطلاعات کاربر
@endsection
@section('dashboard')
    مدیریت کاربران
@endsection
@section('my-style')
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-title"> <a href="{{ url('user/index') }}" class="btn btn-primary" style="width:80px;">باز
                            گشت</a> </div>
                </div>
                <div class="col-md-6">
                    <h2 class="card-title">بروز رسانی اطلاعات کاربر</h2>
                </div>

            </div>
            <div class="card-body">
                <form action="{{ url('user/update/' . $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">نام:</label>
                                <input type="text" name="first_name" class="form-control"
                                    value="{{ old('first_name', $user->first_name) }}">
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">نام و خانوادگی </label>
                                <input type="text" name="last_name" class="form-control"
                                    value="{{ old('last_name', $user->last_name) }}">
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">شماره ملی</label>
                                <input type="text" name="national_id" class="form-control input-form"
                                    value="{{ old('national_id', $user->national_id) }}">
                                @error('national_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">شماره پرسنلی</label>
                                <input type="text" name="card_id" class="form-control input-form"
                                    value="{{ old('card_id', $user->card_id) }}">
                                @error('card_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <div class="form-group ">
                                    <label class="birth_date-lable" for="inputGroupSelect01">تاریخ
                                        تولد:{{ $birth_date }}</label>
                                    <input type="text" name="birth_date" class="form-control birthdate"
                                        value="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">وضعیت فعالیتی</label>
                                    <select class="form-control" id="work_status" name="work_status">
                                        <option value="">--Select work status--</option>
                                        @foreach ($status as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ old('work_status', $user['work_status']) == $value ? 'selected' : '' }}>
                                                {{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('work_status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Start second column --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">ایمیل</label>
                                <input type="text" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">پسورد</label>
                                <input type="text" name="password" class="form-control">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <label for="inputGroupSelect01">نقش</label>
                                <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="">--Select Role--</option>
                                @foreach ($roles as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ old('role', $user['role']) == $value ? 'selected' : '' }}>{{ $label }}
                                    </option>
                                @endforeach
                            </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <label>تصویر</label>
                                <input  type="file" name="image" class="form-control image-upload">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <img src="{{ asset('assets/images/' . $user->image) }}" class="user-image" alt="no image">
                            <img src="#"  class="user-image image-preview" alt="">
                        </div>


                    </div>

                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </form>
            @endsection

            @section('scripts')
            @endsection
