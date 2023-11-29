<?php
    include '../layout/header.php';

    $sql = "select * from theloai";

    if ($connect != null) {
        try {
            $statement = $connect->prepare($sql);
            $statement->execute();
            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
            $types = $statement->fetchAll();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $connect = null;
        }
    }
?>

    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <a href="add_category.php" class="btn btn-success">Thêm mới</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên thể loại</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($types as $type): ?>
                            <tr>
                                <th scope="row"><?php echo $type['ma_tloai']; ?></th>
                                <td>
                                    <?php echo $type['ten_tloai']; ?>
                                </td>
                                <td>
                                    <a href="edit_category.php?id=<?php echo $type['ma_tloai']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                </td>
                                <td>
                                    <a href="delete_category.php?id=<?php echo $type['ma_tloai']; ?>"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </main>
<?php include '../layout/footer.php';?>