<?php

namespace Khodemobin\Gitlab\Concepts;

use GuzzleHttp\Client;

trait Webhook
{
    public static function webhooks($token, $projectId)
    {
        $client = new Client();
        $response = $client->get(config('gitlab.gitlab_url') . "projects/{$projectId}/hooks", [
            'headers' => [
                'Authorization' => 'Bearer' . $token
            ]
        ])->getBody();

        return json_decode($response->getContents(), true);
    }

    public static function createWebHook($token, $name)
    {
        $client = new Client();
    }
}
