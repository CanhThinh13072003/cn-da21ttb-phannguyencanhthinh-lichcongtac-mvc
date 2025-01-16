<?php 
$userId = (isset($_GET['ID']) && $_GET['ID'] != '') ? $_GET['ID'] : 0;
$usql = "SELECT * FROM tbl_users u WHERE u.id = $userId";
$res  = dbQuery($usql);
while($row = dbFetchAssoc($res)) {
    extract($row);
    $stat = '';
    
    if($status == "active") {$stat = 'success';}
    else if($status == "lock") {$stat = 'warning';}
    else if($status == "inactive") {$stat = 'warning';}
    else if($status == "delete") {$stat = 'danger';}
?>
<div class="col-md-9">
  <div class="box box-solid">
    <div class="box-header with-border"> 
      <i class="fa fa-text-width"></i>
      <h3 class="box-title">User Details</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <dl class="dl-horizontal">
        <dt>Username</dt>
        <dd><?php echo $name; ?></dd>
        
        <dt>Address</dt>
        <dd><?php echo $address; ?></dd>
        
        <dt>Email</dt>
        <dd><?php echo $email; ?></dd>
        
        <dt>Phone</dt>
        <dd><?php echo $phone; ?></dd>
        
        <dt>Booking Status</dt>
        <dd><span class="label label-<?php echo $stat; ?>"><?php echo $status; ?></span></dd>
      </dl>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button class="btn btn-primary" onclick="sendEmail('<?php echo $email; ?>')"><i class="fa fa-envelope"></i> Send Email</button>
    </div>
  </div>
  <!-- /.box -->
</div>

<script>
function sendEmail(email) {
    if(confirm('Do you want to send an email to ' + email + '?')) {
        // Redirect to PHP mail handler
        window.location.href = '../send_email.php?email=' + email;
    }
}
</script>
<?php 
}
?>
