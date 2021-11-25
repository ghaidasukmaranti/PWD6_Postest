<?php
include_once("koneksi.php");

$id_user = $_POST['id_user'];
$no_hp = $_POST['no_hp'];
$pass = md5($_POST['password']);

$sql = "SELECT * FROM users WHERE id_user='$id_user' AND no_hp='$no_hp'AND password='$pass'";
session_start();
if ($_POST["captcha_code"] == $_SESSION["captcha_code"]){
    $login = mysqli_query($con, $sql);
    $ketemu = mysqli_num_rows($login);
    $r = mysqli_fetch_array($login);

    if ($ketemu > 0) {
        $_SESSION['iduser'] = $r['id_user'];
        $_SESSION['nohp'] = $r['no_hp'];
        $_SESSION['passuser'] = $r['password'];
        echo "USER BERHASIL LOGIN<br>";
        echo "Id user =", $_SESSION['iduser'], "<br>";
        echo "Nomor Telephone =", $_SESSION['nohp'], "<br>";
        echo "Password=", $_SESSION['passuser'], "<br>";
        echo "<a href=logout.php><b>LOGOUT</b></a></center>";
    }else {
        echo "<center>Login gagal! username, nomer telephone& password tidak benar<br>";
        echo "<a href=form_login.php><b>ULANGILAGI</b></a></center>";
    }
    mysqli_close($con);
}else {
    echo "<center>Login gagal! captcha tidak benar<br>";
    echo "<a href=form_login.php><b>ULANGILAGI</b></a></center>";
}
?>