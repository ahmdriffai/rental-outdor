<?php

namespace App\Services\Elequent;

use App\Exceptions\invariantException;
use App\Http\Requests\UserAddAdminRequest;
use App\Http\Requests\UserAddCustomerRequest;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl implements UserService
{

    function add(UserAddRequest $request): User
    {
        $email = $request->input('email');
        $passeord = $request->input('password');
        $roles = $request->input('roles');

        $hashPassword = Hash::make($passeord);

        try {
            $user = new User([
                'email' => $email,
                'password' => $hashPassword,
            ]);
            $user->save();
            $user->assignRole($roles);

        }catch (\Exception $exception) {
            throw new invariantException($exception->getMessage());
        }
        return $user;
    }

    function list(string $key = '', int $size = 10): LengthAwarePaginator
    {
        return User::where('email', 'like', '%'. $key .'%')
            ->orderBy('created_at', 'DESC')
            ->paginate($size);
    }

    function update(UserUpdateRequest $request, int $id): User
    {
        $user = User::find($id);
        $email = $request->input('email');
        $password = $request->input('password');
        $roles = $request->input('roles');
        $hashPassword = $user->password;

        if (!empty($password)){
            $hashPassword = Hash::make($password);
        }
        try {
            DB::beginTransaction();
            $user->email = $email;
            $user->password = $hashPassword;
            DB::table('model_has_roles')->where('model_id',$id)->delete();

            $user->assignRole($roles);
            $user->save();
            DB::commit();
        }catch (\Exception $exception) {
            DB::rollBack();
            throw new invariantException($exception->getMessage());
        }

        return $user;
    }

    function delete(int $id): void
    {
        $user = User::find($id);
        try {
            $user->delete();
        }catch (\Exception $exception) {
            throw new invariantException($exception->getMessage());
        }
    }

    function changePassword(UserChangePasswordRequest $request, int $id): User
    {
        $user = User::find($id);
        $hashPassword = Hash::make($request->input('new_password'));

        try {
            $user->password = $hashPassword;
            $user->save();
        }catch (\Exception $exception) {
            throw new invariantException($exception->getMessage());
        }

        return $user;
    }

    function addAdmin(UserAddAdminRequest $request)
    {
        $email = $request->input('email');
        $passeord = $request->input('password');

        $hashPassword = Hash::make($passeord);

        try {
            $user = new User([
                'email' => $email,
                'password' => $hashPassword,
            ]);
            $user->save();

            $user->assignRole('admin');

        }catch (\Exception $exception) {
            throw new invariantException($exception->getMessage());
        }

        return $user;
    }

    function addCustomer(UserAddCustomerRequest $request)
    {
        $email = $request->input('email');
        $passeord = $request->input('password');

        $hashPassword = Hash::make($passeord);

        try {
            $user = new User([
                'email' => $email,
                'password' => $hashPassword,
            ]);
            $user->save();

            $user->assignRole('customer');

        }catch (\Exception $exception) {
            throw new invariantException($exception->getMessage());
        }

        return $user;
    }
}
