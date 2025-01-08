<?php
// Lấy email từ tham số trong URL

$email_to = isset($_GET['email']) ? $_GET['email'] : '';

// Kiểm tra xem email có hợp lệ không
if (empty($email_to)) {
    die("Thiếu tham số email trong URL.");
}

// Đặt email người gửi mặc định
$email_from = "adminqlct@gmail.com";  // Email người gửi mặc định

// Các thông tin email
$subject = "Nhắc Nhở Công Việc";
$message = "ĐÂY LÀ TIN NHẮN NHẮC NHỞ, BẠN CÓ MỘT CÔNG VIỆC QUAN TRỌNG CẦN THỰC HIỆN!";

// Mã hóa nội dung để sử dụng trong URL
$subject_encoded = rawurlencode($subject);
$message_encoded = rawurlencode($message);

// Tạo link mailto
$mailto_link = "mailto:$email_to?subject=$subject_encoded&body=$message_encoded";

// Chuyển hướng đến link mailto
header("Location: $mailto_link");
exit();
?>
