<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserInterface;

class UserRepository implements UserInterface{

    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function getAll($parameters = [])
    {
        $query = $this->model->newQuery()->orderBy('created_at', 'DESC');
        if(isset($parameters['per_page']))
        {
          return $query->paginate($parameters['per_page']);
        }

        return $query->get();
    }

    public function create(array $row)
    {
        $user = $this->model->fill($row);
        $user->save();
        return $user->fresh();
    }

    public function show($whereCondition)
    {
        return $this->model->where($whereCondition)->first();
    }

    public function update($row, $id)
    {
        $user = $this->model->findOrFail($id);
        $user->fill($row);
        $user->save();
        return $user->fresh();
    }

    public function delete($id)
    {
        return $this->model::findOrFail($id)->delete();
    }

}

?>
