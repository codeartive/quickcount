@extends('layouts.app')

@section('content')
<!-- Animated -->
<div class="animated fadeIn">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Calon Legislatif</h4>
                        <hr>
                        <button class="btn btn-success" data-toggle="modal" id="btnAdd" data-target="#staticModalAddCaleg"><i class="fa fa-plus"></i> Tambah Data</button>
                    </div>
                    <div class="card-body--">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Nama Partai</th>
                                    <th>Nama Calon Legislatif</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($caleg_list as $caleg)
                                    <tr>
                                        <td style="width:20%;">
                                            <button onclick="editData({{$caleg->id}})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Ubah</button>
                                            <button data-toggle="modal" data-target="#staticModalDeleteCaleg" onclick="hapusData({{$caleg->id}})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                        </td>
                                        <td>{{$caleg->partai->name}}</td>
                                        <td>{{$caleg->name}}</td>
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
<div class="modal fade" id="staticModalAddCaleg" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel"><strong><span id="labelModal">Tambah</span> Data Calon Legislatif</strong></h5>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('add.calon-legislatif')}}" id="myForm" name="">
                    {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-control-label">
                                    Partai:
                                </label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" id="partai" name="partai">
                                    <option></option>
                                </select>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-control-label">
                                    Nama Calon Legislatif:
                                </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama calon legislatif" required="required">
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
<div class="modal fade" id="staticModalDeleteCaleg" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel"><strong>Hapus Data Calon Legislatif</strong></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        Anda yakin ingin menghapus data Calon Legislatif?
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
            url: "{{ url('master-data/calon-legislatif/edit') }}" + '/'+id,
            method: "GET",
            dataType: 'JSON',
            success: function(data) {
                $('#name').val(data.name);
                $('#partai').val(data.partai_id).trigger('change');
                // $('#name').val(data.result.name);
                // $('#kecamatan').val(data.result.kecamatan_id).trigger('change');
                // $('#jumlah_rw').val(data.jumlah_rw);
                $('#btnSubmit').removeAttr('value');
                $('#btnSubmit').attr('value','Ubah');
                $('#labelModal').text('Ubah');
                $('#myForm').removeAttr('action');
                $('#myForm').attr('action',"{{ url('master-data/calon-legislatif/edit') }}" + '/'+id);
                $('#btnAdd').click();
            }
        });
    }

    function hapusData(id) {
        $('#btnHapus').removeAttr('href');
        $('#btnHapus').attr('href',"{{ url('master-data/calon-legislatif/delete') }}" + '/'+id);
    }

    $('#staticModalAddCaleg').on('hidden.bs.modal', function () {
        $('#name').val('');
        $('#partai').val('').trigger('change');
        // $('#jumlah_rw').val('0');
        $('#btnSubmit').removeAttr('value');
        $('#btnSubmit').attr('value','Tambah');
        $('#labelModal').text('Tambah');
        $('#myForm').removeAttr('action');
        $('#myForm').attr('action','{{route('add.calon-legislatif')}}');
    });

    function initSelect2(){
        $('#partai').select2({
            width: '100%',
            placeholder: 'Partai',
            dropdownParent: $('#staticModalAddCaleg'),
        });

        getPartai();
    }

    function getPartai() {
        $.ajax({
            url: "{{ url('utilities/partai') }}",
            method: "GET",
            dataType: 'JSON',
            success: function(data) {
                $('#partai').empty();
                $.each( data, function( key, value ) {
                    var newOption = new Option(value.text, value.id, true, true);
                    $('#partai').append(newOption).val('').trigger('change');
                });
            }
        });
    }
</script>
@endsection