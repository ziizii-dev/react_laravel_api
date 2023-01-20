<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;
use App\Http\Resources\todoResource;
use App\Http\Requests\StoreToDoRequest;
use App\Http\Requests\UpdateToDoRequest;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Todo::
        // select('to_dos.*','user_lists.*')
        //          ->rightJoin('user_lists','user_lists.id','to_dos.user_id')
        //          ->
                 get();
                //  return $data;
                //  $response = todoResource::collection($data);
        return response()->json([
            "error"=>false,
            "message"=>"todo list",
            // "data"=>$response
            "data"=>$data
        ]);
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
     * @param  \App\Http\Requests\StoreToDoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $validator = $request->validate([
            "todo" =>"required|string",
            "user_list_id"=>"required|string",
            "status"=>"required|integer"

        ]);
       $data = ToDo::create($validator);
        return response()->json([
            "error"=>false,
            "message"=>"create success",
            "data"=>$data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function show(ToDo $toDo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function edit(ToDo $toDo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateToDoRequest  $request
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            "todo"=>$request->todo,
            "user_list_id"=>$request->user_id,
            "status"=>$request->status
        ];
        $update = ToDo::where('id',$id)->first();
        // return $update;
        if(isset($update)){
            $response = ToDo::where('id',$id)->update($data);
            return response()->json([
                "error"=>false,
                "message"=>"update success",
                "data"=>$response
               ]);
        }
        return response()->json([
            "error"=>false,
            "message"=>"there is no data",
            "data"=>$update
           ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = ToDo::where([
            ['status','=',1],
            ['id','=',$id]

           ])->first();
        // return $data;
        if(isset($data)){
           $response= ToDo::where([
            ['status','=',1],
            ['id','=',$id]

           ])->delete();
            // return $response;
            return response()->json([
                "error"=>false,
                "message"=>"delete success",
                "data"=>$response
               ],200);
        }
        return response()->json([
            "error"=>true,
            "message"=>"There is no data",
            "data"=>$data
           ],200);
    }
}
