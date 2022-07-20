<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreView;
use App\Http\Resources\LessonResource;
use App\Repositories\LessonRepository;

class LessonController extends Controller
{
    public function __construct(LessonRepository $lessonRepository)
    {
        $this->repository = $lessonRepository;
    }
    public function index($moduleId)
    {
        $lessons = $this->repository->getLessonByModuleId($moduleId);
        return LessonResource::collection($lessons);
    }


    public function show($lessonId)
    {
        return new LessonResource($this->repository->getLesson($lessonId));
    }

    public function viewed(StoreView $request)
    {
        $this->repository->markLessonViewd($request->lesson);
        return response()->json(['success' => true]);
    }
}
