<?php

namespace Khodemobin\Gitlab\Concepts;


use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;

trait Auth
{
    /**
     * return to gitlab authorize page url
     *
     * @param null $callback
     * @return string
     */
    public static function authorize($callback = null): string
    {
        $appID = config('gitlab.gitlab_application_id');

        if (!$callback) {
            $callback = config('gitlab.gitlab_callback');
        }

        return "https://gitlab.com/oauth/authorize?client_id={$appID}&redirect_uri={$callback}&response_type=code";
    }

    /**
     * get oauth access token
     *
     * @param $code //gitlab RETURNED_CODE from authorize page
     * @return array|null
     */
    public static function getAccessToken($code)
    {
        $appID = config('gitlab.gitlab_application_id');
        $secret = config('gitlab.gitlab_secret');
        $callback = config('gitlab.gitlab_callback');

        try {
            $gitResponse = Http::post("https://gitlab.com/oauth/token", [
                'client_id' => $appID,
                'client_secret' => $secret,
                'code' => $code,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $callback
            ]);
        } catch (\Exception $e) {
            return null;
        }

        return json_decode($gitResponse->body(), true);
    }

}
