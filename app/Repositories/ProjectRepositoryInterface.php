<?php

namespace App\Repositories;

interface ProjectRepositoryInterface {

    public function store($name, $description);

    public function update($id, $name, $description);

    public function delete($id);
}
