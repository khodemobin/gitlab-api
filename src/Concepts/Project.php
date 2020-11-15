<?php

namespace Khodemobin\Gitlab\Concepts;

use GuzzleHttp\Client;
use Khodemobin\Gitlab\Gitlab;

trait Project
{
    public static function projects($token)
    {
        $client = new Client();
        $user = Gitlab::user($token);

        $response = $client->get(config('gitlab.gitlab_url') . "users/{$user['id']}/projects?access_token={$token}")->getBody();

        return json_decode($response->getContents(), true);
    }

    public static function project($token, $projectId)
    {
        $client = new Client();
        $response = $client->get(config('gitlab.gitlab_url') . "projects/{$projectId}?access_token={$token}")->getBody();

        return json_decode($response->getContents(), true);
    }

    public static function branches($token, $projectId)
    {

        $client = new Client();
        $project = Project::project($token, $projectId);
        $branchLink = $project['_links']['repo_branches'];

        $response = $client->get($branchLink . "?access_token={$token}")->getBody();

        return json_decode($response->getContents(), true);
    }
}
