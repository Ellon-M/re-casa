<?php
error_reporting(E_ALL);

use App\Utils\Config;
use App\Models\WebApp;

require_once 'app/vendor/autoload.php';

$url = WebApp::getURL();

if (Config::FORCE_HTTPS && !WebApp::isSecure() && php_sapi_name() != 'cli-server')
{
    header('Location: https://' . $_SERVER['HTTP_HOST'] . $url, TRUE, 301);
    exit;
}

switch ($url){
    //TODO Confirm all routes
//    case '/':
//    case '/home':
//        require 'templates/session-file.php';
//        require 'homepage/controller.php';
//        require 'homepage/index.php';
//        break;

    case '/about-us':
        require 'templates/session-file.php';
        require 'about/about-us.php';
        break;

    case '/contact-us':
        require 'templates/session-file.php';
        require 'contact/contact.php';
        break;

    case '/page-not-found':
        require 'templates/session-file.php';
        require '404/page-not-found.php';
        break;

    case '/home':
    case '/':
    case '/property-listing':
        require 'templates/session-file.php';
        require 'property-listings/controller.php';
        require 'property-listings/property-listing.php';
        break;

    case '/property-detail':
        require 'templates/session-file.php';
        require 'property-details/controller.php';
        require 'property-details/property-detail.php';
        break;

    case '/privacy':
        require 'templates/session-file.php';
        require 'privacy-policy/privacy-policy.php';
        break;

    case "/log-in":
        require 'login/controller.php';
        require 'login/login.php';
        break;

    case '/register':
        require 'login/controller.php';
        require 'login/register.php';
        break;

    case '/verify-buyer':
        require 'templates/session-file.php';
        require 'templates/session-lock-file.php';
        require 'verify/verify-buyer.php';
        break;

    case '/verify-seller':
        require 'templates/session-file.php';
        require 'templates/session-lock-file.php';
        require 'verify/verify-seller.php';
        break;

    case "/account-settings":
        require 'templates/session-file.php';
        require 'templates/session-lock-file.php';
        require 'profile/controller.php';
        require "profile/profile.php";
        break;

    case "/sell-your-property":
        require 'templates/session-file.php';
        require 'templates/session-lock-file.php';
        require "sell-property/sell-property.php";
        break;

    case "/logout":
        require 'templates/logout.php';
        break;

    case "/fake":
        require "faker-file.php";
        break;

    case "/admin/verified-buyers":
        require "admin/templates/admin-session-lock.php";
        require "admin/verified-buyers.php";
        break;

    case "/admin/verified-properties":
        require "admin/templates/admin-session-lock.php";
        require "admin/verified-sellers.php";
        break;

    case "/admin/users":
        require "admin/templates/admin-session-lock.php";
        require "admin/users.php";
        break;

    case "/admin":
    case "/admin/home":
        require "admin/templates/admin-session-lock.php";
        require "admin/index2.php";
        break;

    case "/admin/login":
        require "admin/login.php";
        break;

    case "/admin/pending-buyer-verifications":
        require "admin/templates/admin-session-lock.php";
        require "admin/pending-buyer-verifications.php";
        break;

    case "/admin/pending-property-verifications":
        require "admin/templates/admin-session-lock.php";
        require "admin/pending-property-verifications.php";
        break;

    case "/admin/all-properties":
        require "admin/templates/admin-session-lock.php";
        require "admin/all-properties.php";
        break;

    case "/admin/logout":
        require "admin/templates/logout.php";
        break;

    default:
        // echo $url;
        require "404/page-not-found.php";
        break;
}