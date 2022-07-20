<?php

namespace App\Repositories;

use App\Models\ReplySupport;
use App\Models\Traits\RepositoryTrait;
use App\Models\User;

class ReplyRepository
{
    use RepositoryTrait;


    protected $entity;

    public function __construct(ReplySupport $model)
    {
        $this->entity = $model;
    }

    public function createReplyToSupport(array $data)
    {

        $user = $this->getUserAuth();

        return   $this->entity
            ->create([
                'support_id' => $data['support'],
                'description' => $data['description'],
                'user_id' => $user->id

            ]);
    }
}
