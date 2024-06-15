<?= $this->extend("app") ?>

<?= $this->section("page") ?>
<div class="page-content header-clear-medium">
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
    <div class="card card-style">
        <div class="content">
            <h1 class="font-700 mb-4">Pengaturan Akun</h1>
            <?= form_open('/dashboard/pengaturan/simpan') ?>
                <?= csrf_field() ?>
            	<input type="text" class="d-none" id="targetResult" name="targetResult" value="account" required="">
                <div class="form-custom form-label form-icon mb-3">
                	<i class="bi bi-person-circle font-14"></i>
                	<input type="text" class="form-control rounded-xs" id="name" name="name" placeholder="Nama" value="<?= $data['account'][0]['name'] ?>" required="">
                	<label for="c1" class="color-theme">Nama</label>
                </div>
                <div class="form-custom form-label form-icon mb-3">
                	<i class="bi bi-envelope font-14"></i>
                	<input type="text" class="form-control rounded-xs" id="email" name="email" placeholder="Email" value="<?= $data['account'][0]['email'] ?>" required="">
                	<label for="c1" class="color-theme">Email</label>
                </div>
                <div class="form-custom form-label form-icon mb-3">
                	<i class="bi bi-lock font-14"></i>
                	<input type="text" class="form-control rounded-xs" id="password" name="password" placeholder="Password" value="<?= $data['account'][0]['password'] ?>" required="">
                	<label for="c1" class="color-theme">Password</label>
                </div>
    	        <button type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 w-100">Simpan Perubahan</button>
            <?= form_close() ?>
        </div>
    </div>
    <div class="card card-style">
        <div class="content">
            <h1 class="font-700 mb-4">Pengaturan Lainnya</h1>
            <?= form_open('/dashboard/pengaturan/simpan') ?>
                <?= csrf_field() ?>
            	<input type="text" class="d-none" id="targetResult" name="targetResult" value="setting" required="">
                <div class="form-custom form-label form-icon mb-3">
                	<i class="bi bi-whatsapp font-14"></i>
                	<input type="text" class="form-control rounded-xs" id="whatsApp" name="whatsApp" placeholder="Nomor whatsApp" value="<?= $data['setting'][0]['whatsAppNumber'] ?>" required="">
                	<label for="c1" class="color-theme">Nomor WhatsApp</label>
                </div>
    	        <button type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 w-100">Simpan Perubahan</button>
            <?= form_close() ?>
        </div>
    </div>
    <div class="card card-style">
        <div class="content">
            <h1 class="font-700 mb-4">Pengaturan Pricelist</h1>
            <?= form_open_multipart('/dashboard/pengaturan/simpan') ?>
                <?= csrf_field() ?>
            	<input type="text" class="d-none" id="targetResult" name="targetResult" value="pricelist" required="">
    			<div class="file-data">
                    <?php if($data['setting'][0]['pricelist'] != null || !empty($data['setting'][0]['pricelist'])): ?>
                        <?php forEach($data['setting'][0]['pricelist'] as $pricelist): ?>
    				        <img id="pricelist" src="/uploads/pricelists/<?= $pricelist ?>" class="img-fluid rounded-s mb-3" alt="img">
    				    <?php endforeach; ?>
            		<?php else: ?>
            		    <div class="alert bg-fade-yellow alert-dismissible rounded-s fade show" role="alert">
            		        <p class="text-dark">Belum ada pricelist</p>
                        </div>
            		<?php endif; ?>
    				<div>
    					<input type="file" id="image" name="images[]" class="upload-file" accept="image/*" onchange="javascript:updateList()" multiple>
    					<p class="btn border-mint-dark color-mint-dark text-start font-700 rounded-s upload-file-text w-100"><i class="bi bi-table pe-3 ms-n1"></i> Unggah pricelist baru</p>
    				</div>
    				<div id="fileList"></div>
    			</div>
    	        <button type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 w-100">Simpan Perubahan</button>
            <?= form_close() ?>
        </div>
    </div>
</div>    
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript">
updateList = function() {
    var input = document.getElementById('image');
    var output = document.getElementById('fileList');
    var children = "";
    for (var i = 0; i < input.files.length; ++i) {
        children += '<li>' + input.files.item(i).name + '</li>';
    }
    output.innerHTML = '<p class="mt-4 mb-2 fw-bold">Gambar dipilih:</p><ul class="ps-3">'+children+'</ul>';
}
</script>
<?= $this->endSection() ?>