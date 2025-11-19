document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebar-toggle");
    const themeToggle = document.getElementById("theme-toggle");
    const logoutBtnTrigger = document.getElementById("logout-btn-trigger"); 
    
    const body = document.body;
    const navItems = document.querySelectorAll("#sidebar li[data-section]");
    const contentSections = document.querySelectorAll(".content-section");
    const pageTitleElement = document.querySelector(".page-title");
    const themeIcon = themeToggle ? themeToggle.querySelector("i") : null;

    // Buttons that may exist on page
    const addProductBtn = document.getElementById("add-product-btn");
    const importInventoryBtn = document.getElementById("import-inventory-btn");
    // table container - event delegation
    const productsTable = document.getElementById("products-table"); // optional container id; fallback to document

    if (addProductBtn) {
        // open add product modal instead of redirect
        addProductBtn.addEventListener("click", (e) => {
            e.preventDefault();
            openModal(document.getElementById('product-add-modal'));
        });
    }

    if (importInventoryBtn) {
        importInventoryBtn.addEventListener("click", (e) => {
            e.preventDefault();
            openModal(document.getElementById('inventory-import-modal'));
        });
    }

    sidebarToggle.addEventListener("click", () => {
        if (window.innerWidth > 768) {
            sidebar.classList.toggle("collapsed");
        } else {
            sidebar.classList.toggle("visible");
        }
    });

    function applyTheme(isDark) {
        if (!themeIcon) return;
        if (isDark) {
            body.classList.add("dark-mode");
            body.classList.remove("light-mode");
            themeIcon.classList.replace("fa-moon", "fa-sun");
            localStorage.setItem("theme", "dark-mode");
        } else {
            body.classList.replace("dark-mode", "light-mode");
            themeIcon.classList.replace("fa-sun", "fa-moon");
            localStorage.setItem("theme", "light-mode");
        }
    }

    const storedTheme = localStorage.getItem("theme");
    applyTheme(storedTheme === "dark-mode");

    if (themeToggle) {
        themeToggle.addEventListener("click", () => {
            applyTheme(!body.classList.contains("dark-mode"));
        });
    }

    navItems.forEach((item) => {
        item.addEventListener("click", () => {
            const targetSectionId = item.getAttribute("data-section");

            navItems.forEach((i) => i.classList.remove("active"));
            item.classList.add("active");

            contentSections.forEach((section) => section.classList.remove("active"));

            const targetSection = document.getElementById(targetSectionId);
            if (targetSection) {
                targetSection.classList.add("active");

                const newTitle = targetSection.querySelector("h6")
                    ? targetSection.querySelector("h6").textContent.trim()
                    : 'Dashboard';
                pageTitleElement.textContent = newTitle;
            }

            if (window.innerWidth <= 768) {
                sidebar.classList.remove("visible");
            }
        });
    });

    const activeSection = document.querySelector(".content-section.active");
    if (activeSection && activeSection.querySelector("h2")) {
        pageTitleElement.textContent = activeSection.querySelector("h2").textContent.trim();
    }

    const profileMenu = document.getElementById("profile-menu");
    const profileToggle = document.getElementById("profile-toggle");

    if (profileToggle) {
        profileToggle.addEventListener("click", (e) => {
            e.stopPropagation(); 
            profileMenu.classList.toggle("active");
        });
    }

    document.addEventListener("click", (e) => {
        if (profileMenu && !profileMenu.contains(e.target)) {
            profileMenu.classList.remove("active");
        }
    });

    const dropdownItems = document.querySelectorAll(".profile-dropdown li, .profile-dropdown li button");
    dropdownItems.forEach(item => {
        item.addEventListener("click", () => {
            profileMenu.classList.remove("active");
        });
    });

    // Modal Logic (extended)
    const settingsModal = document.getElementById('settings-modal');
    const logoutModal = document.getElementById('logout-modal');

    // new modals
    const inventoryImportModal = document.getElementById('inventory-import-modal');
    const inventoryUpdateModal = document.getElementById('inventory-update-modal');
    const productAddModal = document.getElementById('product-add-modal');
    const productUpdateModal = document.getElementById('product-update-modal');

    const settingsBtn = document.getElementById('account-settings-btn');
    const confirmLogoutBtn = document.getElementById('confirm-logout-btn');
    const saveSettingsBtn = document.getElementById('save-settings-btn');

    const closeButtons = document.querySelectorAll('.modal-close-btn');
    const cancelButtons = document.querySelectorAll('.modal-cancel-btn');
    const overlays = document.querySelectorAll('.modal-overlay');

    function openModal(modal) {
        if (modal) modal.classList.remove('hidden');
    }

    function closeModal(modal) {
        if (modal) modal.classList.add('hidden');
    }

    if (settingsBtn) {
        settingsBtn.addEventListener('click', () => {
            openModal(settingsModal);
        });
    }

    if (logoutBtnTrigger) {
        logoutBtnTrigger.addEventListener('click', () => {
            openModal(logoutModal);
        });
    }

    closeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            closeModal(document.getElementById(btn.dataset.modalId));
        });
    });

    cancelButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            closeModal(document.getElementById(btn.dataset.modalId));
        });
    });
    
    overlays.forEach(overlay => {
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) {
                closeModal(overlay);
            }
        });
    });

    if (saveSettingsBtn) {
        saveSettingsBtn.addEventListener('click', () => {
            const newPass = document.getElementById('new-password').value;
            const confirmPass = document.getElementById('confirm-password').value;

            if (newPass && newPass !== confirmPass) {
                alert('New passwords do not match!');
                return;
            }

            alert('Account settings saved!');
            closeModal(settingsModal);
        });
    }

    // ---------- New: CSV import validation & handler ----------
    const importCsvBtn = document.getElementById('import-csv-btn');
    const csvFileInput = document.getElementById('csv-file');
    if (importCsvBtn) {
        importCsvBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (!csvFileInput || !csvFileInput.files || csvFileInput.files.length === 0) {
                alert('Please choose a CSV file to import.');
                return;
            }
            const file = csvFileInput.files[0];
            const name = file.name.toLowerCase();
            if (!name.endsWith('.csv')) {
                alert('Invalid file type — please upload a .csv file only.');
                return;
            }
            // Placeholder: send file via fetch/XHR or submit form to server
            // Example: use FormData and POST to /import-csv.php
            const fd = new FormData();
            fd.append('csv', file);
            // show basic feedback (real upload code should send to server)
            alert('CSV validated — uploading (placeholder). Replace with real upload).');
            closeModal(inventoryImportModal);
        });
    }

    // ---------- Helper: get product fields from a table row ----------
    // Expects <tr data-id="123"> and cells in predictable columns OR data attributes.
    function readProductFromRow(tr) {
        if (!tr) return null;
        const id = tr.dataset.id;
        // Attempt to read columns by selectors or data attributes:
        // Prefer data attributes on the row (data-name, data-stock, data-price, data-barcode)
        const name = tr.dataset.name || (tr.querySelector('.col-name') ? tr.querySelector('.col-name').textContent.trim() : '');
        const stock = tr.dataset.stock || (tr.querySelector('.col-stock') ? tr.querySelector('.col-stock').textContent.trim() : '');
        const price = tr.dataset.price || (tr.querySelector('.col-price') ? tr.querySelector('.col-price').textContent.trim() : '');
        const barcode = tr.dataset.barcode || (tr.querySelector('.col-barcode') ? tr.querySelector('.col-barcode').textContent.trim() : '');
        return { id, name, stock, price, barcode };
    }

    // ---------- Event delegation for product table row buttons ----------
    // Two types of row buttons expected: .open-update-inventory and .open-update-product
    const tableContainer = productsTable || document;
    tableContainer.addEventListener('click', (e) => {
        const target = e.target;
        // allow clicks on button or an icon inside button
        const inventoryBtn = target.closest('.update-inventory-btn');
        const productBtn = target.closest('.update-product-btn');

        if (inventoryBtn) {
            e.preventDefault();
            // find closest tr with data-id
            const tr = inventoryBtn.closest('tr[data-id]') || document.querySelector(`tr[data-id="${inventoryBtn.dataset.id || ''}"]`);
            const p = readProductFromRow(tr);
            if (p) {
                document.getElementById('inv-product-id').value = p.id || '';
                document.getElementById('inv-product-name').value = p.name || '';
                document.getElementById('inv-current-stock').value = p.stock || 0;
                document.getElementById('inv-new-stock').value = '';
                document.getElementById('inv-reason').value = '';
                openModal(inventoryUpdateModal);
            } else {
                alert('Could not read product info from the selected row.');
            }
            return;
        }

        if (productBtn) {
            e.preventDefault();
            const tr = productBtn.closest('tr[data-id]') || document.querySelector(`tr[data-id="${productBtn.dataset.id || ''}"]`);
            const p = readProductFromRow(tr);
            if (p) {
                document.getElementById('update-product-id').value = p.id || '';
                document.getElementById('update-name').value = p.name || '';
                document.getElementById('update-category').value = tr.dataset.category || '';
                document.getElementById('update-price').value = p.price || '';
                document.getElementById('update-stock').value = p.stock || '';
                document.getElementById('update-barcode').value = p.barcode || '';
                openModal(productUpdateModal);
            } else {
                alert('Could not read product info from the selected row.');
            }
            return;
        }
    });

    // ---------- Form submit handlers (placeholders) ----------
    const saveInvUpdateBtn = document.getElementById('save-inv-update-btn');
    if (saveInvUpdateBtn) {
        saveInvUpdateBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const id = document.getElementById('inv-product-id').value;
            const adjust = Number(document.getElementById('inv-new-stock').value || 0);
            const note = document.getElementById('inv-reason').value || '';
            if (!id) { alert('No product selected.'); return; }
            if (!adjust) { if(!confirm('You entered 0. Continue?')) return; }
            // Placeholder: send to server via fetch or perform AJAX update
            console.log('Inventory update:', { id, adjust, note });
            alert('Inventory updated (placeholder). Implement AJAX/PHP backend to persist.');
            closeModal(inventoryUpdateModal);
        });
    }

    const saveAddProductBtn = document.getElementById('save-add-product-btn');
    if (saveAddProductBtn) {
        saveAddProductBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const name = document.getElementById('add-name').value.trim();
            const category = document.getElementById('add-category').value.trim();
            const price = document.getElementById('add-price').value;
            const stock = document.getElementById('add-stock').value;
            const barcode = document.getElementById('add-barcode').value.trim();
            if (!name || !category) { alert('Please fill name and category.'); return; }
            // Placeholder: send to server to create product
            console.log('Add product:', { name, category, price, stock, barcode });
            alert('Product added (placeholder). Implement server call to persist.');
            closeModal(productAddModal);
        });
    }

    const saveUpdateProductBtn = document.getElementById('save-update-product-btn');
    if (saveUpdateProductBtn) {
        saveUpdateProductBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const id = document.getElementById('update-product-id').value;
            const name = document.getElementById('update-name').value.trim();
            const category = document.getElementById('update-category').value.trim();
            const price = document.getElementById('update-price').value;
            const stock = document.getElementById('update-stock').value;
            const barcode = document.getElementById('update-barcode').value.trim();
            if (!id) { alert('No product selected.'); return; }
            // Placeholder: send to server to update product
            console.log('Update product:', { id, name, category, price, stock, barcode });
            alert('Product updated (placeholder). Implement server call to persist.');
            closeModal(productUpdateModal);
        });
    }

}); // DOMContentLoaded end

// Existing global helpers you had
function confirmDelete() {
    if (confirm("CONFIRM: Are you sure you want to DELETE this record? This action cannot be undone.")) {
        handleCrudAction("DELETE");
    }
}

function handleCrudAction(action) {
    console.log("Action performed:", action);
}
