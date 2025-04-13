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
                                <td><img src="{{ asset('assets/images/' . $user->image) }}" class="user-image" alt="No Image"></td>
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
                                <td>
                                    @if ($user->role == 'admin')
                                        مدیرپروژه
                                    @elseif ($user->role == 'user')
                                        کاربر
                                        @elseif ($user->role == 'supperadmin')
                                        مدیر ارشد
                                    @endif
                                </td>
                                <td>
                                    @if ($user->work_status == 'active')
                                        <span class="badge badge-success">فعال</span>
                                    @elseif ($user->work_status == 'inactive')
                                        <span class="badge badge-danger">غیرفعال
                                        
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="col">
                                        <div class="row">
                                            <a href="{{ url('user/edit/' . $user->id) }}" class="link link-green">
                                                اصلاح</a>
                                        </div>
                                        <div class="mt-2 row">
                                            <a href="{{ url('user/delete/' . $user->id) }}" class="link link-red">حذف</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                       <a href="#" data-id="{{$user->id }}"  class="user-address"><i class="fa fa-phone mr-2" aria-hidden="true" style="font-size: 20px;"></i>اطلاعات تماس</a>
                                       <a href="#" data-id="{{$user->id }}"  class="bank_info_link"><i class="fa fa-credit-card mr-2" aria-hidden="true" style="font-size: 20px;"></i>اطلاعات بانکی</a>
                                       <a href="#" data-id="{{$user->id }}"  class="task-link"> <i class="fa fa-home mr-2" aria-hidden="true" style="font-size: 20px;"> </i>اطلاعات شغلی</a>
                                       <a href="#" data-id="{{$user->id }}"  class=""><i class="fa fa-file mr-2" aria-hidden="true" style="font-size: 20px;"></i>مستندات</a>

                                       
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
                            <input type="text" hidden class="form-control" name="bank-id" id="bank-id">
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


    {{-- End bank info modal --}}
    {{-- -------------------------------- Start task Details Modal --}}
    <div id="task-modal" class="modal " tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <img id="user-task-image" src="" class="user-image" alt="User Image">
                        <div id="user-task-info" class="modal-title"></div>
                    </div>
                </div>
                <div class="modal-body">
                    {{-- Start task details form --}}
                    <form id="task-details-form">
                        <div class="form-group">
                            <input type="text" hidden class="form-control" name="task-id" id="task-id">
                            <span id="task-details-id_error" class="error-message text-danger"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" hidden class="form-control" name="user_id" id="user_id">
                            <span id="user_id_error" class="error-message text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label for="">عنوان شغلی: </label>
                            <input type="text" class="form-control" id="task_title" name="">
                            <span id="task_title_error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <label for=""> شرح شغل</label>
                            <input type="text" class="form-control" id="task_description" name="">
                            <span id="task_description_error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="">شماره بیمه</label>
                            <input type="text" class="form-control persian-number" id="task_insurance_code" name="">
                            <span id="task_insurance_code_error" class="error-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="" id=""> تاریخ استخدام:</label>
                            <input type="text" class="form-control" id="date_employment" name="" style="font-family: 'yekan' ">
                            <input type="hidden" class="form-control" id="gregorianDate" name="">
                            <span id="task_insurance_code_error" class="error-message"></span>
                        </div>
                        <button id="save-task-button" type="submit" class="btn btn-primary">ذخیره</button>

                    </form>
                    {{-- End address form --}}

                </div>
                <div class="modal-footer">
                    <button id="close-task-amodal" type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">بستن</button>


                </div>
            </div>
        </div>
    </div>

    {{-- --------------------------------- Start task Details Modal --}}
@endsection
@section('scripts')
@endsection
