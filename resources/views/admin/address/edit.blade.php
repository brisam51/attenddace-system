@extends('admin.layouts.app')

@section('title')
@endsection

@section('dashboard')
@endsection

@section('my-style')
@endsection


@section('content')
    <div class="jumbotron shade pt-2 pb-3">


        <form id="addressForm" action="{{ url('user/address/update/'.$address->id) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">userID</label>
                <input type="text" value="{{ $address['user_id'] }}" class="form-control" id="form-mobile" name="user_id">
                <span id="mobile_error" class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="">موبایل</label>
                <input type="text" value="{{ $address['mobile'] }}" class="form-control" id="form-mobile" name="mobile">
                <span id="mobile_error" class="error-message"></span>
            </div>
            <div class="form-group">
                <label for="">تلفن</label>
                <input type="text" value="{{ $address['phone'] }}" class="form-control" id="form-phone" name="phone">
                <span id="phone_error" class="error-message"></span>
            </div>
            <div class="form-group">
                <label for="">آدرس</label>
                <input type="text" value="{{ $address['address'] }}" class="form-control" id="form-address"
                    name="address">
                <textarea id="form-address" class="form-control" placeholder="Address"></textarea>
                <span id="address_error" class="error-message"></span>
            </div>
            <button id="saveButton" type="submit" class="btn btn-primary">Save </button>

        </form>


    </div>
@endsection

@section('script')
@endsection
