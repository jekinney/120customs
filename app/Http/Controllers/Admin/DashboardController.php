<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index(Request $request)
    {
        // You can fetch dashboard data here
        $stats = [
            'total_users' => 1234, // Replace with actual data
            'total_orders' => 567,
            'revenue' => 89432,
            'pending_orders' => 23,
        ];

        $recent_orders = [
            // Replace with actual recent orders data
            [
                'id' => '001',
                'title' => 'Custom Exhaust System',
                'customer' => 'John Doe',
                'amount' => 1250,
                'status' => 'Completed'
            ],
            [
                'id' => '002',
                'title' => 'Performance Tune',
                'customer' => 'Jane Smith',
                'amount' => 850,
                'status' => 'In Progress'
            ],
            [
                'id' => '003',
                'title' => 'Turbo Installation',
                'customer' => 'Mike Johnson',
                'amount' => 2100,
                'status' => 'Pending'
            ],
        ];

        return view('admin.dashboard', compact('stats', 'recent_orders'));
    }
}
