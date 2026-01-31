<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home - SkyTrack</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="home-page">

<div class="home-wrapper">
    <div class="home-hero">
        <img src="plane.jpg" alt="Flight Tracking" class="home-image">
        <div class="home-hero-content">
            <h1 class="home-title">SkyTrack</h1>
            <p class="home-subtitle">Real-Time Flight Intelligence</p>
        </div>
    </div>

    <div class="home-description">
        <p>
            Welcome to SkyTrack, your ultimate flight tracking solution. Monitor real-time flight information, 
            track departures and arrivals, and stay updated on flight status from anywhere. 
            Our comprehensive flight management system helps you stay informed every step of the way.
        </p>
    </div>

    <div class="home-features">
        <div class="feature-box">
            <span class="feature-icon">✈️</span>
            <h3>Real-Time Tracking</h3>
            <p>Track flights as they happen with live updates</p>
        </div>
        <div class="feature-box">
            <span class="feature-icon">📍</span>
            <h3>Departure & Arrival</h3>
            <p>Monitor all flight movements in one place</p>
        </div>
        <div class="feature-box">
            <span class="feature-icon">📊</span>
            <h3>Flight Status</h3>
            <p>Get instant status updates on any flight</p>
        </div>
    </div>

    <a href="dashboard.php" class="home-button-large">Go to Dashboard</a>
</div>

</body>
</html>
