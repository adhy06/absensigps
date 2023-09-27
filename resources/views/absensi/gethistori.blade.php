@if ($histori->isEmpty())
<div class="alert alert-outline-warning">
    <p>Tidak Ada Data</p>
</div>
    
@endif

@foreach ($histori as $d)
<ul class="listview image-listview">
        <li>
            <div class="item">
                @php
                    $path = Storage::url('uploads/presensi/'.$d->foto_masuk);   
                @endphp
                <img src="{{ url($path)}}" alt="image" class="image">
                <div class="in">
                    <div>
                        <b>{{ date("d-m-Y", strtotime($d->tgl_absensi)) }}</b>
                    </div>
                    <span class="badge {{ $d->jam_masuk < "08:00" ? "bg-success" : "bg-danger"}} ">
                        <b>{{ $d->jam_masuk }}</b>
                    </span>
                    <span class="badge bg-primary"><b>{{ $d->jam_masuk }}</b>
                    </span>
                </div>
            </div>
        </li>

</ul>
@endforeach