@extends('admin.layouts.app')

@section('title')
    نمایش همه کاربران
@endsection

@section('main-header')
    مدیریت کار بران
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
                    <a href="{{ route('project-member.create' ,$project_id)}}" class="btn btn-primary" style="display:block; width:80px;"> جدید</a>
                </div>
                <div class="col user-header">
                    <h3>لیست اعضای پروژه</h3>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="user-table" class=" user-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">تصویر</th>
                            <th scope="col">نام</th>
                            <th scope="col">نام خانوادگی</th>
                            <th scope="col">کد ملی</th>
                            <th scope="col">سمت شغلی  </th>
                            <th scope="col">قرارداد</th> </th>
                            <th scope="col">عملیات</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($members as  $member )
                      <td>{{ $loop->iteration }}</td>
                      <td><img src="{{ url('/' . $member['image']) }}" class="user-image" alt="No Image"></td>
                      <td>{{ $member->firstName }}</td>
                      <td>{{ $member->lastName }}</td>  
                      <td>{{ $member->nationalCode }}
                      <td>{{ $member->jobTitle }}</td>  
                      <td>{{$member->id}}</td>  
                     
                       <td>
                        <div class="d-flex gap-2">
                            <a href="{{ url('/project/member/edit/' .$member['id']) }}" class="btn btn-primary">ویرایش</a>
                            <a href="{{ url('/project/member/delete/'.$member['id']) }}" class="btn btn-danger">حذف</a>
                        </div>
                                              
                       </td>
                     
                      </tr>
                      </td>
                    
                          
                            
                          
                              
                            @endforeach
                        </tr>
                       
                      
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    {{-- Start Addres Modal --}}
@endsection
@section('scripts')
@endsection
