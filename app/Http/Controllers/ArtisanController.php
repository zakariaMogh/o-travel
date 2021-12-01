<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function migrate(){
        $command = 'migrate';

        if (\request()->has('fresh'))
        {
            $command .=":fresh";
        }

        Artisan::call($command);
        return 'done';
    }

    public function storage()
    {

        Artisan::call('storage:link');
        return 'done';
    }

    public function seed()
    {

        Artisan::call('db:seed');
        return 'done';
    }

    public function cache()
    {

        Artisan::call('optimize');
        Artisan::call('cache:clear');
        Artisan::call('view:cache');
        Artisan::call('route:cache');
        Artisan::call('config:cache');
        return 'done';
    }
}
