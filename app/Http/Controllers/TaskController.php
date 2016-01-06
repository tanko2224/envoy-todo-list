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

    /**
     * Gets all trashed tasks
     *
     * @return \Illuminate\Http\Response
     */
    public function getTrashed(){
        return response()->json(Task::onlyTrashed()->with('user','category')->get());
    }

    /**
     * Restore a task
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreTask($id){
        $arrRet = array('success' => false);

        if(Task::withTrashed()->find($id)->restore()){
            $arrRet['success'] = true;
        }

        return response()->json($arrRet);
    }

    /**
     * Permanently delete a task
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permDelete($id){
        $arrRet = array('success' => true);

        Task::withTrashed()->find($id)->forceDelete();


        return response()->json($arrRet);
    }
}
