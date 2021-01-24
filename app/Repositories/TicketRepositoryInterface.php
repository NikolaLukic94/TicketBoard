<?php

namespace App\Repositories;

interface TicketRepositoryInterface {

    public function store($request);

    public function update($request);

    public function delete($id);
}
