<?php

namespace Tests\Unit;

use App\Helpers\UserHelper;
use App\Helpers\VideoHelper;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HelperTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_create_default_user_and_teacher()
    {
        // Arrange: Configuració inicial
        config(['users.default' => [
            'name' => 'Default User',
            'email' => 'user@example.com',
            'password' => 'password123', // Sense bcrypt aquí
        ]]);
        config(['users.teacher' => [
            'name' => 'Default Teacher',
            'email' => 'teacher@example.com',
            'password' => 'password123', // Sense bcrypt aquí
        ]]);

        // Act: Creació d'usuaris
        $defaultUser = UserHelper::createDefaultUser();
        $teacherUser = UserHelper::createDefaultTeacher();

        // Assert: Comprovacions
        $this->assertDatabaseHas('users', [
            'email' => 'user@example.com',
            'name' => 'Default User',
        ]);
        $this->assertTrue(password_verify('password123', $defaultUser->password));
        $this->assertNotNull($defaultUser->teams()->first());
        $this->assertTrue($defaultUser->teams()->first()->personal_team);

        $this->assertDatabaseHas('users', [
            'email' => 'teacher@example.com',
            'name' => 'Default Teacher',
        ]);
        $this->assertTrue(password_verify('password123', $teacherUser->password));
        $this->assertNotNull($teacherUser->teams()->first());
        $this->assertTrue($teacherUser->teams()->first()->personal_team);

        $this->assertDatabaseHas('teams', [
            'name' => 'Default User Team',
            'user_id' => $defaultUser->id,
            'personal_team' => true,
        ]);
        $this->assertDatabaseHas('teams', [
            'name' => 'Default Teacher Team',
            'user_id' => $teacherUser->id,
            'personal_team' => true,
        ]);
    }

    public function test_create_default_video()
    {
        $video = VideoHelper::createDefaultVideo();

        // Comprovar que és una instància de Video
        $this->assertInstanceOf(Video::class, $video);

        // Comprovar que els valors coincideixen amb els del mètode createDefaultVideo
        $this->assertEquals('Godzilla', $video->title);
        $this->assertEquals('Llangardaix enorme que destrueix tot a la seva passada.', $video->description);
        $this->assertEquals('https://www.youtube.com/embed/guPwQO9ww20?si=NW5hp55HNaY-DRsj', $video->url);

        // Comprovar que la data de publicació no és nul·la
        $this->assertNotNull($video->published_at);

        $this->assertNull($video->previous);
        $this->assertNull($video->next);
        $this->assertNull($video->series_id);
    }
}

