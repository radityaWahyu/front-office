<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\UserInterface;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use Hash;

class UserController extends Controller
{

    protected $table;

    public function __construct(UserInterface $tableInterface)
    {
        $this->table = $tableInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = new \stdClass;

        if($request->has('search')) {
            if(!empty($request->search)){
                $query->search = array('field' => 'name', 'value' => $request->search);
            }
        }

        if($request->has('sort')){
            if(!empty($request->sort)){
                $sortData = explode('-', $request->sort);
                $query->order = array('field' => $sortData[0], 'value' => $sortData[1]);
            }
        }

        if($request->has('per_page')) {
            $query->limit = array('value' => $request->per_page);
        }

        $query->paginate = true;

        return UserResource::collection($this->table->get($query, array('*')));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $row = $this->table->create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'departement_id' => $request->role =='superuser' ? null : $request->departement,
        ]);

        return response()->json($row);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if(isset($request->id)){
            if(!empty($request->id)){
                $row = $this->table->find($request->id);

                return response()->json([
                    'status' => $row['status'],
                    'message' => $row['message'],
                    'data' => $row['data'] != null ? new UserResource($row['data']) : null
                ]);
            }
        }

        return response()->json([
            "status" => 'fail',
            "message" => 'you must set parameter id'
        ], 404);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {

        $fieldData = [
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
            'email' => $request->email,
            'departement_id' => $request->role =='superuser' ? null : $request->departement,
        ];

        if(!empty($request->password)){
            $fieldData += array('password' => Hash::make($request->password));
        }

        $row = $this->table->update($id, $fieldData);

        return response()->json($row);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $row = $this->table->delete($request->id);

        return response()->json($row);

    }
}
