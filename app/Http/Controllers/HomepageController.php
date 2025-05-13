<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomepageController extends BaseController
{
    public function show()
    {
        return Inertia::render('HomePage');
    }
}
