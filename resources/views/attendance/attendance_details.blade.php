@extends('admin.layouts.app')

@section('title')
    Attendance Deatails
@endsection

@section('dashboard')
    Attendance Deatails
@endsection

@section('my-style')
@endsection


@section('content')
   
        <div class="container">
            {{-- start success /error messages --}}
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
            {{-- end success error messags --}}
           <a href="{{ route('manual-attendance.activeProjects',$project['id']) }}" class="btn btn-primary mb-3" style="width: 80px;">بازگشت</a>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">لیست فعالیت های کاربر 
                    :  {{$user['first_name']}}  {{$user['last_name']}}  {{$project['title']}}</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="user-table" class=" user-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">عنوان پروژه</th>
                                <th scope="col"و>تاریخ فعالیت</th>
                                <th scope="col">ساعت شروع پایان</th>
                                <th scope="col">ساعت پایان</th>
                                <th scope="col">زمان صرف شده/ساعت</th>
                                <th scope="col">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendance as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->projectTitle }}</td>
                                    <td>{{ $item->work_date }}</td>
                                    <td>{{ $item->start_time }}</td>
                                    <td>{{ $item->end_time }}</td>
                                    <td>{{ $item->total_time }}</td>
                                    <td>
                                        <a href="{{url('attendance_edit/details/'.$item->id)}}">edit</a>
                                        {{ $item->id }}
                                    </td>
                                </tr>
                            @endforeach

                        <tbody>


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        </div>

  

    </div>



    </div>


@endsection

@section('script')
@endsection
