<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          <img src="<?php echo base_url() ?>public/NiceAdmin/assets/img/profile-img.jpg" alt="Profile"
            class="rounded-circle">
          <h2>
            <?= session()->get('username') ?>
          </h2>
          <h3>
            <?= session()->get('role') ?>
          </h3>
        </div>
      </div>
    </div>

    <div class="col-xl-8">
      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profile</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ganti Password</button>
            </li>
          </ul>
          <div class="tab-content pt-2">
            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <h5 class="card-title">Detail Profile</h5>
              <?php foreach ($userData as $key => $value) {
                if ($value['username'] == session()->get('username')) { ?>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nama Username</div>
                    <div class="col-lg-9 col-md-8">
                      <?= $value['username'] ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Role</div>
                    <div class="col-lg-9 col-md-8">
                      <?= $value['role'] ?>
                    </div>
                  </div>
                  <?php
                }
              } ?>
            </div>

            <div class="tab-pane fade pt-3" id="profile-change-password">


              <?php if (session()->has('success')): ?>
                <div class="alert alert-success" role="alert">
                  <?= session()->getFlashdata('success') ?>
                </div>
              <?php endif; ?>

              <?php if (session()->has('error')): ?>
                <div class="alert alert-danger" role="alert">
                  <?= session()->getFlashdata('error') ?>
                </div>
              <?php endif; ?>

              <?php if (session()->has('errors')): ?>
                <div class="alert alert-danger" role="alert">
                  <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <p>
                      <?= $error ?>
                    </p>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>

              <!-- Change Password Form -->
              <form action="<?= base_url('profile/update') ?>" method="post">
                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Saat Ini</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="currentPassword" type="password" class="form-control" id="currentPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="newPassword" type="password" class="form-control" id="newPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Masukkan Ulang Password Baru</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="renewPassword" type="password" class="form-control" id="renewPassword">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Ganti Password</button>
                </div>
              </form><!-- End Change Password Form -->
            </div>
          </div><!-- End Bordered Tabs -->
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>