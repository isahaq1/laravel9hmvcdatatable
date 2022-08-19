@extends('layouts.backend')
@push('css')
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
                                <label class="col-form-label text-end fw-semi-bold">Warehouse</label>
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
                                <label class="col-form-label text-end fw-semi-bold">SalesRep</label>
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
                                <label class="col-form-label text-end fw-semi-bold">Product/Brand</label>
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
                                <label class="col-form-label text-end fw-semi-bold">Date</label>
                                <div class="col-12">
                                    <input class="form-control" type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
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
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div class="card-header card-header-warning card-header-icon position-relative border-0 text-end px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="typcn typcn-shopping-cart"></i>
                    </div>
                    <p class="fs-17 fw-bold mt-3">Total Sell-In (YTD)</p>
                    <h3 class="card-title fs-18 fw-bold">2352</h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                        <a href="#" class="warning-link">Total Sell-In</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div class="card-header card-header-success card-header-icon position-relative border-0 text-end px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="typcn typcn-calculator"></i>
                    </div>
                    <p class="fs-17 fw-bold mt-3">Total Sell-Out (YTD)</p>
                    <h3 class="card-title fs-21 fw-bold">455</h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                        <a href="#" class="warning-link">Total Sell-Out (YTD)</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div class="card-header card-header-danger card-header-icon position-relative border-0 text-end px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="typcn typcn-chart-line-outline"></i>
                    </div>
                    <p class="fs-17 fw-bold mt-3">Sell-In (MTD)</p>
                    <h3 class="card-title fs-21 fw-bold">5</h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                        <a href="#" class="warning-link">Sell-In (MTD)</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div class="card-header card-header-info card-header-icon position-relative border-0 text-end px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <!-- <i class="fab fa-product-hunt"></i> -->
                        <i class="fas fa-handshake"></i>
                    </div>
                    <p class="fs-17 fw-bold mt-3">Sell-Out (MTD)</p>
                    <h3 class="card-title fs-21 fw-bold">5</h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                        <a href="#" class="warning-link">Sell-Out (MTD)</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats statistic-box mb-4">
                <div class="card-header card-header-info card-header-icon position-relative border-0 text-end px-3 py-0">
                    <div class="card-icon d-flex align-items-center justify-content-center">
                        <i class="fab fa-product-hunt"></i>
                    </div>
                    <p class="fs-17 fw-bold mt-3">Products / Brands</p>
                    <h3 class="card-title fs-18 fw-bold">2352</h3>
                </div>
                <div class="card-footer p-3">
                    <div class="stats">
                        <a href="#" class="warning-link">Products / Brands</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 fw-semi-bold mb-0">Recent Sales</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table display table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>SL No.</th>
                                    <th>Outlet Name</th>
                                    <th>Unit Qty</th>
                                    <th>Case Qty</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                    <td>
                                        <a href="#" class="btn btn-success-soft btn-sm me-1" data-bs-toggle="tooltip" title="Edit"><i class="far fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger-soft btn-sm" data-bs-toggle="tooltip" title="Delete"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
@endpush

