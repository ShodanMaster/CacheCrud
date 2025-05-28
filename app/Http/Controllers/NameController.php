<?php

namespace App\Http\Controllers;

use App\Models\Name;
use Exception;
use Illuminate\Http\Request;

class NameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
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

            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            Name::create($request->all());

            return response()->json([
                'status' => 200,
                'message' => 'Name created successfully!'
            ], 200);

        }catch(Exception $e){

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Name $name)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Name $name)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Name $name)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Name $name)
    {
        //
    }
}
