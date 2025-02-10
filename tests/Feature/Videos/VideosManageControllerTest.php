<?php

namespace Tests\Feature\Videos;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\PermissionSeeder;
use App\Helpers\UserHelper;
use Spatie\Permission\Models\Permission;

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(PermissionSeeder::class);
    }

    public function test_user_with_permissions_can_manage_videos()
    {
        $user = $this->loginAsVideoManager();
        $this->assertTrue($user->hasPermissionTo('manage videos'));
    }

    public function test_regular_users_cannot_manage_videos()
    {
        $user = $this->loginAsRegularUser();
        $this->assertFalse($user->hasPermissionTo('manage videos'));
    }

    public function test_guest_users_cannot_manage_videos()
    {
        $this->assertGuest();
    }

    public function test_superadmins_can_manage_videos()
    {
        $user = $this->loginAsSuperAdmin();
        $this->assertTrue($user->hasPermissionTo('manage videos'));
    }

    protected function loginAsVideoManager()
    {
        $user = UserHelper::create_video_manager_user();
        Permission::firstOrCreate(['name' => 'manage videos']);
        $user->givePermissionTo('manage videos');
        $this->actingAs($user);
        return $user;
    }

    protected function loginAsSuperAdmin()
    {
        $user = UserHelper::create_superadmin_user();
        $this->actingAs($user);
        return $user;
    }

    protected function loginAsRegularUser()
    {
        $user = UserHelper::create_regular_user();
        $this->actingAs($user);
        return $user;
    }
}
