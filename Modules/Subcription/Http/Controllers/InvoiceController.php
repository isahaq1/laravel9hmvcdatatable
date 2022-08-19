<?php

namespace Modules\Subcription\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Role\Entities\Module;
use Modules\Subcription\Entities\Package;
use Modules\Client\Entities\Client;
use Modules\Subcription\Http\Requests\InvoiceRequest;
use Modules\Subcription\Entities\PackageInvoice;
use Modules\Subcription\Entities\PackagePaymentMethod;
use Modules\Subcription\Entities\PackageInvoicePayment;
use Auth;


class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = PackageInvoice::with('client','package','packageInvoicePayment')->get();
        return view('subcription::invoice.index',[
            'invoices' => $invoices
        ]);
    }
    public function create()
    {
        return view('subcription::invoice.create',[
            'packages' => Package::orderBy('id','desc')->get(),
            'clients' => Client::orderBy('id','desc')->get(),
            'modules' => Module::orderBy('id','desc')->get(),
            'paymentMethods' => PackagePaymentMethod::orderBy('id','desc')->get()
        ]);
    }
    
    public function store(InvoiceRequest $request)
    {

        $invoice = new PackageInvoice();
        $invoice->fill($request->all());
        $invoice->offer_status = @$request->offer_status ?? 0;
        $invoice->status = @$request->status ?? 0;

        if($invoice->save()){
            $modules_id = $request->module_id;
            $invoice->modules()->sync( $modules_id);
            $invoicePayment = new PackageInvoicePayment();
            $invoicePayment->fill($request->only('total_amount','package_payment_method_id','received_date'));
            $invoicePayment->invoice_id =  $invoice->invoice_id;
            $invoicePayment->save();
        }
        // toastr.success(response.message, response.title);
        Toastr::success('Invoice created successfully :)','Success');
        return redirect()->route('packages-invoices.index');
    }

    public function show($id)
    {
        return view('subcription::show');
    }
    public function edit($id)
    {
        $invoice = PackageInvoice::findOrFail($id);
        return view('subcription::invoice.edit',[
            'packages' => Package::orderBy('id','desc')->get(),
            'clients' => Client::orderBy('id','desc')->get(),
            'modules' => Module::orderBy('id','desc')->get(),
            'paymentMethods' => PackagePaymentMethod::orderBy('id','desc')->get(),
            'invoice' => $invoice,
            'modules_id' => $invoice->modules()->pluck('module_id')->toArray()
        ]);
    }
    public function update(Request $request, $id)
    {
        $invoice = PackageInvoice::findOrFail($id);
        $invoice->fill($request->all());
        $invoice->offer_status = @$request->offer_status ?? 0;
        $invoice->status = @$request->status ?? 0;
        if($invoice->save()){
            $modules_id = $request->module_id;
            $invoice->modules()->sync( $modules_id);
            $invoicePayment = $invoice->packageInvoicePayment()->firstOrFail();
            $invoicePayment->fill($request->only('total_amount','package_payment_method_id','received_date'));
            $invoicePayment->invoice_id =  $invoice->invoice_id;
            $invoicePayment->save();
        }
        Toastr::success('Invoice updated successfully :)','Success');
        return redirect()->route('packages-invoices.index');
    }
    public function destroy($id)
    {
        $invoice = PackageInvoice::findOrFail($id);
        $invoice->packageInvoicePayment()->delete();
        $invoice->delete();
        Toastr::success('Invoice deleted successfully :)','Success');
        return response()->json(['success' => 'Data Deleted Successfully']);
    }
}
