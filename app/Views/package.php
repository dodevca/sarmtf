<?= $this->extend("app") ?>

<?= $this->section("page") ?>
<div class="page-content header-clear-medium">
    <div class="card card-style">
        <div class="content">
            <div class="d-flex align-items-center justify-content-between gap-3">
                <h1 class="font-700 pb-0">Daftar Paket</h1>
                <a href="#" class="btn-full btn bg-fade2-yellow" data-bs-toggle="offcanvas" data-bs-target="#menu-submit" >
                    <i class="bi bi-plus-lg font-16 text-dark me-2"></i><span class="text-dark">Tambah</span>
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
    <?php if (session()->has('success')): ?>
        <div class="container">
            <div class="alert bg-fade-green alert-dismissible rounded-s fade show" role="alert">
            	<strong class="text-dark"><?= session()->getFlashdata('success') ?></strong>
            	<button type="button" class="btn-close opacity-20 font-11 pt-3 mt-1" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>
    <?php if($data['totalResults'] > 0): ?>
        <?php forEach($data['results'] as $result): ?>
            <a href="/dashboard/paket/<?= $result['uid'] ?>">
                <div class="card card-style">
                    <div class="content">
                        <div class="d-flex pb-0">
                            <div class="align-self-center">
                                <div class="icon icon-xl bg-linkedin shadow-bg shadow-bg-xs rounded-m"><i class="bi bi-box-seam"></i></div>
                            </div>
                            <div class="align-self-center">
                                <h2 class="ps-3 mb-0"><?= $result['name'] ?></h2>
                            </div>
                        </div>
                	</div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="container">
            <div class="alert bg-fade-yellow text-dark alert-dismissible rounded-s fade show" role="alert">
            	<strong class="text-dark">Tidak ditemukan paket.</strong><span class="opacity-60 text-dark"></span>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= form_open('/dashboard/paket/tambah') ?>
    <?= csrf_field() ?>
    <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-submit">
        <div class="content">
            <div class="form-custom form-label form-icon mb-3">
            	<i class="bi bi-box-seam font-14"></i>
            	<input type="text" class="form-control rounded-xs" id="name" name="name" placeholder="Nama paket" required="">
            	<label for="c1" class="color-theme">Nama</label>
            </div>
	        <button type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 w-100">Tambah paket</button>
        </div>
    </div>
<?= form_close() ?>
<?= $this->endSection() ?>