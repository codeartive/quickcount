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
                                    <select class="form-control" id="kecamatan" name="kecamatan">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="kelurahan" name="kelurahan">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="rw" name="rw">
                                        <option></option>
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
                                    <select class="form-control" id="tps" name="tps">
                                        <option></option>
                                    </select>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="btn-group" style="width:100%">
                                        <button class="btn btn-primary btn-sm" style="width:100%" onclick="getDataPieChart()"><i class="fa fa-filter"></i>&nbsp;Filter Data</button>
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
                        <div class="card-body pieDiv">
                            <canvas id="pie"></canvas>
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

    function hexToRgb(hex) {
        // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
        var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
        hex = hex.replace(shorthandRegex, function (m, r, g, b) {
            return r + r + g + g + b + b;
        });

        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }

    function initSelect2(){
        jQuery('#kecamatan').select2({
            placeholder: "Kecamatan",
            allowClear: true
        });
        jQuery('#kelurahan').select2({
            placeholder: "Kelurahan",
            allowClear: true
        });
        jQuery('#rw').select2({
            placeholder: "RW",
            allowClear: true
        });
        jQuery('#tps').select2({
            placeholder: "TPS",
            allowClear: true
        });

        getKecamatan();
        getKelurahan();
        getRukunWarga();
        getTPS();

        getDataPieChart();
    }

    $('#kecamatan').on('select2:select', function(e) { 
        getKelurahan($(this).val());
    });

    $('#kelurahan').on('select2:select', function(e) { 
        getRukunWarga($(this).val());
    });

    $('#rw').on('select2:select', function(e) { 
        getTPS($(this).val());
    });

    function getDataPieChart(){
        var params = {
            byKecamatan: $('#kecamatan').val(),
            byKelurahan: $('#kelurahan').val(),
            byRW: $('#rw').val(),
            byTPS: $('#tps').val(),
        };
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        // console.log(params);
        $.ajax({
            url: "{{ url('utilities/voting') }}",
            method: "POST",
            data: {_token: CSRF_TOKEN, params: params},
            dataType: 'JSON',
            success: function(data) {
                console.log(data);
                // $('#tps').empty();
                $('.pieDiv').html('<canvas id="pie"></canvas>');
                myChart = new Chart(document.getElementById("pie").getContext('2d'),{
                    type:"pie",
                    data:{
                        "labels":data.caleg,
                        "datasets":[{
                            "label":"My First Dataset",
                            "data":data.total_suara,
                            "backgroundColor":data.color
                        }]
                    },
                    options:{
                        legend: {
                            position: "right",
                        },
                        plugins: {
                            labels: {
                                render: 'percentage',
                                fontColor: function (data) {
                                  var rgb = hexToRgb(data.dataset.backgroundColor[data.index]);
                                  var threshold = 140;
                                  var luminance = 0.299 * rgb.r + 0.587 * rgb.g + 0.114 * rgb.b;
                                  return luminance > threshold ? 'black' : 'white';
                                },
                                precision: 2
                            }
                        }
                    }
                });
            }
        });
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
            url: "{{ url('utilities/tps') }}"+'/'+id,
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