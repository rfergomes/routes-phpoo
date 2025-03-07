<?php
namespace app\controllers;

class NotFoundController
{
    public function index()
    {
        //dd('error 404');
        \redirect('/404');
    }
}
