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
                                <label class="col-form-label text-end fw-semi-bold">Country</label>
                                <div class="col-12">
                                    <select class="form-control placeholder-single">                                       
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                        </optgroup>                                              
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Regions</label>
                                <div class="col-12">
                                    <select class="form-control placeholder-single">                                       
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                        </optgroup>                                              
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">State</label>
                                <div class="col-12">
                                    <select class="form-control placeholder-single">                                       
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="WI">Wisconsin</option>
                                        </optgroup>                                              
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3 mb-3">
                                <label class="col-form-label text-end fw-semi-bold">Location</label>
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
                                <label class="col-form-label text-end fw-semi-bold">Client</label>
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
                            <div class="col-12 col-md-6 col-lg-3 mb-3 align-items-end d-flex">
                                <button class="btn btn-primary me-2">Go</button>
                                <button class="btn btn-danger">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-6 col-xl-3">
            <div class="card mb-4 flex-fill w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-stats statistic-box mb-4">
                                <div class="card-header card-header-success card-header-icon position-relative border-0 text-end px-3 py-0">
                                    <div class="card-icon d-flex align-items-center justify-content-center">
                                        <i class="typcn typcn-device-tablet"></i>
                                    </div>
                                    <p class="fs-15 fw-bold mt-3">Total Outlet / Customar (Number)</p>
                                    <h3 class="card-title fs-18 fw-bold">2</h3>
                                </div>
                                <div class="card-footer p-3">
                                    <div class="stats">
                                        <a href="outlate-list.html" class="warning-link">Total Outlet / Customar (Number)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card card-stats statistic-box mb-4">
                                <div class="card-header card-header-warning card-header-icon position-relative border-0 text-end px-3 py-0">
                                    <div class="card-icon d-flex align-items-center justify-content-center">
                                        <i class="typcn typcn-device-tablet"></i>
                                    </div>
                                    <p class="fs-15 fw-bold mt-3">Active Outlet / Customar (Purchase)</p>
                                    <h3 class="card-title fs-18 fw-bold">2</h3>
                                </div>
                                <div class="card-footer p-3">
                                    <div class="stats">
                                        <a href="outlate-list.html" class="warning-link">Active Outlet / Customar (Purchase)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3">
            <div class="card mb-4 flex-fill w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 fw-semi-bold mb-0">Outlate Channels</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chartdiv" style="width: 100%;
                    height: 400px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3">
            <div class="card mb-4 flex-fill w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 fw-semi-bold mb-0">Outlate Categories /Types</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chartdiv1" style="width: 100%;
                    height: 400px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3">
            <div class="card mb-4 flex-fill w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 fw-semi-bold mb-0">Outlate By Clients</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chartdiv2" style="width: 100%;
                    height: 400px;"></div>
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
                            <h6 class="fs-17 fw-semi-bold mb-0">Outlet By Region</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table display table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Store Name</th>
                                    <th>Address</th>
                                    <th>Location</th>
                                    <th>Amount</th>
                                    <th>Purchase</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>61</td>
                                </tr>
                                <tr>
                                    <td>Garrett Winters</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>63</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
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
                        <a href="{{url('public/assets/dist/img/pos/01.webp')}}" title="The Cleaner"><img class="p-2" src="{{url('public/assets/dist/img/pos/01.webp')}}" width="200" height="200"></a>
                        <a href="{{url('public/assets/dist/img/pos/02.webp')}}" title="Winter Dance"><img class="p-2" src="{{url('public/assets/dist/img/pos/02.webp')}}" width="200" height="200"></a>
                        <a href="{{url('public/assets/dist/img/pos/03.webp')}}" title="The Uninvited Guest"><img class="p-2" src="{{url('public/assets/dist/img/pos/03.webp')}}" width="200" height="200"></a>
                        <a href="{{url('public/assets/dist/img/pos/01.webp')}}" title="The Cleaner"><img class="p-2" src="{{url('public/assets/dist/img/pos/01.webp')}}" width="200" height="200"></a>
                        <a href="{{url('public/assets/dist/img/pos/02.webp')}}" title="Winter Dance"><img class="p-2" src="{{url('public/assets/dist/img/pos/02.webp')}}" width="200" height="200"></a>
                        <a href="{{url('public/assets/dist/img/pos/03.webp')}}" title="The Uninvited Guest"><img class="p-2" src="{{url('public/assets/dist/img/pos/03.webp')}}" width="200" height="200"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card mb-4 flex-fill w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 fw-semi-bold mb-0">Map Of Outlate Across Location</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="gmaps1"></div>
                </div>
            </div>
        </div>
    </div>


</div>


<script src="{{url('public/assets/plugins/amcharts5/index.js')}}"></script>
<script src="{{url('public/assets/plugins/amcharts5/percent.js')}}"></script>
<script src="{{url('public/assets/plugins/amcharts5/themes/Animated.js')}}"></script>
<script src="{{url('public/assets/plugins/amcharts5/xy.js')}}"></script>


<script src="{{url('public/assets/plugins/gmaps/gmaps.min.js')}}"></script>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyDcMXKkIZSG1Ev3nNkDE5vZpfT_KG9zBT8"></script>
<script src="{{url('public/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>

<script>
    am5.ready(function() {
        var root = am5.Root.new("chartdiv");

        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        var chart = root.container.children.push(am5percent.PieChart.new(root, {
            layout: root.verticalLayout
        }));

        var series = chart.series.push(am5percent.PieSeries.new(root, {
            valueField: "value",
            categoryField: "category"
        }));

        series.data.setAll([{
            value: 10,
            category: "One"
        }, {
            value: 9,
            category: "Two"
        }, {
            value: 6,
            category: "Three"
        }, ]);

        var legend = chart.children.push(am5.Legend.new(root, {
            centerX: am5.percent(50),
            x: am5.percent(50),
            marginTop: 15,
            marginBottom: 15
        }));

        legend.data.setAll(series.dataItems);

        series.appear(1000, 100);

    });
</script>
<script>
    am5.ready(function() {
        var root = am5.Root.new("chartdiv1");

        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        var chart = root.container.children.push(am5percent.PieChart.new(root, {
            layout: root.verticalLayout
        }));

        var series = chart.series.push(am5percent.PieSeries.new(root, {
            valueField: "value",
            categoryField: "category"
        }));

        series.data.setAll([{
            value: 10,
            category: "One"
        }, {
            value: 9,
            category: "Two"
        }, {
            value: 6,
            category: "Three"
        }, ]);

        var legend = chart.children.push(am5.Legend.new(root, {
            centerX: am5.percent(50),
            x: am5.percent(50),
            marginTop: 15,
            marginBottom: 15
        }));

        legend.data.setAll(series.dataItems);
        series.appear(1000, 100);

    });
</script>

<script>
    am5.ready(function() {
        var root = am5.Root.new("chartdiv2");

        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        var chart = root.container.children.push(am5percent.PieChart.new(root, {
            layout: root.verticalLayout
        }));

        var series = chart.series.push(am5percent.PieSeries.new(root, {
            valueField: "value",
            categoryField: "category"
        }));

        series.data.setAll([{
            value: 10,
            category: "One"
        }, {
            value: 9,
            category: "Two"
        }, {
            value: 6,
            category: "Three"
        }, {
            value: 5,
            category: "Four"
        }, ]);

        var legend = chart.children.push(am5.Legend.new(root, {
            centerX: am5.percent(50),
            x: am5.percent(50),
            marginTop: 15,
            marginBottom: 15
        }));

        legend.data.setAll(series.dataItems);

        series.appear(1000, 100);

    });
</script>


@endsection

@push('js')
@endpush