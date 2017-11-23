<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Mockery\Exception;

final class TwitterController extends Controller
{
    public function feeds()
    {

        try {
            $data = \Twitter::getUserTimeline(['screen_name' => 'realDonaldTrump', 'count' => 50, 'format' => 'array']);
            return response()->json([
                'data' => $this->parseFeed($data),
                'status' => true
            ], 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        } catch (\Exception $exception) {
            return response()->json([
                'msg' => $exception->getMessage(),
                'status' => false
            ], 200, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }

    private function parseFeed(array $feeds): array
    {
        return array_map(function ($item) {
            $text = $item['text'];
            $entities = $item['entities'];
            $item['text_html'] = $text;
            foreach ($entities['user_mentions'] as $user_mention) {
                $item['text_html'] = str_replace(
                    "@{$user_mention['screen_name']}",
                    "<a href='https://twotter.com/{$user_mention['screen_name']}' target='_blank'>@{$user_mention['screen_name']}</a>",
                    $item['text_html']
                );
            }

            foreach ($entities['urls'] as $url) {
                $item['text_html'] = str_replace(
                    $url['url'],
                    "<a href='{$url['url']}' target='_blank'>{$url['url']}</a>",
                    $item['text_html']
                );
            }

            $item['timestamp'] = strtotime($item['created_at']);
            return $item;
        }, $feeds);
    }

    public function listTimeSlots()
    {
        $user = User::find(Auth::user());
        dd($user->tweetTimeSlots);
    }
}