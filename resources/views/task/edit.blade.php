@extends('admin.layouts.app')

@section('title')
 بروز رسانی شغل فعلی  
@endsection

@section('dashboard')
 بروز رسانی شغل فعلی    
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
                <a href="{{ route('all.tasks') }} " class="btn btn-outline-primary">بازگشت</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('update.task', $tasks->id) }}" method="POST"   enctype="multipart/form-data">
                @csrf
                <div class="row">
                  {{--  'hourly_wages','task_code','task_title','task_description' --}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">عنوان شغل :</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title',$tasks->title) }}" id="exampleInputEmail1" aria-describedby="emailHelp">  
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> کد شغل :</label>
                            <input type="text" name="task_code" class="form-control "   value="{{ old('task_code',$tasks->task_code) }}">    
                           @error('task_code') 
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> دستمزد ساعت </label>
                        <input type="text" name="hourly_wage" class="form-control " value="{{ old('hourly_wage',$tasks->hourly_wage) }}" >
                        @error('hourly_wage')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> شرح شغل:</label>
                        <input type="text" name="description" class="form-control" value="{{ old('description',$tasks->description) }}">
                        @error('description')
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
