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

if($last_url === "") {
include DIR_APPLICATION.'include/index.php';
}if($last_url === "index") {
include DIR_APPLICATION.'include/index.php';
}elseif ($last_url === "login") {
include DIR_APPLICATION.'include/login.php';
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
}elseif ($last_url === "chart") {
include DIR_APPLICATION.'include/chart.php';
}elseif ($last_url === "report-chart") {
include DIR_APPLICATION.'include/report-chart.php';
}elseif ($last_url === "info") {
include DIR_APPLICATION.'include/info.php';
}elseif ($last_url === "customer-list") {
include DIR_APPLICATION.'include/customer-list.php';
}elseif ($last_url === "edit-customer") {
include DIR_APPLICATION.'include/edit-customer.php';
}elseif ($last_url === "cusstatusupdate") {
include DIR_APPLICATION.'include/cusstatusupdate.php';
}elseif ($last_url === "pausedetails") {
include DIR_APPLICATION.'appointment/pausedetails.php';
}elseif ($last_url === "registerjan-register") {
include DIR_APPLICATION.'include/registerjan-register.php';
}



elseif ($last_url === "add-new-classified-ad") {
include DIR_APPLICATION.'classified-ads/add-new-classified-ad.php';
}elseif ($last_url === "all-classified-ads") {
include DIR_APPLICATION.'classified-ads/all-classified-ads.php';
}elseif ($last_url === "deleted-classified-ads") {
include DIR_APPLICATION.'classified-ads/deleted-classified-ads.php';
}elseif ($last_url === "free-classified-ads") {
include DIR_APPLICATION.'classified-ads/free-classified-ads.php';
}elseif ($last_url === "emi-classified-ads") {
include DIR_APPLICATION.'classified-ads/emi-classified-ads.php';
}elseif ($last_url === "halfyearly-classified-ads") {
include DIR_APPLICATION.'classified-ads/halfyearly-classified-ads.php';
}elseif ($last_url === "quarterly-classified-ads") {
include DIR_APPLICATION.'classified-ads/quarterly-classified-ads.php';
}elseif ($last_url === "annually-classified-ads") {
include DIR_APPLICATION.'classified-ads/annually-classified-ads.php';
}elseif ($last_url === "other-plan-classified-ads") {
include DIR_APPLICATION.'classified-ads/other-plan-classified-ads.php';
}elseif ($last_url === "platinum-exclusive-classified-ads") {
include DIR_APPLICATION.'classified-ads/platinum-exclusive-classified-ads.php';
}elseif ($last_url === "platinum-plus-classified-ads") {
include DIR_APPLICATION.'classified-ads/platinum-plus-classified-ads.php';
}elseif ($last_url === "platinum-classified-ads") {
include DIR_APPLICATION.'classified-ads/platinum-classified-ads.php';
}elseif ($last_url === "premium-classified-ads") {
include DIR_APPLICATION.'classified-ads/premium-classified-ads.php';
}elseif ($last_url === "gold-classified-ads") {
include DIR_APPLICATION.'classified-ads/gold-classified-ads.php';
}elseif ($last_url === "standard-classified-ads") {
include DIR_APPLICATION.'classified-ads/standard-classified-ads.php';
}elseif ($last_url === "other-plan-classified-ads") {
include DIR_APPLICATION.'classified-ads/other-plan-classified-ads.php';
}elseif ($last_url === "sub-categories") {
include DIR_APPLICATION.'classified-ads/sub-categories.php';
}elseif ($last_url === "all-category") {
include DIR_APPLICATION.'classified-ads/all-category.php';
}elseif ($last_url === "sub-category") {
include DIR_APPLICATION.'classified-ads/sub-category.php';
}elseif ($last_url === "add-new-category") {
include DIR_APPLICATION.'classified-ads/add-new-category.php';
}elseif ($last_url === "add-new-sub-category") {
include DIR_APPLICATION.'classified-ads/add-new-sub-category.php';
}elseif ($last_url === "edit-cat") {
include DIR_APPLICATION.'classified-ads/edit-cat.php';
}elseif ($last_url === "edit-subcat") {
include DIR_APPLICATION.'classified-ads/edit-subcat.php';
}elseif ($last_url === "all-classified-ads-sales-team") {
include DIR_APPLICATION.'classified-ads/all-classified-ads-sales-team.php';
}elseif ($last_url === "edit-ad") {
include DIR_APPLICATION.'classified-ads/edit-ad.php';
}elseif ($last_url === "all-classified-ads-sales-team") {
include DIR_APPLICATION.'classified-ads/all-classified-ads-sales-team.php';
}elseif ($last_url === "all-classified-ads-sales-team") {
include DIR_APPLICATION.'classified-ads/all-classified-ads-sales-team.php';
}elseif ($last_url === "all-classified-ads-sales-team") {
include DIR_APPLICATION.'classified-ads/all-classified-ads-sales-team.php';
}elseif ($last_url === "all-classified-ads-sales-team") {
include DIR_APPLICATION.'classified-ads/all-classified-ads-sales-team.php';
}elseif ($last_url === "seo-all-classified-ads") {
include DIR_APPLICATION.'classified-ads/seo-all-classified-ads.php';
}elseif ($last_url === "seo-edit-ad") {
include DIR_APPLICATION.'classified-ads/seo-edit-ad.php';
}elseif ($last_url === "all-category-meta") {
include DIR_APPLICATION.'classified-ads/all-category-meta.php';
}elseif ($last_url === "sub-category-meta") {
include DIR_APPLICATION.'classified-ads/sub-category-meta.php';
}elseif ($last_url === "recent-classified-ads") {
include DIR_APPLICATION.'classified-ads/recent-classified-ads.php';
}



elseif ($last_url === "all-bs-category") {
include DIR_APPLICATION.'buy-sell/all-bs-category.php';
}elseif ($last_url === "bs-sub-category") {
include DIR_APPLICATION.'buy-sell/bs-sub-category.php';
}elseif ($last_url === "bs-add-new-category") {
include DIR_APPLICATION.'buy-sell/bs-add-new-category.php';
}elseif ($last_url === "bs-add-new-sub-category") {
include DIR_APPLICATION.'buy-sell/bs-add-new-sub-category.php';
}elseif ($last_url === "edit-bscat") {
include DIR_APPLICATION.'buy-sell/edit-bscat.php';
}elseif ($last_url === "edit-bssubcat") {
include DIR_APPLICATION.'buy-sell/edit-bssubcat.php';
}elseif ($last_url === "bs-doneby") {
include DIR_APPLICATION.'buy-sell/bs-doneby.php';
}elseif ($last_url === "edit-sell") {
include DIR_APPLICATION.'buy-sell/edit-sell.php';
}elseif ($last_url === "bs-doneby") {
include DIR_APPLICATION.'buy-sell/bs-doneby.php';
}



elseif ($last_url === "search-classified-ads-admin") {
include DIR_APPLICATION.'search/search-classified-ads-admin.php';
}elseif ($last_url === "search-classified-ads-sales") {
include DIR_APPLICATION.'search/search-classified-ads-sales.php';
}elseif ($last_url === "search-classified-ads-seo") {
include DIR_APPLICATION.'search/search-classified-ads-seo.php';
}elseif ($last_url === "search-result-ads-admin") {
include DIR_APPLICATION.'search/search-result-ads-admin.php';
}elseif ($last_url === "search-result-ads-seo") {
include DIR_APPLICATION.'search/search-result-ads-seo.php';
}elseif ($last_url === "search-result-ads") {
include DIR_APPLICATION.'search/search-result-ads.php';
}elseif ($last_url === "search-seo") {
include DIR_APPLICATION.'search/search-seo.php';
}elseif ($last_url === "seo-edit-meta") {
include DIR_APPLICATION.'search/seo-edit-meta.php';
}elseif ($last_url === "add-meta-details") {
include DIR_APPLICATION.'seo/add-meta-details.php';
}



elseif ($last_url === "add-areas") {
include DIR_APPLICATION.'areas/add-areas.php';
}


elseif ($last_url === "add-keywords") {
include DIR_APPLICATION.'keywords/add-keywords.php';
}


elseif ($last_url === "add-faq") {
include DIR_APPLICATION.'faq/add-faq.php';
}elseif ($last_url === "all-faq") {
include DIR_APPLICATION.'faq/all-faq.php';
}elseif ($last_url === "edit-faq") {
include DIR_APPLICATION.'faq/edit-faq.php';
}


elseif ($last_url === "all-sliders") {
include DIR_APPLICATION.'sliders/all-sliders.php';
}elseif ($last_url === "add-new-slider") {
include DIR_APPLICATION.'sliders/add-new-slider.php';
}elseif ($last_url === "statusupdate") {
include DIR_APPLICATION.'sliders/statusupdate.php';
}



elseif ($last_url === "developer-report") {
include DIR_APPLICATION.'report/developer-report.php';
}elseif ($last_url === "chart-month") {
include DIR_APPLICATION.'report/chart-month.php';
}elseif ($last_url === "edit-report") {
include DIR_APPLICATION.'report/edit-report.php';
}elseif ($last_url === "view-all-report") {
include DIR_APPLICATION.'report/view-all-report.php';
}elseif ($last_url === "view-report") {
include DIR_APPLICATION.'report/view-report.php';
}elseif ($last_url === "view-seo-report") {
include DIR_APPLICATION.'report/view-seo-report.php';
}elseif ($last_url === "chart-month") {
include DIR_APPLICATION.'report/chart-month.php';
}elseif ($last_url === "all-report") {
include DIR_APPLICATION.'report/all-report.php';
}



elseif ($last_url === "add-appointment") {
include DIR_APPLICATION.'appointment/add-appointment.php';
}elseif ($last_url === "edit-app-seo") {
include DIR_APPLICATION.'appointment/edit-app-seo.php';
}elseif ($last_url === "edit-app-web") {
include DIR_APPLICATION.'appointment/edit-app-web.php';
}elseif ($last_url === "edit-app") {
include DIR_APPLICATION.'appointment/edit-app.php';
}elseif ($last_url === "view-appointment-marketing") {
include DIR_APPLICATION.'appointment/view-appointment-marketing.php';
}elseif ($last_url === "view-appointment-seo") {
include DIR_APPLICATION.'appointment/view-appointment-seo.php';
}elseif ($last_url === "view-appointment-webdesign") {
include DIR_APPLICATION.'appointment/view-appointment-webdesign.php';
}elseif ($last_url === "view-appointment") {
include DIR_APPLICATION.'appointment/view-appointment.php';
}


elseif ($last_url === "lead-generation") {
include DIR_APPLICATION.'lead/lead-generation.php';
}elseif ($last_url === "view-all-leads") {
include DIR_APPLICATION.'lead/view-all-leads.php';
}elseif ($last_url === "view-lead-map") {
include DIR_APPLICATION.'lead/view-lead-map.php';
}


elseif ($last_url === "ios-notification") {
include DIR_APPLICATION.'ios/ios-notification.php';
}elseif ($last_url === "android-notification") {
include DIR_APPLICATION.'android/android-notification.php';
}elseif ($last_url === "view-lead-map") {
include DIR_APPLICATION.'lead/view-lead-map.php';
}



elseif ($last_url === "raise-ticket") {
include DIR_APPLICATION.'tickets/raise-ticket.php';
}elseif ($last_url === "edit-tickets") {
include DIR_APPLICATION.'tickets/edit-tickets.php';
}elseif ($last_url === "view-all-tickets") {
include DIR_APPLICATION.'tickets/view-all-tickets.php';
}elseif ($last_url === "get-name") {
include DIR_APPLICATION.'tickets/get-name.php';
}elseif ($last_url === "view-my-tickets") {
include DIR_APPLICATION.'tickets/view-my-tickets.php';
}

?>