@extends('admin.layouts.app')

@section('title')
 اضافه کردن عضو جدید به پروژه 
@endsection

@section('dashboard')
اضافه کردن عضو جدید به پروژه
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
               
                <form action="{{ route('project-member.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <input type="text" name="project_id"  value="{{ $projectId}}" hidden  class="form-control">
                            @error('project_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> نام و نام خانوادگی </label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="0">انتخاب عضو جدید  </option>
                                @foreach ($members as $value )
                                    <option value="{{ $value->id }}">{{ $value->first_name }}  {{$value->last_name  }}</option>
                                @endforeach
                               
                            </select>
                            @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> عنوان شغلی </label>
                            <select name="task_id" id="task_id" class="form-control">
                                <option value=""> انتخاب شغل</option>
                                @foreach ($tasks as $value )
                                    <option value="{{ $value->id }}">{{ $value->title  }}</option>
                                @endforeach
                                                           </select>
                            @error('task_id')
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
