<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show</title>
</head>
<body>
    <h2 align="center">Thông tin sinh viên</h2>
<table align="center" border="true">
        <tr>
            <th> STT</th>
            <th> Họ</th>
            <th> Tên</th>
            <th> Địa chỉ</th>
            <th> ID lớp</th>
            <th>  Khoá</th>
        </tr>
        <?php
            require("detailView.php");
            $query='select * from sv';
            $result=$conn->query($query);
            if (!$result) echo "cau truy van bi sai";
            if ($result->num_rows != 0){
                while ($row=$result->fetch_array()){//row la 1 mang
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['ho']  . "</td>";
                    echo "<td>" . $row['ten'] . "</td>";
                    echo "<td>" . $row['diachi'] . "</td>";
                    echo "<td>" . $row['lop'] . "</td>";
                    echo "<td>" . $row['khoa'] . "</td>";
                    echo "</tr>";
                }
            } else echo "ban khong co du lieu";
            $conn->close();
            echo "<tr>";
            echo "<td align='center' colspan='6'>";
            echo "<a href='javascript:window.history.back(-1);'>Trở về trang trước</a>";
            echo "</td>";
            echo "</tr>";
        ?>
    </table>
</body>
</html>