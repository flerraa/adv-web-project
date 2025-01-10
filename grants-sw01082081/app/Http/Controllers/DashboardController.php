<?php

namespace App\Http\Controllers;

use App\Models\Grant;
use App\Models\Academician;
use App\Models\Milestone;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get counts for summary cards
        $activeGrantsCount = Grant::whereRaw('DATE_ADD(start_date, INTERVAL duration_months MONTH) > NOW()')
            ->count();
        $academiciansCount = Academician::count();
        $pendingMilestonesCount = Milestone::where('status', '!=', 'Completed')->count();
        $totalGrantAmount = Grant::sum('amount');

        // Get upcoming milestones
        $upcomingMilestones = Milestone::with('grant')
            ->where('status', '!=', 'Completed')
            ->where('target_date', '>=', now())
            ->orderBy('target_date')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'activeGrantsCount',
            'academiciansCount',
            'pendingMilestonesCount',
            'totalGrantAmount',
            'upcomingMilestones'
        ));
    }
}