<?php

namespace App\Http\Controllers;

use App\Product;
use App\TransactionSellLine;
use App\Utils\BusinessUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Crm\Entities\ServicePropertyWanted;
use Yajra\DataTables\DataTables;

class CustomerProductController extends Controller
{
    public function index()
    {
        $businessUtil   = new BusinessUtil();
        $only_shipments = request()->only_shipments == 'true' ? true : false;
        $is_admin       = $businessUtil->is_admin(auth()->user());
        $sale_type      = !empty(request()->input('sale_type')) ? request()->input('sale_type') : 'sell';
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (request()->ajax()) {
            $transaction_sell_lines = TransactionSellLine::whereHas('transaction', function ($sub_query) use ($user) {
                $sub_query->where('created_by', $user->id);
            })
                ->with(['product.variations'])
                ->orderBy('created_at', 'asc')
                ->get();

            return DataTables::of($transaction_sell_lines)
                ->addColumn(
                    'action',
                    function ($row) use ($only_shipments, $is_admin, $sale_type) {
                        $html = '<div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle btn-xs" 
                                data-toggle="dropdown" aria-expanded="false">' .
                            __('messages.actions') .
                            '<span class="caret"></span><span class="sr-only">Toggle Dropdown
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">';

                        if (auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view') || auth()->user()->can('view_own_sell_only')) {
                            $html .= '<li><a href="#" data-href="' . action([\App\Http\Controllers\SellController::class, 'show'], [$row->id]) . '" class="btn-modal" data-container=".view_modal"><i class="fas fa-eye" aria-hidden="true"></i> ' . __('messages.view') . '</a></li>';
                        }
                        if (!$only_shipments) {
                            if ($row->is_direct_sale == 0) {
                                if (auth()->user()->can('sell.update')) {
                                    $html .= '<li><a target="_blank" href="' . action([\App\Http\Controllers\SellPosController::class, 'edit'], [$row->id]) . '"><i class="fas fa-edit"></i> ' . __('messages.edit') . '</a></li>';
                                }
                            } elseif ($row->type == 'sales_order') {
                                if (auth()->user()->can('so.update')) {
                                    $html .= '<li><a target="_blank" href="' . action([\App\Http\Controllers\SellController::class, 'edit'], [$row->id]) . '"><i class="fas fa-edit"></i> ' . __('messages.edit') . '</a></li>';
                                }
                            } else {
                                if (auth()->user()->can('direct_sell.update')) {
                                    $html .= '<li><a target="_blank" href="' . action([\App\Http\Controllers\SellController::class, 'edit'], [$row->id]) . '"><i class="fas fa-edit"></i> ' . __('messages.edit') . '</a></li>';
                                }
                            }

                            $delete_link = '<li><a href="' . action([\App\Http\Controllers\SellPosController::class, 'destroy'], [$row->id]) . '" class="delete-sale"><i class="fas fa-trash"></i> ' . __('messages.delete') . '</a></li>';
                            if ($row->is_direct_sale == 0) {
                                if (auth()->user()->can('sell.delete')) {
                                    $html .= $delete_link;
                                }
                            } elseif ($row->type == 'sales_order') {
                                if (auth()->user()->can('so.delete')) {
                                    $html .= $delete_link;
                                }
                            } else {
                                if (auth()->user()->can('direct_sell.delete')) {
                                    $html .= $delete_link;
                                }
                            }
                        }

                        if (config('constants.enable_download_pdf') && auth()->user()->can('print_invoice') && $sale_type != 'sales_order') {
                            $html .= '<li><a href="' . route('sell.downloadPdf', [$row->id]) . '" target="_blank"><i class="fas fa-print" aria-hidden="true"></i> ' . __('lang_v1.download_pdf') . '</a></li>';

                            if (!empty($row->shipping_status)) {
                                $html .= '<li><a href="' . route('packing.downloadPdf', [$row->id]) . '" target="_blank"><i class="fas fa-print" aria-hidden="true"></i> ' . __('lang_v1.download_paking_pdf') . '</a></li>';
                            }
                        }

                        if (auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.access')) {
                            if (!empty($row->document)) {
                                $document_name = !empty(explode('_', $row->document, 2)[1]) ? explode('_', $row->document, 2)[1] : $row->document;
                                $html .= '<li><a href="' . url('uploads/documents/' . $row->document) . '" download="' . $document_name . '"><i class="fas fa-download" aria-hidden="true"></i>' . __('purchase.download_document') . '</a></li>';
                                if (isFileImage($document_name)) {
                                    $html .= '<li><a href="#" data-href="' . url('uploads/documents/' . $row->document) . '" class="view_uploaded_document"><i class="fas fa-image" aria-hidden="true"></i>' . __('lang_v1.view_document') . '</a></li>';
                                }
                            }
                        }

                        if ($is_admin || auth()->user()->hasAnyPermission(['access_shipping', 'access_own_shipping', 'access_commission_agent_shipping'])) {
                            $html .= '<li><a href="#" data-href="' . action([\App\Http\Controllers\SellController::class, 'editShipping'], [$row->id]) . '" class="btn-modal" data-container=".view_modal"><i class="fas fa-truck" aria-hidden="true"></i>' . __('lang_v1.edit_shipping') . '</a></li>';
                        }

                        if ($row->type == 'sell') {
                            if (auth()->user()->can('print_invoice')) {
                                $html .= '<li><a href="#" class="print-invoice" data-href="' . route('sell.printInvoice', [$row->id]) . '"><i class="fas fa-print" aria-hidden="true"></i> ' . __('lang_v1.print_invoice') . '</a></li>
                            <li><a href="#" class="print-invoice" data-href="' . route('sell.printInvoice', [$row->id]) . '?package_slip=true"><i class="fas fa-file-alt" aria-hidden="true"></i> ' . __('lang_v1.packing_slip') . '</a></li>';

                                $html .= '<li><a href="#" class="print-invoice" data-href="' . route('sell.printInvoice', [$row->id]) . '?delivery_note=true"><i class="fas fa-file-alt" aria-hidden="true"></i> ' . __('lang_v1.delivery_note') . '</a></li>';
                            }
                            $html .= '<li class="divider"></li>';
                            if (!$only_shipments) {
                                if (
                                    $row->is_direct_sale == 0 && !auth()->user()->can('sell.update') &&
                                    auth()->user()->can('edit_pos_payment')
                                ) {
                                    $html .= '<li><a href="' . route('edit-pos-payment', [$row->id]) . '" 
                            ><i class="fas fa-money-bill-alt"></i> ' . __('lang_v1.add_edit_payment') .
                                        '</a></li>';
                                }

                                if (
                                    auth()->user()->can('sell.payments') ||
                                    auth()->user()->can('edit_sell_payment') ||
                                    auth()->user()->can('delete_sell_payment')
                                ) {
                                    if ($row->payment_status != 'paid') {
                                        $html .= '<li><a href="' . action([\App\Http\Controllers\TransactionPaymentController::class, 'addPayment'], [$row->id]) . '" class="add_payment_modal"><i class="fas fa-money-bill-alt"></i> ' . __('purchase.add_payment') . '</a></li>';
                                    }

                                    $html .= '<li><a href="' . action([\App\Http\Controllers\TransactionPaymentController::class, 'show'], [$row->id]) . '" class="view_payment_modal"><i class="fas fa-money-bill-alt"></i> ' . __('purchase.view_payments') . '</a></li>';
                                }

                                if (auth()->user()->can('sell.create') || auth()->user()->can('direct_sell.access')) {
                                    // $html .= '<li><a href="' . action([\App\Http\Controllers\SellController::class, 'duplicateSell'], [$row->id]) . '"><i class="fas fa-copy"></i> ' . __("lang_v1.duplicate_sell") . '</a></li>';
        
                                    $html .= '<li><a href="' . action([\App\Http\Controllers\SellReturnController::class, 'add'], [$row->id]) . '"><i class="fas fa-undo"></i> ' . __('lang_v1.sell_return') . '</a></li>

                            <li><a href="' . action([\App\Http\Controllers\SellPosController::class, 'showInvoiceUrl'], [$row->id]) . '" class="view_invoice_url"><i class="fas fa-eye"></i> ' . __('lang_v1.view_invoice_url') . '</a></li>';
                                }
                            }

                            $html .= '<li><a href="#" data-href="' . action([\App\Http\Controllers\NotificationController::class, 'getTemplate'], ['transaction_id' => $row->id, 'template_for' => 'new_sale']) . '" class="btn-modal" data-container=".view_modal"><i class="fa fa-envelope" aria-hidden="true"></i>' . __('lang_v1.new_sale_notification') . '</a></li>';
                        } else {
                            $html .= '<li><a href="#" data-href="' . action([\App\Http\Controllers\SellController::class, 'viewMedia'], ['model_id' => $row->id, 'model_type' => \App\Transaction::class, 'model_media_type' => 'shipping_document']) . '" class="btn-modal" data-container=".view_modal"><i class="fas fa-paperclip" aria-hidden="true"></i>' . __('lang_v1.shipping_documents') . '</a></li>';
                        }

                        $html .= '</ul></div>';

                        return $html;
                    }
                )
                ->addColumn('name', function ($transaction_sell_line) {
                    return $transaction_sell_line->product->name;
                })
                ->addColumn('invoice_no', function ($transaction_sell_line) {
                    return $transaction_sell_line->transaction->invoice_no;
                })
                ->addColumn('unit_price', function ($transaction_sell_line) {
                    return '£ ' . $transaction_sell_line->product->variations[0]->sell_price_inc_tax;
                })
                ->addColumn('payment_method', function ($transaction_sell_line) {
                    return $transaction_sell_line->transaction->payment_lines[0]->method;
                })
                ->addColumn('purchase_date', function ($transaction_sell_line) {
                    return Carbon::parse($transaction_sell_line->created_at)->format('d F, Y');
                })
                ->rawColumns([])
                ->toJson();
        }
        return view('crm::customer-product.list');
    }
}
