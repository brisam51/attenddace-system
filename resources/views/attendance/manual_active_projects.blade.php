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
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex flex-row space-x-4 align-items-start">
                <div class="col-8">
                    <a href="{{route('manual-attendance.activeUsers')}}" class="btn btn-primary"  style="width: 100px; height: 40px; font-size: 15px; margin-bottom: 10px; margin-left: 10px;">بازگشت</a>
                </div>
                <div class="col-12">
                  
                    <span  class="text-center" style="font-size:20px;"> لیست پروژه های فعال : <strong>{{$user->first_name}}  {{$user->last_name}}</strong></span>
                </div>
               
               
            </div>
            
                 

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
                            <th scope="col"> عنوان شغل</th>
                            <th scope="col">جزییات فعالیت ها</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($projects as $value)
                          <tr>
                          <td>{{$loop->iteration}}</td>
                            <td>{{$value['title']}}</td>
                          <td>project-codw</td>
                          <td>{{$value['taskTitle']}}</td>
                         <td>
                            <a href="{{route('manual-attendance.details',['project_id'=>$value['id'],'task_id'=>$value['taskId'],'user_id'=>$value['userId']])}}" class="btn btn-primary">فعالیت</a> 
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
