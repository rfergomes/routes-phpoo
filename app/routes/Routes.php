<?php
namespace app\routes;

/**
 * Route class
 * 
 */

class Routes
{
    public static function get()
    {
        return [
            'get' => [
              '/' => 'HomeController@index',
              '/user' => 'UserController@index',
              '/user/create' => 'UserController@create',
              '/user/getById/[0-9]+' => 'UserController@getById',
              '/user/[0-9]+' => 'UserController@userForm',
              '/product/[a-z]+/category/[a-z]+' => 'ProductController@show',
              '/register' => 'RegisterController@store',
              '/contact' => 'ContactController@index'
            ],
            'post' => [
                '/user/store' => 'UserController@store',
                '/user/save' => 'UserController@save',
                '/contact' => 'ContactController@store'
            ]
        ];
    }
}
