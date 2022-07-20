<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplaySupport;
use App\Http\Resources\ReplySupportResource;
use App\Repositories\ReplyRepository;


class ReplyController extends Controller
{

    protected $replyRepository;

    public function __construct(ReplyRepository $replyRepository)
    {
        $this->replyRepository = $replyRepository;
    }


    public function createReply(StoreReplaySupport $request)
    {
        $reply = $this->replyRepository->createReplyToSupport($request->validated());
        return new ReplySupportResource($reply);
    }
}
