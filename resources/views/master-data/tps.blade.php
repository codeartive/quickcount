@extends('layouts.app')

@section('content')
<!-- Animated -->
<div class="animated fadeIn">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Tempat Pemungutan Suara </h4>
                        <hr>
                        <button class="btn btn-success" data-toggle="modal" id="btnAdd" data-target="#staticModalAddTPS"><i class="fa fa-plus"></i> Tambah Data</button>
                    </div>
                    <div class="card-body--">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Nama Kecamatan</th>
                                    <th>Nama Kelurahan</th>
                                    <th>RW</th>
                                    <th>TPS</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tps_list as $tps)
                                    <tr>
                                        <td style="width:20%;">
                                            <button onclick="editData({{$tps->id}})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Ubah</button>
                                            <button data-toggle="modal" data-target="#staticModalDeleteTPS" onclick="hapusData({{$tps->id}})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                        </td>
                                        <td>{{$tps->getRukunWarga()->kelurahan->kecamatan->name}}</td>
                                        <td>{{$tps->getRukunWarga()->kelurahan->name}}</td>
                                        <td>{{implode(', ',json_decode($tps->rukun_warga->pluck('name')))}}</td>
                                        <td>{{$tps->name}}</td>
                                        <td>{{$tps->address ?? "-"}}</td>
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
<div class="modal fade" id="staticModalAddTPS" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel"><strong><span id="labelModal">Tambah</span> Data TPS</strong></h5>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('add.tps')}}" id="myForm" name="">
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
                                    Nama TPS:
                                </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama tps" required="required">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-control-label">
                                    Alamat TPS:
                                </label>
                            </div>
                            <div class="col-md-9">
                                <textarea id="address" name="address" class="form-control" placeholder="Masukkan alamat tps"></textarea>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-control-label">
                                    RW:
                                </label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" id="rw" name="rw[]" multiple="multiple">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-3">
                                <label class="form-control-label">
                                    Jumlah RW:
                                </label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" id="jumlah_rw" name="jumlah_rw" value="0" class="form-control" required="required">
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <div class="pull-right">
                                    <input type="submit" id="btnSubmit" class="btn btn-primary" value="Tambah">
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

<!-- Hapus Data -->
<div class="modal fade" id="staticModalDeleteTPS" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel"><strong>Hapus Data TPS</strong></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        Anda yakin ingin menghapus data TPS?
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <div class="pull-right">
                            <a id="btnHapus" class="btn btn-danger">Hapus</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional-js')
<script type="text/javascript">
    $(document).ready(function(){
        initSelect2();
    });

    function editData(id) {
        $.ajax({
            url: "{{ url('master-data/tps/edit') }}" + '/'+id,
            method: "GET",
            dataType: 'JSON',
            success: function(data) {
                console.log(data);
                $('#name').val(data.tps.name);
                $('#address').val(data.tps.address);
                $('#kecamatan').val(data.kecamatan.id).trigger('change');
                // $('#kecamatan').val(data.kelurahan.kecamatan.id).trigger('select2:select');
                $('#kelurahan').val(data.kelurahan.id).trigger('change');
                $('#rw').val(data.rw).trigger('change');
                // $('#name').val(data.result.name);
                // $('#kecamatan').val(data.result.kecamatan_id).trigger('change');
                // $('#jumlah_rw').val(data.jumlah_rw);
                $('#btnSubmit').removeAttr('value');
                $('#btnSubmit').attr('value','Ubah');
                $('#labelModal').text('Ubah');
                $('#myForm').removeAttr('action');
                $('#myForm').attr('action',"{{ url('master-data/tps/edit') }}" + '/'+id);
                $('#btnAdd').click();
            }
        });
    }

    function hapusData(id) {
        $('#btnHapus').removeAttr('href');
        $('#btnHapus').attr('href',"{{ url('master-data/tps/delete') }}" + '/'+id);
    }

    $('#staticModalAddTPS').on('hidden.bs.modal', function () {
        $('#name').val('');
        $('#address').val('');
        $('#kecamatan').val('').trigger('change');
        $('#kelurahan').val('').trigger('change');
        $('#rw').val('').trigger('change');
        // $('#jumlah_rw').val('0');
        $('#btnSubmit').removeAttr('value');
        $('#btnSubmit').attr('value','Tambah');
        $('#labelModal').text('Tambah');
        $('#myForm').removeAttr('action');
        $('#myForm').attr('action','{{route('add.tps')}}');
    });

    function initSelect2(){
        $('#kecamatan').select2({
            width: '100%',
            placeholder: 'Kecamatan',
            dropdownParent: $('#staticModalAddTPS'),
        });

        $('#kelurahan').select2({
            width: '100%',
            placeholder: 'Kelurahan',
            dropdownParent: $('#staticModalAddTPS'),
        });

        $('#rw').select2({
            width: '100%',
            placeholder: 'Rukun Warga',
            dropdownParent: $('#staticModalAddTPS'),
        });

        getKecamatan();
        getKelurahan();
        getRukunWarga();
    }

    $('#kecamatan').on('select2:select', function(e) { 
        getKelurahan($(this).val());
    });

    $('#kelurahan').on('select2:select', function(e) { 
        getRukunWarga($(this).val());
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
                console.log(data);
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
                console.log(data);
                $('#rw').empty();
                $.each( data, function( key, value ) {
                    var newOption = new Option(value.text, value.id, true, true);
                    $('#rw').append(newOption).val('').trigger('change');
                });
            }
        });
    }
</script>
@endsection