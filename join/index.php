<?php 
  session_start();
  $error = array();
  $nick_name = '';
  $email = '';
  $password = '';
  $image = '';

  if(isset($_POST) && !empty($_POST)) {
    $nick_name = htmlspecialchars($_POST['nick_name'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    $image = htmlspecialchars($_POST['image'], ENT_QUOTES, 'UTF-8');

    if($_POST['nick_name']=='') {
      $error['nick_name'] = 'blank';
    }
    if($_POST['email']=='') {
       $error['email'] = 'blank';
    }
    if($_POST['password']=='') {
       $error['password'] = 'blank';
    } elseif(strlen($_POST['password']) < 4) {
      $error['password'] = 'length';
    }
    if($_POST['image']=='') {
       $error['image'] = 'blank';
    } else {
      $fileName = $_FILES['image']['nick_name'];
      if(!empty($fileName)) {
        $ext = substr($fileName, -3);
        if($ext != 'jpg' && $ext != 'gif') {
           $error['image'] = 'type';
        }
       }
     }

    if (empty($error)) {
      $image = date('YmdHis').$_FILES['image']['nick_name'];
      move_uploaded_file($_FILES['image']['tmpname'], '../member_picture/'.$image);

      $_SESSION['join'] = $_POST;
      $_SESSION['join']['image'] = $image;
      header('Location: check.php');
      exit();
    }
  }
 ?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SeedSNS</title>

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../assets/css/form.css" rel="stylesheet">
    <link href="../assets/css/timeline.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">
    <!--
      designフォルダ内では2つパスの位置を戻ってからcssにアクセスしていることに注意！
     -->


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php"><span class="strong-title"><i class="fa fa-twitter-square"></i> Seed SNS</span></a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 content-margin-top">
        <legend>会員登録</legend>
        <form method="post" action="" class="form-horizontal" role="form">
          <!-- ニックネーム -->
          <div class="form-group">
            <label class="col-sm-4 control-label">ニックネーム</label>
            <div class="col-sm-8">
              <input type="text" name="nick_name" class="form-control" placeholder="例： Seed kun" 
              value="<?php echo $nick_name; ?>" >
              <?php if(isset($error['nick_name']) && $error['nick_name']=='blank'){ ?>
              <p class="error">*ニックネームを入力してください</p>
              <?php } ?>

            </div>
          </div>
          <!-- メールアドレス -->
          <div class="form-group">
            <label class="col-sm-4 control-label">メールアドレス</label>
            <div class="col-sm-8">
              <input type="email" name="email" class="form-control" placeholder="例： seed@nex.com" 
              value="<?php echo $email; ?>">
              <?php if(isset($error['email']) && $error['email']=='blank'){ ?>
              <p class="error">*メールアドレスを入力してください</p>
              <?php } ?>
            </div>
          </div>
          <!-- パスワード -->
          <div class="form-group">
            <label class="col-sm-4 control-label">パスワード</label>
            <div class="col-sm-8">
              <input type="password" name="password" class="form-control" placeholder="" 
              value="<?php echo $password; ?>">
              <?php if(isset($error['password'])){ ?>
              <?php if($error['password']=='blank'){ ?>
              <p class="error">*パスワードを入力してください</p>
              <?php } elseif ($error['password']=='length') { ?>
              <p class="error">*パスワードは４文字以上で入力してください</p>
              <?php } ?>
              <?php } ?>
            </div>
          </div>
          <!-- プロフィール写真 -->
          <div class="form-group">
            <label class="col-sm-4 control-label">プロフィール写真</label>
            <div class="col-sm-8">
              <input type="file" name="image" class="form-control" 
              value="<?php echo $image; ?>" >
              <?php if (isset($error['image'])) {?>
              <?php if($error['image']=='blank'){ ?>
              <p class="error">*恐れ入りますが、画像を改めて指定してください</p>
              <?php } elseif ($error['image']=='type') { ?>
              <p class="error">*写真などは「.gif」または「.jpg」の画像を指定してください</p>
              <?php } ?>
              <?php } ?>
            </div>
          </div>

          <input type="submit" class="btn btn-default" value="確認画面へ">
        </form>
      </div>
    </div>
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>