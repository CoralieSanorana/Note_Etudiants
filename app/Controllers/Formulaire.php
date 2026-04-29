<?php

namespace App\Controllers;

class Formulaire extends BaseController
{
    public function index(): string
    {
        return view('Formulaire');
    }
}
