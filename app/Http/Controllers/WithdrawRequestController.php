<?php

namespace App\Http\Controllers;

use App\Business;
use App\Http\Controllers\Controller;
use App\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class WithdrawRequestController extends Controller
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

                $html .= '<li><a data-id="' . $row->id . '" data-business_id="' . $row->business_id . '" class="view_request"><i class="fa fa-eye"></i> View</a></li>';
                if (!in_array($row->status, [2,4])) {
                    $html .= '<li><a data-id="' . $row->id . '" data-business_id="' . $row->business_id . '" data-action="reject" class="action_btn"><i class="fa fa-trash"></i> Reject</a></li>';
                    $html .= '<li><a data-id="' . $row->id . '" data-business_id="' . $row->business_id . '" data-action="complete" class="action_btn"><i class="fa fa-check"></i> Complete</a></li>';
                }
                if (!in_array($row->status, [3,4])) {
                    $html .= '<li><a data-id="' . $row->id . '" data-business_id="' . $row->business_id . '" data-action="processing" class="action_btn"><i class="fa fa-hourglass-half"></i> On Process</a></li>';
                }

                $html .= '</ul></div>';

                return $html;
            })
            ->rawColumns(['status', 'action'])->make(true);
    }
    public function getWithdrawList(Request $request)
    {
        $business = Business::where('owner_id', Auth::user()->id)->first();
        $data = Withdraw::where('business_id', $business->id)->orderBy('created_at', 'desc')->get();
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

                $html .= '<li><a data-id="' . $row->id . '" data-business_id="' . $row->business_id . '" class="view_request"><i class="fa fa-eye"></i> View</a></li>';
                // $html .= '<li><a data-id="' . $row->id . '" data-business_id="' . $row->business_id . '" data-action="accept" class="action_btn"><i class="fa fa-eye"></i> Accept</a></li>';
                $html .= '<li><a data-id="' . $row->id . '" data-business_id="' . $row->business_id . '" data-action="reject" class="action_btn"><i class="fa fa-trash"></i> Reject</a></li>';
                $html .= '<li><a data-id="' . $row->id . '" data-business_id="' . $row->business_id . '" data-action="processing" class="action_btn"><i class="fa fa-hourglass-half"></i> On Process</a></li>';
                $html .= '<li><a data-id="' . $row->id . '" data-business_id="' . $row->business_id . '" data-action="complete" class="action_btn"><i class="fa fa-check"></i> Complete</a></li>';
                // $html .= '<li><a data-id="' . $row->id . '" data-business_id="' . $row->business_id . '" data-action="undo" class="action_btn"><i class="fa fa-eye"></i> Undo</a></li>';

                $html .= '</ul></div>';

                return $html;
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
            $business_id = Business::where('owner_id', Auth::user()->id)->first()->id;
            $business = Business::find($business_id);
            if ($business->wallet < $request->amount) {
                $response = [
                    'success' => false,
                    'message' => 'You do not have enough amount on wallet.'
                ];
                return response()->json($response);
            }
            $withdraw = new Withdraw();
            $withdraw->business_id = $business_id;
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
            return response()->json($response);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            return response()->json($response);
        }
    }

    public function viewWithdrawRequest(Request $request)
    {
        $withdraw = Withdraw::find($request->id);
        $business = Business::find($withdraw->business_id);
        $html = view('withdraw.view', compact('withdraw', 'business'))->render();
        $response = [
            'success' => true,
            'html' => $html
        ];
        return response()->json($response);
    }
    public function takeAction(Request $request)
    {
        $action = $request->action;
        $withdraw = Withdraw::find($request->id);
        $business = Business::find($withdraw->business_id);
        $html = view('withdraw.take_action', compact('withdraw', 'business', 'action'))->render();
        $response = [
            'success' => true,
            'html' => $html
        ];
        return response()->json($response);
    }

    public function takeActionStore(Request $request)
    {
        try {
            DB::beginTransaction();
            $withdraw = Withdraw::find($request->id);

            // if ($request->action == 'accept') {
            //     $withdraw->status = 1;
            // }
            if ($request->action == 'reject') {
                $withdraw->status = 2;

                $response = [
                    'success' => true,
                    'message' => 'Withdraw request rejected.'
                ];
            }
            if ($request->action == 'processing') {
                $withdraw->status = 3;

                $response = [
                    'success' => true,
                    'message' => 'Withdraw request is processing.'
                ];
            }
            if ($request->action == 'complete') {
                $withdraw->status = 4;

                $business = Business::find($request->business_id);
                $wallet = $business->wallet - $withdraw->amount;
                if ($wallet < 0) {
                    $response = [
                        'success' => false,
                        'message' => 'You do not have enough amount on wallet.'
                    ];
                    return response()->json($response);
                }
                $business->wallet = $wallet;
                $business->save();

                $response = [
                    'success' => true,
                    'message' => 'Withdraw request completed successfully.'
                ];
            }
            // if ($request->action == 'undo') {
            //     $withdraw->status = 1;
            // }
            $withdraw->save();
            DB::commit();


            return response()->json($response);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            return response()->json($response);
        }
    }
}