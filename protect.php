<?php
/**
 * PHPShield - Simple PHP Application DoS/Rate Limiting Protection
 * 
 * Protects PHP applications by limiting the number of requests per IP address
 * and temporarily blocking abusive IPs. Lightweight, no database required.
 * 
 * Author: Your Name
 * GitHub: https://github.com/your-username/PHPShield
 * License: MIT
 */

session_start();

// === Configuration Settings ===
$max_requests = 10;       // Maximum allowed requests per time window
$time_window = 60;        // Time window in seconds (e.g., 60 seconds)
$block_time = 300;        // Block time in seconds (e.g., 5 minutes)

$visitor_ip = $_SERVER['REMOTE_ADDR'];
$blocked_ips_file = __DIR__ . '/blocked_ips.json';

// === Initialize Blocked IPs File if not exists ===
if (!file_exists($blocked_ips_file)) {
    file_put_contents($blocked_ips_file, json_encode([]));
}

// === Load Blocked IPs List ===
$blocked_ips = json_decode(file_get_contents($blocked_ips_file), true);

// === Check if Visitor IP is Blocked ===
if (isset($blocked_ips[$visitor_ip]) && $blocked_ips[$visitor_ip] > time()) {
    sendBlockedResponse();
}

// === Handle Rate Limiting Using Session ===
if (!isset($_SESSION['request_count'])) {
    $_SESSION['request_count'] = 1;
    $_SESSION['first_request_time'] = time();
} else {
    $_SESSION['request_count']++;
}

// === Reset Request Count After Time Window ===
if (time() - $_SESSION['first_request_time'] > $time_window) {
    $_SESSION['request_count'] = 1;
    $_SESSION['first_request_time'] = time();
}

// === Block IP if Request Limit Exceeded ===
if ($_SESSION['request_count'] > $max_requests) {
    $blocked_ips[$visitor_ip] = time() + $block_time;
    file_put_contents($blocked_ips_file, json_encode($blocked_ips));
    sendBlockedResponse();
}

// === Function to Send Blocked Response ===
function sendBlockedResponse() {
    http_response_code(429); // 429 Too Many Requests
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>429 Too Many Requests</title>
        <style>
            body {
                background-color: #0d1117;
                color: #c9d1d9;
                font-family: Arial, sans-serif;
                text-align: center;
                padding-top: 100px;
            }
            .container {
                background-color: #161b22;
                border: 1px solid #30363d;
                border-radius: 10px;
                display: inline-block;
                padding: 40px 60px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.5);
            }
            h1 {
                color: #ff7b72;
            }
            p {
                font-size: 18px;
                color: #8b949e;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>429 Too Many Requests</h1>
            <p>You are making too many requests.</p>
            <p>Please try again later.</p>
        </div>
    </body>
    </html>
    <?php
    exit();
}
?>
