<?php

namespace App\Controllers;

use App\Models\userModel;

class RegisterController extends BaseController
{
    protected $user;

    function __construct()
    {
        helper('form');
        $this->user = new userModel();
    }
    
    public function register()
	{
		if ($this->request->getMethod() === 'post') {
			$rules = [
				'username' => 'required',
				'password' => 'required'
			];

			if ($this->validate($rules)) {
				$data = [
					'username' => $this->request->getPost('username'),
					// Menggunakan enkripsi md5
					'password' => md5($this->request->getPost('password')),
					'role' => "guest"
				];

				$this->user->insert($data);

				return redirect()->to('login')->with('Suksess', 'Registrasi Berhasil, Silahkan Login.');
			} else {
				return redirect()->back()->withInput()->with('Gagal', 'Registrasi Gagal, Mohon Registrasi Ulang.');
			}
		}

		return view('v_register');
	}
}