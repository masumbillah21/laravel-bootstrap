<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return response()->json(['status' => 'success', 'msg' => 'Request Success', 'data' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{

            $validation = $this->validate($request, [
                'role' => 'required|string|max:30',
                'permissions' => 'nullable|array'
            ]);

            Role::create($validation);

            return response()->json(['status' => 'success', 'msg' => 'Role added successfully.']);

        }catch(Exception $e){
            return response()->json(['status' => 'failed', 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
