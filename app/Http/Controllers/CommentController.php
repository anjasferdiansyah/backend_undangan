<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @group Comment
 */
class CommentController extends Controller
{
    use ResponseAPI;

    /**
     * Display a listing of the resource.
     *
     * @queryParam page[number] string Customizing the URI paginator. Example: 1
     * @queryParam page[size] string Adjusting the amount of data displayed. Example: 2
     * @queryParam sort string Sort data ( key_name / -key_name ), default -created_at. Example: created_at
     *
     * @queryParam filter[created_at] string Sorting by date created. Example: 2020-12-24
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $alloweds = [
            'created_at'
        ];

        $data = QueryBuilder::for(Comment::class)
            ->allowedFilters($alloweds)
            ->allowedSorts($alloweds)
            ->defaultSort('-' . $alloweds[0])
            ->jsonPaginate();

        return CommentResource::collection($data);
    }

    /**
     * Store Comment.
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $validated = $request->validated();

        $data = Comment::create($validated);

        return (new CommentResource($data))->additional([
            'message' => __('messages.created'),
        ]);
    }

    /**
     * Update Comment.
     *
     * @param CommentRequest $request
     * @param \App\Models\Comment $comment
     * @return CommentResource
     *
     * @urlParam Comment int required valid id Comment. Defaults to 'id'. Example: 1
     */
    public function update(CommentRequest $request, Comment $comment)
    {

        $validated = $request->validated();

        $comment->update($validated);

        return (new CommentResource($comment))->additional([
            'message' => __('messages.updated'),
        ]);
    }

    /**
     * Delete Comment.

     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     *
     * @return \Illuminate\Http\Response
     *
     * @urlParam Comment int required valid id Comment. Defaults to 'id'. Example: 1
     */
    public function delete(Request $request, Comment $comment)
    {
        $comment->delete();

        return $this->responseMessage(__('messages.deleted'));
    }
}
