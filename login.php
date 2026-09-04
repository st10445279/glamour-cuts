<?php
session_start();
if (isset($_SESSION['staff_id'])) {
    header('Location: dashboard.php');
    exit;
}

require_once 'db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $staffQuery = $db->collection('staff')
        ->where('Username', '=', $username)
        ->limit(1)
        ->documents();

    $staff = null;
    $staffId = null;
    foreach ($staffQuery as $doc) {
        if ($doc->exists()) {
            $staff = $doc->data();
            $staffId = $doc->id();
        }
    }

    if ($staff && password_verify($password, $staff['PasswordHash'])) {
        $_SESSION['staff_id']   = $staffId;
        $_SESSION['staff_name'] = $staff['FullName'];
        $_SESSION['staff_role'] = $staff['Role'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Staff Login — Glamour Cuts</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  :root {
    --cream:#FAF7F2; --sand:#F0EAE0; --blush:#E8D5C4; --rose:#C4957A;
    --bark:#8B6651; --espresso:#3D2B1F; --charcoal:#1A1410;
    --serif:'Cormorant Garamond',Georgia,serif;
    --sans:'DM Sans',system-ui,sans-serif;
  }
  body { font-family: var(--sans); background: var(--espresso); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
  .login-box { background: var(--cream); width: 100%; max-width: 420px; padding: 3rem; }
  .login-logo { font-family: var(--serif); font-size: 1.8rem; font-weight: 300; color: var(--espresso); margin-bottom: 0.3rem; }
  .login-logo span { color: var(--rose); font-style: italic; }
  .login-sub { font-size: 0.8rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--bark); margin-bottom: 2.5rem; }
  .form-group { margin-bottom: 1.4rem; }
  .form-group label { display: block; font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--bark); margin-bottom: 0.5rem; font-weight: 500; }
  .form-group input { width: 100%; padding: 0.85rem 1rem; background: white; border: 1px solid var(--blush); font-family: var(--sans); font-size: 0.9rem; color: var(--charcoal); outline: none; }
  .form-group input:focus { border-color: var(--rose); }
  .error { background: #fdecea; color: #c62828; border-left: 3px solid #e53935; padding: 0.8rem 1rem; font-size: 0.88rem; margin-bottom: 1.4rem; }
  .btn-submit { width: 100%; padding: 1rem; background: var(--espresso); color: var(--cream); border: none; font-family: var(--sans); font-size: 0.85rem; font-weight: 500; letter-spacing: 0.12em; text-transform: uppercase; cursor: pointer; margin-top: 0.5rem; }
  .btn-submit:hover { background: var(--rose); }
  .back-link { display: block; text-align: center; margin-top: 1.5rem; font-size: 0.82rem; color: var(--bark); text-decoration: none; }
  .back-link:hover { color: var(--rose); }
</style>
</head>
<body>
<div class="login-box">
  <p class="login-logo"><span>Glamour</span> Cuts</p>
  <p class="login-sub">Staff Portal</p>
  <?php if ($error): ?>
    <div class="error"><?= $error ?></div>
  <?php endif; ?>
  <form method="POST">
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" required autofocus>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" required>
    </div>
    <button class="btn-submit" type="submit">Sign In</button>
  </form>
  <a class="back-link" href="index.php">← Back to website</a>
</div>
</body>
</html>