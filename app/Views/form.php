<?= $this->extend("app") ?>

<?= $this->section("page") ?>
<div class="page-content header-clear-medium">
	<div class="card card-style py-3">
		<div class="content px-2 text-center">
			<h2>Kirim data Baru</h2>
            <?php if(session()->has('errors')): ?>
                <div class="alert bg-fade-red alert-dismissible rounded-s fade show" role="alert">
                    <ul class="list-unstyled">
                        <?php foreach(session('errors') as $error) : ?>
                            <li><p class="text-dark"><?= $error ?></p></li>
                        <?php endforeach ?>
                    </ul>
                	<button type="button" class="btn-close opacity-20 font-11 pt-3 mt-1" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php else: ?>
    			<p class="mb-3">
    				Mulai menambahkan data baru.
    			</p>
    		<?php endif; ?>
			<a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-1" class="default-link btn btn-m rounded-s gradient-green shadow-bg shadow-bg-s px-5 mb-0 mt-2"><i class="bi bi-pen font-15 me-2"></i>Isi Form</a>
		</div>
	</div>
	<div class="card card-style py-3">
		<div class="content mx-1">
		    <h2 class="mb-4 text-center">Pricelist</h2>
	        <?php if($data['pricelist'] != null || !empty($data['setting'][0]['pricelist'])): ?>
                <div class="splide single-slider slider-dots-under slider-boxed splide--loop splide--ltr splide--draggable is-active" id="single-slider-1" style="visibility: visible;">
                	<div class="splide__arrows">
                		<button class="splide__arrow splide__arrow--prev" type="button" aria-controls="single-slider-1-track" aria-label="Previous slide">
                			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40">
                				<path d="m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z"></path>
                			</svg>
                		</button>
                		<button class="splide__arrow splide__arrow--next" type="button" aria-controls="single-slider-1-track" aria-label="Next slide">
                			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40">
                				<path d="m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z"></path>
                			</svg>
                		</button>
                	</div>
                	<div class="splide__track" id="single-slider-1-track">
                		<div class="splide__list" id="single-slider-1-list">
                            <?php forEach($data['pricelist'] as $pricelist): ?>
                			    <div class="splide__slide splide__slide--clone" aria-hidden="true" tabindex="-1">
                    				<div class="card rounded-m shadow-l pt-3">
        				                <img src="/uploads/pricelists/<?= $pricelist ?>" class="img-fluid rounded-s" alt="img">
        				                <div class="card-top text-end" style="opacity: 0.7">
			                                <a href="/uploads/pricelists/<?= $pricelist ?>" class="default-link btn btn-m rounded gradient-dark shadow-bg shadow-bg-s py-1 px-2"><i class="bi bi-arrows-fullscreen font-14"></i></a>
                                        </div>
                    				</div>
                    			</div>
    		                <?php endforeach; ?>
                		</div>
                	</div>
                </div>
    		<?php else: ?>
    		    <div class="alert bg-fade-yellow alert-dismissible rounded-s fade show mx-3" role="alert">
    		        <p class="text-dark">Belum ada pricelist</p>
                </div>
    		<?php endif; ?>
	    </div>
	</div>
</div>
<?= form_open_multipart('/formulir/submit') ?>
    <?= csrf_field() ?>
	<div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-step-1">
		<div class="content">
			<div class="d-flex" style="z-index:1">
				<div><a href="#" class="icon icon-xs rounded-s bg-green-dark">1</a></div>
				<div class="mx-auto"><a href="#" class="icon icon-xs rounded-s bg-gray-dark">2</a></div>
				<div><a href="#" class="icon icon-xs rounded-s bg-gray-dark">3</a></div>
				<div class="mx-auto"><a href="#" class="icon icon-xs rounded-s bg-gray-dark">4</a></div>
				<div><a href="#" class="icon icon-xs rounded-s bg-gray-dark">5</a></div>
			</div>
			<div class="divider" style="z-index:-1; margin-top:-19px;"></div>
			<h1 class="font-18 font-800 mt-5">Data Sales</h1>
			<div class="form-custom form-label form-border form-icon mb-3 bg-transparent">
				<i class="bi bi-person-fill font-15"></i>
				<input type="text" class="form-control rounded-xs" id="sales" name="sales" placeholder="Nama Sales" />
				<label for="c1" class="color-theme">Nama</label>
				<span>*</span>
			</div>
			<div class="form-custom form-label form-border form-icon mb-3 bg-transparent">
				<i class="bi bi-building-fill font-15"></i>
				<input type="text" class="form-control rounded-xs" id="dealer" name="dealer" placeholder="Nama Dealer" />
				<label for="c1" class="color-theme">Dealer</label>
				<span>*</span>
			</div>
			<a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-2" class="btn btn-full gradient-blue shadow-bg shadow-bg-s mt-4">Lanjutkan</a>
		</div>
	</div>
	<div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-step-2">
		<div class="content">
			<div class="d-flex" style="z-index:1">
				<div><a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-1" class="icon icon-xs rounded-s bg-blue-dark"><i class="bi bi-check-circle-fill font-16"></i></a></div>
				<div class="mx-auto"><a href="#" class="icon icon-xs rounded-s bg-green-dark">2</a></div>
				<div><a href="#" class="icon icon-xs rounded-s bg-gray-dark">3</a></div>
				<div class="mx-auto"><a href="#" class="icon icon-xs rounded-s bg-gray-dark">4</a></div>
				<div><a href="#" class="icon icon-xs rounded-s bg-gray-dark">5</a></div>
			</div>
			<div class="divider" style="z-index:-1; margin-top:-19px;"></div>
			<h1 class="font-18 font-800 mt-5">Data Pembeli</h1>
			<div class="form-custom form-label form-border form-icon mb-3 bg-transparent">
				<i class="bi bi-person-fill font-15"></i>
				<input type="text" class="form-control rounded-xs" id="nama" name="name" placeholder="Nama Pembeli" />
				<label for="c1" class="color-theme">Nama</label>
				<span>*</span>
			</div>
			<div class="form-custom form-label form-border form-icon mb-3 bg-transparent">
				<i class="bi bi-telephone-fill font-15"></i>
				<input type="tel" class="form-control rounded-xs" id="nohp" name="phoneNumber" placeholder="No. HP" />
				<label for="c1" class="color-theme">No. HP</label>
				<span>*</span>
			</div>
			<div class="form-custom form-label form-border form-icon mb-3 bg-transparent">
				<i class="bi bi-map font-15"></i>
				<textarea class="form-control rounded-xs" placeholder="Masukkan alamat..." id="alamat" name="address" ></textarea>
				<label for="c1" class="color-theme">Alamat</label>
				<span>*</span>
			</div>
			<div class="file-data">
				<img id="image-data" src="/ui/images/empty.png" class="img-fluid rounded-s" alt="img">
				<div>
					<input type="file" name="ktp1" class="upload-file" accept="image/*">
					<p class="btn border-mint-dark color-mint-dark text-start font-700 rounded-s upload-file-text w-100"><i class="bi bi-arrow-up pe-3 ms-n1"></i>  Upload KTP Pembeli</p>
				</div>
			</div>
			<div class="file">
				<img id="ktp-2" src="/ui/images/empty.png" class="img-fluid rounded-s mb-2 mt-2 mx-auto" alt="img">
				<div>
					<input type="file" name="ktp2" onchange="document.getElementById('ktp-2').src = window.URL.createObjectURL(this.files[0])" class="upload-file" accept="image/*">
					<p class="btn border-mint-dark color-mint-dark text-start font-700 rounded-s upload-file-text w-100"><i class="bi bi-arrow-up pe-3 ms-n1"></i> Upload KTP Penjamin</p>
				</div>
			</div>
			<a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-3" class="btn btn-full gradient-blue shadow-bg shadow-bg-s mt-4">Lanjutkan</a>
		</div>
	</div>
	<div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-step-3">
		<div class="content">
			<div class="d-flex" style="z-index:1">
				<div><a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-1" class="icon icon-xs rounded-s bg-blue-dark"><i class="bi bi-check-circle-fill font-16"></i></a></div>
				<div class="mx-auto"><a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-2" class="icon icon-xs rounded-s bg-blue-dark"><i class="bi bi-check-circle-fill font-16"></i></a></div>
				<div><a href="#" class="icon icon-xs rounded-s bg-green-dark">3</a></div>
				<div class="mx-auto"><a href="#" class="icon icon-xs rounded-s bg-gray-dark">4</a></div>
				<div><a href="#" class="icon icon-xs rounded-s bg-gray-dark">5</a></div>
			</div>
			<div class="divider" style="z-index:-1; margin-top:-19px;"></div>
			<h1 class="font-18 font-800 mt-5">Data Unit</h1>
			
			<div class="form-custom form-label form-border form-icon mb-3 bg-transparent">
				<i class="bi bi-person-fill font-15"></i>
				<input type="text" class="form-control rounded-xs" id="unit" name="unit" placeholder="Type unit" />
				<label for="c1" class="color-theme">Type Unit</label>
			</div>
			
			<div class="form-custom form-label form-border form-icon mb-3 bg-transparent">
				<i class="font-16">Rp</i>
				<input type="text" id="harga" name="price" class="form-control rounded-xs" data-type="currency" placeholder="200.000.000"/>
				<label for="harga" class="color-theme">Harga</label>
				<!--<span>*</span>-->
			</div>
			
			<div class="form-custom form-label form-border form-icon mb-3 bg-transparent">
				<i class="bi bi-calendar-range-fill font-15"></i>
				<input type="text" class="form-control rounded-xs" id="tenor" name="tenor" placeholder="Masukkan tenor" />
				<label for="c1" class="color-theme">Tenor</label>
			</div>
			
			<div class="form-custom form-label form-border form-icon mb-3 bg-transparent">
				<i class="bi bi-tags-fill font-15"></i>
				<input type="text" class="form-control rounded-xs" id="package" name="package" placeholder="DP %" />
				<label for="c1" class="color-theme">DP %</label>
			</div>
			
			<a href="#" class="d-flex pb-2" data-trigger-switch="switch-4c">
				<div class="align-self-center">
					<h6 class="mb-0 font-12">Asuransi</h6>
				</div>
				<div class="ms-auto align-self-center">
					<div class="form-switch ios-switch switch-green switch-l">
						<input type="checkbox" name="insurance" class="ios-input" id="switch-4c">
						<label class="custom-control-label" for="switch-4c"></label>
					</div>
				</div>
			</a>
			<a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-4" class="btn btn-full gradient-blue shadow-bg shadow-bg-s mt-4">Lanjutkan</a>
		</div>
	</div>
	<div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-step-4">
		<div class="content">
			<div class="d-flex" style="z-index:1">
				<div><a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-1" class="icon icon-xs rounded-s bg-blue-dark"><i class="bi bi-check-circle-fill font-16"></i></a></div>
				<div class="mx-auto"><a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-2" class="icon icon-xs rounded-s bg-blue-dark"><i class="bi bi-check-circle-fill font-16"></i></a></div>
				<div><a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-3" class="icon icon-xs rounded-s bg-blue-dark"><i class="bi bi-check-circle-fill font-16"></i></a></div>
				<div class="mx-auto"><a href="#" class="icon icon-xs rounded-s bg-green-dark">4</a></div>
				<div><a href="#" class="icon icon-xs rounded-s bg-gray-dark">5</a></div>
			</div>
			<div class="divider" style="z-index:-1; margin-top:-19px;"></div>
			<h1 class="font-18 font-800 mt-5">Data Survey</h1>
			<div class="form-custom form-label form-icon mb-3 mt-3">
				<i class="bi bi-calendar font-12"></i>
				<input type="date" name="date" class="form-control rounded-xs" id="c5" />
				<label for="c5" class="color-theme">Tanggal Survey</label>
				<div class="valid-feedback">HTML5 does not offer Dates Field Validation!</div>
			</div>
			<div class="form-custom form-label form-icon mb-3">
				<i class="bi bi-person-vcard font-13"></i>
				<select name="surveyor" class="form-select rounded-xs" id="c6" aria-label="Floating label select example">
					<option selected="">Nama CMO</option>
					<?php foreach ($data["surveyors"] as $surveyor): ?>
					<option value="<?= $surveyor["name"] ?>"><?= $surveyor["name"] ?></option>
					<?php endforeach; ?>
				</select>
				<label for="c1" class="color-theme">Nama CMO</label>
				<div class="valid-feedback">HTML5 does not offer Dates Field Validation!</div>
			</div>
			<a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-5" class="btn btn-full gradient-blue shadow-bg shadow-bg-s mt-4">Lanjutkan</a>
		</div>
	</div>
	<div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-step-5">
		<div class="content">
			<div class="d-flex" style="z-index:1">
				<div><a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-1" class="icon icon-xs rounded-s bg-blue-dark"><i class="bi bi-check-circle-fill font-16"></i></a></div>
				<div class="mx-auto"><a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-2" class="icon icon-xs rounded-s bg-blue-dark"><i class="bi bi-check-circle-fill font-16"></i></a></div>
				<div><a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-3" class="icon icon-xs rounded-s bg-blue-dark"><i class="bi bi-check-circle-fill font-16"></i></a></div>
				<div class="mx-auto"><a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-4" class="icon icon-xs rounded-s bg-blue-dark"><i class="bi bi-check-circle-fill font-16"></i></a></div>
				<div><a href="#" class="icon icon-xs rounded-s bg-green-dark">5</a></div>
			</div>
			<div class="divider" style="z-index:-1; margin-top:-19px;"></div>
			<h1 class="font-18 font-800 mt-5">Lokasi</h1>
			<p class="location-support"></p>
			<textarea name="geo" class="location-coordinates d-none"></textarea>
			<a href="#" class="get-location btn btn-full btn-m bg-red-dark rounded-s text-uppercase shadow-l font-900 mb-4">Bagikan Lokasi</a>
			<div class="responsive-iframe add-iframe">
				<iframe class="location-map" src="https://www.openstreetmap.org/export/embed.html?bbox=-74.04914975166322%2C40.68780568731773%2C-74.0420687198639%2C40.691909864093816&amp;layer=hot"></iframe>
			</div>
			<script type="text/javascript" src="/ui/plugins/geo.js"></script>
			<a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-6" class="btn btn-full gradient-blue shadow-bg shadow-bg-s mt-4">Lanjutkan</a>
		</div>
	</div>
	<div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-step-6">
		<div class="content">
			<div class="d-flex" style="z-index:1">
				<div><a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-1" class="icon icon-xs rounded-s bg-blue-dark"><i class="bi bi-check-circle-fill font-16"></i></a></div>
				<div class="mx-auto"><a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-2" class="icon icon-xs rounded-s bg-blue-dark"><i class="bi bi-check-circle-fill font-16"></i></a></div>
				<div><a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-3" class="icon icon-xs rounded-s bg-blue-dark"><i class="bi bi-check-circle-fill font-16"></i></a></div>
				<div class="mx-auto"><a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-4" class="icon icon-xs rounded-s bg-blue-dark"><i class="bi bi-check-circle-fill font-16"></i></a></div>
				<div><a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-step-5" class="icon icon-xs rounded-s bg-blue-dark"><i class="bi bi-check-circle-fill font-16"></i></a></div>
			</div>
			<div class="divider" style="z-index:-1; margin-top:-19px;"></div>
			<h1 class="font-18 font-800 mt-5">Selesai</h1>
			<button type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 w-100">Kirim</button>
		</div>
	</div>
<?= form_close() ?>
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$("input[data-type='currency']").on({
	    keyup: function() {
	      formatCurrency($(this));
	    },
	   // blur: function() { 
	   //   formatCurrency($(this), "blur");
	   // }
	});
	
	function formatNumber(n) {
	  // format number 1000000 to 1,234,567
	  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
	}
	
	function formatCurrency(input, blur) {
	  // appends $ to value, validates decimal side
	  // and puts cursor back in right position.
	  
	  // get input value
	  var input_val = input.val();
	  
	  // don't validate empty input
	  if (input_val === "") { return; }
	  
	  // original length
	  var original_len = input_val.length;
	
	  // initial caret position 
	  var caret_pos = input.prop("selectionStart");
	    
	  // check for decimal
	  if (input_val.indexOf(",") >= 0) {
	
	    // get position of first decimal
	    // this prevents multiple decimals from
	    // being entered
	    var decimal_pos = input_val.indexOf(",");
	
	    // split number by decimal point
	    var left_side = input_val.substring(0, decimal_pos);
	    var right_side = input_val.substring(decimal_pos);
	
	    // add commas to left side of number
	    left_side = formatNumber(left_side);
	
	    // validate right side
	    right_side = formatNumber(right_side);
	    
	    // On blur make sure 2 numbers after decimal
	    if (blur === "blur") {
	      right_side += "00";
	    }
	    
	    // Limit decimal to only 2 digits
	    right_side = right_side.substring(0, 2);
	
	    // join number by .
	    input_val = "" + left_side + "," + right_side;
	
	  } else {
	    // no decimal entered
	    // add commas to number
	    // remove all non-digits
	    input_val = formatNumber(input_val);
	    input_val = "" + input_val;
	    
	    // final formatting
	    if (blur === "blur") {
	      input_val += ",00";
	    }
	  }
	  
	  // send updated string to input
	  input.val(input_val);
	
	  // put caret back in the right position
	  var updated_len = input_val.length;
	  caret_pos = updated_len - original_len + caret_pos;
	  input[0].setSelectionRange(caret_pos, caret_pos);
	}
</script>
<?= $this->endSection() ?>