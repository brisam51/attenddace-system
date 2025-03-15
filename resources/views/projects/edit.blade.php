@extends('admin.layouts.app')

@section('title')
بروزرسانی پروژه
@endsection

@section('dashboard')
بروز رسانی پروژه
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
            <form action="{{ route('projects.update',$project->id) }}" method="post"   enctype="multipart/form-data">
                @csrf
              
                <div class="row">
                  
                        <div class="form-group">
                            <label for="exampleInputEmail1">نام پروژه:</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title',$project->title) }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> تاریخ شروع </label>
                            <input type="text" name="start_date" class="form-control persian-date"   value="{{  $project->start_date}}">    
                           @error('start_date') 
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> تاریخ پایان</label>
                        <input type="text" name="end_date" class="form-control persian-date" value="{{  $project->end_date  }}">
                        @error('end_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> شرح پروژه</label>
                        <input type="text" name="description" class="form-control" value="{{ old('description', $project->description   ) }}">
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                                          
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> وضعیت پروژه</label>
                        <select name="status" class="form-control">
                            <option {{ old('status', $project->status   ) == 0 ? 'selected' : '' }} value="0">در حال انجام</option>
                            <option {{ old('status', $project->status   ) == 1 ? 'selected' : '' }} value="1">پایان یافته</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">    
                             </select>
                     
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror       
        
            </div>
        
            <button type="submit" class="btn btn-primary" style="width: 100px; float: right;">بروز رسانی</button>    
        </form>
        </div>
        <div class="card-footer">
            
        </div>
    </div>
    




</div>


@endsection

@section('script')

@endsection
