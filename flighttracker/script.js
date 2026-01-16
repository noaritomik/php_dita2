const airlines = [
    "Air India", "Emirates", "British Airways", "Lufthansa",
    "Qatar Airways", "Singapore Airlines", "IndiGo",
    "United Airlines", "Delta Airlines", "Air France"
];

const cities = [
    "New Delhi", "London", "Dubai", "New York",
    "Paris", "Tokyo", "Singapore", "Sydney",
    "Toronto", "Frankfurt"
];

const statuses = ["On Time", "Delayed", "Landed", "Cancelled"];

// --- Run on page load ---
window.onload = async () => {
    try {
        const flights = await fetchAllFlights();
        if (flights.length === 0) {
            await generateRandomFlights(); // Only generate if DB is empty
        }
        loadAllFlights();
    } catch {
        alert("Error initializing flights");
    }
};

// --- Fetch all flights from allFlights.php ---
async function fetchAllFlights() {
    const res = await fetch('allFlights.php');
    const data = await res.json();
    if (data.error) throw new Error(data.error);
    return data;
}

// --- Generate 100 random flights ---
async function generateRandomFlights() {
    for (let i = 1; i <= 100; i++) {
        const flightNo = "FL" + (100 + i);
        const flight = {
            flight_no: flightNo,
            airline: airlines[i % airlines.length],
            departure: cities[i % cities.length],
            arrival: cities[(i + 3) % cities.length],
            status: statuses[i % statuses.length]
        };

        await fetch('addflights.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(flight)
        });
    }
}

// --- Get flight data from form ---
function getFlightFormData() {
    const flight_no = document.getElementById('flight_no').value.trim().toUpperCase();
    const airline = document.getElementById('airline').value.trim();
    const departure = document.getElementById('departure').value.trim();
    const arrival = document.getElementById('arrival').value.trim();
    const status = document.getElementById('status').value;

    if (!flight_no || !airline || !departure || !arrival) {
        alert("All fields are required");
        return null;
    }

    return { flight_no, airline, departure, arrival, status };
}

// --- Add or update flight ---
function addFlight() {
    const flight = getFlightFormData();
    if (!flight) return;

    fetch('addflights.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(flight)
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message || data.error);
        clearForm();
        loadAllFlights();
    })
    .catch(() => alert("Server error"));
}

// --- Delete flight ---
function deleteFlight() {
    const flight_no = document.getElementById('deleteFlightNo').value.trim().toUpperCase();
    if (!flight_no) { alert("Enter a flight number to delete"); return; }

    fetch('deleteflights.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ flight_no })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message || data.error);
        loadAllFlights();
    })
    .catch(() => alert("Server error"));
}

// --- Check flight status ---
function checkStatus() {
    const flightNo = document.getElementById("checkFlightNo").value.trim().toUpperCase();
    const resultDiv = document.getElementById("result");

    if (!flightNo) { resultDiv.innerHTML = "❌ Enter a flight number"; return; }

    resultDiv.innerHTML = "⏳ Checking flight status...";

    fetch(`status.php?flight_no=${encodeURIComponent(flightNo)}`)
    .then(res => res.json())
    .then(data => {
        if (!data || !data.flight_no) {
            resultDiv.innerHTML = `❌ Flight not found`;
            return;
        }

        resultDiv.innerHTML = `
            ✈️ <strong>${data.flight_no}</strong><br>
            Airline: ${data.airline}<br>
            From: ${data.departure}<br>
            To: ${data.arrival}<br>
            Status: <span class="${data.status.toLowerCase().replace(" ", "-")}">
                ${data.status}
            </span>
        `;
    })
    .catch(() => resultDiv.innerHTML = "❌ Server error");
}

// --- Load all flights into table ---
function loadAllFlights() {
    fetch('allFlights.php')
    .then(res => res.json())
    .then(data => {
        if (data.error) { alert(data.error); return; }
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

// --- Clear add/update form ---
function clearForm() {
    document.getElementById('flight_no').value = '';
    document.getElementById('airline').value = '';
    document.getElementById('departure').value = '';
    document.getElementById('arrival').value = '';
    document.getElementById('status').value = 'On Time';
}


// window.onload = () => {
//     loadAllFlights();
//     generateRandomFlights(); // optional: populate 100 flights
// };

// // Add / Update Flight
// function addFlight() {
//     const flight = getFlightFormData();
//     if (!flight) return;

//     fetch('addflights.php', {
//         method: 'POST',
//         headers: { 'Content-Type': 'application/json' },
//         body: JSON.stringify(flight)
//     })
//     .then(res => res.json())
//     .then(data => {
//         alert(data.message || data.error);
//         loadAllFlights();
//     })
//     .catch(() => alert("Server error"));
// }

// // Delete Flight
// function deleteFlight() {
//     const flight_no = document.getElementById('deleteFlightNo').value.trim().toUpperCase();
//     if (!flight_no) { alert("Enter a flight number to delete"); return; }

//     fetch('deleteflights.php', {
//         method: 'POST',
//         headers: { 'Content-Type': 'application/json' },
//         body: JSON.stringify({ flight_no })
//     })
//     .then(res => res.json())
//     .then(data => {
//         alert(data.message || data.error);
//         loadAllFlights();
//     })
//     .catch(() => alert("Server error"));
// }

// // Check Flight Status
// function checkStatus() {
//     const flightNo = document.getElementById("checkFlightNo").value.trim().toUpperCase();
//     const resultDiv = document.getElementById("result");

//     if (!flightNo) { resultDiv.innerHTML = "❌ Please enter a flight number"; return; }

//     resultDiv.innerHTML = "⏳ Checking flight status...";
//     fetch(`status.php?flight_no=${encodeURIComponent(flightNo)}`)
//     .then(res => res.json())
//     .then(flight => {
//         if (flight.error) { resultDiv.innerHTML = `❌ ${flight.error}`; return; }
//         resultDiv.innerHTML = `
//             ✈️ <strong>${flight.flight_no}</strong><br>
//             Airline: ${flight.airline}<br>
//             From: ${flight.departure}<br>
//             To: ${flight.arrival}<br>
//             Status: <span class="${flight.status.toLowerCase().replace(" ", "-")}">${flight.status}</span>
//         `;
//     })
//     .catch(() => resultDiv.innerHTML = "❌ Server error");
// }

// // Load all flights into table
// function loadAllFlights() {
//     fetch('allFlights.php')
//     .then(res => res.json())
//     .then(data => {
//         if (data.error) { alert(data.error); return; }
//         const tbody = document.querySelector('#flightsTable tbody');
//         tbody.innerHTML = '';
//         data.forEach(f => {
//             const row = document.createElement('tr');
//             row.innerHTML = `
//                 <td>${f.flight_no}</td>
//                 <td>${f.airline}</td>
//                 <td>${f.departure}</td>
//                 <td>${f.arrival}</td>
//                 <td class="${f.status.toLowerCase().replace(" ", "-")}">${f.status}</td>
//             `;
//             tbody.appendChild(row);
//         });
//     })
//     .catch(() => alert("Error loading flights"));
// }

// // Helper: get form data
// function getFlightFormData() {
//     const flight_no = document.getElementById('flight_no').value.trim().toUpperCase();
//     const airline = document.getElementById('airline').value.trim();
//     const departure = document.getElementById('departure').value.trim();
//     const arrival = document.getElementById('arrival').value.trim();
//     const status = document.getElementById('status').value;

//     if (!flight_no || !airline || !departure || !arrival) { alert("All fields are required"); return null; }
//     return { flight_no, airline, departure, arrival, status };
// }

// // Generate 100 random flights (optional)
// function generateRandomFlights() {
//     const airlines = ["Air India","Emirates","British Airways","Lufthansa","Qatar Airways","Singapore Airlines","IndiGo","United Airlines","Delta Airlines","Air France"];
//     const cities = ["New Delhi","London","Dubai","New York","Paris","Tokyo","Singapore","Sydney","Toronto","Frankfurt"];
//     const statuses = ["On Time","Delayed","Landed","Cancelled"];

//     for (let i = 1; i <= 100; i++) {
//         const flightNo = "FL" + (100 + i);
//         const flight = {
//             flight_no: flightNo,
//             airline: airlines[i % airlines.length],
//             departure: cities[i % cities.length],
//             arrival: cities[(i + 3) % cities.length],
//             status: statuses[i % statuses.length]
//         };

//         fetch('addflights.php', {
//             method: 'POST',
//             headers: { 'Content-Type': 'application/json' },
//             body: JSON.stringify(flight)
//         }).catch(() => {});
//     }

//     setTimeout(loadAllFlights, 1000);
// }