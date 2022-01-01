<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;
use App\Models\User;

class DataTableExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email']
        ]);
        
        // if($request->page < 1 || $request->page > )

        $users = User::when($request->name, function($query, $term) {
            $query->where('name', 'LIKE', '%'.$term.'%');
        });

        // if (isset($request->field)){
        //     $users->orderBy("$request->field", "$request->direction");
        // }

        if($request->has(['field','direction'])){
            $users->orderBy($request->field, $request->direction);
        }

        // dd($users);
        // dd($request->field);

        return Inertia::Render('DataTableExample',[
            'users' => $users->paginate(),
            'pField' => $request->field,
            'pDirection' => $request->direction,
            // 'pName'
        ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
