<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleBasedAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RolePermissionSeeder']);
        $this->artisan('db:seed', ['--class' => 'AdminUserSeeder']);
        $this->artisan('db:seed', ['--class' => 'TestUserSeeder']);
    }

    /** @test Super Admin can access dashboard */
    public function test_super_admin_can_access_dashboard()
    {
        $superAdmin = User::where('email', 'nabilyusr4@gmail.com')->first();
        $this->actingAs($superAdmin);

        $response = $this->get('/dashboard');
        $this->assertEquals(200, $response->status());
    }

    /** @test Admin can access dashboard */
    public function test_admin_can_access_dashboard()
    {
        $admin = User::where('email', 'admin@sibasket.test')->first();
        $this->actingAs($admin);

        $response = $this->get('/dashboard');
        $this->assertEquals(200, $response->status());
    }

    /** @test Member can access dashboard */
    public function test_member_can_access_dashboard()
    {
        $member = User::where('email', 'member@sibasket.test')->first();
        $this->actingAs($member);

        $response = $this->get('/dashboard');
        $this->assertEquals(200, $response->status());
    }

    /** @test Pembina can access dashboard */
    public function test_pembina_can_access_dashboard()
    {
        $pembina = User::where('email', 'pembina@sibasket.test')->first();
        $this->actingAs($pembina);

        $response = $this->get('/dashboard');
        $this->assertEquals(200, $response->status());
    }

    /** @test Unauthenticated user redirect ke login */
    public function test_unauthenticated_user_redirect_to_login()
    {
        $response = $this->get('/dashboard');
        $this->assertEquals(302, $response->status());
        $this->assertTrue(str_contains($response->headers->get('Location'), 'login'));
    }

    /** @test Super Admin has all permissions */
    public function test_super_admin_has_all_permissions()
    {
        $superAdmin = User::where('email', 'nabilyusr4@gmail.com')->first();

        $this->assertTrue($superAdmin->can('view kegiatan'));
        $this->assertTrue($superAdmin->can('create kegiatan'));
        $this->assertTrue($superAdmin->can('view keuangan'));
        $this->assertTrue($superAdmin->can('view anggota'));
        $this->assertTrue($superAdmin->can('manage role_permission'));
    }

    /** @test Admin cannot manage roles */
    public function test_admin_cannot_manage_roles()
    {
        $admin = User::where('email', 'admin@sibasket.test')->first();
        $this->assertFalse($admin->can('manage role_permission'));
    }

    /** @test Pembina can only view */
    public function test_pembina_can_only_view()
    {
        $pembina = User::where('email', 'pembina@sibasket.test')->first();

        $this->assertTrue($pembina->can('view kegiatan'));
        $this->assertFalse($pembina->can('create kegiatan'));
        $this->assertTrue($pembina->can('view anggota'));
        $this->assertFalse($pembina->can('update anggota'));
    }

    /** @test Member has limited permissions */
    public function test_member_has_limited_permissions()
    {
        $member = User::where('email', 'member@sibasket.test')->first();

        $this->assertTrue($member->can('view kegiatan'));
        $this->assertFalse($member->can('create kegiatan'));
        $this->assertTrue($member->can('create pendaftaran_kegiatan'));
        $this->assertFalse($member->can('view anggota'));
    }

    /** @test Admin can create anggota */
    public function test_admin_can_create_anggota()
    {
        $admin = User::where('email', 'admin@sibasket.test')->first();

        $this->assertTrue($admin->can('create anggota'));
        $this->assertTrue($admin->can('delete anggota'));
        $this->assertTrue($admin->can('create kegiatan'));
    }
}
