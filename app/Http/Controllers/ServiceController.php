<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Filter search
        $services = Service::query()
            ->when($request->search, function ($query, $search) {
                $query->where('nama_layanan', 'like', "%{$search}%")
                      ->orWhere('harga_per_kg', 'like', "%{$search}%");
            })
            ->paginate(10); 

        return view('service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validasi sekaligus simpan hasilnya ke variabel $data
        $data = $request->validate([
            'nama_layanan'       => 'required|string|max:255',
            'harga_per_kg'       => 'required|numeric|min:0',
            'estimasi_hari'      => 'required|string|max:50',
        ]);

        // Simpan data langsung (tanpa perlu definisikan satu-satu)
        Service::create($data);

        return redirect()->route('service.index')->with('success', 'Data service berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
       return view('service.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(service $service)
    {
         return view('service.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, service $service)
    {
         // Validasi data
        $data = $request->validate([
            'nama_layanan'       => 'required|string|max:255',
            'harga_per_kg'       => 'required|numeric|min:0',
            'estimasi_hari'      => 'required|string|max:50',
        ]);

        // Update data langsung
        $service->update($data);

        return redirect()->route('service.index')->with('success', 'Data service berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
         $service->delete();

        return redirect()->route('service.index')->with('success', 'Data service berhasil dihapus.');
    }
    public function cetakPdf()
    {
        // 1. Ambil semua data service
        $services = Service::all();

        // 2. Load view khusus untuk PDF dan kirim datanya
        // Kita set ukuran kertas A4 dan orientasi landscape agar tabel muat
        $pdf = Pdf::loadView('service.pdf', compact('services'))
                  ->setPaper('a4', 'landscape');

        // 3. Stream pdf ke browser (agar bisa dipreview dulu sebelum download)
        return $pdf->stream('laporan-data-service.pdf');
    }
}

