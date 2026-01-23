<?php
include("config.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - SkyTrack</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Header -->
<header>
    <div class="header-content">
        <div class="logo">✈ SkyTrack</div>
        <p>Welcome, <?= htmlspecialchars($_SESSION["user_name"]) ?></p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</header>

<main>
    <!-- Track Flight Section -->
    <section class="search-card">
        <h2>Track Your Flight</h2>
        <div class="search-box">
            <input type="text" id="flight" placeholder="Flight Number (AA101)">
            <button onclick="searchFlight()">Search</button>
        </div>
        <div id="loading" class="loading hidden">Searching flight…</div>
        <div id="result"></div>
    </section>

    <!-- Manage Flights Section -->
    <section class="search-card">
        <h2>Manage Flights</h2>

        <!-- Add Flight Form -->
        <h3>Add New Flight</h3>
        <form id="addFlightForm">
            <input type="text" name="flight_no" placeholder="Flight Number" required>
            <input type="text" name="airline" placeholder="Airline" required>
            <input type="text" name="departure" placeholder="Departure" required>
            <input type="text" name="arrival" placeholder="Arrival" required>
            <select name="status" required>
                <option value="On Time">On Time</option>
                <option value="Delayed">Delayed</option>
                <option value="Boarding">Boarding</option>
                <option value="Departed">Departed</option>
                <option value="Arrived">Arrived</option>
            </select>
            <button type="submit">Add Flight</button>
        </form>

        <hr>

        <!-- Flights List -->
        <h3>All Flights</h3>
        <div id="flightList" style="overflow-x:auto;"></div>
    </section>
</main>

<!-- Footer -->
<footer>
    <div class="footer-content">
        © 2026 SkyTrack • Flight Tracking System
    </div>
</footer>

<script src="script.js"></script>
<script>
// ================================
// Manage Flights JS
// ================================

function loadFlights() {
    fetch("admin_flights.php")
    .then(res => res.json())
    .then(data => {
        const flightList = document.getElementById("flightList");
        flightList.innerHTML = "";
        if (data.length === 0) {
            flightList.innerHTML = "<p>No flights yet.</p>";
            return;
        }

        const table = document.createElement("table");
        table.innerHTML = `
            <tr>
                <th>ID</th>
                <th>Flight No</th>
                <th>Airline</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        `;

        data.forEach(f => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${f.id}</td>
                <td><input value="${f.flight_no}" data-id="${f.id}" class="editFlightNo"></td>
                <td><input value="${f.airline}" data-id="${f.id}" class="editAirline"></td>
                <td><input value="${f.departure}" data-id="${f.id}" class="editDeparture"></td>
                <td><input value="${f.arrival}" data-id="${f.id}" class="editArrival"></td>
                <td>
                    <select data-id="${f.id}" class="editStatus">
                        <option ${f.status==="On Time"?"selected":""}>On Time</option>
                        <option ${f.status==="Delayed"?"selected":""}>Delayed</option>
                        <option ${f.status==="Boarding"?"selected":""}>Boarding</option>
                        <option ${f.status==="Departed"?"selected":""}>Departed</option>
                        <option ${f.status==="Arrived"?"selected":""}>Arrived</option>
                    </select>
                </td>
                <td>
                    <button onclick="updateFlight(${f.id})">Update</button>
                    <button onclick="deleteFlight(${f.id})">Delete</button>
                </td>
            `;
            table.appendChild(row);
        });

        flightList.appendChild(table);
    });
}

// Add Flight
document.getElementById("addFlightForm").addEventListener("submit", function(e){
    e.preventDefault();
    const formData = new FormData(this);
    fetch("addflight_ajax.php", { method: "POST", body: formData })
    .then(res => res.text())
    .then(msg => { alert(msg); loadFlights(); this.reset(); });
});

// Update Flight
function updateFlight(id) {
    const flight_no = document.querySelector(`.editFlightNo[data-id='${id}']`).value;
    const airline = document.querySelector(`.editAirline[data-id='${id}']`).value;
    const departure = document.querySelector(`.editDeparture[data-id='${id}']`).value;
    const arrival = document.querySelector(`.editArrival[data-id='${id}']`).value;
    const status = document.querySelector(`.editStatus[data-id='${id}']`).value;

    const data = new FormData();
    data.append("id", id);
    data.append("flight_no", flight_no);
    data.append("airline", airline);
    data.append("departure", departure);
    data.append("arrival", arrival);
    data.append("status", status);

    fetch("updateflight_ajax.php", {method:"POST", body:data})
    .then(res => res.text())
    .then(msg => { alert(msg); loadFlights(); });
}

// Delete Flight
function deleteFlight(id) {
    if (!confirm("Are you sure you want to delete this flight?")) return;
    fetch("deleteflight_ajax.php?id="+id)
    .then(res => res.text())
    .then(msg => { alert(msg); loadFlights(); });
}

// Initial load
loadFlights();
</script>

</body>
</html>
