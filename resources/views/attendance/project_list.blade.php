@extends('admin.layouts.app')

@section('title')
project list
@endsection

@section('dashboard')
project list
@endsection

@section('my-style')

@endsection


@section('content')

   
        
        <div class="flash-messages">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
     <div class="card">
        <div class="card-header">
<a href="#" class="btn btn-primary" onclick="window.history.back();">Back</a>
        </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="user-table" class=" user-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">عنوان پروژه</th>
                            <th scope="col">کد پروژه</th>
                            <th scope="col">تاریخ شروع</th>
                            <th scope="col">تاریخ پایان</th>
                            <th scope="col">وضعیت</th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($projects as $project)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$project->title}}</td>
                            <td>{{$project->code}}</td>
                            <td>{{$project->start_date}}</td>
                            <td>{{$project->end_date}}</td>
                            <td>{{$project->status}}
                            <td>
                                <a href="{{route('manual-attendance.details',['project_id'=>$project->id,'user_id'=>$user_id])}}">نمایش</a>
                            </td>
                          </tr>
                       @endforeach
                   
                    <tbody>
                       

                    </tbody>
                </table>

            </div>
        </div>
     </div>
       
    
  
   
       







@endsection

@section('script')

@endsection
