<?php

namespace App\Http\Controllers;

use App\Http\Requests\PembinaStoreRequest;
use App\Http\Requests\PembinaUpdateRequest;
use App\Models\User;

class PembinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pembina = User::where('role', 'pembina')->paginate(10);
        return view('admin.pembina.index', [
            'title' => 'Pembina',
            'pembina' => $pembina
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.pembina.create', [
            'title' => 'Tambah Pembina'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PembinaStoreRequest $request)
    {
        //
        $request->merge([
            'password' => bcrypt($request->password)
        ]);
        User::create($request->validated());
        return redirect()->route('pembina.index')->with('toast', [
            'type' => 'success',
            'message' => 'Pembina berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $pembina = User::find($id);
        return view('admin.pembina.show', [
            'title' => 'Detail Pembina',
            'pembina' => $pembina
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $pembina = User::find($id);
        return view('admin.pembina.edit', [
            'title' => 'Edit Pembina',
            'pembina' => $pembina
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PembinaUpdateRequest $request, string $id)
    {
        //
        $data = $request->validated();
        if($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        else {
            unset($data['password']);
        }
        User::find($id)->update($data);
        return redirect()->route('pembina.index')->with('toast', [
            'type' => 'success',
            'message' => 'Pembina berhasil diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        User::find($id)->delete();
        return redirect()->route('pembina.index')->with('toast', [
            'type' => 'success',
            'message' => 'Pembina berhasil dihapus'
        ]);
    }
}
