<?php

namespace Khodemobin\Gitlab;

use Khodemobin\Gitlab\Concepts\Auth;
use Khodemobin\Gitlab\Concepts\DeployKey;
use Khodemobin\Gitlab\Concepts\Project;
use Khodemobin\Gitlab\Concepts\User;
use Khodemobin\Gitlab\Concepts\Webhook;

class Gitlab
{
    use Auth, User, Webhook, Project, DeployKey;
}
