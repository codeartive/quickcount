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
                                <div class="col-md-3">
                                    <select class="form-control" id="kecamatan" name="states">
                                        <option></option>
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="kelurahan" name="states">
                                        <option></option>
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="rukun_warga" name="states">
                                        <option></option>
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                                {{-- <div class="col-md-2">
                                    <select class="form-control" id="rukun_tetangga" name="states">
                                        <option></option>
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div> --}}
                                <div class="col-md-3">
                                    <select class="form-control" id="tps" name="states">
                                        <option></option>
                                        <option value="AL">Alabama</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="btn-group" style="width:100%">
                                        <button class="btn btn-primary btn-sm" style="width:100%"><i class="fa fa-filter"></i>&nbsp;Filter Data</button>
                                        <button class="btn btn-danger btn-sm" style="width:100%"><i class="fa fa-refresh"></i>&nbsp;Clear Filter</button>
                                    </div>
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
    <div class="row piechartDiv">
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
    <!-- /.orders -->
</div>
<!-- .animated -->
@endsection

@section('additional-js')
<script>
    var myChart = null;
    jQuery(document).ready(function($) {
        "use strict";
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

    function getDataPieChart(params){
        function getTPS(id='') {
            $.ajax({
                url: "{{ url('utilities/voting') }}",
                method: "POST",
                data: params,
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    $('#tps').empty();
                    myChart = new Chart(document.getElementById("traffic-chart"),{
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
            });
        }
        
    }

    function getKecamatan() {
        $.ajax({
            url: "{{ url('utilities/kecamatan') }}",
            method: "GET",
            dataType: 'JSON',
            success: function(data) {
                $('#kecamatan').empty();
                $.each( data, function( key, value ) {
                    var newOption = new Option(value.text, value.id, true, true);
                    $('#kecamatan').append(newOption).val('').trigger('change');
                });
            }
        });
    }

    function getKelurahan(id='') {
        $.ajax({
            url: "{{ url('utilities/kelurahan') }}"+'/'+id,
            method: "GET",
            dataType: 'JSON',
            success: function(data) {
                // console.log(data);
                $('#kelurahan').empty();
                $.each( data, function( key, value ) {
                    var newOption = new Option(value.text, value.id, true, true);
                    $('#kelurahan').append(newOption).val('').trigger('change');
                });
            }
        });
    }

    function getRukunWarga(id='') {
        $.ajax({
            url: "{{ url('utilities/rukun-warga') }}"+'/'+id,
            method: "GET",
            dataType: 'JSON',
            success: function(data) {
                // console.log(data);
                $('#rw').empty();
                $.each( data, function( key, value ) {
                    var newOption = new Option(value.text, value.id, true, true);
                    $('#rw').append(newOption).val('').trigger('change');
                });
            }
        });
    }

    function getTPS(id='') {
        $.ajax({
            url: "{{ url('utilities/tps/filtered') }}"+'/'+id,
            method: "GET",
            dataType: 'JSON',
            success: function(data) {
                // console.log(data);
                $('#tps').empty();
                $.each( data, function( key, value ) {
                    var newOption = new Option(value.text, value.id, true, true);
                    $('#tps').append(newOption).val('').trigger('change');
                });
            }
        });
    }
</script>
@endsection