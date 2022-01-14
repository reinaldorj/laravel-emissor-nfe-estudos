<?php

namespace App\Services;

use App\Repositories\ProdutoRepositoryInterface;

class ProdutoService
{
    protected $repo;

    public function __construct(ProdutoRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function store(array $data)
    {
        if (!isset($data['gtin']))
            $data->merge(['gtin' => 'SEM GTIN']);

        if (!isset($data['cbenef']))
            $data->merge(['cbenef' => 'SEM CBENEF']);

        return $this->repo->store($data);
    }

    public function getList()
    {
        return $this->repo->getList();
    }

    public function get(int $id)
    {
        return $this->repo->get($id);
    }

    public function update(array $data, $id)
    {
        if (!isset($data['gtin'])) $data->merge(['gtin' => 'SEM GTIN']);

        if (!isset($data['cbenef'])) $data->merge(['cbenef' => 'SEM CBENEF']);

        return $this->repo->update($data, $id);
    }

    public function destroy(int $id)
    {
        return $this->repo->destroy($id);
    }

    public function search(string $name)
    {
        return $this->repo->search($name);
    }
}
