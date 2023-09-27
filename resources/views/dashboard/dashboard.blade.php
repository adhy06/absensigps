@extends('layout.absensi')
@section('content')
    
<div class="section" id="user-section">
    <div id="user-detail">
        <div class="avatar">
            @if (!@empty(Auth::guard('karyawan')->user()->foto))
            @php
                $path = Storage::url('uploads/karyawan/' .Auth::guard('karyawan')->user()->foto);   
            @endphp
            <img src="{{ url($path)}}" alt="avatar" class="imaged w64" style="height: 60px absolut">
            @else
            <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
            @endif
            
        </div>
        <div id="user-info">
            <h2 id="user-name">{{ Auth::guard('karyawan')->user()->nama_lengkap }}</h2>
            <span id="user-role">{{ Auth::guard('karyawan')->user()->jabatan }}</span>
        </div>
        
    </div>
</div>

<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/editprofile" class="green" style="font-size: 40px;">
                            <ion-icon name="person-sharp"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Profil</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/absensi/izin" class="danger" style="font-size: 40px;">
                            <ion-icon name="calendar-number"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Cuti</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/absensi/histori" class="warning" style="font-size: 40px;">
                            <ion-icon name="document-text"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Histori</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="orange" style="font-size: 40px;">
                            <ion-icon name="location"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        Lokasi
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section mt-2" id="presence-section">
    <div class="todaypresence">
        <div class="row">
            <div class="col-6">
                <div class="card gradasigreen">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if ($absensihariini != null)
                                @php
                                    $path = Storage::url('uploads/presensi/'.$absensihariini->foto_masuk);
                                @endphp
                                <img src="{{ url($path)}}" alt="" class="imaged w48">    
                                @else 
                                    <ion-icon name="camera"></ion-icon>                                
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Masuk</h4>
                                <span>{{ $absensihariini != null ? $absensihariini->jam_masuk : 'Belum Absen'  }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card gradasired">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if ($absensihariini != null  && $absensihariini->jam_pulang != null)
                                @php
                                    $path = Storage::url('uploads/presensi/'.$absensihariini->foto_pulang);
                                @endphp
                                <img src="{{ url($path)}}" alt="" class="imaged w48">    
                                @else 
                                    <ion-icon name="camera"></ion-icon>                                
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Pulang</h4>
                                <span>{{ $absensihariini != null && $absensihariini->jam_pulang != null ? $absensihariini->jam_pulang : 'Belum Absen'  }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="rekapabsensi">
        <h3 class="text-center">Absensi Bulan {{ $namabulan[$bulanini]}} Tahun {{ $tahunini}} </h3>
        {{-- <div id="chartdiv"></div> --}}
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 12px 12px !important; line-heigh: 0.8rem">
                        <div class="row">
                            <div class="col-6">
                                <ion-icon name="newspaper-outline" style="font-size: 1.6rem;" class="text-success mb-1"></ion-icon>
                            </div>
                            <div class="col-6">
                                <span class="badge bg-danger">{{ $rekapabsensi->jmlhadir}} </span>
                            </div>
                        </div>

                        <span style="font-size: 0.8rem">Hadir</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 12px 12px !important; line-heigh: 0.8rem">
                        <div class="row">
                            <div class="col-6">
                                <ion-icon name="accessibility-outline" style="font-size: 1.6rem;" class="text-primary mb-1"></ion-icon>
                            </div>
                            <div class="col-6">
                                <span class="badge bg-danger">{{ $rekapizin->jmlizin}} </span>
                            </div>
                        </div>
                        <span style="font-size: 0.8rem">Izin</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 12px 12px !important; line-heigh: 0.8rem">
                        <div class="row">
                            <div class="col-6">
                                <ion-icon name="medkit-outline" style="font-size: 1.6rem;" class="text-warning mb-1"></ion-icon>
                            </div>
                            <div class="col-6">
                                <span class="badge bg-danger">{{ $rekapizin->jmlsakit}}</span>
                            </div>
                        </div>
                        <span style="font-size: 0.8rem">Sakit</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 12px 12px !important; line-heigh: 0.8rem">
                        <div class="row">
                            <div class="col-6">
                                <ion-icon name="alarm-outline" style="font-size: 1.6rem;" class="text-danger mb-1"></ion-icon>
                            </div>
                            <div class="col-6">
                                <span class="badge bg-danger">{{ $rekapabsensi->jmltelat}} </span>
                            </div>
                        </div>                   
                        <span style="font-size: 0.8rem">Telat</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="presencetab mt-2">
        <div class="tab-pane fade show active" id="pilled" role="tabpanel">
            <ul class="nav nav-tabs style1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                        Bulan Ini
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                        Leaderboard
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content mt-2" style="margin-bottom:100px;">
            <div class="tab-pane fade show active" id="home" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($historibulanini as $d)
                    @php
                        $path = Storage::url('uploads/presensi/'.$d->foto_masuk);   
                    @endphp
                    <li>
                        <div class="item">
                            <div class="icon-box bg-primary">
                                <img src="{{ url($path) }}" alt="" class="img-fluid rounded">
                            </div>
                            <div class="in">
                                <div>{{ date("d-m-Y", strtotime($d->tgl_absensi))}}</div>
                                <span class="badge badge-success">{{ $d->jam_masuk}} </span>
                                <span class="badge badge-danger">{{ $absensihariini != null && $d->jam_pulang != null ? $d->jam_pulang 
                                : 'Belum Absen'}} </span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($leaderboard as $d)
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>
                                        <b>{{ $d->nama_lengkap }}</b>
                                        <br>
                                        <small class="text-muted">{{ $d->jabatan }}</small>
                                    </div>
                                    <span class="badge {{ $d->jam_masuk < "08:00" ? "bg-success" : "bg-danger"}} ">
                                        <b>{{ $d->jam_masuk }}</b>
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                
                </ul>
            </div>

        </div>
    </div>
</div>

@endsection