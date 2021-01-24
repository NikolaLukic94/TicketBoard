<?php

namespace App\Repositories;

interface ProjectRepositoryInterface {

    public function store($name, $description, $projectMemberIds);

    public function update($id, $name, $description);

    public function delete($id);
}
