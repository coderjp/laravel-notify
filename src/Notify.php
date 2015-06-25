<?php namespace Coderjp\Notify;

/**
 * This file is part of Notify,
 *
 * @license MIT
 * @package Coderjp\Notify
 */

use BadMethodCallException;
use Illuminate\Support\MessageBag;

class Notify extends MessageBag
{
    /**
     * Laravel application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * Create a new confide instance.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     */
    public function __construct($app)
    {
        $this->app = $app;

        parent::__construct($this->app->session->get($this->getSessionName(), []));
    }

    /**
     * Gets all the message types from the config
     * @return mixed
     */
    public function getTypes()
    {
        return $this->app->config->get('notify.types');
    }

    /**
     * Adds the message to the MessageBag
     * @param $type
     * @param $message
     */
    public function storeNotification($type, $message, $flash = true)
    {
        $this->add($type, $message);

        if ($flash) {
            $this->app->session->flash($this->getSessionName(), $this->messages);
        }
    }

    /**
     * Gets the session name
     * @return mixed
     */
    public function getSessionName()
    {
        return $this->app->config->get('notify.session_name');
    }

    /**
     * Dynamically add messages
     * @param $method
     * @param $params
     */
    public function __call($method, $params)
    {
        $flash = true;
        preg_match('/([a-zA-Z]+)Now/', $method, $matches);

        if (count($matches) === 2) {
            $method = $matches[1];
            $flash = false;
        }

        if (!in_array($method, $this->getTypes())) {
            throw new BadMethodCallException("Method [$method] does not exist");
        }

        if (!is_array($params)) {
            $params = [$params];
        }

        foreach ($params as $message) {
            $this->storeNotification($method, $message, $flash);
        }
    }
}