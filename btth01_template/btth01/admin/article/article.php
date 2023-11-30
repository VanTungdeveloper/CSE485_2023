<?php
    include '../layout/header.php';

    $sql = "select * from baiviet";

    if ($connect != null) {
        try {
            $statement = $connect->prepare($sql);
            $statement->execute();
            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
            $articles = $statement->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $connect = null;
        }
    }
?>
    <main class="container mt-5 mb-5">
         <h3 class="text-center text-uppercase mb-3 text-primary">Danh sách bài viết</h3>
        <div class="row">
            <div class="col-sm">
                <a href="add_article.php" class="btn btn-success">Thêm mới</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Mã bài viết</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Tên bài hát</th>
                        <th scope="col">Thể loại</th>
                        <th scope="col">Tác giả</th>
                        <th scope="col">Ngày viết</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <th scope="row"><?php echo $article['ma_bviet']; ?></th>
                            <td>
                                <?php echo $article['tieude']; ?>
                            </td>
                            <td>
                                <?php echo $article['ten_bhat']; ?>
                            </td>
                            <td>
                                <?php
                                    $name = $article['ma_tloai'];
                                    $sql2 = 'select * from theloai where ma_tloai=?';
                                    $statement = $connect->prepare($sql2);
                                    $statement->execute([$name]);
                                    $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                                    $type = $statement->fetch();
                                    echo $type['ten_tloai'];
                                ?>
                            </td>
                            <td>
                                <?php
                                    $au = $article['ma_tgia'];
                                    $sql2 = 'select * from tacgia where ma_tgia=?';
                                    $statement = $connect->prepare($sql2);
                                    $statement->execute([$au]);
                                    $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                                    $aut = $statement->fetch();
                                    echo $aut['ten_tgia'];
                                ?>
                            </td>
                            <td>
                                <?php echo $article['ngayviet']; ?>
                            </td>
                            <td>
                                <a href="edit_article.php?id=<?php echo $article['ma_bviet']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a href="delete_article.php?id=<?php echo $article['ma_bviet']; ?>"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </main>
<?php include '../layout/footer.php';?>