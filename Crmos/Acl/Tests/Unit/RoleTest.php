<?php

namespace Crmos\Acl\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Crmos\Acl\Models\Role;
use Crmos\Acl\Repositories\RoleRepository;
use Crmos\Acl\Services\RoleService;
use Crmos\Authentication\Models\User;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use DatabaseTransactions;

    private $authUser;
    private $roleService;

    function setUp(): void
    {
        parent::setUp();

        $this->roleService = new RoleService(new RoleRepository(new Role()));
        $this->authUser = factory(User::class)->create();

        $this->authUser->givePermissionTo([
            'role_create',
            'role_read',
            'role_update',
            'role_destroy',
        ]);
    }

    public function testCreateRole()
    {
        $data = factory(Role::class)->make()->toArray();

        $this->actingAs($this->authUser, 'api')->json('post', route('crmos.roles.store'), $data)
            ->assertStatus(201);
    }

    public function testListRoles()
    {
        $this->actingAs($this->authUser, 'api')->json('get', route('crmos.roles.index'))
            ->assertStatus(200);
    }

    public function testShowRole()
    {
        $role = $this->roleService->make(factory(Role::class)->make()->toArray());

        $this->actingAs($this->authUser, 'api')->json('get', route('crmos.roles.show', ['role' => $role->id]))
            ->assertStatus(200);
    }

    public function testUpdateRole()
    {
        $role = $this->roleService->make(factory(Role::class)->make()->toArray());

        $newData = factory(Role::class)->make()->toArray();

        $roleUpdated = $this->roleService->make($newData)->toArray();
        $roleUpdated['id'] = $role->id;

        $this->actingAs($this->authUser, 'api')->json('put', route('crmos.roles.update', ['role' => $role->id]), $newData)
            ->assertJsonFragment($roleUpdated)
            ->assertStatus(200);
    }

    public function testDeleteRole()
    {
        $role = $this->roleService->make(factory(Role::class)->make()->toArray());

        $this->actingAs($this->authUser, 'api')->json('delete', route('crmos.roles.destroy', ['role' => $role->id]))->assertStatus(204);
    }

    public function testCreatePermissionRole()
    {
        $this->authUser->revokePermissionTo('role_create');

        $data = factory(Role::class)->make()->toArray();

        $this->actingAs($this->authUser, 'api')->json('post', route('crmos.roles.store'), $data)
            ->assertStatus(403);
    }

    public function testListPermissionRoles()
    {
        $this->authUser->revokePermissionTo('role_read');

        $this->actingAs($this->authUser, 'api')->json('get', route('crmos.roles.index'))
            ->assertStatus(403);
    }

    public function testShowPermissionRole()
    {
        $this->authUser->revokePermissionTo('role_read');

        $role = $this->roleService->make(factory(Role::class)->make()->toArray());

        $this->actingAs($this->authUser, 'api')->json('get', route('crmos.roles.show', ['role' => $role->id]))
            ->assertStatus(403);
    }

    public function testUpdatePermissionRole()
    {
        $this->authUser->revokePermissionTo('role_update');

        $role = $this->roleService->make(factory(Role::class)->make()->toArray());

        $newData = factory(Role::class)->make()->toArray();

        $roleUpdated = $this->roleService->make($newData)->toArray();
        $roleUpdated['id'] = $role->id;

        $this->actingAs($this->authUser, 'api')->json('put', route('crmos.roles.update', ['role' => $role->id]), $newData)
            ->assertStatus(403);
    }

    public function testDeletePermissionRole()
    {
        $this->authUser->revokePermissionTo('role_destroy');

        $role = $this->roleService->make(factory(Role::class)->make()->toArray());

        $this->actingAs($this->authUser, 'api')->json('delete', route('crmos.roles.destroy', ['role' => $role->id]))->assertStatus(403);
    }
}
