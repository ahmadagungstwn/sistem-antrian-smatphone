<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    // Tampilkan semua antrian
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('buyer')) {
            $services = $user->service()->orderBy('id', 'desc')->get();
        } else {
            $services = Service::orderBy('id', 'desc')->get();
        }
        return view('services.index', compact('services'));
    }

    // Tampilkan detail service
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    // Form tambah service baru
    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_type' => 'required|string|max:255',
            'damage_description' => 'required|string',
        ]);

        $service = Service::create([
            'queue_number' => Service::max('queue_number') + 1, // nomor antrian berikutnya
            'customer_name' => $request->customer_name,
            'phone_type' => $request->phone_type,
            'damage_description' => $request->damage_description,
            'repair_costs' => null, // belum ada biaya
            'notes' => null,
            'attachment' => null,
            'user_id' => Auth::id(), // otomatis terhubung ke buyer
            'status_confirmation' => 'Menunggu Konfirmasi',
            'status_repair' => 'Menunggu Antrian',
        ]);

        return redirect()->route('services.index')->with('success', 'Antrian berhasil dibuat.');
    }

    // Update status service
    public function update(Request $request, Service $service)
    {
        $action = $request->input('action');

        switch ($action) {
            case 'Diterima':
                $service->update([
                    'status_confirmation' => 'Diterima',
                    'status_repair' => 'Menunggu Antrian',
                    'rejection_notes' => null
                ]);
                break;

            case 'Ditolak':
                $request->validate([
                    'rejection_notes' => 'required|string',
                ]);
                $service->update([
                    'status_confirmation' => 'Ditolak',
                    'rejection_notes' => $request->rejection_notes
                ]);
                break;

            case 'Mulai Perbaikan':
                $service->update([
                    'status_repair' => 'Proses Perbaikan'
                ]);
                break;

            case 'Selesai Perbaikan':
                $service->update([
                    'status_repair' => 'Selesai',
                    'status_confirmation' => 'Diterima'
                ]);
                break;
        }

        return back()->with('success', 'Status berhasil diperbarui.');
    }

    public function updateCost(Request $request, Service $service)
    {
        $request->validate([
            'repair_costs' => 'required|integer|min:0',
        ]);

        $service->update([
            'repair_costs' => $request->repair_costs,
        ]);

        return back()->with('success', 'Biaya perbaikan berhasil diperbarui.');
    }

    public function uploadNota(Request $request, Service $service)
    {
        $request->validate([
            'attachment' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $file = $request->file('attachment')->store('attachments', 'public');

        $service->update(['attachment' => $file]);

        return back()->with('success', 'Nota berhasil diupload.');
    }
}
