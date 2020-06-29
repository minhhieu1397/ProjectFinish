<?php

namespace App\Http\Controllers\AdminAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Http\Requests\Admin\Program\CreateProgramRequest;
use App\Http\Requests\Admin\Program\UpdateProgramRequest;
use App\Services\checkJwt;

class ProgramController extends Controller
{
	protected $checkJwt;

    public function __construct(checkJwt $checkJwt)
    {
        $this->checkJwt = $checkJwt;
    }

    public function store(Request $request)
    {
    	$admin = $request->input('admin');
        $jwt = $request->input('jwt');

        if($this->checkJwt->checkJwt($admin, $jwt)) {
	    	Program::create([
	            'tour_id' => $request->input('tour_id'),
	            'title' => $request->input('title'),
	            'day' => $request->input('day'),
	            'detail' => $request->input('detail'),
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

    public function destroy(Request $request, $id)
    {
    	$jwt = $request->input('jwt');
    	$adminCurrent = $request->input('admin');

    	if($this->checkJwt->checkJwt($adminCurrent, $jwt)) {
	    	$program = Program::find($id);
        	$program->delete();

	        return response([
	            'result' => 'success'
	        ], 200);
	    } else {
            return response([
                'auth' => false
            ], 200);
        }
    }

    public function view(Request $request, $id)
    {
    	$jwt = $request->input('jwt');
    	$adminCurrent = $request->input('admin');

    	if($this->checkJwt->checkJwt($adminCurrent, $jwt)) {
    		return Program::where('tour_id', $id)->get();
    	} else {
            return response([
                'auth' => false
            ], 200);
        }
    }

    public function update(UpdateProgramRequest $request, $id)
    {
    	$jwt = $request->input('jwt');
    	$adminCurrent = $request->input('admin');

    	if($this->checkJwt->checkJwt($adminCurrent, $jwt)) {
	    	$program = Program::find($id);

	        $program->update([
	            'title' => $request->input('title'),
	            'day' => $request->input('day'),
	            'detail' => $request->input('detail'),
	        ]);

	        return response([
	            'program' => $program
	        ], 200);
	    } else {
            return response([
                'auth' => false
            ], 200);
        }
    }
}
