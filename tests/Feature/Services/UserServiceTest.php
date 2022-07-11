<?php

namespace Tests\Feature\Services;

use App\Http\Requests\UserAddAdminRequest;
use App\Http\Requests\UserAddCustomerRequest;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);

        $role = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'customer']);
    }

    public function test_provider_user_service()
    {
        self::assertTrue(true);
    }

    public function test_add_user_success()
    {
        $request = new UserAddRequest([
            'email' => 'test@gmail.com',
            'password' => 'test',
            'roles' => ['admin'],
        ]);

        $result = $this->userService->add($request);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', [
           'email' => $request->email
        ]);

        self::assertTrue(Hash::check($request->password, $result->password));
        self::assertContains('admin', $result->getRoleNames());
    }

    public function test_update_user_with_password()
    {
        $user = User::factory()->create();
        $request = new UserUpdateRequest([
            'email' => 'updatetest@gmail.com',
            'password' => 'updatetest',
            'roles' => ['admin']
        ]);

        $result = $this->userService->update($request, $user->id);

        $this->assertDatabaseCount('users', 1);
        self::assertSame($request->email, $result->email);
        self::assertTrue(Hash::check($request->password, $result->password));
        self::assertContains('admin', $user->getRoleNames());
    }

    public function test_update_user_empty_password()
    {
        $user = User::factory()->create();
        $request = new UserUpdateRequest([
            'email' => 'updatetest@gmail.com',
            'roles' => ['admin']
        ]);

        $result = $this->userService->update($request, $user->id);

        $this->assertDatabaseCount('users', 1);
        self::assertSame($request->email, $result->email);
        self::assertSame($user->password, $result->password);
        self::assertContains('admin', $user->getRoleNames());
    }

    public function test_list_user()
    {
        User::factory(10)->create();

        $result = $this->userService->list();
        self::assertSame(10, $result->count());

        User::factory()->create(['email' => 'cari@mail.com']);

        $result = $this->userService->list('cari');
        self::assertSame(1, $result->count());

        $result = $this->userService->list('', 3);
        self::assertSame(3, $result->count());

    }

    public function test_delete_user_success()
    {
        $user = User::factory()->create();

        $this->assertDatabaseCount('users', 1);

        $this->userService->delete($user->id);

        $this->assertDatabaseCount('users', 0);
    }

    public function test_change_password_user()
    {
        $user = User::factory()->create();
        $request = new UserChangePasswordRequest([
            'old_password' => 'old_pass',
            'new_password' => 'new_pass',
        ]);

        $result = $this->userService->changePassword($request, $user->id);

        self::assertNotSame($user->password, $result->password);
    }

    public function test_add_admin_success()
    {
        $request = new UserAddAdminRequest([
            'email' => 'test@gmail.com',
            'password' => 'test',
        ]);

        $result = $this->userService->addAdmin($request);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', [
            'email' => $request->email
        ]);

        self::assertTrue(Hash::check($request->password, $result->password));
        self::assertContains('admin', $result->getRoleNames());
    }

    public function test_add_customer_success()
    {
        $request = new UserAddCustomerRequest([
            'email' => 'test@gmail.com',
            'password' => 'test',
        ]);

        $result = $this->userService->addCustomer($request);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', [
            'email' => $request->email
        ]);

        self::assertTrue(Hash::check($request->password, $result->password));
        self::assertContains('customer', $result->getRoleNames());
    }


}
