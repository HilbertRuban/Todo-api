<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allTask = Task::all();
        return response()->json([
            "data" => [
                "tasks" => $allTask
            ]
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userTask = new Task();
        $userTask->task_post = $request->task_input;
        $userTask->user_id = $request->user_id;
        $userTask->save();

        return response()->json([
            "data" => [
                "details" => $userTask
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $userId)
    {

        $userTask = Task::Where('user_id',$userId)->get();

        if($userTask === null) {
            return response()->json([
                'message' => 'Task not found'
            ]);
        }else{
            return response()->json([
                'data' => $userTask
            ]);
        };
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function updateTask(Request $request)
    {
        $data = $request->all();
        // dd($data['taskData']);
        $taskId = $data['taskData']['id'];
        $updateTask = $data['taskData']['task'];
        // dd($updateTask);
        $taskUpdated = Task::where('id', $taskId)
                ->update([
                    'task_post' => $updateTask
                ]);

        if($taskUpdated === null) {
            return response()->json([
                'message' => 'updating error',
            ]);
        }else {
            return response()->json([
                'message' => 'successfully updated',
                'task_updated' => $taskUpdated
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Task $task, Request $request, $taskId)
    // {
    //     dd("hi");
    // }

    public function delete(Request $request) {
        if($request->id === []) {
            return response()->json([
                'message' => 'empty id'
            ]);
        }else {
        Task::whereIn('id', $request->id)->delete();
        return response()->json([
            'message' => 'successfully deleted'
        ]);
        }
        
    }
}
