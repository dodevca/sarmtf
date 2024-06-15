<?= $this->extend("app") ?>

<?= $this->section("page") ?>
<div class="page-content header-clear-medium">
    <div class="card card-style">
    	<div class="content mb-0">
    		<!--<h5 class="color-highlight font-13 mb-n1"></h5>-->
    		<h1 class="font-700 mb-4">Cari</h1>
    		<?= form_open('', ['method' => 'GET']) ?>
        		<p class="mb-3">
        		    <div class="form-custom form-label form-icon mb-3">
                    	<i class="bi bi-search font-14"></i>
                    	<input type="text" class="form-control rounded-xs" id="c1" name="q" placeholder="<?= !empty($data['query']) ? $data['query'] : 'Masukkan nama, unit atau id' ?>" pattern="[A-Za-z ]{1,32}" required="">
                    	<label for="c1" class="form-label-always-active color-blue-dark">Cari disini</label>
                    	<div class="invalid-feedback">Kata kunci tidak valid</div>
                    </div>
        		</p>
                <button type="submit" class="btn-full btn gradient-yellow shadow-bg shadow-bg-m w-100 mb-4">Cari</button>
    		<?= form_close() ?>
    	</div>
    </div>
    <?php if(!empty($data['query'])): ?>
        <?php if($data['totalResults'] > 0): ?>
            <div class="mt-4">
                <?php forEach($data['results'] as $item): ?>
                    <a href="/dashboard/view/<?= $item['uid'] ?>">
                        <div class="card card-style">
                    	    <div class="content">
                        		<div class="d-flex pb-1">
                        			<div>
                        				<h6 class="mt-n2  opacity-80 color-highlight">#<?= $item['uid'] ?></h6>
                        				<h3><?= $item['unit'] ?></h3>
                        			</div>
                        		</div>
                        		<p class="mb-2"><i class="bi bi-person-fill font-16 me-3"></i><?= $item['name'] ?></p>
                        		<p class="mb-2"><i class="bi bi-calendar-fill font-16 me-3"></i><?= $item['date'] ?></p>
                        	</div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="container">
                <div class="alert bg-fade-yellow text-dark alert-dismissible rounded-s fade show" role="alert">
                	<strong class="text-dark">Tidak ditemukan data</strong><span class="opacity-60 text-dark"> - Pastikan kata kunci dimasukkan dengan benar.</span>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>