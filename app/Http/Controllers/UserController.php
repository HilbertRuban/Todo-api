<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signin(Request $request)
    {
            $validated  = $request->all();

            if(!empty($validated)){
                $user = User::where('email', $request->email)->first();
                
                if($user !== null && Hash::check($request->password,$user->password)) {
                    return response()->json([
                        'message' => 'Logged in successfully',
                    ]);
                }else{  
                    return response()->json([
                        'message' => 'Incorrect email or password',
                    ]);
                }
            }else{
                dump('no way');
                return response(['Message'=>'error'], 400);
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signUp(Request $request)
    {

        try {
            $validated  = $request->all();

            if(!empty($validated)){

                $existingEmail = User::Where('email', $request->email)->first();
                if($existingEmail === null) {
                    $newUser = new User();
                    $newUser->name = $request->username;
                    $newUser->email = $request->email;
                    $newUser->email_verified_at = $request->verified;
                    $newUser->password = Hash::make($request->password);
                    $newUser->save();

                    return response(['Message'=>'Registered successfully'], 200);
                }else {
                    return response(['Message'=>'User already registered please sign in'], 200);
                }


            }else{
                return response(['Message'=>'error'], 400);
            }
        }catch(Exception $error) {
            return $error->getMessage();
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
        //
    }
}
