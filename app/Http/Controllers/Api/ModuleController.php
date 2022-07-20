<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\moduleResource;
use App\Repositories\ModuleRepository;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    protected $repository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->repository = $moduleRepository;
    }

    public function index($Courseid)
    {
        $module = $this->repository->getModulesByCoursesId($Courseid);

        return moduleResource::collection($module);
    }

    public function show($id)
    {
        $course =  $this->repository->getModule($id);

        return new moduleResource($course);
    }
}
