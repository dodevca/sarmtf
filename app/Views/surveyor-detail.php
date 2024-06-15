<?= $this->extend("app") ?>

<?= $this->section("page") ?>
<div class="page-content header-clear-medium">
    <?php if($data['totalResults'] > 0): ?>
        <div class="card card-style">
            <div class="content">
                <div class="d-flex align-items-center justify-content-between gap-3">
                    <h1 class="font-700 pb-0">CMO #<?= $data['uid'] ?></h1>
                    <a href="#" class="btn-full btn bg-fade2-red" data-bs-toggle="offcanvas" data-bs-target="#menu-warning">
                        <i class="bi bi-trash3 font-16 text-dark me-2"></i><span class="text-dark">Hapus</span>
                    </a>
                </div>
            </div>
        </div>
        <?php if (session()->has('errors')): ?>
            <div class="container">
                <div class="alert bg-fade-red alert-dismissible rounded-s fade show" role="alert">
                	<strong class="text-dark"><?= session()->getFlashdata('errors') ?></strong>
                	<button type="button" class="btn-close opacity-20 font-11 pt-3 mt-1" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>
        <div class="card card-style">
            <div class="content">
                <?= form_open('/dashboard/surveyor/' . $data['uid'] . '/edit') ?>
                    <?= csrf_field() ?>
                    <div class="form-custom form-label form-icon mb-3">
                    	<i class="bi bi-person-circle font-14"></i>
                    	<input type="text" class="form-control rounded-xs" id="name" name="name" placeholder="Nama CMO" value="<?= $data['result'][0]['name'] ?>" required="">
                    	<label for="c1" class="color-theme">Nama</label>
                    </div>
        	        <button type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 w-100">Simpan Perubahan</button>
                <?= form_close() ?>
            </div>
        </div>
    <?php else: ?>
        <div class="container">
            <div class="alert bg-fade-yellow text-dark alert-dismissible rounded-s fade show" role="alert">
            	<strong class="text-dark">Tidak ditemukan CMO.</strong><span class="opacity-60 text-dark"></span>
            </div>
        </div>
    <?php endif; ?>
</div>
<div class="offcanvas offcanvas-modal rounded-m offcanvas-detached bg-theme" style="width: 340px;visibility: hidden;" id="menu-warning" aria-hidden="true">
	<div class="gradient-red px-3 py-3">
		<div class="d-flex mt-1">
			<div class="align-self-center">
				<i class="bi bi-x-circle-fill font-22 pe-2 scale-box color-white"></i>
			</div>
			<div class="align-self-center">
				<h1 class="font-800 color-white mb-0">Warning</h1>
			</div>
		</div>
		<p class="color-white opacity-60 pt-2">
			Apakah anda yakin akan menghapus CMO?
		</p>
		<a href="/dashboard/surveyor/<?= $data['uid'] ?>/hapus" class="default-link btn btn-full btn-s bg-white color-black">Ya, lanjutkan</a>
	</div>
</div>
<?= $this->endSection() ?>