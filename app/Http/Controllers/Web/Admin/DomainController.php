<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\DomainContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\DomainRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    protected $domain;

    public function __construct(DomainContract $domain)
    {
        $this->domain = $domain;

        $this->middleware(['permission:view-domain'])->only(['index', 'show']);
        $this->middleware(['permission:edit-domain'])->only(['edit','update']);
        $this->middleware(['permission:create-domain'])->only(['create', 'store']);
        $this->middleware(['permission:delete-domain'])->only(['destroy']);
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $domains = $this->domain->findByFilter();
        return view('admin.domains.index',compact('domains'));
    }

    /**
     * @return Renderable
     */
    public function create() : Renderable
    {
        return view('admin.domains.create');
    }

    public function store(DomainRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->domain->new($data);

        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.domains.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $domain = $this->domain->findOneById($id);
        return view('admin.domains.show',compact('domain'));
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id): Renderable
    {
        $domain = $this->domain->findOneById($id);
        return view('admin.domains.edit',compact('domain'));
    }


    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id,DomainRequest $request)
    {
        $data = $request->validated();
        $this->domain->update($id,$data);

        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.domains.index');
    }


    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->domain->destroy($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.domains.index');
    }
}
