<?php
include("config.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<section class="search-card">
    <h2>Track Your Flight</h2>
    <div class="search-box">
        <input type="text" id="flight" placeholder="Flight Number (AA101)">
        <button onclick="searchFlight()">Search</button>
    </div>
    <div id="loading" class="loading hidden">Searching flight…</div>
    <div id="result"></div>
</section>

<section class="notify-card">
    <h3>Email Alerts</h3>
    <div class="notify-box">
        <input type="email" id="email" placeholder="Enter your email">
        <button onclick="notify()">Notify Me</button>
    </div>
</section>
