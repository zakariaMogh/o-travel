<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\CompanyContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{

    protected $company;

    public function __construct(CompanyContract $company)
    {
        $this->company = $company;

        $this->middleware(['permission:view-company'])->only(['index', 'show']);
        $this->middleware(['permission:edit-company'])->only(['edit', 'update']);
        $this->middleware(['permission:create-company'])->only(['create', 'store']);
        $this->middleware(['permission:delete-company'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $companies = $this->company->findByFilter();

        if ($request->wantsJson())
        {
            return response()->json(compact('companies'));
        }

        return view('admin.companies.index', compact('companies'));
    }


    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $company = $this->company->findOneById($id);
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return Renderable
     */
    public function edit($id): Renderable
    {
        $company = $this->company->findOneById($id);
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @return RedirectResponse
     */
    public function checkUncheckCompany($id)
    {
        try {
            $company = $this->company->checkToggle($id);
            session()->flash('success',__('messages.update'));
            return redirect()->back();
        }catch (\Exception $exception)
        {
            session()->flash('error',$exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @return RedirectResponse
     */
    public function activeInactiveCompany($id)
    {
        $company = $this->company->activeToggle($id);
        session()->flash('success',__('messages.update'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->company->destroy($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.companies.index');
    }

}
