<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            return view('organization.index', [
            'title' => 'organization',
            'organizations' => Organization::query()->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('organization.create', [
            'title' => 'Create Organizations',
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|max:255',
        'leader_name' => 'required|max:255',
        
    ],[
    'name.required' => 'Nama organisasi wajib diisi', 
    'name.max' => 'Nama organisasi tidak boleh lebih dari :max karakter',
    'leader_name.required' => 'Nama pimpinan wajib diisi', 
    'leader_name.max' => 'Nama pimpinan tidak boleh lebih dari :max karakter',
        

    ]);

    try {
        DB::beginTransaction();
        $organization = Organization::create($validated);
        $organization ->organizationLeader()->create($validated);
        DB::commit();
        return to_route('organization.index')->withSuccess('Data berhasil ditambahkan');

    }catch (\Exception $e) {
        DB::rollBack();
        return to_route('organization.create')->withError('Data gagal ditambahkan');
    }

    
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
        public function edit(Organization $organization)
    {
            return view('organization.edit', [
            'title' => 'Edit Organizations',
            'organization' => $organization
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organization $organization)
    {
        $validated = $request->validate([
        'name' => 'required|max:255',
        'leader_name' => 'required|max:255',
        
    ],[
    'name.required' => 'Nama organisasiwajib diisi', 
    'name.max' => 'Nama organisasi tidak boleh lebih dari :max karakter',
    'leader_name.required' => 'Nama pimpinan wajib diisi', 
    'leader_name.max' => 'Nama pimpinan tidak boleh lebih dari :max karakter',
        

    ]);

    try {
        DB::beginTransaction();
        $organization->update($validated);
        $organization ->organizationLeader()->updateOrcreate(
            ['organization_id' => $organization->id],
            ['leader_name' => $validated['leader_name']]
        );
        DB::commit();
        return to_route('organization.index')->withSuccess('Data berhasil diperbarui');

    }catch (\Exception $e) {
        DB::rollBack();
        return to_route('organization.edit', $organization)->withError('Data gagal diperbarui');
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization)
    {
        
        $organization->delete($organization);
        return to_route('organization.index')->withSuccess('Data berhasil dihapus');
    }
}
