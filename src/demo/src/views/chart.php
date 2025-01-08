<style>
    h2 {
        text-align: center;
    }
    /* canvas {
        max-width: 500px; 
        max-height: 500px; 
    } */
</style>

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

// Truy vấn lấy số lượng công việc theo uid
$sql = "SELECT uid, COUNT(uid) AS job_count FROM tbl_reservations GROUP BY uid";
$result = $conn->query($sql);

if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}

$uids = [];
$counts = [];

// Lấy dữ liệu từ bảng tbl_users để lấy tên cho uid
$user_names = [];
$user_sql = "SELECT id, name FROM tbl_users";
$user_result = $conn->query($user_sql);

if (!$user_result) {
    die("Lỗi truy vấn người dùng: " . $conn->error);
}

while ($user_row = $user_result->fetch_assoc()) {
    $user_names[$user_row['id']] = $user_row['name'];
}

// Lấy kết quả đếm công việc
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $uids[] = $user_names[$row['uid']] ?? 'Không xác định';
        $counts[] = $row['job_count'];
    }
} else {
    echo "Không có dữ liệu.";
}

// Truy vấn lấy số lượng công việc theo trạng thái
$status_sql = "SELECT status, COUNT(status) AS status_count FROM tbl_reservations GROUP BY status";
$status_result = $conn->query($status_sql);

if (!$status_result) {
    die("Lỗi truy vấn trạng thái: " . $conn->error);
}

$status_labels = [];
$status_counts = [];

$total_jobs = 0; // Tổng số công việc
if ($status_result->num_rows > 0) {
    while ($status_row = $status_result->fetch_assoc()) {
        $status_labels[] = $status_row['status'];
        $status_counts[] = $status_row['status_count'];
        $total_jobs += $status_row['status_count']; // Tính tổng số công việc
    }
} else {
    echo "Không có dữ liệu trạng thái.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biểu Đồ Thống Kê Công Việc</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Biểu Đồ Thống Kê Số Lượng Công Việc</h2>
    
    <h3>Biểu Đồ Cột: Số Lượng Công Việc Theo Người Dùng</h3>
    <canvas id="barChart" width="200" height="75"></canvas>
    
    <h3>Biểu Đồ Tròn: Số Lượng Công Việc Theo Trạng Thái</h3>
    <canvas id="pieChart" width="75" height="75"></canvas>
    
    <script>
        // Biểu Đồ Cột
        const labels = <?php echo json_encode($uids); ?>; // Tên người dùng
        const data = {
            labels: labels,
            datasets: [{
                label: 'Số Lượng Công Việc',
                data: <?php echo json_encode($counts); ?>, // Số lượng công việc
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        const barConfig = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const barChart = new Chart(
            document.getElementById('barChart'),
            barConfig
        );

        // Biểu Đồ Tròn
        const pieData = {
            labels: <?php echo json_encode($status_labels); ?>,
            datasets: [{
                label: 'Số Lượng Công Việc Theo Trạng Thái',
                data: <?php echo json_encode($status_counts); ?>,
                backgroundColor: [
                    'rgba(0, 128, 0, 1)', // Approved - Màu xanh lá
                    'rgba(255, 0, 0, 1)', // Denied - Màu đỏ
                    'rgba(255, 206, 86, 1)' // Pending - Giữ nguyên
                ],
                borderColor: [
                    'rgba(0, 128, 0, 1)',
                    'rgba(255, 0, 0, 1)',
                    'rgba(255, 206, 86, 1)',
                    // 'rgba(75, 192, 192, 1)',
                    // 'rgba(153, 102, 255, 1)'
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
                        text: 'Số Lượng Công Việc Theo Trạng Thái'
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