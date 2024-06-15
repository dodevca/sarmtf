<?= $this->extend("app") ?>

<?= $this->section("page") ?>
<div class="page-content header-clear-medium">
    <div class="card card-style">
        <div class="content">
            <div class="d-flex align-items-center justify-content-between gap-3">
                <h1 class="font-700 pb-0">Daftar Unit</h1>
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
            <a href="/dashboard/unit/<?= $result['unitCode'] ?>">
                <div class="card card-style">
                    <div class="content">
                		<div class="d-flex pb-1">
                			<div>
                				<h3><?= $result['name'] ?></h3>
                				<h6 class="mt-n2  opacity-80 color-highlight"><?= $result['unitCode'] ?></h6>
                			</div>
                		</div>
                		<p class="mb-0"><i class="bi bi-building-fill font-16 me-2"></i><?= $result['dealer'] ?></p>
                		<p class="mb-0"><i class="bi bi-tag-fill font-16 me-2"></i><?= $result['price'] ?></p>
                	</div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="container">
            <div class="alert bg-fade-yellow text-dark alert-dismissible rounded-s fade show" role="alert">
            	<strong class="text-dark">Tidak ditemukan Unit.</strong><span class="opacity-60 text-dark"></span>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= form_open('/dashboard/unit/tambah') ?>
    <?= csrf_field() ?>
    <div class="offcanvas offcanvas-bottom rounded-m offcanvas-detached bg-theme" id="menu-submit">
        <div class="content">
            <div class="form-custom form-label form-icon mb-3">
            	<i class="bi bi-person-circle font-14"></i>
            	<input type="text" class="form-control rounded-xs" id="name" name="name" placeholder="Nama unit" required="">
            	<label for="c1" class="color-theme">Nama</label>
            </div>
            <div class="form-custom form-label form-icon mb-3">
				<i class="font-14">Rp</i>
            	<input type="text" class="form-control rounded-xs" id="price" name="price" placeholder="Harga unit" data-type="currency" required="">
            	<label for="c1" class="color-theme">Harga</label>
            </div>
            <div class="form-custom form-label form-icon mb-3">
            	<i class="bi bi-upc font-14"></i>
            	<input type="text" class="form-control rounded-xs" id="unitCode" name="unitCode" placeholder="Kode unit" required="">
            	<label for="c1" class="color-theme">Kode Unit</label>
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
	        <button type="submit" class="btn btn-full gradient-green shadow-bg shadow-bg-s mt-4 w-100">Tambah unit</button>
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