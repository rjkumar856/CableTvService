<?php
if(!session_id()){
session_start();
}
ini_set("date.timezone", "Asia/Kolkata");
include DIR_APPLICATION.'include/db.php';
$reg_user = new USER1();
require_once(DIR_APPLICATION.'include/class.user.php');
//$id = $_GET['id'];

$url = strtok(rtrim($_SERVER['REQUEST_URI'], "/"), "?");
$ur = explode("/", $url);
$last_url = array_pop($ur);

if(isset($_SESSION['userSession'])) {

if($last_url === "") {
include DIR_APPLICATION.'include/index.php';
}else if($last_url === "index") {
include DIR_APPLICATION.'include/index.php';
}elseif ($last_url === "login") {
include DIR_APPLICATION.'include/login.php';
}elseif ($last_url === "register") {
include DIR_APPLICATION.'include/register.php';
}elseif ($last_url === "register_db") {
include DIR_APPLICATION.'include/register_db.php'; 
}elseif ($last_url === "header") {
include DIR_APPLICATION.'include/header.php';
}elseif ($last_url === "style") {
include DIR_APPLICATION.'include/style.php';
}elseif ($last_url === "class.user") {
include DIR_APPLICATION.'include/class.user.php';
}elseif ($last_url === "dbconfig") {
include DIR_APPLICATION.'include/dbconfig.php';
}elseif ($last_url === "db") {
include DIR_APPLICATION.'include/db.php'; 
}elseif ($last_url === "login_db") {
include DIR_APPLICATION.'include/login_db.php';
}elseif ($last_url === "logout") {
include DIR_APPLICATION.'include/logout.php';
}elseif ($last_url === "cable-user-list") {
include DIR_APPLICATION.'userlist/cable-user-list.php';
}elseif ($last_url === "broadband-user-list") {
include DIR_APPLICATION.'userlist/broadband-user-list.php';
}elseif ($last_url === "smartcard-user-list") {
include DIR_APPLICATION.'userlist/smartcard-user-list.php';
}elseif ($last_url === "all-packages") {
include DIR_APPLICATION.'cable-packages/all-packages.php';
}elseif ($last_url === "channel-packages-list") {
include DIR_APPLICATION.'channel-packages/channel-packages-list.php';
}elseif ($last_url === "genre-list") {
include DIR_APPLICATION.'genre/genre-list.php';
}elseif ($last_url === "internet-pack-list") {
include DIR_APPLICATION.'internet-pack/internet-pack-list.php';
}elseif ($last_url === "network-type") {
include DIR_APPLICATION.'network/network-type.php';
}elseif ($last_url === "edit-cable-user-list") {
include DIR_APPLICATION.'userlist/edit-cable-user-list.php';
}elseif ($last_url === "edit-broadband-user-list") {
include DIR_APPLICATION.'userlist/edit-broadband-user-list.php';
}elseif ($last_url === "edit-smartcard-user-list") {
include DIR_APPLICATION.'userlist/edit-smartcard-user-list.php';
}elseif ($last_url === "user-details-list") {
include DIR_APPLICATION.'userlist/user-details-list.php';
}elseif ($last_url === "edit-user-list") {
include DIR_APPLICATION.'userlist/edit-user-list.php';
}elseif ($last_url === "address-list") {
include DIR_APPLICATION.'userlist/address-list.php';
}elseif ($last_url === "edit-address") {
include DIR_APPLICATION.'userlist/edit-address.php';
}elseif ($last_url === "userstatusupdate") {
include DIR_APPLICATION.'userlist/userstatusupdate.php';
}elseif ($last_url === "edit-cable-packages") {
include DIR_APPLICATION.'cable-packages/edit-cable-packages.php';
}
//USER LIST
elseif ($last_url === "free-cable-user-list") {
include DIR_APPLICATION.'userlist/free-cable-user-list.php';
}elseif ($last_url === "view-card-details") {
include DIR_APPLICATION.'userlist/view-card-details.php';
}elseif ($last_url === "create-new-user") {
include DIR_APPLICATION.'userlist/create-new-user.php';
}elseif ($last_url === "create-new-cable-user") {
include DIR_APPLICATION.'userlist/create-new-cable-user.php';
}elseif ($last_url === "create-new-broadband-user") {
include DIR_APPLICATION.'userlist/create-new-broadband-user.php';
}elseif ($last_url === "edit-cable-user-details") {
include DIR_APPLICATION.'userlist/edit-cable-user-details.php';
}elseif ($last_url === "edit-broadband-user-details") {
include DIR_APPLICATION.'userlist/edit-broadband-user-details.php';
}elseif ($last_url === "broadband-enet-user-list") {
include DIR_APPLICATION.'userlist/broadband-enet-user-list.php';
}elseif ($last_url === "broadband-ttn-user-list") {
include DIR_APPLICATION.'userlist/broadband-ttn-user-list.php';
}elseif ($last_url === "add-cable-user-from-excel") {
include DIR_APPLICATION.'userlist/add-cable-user-from-excel.php';
}

elseif ($last_url === "search-cable-user") {
include DIR_APPLICATION.'userlist/search-cable-user.php';
}elseif ($last_url === "search-broadband-user") {
include DIR_APPLICATION.'userlist/search-broadband-user.php';
}elseif ($last_url === "add-new-cable-package") {
include DIR_APPLICATION.'cable-packages/add-new-cable-package.php';
}elseif ($last_url === "add-new-genre") {
include DIR_APPLICATION.'genre/add-new-genre.php';
}elseif ($last_url === "edit-genre-details") {
include DIR_APPLICATION.'genre/edit-genre-details.php';
}elseif ($last_url === "add-internet-pack") {
include DIR_APPLICATION.'internet-pack/add-internet-pack.php';
}elseif ($last_url === "edit-internet-packages") {
include DIR_APPLICATION.'internet-pack/edit-internet-packages.php';
}elseif ($last_url === "add-network-type") {
include DIR_APPLICATION.'network/add-network-type.php';
}elseif ($last_url === "edit-network-type") {
include DIR_APPLICATION.'network/edit-network-type.php';
}elseif ($last_url === "transaction-list") {
include DIR_APPLICATION.'transaction/transaction-list.php';
}elseif ($last_url === "view-all-transactions") {
include DIR_APPLICATION.'transaction/view-all-transactions.php';
}
//PAYMENT
elseif ($last_url === "add-payment-list") {
include DIR_APPLICATION.'transaction/add-payment-list.php';
}elseif ($last_url === "add-cable-payment-list") {
include DIR_APPLICATION.'transaction/add-cable-payment-list.php';
}elseif ($last_url === "add-broadband-payment-list") {
include DIR_APPLICATION.'transaction/add-broadband-payment-list.php';
}elseif ($last_url === "edit-payment") {
include DIR_APPLICATION.'transaction/edit-payment.php';
}elseif ($last_url === "edit-cable-payment") {
include DIR_APPLICATION.'transaction/edit-cable-payment.php';
}elseif ($last_url === "edit-broadband-payment") {
include DIR_APPLICATION.'transaction/edit-broadband-payment.php';
}elseif ($last_url === "view-all-cable-transactions") {
include DIR_APPLICATION.'transaction/view-all-cable-transactions.php';
}elseif ($last_url === "view-all-broadband-transactions") {
include DIR_APPLICATION.'transaction/view-all-broadband-transactions.php';
}elseif ($last_url === "add-cable-payment-from-excel") {
include DIR_APPLICATION.'transaction/add-cable-payment-from-excel.php';
}elseif ($last_url === "add-broadband-payment-excel") {
include DIR_APPLICATION.'transaction/add-broadband-payment-excel.php';
}

elseif ($last_url === "add-new-channels") {
include DIR_APPLICATION.'channel-packages/add-new-channels.php';
}elseif ($last_url === "edit-channel-list") {
include DIR_APPLICATION.'channel-packages/edit-channel-list.php';
}elseif ($last_url === "user-details-cable") {
include DIR_APPLICATION.'userlist/user-details-list-cable.php';
}elseif ($last_url === "cable-today-expire-list") {
include DIR_APPLICATION.'userlist/cable-today-expire-list.php';
}elseif ($last_url === "cable-inactive-user-list") {
include DIR_APPLICATION.'userlist/cable-inactive-user-list.php';
}elseif ($last_url === "broadband-today-expire-list") {
include DIR_APPLICATION.'userlist/broadband-today-expire-list.php';
}elseif ($last_url === "broadband-inactive-user-list") {
include DIR_APPLICATION.'userlist/broadband-inactive-user-list.php';
}elseif ($last_url === "broadband-active-user-list") {
include DIR_APPLICATION.'userlist/broadband-active-user-list.php';
}elseif ($last_url === "cable-active-user-list") {
include DIR_APPLICATION.'userlist/cable-active-user-list.php';
}elseif ($last_url === "add-smartcard-user") {
include DIR_APPLICATION.'userlist/add-smartcard-user.php';
}elseif ($last_url === "broadband-transaction-list") {
include DIR_APPLICATION.'transaction/broadband-transaction-list.php';
}elseif ($last_url === "cable-transaction-list") {
include DIR_APPLICATION.'transaction/cable-transaction-list.php';
}

//AJAX 
elseif ($last_url === "packages-list") {
include DIR_APPLICATION.'packages/packages-list.php';
}elseif ($last_url === "view-new-connection") {
include DIR_APPLICATION.'complaints/view-new-connection.php';
}elseif ($last_url === "view-user-complaints") {
include DIR_APPLICATION.'complaints/view-user-complaints.php';
}elseif ($last_url === "view-contact-requests") {
include DIR_APPLICATION.'complaints/view-contact-requests.php';
}elseif ($last_url === "edit-new-connetion-request") {
include DIR_APPLICATION.'complaints/edit-new-connetion-request.php';
}elseif ($last_url === "edit-user-complaint") {
include DIR_APPLICATION.'complaints/edit-user-complaint.php';
}elseif ($last_url === "add-user-complaints") {
include DIR_APPLICATION.'complaints/add-user-complaint.php';
}elseif ($last_url === "view-forgot-password") {
include DIR_APPLICATION.'complaints/view-forgot-password.php';
}
elseif ($last_url === "notification") {
include DIR_APPLICATION.'complaints/notification.php';
}

//SALES
elseif ($last_url === "view-sales-status-today") {
include DIR_APPLICATION.'sales/view-sales-status-today.php';
}elseif ($last_url === "add-work-to-salesman") {
include DIR_APPLICATION.'sales/add-work-to-salesman.php';
}elseif ($last_url === "view-sales-all-work") {
include DIR_APPLICATION.'sales/view-sales-all-work.php';
}

elseif ($last_url === "view-admin-list") {
include DIR_APPLICATION.'accounts/view-admin-list.php';
}elseif ($last_url === "add-new-admin") {
include DIR_APPLICATION.'accounts/add-new-admin.php';
}elseif ($last_url === "view-sales-list") {
include DIR_APPLICATION.'accounts/view-sales-list.php';
}elseif ($last_url === "add-new-salesman") {
include DIR_APPLICATION.'accounts/add-new-salesman.php';
}elseif ($last_url === "adminuserstatusupdate") {
include DIR_APPLICATION.'accounts/adminuserstatusupdate.php';
}elseif ($last_url === "salesupdatestatus") {
include DIR_APPLICATION.'accounts/salesupdatestatus.php';
}elseif ($last_url === "edit-admin-list") {
include DIR_APPLICATION.'accounts/edit-admin-list.php';
}elseif ($last_url === "edit-sales-list") {
include DIR_APPLICATION.'accounts/edit-sales-list.php';
}

//LOGGED USER
elseif ($last_url === "logged-user-list") {
include DIR_APPLICATION.'userlist/logged-user-list.php';
}

else{
include DIR_APPLICATION.'include/index.php';
}


}elseif ($last_url === "login_db") {
include DIR_APPLICATION.'include/login_db.php';
}elseif ($last_url === "logout") {
include DIR_APPLICATION.'include/logout.php';
}elseif ($last_url === "login") {
include DIR_APPLICATION.'include/login.php';
}else{
include DIR_APPLICATION.'include/login.php';
}
?>