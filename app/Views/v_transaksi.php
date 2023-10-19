<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php
	if(session()->getFlashData('success')){
?> 
<div class="alert alert-info alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('success') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>
<?php
	if(session()->getFlashData('failed')){
?> 
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<?= session()->getFlashData('failed') ?>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>

<!-- Table with stripped rows -->
<table class="table datatable">
<thead>
	<tr>
	<th scope="col">Id</th>
	<th scope="col">Username</th>
	<th scope="col">Total Harga</th>
	<th scope="col">Alamat</th>
	<th scope="col">Ongkir</th> 
	<th scope="col">Status</th> 
	<th scope="col">Date</th> 
	</tr>
</thead>
<tbody>
	<?php foreach($datas as $index=>$data): ?>
	<tr>
	<th scope="row"><?php echo $data['id'] ?></th>
	<td><?php echo $data['username'] ?></td> 
	<td><?php echo $data['total_harga'] ?></td> 
	<td><?php echo $data['alamat'] ?></td> 
	<td><?php echo $data['ongkir'] ?></td> 
	<td><?php echo $data['status'].($data['status']==0?' (Belum Selesai)':' (Selesai)') ?></td> 
	<td><?php echo $data['created_date'] ?></td> 
	<td>
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal-<?= $data['id'] ?>">
			Ubah Status
		</button>
	</td>
	</tr>
	<!-- Edit Modal Begin -->
	<div class="modal fade" id="editModal-<?= $data['id'] ?>" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ubah Status</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
			<form action="<?= base_url('transaksi/edit/'.$data['id']) ?>" method="post" enctype="multipart/form-data">
			<?= csrf_field(); ?>
				<div class="modal-body">
                    <h5 class="mb-3">Transaksi Id : <?= $data['id'] ?></h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status1" value="0">
                        <label class="form-check-label" for="status1">
                            Belum Selesai
                        </label>
                        </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status2" value="1">
                        <label class="form-check-label" for="status2">
                            Selesai
                        </label>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal End -->
	<?php endforeach ?>   
</tbody>
</table>
<!-- End Table with stripped rows -->

<?= $this->endSection() ?>