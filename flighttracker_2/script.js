// let currentFlight = "";
// let currentStatus = "";

// function searchFlight() {
//   const flightInput = document.getElementById("flight");
//   const loading = document.getElementById("loading");
//   const result = document.getElementById("result");

//   currentFlight = flightInput.value.trim();
//   if (!currentFlight) {
//     alert("Please enter a flight number!");
//     return;
//   }

//   loading.classList.remove("hidden");

//   fetch(`getFlight.php?flight=${currentFlight}`)
//     .then(res => res.json())
//     .then(data => {
//       loading.classList.add("hidden");

//       // Handle errors from PHP
//       if (data.error) {
//         alert(data.error);
//         return;
//       }

//       currentStatus = data.status;

//       // Add new flight card without removing previous ones
//       const flightCard = document.createElement("div");
//       flightCard.classList.add("flight-card");
//       flightCard.innerHTML = `
//         <div class="flight-grid">
//           <div>
//             <div class="label">Flight</div>
//             <div class="value">${data.flight}</div>
//           </div>
//           <div>
//             <div class="label">Airline</div>
//             <div class="value">${data.airline}</div>
//           </div>
//           <div>
//             <div class="label">Departure</div>
//             <div class="value">${data.departure}</div>
//           </div>
//           <div>
//             <div class="label">Arrival</div>
//             <div class="value">${data.arrival}</div>
//           </div>
//           <div>
//             <div class="label">Status</div>
//             <span class="status ${data.status.replace(/\s+/g, '-')}">${data.status}</span>
//           </div>
//         </div>
//       `;
//       result.appendChild(flightCard);
//     })
//     .catch(err => {
//       loading.classList.add("hidden");
//       alert("Error fetching flight: " + err.message);
//     });

//   // Clear input field after search
//   flightInput.value = "";
// }

// function notify() {
//   const email = document.getElementById("email").value.trim();
//   if (!email || !currentFlight) {
//     alert("Please enter an email and search a flight first!");
//     return;
//   }

//   fetch("notify.php", {
//     method: "POST",
//     headers: { "Content-Type": "application/x-www-form-urlencoded" },
//     body: `email=${encodeURIComponent(email)}&flight=${encodeURIComponent(currentFlight)}&status=${encodeURIComponent(currentStatus)}`
//   })
//   .then(res => res.text())
//   .then(msg => alert(msg))
//   .catch(err => alert("Error sending notification: " + err.message));
// }

let currentFlight = "";
let currentStatus = "";

function searchFlight() {
  const flightInput = document.getElementById("flight");
  const loading = document.getElementById("loading");
  const result = document.getElementById("result");

  currentFlight = flightInput.value.trim();
  if (!currentFlight) {
    alert("Please enter a flight number!");
    return;
  }

  loading.classList.remove("hidden");

  fetch(`getFlight.php?flight=${currentFlight}`)
    .then(res => res.json())
    .then(data => {
      loading.classList.add("hidden");

      if (data.error) {
        alert(data.error);
        return;
      }

      currentStatus = data.status;

      const flightCard = document.createElement("div");
      flightCard.classList.add("flight-card");
      flightCard.innerHTML = `
        <div class="flight-grid">
          <div>
            <div class="label">Flight</div>
            <div class="value">${data.flight}</div>
          </div>
          <div>
            <div class="label">Airline</div>
            <div class="value">${data.airline}</div>
          </div>
          <div>
            <div class="label">Departure</div>
            <div class="value">${data.departure}</div>
          </div>
          <div>
            <div class="label">Arrival</div>
            <div class="value">${data.arrival}</div>
          </div>
          <div>
            <div class="label">Status</div>
            <span class="status ${data.status.replace(/\s+/g, '-')}">${data.status}</span>
          </div>
        </div>
      `;
      result.appendChild(flightCard);
    })
    .catch(err => {
      loading.classList.add("hidden");
      alert("Error fetching flight: " + err.message);
    });

  flightInput.value = "";
}

function notify() {
  const email = document.getElementById("email").value.trim();
  if (!email || !currentFlight) {
    alert("Please enter an email and search a flight first!");
    return;
  }

  fetch("notify.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `email=${encodeURIComponent(email)}&flight=${encodeURIComponent(currentFlight)}&status=${encodeURIComponent(currentStatus)}`
  })
  .then(res => res.text())
  .then(msg => alert(msg))
  .catch(err => alert("Error sending notification: " + err.message));
}

