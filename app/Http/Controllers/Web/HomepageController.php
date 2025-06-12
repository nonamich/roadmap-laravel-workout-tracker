<?php

namespace App\Http\Controllers\Web;

use Inertia\Inertia;

class HomepageController extends BaseController
{
    public function show()
    {
        return Inertia::render('HomePage');
    }
}
