<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

abstract class Controller
{
    /**
     * Render view dengan data yang diberikan.
     *
     * @param  string  $view  Nama view yang akan dirender
     * @param  array  $data  Data yang akan dikirim ke view
     * @return \Illuminate\View\View  Instance view yang telah dirender
     */
    protected function render(string $view, array $data = []): View
    {
        return view($view, $data);
    }
}
