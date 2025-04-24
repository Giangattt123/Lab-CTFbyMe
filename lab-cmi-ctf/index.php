<?php
function run_command() {
    if (isset($_GET['cmd'])) {
        $cmd = urldecode($_GET['cmd']);

        if (empty($cmd)) {
            $cmd = "ping -c 4 example.com";
        }
        if (preg_match('/[;&|$`()\r]/i', $cmd)) {
            return "<span class='error'>Command injection attempts are blocked!</span>";
        }

        if (preg_match('/cat|more|less|head|tail|nl|od|xxd|python|perl|ruby|bash|sh|php|curl|wget|nc|netcat|telnet|ssh|ftp|flag/i', $cmd)) {
            return "<span class='error'>Dangerous commands are blocked!</span>";
        }
        if (strpos($cmd, "ping") === false) {
            return "<span class='error'>Only ping commands allowed! Format: ping -c [count] [host]</span>";
        }
        return "<pre>" . shell_exec("sh -c " . escapeshellarg($cmd)) . "</pre>";
    }
    return "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CTF - Secure Ping Sandbox</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>🔐 Secure Ping Sandbox</h1>
        <p class="hint">This sandbox only allows properly formatted ping commands</p>
        <form method="GET" action="">
            <input type="text" name="cmd" placeholder="ping -c 4 example.com" required>
            <button type="submit">Run</button>
        </form>
        <div class="result">
            <?= run_command(); ?>
        </div>
        <footer>
            <p class="credit">Created by Phùng Đức Giang</p>
        </footer>
    </div>
</body>
</html>



