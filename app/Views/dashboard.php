<?= $this->extend("app") ?>

<?= $this->section("page") ?>
<div class="page-content header-clear-medium">
    <?php if (session()->has('success')): ?>
        <div class="container">
            <div class="alert bg-fade-green alert-dismissible rounded-s fade show" role="alert">
            	<strong class="text-dark"><?= session()->getFlashdata('success') ?></strong>
            	<button type="button" class="btn-close opacity-20 font-11 pt-3 mt-1" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>
    <div class="container">
        <h2 class="font-700 mb-4">Order Terbaru</h2>
    </div>
    <?php if(count($data['recents']) > 0): ?>
        <div class="mt-4">
            <?php forEach($data['recents'] as $item): ?>
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
	<div class="divider m-3"></div>
    <div class="mt-4">
        <div class="card card-style">
        	<div class="card-body px-0 py-3">
        		<h5 class="font-700 px-3 mb-3">Sales Teratas</h5>
        		<div class="divider mb-0 mx-3"></div>
                <?php if(count($data['topSales']) > 0): ?>
                    <?php forEach($data['topSales'] as $item): ?>
                		<div class="list-group list-custom list-group-m rounded-xs list-group-flush px-3">
                			<div class="list-group-item">
                				<div><?= $item['sales'] ?></div>
                				<span class="badge rounded-xl bg-green-dark"><?= $item['total'] ?></span>
                			</div>
                		</div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert bg-fade-yellow text-dark alert-dismissible rounded-s fade show" role="alert">
                    	<strong class="text-dark">Tidak ditemukan data</strong><span class="opacity-60 text-dark"></span>
                    </div>
                <?php endif; ?>
        	</div>
        </div>
    </div>
	<div class="divider m-3"></div>
    <div class="mt-4">
        <div class="card card-style">
        	<div class="card-body px-0 py-3">
        		<h5 class="font-700 px-3 mb-3">Dealer Teratas</h5>
        		<div class="divider mb-0 mx-3"></div>
                <?php if(count($data['topSales']) > 0): ?>
                    <?php forEach($data['topDealer'] as $item): ?>
                		<div class="list-group list-custom list-group-m rounded-xs list-group-flush px-3">
                			<div class="list-group-item">
                				<div><?= $item['dealer'] ?></div>
                				<span class="badge rounded-xl bg-green-dark"><?= $item['total'] ?></span>
                			</div>
                		</div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert bg-fade-yellow text-dark alert-dismissible rounded-s fade show" role="alert">
                    	<strong class="text-dark">Tidak ditemukan data</strong><span class="opacity-60 text-dark"></span>
                    </div>
                <?php endif; ?>
        	</div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>