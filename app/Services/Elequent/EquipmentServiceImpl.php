<?php

namespace App\Services\Elequent;

use App\Exceptions\InvariantException;
use App\Helper\Media;
use App\Http\Requests\EquipmentAddRequest;
use App\Http\Requests\EquipmentUpdateRequest;
use App\Models\Category;
use App\Models\Equipment;
use App\Services\EquipmentService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class EquipmentServiceImpl implements EquipmentService
{

    use Media;

    function add(EquipmentAddRequest $request): Equipment
    {
        $name = $request->input('name');
        $price = $request->input('price');
        $description = $request->input('description');

        $category = Category::find($request->input('category_id'));

        try {
            DB::beginTransaction();
            $equipment = new Equipment([
                'name' => $name,
                'price' => $price,
                'description' => $description,
            ]);

            $category->equipment()->save($equipment);

            DB::commit();
        }catch (\Exception $exception) {
            DB::rollBack();
            throw new InvariantException($exception->getMessage());
        }

        return $equipment;
    }

    function list(string $key = '', int $size = 10): LengthAwarePaginator
    {
        return Equipment::where('name', 'like', '%'. $key .'%')
            ->orWhere('description', 'like', '%'. $key .'%')
            ->orderBy('created_at', 'DESC')
            ->paginate($size);
    }

    function update(EquipmentUpdateRequest $request, int $id): Equipment
    {
        $name = $request->input('name');
        $price = $request->input('price');
        $description = $request->input('description');

        try {
            DB::beginTransaction();
            $category = Category::findOrFail($request->input('category_id'));
            $equipment = Equipment::findOrFail($id);
            $equipment->name = $name;
            $equipment->price = $price;
            $equipment->description = $description;

            $category->equipment()->save($equipment);

            DB::commit();
        }catch (\Exception $exception) {
            DB::rollBack();
            throw new InvariantException($exception->getMessage());
        }

        return $equipment;
    }

    function delete(int $id): void
    {
        try {
            $equpment = Equipment::findOrFail($id);

            if ($equpment->image_path != null) {
                unlink($equpment->image_path);
            }

            $equpment->delete();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }
    }

    function addImage($file, int $id): Equipment
    {

        if ($file == null) {
            throw new InvariantException('Belum ada file');
        }

        try {
            $equipment = Equipment::findOrFail($id);
            $dataFile = $this->uploads($file, 'equipment/images/');
            $imageUrl = asset('storage/'. $dataFile['filePath']);
            $imagePath = public_path('storage/'. $dataFile['filePath']);

            $equipment->image_url = $imageUrl;
            $equipment->image_path = $imagePath;
            $equipment->save();
        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $equipment;
    }

    function updateImage($file, int $id): Equipment
    {

        if ($file == null) {
            throw new InvariantException('Belum ada file');
        }

        try {
            $equipment = Equipment::findOrFail($id);
            if ($equipment->image_path != null) {
                unlink($equipment->image_path);
            }

            $dataFile = $this->uploads($file, 'pengumuman/');
            $filePath = public_path('storage/'. $dataFile['filePath']);
            $fileUrl = asset('storage/'. $dataFile['filePath']);

            $equipment->image_path = $filePath;
            $equipment->image_url = $fileUrl;
            $equipment->save();

        }catch (\Exception $exception) {
            throw new InvariantException($exception->getMessage());
        }

        return $equipment;
    }
}
