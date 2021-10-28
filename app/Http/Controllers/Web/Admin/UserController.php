<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    protected $user;

    public function __construct(UserContract $user)
    {
        $this->user = $user;

        $this->middleware(['permission:view-user'])->only(['index', 'show']);
        $this->middleware(['permission:edit-user'])->only(['edit', 'update']);
        $this->middleware(['permission:create-user'])->only(['create', 'store']);
        $this->middleware(['permission:delete-user'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $users = $this->user->findByFilter();
        return view('admin.users.index', compact('users'));
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $user = $this->user->findOneById($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Renderable
     */
    public function edit($id): Renderable
    {
        $user = $this->user->findOneById($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->user->update($id, $request->validated());
        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.users.show',$user->id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->user->destroy($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.users.index');
    }

}
