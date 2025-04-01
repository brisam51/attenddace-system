@extends('admin.layouts.new')

@section('title')
    پروژه ها
@endsection

@section('dashboard')
@endsection

@section('my-style')
    <h2>لیست پروژ ها</h2>
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
        <div class="card-body">
            <div class="table-responsive">
                <table id="user-table" class=" user-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">نام پروژه</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activeProject as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="start-attendance " data-id="{{ $value['project_id'] }}"
                                    data-user={{ $user_id }}>
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col"> <a href="#" data-id="{{ $value['project_id'] }}"
                                                data-user="{{ $user_id }}" class="btn btn-primary start-time"
                                                style="width: 100p; float: right;">ورود </a>
                                        </div>
                                        <div class="col">{{ $value['project_title'] }}</div>
                                        <div class="col"> <a href="#" data-id="{{ $value['project_id'] }}"
                                                data-user="{{ $user_id }}"
                                                class="btn btn-success text-center end-time"
                                                style="width:100px; float:left;">خروج</a>
                                        </div>


                                    </div>
                                </td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection

@section('script')
@endsection
