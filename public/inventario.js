document.addEventListener('DOMContentLoaded', function() {
    const inventoryTable = document.getElementById('inventory-table');
    const carItems = inventoryTable ? inventoryTable.getElementsByClassName('car-item') : [];

    const searchBar = document.getElementById('search-bar');

    if (carItems.length === 0) {
        console.error('No se encontraron elementos para filtrar en inventario.');
        return;
    }

    function filterItems() {
        const search = searchBar ? searchBar.value.toLowerCase() : '';

        Array.from(carItems).forEach(item => {
            const itemModel = item.dataset.model || '';
            const itemPlaca = item.dataset.placa || '';

            let show = true;

            if (search && !itemModel.toLowerCase().includes(search) && !itemPlaca.toLowerCase().includes(search)) {
                show = false;
            }

            item.style.display = show ? 'table-row' : 'none';
        });
    }

    if (searchBar) searchBar.addEventListener('input', filterItems);

    // Ejecutar el filtrado inicial
    filterItems();
});