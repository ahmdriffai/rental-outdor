<div class="card py-2 px-2">
    <div class="row">
        <div class="col-md-6">
            <h5 class="card-header">Daftar Kategori</h5>
        </div>
    </div>
    <div class="text-nowrap">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach($categories as $key => $category)
                <tr>
                    <td>#</td>
                    <td><i class="fa-lg text-danger"></i><strong>{{ $category->name }}</strong></td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('categories.edit',$category->id) }}">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                        </a>
                        {!! Form::open(['method' => 'DELETE','route' => ['categories.destroy', $category->id],'style'=>'display:inline']) !!}
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ?')"git>
                            <i class="bx bx-trash me-1"></i> Hapus
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
