<div class="row mt-5">
    <h4>Peralatan Terpopuler</h4>
</div>

<div class="row mt-3 g-3 flex-wrap">
    @foreach($equipments as $value)
    <div class="col">
        <div class="card border-0 shadow-sm" style="width: 18rem;">
            <a class="nav-link text-capitalize" href="{{ route('guest.equipment-detail', $value->id) }}">
                <img src="{{ $value->image_url ?? asset('sb-admin/img/banner.jpg') }}" class="card-img-top w-100 h-100" alt="...">
            </a>
            <div class="card-body">
                <a class="nav-link" href="{{ route('guest.equipment-detail', $value->id) }}">
                    <h6 class="text-uppercase fw-bold">{{ $value->name }}</h6>
                    <h6 class="card-title text-capitalize fw-light">Rp. {{ number_format($value->price) }}</h6>
                </a>
            </div>
        </div>
    </div>
    @endforeach
    {{ $equipments->links() }}
</div>


