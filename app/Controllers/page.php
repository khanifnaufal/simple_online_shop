<?php

		namespace App\Controllers;
		use App\Models\ProdukModel;

		class Page extends BaseController
		{
			public function keranjang()
			{
				return view('v_keranjang');
			} 

			public function produk()
			{
				$produkModel = new ProdukModel(); 
				$produk = $produkModel->findAll();
				$data['produks'] = $produk;

				return view('v_produk', $data);
			} 
		}