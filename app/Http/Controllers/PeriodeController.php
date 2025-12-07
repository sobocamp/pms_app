<?php

namespace App\Http\Controllers;

use App\Models\RegistrationPeriod;
use App\Http\Requests\PeriodeRequest;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $periode = RegistrationPeriod::paginate(10);
        return view('admin.periode.index', [
            'title' => 'Periode Pendaftaran',
            'periode' => $periode
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.periode.create', [
            'title' => 'Tambah Periode Pendaftaran'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PeriodeRequest $request)
    {
        //
        if ($request->is_active) {
            RegistrationPeriod::where('is_active', true)->update(['is_active' => false]);
        }
        RegistrationPeriod::create($request->validated());
        return redirect()->route('periode.index')->with('toast', [
            'type' => 'success',
            'message' => 'Periode pendaftaran berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $periode = RegistrationPeriod::find($id);
        return view('admin.periode.show', [
            'title' => 'Detail Periode Pendaftaran',
            'periode' => $periode
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $periode = RegistrationPeriod::find($id);
        return view('admin.periode.edit', [
            'title' => 'Edit Periode Pendaftaran',
            'periode' => $periode
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PeriodeRequest $request, string $id)
    {
        //
        if ($request->is_active) {
            RegistrationPeriod::where('is_active', true)->update(['is_active' => false]);
        }
        $periode = RegistrationPeriod::find($id);
        $periode->update($request->validated());
        return redirect()->route('periode.index')->with('toast', [
            'type' => 'success',
            'message' => 'Periode pendaftaran berhasil diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        RegistrationPeriod::find($id)->delete();
        return redirect()->route('periode.index')->with('toast', [
            'type' => 'success',
            'message' => 'Periode pendaftaran berhasil dihapus'
        ]);
    }
}
