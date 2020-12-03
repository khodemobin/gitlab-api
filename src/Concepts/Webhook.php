<?php

namespace Khodemobin\Gitlab\Concepts;

use GuzzleHttp\Client;

trait Webhook
{


    public static function webhooks($token, $projectId)
    {
        $client = new Client();
        $response = $client->get(config('gitlab.gitlab_url') . "projects/{$projectId}/hooks?access_token={$token}")->getBody();

        return json_decode($response->getContents(), true);
    }

    public static function createWebHook($token, $projectId, $url, $enableSSL, $trigger = [], $branchFilter = "")
    {
        $client = new Client();

        $formParams = [
            'id' => $projectId,
            'url' => $url,
            'enable_ssl_verification' => $enableSSL,
            'push_events_branch_filter' => $branchFilter
        ];


        $response = $client->post(config('gitlab.gitlab_url') . "projects/{$projectId}/hooks?access_token={$token}", [
            'form_params' => array_merge($formParams, $trigger)
        ])->getBody();

        return json_decode($response->getContents(), true);
    }
}
