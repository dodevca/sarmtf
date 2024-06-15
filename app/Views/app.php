<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
		<title>SarMTF - Sahabat Aplikasi Retail</title>
		<link rel="stylesheet" type="text/css" href="/ui/styles/bootstrap.css?v=2">
		<link rel="stylesheet" type="text/css" href="/ui/fonts/bootstrap-icons.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700;800&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
		<link rel="manifest" href="/ui/manifest/manifest.webmanifest">
		<meta id="theme-check" name="theme-color" content="#ffc107">
		<link rel="icon" href="/ui/images/logo.png" type="image/x-icon">
		<link rel="apple-touch-icon" sizes="180x180" href="/ui/images/logo.png">
	</head>
	<body class="theme-light">
		<div id="preloader">
			<div class="spinner-border color-highlight" role="status"></div>
		</div>
		<div id="page">
		    <div class="header-bar header-fixed header-app header-bar-detached px-3">
                <?php if($userData['hierarchy'] != null): ?>
                	<a data-bs-toggle="offcanvas" data-bs-target="#menu-main" href="#"><i class="bi bi-list color-theme"></i></a>
                <?php endif; ?>
            	<a href="/" class="header-title color-theme"><img src="/ui/images/logo.png" height="30px"></a>
            </div>
            <!--Footer Nav-->
            <?php if($userData['hierarchy'] == 'admin'): ?>
                <div id="footer-bar" class="footer-bar footer-bar-detached">
                	<a href="/dashboard" class="<?= !empty($page) && $page == 'Dashboard' ? 'active-nav' : '' ?>"><i class="bi bi-house-fill font-16"></i><span>Beranda</span></a>
                	<a href="/dashboard/tabel" class="<?= !empty($page) && $page == 'Export' ? 'active-nav"' : '' ?>"><i class="bi bi-file-earmark-arrow-down-fill font-17"></i><span>Export</span></a>
                	<a href="/dashboard/search" class="<?= !empty($page) && $page == 'Search' ? 'active-nav"' : '' ?>"><i class="bi bi-search font-17"></i><span>Cari</span></a>
                </div>
            <?php endif; ?>
            <!--Footer Nav-->
            <?php if($userData['hierarchy'] != null): ?>
                <div id="menu-main" data-menu-active="nav-homes" style="width:280px;" class="offcanvas offcanvas-start offcanvas-detached rounded-m overflow-visible">
                    <div class="bg-theme mx-3 rounded-m shadow-m mt-3 mb-3">
                    	<div class="d-flex px-2 pb-2 pt-2">
                    		<div>
                    			<a href="#"><img src="/ui/images/avatar.jpg" width="45" class="rounded-s" alt="img"></a>
                    		</div>
                    		<div class="ps-2 align-self-center">
                    			<h5 class="ps-1 mb-0 line-height-xs pt-1"><?= $userData['name'] ?></h5>
                    			<h6 class="ps-1 mb-0 font-400 opacity-40"><?= $userData['email']?></h6>
                    		</div>
                    		<div class="ms-auto">
                    			<a href="#" role="button" data-bs-toggle="dropdown" class="icon icon-m ps-3"><i class="bi bi-three-dots-vertical font-18 color-theme"></i></a>
                    			<div class="dropdown-menu bg-transparent border-0 mt-n1 ms-3">
                    				<div class="card card-style rounded-m shadow-xl mt-1 me-1">
                    					<div class="list-group list-custom list-group-s list-group-flush rounded-xs px-3 py-1">
                    						<a href="/logout" class="color-theme opacity-70 list-group-item py-1"><strong class="font-500 font-12">Log Out</strong><i class="bi bi-chevron-right"></i></a>
                    					</div>
                    				</div>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                    <?php if($userData['hierarchy'] == 'admin'): ?>
                        <span class="menu-divider">Menu</span>
                        <div class="menu-list">
                        	<div class="card card-style rounded-m p-3 py-2 mb-0">
                        	    <a href="/dashboard/surveyor" <?= !empty($page) && $page == 'Surveyor' ? 'class="active-item"' : '' ?>><i class="gradient-green shadow-bg shadow-bg-xs bi bi-people-fill"></i><span>CMO</span><i class="bi bi-chevron-right"></i></a>
                        		<a href="/dashboard/pengaturan" <?= !empty($page) && $page == 'Setting' ? 'class="active-item"' : '' ?>><i class="gradient-red shadow-bg shadow-bg-xs bi bi-gear-fill"></i><span>Pengaturan</span><i class="bi bi-chevron-right"></i></a>
                        	</div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
		    <?= $this->renderSection('page') ?>
		</div>
	    <?= $this->renderSection('modals') ?>
        <script src="/ui/scripts/bootstrap.min.js"></script>
        <script src="/ui/scripts/custom.js"></script>
        <?= $this->renderSection('scripts') ?>
	</body>
</html>