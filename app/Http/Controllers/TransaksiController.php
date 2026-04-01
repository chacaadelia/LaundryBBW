<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Member;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        $transaksis = Transaksi::with(['customer', 'service'])
            ->latest()
            ->paginate(10);

        return view('transaksi.index', compact('transaksis'));
    }

    // ================= CREATE =================
    public function create()
    {
        $customers = Customer::orderBy('nama_pelanggan')->get();
        $services  = Service::all();

        return view('transaksi.create', compact('customers', 'services'));
    }

    // ================= HITUNG TOTAL =================
    private function calculateTotal($customer, $service, $berat)
    {
        $subtotal = $service->harga_per_kg * $berat;

        $diskon = ($customer && $customer->member)
            ? $subtotal * 0.10
            : 0;

        $total = $subtotal - $diskon;

        return [
            'subtotal' => $subtotal,
            'diskon'   => $diskon,
            'total'    => $total,
        ];
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        // ================= VALIDASI =================
        $request->validate([
            'customer_id'    => 'nullable|exists:customers,id',

            'nama_pelanggan' => 'required_without:customer_id|string|nullable',
            'nomor_telepon'  => 'required_without:customer_id|string|nullable',
            'alamat'         => 'required_without:customer_id|string|nullable',

            'service_id'     => 'required|exists:services,id',
            'berat'          => 'required|numeric|min:0.1',
            'status'         => 'required|string',
            'tanggal'        => 'required|date',
        ]);

        // ================= CUSTOMER LOGIC =================
        if ($request->customer_id) {

            // CUSTOMER LAMA
            $customer = Customer::with('member')
                ->findOrFail($request->customer_id);

        } else {

            // VALIDASI CUSTOMER BARU
            if (!$request->nama_pelanggan || !$request->nomor_telepon) {
                return back()->withErrors([
                    'nama_pelanggan' => 'Nama & nomor telepon wajib diisi untuk customer baru'
                ])->withInput();
            }

            // CREATE CUSTOMER BARU
            $customer = Customer::create([
                'nama_pelanggan' => $request->nama_pelanggan,
                'nomor_telepon'  => $request->nomor_telepon,
                'alamat'         => $request->alamat,
            ]);

            // ================= MEMBER OPTIONAL =================
            if ($request->has('is_member')) {
                Member::create([
                    'customer_id'    => $customer->id,
                    'tanggal_daftar' => now(),
                ]);

                $customer->load('member');
            }
        }

        // ================= SERVICE =================
        $service = Service::findOrFail($request->service_id);

        // ================= PERHITUNGAN =================
        $calc = $this->calculateTotal(
            $customer,
            $service,
            $request->berat
        );

        // ================= SIMPAN TRANSAKSI =================
        $transaksi = Transaksi::create([
            'customer_id'  => $customer->id,
            'service_id'   => $service->id,
            'harga_per_kg' => $service->harga_per_kg,
            'berat'        => $request->berat,
            'subtotal'     => $calc['subtotal'],
            'diskon'       => $calc['diskon'],
            'total_harga'  => $calc['total'],
            'status'       => $request->status,
            'tanggal'      => $request->tanggal,
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dibuat');
    }

    // ================= EDIT =================
    public function edit(Transaksi $transaksi)
    {
        $customers = Customer::orderBy('nama_pelanggan')->get();
        $services  = Service::all();

        return view('transaksi.edit', compact('transaksi', 'customers', 'services'));
    }

    // ================= UPDATE =================
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id'  => 'required|exists:services,id',
            'berat'       => 'required|numeric|min:0.1',
            'status'      => 'required|string',
            'tanggal'     => 'required|date',
        ]);

        $customer = Customer::with('member')
            ->findOrFail($request->customer_id);

        $service = Service::findOrFail($request->service_id);

        $calc = $this->calculateTotal($customer, $service, $request->berat);

        $transaksi->update([
            'customer_id'  => $customer->id,
            'service_id'   => $service->id,
            'harga_per_kg' => $service->harga_per_kg,
            'berat'        => $request->berat,
            'subtotal'     => $calc['subtotal'],
            'diskon'       => $calc['diskon'],
            'total_harga'  => $calc['total'],
            'status'       => $request->status,
            'tanggal'      => $request->tanggal,
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui');
    }

    // ================= STRUK =================
    public function struk($id)
    {
        $transaksi = Transaksi::with(['customer', 'service'])
            ->findOrFail($id);

        return view('transaksi.struk', compact('transaksi'));
    }

    // ================= DELETE =================
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }
}