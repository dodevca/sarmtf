<?= $this->extend("app") ?>

<?= $this->section("page") ?>
<div class="page-content header-clear-medium">
    <div class="card card-style">
        <div class="content">
            <div class="d-flex align-items-center justify-content-between gap-3">
                <h1 class="font-700 pb-0">Daftar Sales</h1>
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
            <a href="/dashboard/sales/<?= $result['uid'] ?>">
                <div class="card card-style">
                    <div class="content">
                		<div class="d-flex pb-1">
                			<div>
                				<h3><?= $result['name'] ?></h3>
                				<h6 class="mt-n2  opacity-80 color-highlight"><?= $result['email'] ?></h6>
                			</div>
                		</div>
                		<p class="mb-0"><i class="bi bi-building-fill font-16 me-2"></i><?= $result['dealer'] ?></p>
                	</div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="container">
            <div class="alert bg-fade-yellow text-dark alert-dismissible rounded-s fade show" role="alert">
            	<strong class="text-dark">Tidak ditemukan Sales.</strong><span class="opacity-60 text-dark"></span>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= form_open('/dashboard/sales/tambah') ?>
    <?= csrf_field() ?>
    <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-submit">
        <div class="content">
            <div class="form-custom form-label form-icon mb-3">
            	<i class="bi bi-person-circle font-14"></i>
            	<input type="text" class="form-control rounded-xs" id="name" name="name" placeholder="Nama Sales" required="">
            	<label for="c1" class="color-theme">Nama</label>
            </div>
            <div class="form-custom form-label form-icon mb-3">
            	<i class="bi bi-envelope font-14"></i>
            	<input type="text" class="form-control rounded-xs" id="email" name="email" placeholder="Email Sales" required="">
            	<label for="c1" class="color-theme">Email</label>
            </div>
            <div class="form-custom form-label form-icon mb-3">
                <i class="bi bi-building font-13"></i>
                <select class="form-select rounded-xs" id="dealer" name="dealer" aria-label="Floating label select">
                    <option selected="">Pilih Dealer</option>
                    <?php forEach($data['dealer'] as $dealer): ?>
                        <option value="<?= $dealer['name'] ?>"><?= $dealer['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-custom form-label form-icon mb-3">
            	<i class="bi bi-lock font-14"></i>
            	<input type="password" class="form-control rounded-xs" id="password" name="password" placeholder="Password" required="">
            	<label for="c1" class="color-theme">Password</label>
            </div>
            <div class="form-custom form-label form-icon mb-3">
            	<i class="bi bi-lock font-14"></i>
            	<input type="password" class="form-control rounded-xs" id="passwordMatch" name="passwordMatch" placeholder="Ketik ulang password" required="">
            	<label for="c1" class="color-theme">Password</label>
            </div>
	        <button type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 w-100">Tambah sales</button>
        </div>
    </div>
<?= form_close() ?>
<?= $this->endSection() ?>