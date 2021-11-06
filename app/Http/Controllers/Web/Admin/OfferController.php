<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\OfferContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;

class OfferController extends Controller
{
    protected $offer;

    public function __construct(OfferContract $offer)
    {
        $this->offer = $offer;


        $this->middleware(['permission:view-offer'])->only(['index', 'show']);
        $this->middleware(['permission:edit-offer'])->only(['edit','update']);
        $this->middleware(['permission:create-offer'])->only(['create', 'store']);
        $this->middleware(['permission:delete-offer'])->only(['destroy']);
    }


    public function index()
    {
        $offers = $this->offer->findByFilter();
        return view('admin.offers.index',compact('offers'));
    }

    public function create()
    {
        return view('admin.offers.create');
    }

    public function store(OfferRequest $request)
    {
        $offer = $this->offer->new($request->validated());
        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.offers.show',$offer->id);
    }

    public function show($id)
    {
        $offer = $this->offer->findOneById($id);
        return view('admin.offers.show',compact('offer'));
    }

    public function edit($id)
    {
        $offer = $this->offer->findOneById($id);
        return view('admin.offers.edit',compact('offer'));
    }

    public function update($id,OfferRequest $request)
    {
        $offer = $this->offer->update($id,$request->validated());
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.offers.show',$offer->id);
    }

    public function destroy($id)
    {
        $this->offer->destroy($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.offers.index');
    }
}
