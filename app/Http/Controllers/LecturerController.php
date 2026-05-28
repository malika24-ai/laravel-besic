<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use App\Models\Department;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $lecturers = Lecturer::query()->latest()->filter(request(['keyword', 'department_id']));

        return view('lecturer.index', [
            'title' => 'Lecturer',
            'departments' => Department::query()->latest()->get(),
            'lecturers' => $lecturers->latest()->paginate(5)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lecturer.create', [
            'title' => 'Create Lecturer',
            'departments' => Department::query()->latest()->get(),
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|max:255',
        'department_id' => 'required|exists:departments,id',
    ],[
    'name.required' => 'Nama wajib diisi', 
    'name.max' => 'Nama tidak boleh lebih dari :max karakter',
    'department_id.required' => 'Program studi wajib dipilih',
    'department_id.exists' => 'Program studi yang di pilih tidak di temukan',


    ]);

    Lecturer::create($validated);
    return to_route('lecturer.index')->withSuccess('Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lecturer $lecturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lecturer $lecturer)
    {
            return view('lecturer.edit', [
            'title' => 'Edit Lecturer',
            'departments' => Department::query()->latest()->get(),
            'lecturer' => $lecturer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lecturer $lecturer)
    {
        $validated = $request->validate([
        'name' => 'required|max:255',
        'department_id' => 'required|exists:departments,id',
    ],[
    'name.required' => 'Nama wajib diisi', 
    'name.max' => 'Nama tidak boleh lebih dari :max karakter',
    'department_id.required' => 'Program studi wajib dipilih',
    'department_id.exists' => 'Program studi yang di pilih tidak di temukan',


    ]);

    $lecturer->update($validated);
    return to_route('lecturer.index')->withSuccess('Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete($lecturer);
        return to_route('lecturer.index')->withSuccess('Data berhasil dihapus');
    }
}
