<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Support\Str;

trait RepositoryTrait
{

    private function getUserAuth(): User
    {
        return  auth()->user();
    }
}
