<?php
namespace Bitsbybit\Math\Users\Action;
use Bitsbybit\Math\Common\Action\BaseAction;
use Bitsbybit\Math\Users\Service\User as UserService;
use Bitsbybit\Math\Users\Service\User;
use Slim\Container;
use Slim\Http\Response;

/**
 * Created by PhpStorm.
 * User: tbart
 * Date: 5/6/2018
 * Time: 7:10 PM
 */

class UserAction extends BaseAction
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(Container $c, User $service)
    {
        parent::__construct($c);
        $this->userService = $service;
    }

    public function create(array $args): Response
    {

    }

    public function update($id, array $args): Response
    {

    }

    public function delete($id): Response
    {

    }

    public function get($id, array $args): Response
    {

    }
}