<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = \App\Member::get();
        return view('members.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $datas = $request->all();

        $img = $datas['member_path'];
        $name = $datas['member_name'];
        $content = $datas['member_content'];

        $form_data = array(
            'img' => $img,
            'name' => $name,
            'content' => $content,
        );

        $member = \App\Member::create($form_data);
        $id = $member->id;

        $form_data['id'] = $id;

        return response()->json($form_data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = \App\Member::findorFail($id); //  id를 검색 그러나 결과가 발견되지 않으면 예외 발생
        
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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

        $id = $datas['member_id'];
        $img = $datas['member_path'];
        $name = $datas['member_name'];
        $content = $datas['member_content'];

        $form_data = array(
            'img' => $img,
            'name' => $name,
            'content' => $content,
        );

        \App\Member::whereId($id)->update($form_data);
        return response()->json($form_data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $datas = $request-> all();
        $id = $datas['member_id'];
        \App\Member::find($id)->delete();
        return response()->json();
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
        if($request->hasFile('img')){

            $img = $request->file('img');
    
            $new_name = rand() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images'), $new_name);
        }
        return response()->json($new_name);
    }
}
