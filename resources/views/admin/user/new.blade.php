@extends('admin.layouts.app')

@section('title')
    ثبت کاربر جدید
@endsection
@section('dashboard')
    مدیریت کاربران
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
    <div class="alert alert-success">
        {{ session('error') }}
    </div>

@endif

</div>
    <h3>ثبت کاربر جدید</h3>

    <form action="{{ url('user/store') }}" method="POST"   enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">نام:</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}">
                    @error('first_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">نام و خانوادگی </label>
                    <input type="text" name="last_name" class="form-control"   value="{{ old('last_name') }}">
                   @error('last_name')
                       <span class="text-danger">{{ $message }}</span>
                   @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">شماره ملی</label>
                <input type="text" name="national_id" class="form-control  " value="{{ old('national_id') }}">
                @error('national_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">شماره پرسنلی</label>
                <input type="text" name="card_id" class="form-control" value="{{ old('card_id') }}">
                @error('card_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group ">
                    <label for="inputGroupSelect01">تاریخ تولد</label>
                    <input type="text" name="birth_date" class="form-control birthdate"
                        value="{{ old('birth_date') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">وضعیت فعالیتی</label>
                    <select name="work_status" class="form-control">
                        <option value="active" {{ old('work_status') == 'active' ? 'selected' : '' }}>فعال</option>
                        <option value="inactive" {{ old('work_status') == 'inactive' ? 'selected' : '' }}>غیرفعال</option>
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
                <input type="text" name="email"     class="form-control"  value="{{ old('email') }}"  >
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
                <select class="form-control" name="role">
                    <option selected>انتخاب نقش</option>
                    <option value="supperadmin" {{ old('role') == 'supperadmin' ? 'selected' : '' }}  >مدیر ارشد</option>
                    <option value="admin"   {{ old('role') =='admin' ? 'selected' : '' }}>مدیر پروژه</option>
                    <option value="user"  {{ old('role') == 'user' ? 'selected' : '' }} >کارمند </option>
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

            <img src="#"  class="user-image image-preview" alt="no imag4">
        </div>


    </div>

    <button type="submit" class="btn btn-primary">ذخیره</button>
</form>
@endsection

@section('scripts')
@endsection
