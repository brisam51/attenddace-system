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
                    <a href="{{ url('user/new') }}" class="btn btn-primary" style="display:block; width:80px;"> جدید</a>
                </div>
                <div class="col user-header">
                    <h3>لیست کاربران</h3>
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
                            <th scope="col">شماره پرسنلی </th>
                            <th scope="col">تاریخ تولد </th>
                            <th scope="col"> نقش</th>
                            <th scope="col"> وضعیت شغلی</th>
                            <th scope="col"> ایمیل </th>
                            <th scope="col">عملیات</th>
                            <th scope="col">جزییات بیشتر</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ url('/' . $user->image) }}" class="user-image" alt="No Image"></td>
                                <td class="user-first-name">{{ $user->first_name }}</td>
                                <td class="user-last-name">{{ $user->last_name }}</td>
                                <td class="national-id">{{ $user->national_id }}</td>
                                <td class="card-id">{{ $user->card_id }}</td>
                                <td class="birth-date">
                                    @php
                                        //convert gregorian date to persian date by help og jalali calander
                                        $jalaliDate = \Morilog\Jalali\Jalalian::fromDateTime($user->birth_date);
                                        echo $jalaliDate->format('Y/m/d');
                                    @endphp
                                </td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->work_status }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="col">
                                        <div class="row">
                                            <a href="{{ url('user/edit/' . $user->id) }}" class="link link-green">بروز
                                                رسانی</a>
                                        </div>
                                        <div class="mt-2 row">
                                            <a href="{{ url('user/delete/' . $user->id) }}" class="link link-red">حذف</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col">
                                        <div class="row ">
                                            <a href="#" data-id="{{ $user->id }}"
                                                class="link link-blue user-address">اطلاعات تماس</a>
                                            {{-- {{ url('user/address/edit/'. $user->id) }} --}}
                                        </div>
                                        <div class="mt-2 row">
                                            <a href="#" data-id="{{ $user->id }}"   class="link link-yellow bank_info_link">اطلاعات بانکی
                                            </a>
                                        </div>
                                        <div class="mt-2 row">
                                            <a href="http://" class="link link-gray">اطلاعات شغلی</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                </table>

            </div>
        </div>
    </div>
    {{-- Start Addres Modal --}}

    <div id="address-modal" class="modal " tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <img id="modal-user-image" src="" class="user-image" alt="User Image">
                        <div id="modal-user-name" class="modal-title"></div>
                    </div>
                </div>
                <div class="modal-body">
                    {{-- Start address form --}}
                    <form id="address-form">
                        <div class="form-group">
                            <input type="text" hidden class="form-control" name="" id="address-id">
                        </div>

                        <span id="user_id_error" class="error-message text-danger"></span>
                        <div class="form-group">
                            <label for="">موبایل</label>
                            <input type="text" class="form-control" id="form-mobile" name="mobile">
                            <span id="mobile_error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="">تلفن</label>
                            <input type="text" class="form-control" id="form-phone" name="phone">
                            <span id="phone_error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="">آدرس</label>
                            <textarea id="form-address" class="form-control" placeholder="Address"></textarea>
                            <span id="address_error" class="error-message"></span>
                        </div>
                        <button id="save-button" type="submit" class="btn btn-primary"></button>

                    </form>
                    {{-- End address form --}}

                </div>
                <div class="modal-footer">
                    <button id="close-amodal" type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">بستن</button>


                </div>
            </div>
        </div>
    </div>
    {{-- End Address Modal --}}


{{-- ========================================================================= --}}
 {{-- Start bank info modal --}}
    <div id="bank-user-modal" class="modal " tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <img id="user-image" src="" class="user-image" alt="User Image">
                        <div id="user-info" class="modal-title"></div>
                    </div>
                </div>
                <div class="modal-body">
                    {{-- Start address form --}}
                    <form id="bank-info-form">
                        <div class="form-group">
                            <input type="text" hidden class="form-control" name="bank-id" id="bank-id">
                            <span id="bank_id_error" class="error-message text-danger"></span>
                        </div>
                        <div class="form-group">
                            <input type="text"  hidden class="form-control" name="bank-id" id="bank-id">
                            <span id="bank_id_error" class="error-message text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label for="">شماره حساب:</label>
                            <input type="text" class="form-control" id="account_number" name="">
                            <span id="accuont_number_error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="">نام بانک:</label>
                            <input type="text" class="form-control" id="bank_name" name="">
                            <span id="bank_name_error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="">شماره شبا</label>
                            <input type="text" class="form-control" id="shaba_number" name="">
                            <span id="shaba_number_error" class="error-message"></span>
                        </div>
                        <button id="save-bank-button" type="submit" class="btn btn-primary">ذخیره</button>

                    </form>
                    {{-- End address form --}}

                </div>
                <div class="modal-footer">
                    <button id="close-bank-amodal" type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">بستن</button>


                </div>
            </div>
        </div>
    </div>
    {{-- Start bank info modal --}}

    {{-- End bank info modal --}}
@endsection
@section('scripts')
@endsection
