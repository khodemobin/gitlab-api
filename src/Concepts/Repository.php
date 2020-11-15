<?php

namespace Khodemobin\Gitlab\Concepts;

use GuzzleHttp\Client;

trait Repository
{
    public static function repositories($token)
    {
        $client = new Client();
        $response = $client->get(config('gitlab.gitlab_url') . 'projects', [
            'headers' => [
                'Authorization' => 'Bearer' . $token
            ]
        ])->getBody();

        return json_decode($response->getContents(), true);
    }
}
