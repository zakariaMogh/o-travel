<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\ReportContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $report;
    public function __construct(ReportContract $report)
    {
        $this->report = $report;

        $this->middleware(['permission:view-report'])->only(['index', 'show']);
        $this->middleware(['permission:edit-report'])->only(['edit','update']);
        $this->middleware(['permission:create-report'])->only(['create', 'store']);
        $this->middleware(['permission:delete-report'])->only(['destroy']);
    }

    /**
     */
    public function index(Request $request)
    {
        $reports = $this->report->findByFilter();

        if ($request->wantsJson())
        {
            return response()->json(compact('reports'));
        }
        return view('admin.reports.index',compact('reports'));
    }


    /**
     * @param $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $report = $this->report->findOneById($id);
        return view('admin.reports.show',compact('report'));
    }


    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->report->destroy($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.categories.index');
    }
}
