document.addEventListener('DOMContentLoaded', function() {
    //referencias de elementos
    const yearFilter = document.getElementById('year-filter');
    const fuelFilter = document.getElementById('fuel-filter');
    const priceFilter = document.getElementById('price-filter');
    const typeFilter = document.getElementById('type-filter');
    const transmissionFilter = document.getElementById('transmission-filter');
    const statusFilter = document.getElementById('status-filter');
    const searchBar = document.getElementById('search-bar');
    const carList = document.getElementById('car-list');
    const carCards = carList.getElementsByClassName('car-card');

    function filterCars() {
        const year = yearFilter.value;
        const fuel = fuelFilter.value;
        const price = priceFilter.value;
        const type = typeFilter.value;
        const transmission = transmissionFilter.value;
        const status = statusFilter.value;
        const search = searchBar.value.toLowerCase();
        //se recprre cada vehiculo
        Array.from(carCards).forEach(card => {
            const cardYear = card.dataset.year;
            const cardFuel = card.dataset.fuel;
            const cardPrice = parseFloat(card.dataset.price);
            const cardType = card.dataset.type;
            const cardTransmission = card.dataset.transmission;
            const cardStatus = card.dataset.status;
            const cardModel = card.querySelector('.car-model').textContent.toLowerCase();

            let show = true;

            if (year && cardYear !== year) show = false;
            if (fuel && cardFuel !== fuel) show = false;
            if (price) {
                if (price === '0-100' && cardPrice >= 100) show = false;
                else if (price === '100-200' && (cardPrice < 100 || cardPrice >= 200)) show = false;
                else if (price === '200+' && cardPrice < 200) show = false;
            }
            if (type && cardType !== type) show = false;
            if (transmission && cardTransmission !== transmission) show = false;
            if (status && cardStatus !== status) show = false;
            if (search && !cardModel.includes(search)) show = false;

            card.style.display = show ? 'block' : 'none';
        });
    }

    yearFilter.addEventListener('change', filterCars);
    fuelFilter.addEventListener('change', filterCars);
    priceFilter.addEventListener('change', filterCars);
    typeFilter.addEventListener('change', filterCars);
    transmissionFilter.addEventListener('change', filterCars);
    statusFilter.addEventListener('change', filterCars);
    searchBar.addEventListener('input', filterCars);
});