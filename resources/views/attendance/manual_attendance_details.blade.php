@extends('admin.layouts.app')

@section('title')
    Attendance Deatails
@endsection

@section('dashboard')
@endsection

@section('my-style')
@endsection


@section('content')

    <div class="container">
        {{-- start success /error messages --}}
        <div class="flash-messages">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">

                    {{ session('success') }}

                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">

                    {{ session('error') }}

                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">

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

            <div class="card-header row ">
                <div class="col ">
                    <a href="{{route('manual-attendance.activeProjects',$details->first()->userId)}}" class="btn btn-primary d-flext align-items-rigth" style=" width: 100px;">باز گشت</a>
                </div>
                <div class="col ">
                    <strong class="text-center" style="font-size: 20px;"> لیست فعالیتهای( {{ $details->first()->firstName }}
                        {{ $details->first()->lastName }} ) در پروژه:
                        {{ $details->first()->projectTitle }}</strong>
                </div>


            </div>
            <div>
                <a href="{{route("manual-attendance.addForm",
                [
                    'user_id' => $details->first()->userId,
                    'project_id' => $details->first()->projectId,
                    'task_id' => $details->first()->taskId,
                ]
                )}}"
                 class="btn btn-success d-flext align-items-rigth" style=" width: 100px; margin:10px;"> جدید</a>
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table id="user-table" class=" user-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام پروژه</th>
                                <th scope="col">شغل</th>
                                <th scope="col"> ساعت ورود </th>
                                <th scope="col">ساعت خروج</th>
                                <th scope="col">مجموع ساعات</th>
                                <th scope="col">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value['projectTitle'] }}</td>
                                    <td>{{ $value['taskTitle'] }}</td>
                                    <td>{{ $value['start_time'] }}</td>
                                    <td>{{ $value['end_time'] }}</td>
                                    <td>{{ $value['total_time'] }}</td>
                                    <td>opration</td>
                                </tr>
                            @endforeach

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
