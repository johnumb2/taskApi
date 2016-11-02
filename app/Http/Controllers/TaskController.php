<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('category', 'desc')
            ->orderBy('order', 'asc')
            ->get();

        return response($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task;

        $task->name = $request->name;
        $task->description = $request->description;
        $task->order = $request->order;
        $task->category = $request->category;;

        if($task->save()) {
            return response(array('success' => true, 'id' => $task->id), 200);
        }
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
        $task = Task::find($id);

        if (isset($request->name)) {
            $task->name = $request->name;
        }

        if (isset($request->description)) {
            $task->description = $request->description;
        }

        if (isset($request->order)) {
            $task->order = $request->order;
        }

        if (isset($request->category)) {
            $task->category = $request->category;
        }

        if($task->save()) {
            return response(array('success' => true), 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        if($task->delete()) {
            return response(array('success' => true, 'id' => $task->id), 200);
        }
    }
}
