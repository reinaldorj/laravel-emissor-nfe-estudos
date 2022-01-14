<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface ProdutoRepositoryInterface
{
    public function __construct(Model $model);
    public function store(array $data);
    public function getList();
    public function get(int $id);
    public function update(array $data, int $id);
    public function destroy(int $id);
    public function search(string $name);
}
