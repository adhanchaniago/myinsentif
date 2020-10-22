<style>
    /* .mrgn {
        margin-top : 10;
		margin-left : 10;
		margin-right : 3;
		margin-bottom : 2;
        font-family : arial;
    } */
@page {margin-top : 10; margin-left : 10; margin-right : 3; margin-bottom : 2; font-family : 'arial';}
</style>
<div class="mrgn">
    @php
    $border = "border:1px solid black";
    $fontsize = "font-size:11px";
    $waktuMulai = "7.20'";
    $ip = "100%";
    @endphp
    <table>
        <tr>
            <th align="left" style="<?= $fontsize; ?>">KELOMPOK PEKERJAAN</th>
            <th style="<?= $fontsize; ?>">:</th>
            <th align="left" style="<?= $fontsize; ?>;width:19.7cm">{{ strtoupper(Auth::user()->jabatan) }}</th>
            <th align="left"></th>
            <th align="left"></th>
            <th align="left"></th>
        </tr>
        <tr>
            <th align="left" style="<?= $fontsize; ?>">NAMA</th>
            <th style="<?= $fontsize; ?>">:</th>
            <th align="left" style="<?= $fontsize; ?>">{{ strtoupper(Auth::user()->name) }}</th>
            <th align="left"></th>				
            <th align="left"></th>			
            <th align="left"></th>
        </tr>
        <tr>
            <th align="left" style="<?= $fontsize; ?>">NO.INDUK</th>
            <th style="<?= $fontsize; ?>">:</th>
            <th align="left" style="<?= $fontsize; ?>">{{ strtoupper(Auth::user()->username) }}</th>
            <th align="left">Bulan</th>
            <th align="left">:</th>
            <th align="left">{{ Carbon\Carbon::now()->translatedFormat("F Y") }}</th>
        </tr>
    </table><br>
    <table style="border-collapse: collapse">
        <thead>
            <tr>
                <th style="{{ $border }};width:1.5cm;<?= $fontsize; ?>" rowspan="2">Hari</th>
                <th style="{{ $border }};width:3cm;<?= $fontsize; ?>" rowspan="2">Tanggal</th>
                <th style="{{ $border }};width:8cm;<?= $fontsize; ?>" rowspan="2">Uraian Pekerjaan</th>
                <th style="{{ $border }};word-wrap: break-word; width:1.2cm;<?= $fontsize; ?>" rowspan="2">Target Waktu</th>
                <th style="{{ $border }};<?= $fontsize; ?>;" colspan="2">Waktu</th>
                <th style="{{ $border }};<?= $fontsize; ?>;word-wrap: break-word; width:1.2cm" rowspan="2">Total Waktu</th>
                <th style="{{ $border }};<?= $fontsize; ?>; width:1.2cm" rowspan="2">Ip %</th>
                <th style="{{ $border }};<?= $fontsize; ?>;word-wrap: break-word; width:2cm" rowspan="2">Persetujuan Kualitas</th>
                <th style="width:1.5cm"></th>
                <th colspan="6" style="{{ $border }};<?= $fontsize; ?>;">Kondite</th>
            </tr>
            <tr>
                <th style="{{ $border }};<?= $fontsize; ?>;width:1.3cm">Mulai</th>
                <th style="{{ $border }};<?= $fontsize; ?>;width:1.3cm">Selesai</th>
                <th>&nbsp;&nbsp;&nbsp;</th>
                <th style="{{ $border }};<?= $fontsize; ?>;width:0.8cm">Mk</th>
                <th style="{{ $border }};<?= $fontsize; ?>;width:0.8cm">I</th>
                <th style="{{ $border }};<?= $fontsize; ?>;width:0.8cm">Pk</th>
                <th style="{{ $border }};<?= $fontsize; ?>;width:0.8cm">Kp</th>
                <th style="{{ $border }};<?= $fontsize; ?>;width:0.8cm">Kk</th>
                <th style="{{ $border }};<?= $fontsize; ?>;width:0.8cm">Pk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($header[0]->daily as $report)
                @php
                if ($report->hari == "Jum'at" && $report->kegiatan) {
                    $waktuMulai = "7.20'";
                    $targetWaktu = "360";
                    $waktuSelesai = "14.35'";
                    $ip = "100%";
                }else if ($report->hari == "Sabtu" && $report->kegiatan) {
                    $waktuMulai = "7.20'";
                    $targetWaktu = "360";
                    $waktuSelesai = "14.20'";
                    $ip = "100%";
                }else if($report->kegiatan){
                    $targetWaktu = "420";
                    $waktuSelesai = "15.20'";
                    $waktuMulai = "7.20'";
                    $ip = "100%";
                }else{
                    $targetWaktu = "";
                    $waktuSelesai = "";
                    $waktuMulai = "";
                    $ip ="";
                }		
                if ($report->keterangan == 2) {
                    $backgroundColor = "background-color:#f1c40f";
                    $note = "LIBUR";
                @endphp
                    <tr>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ $report->hari }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ Carbon\Carbon::parse($report->tanggal)->translatedFormat("d F Y") }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;{{ $backgroundColor }}"colspan="7"><?= $note; ?></td>
                        <td></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                    </tr>
                @php
                }else if ($report->keterangan == 1) {
                    $backgroundColor = "background-color:#bdc3c7";
                    $note = "IZIN PULANG";
                @endphp
                    <tr>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ $report->hari }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ Carbon\Carbon::parse($report->tanggal)->translatedFormat("d F Y") }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;{{ $backgroundColor }}"colspan="7"><?= $note; ?></td>
                        <td></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                    </tr>
                @php
                }else if ($report->keterangan == 3) {
                    $backgroundColor = "background-color:#dc3545";
                    $note = "MANGKIR";
                @endphp
                    <tr>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ $report->hari }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ Carbon\Carbon::parse($report->tanggal)->translatedFormat("d F Y") }} </td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;{{ $backgroundColor }}"colspan="7"><?= $note; ?></td>
                        <td></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                    </tr>
                @php
                }else if ($report->keterangan == 4) {
                    $backgroundColor = "background-color:#bdc3c7";
                    $note = "TIDAK MASUK SAKIT";
                @endphp
                    <tr>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ $report->hari }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ Carbon\Carbon::parse($report->tanggal)->translatedFormat("d F Y") }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;{{ $backgroundColor }}"colspan="7"><?= $note; ?></td>
                        <td></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                    </tr>
                @php
                }else if ($report->keterangan == 5) {
                    $backgroundColor = "background-color:#bdc3c7";
                    $note = "CUTI";
                @endphp
                    <tr>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ $report->hari }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ Carbon\Carbon::parse($report->tanggal)->translatedFormat("d F Y") }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;{{ $backgroundColor }}"colspan="7"><?= $note; ?></td>
                        <td></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                    </tr>
                @php
                }else {
                @endphp
                    <tr>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ $report->hari }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ Carbon\Carbon::parse($report->tanggal)->translatedFormat("d F Y") }}</td>
                        <td align="left" style="{{ $border }};<?= $fontsize; ?>;">{{ $report->kegiatan }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ $targetWaktu }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ $waktuMulai }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ $waktuSelesai }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ $targetWaktu }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;">{{ $ip }}</td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                        <td align="center" style="{{ $border }};<?= $fontsize; ?>;"></td>
                    </tr>
                    @php } @endphp
            @endforeach
        </tbody>
    </table>
    <br>
    <table>
        <tr>
            <th style="<?= $fontsize; ?>;width:17cm">&nbsp;</th>
            <td align="center" style="<?= $fontsize; ?>;">Yogyakarta, {{ Carbon\Carbon::now()->translatedFormat("d F Y") }}</td>
        </tr>
        <tr>
            <th style="<?= $fontsize; ?>;"></th>
            <th style="<?= $fontsize; ?>;height:1.5cm"></th>
        </tr>
        <tr>
            <th style="<?= $fontsize; ?>;"></th>
            <td align="center" style="<?= $fontsize; ?>;">( {{ $header[0]->atasan }} )</td>
        </tr>
    </table>
</div>