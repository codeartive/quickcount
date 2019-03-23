@extends('layouts.app')

@section('content')
<!-- Animated -->
<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Filter </h4><hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <select class="form-control" id="kecamatan" name="states">
                                        <option></option>
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="kelurahan" name="states">
                                        <option></option>
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="rukun_warga" name="states">
                                        <option></option>
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="rukun_tetangga" name="states">
                                        <option></option>
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="tps" name="states">
                                        <option></option>
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary btn-sm" style="width:100%"><i class="fa fa-filter"></i>&nbsp;Filter Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- /.row -->
                {{-- <div class="card-body"></div> --}}
            </div>
        </div><!-- /# column -->
    </div>
    <!--  Traffic  -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">Hasil Penghitungan Suara </h4>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <canvas id="traffic-chart" class="traffic-chart"></canvas>
                        </div>
                    </div>
                </div> <!-- /.row -->
                {{-- <div class="card-body"></div> --}}
            </div>
        </div><!-- /# column -->
    </div>
    <!--  /Traffic -->
                    
                    
    <div class="clearfix"></div>
    <!-- Orders -->
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Orders </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th class="avatar">Avatar</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="serial">1.</td>
                                        <td class="avatar">
                                            <div class="round-img">
                                                <a href="#"><img class="rounded-circle" src="images/avatar/1.jpg" alt=""></a>
                                            </div>
                                        </td>
                                        <td> #5469 </td>
                                        <td>  <span class="name">Louis Stanley</span> </td>
                                        <td> <span class="product">iMax</span> </td>
                                        <td><span class="count">231</span></td>
                                        <td>
                                            <span class="badge badge-complete">Complete</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="serial">2.</td>
                                        <td class="avatar">
                                            <div class="round-img">
                                                <a href="#"><img class="rounded-circle" src="images/avatar/2.jpg" alt=""></a>
                                            </div>
                                        </td>
                                        <td> #5468 </td>
                                        <td>  <span class="name">Gregory Dixon</span> </td>
                                        <td> <span class="product">iPad</span> </td>
                                        <td><span class="count">250</span></td>
                                        <td>
                                            <span class="badge badge-complete">Complete</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="serial">3.</td>
                                        <td class="avatar">
                                            <div class="round-img">
                                                <a href="#"><img class="rounded-circle" src="images/avatar/3.jpg" alt=""></a>
                                            </div>
                                        </td>
                                        <td> #5467 </td>
                                        <td>  <span class="name">Catherine Dixon</span> </td>
                                        <td> <span class="product">SSD</span> </td>
                                        <td><span class="count">250</span></td>
                                        <td>
                                            <span class="badge badge-complete">Complete</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="serial">4.</td>
                                        <td class="avatar">
                                            <div class="round-img">
                                                <a href="#"><img class="rounded-circle" src="images/avatar/4.jpg" alt=""></a>
                                            </div>
                                        </td>
                                        <td> #5466 </td>
                                        <td>  <span class="name">Mary Silva</span> </td>
                                        <td> <span class="product">Magic Mouse</span> </td>
                                        <td><span class="count">250</span></td>
                                        <td>
                                            <span class="badge badge-pending">Pending</span>
                                        </td>
                                    </tr>
                                    <tr class=" pb-0">
                                        <td class="serial">5.</td>
                                        <td class="avatar pb-0">
                                            <div class="round-img">
                                                <a href="#"><img class="rounded-circle" src="images/avatar/6.jpg" alt=""></a>
                                            </div>
                                        </td>
                                        <td> #5465 </td>
                                        <td>  <span class="name">Johnny Stephens</span> </td>
                                        <td> <span class="product">Monitor</span> </td>
                                        <td><span class="count">250</span></td>
                                        <td>
                                            <span class="badge badge-complete">Complete</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- /.table-stats -->
                    </div>
                </div> <!-- /.card -->
            </div>  <!-- /.col-lg-8 -->
        </div>
    </div>
    <!-- /.orders -->
</div>
<!-- .animated -->
@endsection

@section('additional-js')
<script>
    jQuery(document).ready(function($) {
        "use strict";
        
        // Traffic Chart using chartist
        if ($('#traffic-chart').length) {
        	var myChart = new Chart(document.getElementById("traffic-chart"),{
        		type:"pie",
        		data:{
        			"labels":[1,2,3,4,5,6,7,8,9,10],
        			"datasets":[{
        				"label":"My First Dataset",
        				"data":[30,50,70,20,86,72,96,28,19,42],
        				"backgroundColor":["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"]
        			}]
        		},
                options:{
                    legend: {
                        position: "right",
                    },
                    labels: {
                        render: 'percentage',
                    }
                }
            });
        }
        // Traffic Chart using chartist End
        initSelect2();
    });

    function initSelect2(){
        jQuery('#kecamatan').select2({
            placeholder: "Kecamatan",
            allowClear: true
        });
        jQuery('#kelurahan').select2({
            placeholder: "Kelurahan",
            allowClear: true
        });
        jQuery('#rukun_warga').select2({
            placeholder: "RW",
            allowClear: true
        });
        jQuery('#rukun_tetangga').select2({
            placeholder: "RT",
            allowClear: true
        });
        jQuery('#tps').select2({
            placeholder: "TPS",
            allowClear: true
        });

    }
</script>
@endsection