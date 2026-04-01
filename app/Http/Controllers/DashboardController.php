<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomer = Customer::count();
        $totalService = Service::count();
        $totalTransaksi = Transaksi::count();
        $totalPendapatan = Transaksi::sum('total_harga');

        $transaksiTerbaru = Transaksi::with(['customer','service'])
                        ->latest()
                        ->take(5)
                        ->get();

        return view('dashboard', compact(
         'totalCustomer',
         'totalService',
         'totalTransaksi',
         'totalPendapatan',
         'transaksiTerbaru'
      ));
    }
}