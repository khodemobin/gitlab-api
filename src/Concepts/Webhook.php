<?php

namespace Khodemobin\Gitlab\Concepts;

use GuzzleHttp\Client;

trait Webhook
{
    public static function webhooks($token)
    {
        $client = new Client();
        $response = $client->get(config('gitlab.gitlab_url') . 'webhooks', [
            'headers' => [
                'Authorization' => 'Bearer' . $token
            ]
        ])->getBody();

        return json_decode($response->getContents(), true);
    }
}
