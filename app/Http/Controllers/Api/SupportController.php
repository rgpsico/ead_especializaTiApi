<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplaySupport;
use App\Http\Resources\ReplySupportResource;
use App\Http\Resources\SupportResource;
use App\Repositories\ReplyRepository;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $supportRepository;


    public function __construct(SupportRepository $supportRepository)
    {
        $this->supportRepository = $supportRepository;
    }

    public function index(Request $request)
    {
        $support = $this->supportRepository->getSupports($request->all());

        return SupportResource::collection($support);
    }

    public function mySupports(Request $request)
    {

        $support = $this->supportRepository->getMySupports($request->all());

        return SupportResource::collection($support);
    }


    public function store(Request $request)
    {
        $support = $this->supportRepository
            ->createNewSupport($request->all());

        return new ReplySupportResource($support);
    }
}
