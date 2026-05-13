/**
 * In this file we have the logic used throughout all the file that
 * uses the filters features
 */

const activeFilters = {};
const tableRows = document.querySelectorAll('#search-table tr');

/**
 * Display the dropdown of the rigth colomn according to the key id
 * @param id
 */
function toggleDropdown(id) {
    document.querySelectorAll('.filter-dropdown').forEach(el => {
        if (el.id !== id) el.classList.add('hidden');
    });
    document.getElementById(id).classList.toggle('hidden');
}

/**
 * If option.length > 5 the user can click on 'voir plus' / 'voir moins'
 * This function is used to either show all the options or only five
 * @param id
 * @param btn
 */
function toggleMore(id, btn) {
    const el = document.getElementById(id);
    const isHidden = el.classList.toggle('hidden');
    btn.textContent = isHidden
        ? btn.textContent.replace('Voir moins', 'Voir plus (' + el.querySelectorAll('button').length + ')')
        : 'Voir moins';
}

/**
 * Add the filter to the activeFilters variable
 * And change the style of the active filter (UI)
 * @param filterId
 * @param value
 */
function setFilter(filterId, value) {
    activeFilters[filterId] = value;
    const panel = document.getElementById(filterId);
    panel.querySelectorAll('.filter-option').forEach(opt => {
        const isSelected = opt.dataset.value === value;
        opt.classList.toggle('bg-indigo-500/10', isSelected);
        opt.classList.toggle('text-indigo-400', isSelected);
        opt.querySelector('.check-icon').style.opacity = isSelected ? '1' : '0';
    });
}

/**
 * "Delete" a filter from the activefilters variable
 * @param filterId
 */
function clearFilter(filterId) {
    setFilter(filterId, '');
}

/**
 * Filter the rows of the table according to the values in activeFilters
 * @param filterId
 */
function applyFilter(filterId) {
    document.getElementById(filterId).classList.add('hidden');

    tableRows.forEach(row => {
        const text = row.innerText.toLowerCase();

        const visible = Object.entries(activeFilters).every(([filterId, value]) => {
            return value === '' || text.includes(value.toLowerCase());
        });

        row.style.display = visible ? '' : 'none';
    });
}

// Close the dropdown when the user click outside
document.addEventListener('click', e => {
    if (!e.target.closest('.relative')) {
        document.querySelectorAll('.filter-dropdown').forEach(el => el.classList.add('hidden'));
    }
});
