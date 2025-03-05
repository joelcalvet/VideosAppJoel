<?php
namespace Tests\Feature\Videos;

use App\Models\User;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\Test;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;
use App\Helpers\VideoHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    #[Test] public function users_can_view_videos()
    {
        // Crear un vídeo de prova utilitzant el VideoHelper
        $video = VideoHelper::createCustomVideo(
            title: 'Vegeta 777',
            description: 'Es el mejor youtuber',
            url: 'https://www.youtube.com/embed/oM9fUlGET-w?si=mrCctV-Ilp3OXKbI',
            publishedAt: Carbon::now(),
        );

        // Realitzar una petició per veure el vídeo
        $response = $this->get(route('videos.show', $video->id));

        // Comprovar que la petició va tenir èxit (status 200)
        $response->assertStatus(200);

        // Comprovar que la resposta conté dades del vídeo
        $response->assertSee($video->title);
        $response->assertSee($video->description);
        $response->assertSee($video->url);
        $this->assertEquals('Tests\\Feature\\Videos\\VideosTest', $video->testedBy());

    }

    #[Test] public function users_cannot_view_not_existing_videos()
    {
        // Intentar veure un vídeo que no existeix
        $response = $this->get(route('videos.show', 999)); // ID que no existeix

        // Comprovar que la petició retorna una resposta 404 (not found)
        $response->assertStatus(404);
    }

    #[Test] public function user_without_permissions_can_see_default_videos_page()
    {
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);
        $this->actingAs($user);

        $response = $this->get('/videos');
        $response->assertStatus(200);
    }

    #[Test]
    public function user_with_permissions_can_see_default_videos_page()
    {
        // Crear el permís 'manage videos' per al guard 'web'
        Permission::create(['name' => 'manage videos', 'guard_name' => 'web']);

        // Crear un usuari
        $user = User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => bcrypt('password'),
        ]);

        // Assignar el permís a l'usuari
        $user->givePermissionTo('manage videos');

        // Autenticar l'usuari
        $this->actingAs($user);

        // Fer la petició a /videos
        $response = $this->get('/videos');

        // Comprovar que la resposta és correcta
        $response->assertStatus(200);
    }

    #[Test] public function not_logged_users_can_see_default_videos_page()
    {
        $response = $this->get('/videos');
        $response->assertStatus(200);
    }
}
