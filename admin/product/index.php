<?php
require_once('../../db/dbhelper.php');
?>
<!DOCTYPE html>
<html>

<head>
  <title>Danh Mục Sản Phẩm</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link " href="../category/">Quản Lý Danh Mục</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="#">Quản Lý Sản Phẩm</a>
    </li>
  </ul>

  <div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h2 class="text-center">Danh Mục Sản Phẩm</h2>
      </div>
      <div class="panel-body">
        <a href="add.php">
          <button class="btn btn-success" style="margin-bottom: 15px;">Thêm Sản Phẩm</button>
        </a>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="50px">STT</th>
              <th>Hình Ảnh</th>
              <th>Tên Sản Phẩm</th>
              <th>Giá Bán</th>
              <th>Danh mục</th>
              <th>Ngày cập nhật</th>
              <th width="50px"></th>
              <th width="50px"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            //Lay danh sach danh muc tu database
            $sql          = 'select product.id,product.title,product.price,product.thumbnail,product.updated_at,category.name category_name from product left join category on product.id_category = category.id';
            $productList = executeResult($sql);

            $index = 1;
            foreach ($productList as $item) {
              echo '<tr>
                      <td>' . ($index++) . '</td>
                      <td> <img src="' . $item['thumbnail'] . '" style="max-width:100px;"/> </td>
                      <td>' . $item['title'] . '</td>
                      <td>' . $item['price'] . '</td>
                      <td>' . $item['category_name'] . '</td>
                      <td>' . $item['updated_at'] . '</td>
                      <td>
                        <a href="add.php?id=' . $item['id'] . '"><button class="btn btn-warning">Sửa</button></a>
                      </td>
                      <td>
                        <button class="btn btn-danger" onclick="deleteProduct(' . $item['id'] . ')">Xoá</button>
                      </td>
                    </tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function deleteProduct(id) {
      var option = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?')
      if (!option) {
        return;
      }

      // console.log(id)
      //ajax - lenh post
      $.post('ajax.php', {
        'id': id,
        'action': 'delete'
      }, function(data) {
        location.reload()
      })
    }
  </script>
</body>

</html>