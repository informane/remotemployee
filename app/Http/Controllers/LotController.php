<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lot;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use PhpParser\Builder;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lots = Lot::all();
        $categories = Category::all();
        return response()->view('lot/index', ['lots' => $lots,'categories'=>$categories]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        if(!empty($request->categories)) {
            $lots = Lot::whereHas('categories', function (\Illuminate\Database\Eloquent\Builder $query) use ($request) {
                $query->whereIn('categories.id', $request->categories);
            })->get();
        }
        else $lots = Lot::all();

        $categories = Category::all();
        return response()->view('lot/index', ['lots' => $lots,'categories'=>$categories, 'chosenCategories' =>$request->categories]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lot = new Lot();

        $categories = Category::all();

        return response()->view('lot/edit',['lot' => $lot, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'name'=>'required|unique:lots|max:255',
            'desc' => 'required'
        ]);
        if($valid){
            $lot = new Lot();
            $lot->name = $request->name;
            $lot->desc = $request->desc;
            $lot->save();

            $lot->categories()->attach($request->categories);
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lot = Lot::find($id);

        return response()->view('lot/show',['lot' => $lot]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lot = Lot::find($id);
        $categories = Category::all();

        return response()->view('lot/edit',['lot' => $lot, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => [
                'required',
                'max:255',
                Rule::unique('lots')->ignore($id),
            ],
            'desc' => [
                'required',
            ]
        ]);
        if(!$validator->fails()){
            $lot = Lot::find($id);
            $lot->name = $request->name;
            $lot->desc = $request->desc;
            $lot->save();
            $lot->categories()->detach();
            $lot->categories()->attach($request->categories);
            return redirect('/');
        }
        else {
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lot = Lot::find($id);
        $lot->categories()->detach();
        $lot->delete();

        return redirect('/');
    }
}
