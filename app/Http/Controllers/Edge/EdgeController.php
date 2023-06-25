<?php

namespace App\Http\Controllers\Edge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use DataTables;
use Illuminate\Support\Facades\Session;
use App\Services\UserService;

class EdgeController extends Controller
{
    private $UserService;
    public function __construct(UserService $service)
    {
        $this->UserService = $service;
    }
    public function edgeDashboard()
    {
        return view('edge.dashboard');
    }
    public function viewUserList()
    {
        //dd("This is Edge Controller");
        return view('edge.user_list');
    }
    public function getUserList(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::latest('id')->where('status','<>', DELETED)->get();
            return datatables($data)
                ->addIndexColumn()
                ->editColumn('avatar_path', function ($row) {
                    isset($row->avatar_path) ? $img_path = '<img src="' . asset('file_root') . '/' . $row->avatar_path . '" class="img-circle" width="30">' : $img_path = '';
                    return $img_path;
                })
                ->editColumn('status', function ($row) {
                    return $row->status == ACTIVE ? '<span class="badge badge-success">' . __('Active') . '</span>' : '<span class="badge badge-warning">' . __('Inactive') . '</span>';
                })
                ->editColumn(
                    'action',
                    function ($item) {
                        $html = '<a href="javascript:void(0)" class="text-info p-1 edit-row" data-id="' . $item->id . '"><i class="fa fa-edit"></i></a>';
                        $html .= '<a href="javascript:void(0)" class="text-danger p-1 delete_row" data-style="zoom-in" data-id="' . $item->id . '"><i class="fa fa-trash"></i></a>';
                        return $html;
                    }
                )->rawColumns(['avatar_path', 'status',  'action'])
                ->make(true);
        }
    }

    public function newUserForm(Request $request)
    {
        return view('edge.newUserForm');
    }


    public function notificationRead($notification_id)
    {
        if (!empty($notification_id)) {
            $notifications =  app('auth')->guard('admin')->user()->unreadNotifications->where('id', $notification_id)->markAsRead();
        }
        echo "Notification " . $notification_id . " read done";
    }
    public function userProfile($email)
    {
        $user = Customer::where('email', $email)->firstOrFail();
        $data = $user->toArray();
        return view('edge.userProfile', compact('data'));
    }
    public function editUser(Request $request)
    {
        $user = Customer::find($request->id);
        return view('edge.user_edit', compact('user'));
    }

    public function deleteUser(Request $request)
    {
        $user_id =  $request->id;
        return $this->UserService->UserDelete($user_id);
    }
    public function editUserData(Request $request)
    {
        try {
            $requestData =  $request->all();
            $updateData =
                [
                    'status' => $requestData['status'],
                ];

            $customer =  Customer::where(['id' => $requestData['id']])->update($updateData);
            Session::flash('success', 'Data Updated successfully.');
            if ($customer === null) {
                Session::flash('error', 'Something went wrong!');
                return redirect()->back();
            } else {
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }
    }
}
