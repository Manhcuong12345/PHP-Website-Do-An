<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Kết quả</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
    <body>
        <?php
            $kq=0;
            $so1=$_POST["so1"];
            $so2=$_POST["so2"];
            $tests = array(
                $so1,
                $so2
            );
            $pheptinh=$_POST["pheptinh"];
            if(isset($_POST["submit"]))
            {
                foreach ($tests as $element)
                {
                    if(is_numeric($element))
                    {
                        if($pheptinh=="cong")$kq=$so1+$so2;
                        if($pheptinh=="tru")$kq=$so1-$so2;
                        if($pheptinh=="nhan") $kq=$so1*$so2;
                        if($pheptinh=="chia")
                        {
                            if($so2==0) $kq="nhập sai, nhập lại";
                            else $kq=$so1/$so2;
                        }
                    }
                    else $kq="nhập sai, nhập lại";
                }
            }
        ?>
        <form action="ketqua.php" method="POST">
            <table bgcolor="white" align="center">
                <tr>
                    <td colspan="2" align="center">
                        <h2 style="color:#7B68EE">Phép tính trên hai số</h2>
                    </td>
                </tr>
                <tr>
                    <td style="color:#FF8C00" align="right"><b>Chọn phép tính:&ensp;</b></td>
                    <td style="color:#FF8C00">
                        <?php
                            if($pheptinh!="cong" && $pheptinh!="tru" && $pheptinh!="nhan" && $pheptinh!="chia")
                            {
                                echo "bạn chưa chọn phép tính";
                            }
                            else
                            {
                                if($pheptinh=="cong") echo "Cộng";
                                if($pheptinh=="tru") echo "Trừ";
                                if($pheptinh=="nhan") echo "Nhân";
                                if($pheptinh=="chia") echo "Chia";
                            }
                            
                        ?>
                    </td>
                </tr>
                <tr>
                    <td align="right"><b style="color:blue">Số thứ nhất:&ensp;</b></td>
                    <td>
                        <input type="text" name="so1" placeholder="nhập số thứ nhất" size ="25"
                        value ="<?php if(isset($_POST['so1'])) echo$_POST['so1']; ?>"
                        >
                    </td>
                </tr>
                    <td align="right"><b style="color:blue" >Số thứ hai:&ensp;</b></td>
                    <td>
                        <input type="text" name="so2" placeholder="nhập số thứ hai" size ="25"
                        value ="<?php if(isset($_POST['so2'])) echo$_POST['so2']; ?>"
                        >
                    </td>
                </tr>
                </tr>
                    <td align="right"><b style="color:blue" >Kết quả:&ensp;</b></td>
                    <td>
                        <input type="text" name="kq" size ="25" readonly value="<?php echo $kq;?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <a href="javascript:window.history.back(-1);"><u><i>Quay lại trang trước</i></u></a> 
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
