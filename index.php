<?php
$path = $_SERVER['REQUEST_URI'];
$segments = explode('/', trim($path, '/'));
$firstSegment = $segments[0] ?? '';
$otherSegments = array_slice($segments, 1);
require_once("services/dbConnect.php");
switch ($firstSegment) {
    case '':
    case '/':
        require_once("./pages/home.php");
        break;
    case "trade":
        require_once("./pages/trade.php");
        break;
    case "deposit":
        require_once("./pages/deposit.php");
        break;
    case "withdraw":
        require_once("./pages/withdraw.php");
        break;
    case "withdraw-fail":
        require_once("./pages/withdraw-fail.php");
        break;
    case "profile":
        require_once("./pages/profile.php");
        break;
    case "login":
        require_once("./pages/login.php");
        break;
    case "riwayatpenarikan":
        require_once("./pages/riwayat-penarikan.php");
        break;
    case "klikdisini":
        require_once("./pages/klik-disini.php");
        break;

        // Batas Client
    case "admin":
        $adminPage = $otherSegments[0] ?? '';
        switch ($adminPage) {
            case '':
                require_once("./pages/admin/index.php");
                break;
            case 'users':
                require_once("./pages/admin/users.php");
                break;
            case 'criptocurrency':
                require_once("./pages/admin/cripto.php");
                break;
            case 'transactions':
                require_once("./pages/admin/withdraw.php");
                break;
            case 'settings':
                require_once("./pages/admin/settings.php");
                break;
            default:
                require_once("./pages/admin/index.php");
                break;
        }
        break;
    default:
        require_once("./pages/home.php");
        break;
}
