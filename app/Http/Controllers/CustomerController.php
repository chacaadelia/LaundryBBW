<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{
    /**
     * LIST CUSTOMER
     */
    public function index(Request $request)
    {
        $customers = Customer::with('member')
            ->when($request->search, function ($query, $search) {
                $query->where('nama_pelanggan', 'like', "%{$search}%")
                    ->orWhere('nomor_telepon', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('customer.index', compact('customers'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * STORE CUSTOMER (NON-AJAX)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'nomor_telepon'  => 'nullable|string|max:20|unique:customers,nomor_telepon',
            'alamat'         => 'required|string|max:255',
        ]);

        Customer::create($data);

        return redirect()->route('customer.index')
            ->with('success', 'Customer berhasil ditambahkan');
    }

    /**
     * SHOW DETAIL
     */
    public function show(Customer $customer)
    {
        $customer->load('member', 'transaksis');

        return view('customer.show', compact('customer'));
    }

    /**
     * EDIT
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'nomor_telepon'  => 'nullable|string|max:20|unique:customers,nomor_telepon,' . $customer->id,
            'alamat'         => 'required|string|max:255',
        ]);

        $customer->update($data);

        return redirect()->route('customer.index')
            ->with('success', 'Customer berhasil diperbarui');
    }

    /**
     * DELETE
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customer.index')
            ->with('success', 'Customer berhasil dihapus');
    }

    /**
     * EXPORT PDF
     */
    public function cetakPdf()
    {
        $customers = Customer::with('member')->get();

        $pdf = Pdf::loadView('customer.pdf', compact('customers'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-customer.pdf');
    }

    /**
     * 🔥 AJAX STORE + OPTIONAL MEMBER
     */
    public function ajaxStore(Request $request)
    {
        $data = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'nomor_telepon'  => 'nullable|string|max:20|unique:customers,nomor_telepon',
            'alamat'         => 'required|string|max:255',
            'is_member'      => 'nullable|boolean',
        ]);

        // 1. CREATE CUSTOMER
        $customer = Customer::create([
            'nama_pelanggan' => $data['nama_pelanggan'],
            'nomor_telepon'  => $data['nomor_telepon'] ?? null,
            'alamat'         => $data['alamat'],
        ]);

        $member = null;

        // 2. CREATE MEMBER JIKA DIPILIH
        if ($request->is_member) {
            $member = Member::create([
                'customer_id' => $customer->id,
                'nama_member' => $customer->nama_pelanggan,
                'no_telepon'  => $customer->nomor_telepon,
            ]);
        }

        return response()->json([
            'id' => $customer->id,
            'nama_pelanggan' => $customer->nama_pelanggan,
            'is_member' => $member ? true : false
        ]);
    }
}