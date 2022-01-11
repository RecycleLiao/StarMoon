<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomTypes = RoomType::orderBy('created_at','desc')->get();
        return view('admin.room-type.index',compact('roomTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.room-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RoomType::create($request->all());
        return redirect()->route('room-types.index')
                        ->with([
                            'message' =>'類別新增成功',
                            'color'=> 'alert-success'
                        ]);
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
        $roomType = RoomType::find($id);
        return view('admin.room-type.edit',compact('roomType'));
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
        RoomType::find($id)->update($request->all());

        return redirect()->route('room-types.index')
                        ->with([
                            'message'=>'類別更新成功',
                            'color'=>'alert-success'
                        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roomType = RoomType::with('rooms')->find($id);
        // 如果有產品
        if($roomType->rooms->count()){
            return redirect()
            ->route('room-types.index')
            ->with([
                'message'=>'目前'.$roomType->name.'類別，尚有'.$roomType->rooms->count().'個房間，無法刪除。',
                'color'=>'alert-danger'
            ]);
        }
        
        $roomType->delete();
        return redirect()
        ->route('room-types.index')
        ->with([
            'message'=>'刪除成功!!',
            'color'=>'alert-success'
        ]);
    }
}
