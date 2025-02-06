<?php

namespace App\Modules\Core\Repositories;

use App\Modules\Core\Interfaces\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepositoryEloquent implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $record = $this->model->find($id);
        if ($record) {
            $record->update($data);
            return $record;
        }
        return null;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
