// document.addEventListener("DOMContentLoaded", function () {
//     const reserveButton = document.getElementById("reserve-button");
//     const message = document.getElementById("message");

//     reserveButton.addEventListener("click", function () {
//         const checkedSeats = document.querySelectorAll('input[type="checkbox"]:checked');
//         if (checkedSeats.length > 0) {
//             const selectedSeats = Array.from(checkedSeats).map(checkbox => checkbox.id);
//             message.textContent = `Reserved Seats: ${selectedSeats.join(", ")}`;
//         } else {
//             message.textContent = "No seats selected.";
//         }
//     });
// });


//  // Array to store selected seats
//  const selectedSeats = [];

//  // Function to create seating plan and handle seat selection
//  function createSeatingPlan(rows, seatsPerRow) {
//      const seatingContainer = document.getElementById('seating-container');

//      for (let i = 1; i <= rows; i++) {
//          const row = document.createElement('div');
//          row.classList.add('row');
//          for (let j = 1; j <= seatsPerRow; j++) {
//              const seat = document.createElement('div');
//              seat.classList.add('seat');
//              seat.textContent = `${i}-${j}`;
//              seat.addEventListener('click', () => toggleSeat(seat));
//              row.appendChild(seat);
//          }
//          seatingContainer.appendChild(row);
//      }
//  }

//  // Function to toggle seat selection
//  function toggleSeat(seat) {
//      if (selectedSeats.includes(seat.textContent)) {
//          // Deselect seat
//          const index = selectedSeats.indexOf(seat.textContent);
//          selectedSeats.splice(index, 1);
//          seat.style.backgroundColor = '#ccc';
//      } else {
//          // Select seat
//          selectedSeats.push(seat.textContent);
//          seat.style.backgroundColor = 'green';
//      }
//  }

//  // Function to proceed to the next page (You can implement your own logic here)
//  function proceedToNextPage() {
//      // In a real-world scenario, you would send selectedSeats to the server or save them in a database
//      console.log('Selected Seats:', selectedSeats);
//      // Redirect to the next page or perform further actions
//  }

//  // Initialize seating plan with 5 rows and 10 seats per row
//  createSeatingPlan(5, 10);


//Github
const seats = document.querySelectorAll(".row .seat:not(.occupied)");
const seatContainer = document.querySelector(".row-container");
const count = document.getElementById("count");
const total = document.getElementById("total");
const movieSelect = document.getElementById("movie");

// Another Approach

// seats.forEach(function(seat) {
//   seat.addEventListener("click", function(e) {
//     seat.classList.add("selected");
//     const selectedSeats = document.querySelectorAll(".container .selected");
//     selectedSeathLength = selectedSeats.length;
//     count.textContent = selectedSeathLength;
//     let ticketPrice = +movieSelect.value;
//     total.textContent = ticketPrice * selectedSeathLength;
//   });
// });

// localStorage.clear();

//Extra
populateUI();

let ticketPrice = +movieSelect.value;

// Save selected movie index and price
//Extra
function setMovieData(movieIndex, moviePrice) {
  localStorage.setItem("selectedMovieIndex", movieIndex);
  localStorage.setItem("selectedMoviePrice", moviePrice);
}

function updateSelectedCount() {
  const selectedSeats = document.querySelectorAll(".container .selected");

  //Extra
  seatsIndex = [...selectedSeats].map(function(seat) {
    return [...seats].indexOf(seat);
  });

  //Extra
  localStorage.setItem("selectedSeats", JSON.stringify(seatsIndex));

  let selectedSeatsCount = selectedSeats.length;
  count.textContent = selectedSeatsCount;
  total.textContent = selectedSeatsCount * ticketPrice;

  //missing   setMovieData(movieSelect.selectedIndex, movieSelect.value);

}

// Get data from localstorage and populate
//Extra
function populateUI() {
  const selectedSeats = JSON.parse(localStorage.getItem("selectedSeats"));

  if (selectedSeats !== null && selectedSeats.length > 0) {
    seats.forEach(function(seat, index) {
      if (selectedSeats.indexOf(index) > -1) {
        seat.classList.add("selected");
      }
    });
  }

  const selectedMovieIndex = localStorage.getItem("selectedMovieIndex");

  if (selectedMovieIndex !== null) {
    movieSelect.selectedIndex = selectedMovieIndex;
  }
}

// Movie select event

movieSelect.addEventListener("change", function(e) {
  ticketPrice = +movieSelect.value;
  setMovieData(e.target.selectedIndex, e.target.value);
  updateSelectedCount();
});

// Adding selected class to only non-occupied seats on 'click'

seatContainer.addEventListener("click", function(e) {
  if (
    e.target.classList.contains("seat") &&
    !e.target.classList.contains("occupied")
  ) {
    e.target.classList.toggle("selected");
    updateSelectedCount();
  }
});

// Initial count and total rendering
updateSelectedCount();

//View https://codepen.io/aniketkudale/pen/oNXWzVY for similar code but without implementing json 








input[type="checkbox"] {
    /* display: none; */
}

input[type="checkbox"] + label {
    display: flex;
    width: 30px;
    height: 30px;
    border: 1px solid #ccc;
    margin: 2px;
    cursor: pointer;
    text-align: center;
    line-height: 28px;
    background-color: white; /* Default color is white */
    transition: background-color 0.3s;
}

input[type="checkbox"]:checked + label {
    background-color: green; /* Change the background color to green when checked */
    color: white;
    border: 1px solid #3498db;
}

input[type="checkbox"][disabled] + label {
    background-color: red; /* Change the background color to red when disabled (occupied) */
    color: rgb(233, 33, 33);
    border: 1px solid #ff0000;
}

label {
    position: relative; /* This is needed for custom styles */
  }
  
  /* Style the checkmark (hidden by default) */
  label::before {
    content: '\2713'; /* Unicode checkmark character */
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    font-size: 20px; /* Adjust the size of the checkmark */
    color: transparent; /* Make the checkmark transparent by default */
    transition: color 0.3s; /* Add a transition for color change */
  }
  
  /* Show the checkmark when the checkbox is checked */
  input[type="checkbox"]:checked + label::before {
    color: white; /* Change the color to white when checked */
  }
