<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with(['user.ownedStore', 'catalogTemplate.category'])->latest()->paginate(20);

        return view('admin-main.pages.manajemen-pembayaran.index', compact('payments'));
    }
}
