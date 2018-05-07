<?php
namespace Bitsbybit\Math\Users\Service;

class User
{
    private $userRepo;

    public function __construct(\Bitsbybit\Math\Users\Repository\User $repo)
    {
        $this->userRepo = $repo;
    }

    public function create(array $args)
    {

    }

    public function update($id, array $args)
    {

    }

    public function delete($id)
    {

    }

    public function get($id, array $args)
    {

    }
}