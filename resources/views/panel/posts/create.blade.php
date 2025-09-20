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
        <h5 class="card-header heading-color"> ایجاد مطلب جدید </h5>
        <form class="card-body">

            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="title"> عنوان مطلب </label>
                    <input type="text" id="title" class="form-control text-start"
                        placeholder="عنوان مطلب را وارد کنید" dir="ltr">
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="slug"> Slug </label>
                    <input type="text" id="slug" class="form-control "
                        placeholder="با کاراکتر های انگلیسی تکمیل نمایید" dir="ltr">
                </div>
                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="" class="form-label">متن</label>
                        {{-- <textarea class="form-control text-start" id="" dir="ltr" rows="10" style="height: 200px;"></textarea> --}}

                        <div id="editor" style="min-height: 100px">
                            <br>
                        </div>
                    </div>
                </div>



                <br>
                <div class="row g-3">
                    <div class="col-md-6 select2-primary">
                        <label class="form-label" for="multicol-country">دسته بندی</label>
                        <select id="multicol-country" class="select2 form-select" data-allow-clear="true" multiple>
                            <option value="Australia">استرالیا</option>
                            <option value="Brazil">برزیل</option>
                        </select>
                    </div>

                    <div class="col-md-6 select2-primary">
                        <label class="form-label" for="tags">تگ ها</label>
                        <select id="tags" class="select2 form-select" multiple>
                            <option value="en" selected>انگلیسی</option>
                            <option value="fr" selected>فرانسوی</option>
                            <option value="de">آلمانی</option>
                            <option value="pt">پرتغالی</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-birthdate">زمان انتشار </label>
                        <input type="text" id="multicol-birthdate" class="form-control dob-picker"
                            placeholder="YYYY/MM/DD">
                    </div>

                </div>

                <hr class="">

                <div class="pt-1">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">ثبت</button>
                    <button type="reset" class="btn btn-label-secondary">انصراف</button>
                </div>
        </form>
    </div>
@endsection

@section('css-libs')
    <link rel="stylesheet" href="{{ asset('/panel/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('/panel/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('/panel/vendor/libs/quill/editor.css') }}" />
@endsection

@section('js-libs')
    <script src="{{ asset('/panel/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('/panel/vendor/libs/quill/quill.js') }}"></script>
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

    const quill = new Quill('#editor', {
    placeholder: 'بنویس ...',
    theme: 'snow'
    });
@endsection
