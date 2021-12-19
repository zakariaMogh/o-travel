<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\CompanyContract;
use App\Contracts\StoryContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{

    protected $company;
    protected $story;

    public function __construct(CompanyContract $company, StoryContract $story)
    {
        $this->company = $company;
        $this->story = $story;


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
     * Display a listing of the resource.
     *
     */
    public function requests(Request $request)
    {
        $companies = $this->company->setScopes(['notApproved'])->findByFilter();

        if ($request->wantsJson())
        {
            return response()->json(compact('companies'));
        }

        return view('admin.companies.requests', compact('companies'));
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

    public function update($id,Request $request)
    {
        $data = $request->validate([
            'auto_accepted' => 'required|integer|in:1,2',
            'max_number_of_offers' => 'required|integer',
            'story_state' => 'required|integer|in:1,2',
        ]);
        $this->company->update($id,$data);
        session()->flash('success',__('messages.update'));
         return redirect()->route('admin.companies.show',$id);
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

    public function approved($id)
    {
        try {
            $this->company->addCheck($id);
            session()->flash('success',__('messages.update'));
            return redirect()->back();
        }catch (\Exception $exception)
        {
            session()->flash('error',$exception->getMessage());
            return redirect()->back();
        }

    }

    public function unpproved($id)
    {
        $this->company->removeCheck($id);
        session()->flash('success',__('messages.update'));
        return redirect()->back();
    }


    public function toggleStory($id)
    {
        $this->story->toggle($id);
        session()->flash('success',__('messages.update'));
        return back();
    }

}
