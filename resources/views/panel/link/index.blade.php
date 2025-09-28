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
        لیست تمامی لینک ها
    </h4>

    <div class="card">
        {{-- <h5 class="card-header heading-color">جدول لینک های کوتاه شده</h5> --}}
        {{-- {{ ds($allLinks) }} --}}

        <div class="row mx-2 mb-2 mt-3">
            <div class="col-md-6 ">
                <div class="dataTables_length" id="DataTables_Table_0_length">
                    {{-- Right col --}}
                    <h5 class="heading-color">جدول لینک های کوتاه شده</h5>

                </div>
            </div>
            <div class="col-md-6">

                <div
                    class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                    <div class="dt-buttons btn-group flex-wrap">

                        <button type="button" class="btn btn-label-success px-2">
                            <span class="tf-icons bx bx-save me-1"></span>
                            خروجی اکسل
                        </button>

                        <button class="btn btn-label-primary add-new ms-2 px-2" tabindex="0"
                            aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasAddLink">
                            <span>
                                <i class="bx bx-plus me-0 me-lg-2"></i>
                                <span class=" d-lg-inline-block"> لینک جدید</span>
                            </span>
                        </button>
                    </div>
                </div>



            </div>
        </div>

        <div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-striped" style="margin-bottom: 20px">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>لینک اصلی</th>
                        <th>لینک کوتاه</th>
                        <th style="width: 10%">تعداد بازدید</th>
                        <th style="width: 12%"> تاریخ ایجاد </th>
                        <th style="width: 10%">وضعیت</th>
                        <th style="width: 10%">عمل‌ها</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($allLinks as $link)
                        <tr>
                            <td><i class="align-middle fab fa-angular fa-lg text-danger "></i>
                                <strong>{{ $loop->iteration }}</strong>
                            </td>
                            <td><i class="align-middle fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>
                                    {{ $link->title }}
                                </strong>
                            </td>
                            <td style="max-width: 200px; direction: ltr; overflow: hidden">
                                <a href="{{ $link->main_link }}" target="_blank" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-custom-class="tooltip-success"
                                    data-bs-original-title="{{ $link->main_link }}" rel="noopener noreferrer">
                                    {{ $link->main_link }}
                                </a>
                            </td>
                            <td style="direction: ltr; overflow: hidden">
                                <a href="{{ $link->short_link }}" target="_blank" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-custom-class="tooltip-success"
                                    data-bs-original-title="{{ $link->short_link }}" rel="noopener noreferrer">
                                    {{ $link->short_link }}
                                </a>
                            </td>
                            <td><span class="badge bg-label-primary me-1">{{ $link->view }}</span></td>
                            <td><span
                                    class="badge bg-label-primary me-1">{{ jdate($link->created_at)->format('%d %B %Y') }}</span>
                            </td>
                            <td>
                                <label class="me-3 switch switch-primary">
                                    <input type="checkbox" class="switch-input" {{ $link->is_active ? 'checked' : '' }}>
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on">
                                            <i class="bx bx-check"></i>
                                        </span>
                                        <span class="switch-off">
                                            <i class="bx bx-x"></i>
                                        </span>
                                    </span>
                                    <span class="switch-label"></span>
                                </label>

                            </td>
                            <td>

                                <button type="button" value="{{ $link->id }}" class="btn btn-icon btn-label-warning">
                                    <span class="tf-icons bx bx-edit"></span>
                                </button>

                                <button type="button" value="{{ $link->id }}" class="btn btn-icon btn-label-danger">
                                    <span class="tf-icons bx bx-trash"></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>


        <!-- Offcanvas to add new user -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddLink" aria-labelledby="offcanvasAddLinkLabel">
            <div class="offcanvas-header border-bottom">
                <h6 id="offcanvasAddLinkLabel" class="offcanvas-title">افزودن لینک</h6>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form action="{{ route('link.store') }}" method="POST" class="add-new-user pt-0" id="addNewUserForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="add-link-title">عنوان </label>
                        <input type="text" class="form-control" id="add-link-title"
                            placeholder="یک عنوان مناسب وارد کنید" name="linkTitle" aria-label="John Doe">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-link-main">لینک اصلی</label>
                        <input type="text" id="add-link-main" class="form-control text-end"
                            placeholder="http://www.yoururl.com/..." aria-label="" name="mainLink" dir="ltr">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-short-link">لینک کوتاه</label>
                        <input type="text" id="add-short-link" class="form-control text-end"
                            placeholder="Shortlink.link/123" aria-label="" name="shortLink" dir="ltr">
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="user-plan">وضعیت </label>
                        <select id="user-plan" class="form-select" name="isActive">
                            <option value="1">فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </div>
                    {{-- <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">ثبت</button> --}}
                    <input type="submit" value="ثبت" class="btn btn-primary me-sm-3 me-1 data-submit">
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">انصراف</button>
                </form>
            </div>
        </div>

    </div>

    <hr class="my-5">


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
