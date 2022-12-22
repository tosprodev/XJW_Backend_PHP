<?php
if ($pname == "Profile"){
	$profile = "active";
}

if ($pname == "Dashboard"){
	$home = "active";
}

if ($pname == "Booking"){
	$booking = "active";
}

if ($pname == "Booking with health fund"){
	$bookinghf = "active";
}
if ($pname == "New Appointment Booking"){
	$newbooking = "active";
}

?>
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto"><a class="navbar-brand" href="https://www.xjwmobilemassage.com.au/"><span class="brand-logo">
                            </span>
                        <h2 class="brand-text"><?php echo $short_app_name;?></h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="<?php echo $home;?> nav-item"><a class="d-flex align-items-center" href="index.php"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Home</span><span class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a> 
                </li>
				
				<li class="<?php echo $newbooking;?> nav-item" ><a class="d-flex align-items-center" href="new_booking.php"><i data-feather='calendar'></i><span class="menu-item text-truncate" data-i18n="Profile">Book Appointment</span></a>
                        </li>
				<li class="<?php echo $booking;?> nav-item" ><a class="d-flex align-items-center" href="booking.php"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg><span class="menu-item text-truncate" data-i18n="Profile">Bookings</span></a>
                        </li>
				<li class="<?php echo $bookinghf;?> nav-item" ><a class="d-flex align-items-center" href="bookinghf.php"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg><span class="menu-item text-truncate" data-i18n="Profile">Bookings (HF)</span></a>
                        </li>
				<li class="<?php echo $profile;?> nav-item" ><a class="d-flex align-items-center" href="profile.php"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg><span class="menu-item text-truncate" data-i18n="Profile">Profile</span></a>
                        </li>
            </ul>
        </div>
    </div>