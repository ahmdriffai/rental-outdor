<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use App\Services\EquipmentService;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    private EquipmentService $equipmentService;

    public function __construct(EquipmentService $equipmentService)
    {
        $this->equipmentService = $equipmentService;
    }


    public function index() {
        $category = Category::all();
        $equipments = $this->equipmentService->list('', 10);
        return response()->view('guests.index', compact('category', 'equipments'));
    }

    public function equipmentDetail($id) {
        $equipment = Equipment::find($id);
        return response()->view('guests.equipment-detail', compact('equipment'));
    }
}
