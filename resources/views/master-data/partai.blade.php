@extends('layouts.app')

@section('content')
<!-- Animated -->
<div class="animated fadeIn">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Partai </h4>
                        <hr>
                        <button class="btn btn-success" data-toggle="modal" id="btnAdd" data-target="#staticModalAddPartai"><i class="fa fa-plus"></i> Tambah Data</button>
                    </div>
                    <div class="card-body--">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Nama Partai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($partai_list as $partai)
                                    <tr>
                                        <td style="width:20%;">
                                            <button onclick="editData({{$partai->id}})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Ubah</button>
                                            <button data-toggle="modal" data-target="#staticModalDeletePartai" onclick="hapusData({{$partai->id}})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                        </td>
                                        <td>{{$partai->name}}</td>
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
<div class="modal fade" id="staticModalAddPartai" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel"><strong><span id="labelModal">Tambah</span> Data Partai</strong></h5>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('add.partai')}}" id="myForm" name="">
                    {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-control-label">
                                    Partai:
                                </label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama partai" required="required">
                            </div>
                        </div>
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
<div class="modal fade" id="staticModalDeletePartai" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel"><strong>Hapus Data Partai</strong></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        Anda yakin ingin menghapus data Partai?
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
    function editData(id) {
        $.ajax({
            url: "{{ url('master-data/partai/edit') }}" + '/'+id,
            method: "GET",
            dataType: 'JSON',
            success: function(data) {
                $('#name').val(data.name);
                $('#btnSubmit').removeAttr('value');
                $('#btnSubmit').attr('value','Ubah');
                $('#labelModal').text('Ubah');
                $('#myForm').removeAttr('action');
                $('#myForm').attr('action',"{{ url('master-data/partai/edit') }}" + '/'+id);
                $('#btnAdd').click();
            }
        });
    }

    function hapusData(id) {
        $('#btnHapus').removeAttr('href');
        $('#btnHapus').attr('href',"{{ url('master-data/partai/delete') }}" + '/'+id);
    }

    $('#staticModalAddPartai').on('hidden.bs.modal', function () {
        $('#name').val('');
        $('#btnSubmit').removeAttr('value');
        $('#btnSubmit').attr('value','Tambah');
        $('#labelModal').text('Tambah');
        $('#myForm').removeAttr('action');
        $('#myForm').attr('action','{{route('add.partai')}}');
    });
</script>
@endsection