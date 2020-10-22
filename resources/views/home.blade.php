@extends('layouts.main')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('update') }}" method="POST">
                    @csrf
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">THIS IS YOUR INSENTIF FOR {{ strtoupper(date('F Y')) }}</h3>
                        </div>
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
                                        <th><span>{{ Carbon\Carbon::now()->translatedFormat('F Y') }}</span>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <br>
                            <div class="detail">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Hari</th>
                                            <th>Tanggal</th>
                                            <th>Uraian Pekerjaan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $itungan = 0;
                                        @endphp
                                        @foreach ($header[0]->daily as $report)
                                            @php
                                                $no = $loop->iteration;
                                                $act = $report->keterangan;

                                                if ($act == 1) {
                                                    $input = '<span>IZIN PULANG</span><input type="hidden" class="form-control" name="kegiatan[]" value="'.$report->kegiatan.'">';
                                                    $color = '#bdc3c7';
                                                }else if ($act == 2) {
                                                    $input = '<span>LIBUR</span><input type="hidden" class="form-control" name="kegiatan[]" value="'.$report->kegiatan.'">';
                                                    $color = '#ffc107';
                                                }else if ($act == 3) {
                                                    $input = '<span>MANGKIR</span><input type="hidden" class="form-control" name="kegiatan[]" value="'.$report->kegiatan.'">';
                                                    $color = '#dc3545';
                                                }else if($act == 4){
                                                    $input = '<span>TIDAK MASUK SAKIT</span><input type="hidden" class="form-control" name="kegiatan[]" value="'.$report->kegiatan.'">';
                                                    $color = '#bdc3c7';
                                                }else if($act == 5){
                                                    $input = '<span>CUTI</span><input type="hidden" class="form-control" name="kegiatan[]" value="'.$report->kegiatan.'">';
                                                    $color = '#bdc3c7';
                                                }else{
                                                    if ($report->kegiatan == null) {
                                                        $placeholder = 'placeholder="masukan kegiatan"';
                                                    }else {
                                                        $placeholder = '';
                                                    }
                                                    $input = '<input type="text" class="form-control kegiatan" name="kegiatan[]" value="'.$report->kegiatan.'" '.$placeholder.' tabindex="'.$no.'">';
                                                    $color = '';
                                                    $itungan++;
                                                }
                                            @endphp
                                            <tr data-row="{{ $no }}">
                                                <td>{{$report->hari}}<input type="hidden" class="form-control" name="id[]" value="{{$report->id}}"></td>
                                                <td>{{ Carbon\Carbon::parse($report->tanggal)->translatedFormat('d F Y') }}</td>
                                                <td style="background-color:{{$color}}" class="setInput"><?= $input; ?></td>
                                                <td><button type="button" class="btn btn-info btnConfg"><i class="fa fa-wrench"></i></button><input type="hidden" class="form-control keterangan" value="{{$report->keterangan}}" name="keterangan[]"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">Total Pendapatan Insentif Bulan Ini</td>
                                            <td>Rp. {{ number_format($itungan*14147,2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right displayGenerate">
                                <select class="slcAtasan" style="width:200px;" name="slcAtasan">
                                    <option class="selected" value="{{ $header[0]->atasan }}">{{ $header[0]->atasan }}</option>
                                </select>
                                <button type="submit" class="btn btn-primary" name="btnSubmit" value="1">Update</button>
                            </div>
                            <div class="float-left displayGenerate">
                                <a href="{{ route('generatepdf') }}" class="btn btn-danger" name="" >Generate Now</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
