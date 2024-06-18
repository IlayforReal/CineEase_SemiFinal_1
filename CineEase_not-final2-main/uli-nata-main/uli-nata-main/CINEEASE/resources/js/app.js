import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// public/js/script.js

document.addEventListener('DOMContentLoaded', function () {
    var movieCost = movieCostValue; // Use a variable passed from the Blade template
    var maxSeats = maxSeatsValue; // Use a variable passed from the Blade template
    var quantityInput = document.getElementById('quantity');
    var amountDisplay = document.getElementById('amount');
    var seatArrangementSelect = document.getElementById('seatArrangement');

    function calculateAmount() {
        var quantity = quantityInput.value;
        var totalAmount = quantity * movieCost;
        amountDisplay.textContent = totalAmount;
    }

    quantityInput.addEventListener('change', calculateAmount);
    seatArrangementSelect.addEventListener('change', calculateAmount);

    quantityInput.setAttribute('max', maxSeats); // Set the max value dynamically

    // Initial calculation on page load
    calculateAmount();
});
