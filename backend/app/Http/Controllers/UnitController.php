<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use App\Http\Requests\UnitRequest;
use App\Http\Resources\UnitResource;
use App\Interfaces\UnitInterface;


class UnitController extends Controller
{
    protected $table;

    public function __construct(UnitInterface $tableInterface)
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

        return UnitResource::collection($this->table->get($query, array('*')));
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitRequest $request)
    {
        $row = $this->table->create([
            'name' => $request->name
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
                    'data' => $row['data'] != null ? new UnitResource($row['data']) : null
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
    public function update(UnitRequest $request, $id)
    {
        $row = $this->table->update($id, [
            'name' => $request->name
        ]);

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

    public function list()
    {
        $query = new \stdClass;
        $query->get = true;

        $data = $this->table->get($query, array('id', 'name'));

        if(!empty($data)) {
            return response()->json([
                "status" => true,
                "message" => 'found_row',
                "data" => $data 
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => 'not_found',
                "data" => null 
            ]);
        }
        
    }

}
