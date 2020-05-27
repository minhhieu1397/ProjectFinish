<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Detail;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\Detail\CreateDetailRequest;
use App\Http\Requests\Admin\Detail\UpdateDetailRequest;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function store(CreateDetailRequest $request)
    {
        $acount = 0;
        return Detail::create([
            'tour_id' => $request->input('tour_id'),
            'day_start' => $request->input('day_start'),
            'day_end' => $request->input('day_end'),
            'total' => $request->input('total'),
            'amount' => 0,
            'account' => $request->input('account'),
            'description' => $request->input('description')
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
        return Detail::where('tour_id', $id)->get();
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
    public function update($id, UpdateDetailRequest $request)
    {
        $detail = Detail::find($id);
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('image\detail'), $imageName);
        
            $detail->update([
                'day_start' => $request->input('day_start'),
                'day_end' => $request->input('day_end'),
                'image' => $imageName,
                'amount' => $request->input('amount'),
            ]);

            return response([
                'detail' => $detail
            ], 200);
        }
        $detail->update([
            'day_start' => $request->input('day_start'),
            'day_end' => $request->input('day_end'),
            'amount' => $request->input('amount'),
        ]);
        
        return response([
            'detail' => $detail
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail = Detail::find($id);
        $detail->delete();
        return response([
            'result' => 'success'
        ], 200);
    }
}
