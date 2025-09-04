<?php

namespace App\Http\Controllers;

use App\Models\UserStore;
use Illuminate\Http\Request;

class ManajemenTokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = UserStore::with('user')->latest()->paginate(15);
        $centralDomain = config('tenancy.central_domains')[0] ?? request()->getHost();

        return view('admin-main.pages.manajemen-toko.index', compact('stores', 'centralDomain'));
    }

    /**
     * Toggle the active status of the specified resource.
     */
    public function toggleStatus(UserStore $userStore)
    {
        $userStore->update([
            'is_active' => !$userStore->is_active,
        ]);

        return back()->with('success', 'Status toko berhasil diubah.');
    }
}
