<?php

/**
 * Class Application
 */
class Application
{
    /**
     * @var
     */
    static public $route;

    /**
     *
     */
    static public function processRoute()
    {
        $part = explode('?', $_SERVER['REQUEST_URI']);

        self::$route = $part[0];
    }

    /**
     *
     */
    static public function runController()
    {
        switch (self::$route) {
            case('/'):
                require_once APPLICATION_ROOT . '/application/controller/index.php';
                break;
            case('/add'):
                require_once APPLICATION_ROOT . '/application/controller/add.php';
                break;
            default:
                echo 'Page was not found';
                break;
        }
    }

    /**
     * @return mixed
     */
    static public function getConfig()
    {
        return require_once APPLICATION_ROOT . '/config/env/' . env . '.php';
    }
}