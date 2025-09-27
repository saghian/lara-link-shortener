@extends('panel.layouts.master')

{{-- 
Class:
Div:content-wrapper
Div: container-xxl flex-grow-1 container-p-y
--}}

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">
            لینک های کوتاه شده
            /</span>
        ویرایش لینک
        "هیات امنا - 25 شهریور "
    </h4>


    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">هیات امنا - 25 شهریور </h5>
                    <small class="text-muted float-end primary-font">
                        <button type="button" class="btn btn-label-danger px-2">
                            <span class="tf-icons bx bx-trash me-1"></span>
                            حذف
                        </button>

                    </small>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">عنوان </label>
                            <input type="text" class="form-control" id="basic-default-fullname" placeholder="Title ">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">لینک اصلی</label>
                            <input type="text" class="form-control text-end" id="basic-default-company"
                                placeholder="Link">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">لینک کوتاه </label>
                            <input type="text" class="form-control text-end" id="basic-default-company"
                                placeholder="لینک کوتاه">
                        </div>

                        <div class="pt-3">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">ثبت</button>
                            <button type="reset" class="btn btn-label-secondary">انصراف</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



{{-- 
Add  JS - CSS Libs
--}}
@section('css-libs')
@endsection

@section('js-libs')
@endsection

@section('script')
    <!-- Page JS -->
@endsection
