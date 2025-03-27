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
        <div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('success') }}
                </div>
            @endif


        </div>
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
                                <td class="start-attendance "
                                data-id="{{ $value['project_id'] }}"
                                data-user={{ $user_id }}
                                >{{ $value['project_title'] }}

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
