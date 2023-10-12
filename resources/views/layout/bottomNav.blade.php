<!-- App Bottom Menu -->
<div class="appBottomMenu">
    <a href="/panelkaryawan/dashboard" class="item {{ request()->is('dashboard') ? 'active' : '' }}">
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
    <a href="/absensi/create" class="item {{ request()->is('absensi/create') ? 'active' : '' }}">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="/absensi/izin" class="item {{ request()->is('izin') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="document-outline"></ion-icon>
            <strong>Izin</strong>
        </div>
    </a>
    <a href="/editprofile" class="item {{ request()->is('editprofile') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->