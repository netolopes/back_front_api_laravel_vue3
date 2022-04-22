<?php

namespace App\Services\Contracts;

interface IReportService
{
    public function list($data);
    public function add(string $title, string $category, string $description, int $user_id);
    public function listBy(int $id);
    public function edit(int $id, string $title, string $category, string $description, int $user_id);
    public function delete(int $id);
 }
