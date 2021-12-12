<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\NotificationContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    /**
     * @var NotificationContract
     */
    protected $notification;
    public function __construct(NotificationContract $notification)
    {
        $this->notification = $notification;

        $this->middleware(['permission:create-admin-notification'])->only(['create', 'store','send']);
        $this->middleware(['permission:view-admin-notification'])->only(['index','show']);
        $this->middleware(['permission:edit-admin-notification'])->only(['edit','update']);
        $this->middleware(['permission:delete-admin-notification'])->only(['destroy']);
    }

    /**
     * @return Renderable
     */
    public function index() : Renderable
    {
        $notifications = $this->notification->findByFilter();
        return view('admin.notifications.index',compact('notifications'));
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('admin.notifications.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:240',
            'message' => 'required|string',
            'receivers' => 'required|in:1,2,3'
        ]);
        $n = $this->notification->new($data);
        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.notifications.index');
    }

    public function show($id)
    {
        $notification = $this->notification->findOneById($id);
        return view('admin.notifications.index');
    }

    public function edit($id)
    {
        $notification = $this->notification->findOneById($id);
        return view('admin.notifications.edit',compact('notification'));
    }

    public function update($id,Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:240',
            'message' => 'required|string',
            'receivers' => 'required|in:1,2,3'
        ]);
        $this->notification->update($id,$data);
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.notifications.index');
    }

    public function destroy($id)
    {
        $this->notification->destroy($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.notifications.index');
    }

    public function send($id)
    {

        try {
            $this->notification->sendAdminNotification($id);
            session()->flash('success',__('messages.send-with-success'));
            return redirect()->back();
        }catch (\Exception $exception)
        {
            session()->flash('error',__('messages.fail'));
            return redirect()->back();
        }
    }


}
