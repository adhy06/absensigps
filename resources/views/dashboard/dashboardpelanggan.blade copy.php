@extends('layout.pelanggan.pelanggan')
@section('content')
    
<div class="section" id="user-section">
    <div id="user-detail">
        <div class="avatar">
            @if (!@empty(Auth::guard('pelanggan')->user()->foto))
            @php
                $path = Storage::url('uploads/pelanggan/'.Auth::guard('pelanggan')->user()->foto);   
            @endphp
            <img src="{{ url($path)}}" alt="avatar" class="imaged w64" style="height: 60px absolut">
            @else
            <img src="{{ asset('/assets/img/sample/avatar/avatar1.jpg') }}" alt="avatar" class="imaged w64 rounded">
            @endif
            
        </div>
        <div id="user-info">
            <h2 id="user-role">{{ Auth::guard('pelanggan')->user()->nama_pelanggan }}</h2>
            <span id="user-name">{{ Auth::guard('pelanggan')->user()->nik_ktp }}</span>
        </div>
        
    </div>
</div>

<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/pelanggan/editprofile" class="green" style="font-size: 40px;">
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
                        <a href="{{ asset('/panelpelanggan/proseslogoutpelanggan')}}" class="orange" style="font-size: 40px;">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        Keluar
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section mt-2" id="presence-section">

</div>

@endsection