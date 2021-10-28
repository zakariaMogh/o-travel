<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\CityContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $city;

    public function __construct(CityContract $city)
    {
        $this->city = $city;

        $this->middleware(['permission:view-city'])->only(['index', 'show']);
        $this->middleware(['permission:edit-city'])->only(['edit','update']);
        $this->middleware(['permission:create-city'])->only(['create', 'store']);
        $this->middleware(['permission:delete-city'])->only(['destroy']);
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $cities = $this->city->findByFilter();
        return view('admin.cities.index',compact('cities'));
    }

    /**
     * @return Renderable
     */
    public function create() : Renderable
    {
        return view('admin.cities.create');
    }

    public function store(CityRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->city->new($data);

        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.cities.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $city = $this->city->findOneById($id);
        return view('admin.cities.show',compact('city'));
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id): Renderable
    {
        $city = $this->city->findOneById($id);
        return view('admin.cities.edit',compact('city'));
    }


    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id,CityRequest $request)
    {
        $data = $request->validated();
        $this->city->update($id,$data);

        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.cities.index');
    }


    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->city->destroy($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.cities.index');
    }
}
