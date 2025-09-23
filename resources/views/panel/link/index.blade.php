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
        <h5 class="card-header heading-color">جدول لینک های کوتاه شده</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>لینک اصلی</th>
                        <th>لینک کوتاه</th>
                        <th>تعداد بازدید</th>
                        <th> تاریخ ایجاد </th>
                        <th>وضعیت</th>
                        <th>عمل‌ها</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td><i class="align-middle fab fa-angular fa-lg text-danger "></i> <strong>1 </strong>
                        </td>
                        <td><i class="align-middle fab fa-angular fa-lg text-danger me-3"></i> <strong>پروژه
                                انگولار</strong>
                        </td>
                        <td>استیو جابز</td>
                        <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">


                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" aria-label="اولیور کویین"
                                    data-bs-original-title="اولیور کویین">
                                    <img src="../../assets/img/avatars/7.png" alt="آواتار" class="rounded-circle">
                                </li>
                            </ul>
                        </td>
                        <td><span class="badge bg-label-primary me-1">15</span></td>
                        <td><span class="badge bg-label-primary me-1">14 شهریور 1404</span></td>
                        <td><span class="badge bg-label-primary me-1">فعال</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>
                                        ویرایش</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                        حذف</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
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
