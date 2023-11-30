<?php
include '../layout/header.php';

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

$id = empty($_GET['id'])?$_POST['id']: $_GET['id'];
$sql = "select * from baiviet where ma_bviet=$id";
try {
    $statement = $connect->prepare($sql);
    $statement->execute();
    $article = $statement->fetch();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


    <main class="container mt-5 mb-5">
    <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
    <div class="row">
    <div class="col-sm">
    <h3 class="text-center text-uppercase fw-bold">Sửa thông tin bài viết</h3>
    <form action="edit_article.php" method="post">
    <div class="input-group mt-3 mb-3">
        <span class="input-group-text" id="lblCatName">ID bài viết</span>
        <input type="text" class="form-control" name="id" readonly value="<?=$article['ma_bviet']?>">
    </div>
    <div class="input-group mt-3 mb-3">
        <span class="input-group-text" id="lblCatName">Tiêu đề</span>
        <input type="text" class="form-control" name="title" value="<?=$article['tieude']?>">
    </div>
    <div class="input-group mt-3 mb-3">
        <span class="input-group-text" id="lblCatName">Tên bài viết</span>
        <input type="text" class="form-control" name="name" value="<?=$article['ten_bhat']?>">
    </div>
    <div class="input-group mt-3 mb-3">
    <span class="input-group-text" id="lblCatName">Thể loại</span>
    <select name="type" class="form-select" aria-label="Default select example">
        <option value="<?php echo $article['ma_tloai']?>" selected >
        <?php
        $name = $article['ma_tloai'];
        $sql2 = 'select * from theloai where ma_tloai=?';
        $statement = $connect->prepare($sql2);
        $statement->execute([$name]);
        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
        $type = $statement->fetch();
        echo $type['ten_tloai'];
        ?>
        </option>
        <?php foreach ($types as $type): ?>
            <option value="<?= $type['ma_tloai']; ?>"><?= $type['ten_tloai']; ?></option>
        <?php endforeach; ?>
    </select>
    </div>
        <div class="input-group mt-3 mb-3">
            <span class="input-group-text" id="lblCatName">Tóm tắt</span>
            <textarea name="tomtat" rows="4" cols="50">
                            <?=$article['tomtat']?>
                        </textarea>
        </div>
        <div class="input-group mt-3 mb-3">
            <span class="input-group-text" id="lblCatName">Tác giả</span>
            <select name="author" class="form-select" aria-label="Default select example">
                <option value="<?$article['ma_tgia']?>" selected >
                    <?php
                    $au = $article['ma_tgia'];
                    $sql2 = 'select * from tacgia where ma_tgia=?';
                    $statement = $connect->prepare($sql2);
                    $statement->execute([$au]);
                    $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                    $aut = $statement->fetch();
                    echo $aut['ten_tgia'];
                    ?>
                </option>
                <?php foreach ($authors as $author): ?>
                    <option value="<?= $author['ma_tgia']; ?>"><?= $author['ten_tgia']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-group mt-3 mb-3">
            <span class="input-group-text" id="lblCatName">Ngày viết</span>
            <input type="datetime-local" class="form-control" name="publish" value="<?=$article['ngayviet']?>">
        </div>

        <div class="form-group  float-end ">
            <input  name="submit" type="submit" value="Lưu" class="btn btn-success">
            <a href="article.php" class="btn btn-warning ">Quay lại</a>
        </div>
    </form>
    </div>
    </div>
    </main>

<?php

if (isset($_POST['submit'])) {
    try {
        $name_up = htmlspecialchars($_POST['name']);
        $title_up = htmlspecialchars($_POST['title']);
        $typeInput_up = htmlspecialchars($_POST['type']);
        $tomtat_up = htmlspecialchars($_POST['tomtat']);
        $author_up = htmlspecialchars($_POST['author']);
        $publish_up = htmlspecialchars($_POST['publish']);
        $statement = $connect->prepare("UPDATE baiviet 
                SET ten_bhat='$name_up' ,
                    tieude='$title_up',
                    ma_tloai=$typeInput_up,
                    tomtat='$tomtat_up',
                    ma_tgia=$author_up,
                    ngayviet='$publish_up'
               WHERE ma_bviet=?;");
        $statement->execute([$id]);
        header('location: article.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<?php include '../layout/footer.php';?>