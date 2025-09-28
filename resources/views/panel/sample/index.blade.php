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


    <div class="card mb-4">
        <h5 class="card-header heading-color"> عنوان ...</h5>
        <div class="card-body">
            متن ...
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
