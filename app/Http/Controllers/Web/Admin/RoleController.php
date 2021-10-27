<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * @param Request $request
     * @return Renderable|JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $roles = Role::orderBy('name')->paginate(10);
            return response()->json([
                'roles' => $roles
            ]);
        }

        $roles = Role::with('permissions');


        $roles = app(Pipeline::class)
            ->send($roles)
            ->through([
                \App\QueryFilter\Search::class,
            ])
            ->thenReturn()
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('admin.roles.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        $role = Role::create($data);
        $role->givePermissionTo($data['permissions']);

        session()->flash('success', __('messages.create'));
        return redirect()->route('admin.roles.index');
    }

    /**
     * @param Role $role
     * @return Renderable
     */
    public function edit(Role $role): Renderable
    {
        $role->load(['permissions:id,name']);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * @param Role $role
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Role $role, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
        ]);

        $role->update($data);
        $role->syncPermissions($data['permissions']);
        session()->flash('success', __('messages.update'));
        return redirect()->route('admin.roles.index');
    }

    /**
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        session()->flash('success', __('messages.delete'));
        return redirect()->route('admin.roles.index');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPermissionsList(Request $request): JsonResponse
    {
        $permissions = Permission::orderBy('name')->select(['id', 'name'])->newQuery();
        if ($request->has('search') && !empty($request->get('search'))) {
            $permissions->where('name', 'like', '%' . $request->get('search') . '%');
        }
        $permissions = $permissions->paginate(10);

        $permissions->getCollection()->transform(function ($permission) {
            $permission->name = Str::replace('-', ' ', $permission->name);
            return $permission;
        });

        return response()->json([
            'success' => true,
            'permissions' => $permissions
        ]);
    }
}
