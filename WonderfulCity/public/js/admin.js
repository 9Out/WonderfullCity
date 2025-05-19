const sidebar = document.getElementById('sidebar')
const menu_btn = document.getElementById('menu-toggle')

// Tombol hide show sidebar
function toggleSidebar() {
    sidebar.classList.toggle('show')
    menu_btn.classList.toggle('show')
}

// Dropdown Kelola Barang Sidebar
function toggleDropdown(event) {
    event.preventDefault();
    const dropdown = event.currentTarget.closest('.dropdown');
    const arrow_down = document.getElementById('arrow-down');
    const fa_gear = document.getElementById('fa_gear')
    dropdown.classList.toggle('active');
    arrow_down.classList.toggle('active');
    fa_gear.classList.toggle('active');
}

