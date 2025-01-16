<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <ul class="sidebar-menu">
    <li class="header">DANH MỤC CHÍNH</li>
    <li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=DB"><i class="fa fa-calendar"></i><span>LỊCH CÔNG VIỆC</span></a>
	</li>
    <li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=LIST"><i class="fa fa-newspaper-o"></i><span>QUẢN LÝ CÔNG VIỆC</span></a>
	</li>
	<li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=USERS"><i class="fa fa-users"></i><span>THÔNG TIN TÀI KHOẢN</span></a>
	</li>
	<li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=CONTACT"><i class="fa fa-map-marker"></i><span>LIÊN HỆ</span></a>
	</li>

	<?php 
	$type = $_SESSION['calendar_fd_user']['type'];
	if($type == 'admin') {
	?>
	<li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=STATISTICS">
			<i class="fa fa-bar-chart"></i>
			<span>THỐNG KÊ</span>
		</a>
	</li>
	<?php
	}
	else{?>

	<li class="treeview"> 
		<a href="<?php echo WEB_ROOT; ?>views/?v=STATISTICS_NORMAL">
			<i class="fa fa-bar-chart"></i>
			<span>THỐNG KÊ CÁ NHÂN</span>
		</a>
	</li>
	<?php
	}
	?>

  </ul>
</section>
<!-- /.sidebar -->