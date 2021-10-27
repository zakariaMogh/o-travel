<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\AdminContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $admin;

    public function __construct(AdminContract $admin)
    {
        $this->admin = $admin;

        $this->middleware(['permission:view-admin'])->only(['index', 'show']);
        $this->middleware(['permission:edit-admin'])->only(['edit','update','editPassword','updatePassword']);
        $this->middleware(['permission:create-admin'])->only(['create', 'store']);
        $this->middleware(['permission:delete-admin'])->only(['destroy']);
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $admins = $this->admin->setRelations(['roles'])->findByFilter();
        return view('admin.admins.index',compact('admins'));
    }

    /**
     * @return Renderable
     */
    public function create() : Renderable
    {
        return view('admin.admins.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:admins,email',
            'password'  => 'required|string|min:8|max:24|confirmed',
            'roles'  => 'required|array',
            'roles.*'  => 'required|integer',
            'pic'       => 'sometimes|nullable|file|image|max:3000',
        ]);

        $this->admin->new($data);

        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.admins.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $admin = $this->admin->setRelations(['roles'])->findOneById($id);
        return view('admin.admins.show',compact('admin'));
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id): Renderable
    {
        $admin = $this->admin->setRelations(['roles'])->findOneById($id);
        return view('admin.admins.edit',compact('admin'));
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function editPassword($id): Renderable
    {
        $admin = $this->admin->findOneById($id);
        return view('admin.admins.edit-password',compact('admin'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function updatePassword($id,Request $request): RedirectResponse
    {
        $data = $request->validate([
            'password' => 'required|string|max:24|min:8|confirmed'
        ]);

        $this->admin->update($id,$data);

        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.admins.show',$id);
    }


    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id,Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'roles'     => 'required|array',
            'roles.*'   => 'required|integer',
            'email'     => 'required|email|unique:admins,email,'.$id,
            'pic'       => 'sometimes|nullable|file|image|max:3000',
        ]);
        $this->admin->update($id,$data);

        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.admins.show',$id);
    }


    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->admin->destroy($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.admins.index');
    }
}
