<?php

namespace App\Repositories;

interface SubcategoryRepositoryIterface {

    public function store($name, $description);

    public function update($id, $name, $description);

    public function delete($id);
}
