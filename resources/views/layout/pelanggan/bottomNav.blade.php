<!-- App Bottom Menu -->
<div class="appBottomMenu">
    <a href="/panelpelanggan/dashboardpelanggan" class="item {{ request()->is('dashboard') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="/absensi/histori" class="item {{ request()->is('absensi/histori') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="newspaper-outline"></ion-icon>
            <strong>Histori</strong>
        </div>
    </a>
    <a href="/pelanggan/editprofile" class="item {{ request()->is('izin') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="document-outline"></ion-icon>
            <strong>Histori</strong>
        </div>
    </a>
    <a href="/pelanggan/editprofile" class="item {{ request()->is('izin') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="document-outline"></ion-icon>
            <strong>Profil</strong>
        </div>
    </a>
    <a href="/panelpelanggan/proseslogoutpelanggan" class="item {{ request()->is('editprofile') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Logout</strong>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->