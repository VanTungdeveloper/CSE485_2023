<?php
    include '../layout/header.php';

    $id = empty($_GET['id'])?$_POST['id']: $_GET['id'];
    $sql = "select * from theloai where ma_tloai=$id";
    try {
        $statement = $connect->prepare($sql);
        $statement->execute();
        $type = $statement->fetch();
//        header("Location: category.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>


    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin thể loại</h3>
                <form action="edit_category.php" method="post">
                <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatId">Mã thể loại</span>
                        <input type="text" value="<?=$type['ma_tloai']?>" class="form-control" name="id" readonly>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên thể loại</span>
                        <input type="text"  value="<?=$type['ten_tloai']?>"class="form-control" name="name">
                    </div>

                    <div class="form-group  float-end ">
                        <input name="submit" type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="category.php" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php

if (isset($_POST['submit'])) {
    try {
        $name_update = $_POST['name'];
        $statement = $connect->prepare("UPDATE theloai SET ten_tloai='$name_update' WHERE ma_tloai=?;");
        $statement->execute([$id]);
        header('location: category.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<?php include '../layout/footer.php';?>