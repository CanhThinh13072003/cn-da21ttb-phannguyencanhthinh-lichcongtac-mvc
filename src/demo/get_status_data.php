<?php
// Kết nối đến CSDL
$servername = "localhost"; // Thay bằng tên máy chủ của bạn
$username = "root"; // Thay bằng tên người dùng của bạn
$password = ""; // Thay bằng mật khẩu của bạn
$dbname = "db_event_management"; // Thay bằng tên CSDL của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Nhận user_id từ yêu cầu POST
$user_id = $_POST['uid'];

// Truy vấn lấy số lượng công việc theo trạng thái cho user được chọn
$status_sql = "SELECT status, COUNT(status) AS status_count FROM tbl_reservations WHERE uid = ? GROUP BY status";
$stmt = $conn->prepare($status_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$status_labels = [];
$status_counts = [];

if ($result && $result->num_rows > 0) {
    while ($status_row = $result->fetch_assoc()) {
        $status_labels[] = $status_row['status'];
        $status_counts[] = $status_row['status_count'];
    }
}

// Đóng kết nối
$stmt->close();
$conn->close();

// Trả về dữ liệu dưới dạng JSON
echo json_encode(['labels' => $status_labels, 'counts' => $status_counts]);
?>