<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('department.index', [
            'title' => 'Department',
            'departments' => Department::query()->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('department.create', ['title' => 'Create Department']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|max:255',
        'nim' => 'required|digits:11|numeric',
    ],[
    'name.required' => 'Nama wajib diisi', 
    'name.max' => 'Nama tidak boleh lebih dari :max karakter',
    'nim.required' => 'Nim tidak boleh kosong',
    'nim.digits' => 'Nim wajib :max 11 digit',
    'nim.numeric' => 'Nim harus berupa angka',

    ]);

    Department::create($validated);
    return to_route('department.index')->withSuccess('Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
            return view('department.show', [
            'title' => ' Detail Department',
            'department' => $department, 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
            return view('department.edit', [
            'title' => 'Edit Department',
            'department' =>  $department,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
        'name' => 'required|max:255',
        'nim' => 'required|digits:11|numeric',
    ],[
    'name.required' => 'Nama wajib diisi', 
    'name.max' => 'Nama tidak boleh lebih dari :max karakter',
    'nim.required' => 'Nim tidak boleh kosong',
    'nim.digits' => 'Nim wajib :max 11 digit',
    'nim.numeric' => 'Nim harus berupa angka',

    ]);

    $department->update($validated);
    return to_route('department.index')->withSuccess('Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete($department);
        return to_route('department.index')->withSuccess('Data berhasil dihapus');
    }
}
