
<div class="card py-2 px-2">
    <div class="row">
        <div class="col-md-6">
            <h5 class="card-header">Tambah Kategori</h5>
        </div>
    </div>
    {!! Form::open(array('route' => 'categories.store','method'=>'POST')) !!}
    <div class="row">
        <div class="card-body">

            <div class="mb-3">
                <label class="form-label" for="basic-default-email">Kategori <span class="text-danger">*</span></label>
                <div class="input-group input-group-merge">
                    {!! Form::text('name', null, array('placeholder' => 'Nama Kategori','class' => 'form-control')) !!}
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Tambah</button>

        </div>
    </div>
    {!! Form::close() !!}
</div>
