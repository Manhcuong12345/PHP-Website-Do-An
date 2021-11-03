<?php
get_header();
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
        #box1{
            border-width: 2px;
            border-style: solid;
            background-color:pink;
            color:black;
            border-color: grey;
            box-shadow: 5px 5px 5px black;
        }
        #ab1{
           padding-top: 20px;
           padding-left: 570px;
        }
        h1{
           text-align: center;
           padding-top:20px;
           padding-bottom:20px;
           color:blue;
           font-size:30px
        }
    </style>
</head>
<h1>1.CÁC BÀI TẬP MẢNG,CHUỖI,HÀM</h1>
<body>
    <?php
    function tao_mang(&$n,&$arr)
    {
        for($i=0;$i<$n;$i++)
        {
            $x=rand(-100,200);
            $arr[$i]=$x;
        }
    }
    function Demsochan($arr)
    {
        $dem=0;
        foreach($arr as $i)
        {
            if($i%2==0) $dem++;
        }
        return $dem;
    }
    function Demsobehon100($arr)
    {
        $dem=0;
        foreach($arr as $i)
        {
            if($i<100) $dem++;
        }
        return $dem;
    }
    function Tongsoam($arr)
    {
        $t=0;
        foreach ($arr as $i)
        {
            if($i<0) $t=$t+$i;
        }
        return $t;
    }
    function invitri0($arr)
    {
        $index="0";
        foreach ($arr as $key=>$value)
        {
            if($value==0) $index=$key+1;
        }
        if($index==0) return "Trong mảng không có số 0 nào";
        else return "Vị trí của phần tử mang giá trị âm là $index";
    }
    function sapxeptang($n,&$arr)
    {
        for($i=0; $i<$n-1;$i++)
        {
            for($j=$i+1;$j<$n;$j++)
            {
                if($arr[$i]>$arr[$j])
                {
                    $tg=$arr[$i];
                    $arr[$i]=$arr[$j];
                    $arr[$j]=$tg;
                }
            }
        }
    }
    function xuatmang($arr)
    {
        $m="";
        foreach($arr as $i)
        {
            $m.= $i." ";
        }
        return $m;
    }
    if(isset($_POST['submit']))
    {
        $n=$_POST['input'];
        if($n>0 && is_numeric($n) && is_int($n+0))
        {
            tao_mang($n,$arr);
            $kq="Mảng được tạo là:\n" .implode(",",$arr)."\n";
            $kq.="Có ".Demsochan($arr)." số chẳn trong mảng\n";
            $kq.="Có ".Demsobehon100($arr)." số nhỏ hơn 100\n";
            $kq.="Tổng các số âm trong mảng là:".Tongsoam($arr)."\n";
            $kq.=invitri0($arr)."\n";
            sapxeptang($n,$arr);
            $kq.="Sắp xếp theo thứ tự tăng dần:\n".xuatmang($arr);
        }
        else $kq=$n." không phải là số nguyên dương";
    }
    ?>
    <form action="form.php" method="Post" id="ab1">
        <table align="center" bgcolor="#FAFAD2" id="box1">
            <tr >
                <td colspan="3"  align="center" bgcolor="#FFFF00">
                    <h2 style="color:red">Bài 1</h2>
                </td>
            </tr>
            <tr>
                <td>Nhập vào số </td>
                <td>
                    <input type="text" name="input" size="42" placeholder="nhập vào số nguyên dương"
                    value="<?php if(isset($_POST['input'])) echo $_POST['input'];?>"
                    >
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Kết quả</td>
                <td>
                    <textarea name="ketqua" cols="40" rows="10" ><?php if(isset($_POST['ketqua'])) echo $kq;?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <input type="submit" name="submit" value="Thực hiện" >
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
<br>

<!-- /////////////////////Bai 2///////////////////////////// -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="modules/hosts/public/cssforbt08.css"> -->
    <title>Bài 2</title>
    <style>
        #box{
            border-width: 2px;
            border-style: solid;
            border-color: orange;
            background-color:grey;
            color:black;
            box-shadow: 5px 5px 5px black;
        }
        #submit{
            text-align: center;
            background-color:#EEE8AA;
            width: 60%;
        }
        #ab{
           padding-left: 570px;
        }
    </style>
</head>
<body>
<?php
function Tong($arr)
{
    $t=0;
    for($i=0;$i<count($arr);$i++)
    {
        $t=$t+$arr[$i];
    }
    return $t;
}
if(isset($_POST["submit"]))
{
    $arr=[];
    $m=$_POST["m"];
    $original=explode(",",$m);
    $mang= implode(", ",$original);
    $kq=Tong($original);
}
?>
    <form action="" method="post" id = "ab">
        <table  align="center" bgcolor="#AFEEEE" id="box">
            <tr>
                <td colspan="4" align="center" bgcolor="#008B8B">
                <h3 style="color:red">Bài 2</h3>
                    <h2 style="color:white">Nhập mảng và tính trên dãy số</h2>
                </td>
            </tr>
            <tr>
                <td>Nhập dãy số: &emsp; &emsp;</td>
                <td>
                    <input type="text" name="m" size="30"
                    value ="<?php if(isset($_POST['m'])) echo$_POST['m']; ?>"
                    >
                </td>
                <td><span style="color:red">(*)&emsp; &emsp;</span></td>
            </tr>
            <tr>
                <td></td>
                <td >
                    <input type="submit" name="submit" id="submit" value="Tổng dãy số"> 
                </td>
            </tr>
            <tr>
                <td>Tổng dãy số:</td>
                <td>
                    <input type="text" name="kq" size="30" value="<?php if(isset($_POST['kq'])) echo $kq;?>">
                </td>
                <td>&emsp;</td>
            </tr>
            <tr>
                <td colspan="3" align="center" >
                    <span><span style="color:red">(*)</span> Các số được nhập sẽ cách nhau bằng dấu ";"</span>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
<br>

<!-- /////////////////////Bai 4///////////////////////////// -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 4</title>
    <style>
        #box2{
            border-width: 2px;
            border-style: solid;
            border-color: grey;
            background-color:#EEE8AA;
            color:black;
            box-shadow: 5px 5px 5px black;
        }
        #submit2{
            text-align: center;
            background-color: #87CEFA;
            width: 30%;
        }
        #ab{
            padding-left: 570px;
        }
    </style>
</head>
<body>
<?php
function Timkiem($arr,$n)
{
    $vitri=0;
    for($i=0;$i<count($arr);$i++)
    {
        if($n==$arr[$i])
        {
            $vitri=$i+1;        
            return "Tìm thấy $n tại vị trí thứ $vitri của mảng";
        }
    }
    return "Không tìm thấy số $n trong mảng";
}
if(isset($_POST["submit"]))
{
    $arr=[];
    $m=$_POST["m"];
    $n=$_POST["n"];
    $original=explode(",",$m);
    $mang= implode(", ",$original);
    $kq=Timkiem($original,$n);
}
?>
    <form action="" method="post" id="ab">
        <table  align="center" bgcolor="#AFEEEE" id="box2">
            <tr>
                <td colspan="4" align="center" bgcolor="#008B8B">
                <h3 style="color:red">Bài 4</h3>
                    <h2 style="color:white">Tìm kiếm</h2>
                </td>
            </tr>
            <tr>
                <td>Nhập mảng:</td>
                <td>
                    <input type="text" name="m" size="40"
                    value ="<?php if(isset($_POST['m'])) echo$_POST['m']; ?>"
                    >
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Nhập số cần tìm:</td>
                <td>
                    <input type="text" name="n" size="8" value="<?php if(isset($_POST['n'])) echo $n;?>">
                </td>
                <td>&emsp;</td>
            </tr>
            <tr>
                <td></td>
                <td >
                    <input type="submit" name="submit" id="submit2" value="Tìm kiếm"> 
                </td>
            </tr>
            <tr>
                <td>Mảng:</td>
                <td>
                    <input type="text" name="mang" size="40" value="<?php if(isset($_POST['mang'])) echo $mang;?>">
                </td>
                <td>&emsp;</td>
            </tr>
            <tr>
                <td>Kết quả tìm kiếm:</td>
                <td>
                    <input type="text" name="kq" size="40" value="<?php if(isset($_POST['kq'])) echo $kq;?>">
                </td>
                <td>&emsp;</td>
            </tr>
            <tr bgcolor="#008B8B">
                <td colspan="3" align="center" >
                    <span>(Các phần tử trong mảng sẽ cách nhau bằng dấu ";")</span>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
<br>

<!-- //////////////Bai 5//////////////////////// -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 5</title>
    <style>
        #box3{
            border-width: 2px;
            border-style: solid;
            background-color:grey;
            color:black;
            border-color: grey;
            box-shadow: 5px 5px 5px black;
        }
        #submit3{
            text-align: center;
            background-color: #F0E68C;
            width: 30%;
        }

    </style>
</head>
<body>
    <?php
    function thaythe($arr,$a,$b)
    {
        for($i=0;$i<count($arr);$i++)
        {
            if($arr[$i]==$a) $arr[$i]=$b;
        }
        return $arr;
    }
    if (isset($_POST['submit'])){
        $m=$_POST['m'];
        $a=$_POST['a'];
        $b=$_POST['b'];
        $original=explode(",",$m);
        $mangcu=implode(",",$original);
        $mangmoi=implode(",",thaythe($original,$a,$b));
    }
    ?>
    <form action="" method="Post" id="ab">
        <table align="center" bgcolor="#AFEEEE" id="box3">
            <tr>
                <td bgcolor="#008B8B" align="center" colspan="3">
                <h3 style="color:red">Bài 5</h3>
                    <h2 style="color:white">Thay Thế</h2>
                </td>
            </tr>
            <tr>
                <td>Nhập các phần tử: </td>
                <td>
                    <input type="text" name="m" value="<?php if (isset($m)) echo $m;?>"  size="40">
                </td>
                <td> &emsp;</td>
            </tr>
            <tr>
                <td>Giá trị cần thay thế:&emsp;</td>
                <td>
                    <input type="text" name="a" size="30" value="<?php if (isset($a)) echo $a;?>">
                </td>
            </tr>
            <tr>
                <td>Giá trị thay thế:</td>
                <td>
                    <input type="text" name="b" size="30" value="<?php if (isset($b)) echo $b;?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" id="submit3" value ="Thay thế">
                </td>
            </tr>
            <tr>
                <td>Mảng cũ:</td>
                <td>
                    <input type="text" size="40" value="<?php if (isset($mangcu)) echo $mangcu;?>">
                </td>
            </tr>
            <tr>
                <td>Mảng mới:</td>
                <td>
                    <input type="text" size="40" value="<?php if (isset($mangmoi)) echo $mangmoi;?>">
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <span>(<span style="color:red">Ghi chú:</span> Các phần tử trong mảng cách nhau bằng dấu ",")</span>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
<br>

<!-- //////Bai 6////////// -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 6</title>
    <style>
        #box4{
            border-width: 2px;
            border-style: solid;
            border-color: grey;
            background-color:brown;
            color:black;
            box-shadow: 5px 5px 5px black;
        }
    </style>
</head>
<body>
    <?php
    function doicho(&$a,&$b)
    {
        $tam=$a;
        $a=$b;
        $b=$tam;    
    }
    function sapxeptangs($arr)
    {
        for($i=0; $i<count($arr)-1;$i++)
        {
            for($j=$i+1;$j<count($arr);$j++)
            {
                if($arr[$i]>$arr[$j]) doicho($arr[$i],$arr[$j]);

            }
        }
        return $arr;
    }
    function sapxepgiams($arr)
    {
        for($i=0; $i<count($arr)-1;$i++)
        {
            for($j=$i+1;$j<count($arr);$j++)
            {
                if($arr[$i]<$arr[$j]) doicho($arr[$i],$arr[$j]);
            }
        }
        return $arr;
    }
    if (isset($_POST['submit'])){
        $text=$_POST['text'];
        $original=explode(",",$text);
        $result_decre = implode(",",sapxepgiams($original));
        $result_incre = implode(",",sapxeptangs($original));
    }
    ?>
    <form action="" method="Post" id="ab">
        <table align="center" bgcolor="#AFEEEE" id="box4">
            <tr>
                <td bgcolor="#008B8B" align="center" colspan="3">
                <h3 style="color:red">Bài 6</h3>
                    <h2 style="color:white">Sắp xếp mảng</h2>
                </td>
            </tr>
            <tr>
                <td>Nhập mảng:</td>
                <td>
                    <input type="text" name="text" value="<?php if (isset($text)) echo $text;?>"  size="30">
                </td>
                <td style="color: red">(*)</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value ="Sắp xếp tăng/giảm">
                </td>
            </tr>
            <tr>
                <td>Sau khi sắp xếp:</td>
            </tr>
            <tr>
                <td>Tăng dần:</td>
                <td>
                    <input type="text" value="<?php if(isset($result_incre)) echo  $result_incre;?>">
                </td>
            </tr>
            <tr>
                <td>Giảm dần:</td>
                <td>
                    <input type="text" value="<?php if(isset($result_decre)) echo  $result_decre;?>">
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <span><span style="color:red">(*)</span> Các số được nhập cách nhau bằng dấu ","</span>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
<br>
<!-- 
////Bai so 7 ///// -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 7</title>
    <style>
        #box5{
            border-width: 2px;
            border-style: solid;
            background-color:green;
            color:black;
            border-color: grey;
            box-shadow: 5px 5px 5px black;
        }
        #submit5{
            text-align: center;
            background-color: #FAFAD2;
            width: 80%;
        }
        #mauchu{
            color:red;
            font-weight:600;
        }
    </style>
</head>
<body>
    <?php
    
    if (isset($_POST['submit']))
    {
        $nam=$_POST['input'];
        if($nam>1900 && $nam<2100)
        {
            $mang_can=array("Quý","Giáp","Ất","Bính","Đinh","Mậu","Kỷ","Canh","Tân","Nhâm");
            $mang_chi=array("Hợi","Tý","Sửu","Dần","Mão","Thìn","Tỵ","Ngọ","Mùi","Thân","Dậu","Tức");
            $mang_hinh=array("hoi.png","ti.png","suu.png","dan.png","mao.png","thin.png","ty.png","ngo.png",
            "mui.png","than.png","dau.png","tuc.png");
            $nam=$nam-3;
            $can=$nam%10;
            $chi=$nam%12;
            $nam_al=$mang_can[$can];
            $nam_al=$nam_al." ".$mang_chi[$chi];
            $hinh=$mang_hinh[$chi];
            $hinh_anh="<img src='12 con giap/$hinh'>";
        }
        else
        {
            $nam_al="Fail";

        }
        
    }
    ?>
    <form action="" method="Post" id="ab">
        <table align="center" bgcolor="#AFEEEE" id="box5">
            <tr>
                <td bgcolor="#008B8B" align="center" colspan="3">
                <h2 style="color:red">Bài 7</h2>
                    <h2 style="color:white">Tính năm âm lịch</h2>
                </td>
            </tr>
            <tr>
                <td align="center">Năm dương lịch</td>
                <td>&emsp; &emsp; &emsp;</td>
                <td align="center">Năm âm lịch</td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="input" value="<?php if (isset($_POST['input'])) echo $_POST['input'];?>"  size="30">
                </td>
                <td>&emsp; &emsp; &emsp;</td>
                <td style="color:red">
                    <input type="text" id="mauchu" value="<?php if (isset($nam_al)) echo $nam_al; ?>"  size="30">
                </td>
            </tr>
            
            <tr>
                <td></td>
                <td align="center">
                    <input type="submit" name="submit5" id="submit" value ="=>">
                </td>
            </tr>
            <tr>
                <td align="center" colspan="3"> 
                    <?php if (isset($hinh_anh)) echo $hinh_anh;?>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
<br>
<!-- /////Bai 3//// -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 3</title>
    <style>
        #box6{
            border-width: 2px;
            border-style: solid;
            border-color: grey;
            background-color:purple;
            color:black;
            box-shadow: 5px 5px 5px black;
        }
        #submit6{
            text-align: center;
            background-color: #F0E68C;
            width: 60%;
        }
        #reset{
            background-color: #F0E68C;
            width: 20%;
        }
    </style>
</head>
<body>
<?php
function tao_mangs($n,&$arr)
{
    for($i=0;$i<$n;$i++)
    {
        $arr[$i]=rand(0,20);
    }
}
function GTLN($arr)
{
    $max=0;
    for($i=0;$i<count($arr);$i++)
    {
        if($arr[$i]>$max) $max=$arr[$i];
    }
    return $max;
}
function GTNN($arr)
{  
    foreach($arr as $i)
    {
        $min=$i;
        for($i=0;$i<count($arr);$i++)
        {
            if($arr[$i]<$min) $min=$arr[$i];
        }
        return $min;
    }
    
}
function Tongmang($arr)
{
    $t=0;
    for($i=0;$i<count($arr);$i++)
    {
        $t=$t+$arr[$i];
    }
    return $t;
}
if(isset($_POST["submit"]))
{
    $n=$_POST["n"];
    $arr=[];
    tao_mangs($n,$arr);
    $mang="".implode(" ",$arr);
    $gtln=GTLN($arr);
    $gtnn=GTNN($arr);
    $tong=Tongmang($arr);
}
if(isset($_POST["reset"]))
{
    $n=$_POST["n"];
    $n="";
}
?>
    <form action="bai3.php" method="post" id="ab">
        <table  align="center" bgcolor="#DDA0DD" id="box6">
            <tr>
                <td colspan="4" align="center" bgcolor="#8B008B">
                <h2 style="color:red">Bài 3</h2>
                    <h2 style="color:white">Phát sinh mảng và tính toán</h2>
                </td>
            </tr>
            <tr>
                <td>Nhập số phần tử:</td>
                <td>
                    <input type="text" name="n" size="30"
                    value ="<?php if(isset($_POST['n'])) echo$_POST['n']; ?>"
                    >
                </td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td >
                    <input type="submit" name="submit" id="submit6" value="phát sinh và tính toán"> 
                    <input type="submit" name="reset" id="reset" value="reset">
                </td>
            </tr>
            <tr>
                <td>Mảng:</td>
                <td>
                    <input type="text" name="mang" size="40" value="<?php if(isset($_POST['mang'])) echo $mang;?>">
                </td>
                <td>&emsp;</td>
            </tr>
            <tr>
                <td>GTLM (max) trong mảng:</td>
                <td>
                    <input type="text" name="gtln" size="15" value="<?php if(isset($_POST['gtln'])) echo $gtln;?>">
                </td>
                <td>&emsp;</td>
            </tr>
            <tr>
                <td>GTNN (min) trong mảng:</td>
                <td>
                    <input type="text" name="gtnn" size="15" value="<?php if(isset($_POST['gtnn'])) echo $gtnn;?>">
                </td>
                <td>&emsp;</td>
            </tr>
            <tr>
                <td>Tổng mảng:</td>
                <td>
                    <input type="text" name="tong" size="15" value="<?php if(isset($_POST['tong'])) echo $tong;?>">
                </td>
                <td>&emsp;</td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <span>(<span style="color:red">Ghi chú:</span>Các phần tử trong mảng có giá trị từ 0 đến 20)</span>
                </td>
                <td>&emsp;</td>
            </tr>
        </table>
    </form>
</body>
</html>
<br>

<!-- ////////////////////////////////////////////////////////////////////////////// -->

<h1>2.CÁC BÀI TẬP VỀ FORM</h1>

<!-- //Bài thanh toán tiền diện/// -->
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Thanh toán tiền điện</title>
        <!-- <link rel="stylesheet" href="style.css"> -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
    <style>
         #tb{
            background-color:#faeb;
            border-width: 2px;
            border-style: solid;
            color:black;
            border-color: grey;
            box-shadow: 5px 5px 5px black;
         }
    
    </style>
    <body>
        <?php
        $dongia=2000;
        $tien=0;
        if(isset($_POST['submit']))
        {
            $old=$_POST['old'];
            $new=$_POST['new'];
            if($new<$old||$new<=0||$old<=0) 
            {
                $tien="nhập sai, nhập lại";
            }
            else $tien=($new-$old)*$dongia;
        }
        ?>

        <form action="" method="POST" id="ab">
        <table bgcolor="#faebd" align="center" id="tb">
            <tr>
                <td colspan="3" bgcolor="orange" align="center">
                    <h2 style="font-size:20px;color:red">Thanh toán tiền điện</h2>
                </td>
            </tr>
            <tr>
                <td>Chủ hộ</td>
                <td>
                    <input type="text" name="chuho" placeholder="nhập chủ hộ" size ="30"
                    value ="<?php if(isset($_POST['chuho'])) echo$_POST['chuho']; ?>"
                    >
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Chỉ số cũ</td>
                <td>
                    <input type="text" name="old" placeholder="nhập chỉ số cũ" size ="30"
                    value ="<?php if(isset($_POST['old'])) echo$_POST['old']; ?>"
                    >
                </td>
                <td>Kw</td>
            </tr>
            <tr>
                <td>Chỉ số mới</td>
                <td>
                    <input type="text" name="new" placeholder="nhập chỉ số mới" size ="30"
                    value ="<?php if(isset($_POST['new'])) echo$_POST['new']; ?>"
                    >
                </td>
                <td>Kw</td>
            </tr>
            <tr>
                <td>Đơn giá</td>
                <td>
                    <input type="text" name="dongia" size ="30"
                    value ="<?php echo $dongia ?>"
                    >
                </td>
                <td>VNĐ</td>
            </tr>
            <tr>
                <td>Số tiền thanh toán</td>
                <td>
                    <input type="text" name="sotien" size ="30" readonly value="<?php echo $tien ?>">
                </td>
                <td>VNĐ</td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="submit" value="Tính">
                </td>
            </tr>
        </table>
        </form>
    </body>
</html> 
<br>

<!-- 
//Bai tiep theo// -->
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Tính tiền Karaoke</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
    <style>
         #tb1{
            background-color:gray;
            border-width: 2px;
            border-style: solid;
            color:black;
            border-color: brown;
            box-shadow: 5px 5px 5px black;
         }
    
    </style>
    <body>
        <?php
        $tien=0;
        if(isset($_POST['submit']))
        {
            $Start=$_POST['start'];
            $End=$_POST['end'];
            if($Start<10 || $End>24)
            {
                $tien="nhập sai giờ làm";
            }
            else
            {
                if($Start >=10 && $End <=17)
                {
                    $tien=($End-$Start)*20000;
                }
                if($Start >=17 && $End <=24)
                {
                    $tien=($End-$Start)*45000;
                }
                if($Start <17 && $End>17 )
                {
                    $tien=(17-$Start)*20000 + ($End-17)*45000;
                }
                if($Start>$End) 
                {
                    $tien="Giờ kết thúc phải lớn hơn giờ bắt đầu";
                }
            }
        }
        ?>

        <form action="" method="POST" id="ab">
        <table bgcolor="#20B2AA" align="center" id="tb1">
            <tr>
                <td colspan="3" bgcolor="#008080" align="center">
                <h2 style="font-size:20px;color:red">Tính tiền Karaoke</h2>
                </td>
            </tr>
            <tr>
                <td>Giờ bắt đầu</td>
                <td>
                    <input type="text" name="start" placeholder="nhập giờ bắt đầu" size ="30"
                    value ="<?php if(isset($_POST['start'])) echo$_POST['start']; ?>"
                    >
                </td>
                <td>(h)</td>
            </tr>
            <tr>
                <td>Giờ kết thúc</td>
                <td>
                    <input type="text" name="end" placeholder="nhập giờ kết thúc" size ="30"
                    value ="<?php if(isset($_POST['end'])) echo$_POST['end']; ?>"
                    >
                </td>
                <td>(h)</td>
            </tr>
            <tr>
                <td>Tiền thanh toán</td>
                <td>
                    <input type="text" name="tien" size ="30" readonly value="<?php echo $tien ?>" >
                </td>
                <td>VNĐ</td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <input type="submit" name="submit" value="Tính tiền">
                </td>
            </tr>
        </table>
        </form>
    </body>
</html> 
<br>

<!-- 
/////Bai tiep theo//// -->
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Xét tốt nghiệp</title>
        <!-- <link rel="stylesheet" href="style.css"> -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
    <style>
         #tb2{
            background-color:brown;
            border-width: 2px;
            border-style: solid;
            color:black;
            border-color: grey;
            box-shadow: 5px 5px 5px black;
         }
    </style>
    <body>
        <?php
        $diemchuan=20;
        $tongdiem=0;
        $ketqua=" ";
        if(isset($_POST['submit']))
        {
            $toan=$_POST['toan'];
            $ly=$_POST['ly'];
            $hoa=$_POST['hoa'];
            $tongdiem=($toan+$ly+$hoa);
            
            if($toan<0 || $toan>10 || $ly<0 || $ly>10 || $hoa<0 || $hoa>10)
            {
                $ketqua="nhập sai, nhập lại";
            }
            else
            {
                if($toan == 0 || $ly== 0 || $hoa== 0)
                {
                    $ketqua="Rớt";
                }
                else 
                {
                    if($tongdiem >= $diemchuan) $ketqua= "Đậu";
                    else $ketqua="Rớt";
                }
            }
        }
        ?>

        <form action="" method="POST" id="ab">
        <table bgcolor="#DDA0DD" align="center" id="tb2">
            <tr>
                <td colspan="3" bgcolor="#FF1493" align="center">
                <h2 style="font-size:20px;color:red">Kết quả đại học</h2>
                </td>
            </tr>
            <tr>
                <td>Toán</td>
                <td>
                    <input type="text" name="toan" placeholder="nhập điểm toán" size ="30"
                    value ="<?php if(isset($_POST['toan'])) echo$_POST['toan']; ?>"
                    >
                </td>
                <td>&emsp;</td>
            </tr>
            <tr>
                <td>Lý</td>
                <td>
                    <input type="text" name="ly" placeholder="nhập điểm lý" size ="30"
                    value ="<?php if(isset($_POST['ly'])) echo$_POST['ly']; ?>"
                    >
                </td>
                <td>&emsp;</td>
            </tr>
            <tr>
                <td>Hoá</td>
                <td>
                    <input type="text" name="hoa" placeholder="nhập điểm hoá" size ="30"
                    value ="<?php if(isset($_POST['hoa'])) echo$_POST['hoa']; ?>"
                    >
                </td>
                <td>&emsp;</td>
            </tr>
            <tr>
                <td>Điểm chuẩn  &ensp;</td>
                <td>
                    <input type="text" name="diemchuan" size ="30"
                    value ="<?php echo $diemchuan ?>"
                    >
                </td>
                <td>&emsp;</td>
            </tr><tr>
                <td>Tổng điểm</td>
                <td>
                    <input type="text" name="tongdiem" size ="30"
                    value ="<?php echo $tongdiem ?>"
                    >
                </td>
                <td>&emsp;</td>
            </tr>
            <tr>
                <td>Kết quả thi</td>
                <td>
                    <input type="text" name="ketqua" size ="30" readonly value="<?php echo $ketqua ?>">
                </td>
                <td>&emsp;</td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="submit" value="Xem kết quả">
                </td>
            </tr>
        </table>
        </form>
    </body>
</html> 
<br>

<!-- ///Bai tiep theo/// -->
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Chu vi HCN</title>
        <!-- <link rel="stylesheet" href="style.css"> -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
    <style>
         #tb3{
            background-color:green;
            border-width: 2px;
            border-style: solid;
            color:black;
            border-color: grey;
            box-shadow: 5px 5px 5px black;
         }
    </style>
    <body>
        <?php
        if(isset($_POST["submit"]))
        {
            $Width=$_POST["width"];
            $Height=$_POST["height"];
            if($Width<=0||$Height<=0) $Perimeter="nhập sai, nhập lại";
            else $Perimeter=($Width+$Height)*2;
        }
        ?>
        <form action="" method="post" id="ab">
            <table bgcolor="#faebd" align="center" id="tb3">
                <tr>
                    <td align="center" bgcolor="orange" colspan="2" >
                    <h2 style="font-size:20px;color:red">Chu Vi HCN</h2>
                    </td>
                </tr>
                <tr>
                    <td>Width</td>
                    <td>
                        <input Type="text" size="30" name="width" placeholder="nhập chiều dài"
                        value="<?php if(isset($_POST['width'])) echo $_POST['width'];?>"
                        >
                    </td>
                </tr>
                <tr>
                    <td>Height</td>
                    <td>
                        <input Type="text" size="30" name="height" placeholder="nhập chiều rộng"
                        value="<?php if(isset($_POST['height'])) echo $_POST['height'];?>"
                        >
                    </td>
                </tr>
                <tr>
                    <td>Perimeter</td>
                    <td>
                        <input Type="text" size="30" placeholder="kết quả" readonly value="<?php echo "$Perimeter"?>">
                        
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="tính" name="submit">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
<br>

<!-- //Bài tiếp// -->
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Chu vi và diện tích hình tròn</title>
        <!-- <link rel="stylesheet" href="style.css"> -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
    <style>
         #tb4{
            background-color:pink;
            border-width: 2px;
            border-style: solid;
            color:black;
            border-color: grey;
            box-shadow: 5px 5px 5px black;
         }
    
    </style>
    <body>
        <?php
        $Perimeter=0;
        $Area=0;
        if(isset($_POST["submit"]))
        {
            $bk=$_POST["bk"];
            
            if($bk<=0)
            {
                $Perimeter="nhập sai, nhập lại";
                $Area="nhập sai, nhập lại";
            }
            else
            {
                $Perimeter= $bk*2*3.14;
                $Area= $bk*$bk*3.14;
            }
            
        }
        ?>
        <form action="" method="post" id="ab">
            <table bgcolor="#faebd" align="center" id="tb4">
                <tr>
                    <td align="center" bgcolor="orange" colspan="2" >
                    <h2 style="font-size:20px;color:red">Chu vi và dt hình tròn</h2>
                    </td>
                </tr>
                <tr>
                    <td>Bán kính</td>
                    <td>
                        <input Type="text" size="30" name="bk" placeholder="nhập bán kính"
                        value="<?php if(isset($_POST['bk'])) echo $_POST['bk'];?>"
                        >
                    </td>
                </tr>
                <tr>
                    <td>Perimeter</td>
                    <td>
                        <input Type="text" size="30"  placeholder="kết quả" readonly value="<?php echo "$Perimeter cm";?>">
                    </td>
                </tr>
                <tr>
                    <td>Area</td>
                    <td>
                        <input Type="text" size="30" placeholder="kết quả" readonly value="<?php echo "$Area cm2";?>">
                        
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="tính" name="submit">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
<br>

<!-- //bai riep// -->
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Diện tích HCN</title>
        <!-- <link rel="stylesheet" href="style.css"> -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
    <style>
         #tb5{
            background-color:yellow;
            border-width: 2px;
            border-style: solid;
            color:black;
            border-color: grey;
            box-shadow: 5px 5px 5px black;
         }
    </style>
    <body>
        <?php
        if(isset($_POST['submit']))
        {
            $Width=$_POST['width'];
            $Height=$_POST['height'];
            if($Width<$Height||$Width<=0||$Height<=0) $Area="nhập sai, nhập lại";
            else $Area=$Width*$Height;
        }
        ?>

        <form action="" method="POST" id="ab">
        <table bgcolor="#faebd" align="center" id="tb5">
            <tr>
                <td colspan="2" bgcolor="orange" align="center">
                <h2 style="font-size:20px;color:red">Diện tích HCN</h2>
                </td>
            </tr>
            <tr>
                <td>Width</td>
                <td>
                    <input type="text" name="width" placeholder="nhập chiều dài" size ="30"
                    value ="<?php if(isset($_POST['width'])) echo$_POST['width']; ?>"
                    >
                </td>
            </tr>
            <tr>
                <td>Height</td>
                <td>
                    <input type="text" name="height" placeholder="nhập chiều rộng" size ="30"
                    value ="<?php if(isset($_POST['height'])) echo$_POST['height']; ?>"
                    >
                </td>
            </tr>
            <tr>
                <td>Area</td>
                <td>
                    <input type="text" name="area" size ="30" readonly value="<?php echo $Area ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="Tính">
                </td>
            </tr>
        </table>
        </form>
    </body>
</html> 
<br>

<!-- //Phép tính// -->
<h1>3.CÁC PHÉP TÍNH TOÁN</h1>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Phép tính</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
    <style>
         #tb8{
            background-color:#faeb;
            border-width: 2px;
            border-style: solid;
            color:black;
            border-color: grey;
            box-shadow: 5px 5px 5px black;
         }
    </style>
    <body>

        <form action="detailView.php" method="POST" id="ab">
            <table bgcolor="white" align="center" id="tb8">
                <tr>
                    <td colspan="2" align="center" id="">
                        <h2 style="color:#7B68EE">Phép tính trên hai số</h2>
                    </td>
                </tr>
                <tr>
                    <td style="color:#FF8C00" align="right"><b>Chọn phép tính:&ensp;</b></td>
                    <td>
                        <span><input type="radio" name="pheptinh" Value="cong"><span style="color:#FF8C00">Cộng </span><span>
                        <span><input type="radio" name="pheptinh" Value="tru"><span style="color:#FF8C00">Trừ </span><span>
                        <span><input type="radio" name="pheptinh" Value="nhan"><span style="color:#FF8C00">Nhân</span><span>
                        <span><input type="radio" name="pheptinh" Value="chia"><span style="color:#FF8C00">Chia </span><span>
                    </td>
                </tr>
                <tr>
                    <td align="right"><b style="color:blue">Số thứ nhất:&ensp;</b></td>
                    <td>
                        <input type="text" name="so1" placeholder="nhập số thứ nhất" size ="25">
                    </td>
                </tr>
                    <td align="right"><b style="color:blue" >Số thứ hai:&ensp;</b></td>
                    <td>
                        <input type="text" name="so2" placeholder="nhập số thứ hai" size ="25">
                    </td>
                </tr>
                </tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="tính" size ="25">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
<br>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Kết quả</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
    <style>
         #tb7{
            background-color:#faeb;
            border-width: 2px;
            border-style: solid;
            color:black;
            border-color: grey;
            box-shadow: 5px 5px 5px black;
         }
    </style>
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
        <form action="ketqua.php" method="POST" id="ab">
            <table bgcolor="white" align="center" id="tb7">
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
                    <!-- <td>
                        <a href="javascript:window.history.back(-1);"><u><i>Quay lại trang trước</i></u></a> 
                    </td> -->
                </tr>
            </table>
        </form>
    </body>
</html>
<br>

<h1>4.Bài Tập Phần mySQL+PHP</h1>

<!-- //Phần kết nối SQL// -->
<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show data from ct_hoadon table</title>
</head>
<style>
   #tb8{
            background-color:#faeb;
            border-width: 2px;
            border-style: solid;
            align:center;
            color:black;
            border-color: grey;
            box-shadow: 5px 5px 5px black;
         }
</style>
<body>
<form action="" method="" id="ab" class="ac">
<h2 style="color:#7B68EE">Quản lý bán sữa</h2>
<table align="center" border="true" id="tb8">

    <tr>
        <th>So_hoa_don</th>
        <th>Ma_sua</th>
        <th>So_luong</th>
        <th>Don_gia</th>
    </tr>
    <?php
        require ("detailView.php");
        //1-> mo ket noi
        // include ("detailView.php");
        $conn=new mysqli($hostname,$username,$password,$dbname);
        if ($conn->connect_error){
            echo "loi ket noi db".$conn->connect_error;
        }
        //2-> xay dung cau truy van
        $query='select * from ct_hoadon';// tiep can huong 1
        //3-> thuc thi cau truy van
        $result=$conn->query($query);
        if (!$result) echo "cau truy van bi sai";
        //4->xu ly ket qua tra ve
        if ($result->num_rows != 0){
            while ($row=$result->fetch_array()){//row la 1 mang
                if ($row['Don_gia']>=50000 && substr($row["Ma_sua"],0,2)==="VN") {//don gia lon hon 50000 va ma_sua bat dau bang VN
                    echo "<tr>";
                    echo "<td>" . $row['So_hoa_don'] . "</td>";
                    echo "<td>" . $row['Ma_sua'] . "</td>";
                    echo "<td>" . $row['So_luong'] . "</td>";
                    echo "<td>" . $row['Don_gia'] . "</td>";
                    echo "</tr>";
                }
            }
        } else echo "bang khong co du lieu";
        //5-> don dep bo nho, dong ket noi
        // $conn->free($result);
        $conn->close();

    ?>
</table>
    </form>
</body>
</html>
<br>

<!-- //bai tiep theo// -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>2.1</title>
</head>
<style>
   #tb9{
            background-color:#faeb;
            border-width: 2px;
            border-style: solid;
            align:center;
            color:black;
            border-color: grey;
            box-shadow: 5px 5px 5px black;
         }
</style>
<body>
<form action="" method="" id="ab" class="ac">
<h2 style="color:#7B68EE">Lấy danh sách thông tin bán sửa(Bài số 2)</h2>
    <table align="center" border="true" id="tb9">
        <tr>
            <th>Mã HS</th>
            <th>Tên hãng sữa</th>
            <th>Địa chỉ</th>
            <th>Điện thoại</th>
            <th>Email</th>
        </tr>
        <?php
            require("detailView.php");
            $query='select * from hang_sua';
            $result=$conn->query($query);
            if (!$result) echo "cau truy van bi sai";
            if ($result->num_rows != 0){
                while ($row=$result->fetch_array()){//row la 1 mang
                    echo "<tr>";
                    echo "<td>" . $row['Ma_hang_sua'] . "</td>";
                    echo "<td>" . $row['Ten_hang_sua'] . "</td>";
                    echo "<td>" . $row['Dia_chi'] . "</td>";
                    echo "<td>" . $row['Dien_thoai'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "</tr>";
                }
            } else echo "bang khong co du lieu";
            $conn->close();
        ?>
    </table>
        </form>
</body>
</html>
<br>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>2.2</title>
    <style>
        #th
        {
            color:red;
        }
         #tb10{
            background-color:#faeb;
            border-width: 2px;
            border-style: solid;
            align:center;
            color:black;
            border-color: grey;
            box-shadow: 5px 5px 5px black;
         }
</style>
   
</head>
<body>
<form action="" method="" id="ab" class="ac">
<h2 style="color:#7B68EE">Lấy danh sách thông tin bán sửa(Bài số 2)</h2>
    <h3 style="text-transform: uppercase" color="blue">Thông tin khách hàng</h3>
    <table align="center" border="true" id="tb10">
        <tr id="th">
            <th>Mã Khách Hàng</th>
            <th>Tên Khách Hàng</th>
            <th>Giới tính</th>
            <th>Địa chỉ</th>
            <th>Điện thoại</th>
            <th>Email</th>
        </tr>
        <?php
            require("detailView.php");
            $query='select * from khach_hang';
            $result=$conn->query($query);
            if (!$result) echo "cau truy van bi sai";
            if ($result->num_rows != 0){
                $dem=0;
                while ($row=$result->fetch_array()){
                    if($dem%2==0) echo"<tr bgcolor='yellow'>";
                    else echo"<tr>";
                    for($i=0;$i<$result->field_count;$i++)
                    {
                        if($i==2)
                        {
                            // if($row[$i]==1) echo"<td align='center'>Nam</td>";
                            // else echo"<td align='center'>Nữ</td>";
                            if($row[$i]==1) echo"<td align='center'><img width='50px' height='50px' src='nam.jpg'></td>";
                            else echo"<td align='center'><img width='50px' height='50px' src='nu.jpg'></td>";
                        }
                        else echo"<td>".$row[$i]."</td>";
                    }
                    $dem++;
                }
            } else echo "bang khong co du lieu";
            $conn->close();
        ?>
    </table>
    </form>
</body>
</html>
<br>
<!-- //Bai tiep theo// -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<style>
    #tb11{
            background-color:brown;
            border-width: 2px;
            border-style: solid;
            align:center;
            color:black;
            border-color: grey;
            box-shadow: 5px 5px 5px black;
         }
</style>
<body>
    <?php
    if(isset($_POST['reset']))
    {
        $ten=$ho=$diachi=""; 
    }
    if(isset($_POST['xemkq'])) header("location:excireView.php");
    if(isset($_POST['submit']))
    {
        $ten=$_POST['ten'];
        $ho=$_POST['ho'];
        $diachi=$_POST['dc'];
        $khoa=$_POST['khoa'];
        $lop=$_POST['lop'];
        require('detailView.php');
        $query="INSERT INTO sv(ten,ho,diachi,lop,khoa) VALUE('$ten','$ho','$diachi','$lop','$khoa')";
        $result=$conn->query($query);
        if(!$result) echo "query fail: ".$conn->error; 
    }
    ?>
    <form action="" method="post" id="ab">
        <table align="center" bgcolor="#FFFFE0" id="tb11">
        <h2 style="color:#7B68EE">Bài sinh viên</h2>
            <tr>
                <td  bgcolor="yellow" align ="center" colspan="3">
                    <h2>Nhập thông tin sinh viên</h2>
                </td>
            </tr>
            <tr>
                <td>Tên</td>
                <td>
                    <input type="text" name="ten" size="30" placeholder="nhập tên" 
                    value="<?php if(isset($_POST['ten'])) echo $_POST['ten']; ?>"
                    >
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Họ</td>
                <td>
                    <input type="text" name="ho" size="30" placeholder="nhập họ" 
                    value="<?php if(isset($_POST['ho'])) echo $_POST['ho']; ?>"
                    >
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Địa chỉ &emsp;</td>
                <td>
                    <input type="text" name="dc" size="30" placeholder="nhập địa chỉ" 
                    value="<?php if(isset($_POST['dc'])) echo $_POST['dc']; ?>"
                    >
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <b>khoá</b>
                    <select name="khoa">
                        <option value="57">57</option>
                        <option value="58">58</option>
                        <option value="59">59</option>
                        <option value="60">60</option>
                        <option value="61">61</option>
                    </select>
                    <b>Lớp</b>
                    <select name="lop">
                        <option value="1">CNTT1</option>
                        <option value="2">CNTT2</option>
                        <option value="3">CNTT3</option>
                        <option value="4">CNTT4</option>
                        <option value="5">CNTT5</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="3">
                    <input type="submit" name="submit" value="gửi">
                    <input type="submit" name="reset" value="xoá">
                    <input type="submit" name="xemkq" value="xem kết quả">
                </td>
            </tr>
            <tr <?php if(!isset($result)) echo "hidden";?> >
                <td colspan="3" align="center" >New record create!</td>
            </tr>
        </table>
    </form>
</body>
</html>
<br>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show</title>
</head>
<style>
    #tb14{
            background-color:brown;
            border-width: 2px;
            border-style: solid;
            align:center;
            color:black;
            border-color: grey;
            box-shadow: 5px 5px 5px black;
         }
</style>
<body>
    <h2 style="color:#7B68EE;padding-left:560px">Thông tin sinh viên</h2>
    <form action="" method="post" id="ab">
<table align="center" border="true" id="tb14">
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
            // echo "<a href='javascript:window.history.back(-1);'>Trở về trang trước</a>";
            echo "</td>";
            echo "</tr>";
        ?>
    </table>
    </form>
</body>
</html>

<?php
get_footer();
?>

