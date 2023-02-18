<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = htmlspecialchars($_POST['my_name'], ENT_QUOTES);
  $age = (int)$_POST['my_age'];
  $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
  session_start();
  $_SESSION['name'] = $name;
  $_SESSION['age'] = $age;
  $_SESSION['email'] = $email;

  // name check
  if (empty($name)) {
    $error['name'] = '名前を入力してください';
    // name length check
    if(mb_strlen($name) > 20) {
      $error['name'] = '名前は20文字以内で入力してください';
    }
  }

  // age check
  if (empty($age)) {
    $error['age'] = '年齢を入力してください';
  } elseif ($age < 0 || $age > 120) {
    $error['age'] = '年齢は0以上120以下で入力してください';
  } elseif (!preg_match('/^[0-9]+$/', $age)) {
    $error['age'] = '年齢は半角数字で入力してください';
  }

  // email check
  if (empty($email)) {
    $error['email'] = 'メールアドレスを入力してください';
  } elseif (!preg_match('/^[a-zA-Z0-9.!#$%&\\'*+\\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\\.[a-zA-Z0-9-]+)*$/', $email)) {
    $error['email'] = 'メールアドレスを正しく入力してください';
  }

}

// エラーがある場合前の画面へ戻す
if (isset($error)) {
  // エラーメッセージをセッションに保存
  $_SESSION['error'] = $error;
  header('Location: index.php');
  exit;
}

?>
<!DOCTYPE html>
<html lang="ja">

<?php include './common/head.php';?>

<body>
  <div class="container-sm mt-5">
    <h1>データ確認画面</h1>
    <form action="compleat.php" method="post">
      <input type="hidden" name="my=name" value="<?php echo $name?>">
    <input type="hidden" name="my=age" value="<?php echo $age?>">
    <table class="table">
      <tbody>
        <tr>
          <th scope="row">名前</th>
          <td><?php echo $name?></td>
        </tr>
        <tr>
          <th scope="row">年齢</th>
          <td><?php echo $age?></td>
        </tr>
        <tr>
          <th scope="row">メールアドレス</th>
          <td><?php echo $email?></td>
        </tr>
      </tbody>
    </table>
    <div class="mx-auto">
      <input type="submit" class="btn btn-primary" value="完了">
    </div>
  </form>
</div>
</body>

</html>