<!-- App Bottom Menu -->
<div class="appBottomMenu">
    <a href="/" class="item {{ request()->is('/') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="/informasi" class="item {{ request()->is('informasi') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="newspaper-outline"></ion-icon>
            <strong>Tentang Kami</strong>
        </div>
    </a>
    <a href="/produk" class="item {{ request()->is('produk') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="newspaper-outline"></ion-icon>
            <strong>Produk</strong>
        </div>
    </a>
    <a href="/langganan" class="item {{ request()->is('langganan') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="document-outline"></ion-icon>
            <strong>Langganan</strong>
        </div>
    </a>
    <a href="/kontak" class="item {{ request()->is('kontak') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Kontak</strong>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->