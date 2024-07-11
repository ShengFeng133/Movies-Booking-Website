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