<?php

namespace App\Http\Controllers;

use App\Models\Receipt;

class ReceiptController extends Controller
{
    public function index()
    {
        $receipts = Receipt::with('student', 'payment')->paginate(10);
        return view('admin.receipts.index', compact('receipts'));
    }
}