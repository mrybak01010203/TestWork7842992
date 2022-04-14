<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProjectResource;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();
        return response([ 'members' => ProjectResource::collection($members), 'message' => 'Retrieved successfully'], 200);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'fname' => 'required|max:100',
            'lname' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $member = Member::create($data);

        return response(['member' => new ProjectResource($member), 'message' => 'Created successfully'], 201);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return response(['member' => new ProjectResource($member), 'message' => 'Retrieved successfully'], 200);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $member->update($request->all());

        return response(['member' => new ProjectResource($member), 'message' => 'Update successfully'], 200);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return response(['message' => 'Deleted']);
    }
    
    /**
     * select records from members with many project filter and order by columns .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function findmembs (Request $request)
    
    //http://tz1laravel.my/api/findmembs
    {
        $fname=$request->get('fname',''); // first name
        $lname=$request->get('lname','');// last name
        $pname=$request->get('pname','');// project name
        $plang=$request->get('plang','');// project Language
        $mrole=$request->get('mrole','');// role user in project
        $outorder=$request->get('outorder','fname ASC, lname DESC'); // order records
        
        $arrwhereproject= array();
        if ($plang!=null) {$arrwhereproject[]=['lang', '=', $plang];};
        if ($mrole!=null) {$arrwhereproject[]=['role', '=', $mrole];};
        if ($pname!=null) {$arrwhereproject[]=['name', 'like', '%'.$pname.'%'];};
        $arrweremember= array();
        if ($fname!=null) {$arrweremember[]=['fname', '=', $fname];};
        if ($lname!=null) {$arrweremember[]=['lname', '=', $lname];};
        $callback = function($query) use ($arrwhereproject) {
            $query->where($arrwhereproject);
            };
        $members = Member::whereHas('projects', $callback)
                 ->with(['projects' => $callback])
                 ->where($arrweremember)
                 ->orderByRaw($outorder)
                 ->get();
        return response(['project' => new ProjectResource($members), 'message' => 'Retrieved successfully'], 200);
    }
}
