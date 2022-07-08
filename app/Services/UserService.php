<?php

namespace App\Services;

use App\Http\Requests\UserAddAdminRequest;
use App\Http\Requests\UserAddCustomerRequest;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserService
{
    function add(UserAddRequest $request): User;
    function addAdmin(UserAddAdminRequest $request);
    function addCustomer(UserAddCustomerRequest $request);
    function list(string $key, int $size): LengthAwarePaginator;
    function update(UserUpdateRequest $request, int $id): User;
    function delete(int $id): void;
    function changePassword(UserChangePasswordRequest $request, int $id): User;
}
