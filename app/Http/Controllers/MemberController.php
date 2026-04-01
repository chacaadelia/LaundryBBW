<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = Member::with('customer')
            ->when($request->search, function ($query, $search) {
                $query->whereHas('customer', function ($q) use ($search) {
                    $q->where('nama_pelanggan', 'like', "%{$search}%")
                      ->orWhere('no_telepon', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('member.index', compact('members'));
    }

    public function create()
    {
        $customers = Customer::orderBy('nama_pelanggan')->get();

        return view('member.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => [
                'required',
                'exists:customers,id',
                'unique:members,customer_id'
            ]
        ], [
            'customer_id.unique' => 'Customer ini sudah menjadi member.'
        ]);

        Member::create($data);

        return redirect()->route('member.index')
            ->with('success', 'Customer berhasil dijadikan member.');
    }

    public function edit(Member $member)
    {
        $customers = Customer::orderBy('nama_pelanggan')->get();

        return view('member.edit', compact('member', 'customers'));
    }

    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            'customer_id' => [
                'required',
                'exists:customers,id',
                'unique:members,customer_id,' . $member->id
            ]
        ], [
            'customer_id.unique' => 'Customer ini sudah menjadi member.'
        ]);

        $member->update($data);

        return redirect()->route('member.index')
            ->with('success', 'Data member berhasil diperbarui.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('member.index')
            ->with('success', 'Data member berhasil dihapus.');
    }

    public function cetakPdf()
    {
        $members = Member::with('customer')
            ->orderByDesc('created_at')
            ->get();

        $pdf = Pdf::loadView('member.pdf', compact('members'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-data-member.pdf');
    }
}