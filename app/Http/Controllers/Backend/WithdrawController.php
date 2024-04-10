<?php

namespace App\Http\Controllers\Backend;

use App\Business;
use App\Http\Controllers\Controller;
use App\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class WithdrawController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->id == 5) {
            return view('withdraw.superadmin_index');
        } else {
            return view('withdraw.index');
        }
    }

    public function getSuperadminList(Request $request)
    {
        $data = Withdraw::orderBy('created_at', 'desc')->get();
        return DataTables::of($data)
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge bg-success-200 text-success-700 rounded-pill w-80">Pending</span>';
                } elseif ($row->status == 2) {
                    return '<span class="badge bg-warning-200 text-warning-600 rounded-pill w-80">Rejected</span>';
                } elseif ($row->status == 3) {
                    return '<span class="badge bg-warning-200 text-warning-600 rounded-pill w-80">On Process</span>';
                } elseif ($row->status == 4) {
                    return '<span class="badge bg-warning-200 text-warning-600 rounded-pill w-80">Completed</span>';
                }
            })
            ->addColumn('action', function ($row) {
                $html =
                    '<div class="btn-group"><button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">' . __('messages.actions') . '<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu dropdown-menu-left" role="menu">';

                $html .= '<li><a data-id="'.$row->id.'" data-business_id="'.$row->business_id.'" class="view_request"><i class="fa fa-eye"></i> View</a></li>';
                $html .= '<li><a data-id="'.$row->id.'" data-business_id="'.$row->business_id.'" class="view_request"><i class="fa fa-eye"></i> Accept</a></li>';
                $html .= '<li><a data-id="'.$row->id.'" data-business_id="'.$row->business_id.'" class="view_request"><i class="fa fa-eye"></i> Reject</a></li>';
                $html .= '<li><a data-id="'.$row->id.'" data-business_id="'.$row->business_id.'" class="view_request"><i class="fa fa-eye"></i> On Process</a></li>';
                $html .= '<li><a data-id="'.$row->id.'" data-business_id="'.$row->business_id.'" class="view_request"><i class="fa fa-eye"></i> Complete</a></li>';
                $html .= '<li><a data-id="'.$row->id.'" data-business_id="'.$row->business_id.'" class="view_request"><i class="fa fa-eye"></i> Undo</a></li>';

                $html .= '</ul></div>';

                return $html;
            })
            ->rawColumns(['status', 'action'])->make(true);
    }
    public function getWithdrawList(Request $request)
    {
        $data = Withdraw::orderBy('created_at', 'desc')->get();
        return DataTables::of($data)
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge bg-success-200 text-success-700 rounded-pill w-80">Pending</span>';
                } elseif ($row->status == 2) {
                    return '<span class="badge bg-warning-200 text-warning-600 rounded-pill w-80">Rejected</span>';
                } elseif ($row->status == 3) {
                    return '<span class="badge bg-warning-200 text-warning-600 rounded-pill w-80">On Process</span>';
                } elseif ($row->status == 4) {
                    return '<span class="badge bg-warning-200 text-warning-600 rounded-pill w-80">Completed</span>';
                }
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn = $btn . '<button data-href="{{action(\'App\Http\Controllers\AccountController@edit\',[$id])}}" data-container=".account_model" class="btn btn-xs btn-primary btn-modal"><i class="glyphicon glyphicon-edit"></i> @lang("messages.edit")</button>';
                $btn = $btn . '<a href="{{action(\'App\Http\Controllers\AccountController@show\',[$id])}}" class="btn btn-warning btn-xs"><i class="fa fa-book"></i> @lang("account.account_book")</a>&nbsp;';
                return $btn;
            })
            ->rawColumns(['status', 'action'])->make(true);
    }
    public function addRequest()
    {
        $html = view('withdraw.add_request')->render();
        $response = [
            'success' => true,
            'html' => $html
        ];
        return response()->json($response);
    }
    public function storeWithdrawRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_name' => 'required',
            'account_no' => 'required',
            'account_branch' => 'required',
            'amount' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            DB::beginTransaction();
            $withdraw = new Withdraw;
            $withdraw->business_id = Business::where('owner_id', Auth::user()->id)->first()->id;
            $withdraw->account_name = $request->account_name;
            $withdraw->account_name = $request->account_name;
            $withdraw->account_no = $request->account_no;
            $withdraw->account_branch = $request->account_branch;
            $withdraw->amount = $request->amount;
            $withdraw->status = 1;
            $withdraw->save();
            DB::commit();

            $response = [
                'success' => true,
                'message' => 'Withdraw request sent successfully.'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }
}
