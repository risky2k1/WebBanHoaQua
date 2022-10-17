<?php
session_start();
echo $_GET['id'];
$id = $_GET['id'];

try {
  if (empty($_SESSION['cart'][$id])) {
    require '/laragon/www/WEBbanhang/db/dbhelper.php';
    $sql = "select * from product where id='$id'";
    // $productList = executeResult($sql);
    $each = executeSingleResult($sql);

    // $result = mysqli_query($connect, $sql);
    // $each = mysqli_fetch_array($result);
    $_SESSION['cart'][$id]['title'] = $each['title'];
    $_SESSION['cart'][$id]['price'] = $each['price'];
    $_SESSION['cart'][$id]['thumbnail'] = $each['thumbnail'];
    $_SESSION['cart'][$id]['quantity'] = 1;
  } else {
    $_SESSION['cart'][$id]['quantity']++;
  }
  // echo '<br> chay la: ';
  // echo 1;
} catch (Exception $e) {
}
