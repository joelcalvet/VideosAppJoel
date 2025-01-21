<?php

namespace App\Helpers;

use App\Models\Video;
use Carbon\Carbon;

class VideoHelper
{
    public static function createDefaultVideo()
    {
        return Video::create([
            'title' => 'Godzilla',
            'description' => 'Llangardaix enorme que destrueix tot a la seva passada.',
            'url' => 'https://www.youtube.com/embed/guPwQO9ww20?si=NW5hp55HNaY-DRsj',
            'published_at' => Carbon::now(),
            'previous' => null,
            'next' => null,
            'series_id' => null,
        ]);
    }

    public static function createCustomVideo($title, $description, $url,
                                             $publishedAt = null, $previous = null, $next = null, $seriesId = null)
    {
        return Video::create([
            'title' => $title,
            'description' => $description,
            'url' => $url,
            'published_at' => $publishedAt,
            'previous' => $previous,
            'next' => $next,
            'series_id' => $seriesId,
        ]);
    }
}
