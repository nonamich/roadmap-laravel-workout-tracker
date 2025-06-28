<?php

namespace App\Http\Controllers\Api;

use App\Data\Api\Comment\CommentUpdateRequest;
use App\Data\Shared\Requests\IndexQueryData;
use App\Http\Controllers\BaseController;
use App\Models\Comment;
use App\Services\PaginationService;
use Illuminate\Http\Resources\Json\JsonResource;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;

#[Authenticated]
#[Group('Comment')]
class CommentResourceController extends BaseController
{
    public function __construct(private PaginationService $pagination)
    {
        $this->authorizeResource(Comment::class, 'comment');
        $this->middleware('auth:api');
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Comment::class, collection: true, simplePaginate: 10)]
    public function index(IndexQueryData $data): JsonResource
    {
        $query = Comment::query()
            ->where('user_id', '=', $this->getUserOrThrow()->id);

        return new JsonResource($this->pagination->paginate($query, $data));
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Comment::class)]
    public function show(Comment $comment): JsonResource
    {
        return new JsonResource($comment);
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Comment::class)]
    public function update(Comment $comment, CommentUpdateRequest $data): JsonResource
    {
        $comment->update([
            'body' => $data->body,
        ]);

        return new JsonResource($comment);
    }

    public function destroy(Comment $comment): void
    {
        $comment->delete();
    }
}
