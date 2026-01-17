let currentFlight = "";
let currentStatus = "";

function searchFlight() {
  const flightInput = document.getElementById("flight");
  const loading = document.getElementById("loading");
  const result = document.getElementById("result");

  currentFlight = flightInput.value;
  if (!currentFlight) return;

  loading.classList.remove("hidden");
  result.innerHTML = "";

  fetch(`getFlight.php?flight=${currentFlight}`)
    .then(res => res.json())
    .then(data => {
      loading.classList.add("hidden");
      currentStatus = data.status;

      result.innerHTML = `
        <div class="flight-card">
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
              <span class="status ${data.status}">${data.status}</span>
            </div>
          </div>
        </div>
      `;
    });
}

function notify() {
  const email = document.getElementById("email").value;
  if (!email || !currentFlight) return;

  fetch("notify.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `email=${email}&flight=${currentFlight}&status=${currentStatus}`
  })
  .then(() => alert("You will receive flight updates!"));
}