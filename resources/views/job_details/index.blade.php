@extends('admin.layouts.app')

@section('title')
    مدیریت عناوین شغلی
@endsection

@section('main-header')
   مدیریت عناوین شغلی
@endsection


@section('content')
    <div class="card" style="width: 100%;">
        <div class="card-heder">
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="row">
                <div class="col" style="margin:10px;">
                    <a href="{{ route('create.job') }}" class="btn btn-primary"
                        style="display:block; width:80px;"> جدید</a>
                </div>
                <div class="col user-header">
                    <h3>لیست  عناوین مشاغل</h3>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="user-table" class=" user-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">عنوان شغل</th>
                            <th scope="col">کد شغل</th>
                            <th scope="col"> (ریال)دستمزد-ساعت </th>
                            <th scope="col">شرح شغل</th>
                            <th scope="col">عملیات</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $job['job_title']}}</td>
                            <td class="job_code">{{ $job['job_code'] }}</td>
                            <td class=job-hourly-wages  >{{ $job['hourly_wages'] }} ریال</td>
                            <td>{{ $job['job_description'] }}</td>
                            <td>
                                <div class="gap-2 d-flex">
                                    <a href="{{ route('edit.job', $job->id) }}" class="btn btn-primary"
                                        <i class="fa fa-edit"></i> ویرایش</a>
                                        <a href="{{ route('delete.job', $job->id) }}" class="btn btn-danger"
                                            <i class="fa fa-edit"></i> حذف</a>
                                </div>
                                
                            </td>
                                
                        </tr>
                        @endforeach
                       
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    {{-- Start Addres Modal --}}
@endsection
@section('scripts')
@endsection
