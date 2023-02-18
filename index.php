<?php
session_start();
// $_SESSION['error']がある場合は、エラーメッセージを表示する
if (isset($_SESSION['error'])) {
  $error = $_SESSION['error'];
  // エラーメッセージをクリア
  unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="ja">

<?php include './common/head.php';?>

<body>
  <div class="form-area container-sm mt-5">
    <h1>Webフォーム入力テスト</h1>
    <?php if (!empty($error)) : ?>
      <div class="mt-3">
        <ul class="alert alert-danger" role="alert">
          <?php foreach ($error as $err) : ?>
            <li class="mx-2"><?php echo $err; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <form action="receive.php" method="post" class="mt-4">
      <div class="mb-3">
        <label for="my_name" class="form-label">名前</label>
        <input type="text" class="form-control" name="my_name" value="<?php if (!empty($_SESSION['name'])) {
                                                                        echo $_SESSION['name'];
                                                                      } ?>">
      </div>
      <div class="mb-3">
        <label for="my_age" class="form-label">年齢</label>
        <input type="number" class="form-control" name="my_age" value="<?php if (!empty($_SESSION['age'])) {
                                                                          echo $_SESSION['age'];
                                                                        } ?>">
      </div>
      <div>
        <label for="email" class="form-label">メールアドレス</label>
        <input type="text" class="form-control" name="email" value="<?php if (!empty($_SESSION['email'])) {
                                                                      echo $_SESSION['email'];
                                                                    } ?>">
      </div>
      <div class="mt-3">
        <input type="submit" class="btn btn-primary" value="データの送信">
      </div>
    </form>
  </div>
</body>

</html>