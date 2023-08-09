<?php

namespace MyApp\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\QueryBuilder;

class Repository implements RepositoryInterface
{
    /**
     * @var ModelInterface $model
     */
    protected $model;
    /**
     * @var array $errors
     */
    private $errors = [];

    /**
     * @return ModelInterface
     */
    public function getModel(): BaseModel
    {
        return $this->model;
    }

    /**
     * @param  BaseModel  $model
     */
    public function setModel(BaseModel $model): self
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param  array  $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    public function minimalListWithFilter(
        array $listFields = ['id', 'title'],
        array $with = [],
        array $where = []
    ): \Illuminate\Database\Eloquent\Collection|array {

        $query = $this->getModel()->select($listFields)->limit(request('limit',250));
        if(!empty($with)){
            $query = $query->with($with);
        }
        if(!empty($where)){
            $query = $query->where($where);
        }
        if(!empty($with) && !empty($where)){
            $query = $query->with($with)->where($where);
        }
        return QueryBuilder::for(
            $query
        )
            ->allowedFilters($this->getModel()->getAllowedFilters())
            ->allowedSorts($this->getModel()->getAllowedSorts())
            ->get();
    }

    public function minimalListWithLocation(
        array $listFields = ['id', 'title', 'address', 'location', 'property_type_id', 'company_id', 'city_id','area_id'],
        array $with = ['type' ,'company'],
        array $where = []
    ): \Illuminate\Database\Eloquent\Collection|array {
        $query = $this->getModel()->select($listFields);
        if(!empty($with)){
            $query = $query->with($with);
        }
        if(!empty($where)){
            $query = $query->where($where);
        }
        if(!empty($with) && !empty($where)){
            $query = $query->with($with)->where($where);
        }
        return QueryBuilder::for(
            $query
        )
            ->allowedFilters($this->getModel()->getAllowedFilters())
            ->allowedSorts($this->getModel()->getAllowedSorts())
            ->get();
    }

    /**
     * @param array $columns
     * @param array $relations
     * @return
     */
    public function allData(array $columns = ['*'], array $relations = [])
    {
        return $this->model->with($relations)->get($columns);
    }

    /**
     * Get all trashed models.
     *
     * @return
     */
    public function allTrashed()
    {
        return $this->model->onlyTrashed()->get();
    }

    /**
     * Find model by id.
     *
     * @param  $modelId
     * @param array $columns
     * @param array $relations
     * @param array $appends
     * @return Model
     */
    public function findById(
         $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model {
        return $this->model->select($columns)->with($relations)->findOrFail($modelId)->append($appends);
    }

    /**
     * Find trashed model by id.
     *
     * @param int $modelId
     * @return Model
     */
    public function findTrashedById(int $modelId): ?Model
    {
        return $this->model->withTrashed()->findOrFail($modelId);
    }

    /**
     * Find only trashed model by id.
     *
     * @param int $modelId
     * @return Model
     */
    public function findOnlyTrashedById(int $modelId): ?Model
    {
        return $this->model->onlyTrashed()->findOrFail($modelId);
    }

    /**
     * Create a model.
     *
     * @param array $payload
     * @return Model
     */
    public function create(array $payload): ?Model
    {
        $model = $this->model->create($payload);

        return $model->fresh();
    }

    /**
     * Update existing model.
     *
     * @param  $modelId
     * @param array $payload
     * @return bool
     */
    public function update($modelId, array $payload): bool
    {
        $model = $this->findById($modelId);

        return $model->update($payload);
    }

    /**
     * Delete model by id.
     *
     * @param $modelId
     * @return bool
     */
    public function deleteById($modelId): bool
    {
        return $this->findById($modelId)->delete();
    }

    /**
     * Restore model by id.
     *
     * @param int $modelId
     * @return bool
     */
    public function restoreById(int $modelId): bool
    {
        return $this->findOnlyTrashedById($modelId)->restore();
    }

    /**
     * Permanently delete model by id.
     *
     * @param int $modelId
     * @return bool
     */
    public function permanentlyDeleteById(int $modelId): bool
    {
        return $this->findTrashedById($modelId)->forceDelete();
    }

    public function updateWithData($modelId, $payload){
        $model = $this->findById($modelId);

         $model->update($payload);

        return $model->fresh();
    }

}
