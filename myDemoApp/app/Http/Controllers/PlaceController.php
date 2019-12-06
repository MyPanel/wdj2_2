<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('places.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $place_datas = $request->all();

        $time_string = date('YmdHis', time() );

        // 유효성 검사
        $request->validate([
            'new_img' => 'required|image|max:2048',
            'new_title' =>  'required',
            'new_body' => 'required',
        ]);

        if($request->hasFile('new_img')){

            $img = $request->file('new_img');

            $new_name = $time_string . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('image/place'), $new_name);
            $form_data = array(
                'place_picture' => $new_name,
                'title' => $place_datas['new_title'],
                'body' => $place_datas['new_body'],
            );
        }

        \App\Place::create($form_data);

        return redirect('infos')->with('success', 'Data Added successfully');

        // sreturn veiw('infos/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = \App\Place::findorFail($id); 
        
        return view('places.show', compact('place'));
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

    public function upload(Request $request)
    {

        $time_string = date('YmdHis', time() );

        if($request->hasFile('place_img')){

            $img = $request->file('place_img');
            
            $new_name = $time_string . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('image/place'), $new_name);
        }
        return response()->json($new_name);
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
        $id = $datas['place_id'];
        $form_data = array(
            'place_picture'=>$datas['place_img'],
            'title' => $datas['place_title'],
            'body' => $datas['place_body'],
        );

        \App\Place::whereId($id)->update($form_data);
        return response()->json($form_data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = \App\Place::find($id);
        $place->delete();
        return redirect('infos');
    }
}
