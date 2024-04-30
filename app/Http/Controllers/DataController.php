<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\Stok;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function index(Request $request)
    {   
        // Ambil tanggal dari request
        $tanggal = $request->input('tanggal');

        // Query data berdasarkan tanggal jika tanggal tersedia
        if ($tanggal) {
            $detail_transaksi = DetailTransaksi::whereDate('created_at', $tanggal)->get();
        } else {
            // Jika tanggal tidak tersedia, ambil semua data
            $detail_transaksi = DetailTransaksi::get();
        }

         // Mendapatkan jumlah menu
        $count_menu = Menu::count();

        // Menampilkan sisa stok stok yang tersedia
        $sisaStok = Stok::sum('jumlah');

        // Menghitung jumlah pesanan untuk setiap menu top 5
        $menu_counts = DetailTransaksi::select('menu_id', DB::raw('SUM(jumlah) as total_qty'))
        ->groupBy('menu_id')
        ->orderByDesc('total_qty')
        ->limit(5)
        ->get();

        // Menyimpan hasil dalam array
        $most_ordered_menu = [];
        foreach ($menu_counts as $menu_count) {
            $menu = Menu::find($menu_count->menu_id);
            $most_ordered_menu[$menu->nama_menu] = $menu_count->total_qty;
        }

        // Mendapatkan jumlah transaksi
        $count_transaksi = Transaksi::count();

        // Mendapatkan data pelanggan
        $pelanggan = Pelanggan::orderByDesc('created_at')->limit(10)->get();

        // Mendapatkan pendapatan
        $pendapatan = DetailTransaksi::sum('subtotal');

        // Mendapatkan stok terendah
        $stokTerendah = Stok::orderBy('jumlah')->limit(5)->get();

        // Mendapatkan pendapatan per tanggal
        $pendapatan_per_tanggal = DetailTransaksi::select(
            DB::raw('DATE(created_at) as tanggal'),
            DB::raw('SUM(subtotal) as total_pendapatan')
        )
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        // Mendapatkan transaksi terbaru
        $latest_transactions = DetailTransaksi::latest()->limit(5)->get();

        //Filter data
        // $pendapatan_per_tanggal_query = DetailTransaksi::select(
        //     DB::raw('DATE(created_at) as tanggal'),
        //     DB::raw('SUM(subtotal) as total_pendapatan')
        // )
        //     ->groupBy('tanggal')
        //     ->orderBy('tanggal');

        // $tanggal_awal = $request->input('tanggal_awal');
        // $tanggal_akhir = $request->input('tanggal_akhir');

        // if ($tanggal_awal && $tanggal_akhir) {
        //     // Filter data pendapatan per tanggal
        //     $pendapatan_per_tanggal_query->whereBetween('created_at', [$tanggal_awal, $tanggal_akhir]);
        
        //     // Menghitung total pendapatan
        //     $pendapatan = DetailTransaksi::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->sum('subtotal');
        
        //     // Menghitung jumlah menu
        //     $count_menu = Menu::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->count();
        
        //     // Menghitung jumlah transaksi
        //     $count_transaksi = Transaksi::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->count();
        
        //     // Mengambil data sisa stok
        //     $sisaStok = Stok::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->sum('jumlah');
        // }

        // Mengirim data ke view
        return view('template.data', compact(
            'count_menu',
            'most_ordered_menu',
            'count_transaksi',
            'pelanggan',
            'pendapatan',
            'stokTerendah',
            'sisaStok',
            'pendapatan_per_tanggal',
            'latest_transactions'
        ));
    }

}