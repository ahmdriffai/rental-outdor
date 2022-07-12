<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\EquipmentAddRequest;
use App\Http\Requests\EquipmentUpdateRequest;
use App\Http\Requests\EquipmetChangeImageRequest;
use App\Models\Category;
use App\Models\Equipment;
use App\Services\EquipmentService;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    private EquipmentService $equipmentService;

    public function __construct(EquipmentService $equipmentService)
    {
        $this->equipmentService = $equipmentService;
        $this->middleware('role:admin')->only('index');
    }

    public function index(Request $request) {
        $title = 'List Peralatan';
        $key = $request->query('key') ?? '';
        $data = $this->equipmentService->list($key, 10);

        return response()->view('equipment.index', compact('title', 'data'));
    }

    public function create() {
        $title = 'Tambah Peralatan';
        $category = Category::pluck('name', 'id')->all();
        return response()->view('equipment.create', compact('title', 'category'));
    }

    public function store(EquipmentAddRequest $request) {
        $image = $request->file('image');

        try {
            $result = $this->equipmentService->add($request);
            $this->equipmentService->addImage($image, $result->id);
            return redirect()->route('equipment.index')->with('success', 'Berhasil Menambah Data Peralatan');
        }catch (InvariantException $exception){
            return redirect()->back()->with('error', $exception->getMessage())->withInput($request->all());
        }

    }

    public function edit($id) {
        try {
            $equipment = Equipment::findOrFail($id);
            $title = 'Edit Peralatan';
            $category = Category::pluck('name', 'id')->all();
            return response()->view('equipment.edit', compact('title', 'category', 'equipment'));
        }catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function update(EquipmentUpdateRequest $request, $id) {
        try {
           $this->equipmentService->update($request, $id);
            return redirect()->back()->with('success', 'Berhasil memperbarui data peralatan');
        }catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function changeImage(EquipmetChangeImageRequest $request, $id){
        $image = $request->file('image');
        try {
            $this->equipmentService->addImage($image, $id);
            return redirect()->back()->with('success', 'Berhasil memperbarui data peralatan');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function destroy($id) {
        try {
            $this->equipmentService->delete($id);
            return redirect()->route('equipment.index')->with('success', 'Berhasil Menghapus Data Peralatan');
        }catch (InvariantException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
