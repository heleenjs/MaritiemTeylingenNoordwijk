<?php
declare(strict_types=1);
session_start();

// Pas dit pad aan naar de locatie van leden-config.php BUITEN de openbare webmap.
// Voorbeeld: /home/accountnaam/private/leden-config.php
$configPath = '/VOLLEDIG/PAD/BUITEN/WEBMAP/leden-config.php';

if (!is_file($configPath)) {
    http_response_code(500);
    exit('De ledenconfiguratie is niet ingesteld. Neem contact op met de websitebeheerder.');
}
$config = require $configPath;

if (!isset($config['password_hash']) || !is_string($config['password_hash'])) {
    http_response_code(500);
    exit('De ledenconfiguratie is ongeldig.');
}

if (isset($_SESSION['leden_ingelogd']) && $_SESSION['leden_ingelogd'] === true) {
    header('Location: leden.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = (string)($_POST['password'] ?? '');

    if (password_verify($password, $config['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['leden_ingelogd'] = true;
        $_SESSION['leden_login_tijd'] = time();
        header('Location: leden.php');
        exit;
    }

    // Kleine vertraging tegen snel herhaald raden; geen vervanging voor server-side rate limiting.
    usleep(350000);
    $error = 'Het wachtwoord klopt niet. Probeer het opnieuw.';
}
?>
<!doctype html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ledenlogin | Maritiem Teylingen Noordwijk</title>
  <style>
    :root { color-scheme: light; }
    body { margin:0; min-height:100vh; display:grid; place-items:center; padding:24px;
      box-sizing:border-box; font:16px/1.5 system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;
      color:#183247; background:#f2f6f8; }
    main { width:min(100%,420px); box-sizing:border-box; padding:32px; background:#fff;
      border:1px solid #d9e3e8; border-radius:16px; box-shadow:0 12px 32px #18324712; }
    h1 { margin:0 0 8px; font-size:1.65rem; }
    p { color:#536875; }
    label { display:block; margin:22px 0 7px; font-weight:600; }
    input { width:100%; box-sizing:border-box; padding:12px 13px; border:1px solid #aabcc7;
      border-radius:8px; font:inherit; }
    input:focus { outline:3px solid #b9d9ea; border-color:#286b8a; }
    button { width:100%; margin-top:16px; padding:12px; border:0; border-radius:8px;
      color:#fff; background:#174f6b; font:inherit; font-weight:700; cursor:pointer; }
    button:hover { background:#103d53; }
    .error { padding:10px 12px; border-radius:8px; color:#8b1e1e; background:#fff0f0; }
  </style>
</head>
<body>
<main>
  <h1>Ledenpagina</h1>
  <p>Maritiem Teylingen Noordwijk</p>
  <?php if ($error !== ''): ?>
    <p class="error" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
  <?php endif; ?>
  <form method="post" action="login.php">
    <label for="password">Wachtwoord</label>
    <input id="password" name="password" type="password" autocomplete="current-password" required autofocus>
    <button type="submit">Inloggen</button>
  </form>
</main>
</body>
</html>
