<?php 
// Khởi tạo biến
$utype = ''; 
$records = []; // Khởi tạo $records như mảng rỗng để tránh lỗi
$uid = $_SESSION['calendar_fd_user']['id']; // Lấy ID của người dùng đang đăng nhập

// Lấy thông tin người dùng
$type = $_SESSION['calendar_fd_user']['type'];
if($type == 'normal'|| $type=='boss') {
    $utype = 'on';
}


// Lấy dữ liệu booking
$records = getBookingRecords();
if (!is_array($records)) {
    $records = []; // Đảm bảo $records là một mảng
}
?>


<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Danh sách công việc</h3>
      <!-- Thanh tìm kiếm -->
      <div class="box-tools">
        <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm...">
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered" id="bookingTable">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Tên</th>
            <th>Email</th>
            <th>SĐT</th>
            <th>Ngày công tác</th>
            <th style="width: 140px">Số ngày thực hiện</th>
            <th style="width: 100px">Trạng thái</th>
            <?php if($utype == 'on') { ?>
            <th>Thao tác</th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <?php
          $idx = 1;
          foreach($records as $rec) {
            extract($rec);
            $stat = '';
            if($status == "PENDING") {$stat = 'warning';}
            else if ($status == "APPROVED") {$stat = 'success';}
            else if($status == "DENIED") {$stat = 'danger';}
          ?>
          <tr>
            <td><?php echo $idx++; ?></td>
            <td><a href="<?php echo WEB_ROOT; ?>views/?v=USER&ID=<?php echo $user_id; ?>"><?php echo strtoupper($user_name); ?></a></td>
            <td><?php echo $user_email; ?></td>
            <td><?php echo $user_phone; ?></td>
            <td><?php echo $res_date; ?></td>
            <td><?php echo $count; ?></td>
            <td><span class="label label-<?php echo $stat; ?>"><?php echo $status; ?></span></td>
            <?php if($utype == 'on' && $user_id==$uid) { ?>
            <td><?php if($status == "PENDING" ) { ?>
              <a href="javascript:approve('<?php echo $uid?>');">Approve</a>&nbsp;/
              &nbsp;<a href="javascript:decline('<?php echo $uid ?>');">Denied</a>&nbsp;
              <!-- &nbsp;<a href="javascript:deleteUser('<?php echo $user_id ?>');">Delete</a> -->
              <?php } else { ?>
              <!-- <a href="javascript:deleteUser('<?php echo $user_id ?>');">Delete</a> -->
              <?php }//else ?>
            </td>
            <?php } ?>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
      <?php echo generatePagination(); ?> 
    </div>
  </div>
  <!-- /.box -->
</div>

<script language="javascript">
// Lọc dữ liệu trong bảng
document.getElementById('searchInput').addEventListener('keyup', function() {
    var input = this.value.toLowerCase();
    var rows = document.querySelectorAll('#bookingTable tbody tr');
    rows.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        row.style.display = text.includes(input) ? '' : 'none';
    });
});
</script>

<script language="javascript">
function approve(userId) {
	if(confirm('Are you sure you wants to Approve it ?')) {
		window.location.href = '<?php echo WEB_ROOT; ?>api/process.php?cmd=regConfirm&action=approve&userId='+userId;
	}
}
function decline(userId) {
	if(confirm('Are you sure you wants to Decline the Booking ?')) {
		window.location.href = '<?php echo WEB_ROOT; ?>api/process.php?cmd=regConfirm&action=denide&userId='+userId;
	}
}
// function deleteUser(userId) {
// 	if(confirm('Deleting user will also delete it\'s booking from calendar.\n\nAre you sure you want to priceed ?')) {
// 		window.location.href = '<?php echo WEB_ROOT; ?>api/process.php?cmd=delete&userId='+userId;
// 	}
// }

</script>