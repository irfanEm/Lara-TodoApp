<?php

namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService
{
    private array $users = [
        "balqis_fa" => "130321",
        "shilvia_qa" => "170303",
        "irfan_em" => "271197"
    ];

    public function login(string $user, string $password): bool
    {
        if(!isset($this->users[$user]))
        {
            return false;
        }

        $passwordBenar = $this->users[$user];
        return $password == $passwordBenar;
    }
}
