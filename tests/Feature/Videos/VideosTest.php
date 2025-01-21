<?php
namespace Tests\Feature\Videos;

use PHPUnit\Framework\Attributes\Test;
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
            publishedAt: now(),
        );

        // Realitzar una petició per veure el vídeo
        $response = $this->get(route('videos.show', $video->id));

        // Comprovar que la petició va tenir èxit (status 200)
        $response->assertStatus(200);

        // Comprovar que la resposta conté dades del vídeo
        $response->assertSee($video->title);
        $response->assertSee($video->description);
        $response->assertSee($video->url);
    }

    #[Test] public function users_cannot_view_not_existing_videos()
    {
        // Intentar veure un vídeo que no existeix
        $response = $this->get(route('videos.show', 999)); // ID que no existeix

        // Comprovar que la petició retorna una resposta 404 (not found)
        $response->assertStatus(404);
    }
}
