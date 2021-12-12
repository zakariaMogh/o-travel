<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\CompanyContract;
use App\Contracts\OfferContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(CompanyContract $company,OfferContract $offer){

        $companies_count = DB::table('companies')->count();
        $users_count = DB::table('users')->count();
        $categories_count = DB::table('categories')->count();
        $domains_count = DB::table('domains')->count();
        $countries_count = DB::table('countries')->count();
        $cities_count = DB::table('cities')->count();
        $normal_offers = DB::table('offers')->where('featured',1)->count();
        $featured_offers = DB::table('offers')->where('featured',2)->count();


        $companies = $company->setScopes(['notApproved'])->setPerPage(5)->findByFilter();
        $latestOffers = $offer->setPerPage(5)->findByFilter();


        return view('admin.dashboard',compact(
            'users_count','companies_count','categories_count','domains_count','countries_count','cities_count',
            'normal_offers','featured_offers','latestOffers','companies'
        ));
    }
}
