<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();

        return view('v_user', $data);
    }

    public function add()
    {
        $userModel = new UserModel();

        if ($this->request->getMethod(true) === 'POST') {
            $userData = [
                'username' => $this->request->getPost('username'),
                'password' => md5($this->request->getVar('password')),
                'role' => $this->request->getPost('role')
            ];

            $userModel->insert($userData);

            // Set flash data untuk sukses tambah user
            session()->setFlashData('success', 'User berhasil ditambahkan.');

            return redirect()->to(base_url('user'));
        }

        return view('user/add');
    }

    public function edit($id)
    {
        $userModel = new UserModel();

        if ($this->request->getMethod(true) === 'POST') {
            $userData = [
                'username' => $this->request->getPost('username'),
                'password' => md5($this->request->getVar('password')),
                'role' => $this->request->getPost('role')
            ];

            $userModel->update($id, $userData);

            // Set flash data untuk sukses edit user
            session()->setFlashData('success', 'User berhasil diubah.');

            return redirect()->to(base_url('user'));
        }

        $data['user'] = $userModel->find($id);

        return view('user/edit', $data);
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);

        // Set flash data untuk sukses hapus user
        session()->setFlashData('success', 'User berhasil dihapus.');

        return redirect()->to(base_url('user'));
    }
}