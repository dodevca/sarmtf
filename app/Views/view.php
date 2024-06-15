<?= $this->extend("app") ?>

<?= $this->section("page") ?>
<?php $result = $data['result'][0]; ?>
<div class="page-content header-clear-medium">
    <?php if (session()->has('errors')): ?>
        <div class="container">
            <div class="alert bg-fade-red alert-dismissible rounded-s fade show" role="alert">
            	<strong class="text-dark"><?= session()->getFlashdata('errors') ?></strong>
            	<button type="button" class="btn-close opacity-20 font-11 pt-3 mt-1" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>
    <h1 class="font-700 font-30 pb-4 text-center">Order #<?= $data['uid'] ?></h1>
    <div class="card card-style">
    	<div class="card-body px-0 py-3">
    		<h4 class="font-700 px-3 mb-3 pt-3 text-center">Data Pembeli</h5>
    		<div class="list-group list-custom list-group-m rounded-xs list-group-flush px-3">
    			<div class="list-group-item flex-column px-3">
    				<h5 class="align-self-start">Nama</h5>
    				<div class="align-self-start"><?= $result['name'] ?></div>
    			</div>
    			<div class="list-group-item flex-column px-3">
    				<h5 class="align-self-start">No. Telepon</h5>
    				<div class="align-self-start"><?= $result['phoneNumber'] ?></div>
    			</div>
    			<div class="list-group-item flex-column px-3">
    				<h5 class="align-self-start">Alamat</h5>
    				<div class="align-self-start"><?= $result['address'] ?></div>
    			</div>
    			<div class="list-group-item flex-column px-3">
    				<h5 class="align-self-start">KTP</h5>
    				<div class="d-flex flex-column gap-3">
    				    <?php forEach($result['identity'] as $ktp): ?>
                    		<div class="card rounded-m">
                    		    <img src="/uploads/ktp/<?= $ktp ?>" class="w-100 h-auto rounded-m">
                    		</div>
    				    <?php endforeach; ?>
                    </div>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="card card-style">
    	<div class="card-body px-0 py-3">
    		<h4 class="font-700 px-3 mb-3 pt-3 text-center">Data Unit</h5>
    		<div class="list-group list-custom list-group-m rounded-xs list-group-flush px-3">
    			<div class="list-group-item flex-column px-3">
    				<h5 class="align-self-start">Nama</h5>
    				<div class="align-self-start"><?= $result['unit'] ?></div>
    			</div>
    			<div class="list-group-item flex-column px-3">
    				<h5 class="align-self-start">Harga</h5>
    				<div class="align-self-start"><?= $result['price'] ?></div>
    			</div>
    			<div class="list-group-item flex-column px-3">
    				<h5 class="align-self-start">Tenor</h5>
    				<div class="align-self-start"><?= $result['tenor'] ?></div>
    			</div>
    			<div class="list-group-item flex-column px-3">
    				<h5 class="align-self-start">Paket</h5>
    				<div class="align-self-start"><?= $result['package'] == null ? 'Tidak ada' : $result['package'] ?></div>
    			</div>
    			<div class="list-group-item flex-column px-3">
    				<h5 class="align-self-start">Asuransi</h5>
    				<div class="align-self-start"><?= $result['insurance'] ==  1 ? 'Ya' : 'Tidak' ?></div>
    			</div>
		    </div>
        </div>
    </div>
    <div class="card card-style">
    	<div class="card-body px-0 py-3">
    		<h4 class="font-700 px-3 mb-3 pt-3 text-center">Data Survey</h5>
    		<div class="list-group list-custom list-group-m rounded-xs list-group-flush px-3">
    			<div class="list-group-item flex-column px-3">
    				<h5 class="align-self-start">Tanggal</h5>
    				<div class="align-self-start"><?= $result['date'] ?></div>
    			</div>
    			<div class="list-group-item flex-column px-3">
    				<h5 class="align-self-start">CMO</h5>
    				<div class="align-self-start"><?= $result['surveyor'] ?></div>
    			</div>
    			<div class="list-group-item flex-column px-3">
    				<h5 class="align-self-start">Lokasi</h5>
    				<div class="align-self-start"><a href="<?= $result['location'] ?>" target="_blank"><?= $result['location'] ?></a></div>
    			</div>
		    </div>
        </div>
    </div>
    <div class="card card-style">
    	<div class="card-body px-0 py-3">
    		<h4 class="font-700 px-3 mb-3 pt-3 text-center">Data Sales</h5>
    		<div class="list-group list-custom list-group-m rounded-xs list-group-flush px-3">
    			<div class="list-group-item flex-column px-3">
    				<h5 class="align-self-start">Nama</h5>
    				<div class="align-self-start"><?= $result['sales'] ?></div>
    			</div>
    			<div class="list-group-item flex-column px-3">
    				<h5 class="align-self-start">Dealer</h5>
    				<div class="align-self-start"><?= $result['dealer'] ?></div>
    			</div>
		    </div>
        </div>
    </div>
    <?php if($userData['email'] != null): ?>
        <div class="container pb-5">
            <a href="#" class="btn-full btn bg-fade2-red" data-bs-toggle="offcanvas" data-bs-target="#menu-warning">
                <i class="bi bi-trash3 font-16 text-dark me-2"></i><span class="text-dark">Hapus</span>
            </a>
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
			Apakah anda yakin akan menghapus data?
		</p>
		<a href="/dashboard/view/<?= $data['uid'] ?>/hapus" class="default-link btn btn-full btn-s bg-white color-black">Ya, lanjutkan</a>
	</div>
</div>
<?= $this->endSection() ?>