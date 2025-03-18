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
            <div style="width: 100px; float: right">
                <a href="{{ route('projects.create') }} " class="btn btn-outline-primary">جدید</a>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="user-table" class=" user-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">نام پروژه</th>
                            <th scope="col">تاریخ شروع </th>
                            <th scope="col"> تاریخ پایان</th>
                            <th scope="col"> شرح پروژه </th>
                            <th scope="col"> وضعیت پروژه </th>
                            <th scope="col"> عملیات</th>
                            <th scope="col">اعضای پروژه</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allRecords as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $value->title }}</td>
                                <td class="start_date">
                                    @php
                                        //convert gregorian date to persian date by help og jalali calander
                                        $jalaliDate = \Morilog\Jalali\Jalalian::fromDateTime($value->start_date);
                                        echo $jalaliDate->format('Y/m/d');
                                    @endphp

                                <td class="end_date"> @php
                                    //convert gregorian date to persian date by help og jalali calander
                                    $jalaliDate = \Morilog\Jalali\Jalalian::fromDateTime($value->end_date);
                                    echo $jalaliDate->format('Y/m/d');
                                @endphp
                                </td>
                                <td>{{ $value->description }}</td>
                                <td>
                                    @if ($value->status == '0')
                                        درحال انجام
                                    @else
                                        پایان یافته
                                    @endif
                                </td>


                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('projects.edit', $value->id) }}"
                                            class="btn btn-warning">ویرایش</a>
                                        <a href="{{ route('projects.delete', $value->id) }}" class="btn btn-danger">حذف</a>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('projects.members', $value->id) }}" class="btn btn-primary">اعضای
                                        پروژه</a>
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
