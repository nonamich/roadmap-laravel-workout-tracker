<?php

namespace App\Http\Controllers\Api;

use App\Data\Api\Comment\CommentStoreRequest;
use App\Http\Controllers\BaseController;
use App\Models\Comment;
use App\Models\Schedule;
use App\Models\Workout;
use Illuminate\Http\Resources\Json\JsonResource;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;

#[Authenticated]
#[Group('Comment')]
class CommentController extends BaseController
{
    #[ResponseFromApiResource(name: JsonResource::class, model: Comment::class)]
    public function storeSchedule(Schedule $schedule, CommentStoreRequest $data): JsonResource
    {
        $this->authorize('create-comment', $schedule);

        return new JsonResource(
            $schedule->comments()->create([
                'body' => $data->body,
                'user_id' => $this->getUserOrThrow()->id,
            ])
        );
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Comment::class)]
    public function storeWorkout(Workout $workout, CommentStoreRequest $data): JsonResource
    {
        $this->authorize('create-comment', $workout);

        return new JsonResource(
            $workout->comments()->create([
                'body' => $data->body,
                'user_id' => $this->getUserOrThrow()->id,
            ])
        );
    }
}
