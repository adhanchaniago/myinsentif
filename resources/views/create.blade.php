@extends('layouts.main')

@section('content')
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">CREATE INSENTIF</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <form action="{{ route('save') }}" method="POST">
                    @csrf
                        <div class="card-body">
                            <div>
                                <table>
                                    <tr>
                                        <td>KELOMPOK PEKERJAAN</td>
                                        <td>&nbsp;&nbsp;:</td>
                                        <td>&nbsp;{{ strtoupper(Auth::user()->jabatan) }}<input type="hidden" class="form-control" name="jabatan" value=""></td>
                                    </tr>
                                    <tr>
                                        <td>NAMA</td>
                                        <td>&nbsp;&nbsp;:</td>
                                        <td>&nbsp;{{ strtoupper(Auth::user()->name) }}<input type="hidden" class="form-control" name="nama" value=""></td>
                                    </tr>
                                    <tr>
                                        <td>NO.INDUK</td>
                                        <td>&nbsp;&nbsp;:</td>
                                        <td>&nbsp;{{ strtoupper(Auth::user()->username) }}<input type="hidden" class="form-control" name="noind" value=""></td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                                <div class="float-right">
                                    <table>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>:</th>
                                            <th>
                                                <select class="slcBulan" style="width:200px;" name="bulan">
                                                    <option value=""></option>
                                                    @for ($i=1; $i <= 12; $i++)
                                                        @php
                                                            $form = DateTime::createFromFormat('!m', $i);
                                                        @endphp
                                                        <option value="{{$i}}" title="{{ Carbon\Carbon::parse($form)->translatedFormat('F') }}">{{ Carbon\Carbon::parse($form)->translatedFormat('F') }}</option>
                                                    @endfor
                                                </select>
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="displayBatch" style="display:none">
                                    <table>
                                        <tr>
                                            <td><input type="text" class="form-control kgtnAll" placeholder="Input Batch Kegiatan"></td>
                                            <td></td>
                                            <td><button type="button" class="btn btn-primary btnKgtnAll">Set to all</button></td>
                                        </tr>
                                    </table>
                                </div>
                                <br>
                                <br>
                                <div class="tableMain">
                                </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right displayGenerate" style="display:none">
                                <select class="slcAtasan" style="width:200px;" name="atasan" required>
                                    <option></option>
                                    <option value="NUGROHO">NUGROHO</option>
                                </select>
                                <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">Save</button>
                            </div>
                            <div class="float-left displayGenerate" style="display:none">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
    <div class="modal fade" id="mdlSetting">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><i class="fa fa-wrench"></i> Setting</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <select class="slcKegiatan" style="width:260px;">
                  <option value="1">IZIN PULANG</option>
                  <option value="2">LIBUR</option>
                  <option value="3">MANGKIR</option>
                  <option value="4">TIDAK MASUK SAKIT</option>
                  <option value="5">CUTI</option>
                  <option value="6">MASUK</option>
              </select>
              <input type="hidden" class="form-control hdnRowId" value="">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary btnConfirmSet">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection