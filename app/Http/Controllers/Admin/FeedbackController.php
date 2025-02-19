<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Carbon\Carbon;

class FeedbackController extends Controller
{
    public function index()
{
    // Menghitung jumlah feedback yang masuk hari ini
    $feedbackToday = Feedback::whereDate('created_at', Carbon::today())->count();

    // Menghitung total semua feedback yang masuk
    $feedbackCount = Feedback::count();

    return view('admin.layouts.template', [
        'feedbackToday' => $feedbackToday,
        'feedbackCount' => $feedbackCount
    ]);

}

}
