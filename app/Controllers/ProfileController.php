<?php
namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->userModel = new UserModel();
    }

    public function profile()
    {
        // Ambil id pengguna yang sedang login (sesuaikan dengan implementasi login Anda)
        $userId = session()->get('user_id');

        // Ambil data pengguna dari database
        $userModel = new UserModel();
        $userData = $userModel->find($userId);

        // Kirim data pengguna ke tampilan
        $data['userData'] = $userData;

        return view('v_profile', $data);
    }

    public function updatePassword()
    {
        $validationRules = [
            'currentPassword' => 'required',
            'newPassword' => 'required|min_length[3]',
            'renewPassword' => 'required|matches[newPassword]'
        ];

        if ($this->validate($validationRules)) {
            $currentPassword = $this->request->getPost('currentPassword');
            $newPassword = $this->request->getPost('newPassword');

            // Mendapatkan ID pengguna dari data pengguna
            $userData = session('userData');
            if (!$userData) {
                return redirect()->back()->with('error', 'User data not found in session.');
            }

            $userId = $userData['id'];


            // Mendapatkan data pengguna dari database berdasarkan ID
            $user = $this->userModel->find($userId);

            if (!$user) {
                return redirect()->back()->with('error', 'User not found.');
            }

            // Memverifikasi password saat ini
            if (md5($currentPassword) != $user['password']) {
                return redirect()->back()->with('error', 'Incorrect current password.');
            }

            // Mengubah password baru
            $data = [
                'password' => md5($newPassword)
            ];
            $this->userModel->update($userId, $data);

            return redirect()->to('/profile')->with('success', 'Password successfully updated.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }
    
}