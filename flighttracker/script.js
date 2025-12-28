window.onload = loadAllFlights;

// Add Flight
function addFlight() {
    const flight = getFlightFormData();
    if (!flight) return;

    fetch('addFlight.php', {
        method: 'POST',
        body: new URLSearchParams(flight)
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message || data.error);
        loadAllFlights(); // Refresh table
    })
    .catch(() => alert("Server error"));
}

// Update Flight
function updateFlight() {
    const flight = getFlightFormData();
    if (!flight) return;

    fetch('updateFlight.php', {
        method: 'POST',
        body: new URLSearchParams(flight)
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message || data.error);
        loadAllFlights();
    })
    .catch(() => alert("Server error"));
}

// Delete Flight
function deleteFlight() {
    const flight_no = document.getElementById('deleteFlightNo').value.trim().toUpperCase();
    if (!flight_no) {
        alert("Enter a flight number to delete");
        return;
    }

    fetch('deleteFlight.php', {
        method: 'POST',
        body: new URLSearchParams({ flight_no })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message || data.error);
        loadAllFlights();
    })
    .catch(() => alert("Server error"));
}

// Check Status
function checkStatus() {
    const flightNo = document.getElementById("checkFlightNo").value.trim().toUpperCase();
    const resultDiv = document.getElementById("result");

    if (!flightNo) {
        resultDiv.innerHTML = "❌ Enter a flight number";
        return;
    }

    resultDiv.innerHTML = "⏳ Checking flight status...";

    fetch(`status.php?flight=${encodeURIComponent(flightNo)}`)
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            resultDiv.innerHTML = `❌ ${data.error}`;
            return;
        }

        const flight = data.flight;
        resultDiv.innerHTML = `
            ✈️ <strong>${flight.flight_no}</strong><br>
            Airline: ${flight.airline}<br>
            From: ${flight.departure}<br>
            To: ${flight.arrival}<br>
            Status: <span class="${flight.status.toLowerCase().replace(" ", "-")}">
                ${flight.status}
            </span>
        `;
    })
    .catch(() => resultDiv.innerHTML = "❌ Server error");
}

// Load all flights into table
function loadAllFlights() {
    fetch('allFlights.php')
    .then(res => res.json())
    .then(data => {
        const tbody = document.querySelector('#flightsTable tbody');
        tbody.innerHTML = '';
        data.forEach(f => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${f.flight_no}</td>
                <td>${f.airline}</td>
                <td>${f.departure}</td>
                <td>${f.arrival}</td>
                <td class="${f.status.toLowerCase().replace(" ", "-")}">${f.status}</td>
            `;
            tbody.appendChild(row);
        });
    })
    .catch(() => alert("Error loading flights"));
}

// Helper: get form data
function getFlightFormData() {
    const flight_no = document.getElementById('flight_no').value.trim().toUpperCase();
    const airline = document.getElementById('airline').value.trim();
    const departure = document.getElementById('departure').value.trim();
    const arrival = document.getElementById('arrival').value.trim();
    const status = document.getElementById('status').value;
}
    if (!flight_no || !airline || !departure || !arrival) {
        alert("All fields are required");
        return null;
    }

    return { flight_no, airline, departure, arrival, status };
// const flights = {};


// const airlines = [
//     "Air India", "Emirates", "British Airways", "Lufthansa",
//     "Qatar Airways", "Singapore Airlines", "IndiGo",
//     "United Airlines", "Delta Airlines", "Air France"
// ];

// const cities = [
//     "New Delhi", "London", "Dubai", "New York",
//     "Paris", "Tokyo", "Singapore", "Sydney",
//     "Toronto", "Frankfurt"
// ];

// const statuses = ["On Time", "Delayed", "Landed", "Cancelled"];


// for (let i = 1; i <= 100; i++) {
//     const flightNo = "FL" + (100 + i); // FL101 - FL200
//     flights[flightNo] = {
//         airline: airlines[i % airlines.length],
//         departure: cities[i % cities.length],
//         arrival: cities[(i + 3) % cities.length],
//         status: statuses[i % statuses.length]
//     };
// }

// function checkStatus() {
//     const flightNo = document.getElementById("flightNo").value.trim().toUpperCase();
//     const resultDiv = document.getElementById("result");

//     if (flightNo === "") {
//         resultDiv.innerHTML = " Please enter a flight number.";
//         return;
//     }

//     resultDiv.innerHTML = " Checking flight status...";

//     fetch(`status.php?flight=${encodeURIComponent(flightNo)}`)
//         .then(response => response.json())
//         .then(data => {
//             if (!data.success) {
//                 resultDiv.innerHTML = ` ${data.error}`;
//                 return;
//             }

//             const flight = data.flight;

//             resultDiv.innerHTML = `
//                 <strong>${flight.flight_no}</strong><br>
//                 Airline: ${flight.airline}<br>
//                 From: ${flight.departure}<br>
//                 To: ${flight.arrival}<br>
//                 Status: <span class="${flight.status.toLowerCase().replace(" ", "-")}">
//                     ${flight.status}
//                 </span>
//             `;
//         })
//         .catch(() => {
//             resultDiv.innerHTML = " Server error. Please try again.";
//         });
// }
