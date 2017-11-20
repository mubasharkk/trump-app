<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

final class TwitterController extends Controller
{
    public function feeds()
    {
        return response()->json([
            'data' => \Twitter::getUserTimeline(['screen_name' => 'realDonaldTrump', 'count' => 20, 'format' => 'array'])
        ], 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}