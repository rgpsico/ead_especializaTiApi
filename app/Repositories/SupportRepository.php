<?php

namespace App\Repositories;


use App\Models\Support;
use App\Models\Traits\RepositoryTrait;
use App\Models\User;

class SupportRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(Support $model)
    {
        $this->entity = $model;
    }

    public function getMySupports(array $filters = [])
    {
        $filters['user'] = true;
        return $this->getSupports($filters);
    }

    public function getSupports(array $filters = [])
    {

        return $this->entity
            ->where(function ($query) use ($filters) {
                if (isset($filters['lesson'])) {
                    $query->where('lesson_id', $filters['lesson']);
                }

                if (isset($filters['status'])) {
                    $query->where('status', $filters['status']);
                }

                if (isset($filters['filter'])) {
                    $filters = $filters['filter'];
                    $query->where('description', 'LIKE', "%{$filters}%");
                }

                if (isset($filters['User'])) {
                    $user = $this->getUserAuth();
                    $query->where('User_id', $user->id);
                }
            })
            ->orderBy('updated_at')
            ->get();
    }


    public function createNewSupport(array $data): Support
    {
        $support = $this->getUserAuth()->supports()->create([
            'lesson_id' => $data['lesson'],
            'description' => $data['description'],
            'status' => $data['status'],

        ]);
        return $support;
    }

    public function createReplyToSupportId(string $supportId, array $data)
    {
        $user = $this->getUserAuth();

        return $this->getSupport($supportId)
            ->replies()
            ->create([
                'description' => $data['description'],
                'user_id' => $user->id

            ]);
    }

    public function getSupport(string $supportId)
    {

        return  $this->entity->findOrFail($supportId);
    }
}
