<?php

namespace Bitsbybit\Math\Common\Action;

use \Slim\Container;

class BaseAction
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var array
     */
    protected $settings;

    public function __construct(Container $c)
    {
        $this->container = $c;
        $this->settings = $c->get('settings');
    }
}