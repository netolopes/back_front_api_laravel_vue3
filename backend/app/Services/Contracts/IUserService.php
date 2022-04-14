<?php

namespace App\Services\Contracts;

interface IUserService
{
    public function list();
    public function add(string $name, string $msisdn, ?string $password, string $access_level,string $external_id, string $email);
    public function listBy(int $id);
    public function edit(int $id, string $name, string $msisdn, ?string $password, string $access_level,string $external_id, string $email);
    public function delete(int $id);
 }
