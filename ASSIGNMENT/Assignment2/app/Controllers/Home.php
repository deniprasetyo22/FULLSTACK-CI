<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // return view('welcome_message');
        return '<div>
        <h1>Welcome to the Article Management System.</h1>
        <a href="/articles">Article</a>
        </div>';
    }
}