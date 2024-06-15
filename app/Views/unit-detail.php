<?= $this->extend("app") ?>

<?= $this->section("page") ?>
<div class="page-content header-clear-medium">
    <?php if($data['totalResults'] > 0): ?>
        <div class="card card-style">
            <div class="content">
                <div class="d-flex align-items-center justify-content-between gap-3">
                    <h1 class="font-700 pb-0">unit #<?= $data['unitCode'] ?></h1>
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
                <?= form_open('/dashboard/unit/' . $data['unitCode'] . '/edit') ?>
                    <?= csrf_field() ?>
                    <div class="form-custom form-label form-icon mb-3">
                    	<i class="bi bi-person-circle font-14"></i>
                    	<input type="text" class="form-control rounded-xs" id="name" name="name" placeholder="Nama unit" value="<?= $data['result'][0]['name'] ?>" required="">
                    	<label for="c1" class="color-theme">Nama</label>
                    </div>
                    <div class="form-custom form-label form-icon mb-3">
				        <i class="font-14">Rp</i>
                    	<input type="text" class="form-control rounded-xs" id="price" name="price" placeholder="Harga unit" value="<?= $data['result'][0]['price'] ?>" data-type="currency"  required="">
                    	<label for="c1" class="color-theme">Harga</label>
                    </div>
                    <div class="form-custom form-label form-icon mb-3">
            	        <i class="bi bi-upc font-14"></i>
                    	<input type="text" class="form-control rounded-xs" id="unitCode" name="unitCode" placeholder="Kode unit" value="<?= $data['result'][0]['unitCode'] ?>" required="">
                    	<label for="c1" class="color-theme">Kode Unit</label>
                    </div>
                    <div class="form-custom form-label form-icon mb-3">
                        <i class="bi bi-building font-13"></i>
                        <select class="form-select rounded-xs" id="dealer" name="dealer" aria-label="Floating label select">
                            <option selected="" value="<?= $data['result'][0]['dealer'] ?>"><?= $data['result'][0]['dealer'] ?></option>
                            <?php forEach($data['dealer'] as $dealer): ?>
                                <option value="<?= $dealer['name'] ?>"><?= $dealer['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
        	        <button type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 w-100">Simpan Perubahan</button>
                <?= form_close() ?>
            </div>
        </div>
    <?php else: ?>
        <div class="container">
            <div class="alert bg-fade-yellow text-dark alert-dismissible rounded-s fade show" role="alert">
            	<strong class="text-dark">Tidak ditemukan unit.</strong><span class="opacity-60 text-dark"></span>
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
			Apakah anda yakin akan menghapus unit?
		</p>
		<a href="/dashboard/unit/<?= $data['unitCode'] ?>/hapus" class="default-link btn btn-full btn-s bg-white color-black">Ya, lanjutkan</a>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
  formatCurrency($("input[data-type='currency']"), "blur");
  
	$("input[data-type='currency']").on({
	    keyup: function() {
	      formatCurrency($(this));
	    },
	    blur: function() { 
	      formatCurrency($(this), "blur");
	    }
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