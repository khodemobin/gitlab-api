<?php

namespace Khodemobin\Gitlab\Concepts;

use GuzzleHttp\Client;

trait User
{

    public static function user($token)
    {
        $client = new Client();
        $response = $client->get(config('gitlab.gitlab_url') . '/user?access_token='.$token)->getBody();

        return json_decode($response->getContents(), true);
    }
}
