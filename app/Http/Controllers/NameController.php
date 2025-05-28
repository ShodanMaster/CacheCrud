<?php

namespace App\Http\Controllers;

use App\Models\Name;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;

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

            Name::create($request->only('name'));
            Cache::forget('names_data_table');

            return response()->json([
                'status' => 200,
                'message' => 'Name created successfully!'
            ], 200);

        }catch(Exception $e){
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while creating the name: ' . $e->getMessage()
            ], 500);
        }

    }

    public function getNames(Request $request)
    {
        if($request->ajax()){
            // $names = Name::all();
            $cacheKey = 'names_data_table';

            $names = Cache::remember($cacheKey, now()->addMinutes(5), function () {
                return Name::all();
            });

            return DataTables::of($names)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '
                            <button type="button" class="btn btn-info btn-sm editName" data-bs-toggle="modal" data-bs-target="#editModal" data-id="'.$row->id.'" data-name="'.$row->name.'">
                                Edit
                            </button>

                            <button type="button" class="btn btn-danger btn-sm deleteName" data-id="'.$row->id.'">Delete</button>
                        ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Name $name)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $name->update($request->only('name'));
            Cache::forget('names_data_table');

            return response()->json([
                'status' => 200,
                'message' => 'Name updated successfully!'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while updating the name: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Name $name)
    {
        try {
            $name->delete();
            Cache::forget('names_data_table');

            return response()->json([
                'status' => 200,
                'message' => 'Name deleted successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while deleting the name: ' . $e->getMessage()
            ], 500);
        }
    }
}
