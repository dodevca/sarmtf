<?= $this->extend("app") ?>

<?= $this->section("page") ?>
<?php $result = $data['result'][0]; ?>
<div class="page-content header-clear-medium">
    <h1 class="font-700 font-30 pb-4 text-center">Preview</h1>
    <div class="container p-3">
        <div class="alert bg-fade2-yellow color-theme border border-yellow-dark alert-dismissible rounded-s fade show" role="alert">
            <strong>
                Periksa kembali data yang anda masukkan!
            <br>
                Jika data sudah benar, lanjutkan dengan klik tombol kirim data di bawah.
            </strong>
        </div>
    </div>
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
    <div id="sendWA" class="container pb-4">
        <a href="<?= $data['sendUrl'] ?>" class="btn-full btn gradient-red shadow-bg shadow-bg-m" target="_blank">Kirim data</a>
    </div>
</div>
<?= $this->endSection() ?>