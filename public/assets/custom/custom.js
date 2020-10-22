$(document).ready(function () {
    var date = new Date();
    var weekday = new Array();
    weekday[0] = "Minggu";
    weekday[1] = "Senin";
    weekday[2] = "Selasa";
    weekday[3] = "Rabu";
    weekday[4] = "Kamis";
    weekday[5] = "Jum'at";
    weekday[6] = "Sabtu";

    if (weekday[date.getDay()]== "Minggu") {
        $('.hdnKeterangan').val('2');
    }else{
        $('.hdnKeterangan').val('6');
    }

    $('.hariIni').html(weekday[date.getDay()]);
    $('.hdnHari').val(weekday[date.getDay()]);

    $('.slcBulan').select2({
        placeholder : 'Pilih Bulan',
    })
    
    $('.slcBulanDraft').select2({
        placeholder : 'Pilih Bulan',
    })

    $('.slcKegiatan').select2();
    $('.slcAtasan').select2({
        placeholder: 'Pilih Atasan'
    });

    $(document).on('change','.slcBulanDraft',function () {
        var header_id = $(this).val();
        var namaBulan = $(this).select2('data')[0]['title'];
        $('.hdnBulan').val(namaBulan);
        $.ajax({
            type: "POST",
            url: baseurl+"GetDraft",
            data: {
                header_id : header_id,
            },
            success: function (response) {
                $('.tableMain').html(response);
                $('.displayBatch').css('display','block');
                $('.displayGenerate').css('display','block');
            }
        });

        $.ajax({
            type: "POST",
            url: baseurl+"GetHeaderDraft",
            data: {
                header_id : header_id,
            },
            dataType:'JSON',
            success: function (response) {
                $('.slcAtasan').val(response[0]['atasan']).trigger('change.select2');
            }
        });
    })

    $(document).on('change','.slcBulan', function () {
        var date = new Date()
        var bulan = $(this).val();
        var namaBulan = $(this).select2('data')[0]['title'];
        // $('.hdnBulan').val(namaBulan);
        // alert(namaBulan);
        var params = new Date(date.getFullYear(), Number(bulan), 0);
        // alert(bulan);
        var tanggalAkhirBulan = params.getDate();

        $('.displayBatch').css('display','block');
        $('.displayGenerate').css('display','block');
        $('.displayAtasan').css('display','block');
 
        var weekday = new Array();
            weekday[0] = "Minggu";
            weekday[1] = "Senin";
            weekday[2] = "Selasa";
            weekday[3] = "Rabu";
            weekday[4] = "Kamis";
            weekday[5] = "Jum'at";
            weekday[6] = "Sabtu";

        var html=   '<table class="table table-bordered text-center">'+
                        '<thead>'+
                            '<tr class="bg-primary">'+
                                '<th>Hari</th>'+
                                '<th>Tanggal</th>'+
                                '<th>Uraian Pekerjaan</th>'+
                                '<th>Action</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>';
                            for (let i = 1; i <= tanggalAkhirBulan; i++) {
                                var tgl = new Date(date.getFullYear(), Number(bulan)-1,Number(i));
                                // alert(tgl);
                                if (weekday[tgl.getDay()] == 'Minggu') {
                                    var input = '<span>LIBUR</span><input type="hidden" class="form-control" name="kegiatan[]" placeholder="masukan kegiatan">';
                                    var color = 'background-color:#ffc107';
                                    var keterangan = "2";
                                }else{
                                    input = '<input type="text" class="form-control kegiatan" name="kegiatan[]" placeholder="masukan kegiatan" tabindex="'+i+'">';
                                    color = '';
                                    keterangan = "6";
                                }
                                html+=  '<tr data-row="'+i+'">'+
                                            '<td>'+weekday[tgl.getDay()]+'<input type="hidden" class="form-control" name="hari[]" value="'+weekday[tgl.getDay()]+'"></td>'+
                                            '<td>'+("0" + tgl.getDate()).slice(-2)+' '+namaBulan+' '+tgl.getFullYear()+'<input type="hidden" class="form-control" name="tanggal[]" value="'+("0" + tgl.getDate()).slice(-2)+'-'+("0"+bulan).slice(-2)+'-'+tgl.getFullYear()+'"></td>'+
                                            '<td style="'+color+'" class="setInput">'+input+'</td>'+
                                            '<td><button type="button" class="btn btn-info btnConfg"><i class="fa fa-wrench"></i></button><input type="hidden" class="form-control keterangan" value="'+keterangan+'" name="keterangan[]"></td>'+
                                        '</tr>';
                            }
            html+=      '</tbody>'+
                    '</table>';

        $('.tableMain').html(html);
        // console.log(html)
    })

    $(document).on('click','.btnConfg', function () {
        var tr = $(this).closest('tr');
        var row_id = tr.attr('data-row');

        $('.hdnRowId').val(row_id);
        
        $('#mdlSetting').modal('show');

    })
    
    $(document).on('click','.btnConfirmSet', function () {
        var act = $('.slcKegiatan').val();
        var row_id = $('.hdnRowId').val();
        if (act == 1) {
            var input = '<span>IZIN PULANG</span><input type="hidden" class="form-control" name="kegiatan[]" placeholder="masukan kegiatan">';
            var color = '#bdc3c7';
        }else if (act == 2) {
            input = '<span>LIBUR</span><input type="hidden" class="form-control" name="kegiatan[]" placeholder="masukan kegiatan">';
            color = '#ffc107';
        }else if (act == 3) {
            input = '<span>MANGKIR</span><input type="hidden" class="form-control" name="kegiatan[]" placeholder="masukan kegiatan">';
            color = '#dc3545';
        }else if(act == 4){
            input = '<span>TIDAK MASUK SAKIT</span><input type="hidden" class="form-control" name="kegiatan[]" placeholder="masukan kegiatan">';
            color = '#bdc3c7';
        }else if(act == 5){
            input = '<span>CUTI</span><input type="hidden" class="form-control" name="kegiatan[]" placeholder="masukan kegiatan">';
            color = '#bdc3c7';
        }else{
            input = '<input type="text" class="form-control kegiatan" name="kegiatan[]" placeholder="masukan kegiatan" tabindex="'+row_id+'">';
            color = '';
        }
        $('tr[data-row="'+row_id+'"]').find('.keterangan').val(act);
        $('tr[data-row="'+row_id+'"]').find('.setInput').html(input);
        $('tr[data-row="'+row_id+'"]').find('.setInput').css('background-color',color);
        $('#mdlSetting').modal('hide');
    })

    $(document).on('click','.btnKgtnAll',function () {
        var kegiatanAll = $('.kgtnAll').val();
        $('.kegiatan').val(kegiatanAll);
    })

})