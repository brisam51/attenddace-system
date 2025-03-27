@extends('admin.layouts.app')

@section('title')
بروز رسانی اعضای تیم
@endsection

@section('dashboard')
روز رسانی اعضای تیم
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
                    <a href="{{ route('projects.members', $member->project_id) }}" class="btn btn-outline-primary">بازگشت</a>
                </div>
            </div>
            <div class="card-body">
               
                <form action="{{ route('project-member.update', $member->id ) }}" method="POST" enctype="multipart/form-data">  
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <input type="text" name="project_id"  value="{{ $member->project_id }}" hidden  class="form-control">
                            @error('project_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> نام   </label>
                            <input type="text"   readonly value="{{ $member['firstName'] }}" class="form-control">
                            
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">  نام خانوادگی </label>
                            <input type="text"   readonly value="{{ $member['lastName'] }}" class="form-control">
                            
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> عنوان شغلی </label>
                            <select name="task_id" id="task_id" class="form-control">
                                <option value=""> انتخاب شغل</option>
                                @foreach ($tasks as $value )
                                    <option value="{{ $value->id }}"
                                        {{ isset($member['task_id']) && $member['task_id'] == $value->id ? 'selected' : ''}}
                                        >{{ $value->title  }}</option>
                                @endforeach
                                                           </select>
                            @error('task_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> تصویر قرارداد</label>
                            <input type="file" name="file_contract" class="form-control persian-date">
                            
                            <img src="{{ asset('assets/images/' . $member->file_contract) }}" class="user-image" alt="no image">
                            <img src="#"  class="user-image image-preview" alt="">
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
