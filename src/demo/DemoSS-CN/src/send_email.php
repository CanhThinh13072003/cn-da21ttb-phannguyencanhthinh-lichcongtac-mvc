<?php
// Lấy email từ tham số trong URL
$email_to = isset($_GET['email']) ? $_GET['email'] : '';

// Kiểm tra xem email có hợp lệ không
if (empty($email_to)) {
    die("Thiếu tham số email trong URL.");
}

// Đặt email người gửi mặc định
$email_from = "adminqlct@gmail.com";  // Email người gửi mặc định

// Lấy ngày hiện tại hoặc ngày từ biến $bdate
$bdate = date("F d, Y"); // Nếu muốn dùng ngày hiện tại
// $bdate = '2025-01-16'; // Nếu bạn muốn dùng một ngày cụ thể

// Các thông tin email, chèn ngày vào trong nội dung
$subject = "THÔNG BÁO Nhắc Nhở Công Việc";
$message = 'Xác nhận lịch công tác
            Sắp tới bạn có lịch làm việc quan trọng!!! Ngày thực hiện: ' . $bdate. '
            Mong bạn hãy chú ý và thực hiện đúng lịch trình. Chân thành cảm ơn!
        ';

// Mã hóa nội dung để sử dụng trong URL (vẫn giữ thẻ HTML trong message)
$subject_encoded = rawurlencode($subject);
$message_encoded = rawurlencode($message);

// Tạo link mailto
$mailto_link = "mailto:$email_to?subject=$subject_encoded&body=$message_encoded";

// Chuyển hướng đến link mailto
header("Location: $mailto_link");
exit();
?>
