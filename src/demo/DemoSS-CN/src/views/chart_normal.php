<style>
    h2,h3 {
        text-align: center;
    }
    canvas {
        max-width: 500px; 
        max-height: 500px;
        align-items: center; 
    }
</style>

<?php
// session_start(); // Bắt đầu session

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

// Lấy ID user từ URL (ví dụ: ?user_id=1)
$loggedInUserId = $_SESSION['calendar_fd_user']['id'];
$loggedInUserName = $_SESSION['calendar_fd_user']['name'];

// Truy vấn số lượng công việc theo trạng thái cho người dùng
$sql = "SELECT status, COUNT(status) AS status_count FROM tbl_reservations WHERE uid = ? GROUP BY status";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $loggedInUserId);
$stmt->execute();
$status_result = $stmt->get_result();

if (!$status_result) {
    die("Lỗi truy vấn trạng thái: " . $conn->error);
}

$status_labels = [];
$status_counts = [];

$total_jobs = 0; // Tổng số công việc
while ($status_row = $status_result->fetch_assoc()) {
    $status_labels[] = $status_row['status'];
    $status_counts[] = $status_row['status_count'];
    $total_jobs += $status_row['status_count']; // Tính tổng số công việc
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biểu Đồ Thống Kê Công Việc - User</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2><b>Thống kê của tôi</b></h2>

    <h3><i>Biểu đồ thể hiện số lượng công việc theo trạng thái của cá nhân</i></h3>
    <canvas id="pieChart" width="25" height="25"></canvas>

    <script>
        // Biểu Đồ Tròn
        const pieData = {
            labels: <?php echo json_encode($status_labels); ?>,
            datasets: [{
                label: 'Số lượng công việc theo trạng thái',
                data: <?php echo json_encode($status_counts); ?>,
                backgroundColor: [
                    'rgba(0, 128, 0, 1)', // Approved - Màu xanh lá
                    'rgba(255, 0, 0, 1)', // Denied - Màu đỏ
                    'rgba(255, 206, 86, 1)' // Pending - Màu vàng
                ],
                borderColor: [
                    'rgba(0, 128, 0, 1)',
                    'rgba(255, 0, 0, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        };

        const pieConfig = {
            type: 'pie',
            data: pieData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Số lượng công việc:'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                // Tính phần trăm
                                const total = <?php echo $total_jobs; ?>; // Tổng số công việc
                                const count = context.raw; // Số lượng công việc theo trạng thái
                                const percentage = ((count / total) * 100).toFixed(2); // Phần trăm
                                return `${context.label}: ${count} (${percentage}%)`; // Hiển thị nhãn với số lượng và phần trăm
                            }
                        }
                    }
                }
            }
        };

        const pieChart = new Chart(
            document.getElementById('pieChart'),
            pieConfig
        );
    </script>
</body>
</html>
