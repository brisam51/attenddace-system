@extends('admin.layouts.app')

@section('title')
    حضور و غیاب دستی کاربران
@endsection

@section('dashboard')
    حضور وغیاب دستی کار بران
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
            
            <div  class="d-flex justify-content-between align-items-center" style="margin: 10px;">
                          
                    <a href="#" class="btn btn-primary" style="width: 80px;">جدید</a>
                
                       
               
                    <h3 class="text-center flex-grow-1">   حضور و غیاب دستی</h3>
               
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="user-table" class=" user-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">نام پروژه</th>
                            <th scope="col">تعداد اعضاء </th>
                            
                          
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activeProjects as $item)
                        <tr>
                           <td>{{ $loop->iteration }}</td>  
                           <td>
                            <div class="d-flex align-items-center space-y-2">
                               
                               <div class="col">
                                {{ $item->title }}
                               </div>
                               <div class="col">
                                <a href="{{ url('manual/attendance/members/'.$item->id) }}" class="btn btn-primary text-center"> حضورو غیاب جدید</a>
                               </div>
                               <div class="col">
                                <a href="{{ url('manual/attendance/edit/'.$item->id) }}" class="btn btn-info text-center">بروز رسانی</a>
                               </div>
                               <div class="col">
                                <a href="{{ url('manual/attendance/members/'.$item->id) }}" class="btn btn-danger text-center">حذف</a>
                               </div>
                               
                            </div>
                          
                           
                           
                                                     
                        </td>
                           <td>{{ $item->users->count()}}</td>
                           <td></td>
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
