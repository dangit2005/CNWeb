A:code hoàn thiện:
////////////////////
<?php
// === THIẾT LẬP KẾT NỐI PDO === 
$host = '127.0.0.1'; // hoặc localhost 
$dbname = 'cse485_web'; // Tên CSDL bạn vừa tạo 
$username = 'root'; // Username mặc định của XAMPP 
$password = ''; // Password mặc định của XAMPP (rỗng) 
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4"; 
 
try { 
    // TODO 1: Tạo đối tượng PDO để kết nối CSDL
    $pdo = new PDO($dsn, $username, $password); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    // echo "Kết nối thành công!"; // (Bỏ comment để test) 
} catch (PDOException $e) { 
    die("Kết nối thất bại: " . $e->getMessage()); 
} 
 
// === LOGIC THÊM SINH VIÊN (XỬ LÝ FORM POST) === 
// TODO 2: Kiểm tra xem form đã được gửi đi (method POST) và có 'ten_sinh_vien' không
if (isset($_POST['ten_sinh_vien'])) { 
     
    // TODO 3: Lấy dữ liệu 'ten_sinh_vien' và 'email' từ $_POST 
    $ten = $_POST['ten_sinh_vien']; 
    $email = $_POST['email']; 
 
    // TODO 4: Viết câu lệnh SQL INSERT với Prepared Statement (dùng dấu ?) 
    $sql = "INSERT INTO sinhvien (ten_sinh_vien, email) VALUES (?, ?)"; 
     
    // TODO 5: Chuẩn bị (prepare) và thực thi (execute) câu lệnh 
    $stmt = $pdo->prepare($sql); 
    $stmt->execute([$ten, $email]); 
 
    // TODO 6: (Tùy chọn) Chuyển hướng về chính trang này để "làm mới" 
    header('Location: index.php'); 
    exit; 
} 
 
// === LOGIC LẤY DANH SÁCH SINH VIÊN (SELECT) === 
// TODO 7: Viết câu lệnh SQL SELECT * 
$sql_select = "SELECT * FROM sinhvien ORDER BY ngay_tao DESC"; 
 
// TODO 8: Thực thi câu lệnh SELECT (không cần prepare vì không có tham số) 
$stmt_select = $pdo->query($sql_select); 
 
?> 
<!DOCTYPE html> 
<html lang="vi"> 
<head> 
    <meta charset="UTF-8"> 
    <title>PHT Chương 4 - Website hướng dữ liệu</title> 
    <style> 
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f9f9f9; }
        h2 { color: #333; margin-top: 30px; }
        
        form { 
            background-color: #fff; 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
            max-width: 500px; 
            margin-bottom: 30px;
        }
        
        form label { 
            display: block; 
            margin-bottom: 8px; 
            color: #555; 
            font-weight: bold;
        }
        
        form input { 
            width: 100%; 
            padding: 10px; 
            margin-bottom: 15px; 
            border: 1px solid #ddd; 
            border-radius: 4px; 
            box-sizing: border-box;
            font-size: 14px;
        }
        
        form input:focus { 
            outline: none; 
            border-color: #4CAF50; 
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }
        
        form button { 
            background-color: #4CAF50; 
            color: white; 
            padding: 12px 25px; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 16px; 
            font-weight: bold;
            width: 100%;
        }
        
        form button:hover { 
            background-color: #45a049;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        } 
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px; 
            text-align: left;
        } 
        th { 
            background-color: #4CAF50; 
            color: white;
            font-weight: bold;
        }
        tr:hover { background-color: #f5f5f5; }
    </style> 
</head> 
<body> 
    <h2>Thêm Sinh Viên Mới (Chủ đề 4.3)</h2> 
    <form action="index.php" method="POST"> 
        Tên sinh viên: <input type="text" name="ten_sinh_vien" required> 
        Email: <input type="email" name="email" required> 
        <button type="submit">Thêm</button> 
    </form> 
 
    <h2>Danh Sách Sinh Viên (Chủ đề 4.2)</h2> 
    <table> 
        <tr> 
            <th>ID</th> 
            <th>Tên Sinh Viên</th> 
            <th>Email</th> 
            <th>Ngày Tạo</th> 
        </tr> 
        <?php 
        // TODO 9: Dùng vòng lặp để duyệt qua kết quả
        while ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) { 
            // TODO 10: In các dòng <tr> và <td> chứa dữ liệu $row
            echo "<tr>"; 
            echo "<td>" . htmlspecialchars($row['id']) . "</td>"; 
            echo "<td>" . htmlspecialchars($row['ten_sinh_vien']) . "</td>"; 
            echo "<td>" . htmlspecialchars($row['email']) . "</td>"; 
            echo "<td>" . htmlspecialchars($row['ngay_tao']) . "</td>"; 
            echo "</tr>"; 
        } 
        ?> 
    </table> 
</body> 
</html>

B: Ảnh chụp màn hình kết quả:
/////////////////////////////
1:màn hình tab "Browse" (Duyệt) của bảng sinhvien
![Ảnh minh hoạ](./imgs/buoi4/phpmyadmin.png)
/////////////////////////////
2: ảnh màn hình trang chapter4.php của bạn, hiển thị đúng 2-3 sinh viên mà bạn vừa thêm (chứng minh SELECT thành công).
![Ảnh minh họa](./imgs/buoi4/indexphp.png)

////////////////////////////
3:Câu hỏi Phản biện (Bắt buộc) 
-Tại sao phải redirect sau khi submit form?
Nếu không redirect mà để tải lại trang luôn thì có thể gặp lỗi gì?
/////////
-$sql = "INSERT INTO sinhvien (ten_sinh_vien, email): có thể gây ra lỗ hổng bảo mật, và prepared statement lại ngăn được tấn công này?
