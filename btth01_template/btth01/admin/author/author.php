<?php
include '../layout/header.php';

$sql = "select * from tacgia";

if ($connect != null) {
    try {
        $statement = $connect->prepare($sql);
        $statement->execute();
        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
        $authors = $statement->fetchAll();

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
                <a href="add_author.php" class="btn btn-success">Thêm mới</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Mã Tác giả</th>
                        <th scope="col">Tên Tác giả</th>
                        <th scope="col">Hình tác giả</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($authors as $author): ?>
                        <tr>
                            <th scope="row"><?php echo $author['ma_tgia']; ?></th>
                            <td>
                                <?php echo $author['ten_tgia']; ?>
                            </td>
                            <td>
                                <?php echo $author['hinh_tgia']; ?>
                            </td>
                            <td>
                                <a href=".php?id=<?php echo $author['ma_tgia']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a href=".php?id=<?php echo $author['ma_tgia']; ?>"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </main>
<?php include '../layout/footer.php';?>