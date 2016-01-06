<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Task::with('user','category')->get());
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
    public function store(Request $request)
    {
        //
        $arrRet = array('success' => false);

        if(empty($request->get('title'))){
            $arrRet['errors'][] = "The title cannot be empty.";
        }
        if(empty($request->get('description'))){
            $arrRet['errors'][] = "The description cannot be empty.";
        }
        if(empty($request->get('categoryId'))){
            $arrRet['errors'][] = "Please select a category.";
        }
        if(empty($request->get('userId'))){
            $arrRet['errors'][] = "Please assign the task to a user.";
        }

        if(empty($arrRet['errors'])){ // We are good no errors
            $task = new Task();
            $created = $task->create([
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'category_id' => $request->get('categoryId'),
                'user_id' => $request->get('userId')
            ]);

            if($created){
                $arrRet['success'] = true;
                $arrRet['task'] = $created;
            }
        }

        return response()->json($arrRet);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TODO: implement a validation for this method
        $arrRet = array("success" => true);

        $task = Task::find($id);
        $task->delete();

        return response()->json($arrRet);
    }
}
