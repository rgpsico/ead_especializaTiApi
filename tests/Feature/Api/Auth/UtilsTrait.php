<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;

use Tests\TestCase;

trait UtilsTrait
{

    public function createTokenUser()
    {
        $user = User::factory()->create();
        return $token = $user->createToken('teste')->plainTextToken;
    }
}
