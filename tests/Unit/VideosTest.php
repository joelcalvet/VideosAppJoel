<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Helpers\VideoHelper;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    #[Test] public function can_get_formatted_published_at_date()
    {
        // Crear un vídeo amb una data específica utilitzant el helper
        $publishedAt = Carbon::create(2025, 1, 13, 12, 0, 0);
        $video = VideoHelper::createCustomVideo(
            title: 'El Rubius OMG',
            description: 'OMG el Rubius',
            url: 'https://www.youtube.com/embed/NOtKSK2k2OU?si=JbaJUZ43Sa1ChHr7',
            publishedAt: $publishedAt
        );

        // Assert que retorna la data en el format esperat
        $this->assertEquals('13th of January, 2025', $video->formatted_published_at);

        // Assert que retorna la data relativa
        $this->assertEquals('1 week ago', $video->formatted_for_humans_published_at);

        // Assert que retorna el Unix timestamp
        $this->assertEquals($publishedAt->timestamp, $video->published_at_timestamp);
    }

    #[Test] public function can_get_formatted_published_at_date_when_not_published()
    {
        // Crear un vídeo sense data de publicació utilitzant el helper
        $video = VideoHelper::createCustomVideo(
            title: 'Test Video',
            description: 'Test description',
            url: 'https://example.com',
            publishedAt: null
        );

        // Assert que els accessors retornen null
        $this->assertNull($video->formatted_published_at);
        $this->assertNull($video->formatted_for_humans_published_at);
        $this->assertNull($video->published_at_timestamp);
    }
}
