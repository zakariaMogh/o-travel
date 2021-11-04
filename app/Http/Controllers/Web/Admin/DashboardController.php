<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

        $companies_count = DB::table('companies')->count();
        $users_count = DB::table('users')->count();
        $categories_count = DB::table('categories')->count();
        $domains_count = DB::table('domains')->count();
        $countries_count = DB::table('countries')->count();
        $cities_count = DB::table('cities')->count();




        return view('admin.dashboard',compact(
            'users_count','companies_count','categories_count','domains_count','countries_count','cities_count'
        ));
    }
}
