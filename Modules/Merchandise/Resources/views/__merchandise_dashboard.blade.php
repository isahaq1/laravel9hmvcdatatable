@extends('layouts.backend')
@push('css')
<link href="{{asset('public/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css')}}" rel="stylesheet">
@endpush


@section('content')
<div class="body-content">
    <div class="row">
        <div class="col-12">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header d-flex justify-content-end mb-3" id="flush-headingOne">
                        <button type="button" class="fs-17 filter-bt" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne"><img  class="me-2 h-24" src="assets/dist/img/icons8-filter-30.png" alt="">Filter</button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse bg-white px-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Supply Location</label>
                                <div class="col-12">
                                    <select class="form-control placeholder-single">                                       
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                        </optgroup>                                              
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Field Staff</label>
                                <div class="col-12">
                                    <select class="form-control placeholder-single">                                       
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                        </optgroup>                                              
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Outlet Type</label>
                                <div class="col-12">
                                    <select class="form-control placeholder-single">                                       
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                        </optgroup>                                              
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Outlet Channel</label>
                                <div class="col-12">
                                    <select class="form-control placeholder-single">                                       
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                        </optgroup>                                              
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Custom Date</label>
                                <div class="col-12">
                                    <select class="form-control placeholder-single">                                       
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                        </optgroup>                                              
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Custom Search</label>
                                <div class="col-12">
                                    <select class="form-control placeholder-single">                                       
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                        </optgroup>                                              
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3 d-flex align-items-end">
                                <button class="btn btn-primary me-2">Go</button>
                                <button class="btn btn-danger">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div class="card-header card-header-warning card-header-icon position-relative border-0 text-end px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="typcn typcn-device-tablet"></i>
                    </div>
                    <p class="fs-15 fw-bold mt-3">Total Outlet</p>
                    <h3 class="card-title fs-18 fw-bold">2</h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                        <a href="#" class="warning-link">Total Outlet</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div class="card-header card-header-success card-header-icon position-relative border-0 text-end px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="typcn typcn-home-outline"></i>
                    </div>
                    <p class="fs-15 fw-bold mt-3">Total outlet map to fieldstaff</p>
                    <h3 class="card-title fs-21 fw-bold">5</h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                        <a href="#" class="warning-link">Total outlet map to fieldstaff</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div class="card-header card-header-danger card-header-icon position-relative border-0 text-end px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="typcn typcn-info-outline"></i>
                    </div>
                    <p class="fs-15 fw-bold mt-3">Total outlet map to client</p>
                    <h3 class="card-title fs-21 fw-bold">75</h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                        <a href="#" class="warning-link">Total outlet map to client</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div class="card-header card-header-info card-header-icon position-relative border-0 text-end px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="fab fa-twitter"></i>
                    </div>
                    <p class="fs-15 fw-bold mt-3 mb-1">Click to custom export</p>
                    <i class="typcn typcn-arrow-down-thick fs-26"></i>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                        <a href="#" class="warning-link">Click to custom export</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card">
                <div class="card-header gradient-1 p-3">
                    <h1 class="fs-24 text-white">Outlets</h1>
                </div>
                <div class="card-body py-5">
                    <div class="fs-15 fw-bold">
                        2 Wholesaler
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card">
                <div class="card-header gradient-2 p-3">
                    <h1 class="fs-24 text-white">Special Outlets Summary</h1>
                </div>
                <div class="card-body py-5">
                    <div class="fs-15 fw-bold">
                        1 Aba North
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card">
                <div class="card-header gradient-3 p-3">
                    <h1 class="fs-24 text-white">Others</h1>
                </div>
                <div class="card-body py-5">
                    <div class="fs-15 fw-bold">
                        1 Aba North
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card">
                <div class="card-header gradient-3 p-3">
                    <h1 class="fs-24 text-white"> Top Expiring Products</h1>
                </div>
                <div class="card-body py-5">
                    <div class="fs-15 fw-bold">
                        1 Aba North
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-6 d-flex">
            <div class="card mb-4 flex-fill w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 fw-semi-bold mb-0">Recently Captured Image</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="popup-gallery">
                        <a href="{{asset('public/assets/dist/img/pos/01.webp')}}" title="The Cleaner"><img src="{{asset('public/assets/dist/img/pos/01.webp')}}" width="75" height="75"></a>
                        <a href="{{asset('public/assets/dist/img/pos/02.webp')}}" title="Winter Dance"><img src="{{asset('public/assets/dist/img/pos/02.webp')}}" width="75" height="75"></a>
                        <a href="{{asset('public/assets/dist/img/pos/03.webp')}}" title="The Uninvited Guest"><img src="{{asset('public/assets/dist/img/pos/03.webp')}}" width="75" height="75"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-flex">
            <div class="card mb-4 flex-fill w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 fw-semi-bold mb-0">Recent Visits</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class=" table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Outlet Name</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2022-04-26</td>
                                <td>2022-04-26</td>
                                <td>11:23:10</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.popup-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    return item.el.attr('title');
                }
            }
        });
    });
</script>


@endsection

@push('js')

<script src="{{asset('public/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>

@endpush

