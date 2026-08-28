<?php

// ------------------------------------------------------------
// COOKIE TEST PAGE
// ------------------------------------------------------------

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name     = isset($_POST['name']) ? $_POST['name'] : '';
    $value    = isset($_POST['value']) ? $_POST['value'] : '';
    $domain   = isset($_POST['domain']) ? $_POST['domain'] : '';
    $path     = isset($_POST['path']) ? $_POST['path'] : '/';
    $maxage   = isset($_POST['maxage']) ? $_POST['maxage'] : '';
    $expires  = isset($_POST['expires']) ? $_POST['expires'] : '';
    $samesite = isset($_POST['samesite']) ? $_POST['samesite'] : '';

    $secure   = isset($_POST['secure']);
    $httponly = isset($_POST['httponly']);

    $clear_cookies = isset($_POST['clear_cookies']);

    $generated_headers = array();


    // --------------------------------------------------------
    // ESKİ TÜM COOKIE'LERİ TEMİZLE
    // --------------------------------------------------------

    if ($clear_cookies) {

        foreach ($_COOKIE as $cookie_name => $cookie_value) {

            /*
             * Cookie'yi silmek için:
             *
             * Max-Age=0
             * Expires=Thu, 01 Jan 1970 00:00:00 GMT
             *
             * Path aynı olmalı.
             *
             * Domain belirtilmişse burada da belirtilmeli.
             */

            $delete_cookie =
                $cookie_name .
                '=; Max-Age=0; Expires=Thu, 01 Jan 1970 00:00:00 GMT';

            if ($path !== '') {
                $delete_cookie .= '; Path=' . $path;
            }

            if ($domain !== '') {
                $delete_cookie .= '; Domain=' . $domain;
            }

            if ($secure) {
                $delete_cookie .= '; Secure';
            }

            if ($httponly) {
                $delete_cookie .= '; HttpOnly';
            }

            if ($samesite !== '') {
                $delete_cookie .= '; SameSite=' . $samesite;
            }

            header('Set-Cookie: ' . $delete_cookie, false);
            $generated_headers[] = $delete_cookie;
        }
    }


    // --------------------------------------------------------
    // YENİ COOKIE OLUŞTUR
    // --------------------------------------------------------

    if ($name === '') {
        $error = 'Cookie name boş olamaz.';
    } else {
        /*
         * Cookie header oluştur.
         */
        $cookie = $name . '=' . rawurlencode($value);
        // Max-Age
        if ($maxage !== '') {
            $cookie .= '; Max-Age=' . intval($maxage);
        }
        // Expires
        if ($expires !== '') {
            $cookie .= '; Expires=' . $expires;
        }
        // Path
        if ($path !== '') {
            $cookie .= '; Path=' . $path;
        }
        // Domain
        if ($domain !== '') {
            $cookie .= '; Domain=' . $domain;
        }
        // Secure
        if ($secure) {
            $cookie .= '; Secure';
        }
        // HttpOnly
        if ($httponly) {
            $cookie .= '; HttpOnly';
        }
        // SameSite
        if ($samesite !== '') {
            $cookie .= '; SameSite=' . $samesite;
        }
        /*
         * false parametresi sayesinde birden fazla
         * Set-Cookie header gönderilebilir.
         */
        header('Set-Cookie: ' . $cookie, false);
        $generated_headers[] = $cookie;
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cookie Test</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 40px;
        }

        .container {
            width: 100%;
            max-width: none;
            margin: 0;
            background: #ffffff;
            padding: 30px;
            box-sizing: border-box;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
        }

        h1 {
            margin-top: 0;
        }

        h2 {
            margin-top: 30px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 8px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .checkbox-container {
            margin-top: 20px;
            padding: 15px;
            background: #fff4d6;
            border: 1px solid #e6c86e;
            border-radius: 4px;
        }

        .checkbox-container label {
            display: block;
            font-weight: normal;
            margin: 0;
        }

        .checkbox-container input {
            margin-right: 8px;
        }

        button {
            margin-top: 25px;
            padding: 12px 25px;
            background: #333;
            color: white;
            border: 0;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background: #555;
        }

        .success {
            background: #dff0d8;
            border: 1px solid #c8dfc0;
            color: #3c763d;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .error {
            background: #f2dede;
            border: 1px solid #ebcccc;
            color: #a94442;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .info {
            background: #eef5ff;
            border: 1px solid #ccdff5;
            padding: 12px;
            border-radius: 4px;
            margin-top: 20px;
        }

        pre {
            background: #222;
            color: #eee;
            padding: 15px;
            border-radius: 4px;
            overflow-x: auto;
            white-space: pre-wrap;
            word-break: break-all;
        }

        .cookie-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cookie-table th,
        .cookie-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            word-break: break-all;
        }

        .cookie-table th {
            background: #f0f0f0;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Request Bilgileri</h2>
    <pre><?php
        $headers = apache_request_headers();
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        $proto = $_SERVER['SERVER_PROTOCOL'];

        $serverip = $_SERVER['SERVER_ADDR'];

        if (getenv('HTTP_CLIENT_IP')) 
        {
            $sourceip = getenv('HTTP_CLIENT_IP');
        }
        else if (getenv('HTTP_AHMET_MEHMET')) 
        {
            $sourceip = getenv('HTTP_AHMET_MEHMET');
        }  
        else{
            $sourceip = $_SERVER['REMOTE_ADDR'];    
        }

        echo "Source IP                   : $sourceip\n";
        echo "Destination IP(Server_Addr) : $serverip\n\n";

        echo "$method $uri $proto\n";
        foreach ($headers as $header => $value) {
            echo "$header: $value\n";
        }
    ?></pre>
  
    <h2>Gelen Cookie'ler</h2>
    <?php if (count($_COOKIE) > 0) { ?>
        <table class="cookie-table">
            <tr>
                <th>Name</th>
                <th>Value</th>
            </tr>
            <?php foreach ($_COOKIE as $cookie_name => $cookie_value) { ?>
                <tr>
                    <td>
                        <?php
                        echo htmlspecialchars($cookie_name);
                        ?>
                    </td>

                    <td>
                        <?php
                        echo htmlspecialchars($cookie_value);
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>

        <div class="info">
            Bu request içerisinde gelen Cookie bulunmuyor.
        </div>

    <?php } ?>

    <h2>Cookie Test</h2>
    <?php if (isset($error)) { ?>
        <div class="error">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php } ?>
    <?php if (isset($success)) { ?>
        <div class="success">
            Cookie işlemi tamamlandı.
        </div>
    <?php } ?>
    <form method="post">
        <label>Cookie Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars(isset($_POST['name']) ? $_POST['name'] : 'testcookie');?>">
        
        <label>Cookie Value</label>
        <input type="text" name="value" value="<?php echo htmlspecialchars(isset($_POST['value']) ? $_POST['value'] : '123456');?>">
        
        <label>Domain</label>
        <input type="text" name="domain" placeholder="example.com veya .example.com" value="<?php echo htmlspecialchars(isset($_POST['domain']) ? $_POST['domain'] : '');?>">
        
        <label>Path</label>
        <input type="text" name="path" value="<?php echo htmlspecialchars(isset($_POST['path']) ? $_POST['path'] : '/');?>">
        
        <label>Max-Age (seconds)</label>
        <input type="number" name="maxage" placeholder="Örn: 3600" value="<?php echo htmlspecialchars(isset($_POST['maxage']) ? $_POST['maxage'] : '');?>">

        <label>Expires</label>
        <input type="text"
            name="expires"
            placeholder="Wed, 21 Oct 2026 07:28:00 GMT"
            value="<?php
                echo htmlspecialchars(
                    isset($_POST['expires'])
                        ? $_POST['expires']
                        : ''
                );
            ?>"
        >


        <label>SameSite</label>

        <select name="samesite">

            <option value="">-- Yok --</option>

            <option value="Lax"
                <?php
                if (
                    isset($_POST['samesite']) &&
                    $_POST['samesite'] === 'Lax'
                ) {
                    echo 'selected';
                }
                ?>
            >
                Lax
            </option>

            <option value="Strict"
                <?php
                if (
                    isset($_POST['samesite']) &&
                    $_POST['samesite'] === 'Strict'
                ) {
                    echo 'selected';
                }
                ?>
            >
                Strict
            </option>

            <option value="None"
                <?php
                if (
                    isset($_POST['samesite']) &&
                    $_POST['samesite'] === 'None'
                ) {
                    echo 'selected';
                }
                ?>
            >
                None
            </option>

        </select>
        <div class="checkbox-container">
            <label>
                <input
                    type="checkbox"
                    name="clear_cookies"
                    <?php
                    if (isset($_POST['clear_cookies'])) {
                        echo 'checked';
                    }
                    ?>
                >
                <strong>Eski tüm cookileri temizle</strong>
            </label>
            <div style="margin-top:8px; font-size:13px;">
                İşaretlenirse mevcut request'te bulunan tüm
                cookie'ler için Max-Age=0 gönderilir.
            </div>
        </div>
        <div style="margin-top:20px;">
            <label style="display:inline; font-weight:normal;">
                <input
                    type="checkbox"
                    name="secure"
                    <?php
                    if (isset($_POST['secure'])) {
                        echo 'checked';
                    }
                    ?>
                >
                Secure
            </label>
            <label style="display:inline; font-weight:normal; margin-left:20px;">
                <input type="checkbox" name="httponly" <?php
                    if (isset($_POST['httponly'])) {
                        echo 'checked';
                    }
                    ?>
                >
                HttpOnly
            </label>
        </div>
        <button type="submit">
            Set Cookie
        </button>
    </form>
    <?php if (isset($success)) { ?>
        <h2>Gönderilen Set-Cookie Header'ları</h2>
        <pre><?php
            foreach ($generated_headers as $header) {
                echo "Set-Cookie: " .
                     htmlspecialchars($header) .
                     "\n\n";
            }
        ?></pre>
    <?php } ?>
</div>
</body>
</html>
