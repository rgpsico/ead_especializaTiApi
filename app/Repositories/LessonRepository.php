<?php

namespace App\Repositories;


use App\Models\Lesson;
use App\Models\Traits\RepositoryTrait;

class LessonRepository
{
    use RepositoryTrait;

    protected $entity;

    public function __construct(Lesson $model)
    {
        $this->entity = $model;
    }

    public function getLessonByModuleId(string $moduleId)
    {
        return $this->entity::where('module_id', $moduleId)->get();
    }

    public function getLesson($lessonId)
    {
        return $this->entity::findOrFail($lessonId);
    }

    public function markLessonViewd(string $lessonId)
    {
        $user = $this->getUserAuth();

        $view  = $user->views()->where('lesson_id', $lessonId)->first();

        if ($view) {
            $view->update([
                'qty' => $view->qty + 1
            ]);
        }

        return $user->views()->create([
            'lesson_id' => $lessonId
        ]);
    }
}
