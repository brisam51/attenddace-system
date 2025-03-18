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
                <a href="{{ route('all.jobs') }} " class="btn btn-outline-primary">بازگشت</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('update.job', $jobs->id) }}" method="POST"   enctype="multipart/form-data">
                @csrf
                <div class="row">
                  {{--  'hourly_wages','job_code','job_title','job_description' --}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">عنوان شغل :</label>
                            <input type="text" name="job_title" class="form-control" value="{{ old('job_title',$jobs->job_title) }}" id="exampleInputEmail1" aria-describedby="emailHelp">  
                            @error('job_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> کد شغل :</label>
                            <input type="text" name="job_code" class="form-control "   value="{{ old('job_code',$jobs->job_code) }}">    
                           @error('job_code') 
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> دستمزد ساعت </label>
                        <input type="text" name="hourly_wages" class="form-control " value="{{ old('hourly_wages',$jobs->hourly_wages) }}" >
                        @error('hourly_wages')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> شرح شغل:</label>
                        <input type="text" name="job_description" class="form-control" value="{{ old('job_description',$jobs->job_description) }}">
                        @error('job_description')
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
