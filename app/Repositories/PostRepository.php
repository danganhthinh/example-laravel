<?php

namespace App\Repositories;

use App\Consts;
use App\Models\Post;
use Carbon\Carbon;

//use Your Model

/**
 * Class ProductRepository.
 */
class PostRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $model;

    public function __construct()
    {
        $this->model = new Post();
    }

    public function getPostFilter($request)
    {
        return $this->model->with('categories')
            ->when($request->search !== null, function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('title', 'LIKE', "%$request->search%")
                        ->orWhere('author', 'LIKE', "%$request->search%");
                });
            })
            ->when($request->month !== null, function ($q) use ($request) {
                $q->whereMonth('updated_at', $request->month);
            })
            ->when($request->category_id !== null, function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            })
            ->orderByDesc('updated_at')
            ->paginate(Consts::PER_PAGE);
    }

    public function getRelatedPost($post)
    {
        return $this->model
            ->where('category_id', $post->category_id)
            ->where('id', '<>', $post->id)
            ->orderByDesc('updated_at')
            ->paginate(3);
    }

    public function getHotPostByPost($post)
    {
        return $this->model
            ->where('id', '<>', $post->id)
            ->orderByDesc('updated_at')
            ->paginate(3);
    }
}
