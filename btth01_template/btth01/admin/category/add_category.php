<?php
    require '../layout/header.php';

    $id = $name = '';
    $id_error = $name_error =  '';


    if (isset($_POST['submit'])) {
        if (empty($_POST['id'])) {
            $id_error = 'Mã thể loại là bắt buộc';
        } else {
            $id = htmlspecialchars($_POST['id']);
        }

        if (empty($_POST['name'])) {
            $name_error = 'Tên thể loại là bắt buộc';
        } else {
            $name = htmlspecialchars($_POST['name']);
        }


        if (empty($name_error)) {
            $sql = "INSERT INTO theloai(ma_tloai, ten_tloai) VALUES (?, ?)";
            try {
                $statement = $connect->prepare($sql);
                $statement->bindParam(1, $id);
                $statement->bindParam(2, $name);
                $statement->execute();

                header("Location: category.php");
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
?>
    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm mới thể loại</h3>
                <form action="add_category.php" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">ID thể loại</span>
                        <input type="text" class="form-control" name="id" >
                    </div>
                        <p class="text-danger">
                            <?php echo $id_error; ?>
                        </p>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên thể loại</span>
                        <input type="text" class="form-control" name="name" >
                    </div>
                    <p class="text-danger">
                        <?php echo $name_error; ?>
                    </p>
                    <div class="form-group  float-end ">
                        <input  name="submit" type="submit" value="Thêm" class="btn btn-success">
                        <a href="http://localhost/CSE485_2023/btth01_template/btth01/admin/category/category.php" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php include '../layout/footer.php';?>