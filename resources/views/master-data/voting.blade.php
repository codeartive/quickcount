@extends('layouts.app')

@section('content')
<!-- Animated -->
<div class="animated fadeIn">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Data Hasil Pemilihan </h4>
                        <hr>
                        <button class="btn btn-success" data-toggle="modal" id="btnAdd" data-target="#staticModalAddVoting"><i class="fa fa-plus"></i> Upload Hasil Pemilihan</button>
                    </div>
                    <div class="card-body--">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Kelurahan</th>
                                    <th>RW</th>
                                    <th>TPS</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tps_list as $tps)
                                    <tr>
                                        <td>{{$tps->getRukunWarga()->kelurahan->name}}</td>
                                        <td>{{implode(', ',json_decode($tps->rukun_warga->pluck('name')))}}</td>
                                        <td>{{$tps->name}}</td>
                                        <td>{{$tps->address ?? "-"}}</td>
                                        <th><span class="btn btn-{{$tps->getStatus()['class']}} btn-sm">{{$tps->getStatus()['message']}}</span></th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- /.card -->
            </div>  <!-- /.col-lg-8 -->
        </div>
    </div>
    <!-- /.orders -->
</div>
<!-- .animated -->
@endsection

@section('modal-area')
<!-- Tambah Data -->
<div class="modal fade" id="staticModalAddVoting" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel"><strong>Upload Hasil Pemilihan</strong></h5>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('add.voting')}}" id="myForm" name="" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-control-label">
                                    Kecamatan:
                                </label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" id="kecamatan" name="kecamatan">
                                    <option></option>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-control-label">
                                    Kelurahan:
                                </label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" id="kelurahan" name="kelurahan">
                                    <option></option>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-control-label">
                                    RW:
                                </label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" id="rw" name="rw">
                                    <option></option>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-control-label">
                                    TPS:
                                </label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" id="tps" name="tps">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="row tblCaleg" style="display: none;margin-top: 20px;">
                            <div class="col-md-3">
                                <label class="form-control-label">
                                    Foto Bukti TPS:
                                </label>
                            </div>
                            <div class="col-md-9">
                                <input type="file" name="photo" class="form-control" id="photo">
                            </div>
                        </div><br>
                        <div class="row tblCaleg" style="display: none;">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Calon Legislatif</th>
                                            <th scope="col">Hasil Suara</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i=1;
                                        @endphp
                                        @forelse($caleg_list as $caleg)
                                        <tr>
                                            <th scope="row">{{$i++}}</th>
                                            <td>{{$caleg->name}}</td>
                                            <td>
                                                <input type="number" class="form-control hasil" name="hasil[{{$caleg->id}}]" style="width:100px;" value="0">
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3">Data Kosong</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <div class="pull-right">
                                    <input type="submit" id="btnSubmit" class="btn btn-primary" value="Upload">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional-js')
<script type="text/javascript">
    $(document).ready(function(){
        initSelect2();

        $('#photo').fileinput({
            maxFileSize: 10240,
            elErrorContainer: '#kartik-file-errors',
            allowedFileExtensions: ["jpg", "jpeg", "pdf", "png"],
            // dropZoneTitle: "Upload foto bukti TPS disini...",
            showUpload: false,
            showRemove: false,
            showPreview: false,
            {{-- // initialPreview: ["{{asset(Storage::url('/files/customer-po/'.$qo->getLatestRevision()->customer_po))}}"], --}}
            // initialPreviewAsData: true,
            // showRemove: false,
            // initialPreviewConfig: [
            {{-- //     {downloadUrl: "{{asset(Storage::url('/files/customer-po/'.$qo->getLatestRevision()->customer_po))}}", width: "120px", key: 1}, --}}
            // ],
            // overwriteInitial: true,
            // initialCaption: ""
        });
    });

    function initSelect2(){
        $('#kecamatan').select2({
            width: '100%',
            placeholder: 'Kecamatan',
            dropdownParent: $('#staticModalAddVoting'),
        });

        $('#kelurahan').select2({
            width: '100%',
            placeholder: 'Kelurahan',
            dropdownParent: $('#staticModalAddVoting'),
        });

        $('#rw').select2({
            width: '100%',
            placeholder: 'Rukun Warga',
            dropdownParent: $('#staticModalAddVoting'),
        });

        $('#tps').select2({
            width: '100%',
            placeholder: 'TPS',
            dropdownParent: $('#staticModalAddVoting'),
        });

        getKecamatan();
        getKelurahan();
        getRukunWarga();
        getTPS();
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

    $('#tps').on('select2:select', function(e) { 
        if($(this).val()==''){
            $('.tblCaleg').hide();
        }else{
            $('.tblCaleg').show();
        }
    });    

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