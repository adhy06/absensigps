@php
     function selisih($jam_masuk, $jam_keluar)
        {
            list($h, $m, $s) = explode(":", $jam_masuk);
            $dtAwal = mktime($h, $m, $s, "1", "1", "1");
            list($h, $m, $s) = explode(":", $jam_keluar);
            $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = explode(".", $totalmenit / 60);
            $sisamenit = ($totalmenit / 60) - $jam[0];
            $sisamenit2 = $sisamenit * 60;
            $jml_jam = $jam[0];
            return $jml_jam . ":" . round($sisamenit2);
        }
@endphp

@foreach ($absensi as $d)
@php
    $foto_masuk = Storage::url('uploads/presensi/'.$d->foto_masuk);
    $foto_pulang = Storage::url('uploads/presensi/'.$d->foto_pulang);
@endphp
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $d->nik }}</td>
    <td>{{ $d->nama_lengkap }}</td>
    <td>{{ $d->nama_dept }}</td>
    <td>{{ $d->jabatan }}</td>
    <td>{{ $d->jam_masuk }}</td>
    <td>
        <img src="{{ url($foto_masuk)}}" class="avatar" alt="">
    </td>
    <td>{!! $d->jam_pulang != null ? $d->jam_pulang : '<span class="Badge bg-danger">Belum Absen</span>'!!}</td>
    <td>
        @if ($d->jam_pulang != null)
        <img src="{{ url($foto_pulang)}}" class="avatar" alt="">
        @else
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M15 8h.01"></path>
            <path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z"></path>
            <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5"></path>
            <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3"></path>
         </svg>
        @endif
    </td>
    <td>
    @if ($d->jam_masuk >= '08:00')
    @php
    $jamterlambat = selisih('08:00:00',$d->jam_masuk)
    @endphp
    <span class="badge bg-danger text-white">Terlambat {{ $jamterlambat }}</span>
    @else 
    <span class="badge bg-success text-white">Tepat Waktu</span>
    @endif    
    </td>
    <td>
        <a href="#" class="btn btn-primary tampilkanpeta" id="{{ $d->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5"></path>
                <path d="M9 4v13"></path>
                <path d="M15 7v5.5"></path>
                <path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z"></path>
                <path d="M19 18v.01"></path>
             </svg>
        </a>
    </td>
    
</tr>
@endforeach

<script>
    $(function(){
        $(".tampilkanpeta").click(function(e){
            var id = $(this).attr("id");
            $.ajax({
                type    : 'POST',
                url     : '/tampilkanpeta',
                data    : {
                    _token:"{{ csrf_token() }}",
                    id: id
                },
                cache : false,
                success:function(respond){
                    $("#loadmap").html(respond);
                },
            });
            $("#modal-tampilkanpeta").modal("show");
        });
    });
</script>