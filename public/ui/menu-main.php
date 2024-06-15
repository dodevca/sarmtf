<?php 
if (isset($_GET['uName'])) {?>
<div class="bg-theme mx-3 rounded-m shadow-m mt-3 mb-3">
	<div class="d-flex px-2 pb-2 pt-2">
		<div>
			<a href="#"><img src="/ui/images/avatar.jpg" width="45" class="rounded-s" alt="img"></a>
		</div>
		<div class="ps-2 align-self-center">
			<h5 class="ps-1 mb-0 line-height-xs pt-1"><?php echo $_GET['uName'];?></h5>
			<h6 class="ps-1 mb-0 font-400 opacity-40"><?php echo $_GET['uHierarchy'];?></h6>
		</div>
		<div class="ms-auto">
			<a href="#" data-bs-toggle="dropdown" class="icon icon-m ps-3"><i class="bi bi-three-dots-vertical font-18 color-theme"></i></a>
			<div class="dropdown-menu  bg-transparent border-0 mt-n1 ms-3">
				<div class="card card-style rounded-m shadow-xl mt-1 me-1">
					<div class="list-group list-custom list-group-s list-group-flush rounded-xs px-3 py-1">
						<a href="/logout.php" class="color-theme opacity-70 list-group-item py-1"><strong class="font-500 font-12">Log Out</strong><i class="bi bi-chevron-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if (isset($_GET['uHierarchy'])) { ?>

<?php if ($_GET['uHierarchy'] == 'admin') { ?>
<span class="menu-divider">Menu Admin</span>
<div class="menu-list">
	<div class="card card-style rounded-m p-3 py-2 mb-0">
		<a href="/dashboard" id="nav-homes"><i class="gradient-blue shadow-bg shadow-bg-xs bi bi-house-fill"></i><span>Dashboard</span><i class="bi bi-chevron-right"></i></a>
		<a href="/kelola" id="nav-comps"><i class="gradient-red shadow-bg shadow-bg-xs bi bi-server"></i><span>Kelola Data</span><i class="bi bi-chevron-right"></i></a>
		<a href="/report" id="nav-comps"><i class="gradient-green shadow-bg shadow-bg-xs bi bi-list-nested"></i><span>Laporan</span><i class="bi bi-chevron-right"></i></a>
	</div>
</div>
<?php } else { ?>
<span class="menu-divider">Menu Sales</span>
<div class="menu-list">
	<div class="card card-style rounded-m p-3 py-2 mb-0">
		<a href="/" id="nav-homes"><i class="gradient-blue shadow-bg shadow-bg-xs bi bi-house-fill"></i><span>Home</span><i class="bi bi-chevron-right"></i></a>
		<a href="/formulir" id="nav-comps"><i class="gradient-red shadow-bg shadow-bg-xs bi bi-plus"></i><span>Order Baru</span><i class="bi bi-chevron-right"></i></a>
	</div>
</div>
<?php } ?>
<?php } ?>

<?php
} else {
?>

<div class="bg-theme mx-3 rounded-m shadow-m mt-3 mb-3">
</div>

<span class="menu-divider mt-3">Menu</span>
<div class="menu-list">
	<div class="card card-style rounded-m p-3 py-2 mb-0">
		<a href="/?login" id="nav-comps"><i class="gradient-red shadow-bg shadow-bg-xs bi bi-login"></i><span>Login</span><i class="bi bi-chevron-right"></i></a>
	</div>
</div>
<?php
}
?>

<span class="menu-divider mt-4">Mode</span>
<div class="menu-list">
	<div class="card card-style rounded-m p-3 py-2 mb-0">

		<a href="#" data-toggle-theme data-trigger-switch="switch-1">
			<i class="gradient-dark shadow-bg shadow-bg-xs bi bi-moon-fill font-13"></i>
			<span>Dark Mode</span>
			<div class="form-switch ios-switch switch-green switch-s me-2">
				<input type="checkbox" data-toggle-theme class="ios-input" id="switch-1">
				<label class="custom-control-label" for="switch-1"></label>
			</div>
		</a>
	</div>
</div>


<p class="text-center mb-0 mt-n3 pb-3 font-9 text-uppercase font-600 color-theme"> &copy; 2023 Team SAR.</p>
