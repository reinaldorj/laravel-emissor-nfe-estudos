<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class ProdutoRepositoryEloquent implements ProdutoRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function getList()
    {
        return $this->model->oldest()->paginate(10);
    }

    public function get(int $id)
    {
        return $this->model->find($id);
    }

    public function update(array $data, $id)
    {
        return $this->model->find($id)->update($data);
    }

    public function destroy(int $id)
    {
        return $this->model->find($id)->delete();
    }

    public function search(string $name)
    {
        return $this->model->where('produto', 'like', '%' . $name . '%')->get();
    }
}
