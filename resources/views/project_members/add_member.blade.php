@extends('admin.layouts.app')

@section('title')
    ثبت پروژه جدید
@endsection

@section('dashboard')
    ثبت پروژه جدید
@endsection

@section('my-style')
@endsection


@section('content')
    <div class="jumbotron shade pt-2 pb-3">
        <div class="card">
            <div class="card-header">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div style="width: 100px; float: right">
                    <a href="{{ route('projects.index') }} " class="btn btn-outline-primary">بازگشت</a>
                </div>
            </div>
            <div class="card-body">
               
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <input type="text" name="project_id" hidden value="project_id" class="form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> نام و نام خانوادگی </label>
                            <select name="status" class="form-control">
                                <option value="0">در حال انجام</option>
                                <option value="1">پایان یافته</option>
                            </select>
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> عنوان شغلی </label>
                            <select name="status" class="form-control">
                                <option value="0">در حال انجام</option>
                                <option value="1">پایان یافته</option>
                            </select>
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> تصویر قرارداد</label>
                            <input type="file" name="file_contract" class="form-control persian-date">
                            @error('file_contract')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        

                        <button type="submit" class="btn btn-primary" style="width: 100px; float: right;">ذخیره</button>
                </form>
            </div>
            <div class="card-footer">

            </div>
        </div>





    </div>
@endsection

@section('script')
@endsection
