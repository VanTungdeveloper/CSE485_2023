<?php
    require '../layout/header.php';
    if ($connect != null) {
        try {
            $statement = $connect->prepare("select * from theloai");
            $statement->execute();
            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
            $types= $statement->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $connect = null;
        }
    }

    if ($connect != null) {
        try {
            $statement = $connect->prepare("select * from tacgia");
            $statement->execute();
            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
            $authors= $statement->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $connect = null;
        }
    }

    $id = $name = $title= $typeInput= $tomtat = $author= $publish ='';

    if (isset($_POST['submit'])) {
        $id = htmlspecialchars($_POST['id']);
        $name = htmlspecialchars($_POST['name']);
        $title = htmlspecialchars($_POST['title']);
        $typeInput = htmlspecialchars($_POST['type']);
        $tomtat = htmlspecialchars($_POST['tomtat']);
        $author = htmlspecialchars($_POST['author']);
        $publish = htmlspecialchars($_POST['publish']);

        if (empty($name_error)) {
            $sql = "INSERT INTO baiviet(ma_bviet, tieude, ten_bhat, ma_tloai, tomtat, ma_tgia, ngayviet) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
            try {
                $statement = $connect->prepare($sql);
                $statement->bindParam(1, $id);
                $statement->bindParam(2, $title);
                $statement->bindParam(3, $name);
                $statement->bindParam(4, $typeInput);
                $statement->bindParam(5, $tomtat);
                $statement->bindParam(6, $author);
                $statement->bindParam(7, $publish);
                $statement->execute();

                header("Location: article.php");
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
?>
    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm bài viết</h3>
                <form action="add_article.php" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">ID bài viết</span>
                        <input type="text" class="form-control" name="id" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tiêu đề</span>
                        <input type="text" class="form-control" name="title" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên bài viết</span>
                        <input type="text" class="form-control" name="name" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Thể loại</span>
                        <select name="type" class="form-select" aria-label="Default select example">
                            <option value="" selected >Vui lòng chọn thể loại</option>
                            <?php foreach ($types as $type): ?>
                                <option value="<?= $type['ma_tloai']; ?>"><?= $type['ten_tloai']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tóm tắt</span>
                        <textarea name="tomtat" rows="4" cols="50">

                        </textarea>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tác giả</span>
                        <select name="author" class="form-select" aria-label="Default select example">
                            <option value="" selected >Vui lòng chọn tác giả</option>
                            <?php foreach ($authors as $author): ?>
                                <option value="<?= $author['ma_tgia']; ?>"><?= $author['ten_tgia']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Ngày viết</span>
                        <input type="datetime-local" class="form-control" name="publish" >
                    </div>

                    <div class="form-group  float-end ">
                        <input  name="submit" type="submit" value="Thêm" class="btn btn-success">
                        <a href="article.php" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php include '../layout/footer.php';?>