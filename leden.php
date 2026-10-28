<?php
declare(strict_types=1);
session_start();

// Controleer de login vóórdat er ledeninformatie of documentlinks worden getoond.
if (($_SESSION['leden_ingelogd'] ?? false) !== true) {
    header('Location: login.php');
    exit;
}

// Sessie verloopt na 2 uur inactiviteit.
$now = time();
$lastActivity = (int)($_SESSION['leden_laatste_activiteit'] ?? $now);
if ($now - $lastActivity > 7200) {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', $now - 42000, $params['path'], $params['domain'],
            $params['secure'], $params['httponly']);
    }
    session_destroy();
    header('Location: login.php?verlopen=1');
    exit;
}
$_SESSION['leden_laatste_activiteit'] = $now;

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
?>
<!doctype html>
<html lang="nl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Leden | Maritiem Teylingen Noordwijk</title>
  <style>
    body { margin:0; padding:24px; font:16px/1.6 system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;
      color:#183247; background:#f2f6f8; }
    main { max-width:900px; margin:0 auto; padding:28px; background:#fff; border:1px solid #d9e3e8;
      border-radius:16px; }
    header { display:flex; gap:16px; align-items:center; justify-content:space-between; flex-wrap:wrap; }
    h1 { margin:0; font-size:1.8rem; }
    .note { padding:14px 16px; background:#fff8e6; border-radius:8px; }
    a { color:#145a78; }
    .logout { display:inline-block; padding:9px 13px; color:#fff; background:#174f6b; border-radius:8px;
      text-decoration:none; }
  </style>
</head>
<body>
<main>
  <header>
    <div>
      <h1>Ledenpagina</h1>
      <p>Maritiem Teylingen Noordwijk</p>
    </div>
    <a class="logout" href="logout.php">Uitloggen</a>
  </header>

  <p class="note"><strong>Let op:</strong> vervang deze voorbeeldinhoud door de inhoud van jullie huidige ledenpagina.</p>

  <!--
    PLAATS HIER de ledeninhoud en documentlinks uit de huidige leden.html.
    Let op: links naar Google Drive of andere bestanden zijn niet automatisch beveiligd
    door deze PHP-login. Stel de deelrechten van die documenten ook goed in.
  -->
</main>
</body>
</html>
