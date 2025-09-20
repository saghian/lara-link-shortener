@extends('panel.layouts.master')

{{-- 
Class:
Div:content-wrapper
Div: container-xxl flex-grow-1 container-p-y
--}}

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">
            وبلاگ
            /</span>
        ایجاد مطلب جدید
    </h4>

    {{-- Create form --}}

    <!-- Multi Column with Form Separator -->
    <div class="card mb-4">
        <h5 class="card-header heading-color">چند ستون با جداکننده فرم</h5>
        <form class="card-body">
            <h6 class="fw-normal">1. جزئیات حساب</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="multicol-username">نام کاربری</label>
                    <input type="text" id="multicol-username" class="form-control text-start" placeholder="john.doe"
                        dir="ltr">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="multicol-email">ایمیل</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" id="multicol-email2" dir="ltr">@example.com</span>
                        <input type="text" id="multicol-email" class="form-control text-start" placeholder="john.doe"
                            aria-label="john.doe" aria-describedby="multicol-email2" dir="ltr">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-password-toggle">
                        <label class="form-label" for="multicol-password">رمز عبور</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="multicol-password" class="form-control text-start"
                                placeholder="············" dir="ltr" aria-describedby="multicol-password2">
                            <span class="input-group-text cursor-pointer" id="multicol-password2"><i
                                    class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-password-toggle">
                        <label class="form-label" for="multicol-confirm-password">تایید رمز عبور</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="multicol-confirm-password" class="form-control text-start"
                                placeholder="············" dir="ltr" aria-describedby="multicol-confirm-password2">
                            <span class="input-group-text cursor-pointer" id="multicol-confirm-password2"><i
                                    class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4 mx-n4">
            <h6 class="fw-normal">2. اطلاعات شخصی</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="multicol-first-name">نام</label>
                    <input type="text" id="multicol-first-name" class="form-control" placeholder="جان">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="multicol-last-name">نام خانوادگی</label>
                    <input type="text" id="multicol-last-name" class="form-control" placeholder="اسنو">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="multicol-country">کشور</label>
                    <select id="multicol-country" class="select2 form-select" data-allow-clear="true">
                        <option value="">انتخاب</option>
                        <option value="Australia">استرالیا</option>
                        <option value="Bangladesh">بنگلادش</option>
                        <option value="Belarus">بلاروس</option>
                        <option value="Brazil">برزیل</option>
                    </select>
                </div>


                <div class="col-md-6 select2-primary">
                    <label class="form-label" for="multicol-language">زبان</label>
                    <select id="multicol-language" class="select2 form-select" multiple>
                        <option value="en" selected>انگلیسی</option>
                        <option value="fr" selected>فرانسوی</option>
                        <option value="de">آلمانی</option>
                        <option value="pt">پرتغالی</option>
                    </select>

                    <label for="select2Basic" class="form-label">Basic</label>
                    <select id="select2Basic" class="select2 form-select form-select-lg" data-allow-clear="true">
                        <option value="">انتخاب</option>
                        <option value="AK">Alaska</option>
                        <option value="HI">Hawaii</option>
                        <option value="CA">California</option>
                        <option value="SC">South Carolina</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WV">West Virginia</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="multicol-birthdate">تاریخ تولد</label>
                    <input type="text" id="multicol-birthdate" class="form-control dob-picker"
                        placeholder="YYYY/MM/DD">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="multicol-phone">شماره تلفن</label>
                    <input type="text" id="multicol-phone" class="form-control phone-mask text-start"
                        placeholder="658 799 8941" dir="ltr" aria-label="658 799 8941">
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">ثبت</button>
                <button type="reset" class="btn btn-label-secondary">انصراف</button>
            </div>
        </form>
    </div>



































    <p>
        111
    </p>
@endsection

@section('style')
    <style>
    </style>
@endsection

@section('script')
    <!-- Page JS -->
    {{-- <script src="{{ asset('/panel/js/form-layouts.js') }}"></script> --}}

    var flatpickrDate = document.querySelector("#multicol-birthdate");

    flatpickrDate.flatpickr({

    locale: 'fa',
    enableTime: true,
    disableMobile: true
    });
@endsection
