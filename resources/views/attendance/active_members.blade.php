@extends('admin.layouts.app')

@section('title')
Active Members
@endsection

@section('dashboard')
Active Members
@endsection

@section('my-style')

@endsection


@section('content')
<div class="jumbotron shade pt-2 pb-3">
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
        <div class="card-body">
            <div class="table-responsive">
                <table id="user-table" class=" user-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">تصویر</th>
                            <th scope="col">نام</th>
                            <th scope="col">نام و نام خانوادگی</th>
                            <th scope="col">کدملی</th>
                            <th scope="col">پروژه</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activeUsers as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                           <td><img src="{{ asset('assets/images/' . $value->image) }}" class="user-image" alt="No Image"></td>
                            <td>{{$value->first_name}}</td>
                            <td>{{$value->last_name}}</td>
                            <td>{{\App\Helpers\NumberConverter::englishToPersianNumber($value->national_id)}}</td>
                            <td>
                                <a href="{{url('manual/attendance/getActiveProjects/'.$value->id)}}"  class="btn btn-success">Active Project</a>
                            </td>
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
