<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\CountryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $country;

    public function __construct(CountryContract $country)
    {
        $this->country = $country;

        $this->middleware(['permission:view-country'])->only(['index', 'show']);
        $this->middleware(['permission:edit-country'])->only(['edit','update']);
        $this->middleware(['permission:create-country'])->only(['create', 'store']);
        $this->middleware(['permission:delete-country'])->only(['destroy']);
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $countries = $this->country->findByFilter();
        return view('admin.countries.index',compact('countries'));
    }

    /**
     * @return Renderable
     */
    public function create() : Renderable
    {
        return view('admin.countries.create');
    }

    public function store(CountryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->country->new($data);

        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.countries.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $country = $this->country->findOneById($id);
        return view('admin.countries.show',compact('country'));
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id): Renderable
    {
        $country = $this->country->findOneById($id);
        return view('admin.countries.edit',compact('country'));
    }


    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id,CountryRequest $request)
    {
        $data = $request->validated();
        $this->country->update($id,$data);

        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.countries.index');
    }


    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->country->destroy($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.countries.index');
    }
}
