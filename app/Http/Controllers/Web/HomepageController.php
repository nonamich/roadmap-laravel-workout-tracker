<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseController;
use Inertia\Inertia;
use Inertia\Response;

class HomepageController extends BaseController
{
    public function show(): Response
    {
        return Inertia::render('HomePage');
    }
}
