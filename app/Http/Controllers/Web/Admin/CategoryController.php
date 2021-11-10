<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\CategoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryContract $category)
    {
        $this->category = $category;

        $this->middleware(['permission:view-category'])->only(['index', 'show']);
        $this->middleware(['permission:edit-category'])->only(['edit','update']);
        $this->middleware(['permission:create-category'])->only(['create', 'store']);
        $this->middleware(['permission:delete-category'])->only(['destroy']);
    }

    /**
     */
    public function index(Request $request)
    {
        $categories = $this->category->findByFilter();

        if ($request->wantsJson())
        {
            return response()->json(compact('categories'));
        }
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * @return Renderable
     */
    public function create() : Renderable
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->category->new($data);

        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.categories.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $category = $this->category->findOneById($id);
        return view('admin.categories.show',compact('category'));
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id): Renderable
    {
        $category = $this->category->findOneById($id);
        return view('admin.categories.edit',compact('category'));
    }


    /**
     * @param $id
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function update($id,CategoryRequest $request)
    {
        $data = $request->validated();
        $this->category->update($id,$data);

        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.categories.index');
    }


    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->category->destroy($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.categories.index');
    }
}
