// Load the dashboard page in mobile view
document.getElementById('menuToggle').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('hidden');
});

// Load the selected page
function loadPage(page) {
    // Hide all pages
    var pages = document.querySelectorAll('.ud-page-wrapper');
    pages.forEach(function (p) {
        p.classList.add('hidden');
    });

    // Show the selected page if it exists
    var selectedPage = document.getElementById(page);
    if (selectedPage) {
        selectedPage.classList.remove('hidden');
    } else {
        console.error(`Page with id '${page}' not found.`);
        return;
    }

    // Update the active state in the sidebar
    var items = document.querySelectorAll('.u-sidebar-value');
    items.forEach(function (item) {
        item.classList.remove('bg-customBlue');
    });

    var activeItem = document.querySelector(`.u-sidebar-value[data-page="${page}"]`);
    if (activeItem) {
        activeItem.classList.add('bg-customBlue');
    } else {
        console.error(`Sidebar item with data-page="${page}" not found.`);
    }

    // Update the breadcrumb
    var breadcrumb = document.getElementById('breadcrumb');
    if (breadcrumb) {
        breadcrumb.textContent = ` / ${page.charAt(0).toUpperCase() + page.slice(1).replace(/([A-Z])/g, ' $1').trim()}`;
    } else {
        console.error('Breadcrumb element not found.');
    }
}


