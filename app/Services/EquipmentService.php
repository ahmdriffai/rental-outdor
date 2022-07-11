<?php

namespace App\Services;

use App\Http\Requests\EquipmentAddRequest;
use App\Http\Requests\EquipmentUpdateRequest;
use App\Models\Equipment;
use Illuminate\Pagination\LengthAwarePaginator;

interface EquipmentService
{
    function add(EquipmentAddRequest $request): Equipment;
    function list(string $key = '', int $size = 10 ): LengthAwarePaginator;
    function update(EquipmentUpdateRequest $request, int $id): Equipment;
    function delete(int $id): void;
    function addImage($file, int $id): Equipment;
    function updateImage($file, int $id): Equipment;
}
