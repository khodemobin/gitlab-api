<?php

namespace Khodemobin\Gitlab\Concepts;

use GuzzleHttp\Client;

trait DeployKey
{

    public static function deployKeys($token, $projectId = null)
    {
        $client = new Client();

        if ($projectId) {
            $response = $client->get(config('gitlab.gitlab_url') . "projects/{$projectId}/deploy_keys?access_token={$token}")->getBody();
        }
        else {
            $response = $client->get(config('gitlab.gitlab_url') . "deploy_keys?access_token={$token}")->getBody();
        }


        return json_decode($response->getContents(), true);
    }

    public static function createDeployKey($token, $projectId, $title, $key, $canPush = false)
    {
        $client = new Client();

        $formParams = [
            'id' => $projectId,
            'title' => $title,
            'key' => $key,
            'can_push' => $canPush
        ];


        $response = $client->post(config('gitlab.gitlab_url') . "projects/{$projectId}/deploy_keys?access_token={$token}", [
            'form_params' => $formParams
        ])->getBody();

        return json_decode($response->getContents(), true);
    }
}
