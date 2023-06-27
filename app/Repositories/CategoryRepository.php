<?php

namespace App\Repositories;

use App\Consts;
use App\Models\Category;

//use Your Model

/**
 * Class ProductRepository.
 */
class CategoryRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $model;

    public function __construct()
    {
        $this->model = new Category();
    }

    public function getCategoryFilter($request)
    {
        return $this->model
            ->when($request->search !== null, function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('name', 'LIKE', "%$request->search%");
                });
            })
            ->when($request->month !== null, function ($q) use ($request) {
                $q->whereMonth('updated_at', $request->month);
            })
            ->orderByDesc('updated_at')
            ->paginate(Consts::PER_PAGE);
    }
}
