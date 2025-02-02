<link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.js" type="text/javascript"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><b>Thêm công việc</b></h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form" action="<?php echo WEB_ROOT; ?>api/process.php?cmd=book" method="post">
    <div class="box-body">
      <div class="form-group">
        <label for="exampleInputEmail1">Tên:</label>
		<input type="hidden" name="userId" value=""  id="userId"/>
        <span id="sprytf_name">
		<select name="name" class="form-control input-sm">
			<option>--Chọn người thực hiện--</option>
			<?php
			$sql = "SELECT id, name FROM tbl_users";
			$result = dbQuery($sql);
			while($row = dbFetchAssoc($result)) {
				extract($row);
			?>
			<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
			<?php 
			}
			?>
		</select>
		<span class="selectRequiredMsg">Không được để trống.</span>
		
		</span>
      </div>
	  
	  <div class="form-group">
        <label for="exampleInputEmail1">Địa chỉ:</label>
		<span id="sprytf_address">
        <textarea name="address" class="form-control input-sm" placeholder="Nhập địa chỉ" id="address"></textarea>
		<span class="textareaRequiredMsg">Không được để trống.</span>
		<span class="textareaMinCharsMsg">Phải có tối thiểu 10 kí tự.</span>	
		</span>
      </div>
	  <div class="form-group">
        <label for="exampleInputEmail1">SĐT:</label>
		<span id="sprytf_phone">
        <input type="text" name="phone" class="form-control input-sm"  placeholder="Nhập SĐT" id="phone">
		<span class="textfieldRequiredMsg">Không được để trống.</span>
		</span>
      </div>
	  <div class="form-group">
        <label for="exampleInputEmail1">Email:</label>
		<span id="sprytf_email">
        <input type="text" name="email" class="form-control input-sm" placeholder="Nhập email" id="email">
		<span class="textfieldRequiredMsg">Không được để trống.</span>
		<span class="textfieldInvalidFormatMsg">Hãy nhập đúng định dạng.</span>
		</span>
      </div>
	  
      <div class="form-group">
      <div class="row">
      	<div class="col-xs-6">
			<label>Ngày nhận công việc</label>
			<span id="sprytf_rdate">
        	<input type="text" id="datepicker" name="rdate" class="form-control" placeholder="YYYY-mm-dd">
			<span class="textfieldRequiredMsg">Không được để trống.</span>
			<span class="textfieldInvalidFormatMsg">Invalid date Format.</span>
			</span>
        </div>
        <div class="col-xs-6">
			<label>Thời gian:</label>
			<span id="sprytf_rtime">
            <input type="text" id="timepicker" name="rtime" class="form-control" placeholder="HH:mm">
			<span class="textfieldRequiredMsg">Không được để trống.</span>
			<span class="textfieldInvalidFormatMsg">Invalid time Format.</span>
			</span>
       </div>
      </div>
	  </div>
	  

	<script>
		// Kích hoạt Flatpickr cho lịch và thời gian
		flatpickr("#datepicker", {
			dateFormat: "Y-m-d", // Định dạng ngày
			allowInput: true // Cho phép nhập tay
		});

		flatpickr("#timepicker", {
			enableTime: true, // Kích hoạt chọn thời gian
			noCalendar: true, // Ẩn lịch
			dateFormat: "H:i", // Định dạng thời gian
			time_24hr: true, // Hiển thị 24 giờ
			allowInput: true // Cho phép nhập tay
		});
	</script>

	  <!-- Start Day
	  <div class="form-group">
        <label for="startDay">Start Day</label>
		<span id="sprytf_startDay">
        <input type="text" name="startDay" class="form-control input-sm" placeholder="YYYY-mm-dd">
		<span class="textfieldRequiredMsg">Start Day is required.</span>
		<span class="textfieldInvalidFormatMsg">Invalid date format. Use YYYY-mm-dd.</span>
		</span>
      </div> -->

	  <!-- End Day
	  <div class="form-group">
        <label for="endDay">End Day</label>
		<span id="sprytf_endDay">
        <input type="text" name="endDay" class="form-control input-sm" placeholder="YYYY-mm-dd">
		<span class="textfieldRequiredMsg">End Day is required.</span>
		<span class="textfieldInvalidFormatMsg">Invalid date format. Use YYYY-mm-dd.</span>
		</span>
      </div> -->
				  
	  <div class="form-group">
        <label for="exampleInputPassword1">Số ngày thực hiện:</label>
		<span id="sprytf_ucount">
        <input type="text" name="ucount" class="form-control input-sm" placeholder="Nhập số ngày" >
		<span class="textfieldRequiredMsg">Không được để trống.</span>
		<span class="textfieldInvalidFormatMsg">Invalid Format.</span>
      </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-primary">Hoàn tất</button>
    </div>
  </form>
</div>
<!-- /.box -->
<script type="text/javascript">
<!--
var sprytf_name 	= new Spry.Widget.ValidationSelect("sprytf_name");
var sprytf_address 	= new Spry.Widget.ValidationTextarea("sprytf_address", {minChars:6, isRequired:true, validateOn:["blur", "change"]});
var sprytf_phone 	= new Spry.Widget.ValidationTextField("sprytf_phone", 'none', {validateOn:["blur", "change"]});
var sprytf_mail 	= new Spry.Widget.ValidationTextField("sprytf_email", 'email', {validateOn:["blur", "change"]});
var sprytf_rdate 	= new Spry.Widget.ValidationTextField("sprytf_rdate", "date", {format:"yyyy-mm-dd", useCharacterMasking: true, validateOn:["blur", "change"]});
var sprytf_sdate 	= new Spry.Widget.ValidationTextField("sprytf_rdate", "date", {format:"yyyy-mm-dd", useCharacterMasking: true, validateOn:["blur", "change"]});
var sprytf_edate 	= new Spry.Widget.ValidationTextField("sprytf_rdate", "date", {format:"yyyy-mm-dd", useCharacterMasking: true, validateOn:["blur", "change"]});

var sprytf_rtime 	= new Spry.Widget.ValidationTextField("sprytf_rtime", "time", {hint:"i.e 20:10", useCharacterMasking: true, validateOn:["blur", "change"]});
var sprytf_ucount 	= new Spry.Widget.ValidationTextField("sprytf_ucount", "integer", {validateOn:["blur", "change"]});
var sprytf_startDay = new Spry.Widget.ValidationTextField("sprytf_startDay", "date", {format:"yyyy-mm-dd", useCharacterMasking: true, validateOn:["blur", "change"]});
var sprytf_endDay 	= new Spry.Widget.ValidationTextField("sprytf_endDay", "date", {format:"yyyy-mm-dd", useCharacterMasking: true, validateOn:["blur", "change"]});
//-->
</script>

<script type="text/javascript">
$('select').on('change', function() {
	//alert( this.value );
	var id = this.value;
	$.get('<?php echo WEB_ROOT. 'api/process.php?cmd=user&userId=' ?>'+id, function(data, status){
		var obj = $.parseJSON(data);
		$('#userId').val(obj.user_id);
		$('#email').val(obj.email);
		$('#address').val(obj.address);
		$('#phone').val(obj.phone_no);
	});
	
})
</script>
