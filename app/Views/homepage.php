<?= $this->extend('app') ?>

<?= $this->section('page') ?>
<div class="page-content header-clear-medium">
    <div class="splide single-slider slider-no-dots slider-no-arrows slider-boxed text-center mt-n2" id="single-slider-3">
    	<div class="splide__track">
    		<div class="splide__list">
    			<div class="splide__slide">
    				<div class="card card-style mx-0 shadow-card shadow-card-m bg-14" data-card-height="230">
    					<div class="card-bottom pb-3 px-3">
    						<h3 class="color-white mb-1">SARMTF.com</h3>
    						<p class="color-white opacity-80 mb-0 mt-n1 font-14">Sahabat Aplikasi Retail by MTF</p>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="card card-style py-3">
		<div class="content px-2 text-center">
			<h2>Menambahkan Order</h2>
    			<p class="mb-3">
    				Mulai menambahkan order baru.
    			</p>
			<a href="/formulir" class="default-link btn btn-m rounded-s gradient-green shadow-bg shadow-bg-s px-5 mb-0 mt-2">Isi Form</a>
		</div>
	</div>
    <div class="card card-style py-3">
    	<div class="content px-2">
    	    <form action="/login" method="POST">
        		<h1 class="text-center font-800 font-30 mb-4">Login</h1>
        		<?php if (session()->has('errors')) : ?>
                    <div class="alert bg-fade-red color-red-dark alert-dismissible rounded-s fade show" role="alert">
                    	<strong class="text-dark"><?= session()->getFlashdata('errors') ?></strong>
                    	<button type="button" class="btn-close opacity-20 font-11 pt-3 mt-1" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
        		<div class="form-custom form-label form-icon mb-3">
        			<i class="bi bi-person-circle font-14"></i>
        			<input type="text" name="email" class="form-control rounded-xs" id="c1" placeholder="E-mail">
        			<label for="c1" class="color-theme">Username / E-mail</label>
        			<span>(required)</span>
        		</div>
        		<div class="form-custom form-label form-icon mb-3">
        			<i class="bi bi-asterisk font-12"></i>
        			<input type="password" name="password" class="form-control rounded-xs" id="c2" placeholder="********">
        			<label for="c2" class="color-theme">Password</label>
        			<span>(required)</span>
        		</div>
        		<button type="submit" class="btn rounded-sm btn-m gradient-green text-uppercase font-700 mt-4 mb-3 btn-full shadow-bg shadow-bg-s">Sign In</button>
    		</form>
    	</div>
    </div>
</div>
<?= $this->endSection() ?>