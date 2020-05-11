<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tour\CreateTourRequest;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Services\checkJwt;

class TourController extends Controller
{
    protected $checkJwt;

    public function __construct(checkJwt $checkJwt)
    {
        $this->checkJwt = $checkJwt; 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tour::all();
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
    public function store(CreateTourRequest $request)
    {
        $admin = $request->input('jwt');
        $jwt = $request->input('admin');
        if($this->checkJwt->checkJwt($admin, $jwt)) {
            Tour::create([
                'tour_name' => $request->input('tour_name'),
                'vehicle' => $request->input('vehicle'),
                'departure' => $request->input('departure'),
                'day_night' => $request->input('day_night'),
                'price' => $request->input('price'),
                'note' => $request->input('note'),
            ]);
            return response([
                'auth' => true
            ], 200);
        } else {
            return response([
                'auth' => false
            ], 200);
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
        return Tour::all();
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
        $admin = $request->input('jwt');
        $jwt = $request->input('admin');
        if($this->checkJwt->checkJwt($admin, $jwt)) {
            return Tour::all();
        } else {
            return response([
                'auth' => false
            ], 200);
        }
        $tour = Tour::find($id);
        
        $tour->update([
            'tour_name' => $request->input('tour_name'),
            'vehicle' => $request->input('vehicle'),
            'departune' => $request->input('departune'),
            'day_night' => $request->input('day_night'),
            'price' => $request->input('price'),
            'note' => $request->input('note'),
        ]);

        return response([
            'tour' => $tour
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
        $tour = Tour::find($id);
        $tour->delete();

        return response([
            'result' => 'success'
        ], 200);
    }
}
