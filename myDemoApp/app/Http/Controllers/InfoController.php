<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $infos = \App\Info::get();
        $info = \App\Info::get()->first();
        $places = \App\Place::latest()->paginate(10);
        return view('infos.index', compact('info', 'places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('infos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'outline' => 'required',
            'objective' => 'required',
        ]);

        $form_data = array(
            'outline' => $request->outline,
            'objective' => $request->objective
        );

        \App\Info::create($form_data);

        return redirect('infos')->with('success', 'Data Added success');
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
    public function update(Request $request)
    {

        $datas = $request->all();
        $id = $datas['id'];
        
        $form_data = array(
            'outline' => $datas['info_outline'],
            'objective' => $datas['info_objective'],
        );

        \App\Info::whereId($id)->update($form_data);

        return response()->json($form_data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Info $info)
    {
        $info->delete();

        return redirect('infos');
    }

}
