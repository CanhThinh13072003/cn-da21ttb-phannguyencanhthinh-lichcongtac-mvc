<div class="col-md-8">
  
<link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.js" type="text/javascript"></script>

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><b>Tạo tài khoản mới</b></h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form" action="<?php echo WEB_ROOT; ?>views/process.php?cmd=create" method="post">
    <div class="box-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Tên người dùng</label>
        <span id="sprytf_name">
		<input type="text" name="name" class="form-control input-sm" placeholder="Nhập tên người dùng">
		<span class="textfieldRequiredMsg">Không được để trống.</span>
		<span class="textfieldMinCharsMsg">Phải có tối thiểu 6 kí tự.</span>
		</span>
      </div>
	  <div class="form-group">
        <label for="exampleInputEmail1">Địa chỉ</label>
		<span id="sprytf_address">
        <textarea name="address" class="form-control input-sm" placeholder="Nhập địa chỉ"></textarea>
		<span class="textareaRequiredMsg">Không được để trống.</span>
		<span class="textareaMinCharsMsg">Phải có tối thiểu 10 kí tự.</span>	
		</span>
      </div>
	  <div class="form-group">
        <label for="exampleInputEmail1">SĐT</label>
		<span id="sprytf_phone">
        <input type="text" name="phone" class="form-control input-sm"  placeholder="Nhập SĐT">
		<span class="textfieldRequiredMsg">Không được để trống.</span>
		</span>
      </div>
	  <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
		<span id="sprytf_email">
        <input type="text" name="email" class="form-control input-sm" placeholder="Nhập email">
		<span class="textfieldRequiredMsg">Không được để trống.</span>
		<span class="textfieldInvalidFormatMsg">Please enter a valid email (user@domain.com).</span>
		</span>
      </div>
	  

	<div class="form-group">
        <label for="exampleInputEmail1">Loại tài khoản</label>
		<span id="sprytf_type">
        <select name="type"  class="form-control input-sm">
			<option value=""> -- Chọn loại tài khoản --</option>
			<option value="boss">Boss</option>
			<option value="normal">Normal</option>
		</select>
		<span class="selectRequiredMsg">Chọn loại tài khoản.</span>
		</span>
		
      </div>
	  		  
	  
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-primary">Hoàn thành</button>
    </div>
  </form>
</div>
<!-- /.box -->
<script type="text/javascript">
<!--
var sprytf_name 	= new Spry.Widget.ValidationTextField("sprytf_name", 'none', {minChars:6, validateOn:["blur", "change"]});
var sprytf_address 	= new Spry.Widget.ValidationTextarea("sprytf_address", {minChars:10, isRequired:true, validateOn:["blur", "change"]});
var sprytf_phone 	= new Spry.Widget.ValidationTextField("sprytf_phone", 'none', {validateOn:["blur", "change"]});
var sprytf_mail 	= new Spry.Widget.ValidationTextField("sprytf_email", 'email', {validateOn:["blur", "change"]});
//var sprytf_rdate 	= new Spry.Widget.ValidationTextField("sprytf_rdate", "date", {format:"yyyy-mm-dd", useCharacterMasking: true, validateOn:["blur", "change"]});
//var sprytf_rtime 	= new Spry.Widget.ValidationTextField("sprytf_rtime", "time", {hint:"i.e 20:10", useCharacterMasking: true, validateOn:["blur", "change"]});
//var sprytf_ucount 	= new Spry.Widget.ValidationTextField("sprytf_ucount", "integer", {validateOn:["blur", "change"]});
var sprytf_type 	= new Spry.Widget.ValidationSelect("sprytf_type");
//-->
</script>
</div>