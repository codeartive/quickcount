<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = [
        //     'title' => 'Dashboard',
        //     'icon' => 'fas fa-tachometer-alt',
        //     'breadcrumb' => [],
        //     'po_in' => Quotation::getSummaryPerYear()['poIn_result'],
        //     'qo_out' => Quotation::getSummaryPerYear()['result'],
        //     'open_so_list' => SalesOrder::where('status_so','<>',SalesOrder::STATUS_CLOSED)->paginate(5, ['*'], 'so-page'),
        //     'open_invoice_list' => Invoice::where('status_id', '<', Invoice::STATUS_DONE)->paginate(5, ['*'], 'invoice-page'),
        //     'open_pr_list' => PurchaseRequest::where('status_id', '<', PurchaseRequest::STATUS_DONE)->paginate(5, ['*'], 'pr-page'),
        //     'open_po_list' => PurchaseOrder::where('status_id', '<', PurchaseOrder::STATUS_DONE)->paginate(5, ['*'], 'po-page')
        // ];

        return view('dashboard');
    }
}
