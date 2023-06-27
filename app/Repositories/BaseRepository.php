<?php

namespace App\Repositories;

use Exception;
use App\Consts;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Exceptions\BadRequestException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * model property on class instances
     */
    protected $model;
    protected $msgNotFound = 'Not Found';
    /**
     * Constructor to bind model to repo
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get the associated model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * Set the associated model
     * @param $model
     *
     * @return BaseRepository
     */
    public function setModel($model): BaseRepository
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return array
     */
    public function getGuarded(): array
    {
        return $this->model->getGuarded();
    }

    /**
     * @return array
     */
    public function getFillable(): array
    {
        return $this->model->getFillable();
    }

    /**
     * Get all instances of model
     * @param array|null $condition
     * @param string $sort
     * @return Collection|Model[]
     */
    public function getAll(array $condition = null, $sort = 'id')
    {
        if (!empty($condition)) {
            return $this->model->when(!empty($condition), function ($q) use ($condition) {
                return $q->where($condition);
            })->orderByDesc($sort)->get();
        }
        return $this->model->all()->sortByDesc($sort);
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function getMany($ids)
    {
        return $this->model->whereIn('_id', $ids)->get();
    }

    /**
     * Count all instances of model
     * @param array|null $condition
     * @return mixed
     */
    public function countAll(array $condition = null)
    {
        return $this->model->when(!empty($condition), function ($q) use ($condition) {
            return $q->where($condition);
        })->count();
    }

    /**
     * create a new record in the database
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $attributes['created_at'] = Carbon::now();
        return $this->model->create($attributes);
    }

    /**
     * create a new record in the database
     * @param array $attributes
     * @return mixed
     */
    public function insert(array $attributes)
    {
        $attributes['created_at'] = Carbon::now();
        return $this->model->insert($attributes);
    }

    /**
     * @param $attributes
     * @return bool
     */
    public function insertMany($attributes): bool
    {
        return DB::table($this->model->getTable())->insert($attributes);
    }

    /**
     * update record in the database
     * @param array $data
     * @param null $id
     * @return mixed
     */
    public function update(array $data, $id = null)
    {
        $record = $this->find($id);
        $data['updated_at'] = Carbon::now();
        return $record->update($data);
    }

    /**
     * update record in the database
     * @param array $data
     * @param array $condition
     * @return mixed
     */
    public function updateCondition(array $data, array $condition = [])
    {
        $data['updated_at'] = Carbon::now();
        return $this->model->where($condition)->update($data);
    }

    /**
     * @param array $values
     * @param array $attributes
     * @param string $key
     * @return bool
     */
    public function bulkUpdate(array $values, array $attributes, $key = 'id'): bool
    {
        if (!empty($attributes)) {
            return $this->model->whereIn($key, $values)
                ->update($attributes);
        }
        return false;
    }

    /**
     * update record in the database
     * @param array $condition
     * @param $column
     * @param $num
     * @return mixed
     */
    public function increment(array $condition, $column, $num)
    {
        return $this->model->where($condition)->increment($column, $num);
    }

    /**
     * update record in the database
     * @param array $condition
     * @param $column
     * @param $num
     * @return mixed
     */
    public function decrement(array $condition, $column, $num)
    {
        return $this->model->where($condition)->decrement($column, $num);
    }

    /**
     * remove record from the database
     * @param $id
     * @return bool|null
     * @throws Exception
     */
    public function destroy($id): ?bool
    {
        return $this->model->destroy($id);
    }

    /**
     * Check if model exists
     * @param $id
     * @return mixed
     */
    public function exists($id)
    {
        return $this->model->exists($id);
    }

    /**
     * show the record with the given id
     * @param $id
     * @param array|null $field
     * @return mixed
     */
    public function find($id, array $field = null)
    {
        if (!empty($field)) {
            return $this->model->find($id, $field);
        }
        return $this->model->find($id);
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     * @throws BadRequestException
     */
    public function findOrBad($id)
    {
        try {
            $result = $this->model->findOrFail($id);
        } catch (\Exception $e) {
            throw new BadRequestException($this->msgNotFound, Consts::CODE_SUCCESS);
        }
        return $result;
    }

    /**
     * @param array $condition
     * @return mixed
     */
    public function filter(array $condition)
    {
        return $this->model->where($condition)->get();
    }

    /**
     * Eager load database relationships
     * @param array $relations
     * @return Builder
     */
    public function with(array $relations): Builder
    {
        return $this->model->with($relations);
    }

    /**
     * update or create a new record in the database
     * @param array $data
     * @param array|null $condition
     * @return mixed
     */
    public function updateOrCreate(array $data, array $condition = null)
    {
        return $this->model->updateOrCreate($condition, $data);
    }

    /**
     * The pluck method retrieves all of the values for a given key
     * @param $value
     * @param $key
     * @param null $condition
     * @return mixed
     */
    public function pluck($value, $key, $condition = null)
    {
        return $this->model
            ->when(!empty($condition), function ($q) use ($condition) {
                return $q->where($condition);
            })
            ->pluck($value, $key);
    }

    /**
     *  Get all instances of model with paginate
     * @param int $limit
     * @param null $condition
     * @param null $sort
     * @param string|null $direction
     * @return mixed
     */
    public function paginated($limit = Consts::PER_PAGE, $condition = null, $sort = null, ?string $direction = 'ASC', array $with = [])
    {
        return $this->model
            ->with($with)
            ->when(!empty($condition), function ($q) use ($condition) {
                return $q->where($condition);
            })
            ->when(!empty($sort), function ($query) use ($sort, $direction) {
                return $query->orderBy($sort, $direction);
            }) // sort
            ->paginate($limit);
    }

    public function customPaginate($query,$load = [], $perPage = Consts::PER_PAGE) {
        $page = Paginator::resolveCurrentPage();
        $newQueryCount = array_merge($query, [['$count' => "count"]]);
        $countRow = $this->model->raw(function ($collection) use ($newQueryCount) {
            return $collection->aggregate($newQueryCount);
        });
        $total = @$countRow[0]->count ?? 0;
        $paginateData = [
            ['$skip' => ($page - 1) * $perPage],
            ['$limit' => $perPage],
        ];
        $mergeQuery = array_merge($query, $paginateData);
        $collection = $this->model->raw(function ($collection) use ($mergeQuery) {
            return $collection->aggregate($mergeQuery);
        });

        if (!empty(sizeof($load))){
            $collection = $collection->load($load);
        }

        return new LengthAwarePaginator($collection, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
        ]);
    }

    public function findByCond(array $condition = null, $with = [])
    {
        return $this->model->with($with)->where($condition)->first();
    }

    public function findByWhereIn(array $condition = null, $whereIn = [], $id)
    {
        return $this->model->where($condition)->whereIn($id, $whereIn)->first();
    }

    public function getByCond(array $condition = null, $with = [], $orderColumn = '', $direction = 'asc')
    {
        return $this->model->with($with)
            ->where($condition)
            ->when($orderColumn, function ($q) use ($direction, $orderColumn){
                $q->orderBy($orderColumn, $direction);
            })
            ->get();
    }

    public function getToken(){
        return Str::random(32);
    }
}
