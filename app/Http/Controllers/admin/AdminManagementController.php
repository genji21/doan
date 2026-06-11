<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\AdminModel;
use Illuminate\Http\Request;

class AdminManagementController extends Controller
{
    private $admin;

    public function __construct()
    {
        $this->admin = new AdminModel();
    }
    public function index()
    {
        $title = 'Quản lý Admin';

        $admin = $this->admin->getAdmin();

        return view('admin.profile-admin', compact('title', 'admin'));
    }

    public function updateAdmin(Request $request)
    {
        $fullName = $request->fullName;
        $password = $request->password;
        $email = $request->email;
        $address = $request->address;

        $admin = $this->admin->getAdmin();
        $oldPass = $admin->password;

        if ($password != $oldPass) {
            $password = md5($password);
        }


        $dataUpdate = [
            'fullName' => $fullName,
            'password' => $password,
            'email' => $email,
            'address' => $address
        ];
        $update = $this->admin->updateAdmin($dataUpdate);
        $newinfo = $this->admin->getAdmin();
        if ($update) {
            return response()->json(
                [
                    'success' => true,
                    'data' => $newinfo
                ]
            );
        } else {
            return response()->json(['success' => false, 'message' => 'Không có thông tin nào thay đổi!']);
        }
    }

    public function updateAvatar(Request $req)
    {
        // Handle avatar upload for admin
        $avatar = $req->file('avatarAdmin');

        if (!$avatar) {
            return response()->json(['error' => true, 'message' => 'Không có tệp ảnh được gửi.']);
        }

        $uploadDir = public_path('admin/assets/images/user-profile');

        // ensure directory exists
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Get current admin avatar and delete if exists
        $admin = $this->admin->getAdmin();
        $oldAvatar = $admin->avatar ?? null;
        if ($oldAvatar) {
            $oldPath = $uploadDir . DIRECTORY_SEPARATOR . $oldAvatar;
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

        // Build new filename (keep extension)
        $extension = $avatar->getClientOriginalExtension();
        $filename = time() . '.' . $extension;

        // Move uploaded file
        try {
            $avatar->move($uploadDir, $filename);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Có vấn đề khi lưu tệp ảnh: ' . $e->getMessage()]);
        }

        // Update admin record and session
        $this->admin->updateAdmin(['avatar' => $filename]);
        $req->session()->put('avatar', $filename);

        return response()->json(['success' => true, 'message' => 'Cập nhật ảnh thành công!', 'avatar' => $filename]);
    }

}
