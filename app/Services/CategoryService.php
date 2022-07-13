<?php

namespace App\Services;

use App\Http\Requests\CategoryAddRequest;
use App\Models\Category;

interface CategoryService
{
    function add(CategoryAddRequest $request): Category;
}
