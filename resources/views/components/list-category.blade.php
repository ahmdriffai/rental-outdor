<div class="row mt-3">
    <h4>Kategori</h4>
</div>

<div class="row mt-3 g-3">
    @foreach($category as $value)
    <div class="col-md-2">
        <a href="#" class="nav-link">
            <div class="card border-0 bg-light shadow card-hover">
                <div class="card-body text-center">
                    <h6>{{ $value->name }}</h6>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

<style>
    .card-hover:hover {
        transform: translateY(-2px);
    }
</style>
