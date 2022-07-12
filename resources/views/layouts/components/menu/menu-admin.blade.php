<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item {{ Route::is('equipment.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('equipment.index') }}">
        <i class="fas fa-fw fa-table"></i>
        <span>Peralatan</span></a>
</li>
