<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Extracurricular;
use App\Models\RegistrationPeriod;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EkstrakurikulerRequest;

class EkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extracurriculars = Extracurricular::paginate(10);

        return view('admin.ekstrakurikuler.index', [
            'title' => 'Ekstrakurikuler',
            'extracurriculars' => $extracurriculars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pembina = User::where('role', 'pembina')->get();
        return view('admin.ekstrakurikuler.create', [
            'title' => 'Tambah Ekstrakurikuler',
            'pembina' => $pembina
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EkstrakurikulerRequest $request)
    {
        //
        $extracurricular = Extracurricular::create($request->validated());
        $extracurricular->pembina()->sync($request->pembina_id);

        return redirect()->route('extracurricular.index')->with('toast', [
            'type' => 'success',
            'message' => 'Ekstrakurikuler berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $extracurricular = Extracurricular::find($id);
        $pembina = $extracurricular->pembina;
        return view('admin.ekstrakurikuler.show', [
            'title' => 'Detail Ekstrakurikuler',
            'extracurricular' => $extracurricular,
            'pembina' => $pembina
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $pembina = User::where('role', 'pembina')->get();
        $extracurricular = Extracurricular::find($id);
        return view('admin.ekstrakurikuler.edit', [
            'title' => 'Edit Ekstrakurikuler',
            'pembina' => $pembina,
            'extracurricular' => $extracurricular
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EkstrakurikulerRequest $request, string $id)
    {
        //
        $extracurricular = Extracurricular::find($id);
        $extracurricular->update($request->validated());
        $extracurricular->pembina()->sync($request->pembina_id);

        return redirect()->route('extracurricular.index')->with('toast', [
            'type' => 'success',
            'message' => 'Ekstrakurikuler berhasil diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $extracurricular = Extracurricular::findOrFail($id);

        // hapus relasi pivot
        $extracurricular->pembina()->detach();

        // hapus data utama
        $extracurricular->delete();

        return redirect()->route('extracurricular.index')->with('toast', [
            'type' => 'success',
            'message' => 'Ekstrakurikuler berhasil dihapus'
        ]);
    }

    public function ekstrakurikulerPembina(string $id)
    {
        $extracurriculars = Extracurricular::whereHas('pembina', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->paginate(10);

        // return view('admin.ekstrakurikuler.index', [
        //     'title' => 'Ekstrakurikuler',
        //     'extracurriculars' => $extracurriculars
        // ]);
    }

    public function ekstrakurikulerSiswa(string $id)
    {
        $extracurriculars = Extracurricular::whereHas('registrations', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->paginate(10);

        return view('siswa.ekstrakurikuler.index', [
            'title' => 'Ekstrakurikuler Saya',
            'extracurriculars' => $extracurriculars
        ]);
    }

    public function ekstrakurikulerDetail(string $id)
    {
        $extracurricular = Extracurricular::find($id);
        $registered = $extracurricular->participants->contains('id', Auth::user()->id);
        return view('siswa.ekstrakurikuler.detail', [
            'title' => 'Detail Ekstrakurikuler',
            'extracurricular' => $extracurricular,
            'registered' => $registered
        ]);
    }

    public function register(string $id)
    {
        $extracurricular = Extracurricular::findOrFail($id);
        $user = Auth::user();

        // ambil periode registrasi yang aktif
        $period = RegistrationPeriod::where('is_active', true)->first();

        if (!$period) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Periode registrasi belum dibuka'
            ]);
        }

        // cek apakah user sudah daftar pada periode aktif
        $alreadyJoined = $extracurricular->participants()
            ->where('user_id', $user->id)
            ->where('registration_period_id', $period->id)
            ->exists();

        if ($alreadyJoined) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Anda sudah mendaftar ekstrakurikuler pada periode ini'
            ]);
        }

        // menyimpan ke pivot
        $extracurricular->participants()->attach($user->id, [
            'registration_period_id' => $period->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('extracurricular.detail', $extracurricular->id)->with('toast', [
            'type' => 'success',
            'message' => 'Pendaftaran berhasil'
        ]);
    }

    public function unregister(string $id)
    {
        $extracurricular = Extracurricular::findOrFail($id);
        $user = Auth::user();

        // ambil periode registrasi yang aktif
        $period = RegistrationPeriod::where('is_active', true)->first();

        if (!$period) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Periode registrasi belum dibuka'
            ]);
        }

        // cek apakah user sudah daftar pada periode aktif
        $alreadyJoined = $extracurricular->participants()
            ->where('user_id', $user->id)
            ->where('registration_period_id', $period->id)
            ->exists();

        if (!$alreadyJoined) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Anda belum mendaftar ekstrakurikuler pada periode ini'
            ]);
        }

        // menghapus dari pivot
        $extracurricular->participants()->detach($user->id);

        return redirect()->route('extracurricular.detail', $extracurricular->id)->with('toast', [
            'type' => 'success',
            'message' => 'Pendaftaran berhasil dibatalkan'
        ]);
    }

    public function ekstrakurikulerSemua()
    {
        $extracurriculars = Extracurricular::paginate(10);

        return view('siswa.ekstrakurikuler.list', [
            'title' => 'Semua Ekstrakurikuler',
            'extracurriculars' => $extracurriculars
        ]);
    }
}
