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
                       <form action="{{ route('filter.sell.qty') }}" method="GET" >
                        
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Country</label>
                                <div class="col-12">
                                    <select name="country_id" class="form-control placeholder-single">
                                        <optgroup label="Central Time Zone">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $key => $country)
                                            <option value="{{ $country->id }}" {{ @$request->country_id == $country->id ? 'selected' : '' }}>{{ $country->country_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Regions</label>
                                <div class="col-12">
                                    <select name="region_id" class="form-control placeholder-single">
                                        <optgroup label="Central Time Zone">
                                            <option value="">Select Regions</option>
                                            @foreach($regions as $key => $region)
                                            <option value="{{ $region->id }}" {{ @$request->region_id == $region->id ? 'selected' : '' }}>{{ $region->region_name }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">State</label>
                                <div class="col-12">
                                    <select name="state_id" class="form-control placeholder-single">
                                        <optgroup label="Central Time Zone">
                                            <option value="">Select State</option>
                                            @foreach($states as $key => $state)
                                            <option value="{{ $state->id }}" {{ @$request->state_id == $state->id ? 'selected' : '' }}>{{ $state->state_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Location</label>
                                <div class="col-12">
                                    <select name="location_id" class="form-control placeholder-single">
                                        <optgroup label="Central Time Zone">
                                            <option value="">Select Location</option>
                                            @foreach($locations as $key => $location)
                                            <option value="{{ $location->id }}" {{ @$request->location_id == $location->id ? 'selected' : '' }}>{{ $location->location_name }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Client</label>
                                <div class="col-12">
                                    <select name="client_id" class="form-control placeholder-single">
                                        <optgroup label="Central Time Zone">
                                            <option value="">Select Client</option>
                                            @foreach($clients as $key => $client)
                                            <option value="{{ $client->id }}" {{ @$request->client_id == $client->id ? 'selected' : '' }}>{{ $client->client_name }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Project</label>
                                <div class="col-12">
                                    <select name="project_id" class="form-control placeholder-single">
                                        <optgroup label="Central Time Zone">
                                            <option value="">Select Project</option>
                                            @foreach($projects as $key => $project)
                                            <option value="{{ $project->id }}" {{ @$request->project_id == $project->id ? 'selected' : '' }}>{{ $project->project_name }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Channel</label>
                                <div class="col-12">
                                    <select name="outlet_channel_id" class="form-control placeholder-single">
                                        <optgroup label="Central Time Zone">
                                            <option value="">Select Channel</option>
                                            @foreach($outletChannels as $key => $channel)
                                            <option value="{{ $channel->id }}" {{ @$request->outlet_channel_id == $channel->id ? 'selected' : '' }}>{{ $channel->channel_name }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Outlet</label>
                                <div class="col-12">
                                    <select name="outlet_id" class="form-control placeholder-single">
                                        <optgroup label="Central Time Zone">
                                            <option value="">Select Outlet</option>
                                            @foreach($outlets as $key => $outlet)
                                            <option value="{{ $outlet->id }}" {{ @$request->outlet_id == $outlet->id ? 'selected' : '' }}>{{ $outlet->outlet_name }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Brand</label>
                                <div class="col-12">
                                    <select name="brand_id" class="form-control placeholder-single">
                                        <optgroup label="Central Time Zone">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $key => $brand)
                                            <option value="{{ $brand->id }}" {{ @$request->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            {{-- @dd(@$request->datefilter) --}}
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Date</label>
                                <div class="col-12">
                                    <input class="form-control" type="text" name="datefilter"  placeholder="Select Date Range"/>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <button class="btn btn-danger" name="reset" value="1">Reset</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-lg-6 col-xl-4 col-xxl-3 mb-3">
            <div class="card overflow-hidden gradient-01">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 text-white">
                            <h6 class="mb-2 fs-18">Sales (Qty)</h6>
                            <p class="mb-2 fs-20 fw-bold">{{ $totalSaleQty }}</p>
                            <p class="mb-0"> <span><i class="fa fa-chevron-circle-up me-1"></i> 3%</span> last month </p>
                        </div>
                        <div class="col-4 align-items-center d-flex">
                            <div class="counter-icon bg-info-gradient box-shadow-primary brround ms-auto"> <i class="typcn typcn-shopping-cart text-white"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-xxl-3 mb-3">
            <div class="card overflow-hidden gradient-02">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 text-white">
                            <h6 class="mb-2 fs-18">Sales (Amount)</h6>
                            <p class="mb-2 fs-20 fw-bold">{{  $totalSaleAmount }}</p>
                            <p class="mb-0"> <span><i class="fa fa-chevron-circle-up me-1"></i> 3%</span> last month </p>
                        </div>
                        <div class="col-4 align-items-center d-flex">
                            <div class="counter-icon bg-dark-gradient box-shadow-primary brround ms-auto"> <i class="typcn typcn-calculator text-white"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-xxl-3 mb-3">
            <div class="card overflow-hidden gradient-03">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 text-white">
                            <h6 class="mb-2 fs-18">Ready Stock (Sales)</h6>
                            <p class="mb-2 fs-20 fw-bold">{{ $readySalesStock }}</p>
                            <p class="mb-0"><span><i class="fa fa-chevron-circle-up me-1"></i> 5%</span> last month </p>
                        </div>
                        <div class="col-4 align-items-center d-flex">
                            <div class="counter-icon bg-success-gradient box-shadow-primary brround ms-auto"> <i class="typcn typcn-chart-line-outline text-white"></i> </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-xxl-3 mb-3">
            <div class="card overflow-hidden gradient-04">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 text-white">
                            <h6 class="mb-2 fs-18">Presales (Orders)</h6>
                            <p class="mb-2 fs-20 fw-bold">{{ $totalPresaleQty }}</p>
                            <p class="mb-0"><span><i class="fa fa-chevron-circle-down me-1"></i> 5%</span> last month </p>
                        </div>
                        <div class="col-4 align-items-center d-flex">
                            <div class="counter-icon bg-primary-gradient box-shadow-primary brround ms-auto"> <i class="fas fa-handshake text-white"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-xxl-3 mb-3">
            <div class="card overflow-hidden gradient-010">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 text-white">
                            <h6 class="mb-2 fs-18">Average Sales (Qty) Day</h6>
                            <p class="mb-2 fs-20 fw-bold">{{ number_format($averageSaleQty,2) }}</p>
                            <p class="mb-0"><span><i class="fa fa-chevron-circle-down me-1"></i> 5%</span> last month </p>
                        </div>
                        <div class="col-4 align-items-center d-flex">
                            <div class="counter-icon bg-success-gradient box-shadow-primary brround ms-auto"><i class="typcn typcn-chart-bar-outline text-white"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-xxl-3 mb-3">
            <div class="card overflow-hidden gradient-06">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 text-white">
                            <h6 class="mb-2 fs-18">Sales Callage/Visits</h6>
                            <p class="mb-2 fs-20 fw-bold">{{ number_format($totalCallageByVisits,2) }}</p>
                            <p class="mb-0"><span><i class="fa fa-chevron-circle-up me-1"></i> 4%</span> last month </p>
                        </div>
                        <div class="col-4 align-items-center d-flex">
                            <div class="counter-icon bg-dark-gradient box-shadow-primary brround ms-auto"><i class="typcn typcn-eye-outline text-white"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-xxl-3 mb-3">
            <div class="card overflow-hidden gradient-07">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 text-white">
                            <h6 class="mb-2 fs-18">Avg. Callage/Day</h6>
                            <p class="mb-2 fs-20 fw-bold">{{ number_format($avgCallageByVisitsPerDay,2) }}</p>
                            <p class="mb-0"><span><i class="fa fa-chevron-circle-up me-1"></i> 2%</span> last month </p>
                        </div>
                        <div class="col-4 align-items-center d-flex">
                            <div class="counter-icon bg-primary-gradient box-shadow-primary brround ms-auto"><i class="typcn typcn-eye-outline text-white"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-xxl-3 mb-3">
            <div class="card overflow-hidden gradient-08">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 text-white">
                            <h6 class="mb-2 fs-18">Avg. Sales ep ( Qty )</h6>
                            <p class="mb-2 fs-20 fw-bold">{{ number_format($avgSaleQtyByTotalSaler,2) }}</p>
                            <p class="mb-0"><span><i class="fa fa-chevron-circle-up me-1"></i> 10%</span> last month </p>
                        </div>
                        <div class="col-4 align-items-center d-flex">
                            <div class="counter-icon bg-success-gradient box-shadow-primary brround ms-auto"><i class="typcn typcn-eye-outline text-white"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-xxl-3 mb-3">
            <div class="card overflow-hidden gradient-09">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 text-white">
                            <h6 class="mb-2 fs-18">Avg. Sales ep (Amount)</h6>
                            <p class="mb-2 fs-20 fw-bold">{{ number_format($avgSaleAmountByTotalSaler,2) }}</p>
                            <p class="mb-0"><span><i class="fa fa-chevron-circle-up me-1"></i> 13%</span> last month </p>
                        </div>
                        <div class="col-4 align-items-center d-flex">
                            <div class="counter-icon bg-info-gradient box-shadow-primary brround ms-auto"><i class="typcn typcn-calculator text-white"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xl-4 col-xxl-3 mb-3">
            <div class="card overflow-hidden gradient-03">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 text-white">
                            <h6 class="mb-2 fs-18">No. Repeated Purchase</h6>
                            <p class="mb-2 fs-20 fw-bold">{{ $repeatedPurchase}}</p>
                            <p class="mb-0"><span><i class="fa fa-chevron-circle-up me-1"></i> 13%</span> last month </p>
                        </div>
                        <div class="col-4 align-items-center d-flex">
                            <div class="counter-icon bg-dark-gradient box-shadow-primary brround ms-auto"><i class="typcn typcn-arrow-repeat text-white"></i></div>
                        </div>
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

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 fw-semi-bold mb-0">Recent Image</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="box blury-card">
                                <a data-caption="<div><b>Owerri, Imo, Nigeria </b></div>
                                    <div><b>F2M9+6G7, New Owerri460281, Owerri, Nigeria </b></div>
                                    <div><b>Lat 5.8787</b></div>
                                    <div><b>Lon 7.869</b></div>
                                    <div><b>3/4/2022 12:30AM</b></div>" data-fancybox="gallery" href="{{ asset('public') }}/assets/dist/img/pos/02.webp">
                                    <img class="rounded" src="{{ asset('public') }}/assets/dist/img/pos/02.webp" />
                                </a>
                                <div class="frame fs-17">
                                    <div><b>Owerri, Imo, Nigeria </b></div>
                                    <div><b>F2M9+6G7, New Owerri460281, Owerri, Nigeria </b></div>
                                    <div><b>Lat 5.8787</b></div>
                                    <div><b>Lon 7.869</b></div>
                                    <div><b>3/4/2022 12:30AM</b></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="box blury-card">
                                <a data-caption="<div><b>Owerri, Imo, Nigeria </b></div>
                                    <div><b>F2M9+6G7, New Owerri460281, Owerri, Nigeria </b></div>
                                    <div><b>Lat 5.8787</b></div>
                                    <div><b>Lon 7.869</b></div>
                                    <div><b>3/4/2022 12:30AM</b></div>" data-fancybox="gallery" href="{{ asset('public') }}/assets/dist/img/pos/03.webp">
                                    <img class="rounded" src="{{ asset('public') }}/assets/dist/img/pos/03.webp" />
                                </a>
                                <div class="frame fs-17">
                                    <div><b>Owerri, Imo, Nigeria </b></div>
                                    <div><b>F2M9+6G7, New Owerri460281, Owerri, Nigeria </b></div>
                                    <div><b>Lat 5.8787</b></div>
                                    <div><b>Lon 7.869</b></div>
                                    <div><b>3/4/2022 12:30AM</b></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="box blury-card">
                                <a data-caption="<div><b>Owerri, Imo, Nigeria </b></div>
                                    <div><b>F2M9+6G7, New Owerri460281, Owerri, Nigeria </b></div>
                                    <div><b>Lat 5.8787</b></div>
                                    <div><b>Lon 7.869</b></div>
                                    <div><b>3/4/2022 12:30AM</b></div>" data-fancybox="gallery" href="{{ asset('public') }}/assets/dist/img/pos/05.webp">
                                    <img class="rounded" src="{{ asset('public') }}/assets/dist/img/pos/05.webp" />
                                </a>
                                <div class="frame fs-17">
                                    <div><b>Owerri, Imo, Nigeria </b></div>
                                    <div><b>F2M9+6G7, New Owerri460281, Owerri, Nigeria </b></div>
                                    <div><b>Lat 5.8787</b></div>
                                    <div><b>Lon 7.869</b></div>
                                    <div><b>3/4/2022 12:30AM</b></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="box blury-card">
                                <a data-caption="<div><b>Owerri, Imo, Nigeria </b></div>
                                    <div><b>F2M9+6G7, New Owerri460281, Owerri, Nigeria </b></div>
                                    <div><b>Lat 5.8787</b></div>
                                    <div><b>Lon 7.869</b></div>
                                    <div><b>3/4/2022 12:30AM</b></div>" data-fancybox="gallery" href="{{ asset('public') }}/assets/dist/img/cover.jpg">
                                    <img class="rounded" src="{{ asset('public') }}/assets/dist/img/cover.jpg" />
                                </a>
                                <div class="frame fs-17">
                                    <div><b>Owerri, Imo, Nigeria </b></div>
                                    <div><b>F2M9+6G7, New Owerri460281, Owerri, Nigeria </b></div>
                                    <div><b>Lat 5.8787</b></div>
                                    <div><b>Lon 7.869</b></div>
                                    <div><b>3/4/2022 12:30AM</b></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
