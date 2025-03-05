<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index()
    {
        $videos = Video::paginate(10);
        return view('videos.index', compact('videos'));
    }

    public function show(Video $video)
    {
        return view('videos.show', compact('video'));
    }

    public function testedBy(Video $video)
    {
        return $video->testedBy();
    }
}
