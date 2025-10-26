document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebar-toggle");
    const themeToggle = document.getElementById("theme-toggle");
    const logoutBtn = document.getElementById("logout-btn");
    const body = document.body;
    const navItems = document.querySelectorAll("#sidebar li[data-section]");
    const contentSections = document.querySelectorAll(".content-section");
    const pageTitleElement = document.querySelector(".page-title");
    const themeIcon = themeToggle.querySelector("i");

    sidebarToggle.addEventListener("click", () => {
        if (window.innerWidth > 768) {
            sidebar.classList.toggle("collapsed");
        } else {
            sidebar.classList.toggle("visible");
        }
    });

    function applyTheme(isDark) {
        if (isDark) {
            body.classList.add("dark-mode");
            body.classList.remove("light-mode");
            themeIcon.classList.remove("fa-moon");
            themeIcon.classList.add("fa-sun");
            localStorage.setItem("theme", "dark-mode");
        } else {
            body.classList.remove("dark-mode");
            body.classList.add("light-mode");
            themeIcon.classList.remove("fa-sun");
            themeIcon.classList.add("fa-moon");
            localStorage.setItem("theme", "light-mode");
        }
    }

    const storedTheme = localStorage.getItem("theme");
    if (storedTheme === "dark-mode") {
        applyTheme(true);
    } else {
        body.classList.add("light-mode");
    }

    themeToggle.addEventListener("click", () => {
        const isCurrentlyDark = body.classList.contains("dark-mode");
        applyTheme(!isCurrentlyDark);
    });

    navItems.forEach((item) => {
        item.addEventListener("click", () => {
            const targetSectionId = item.getAttribute("data-section");

            navItems.forEach((i) => i.classList.remove("active"));
            item.classList.add("active");

            contentSections.forEach((section) => section.classList.remove("active"));
            
            const targetSection = document.getElementById(targetSectionId);
            if (targetSection) {
                targetSection.classList.add("active");

                const newTitle = targetSection.querySelector("h2") ? 
                                 targetSection.querySelector("h2").textContent.trim() : 
                                 'Dashboard';
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

    logoutBtn.addEventListener("click", () => {
        alert("Logging out of TechStore Admin System. Thank you for your service!");
    });
});

function handleCrudAction(action) {
    alert(`[${action}]: Action triggered! A modal form for input/editing would typically open here.`);
}

function confirmDelete() {
    if (confirm("CONFIRM: Are you sure you want to DELETE this record? This action cannot be undone.")) {
        handleCrudAction("DELETE");
    }
}

document.addEventListener('DOMContentLoaded', () => {
      const addProductForm = document.getElementById('addProductForm');
      const modalAlertContainer = document.getElementById('modal-alert-container');
      const saveBtn = document.getElementById('saveProductBtn');
      const toastContainer = document.getElementById('toast-container');
      const notifSound = document.getElementById('notifSound');

      function playSound() {
        notifSound.currentTime = 0;
        notifSound.play().catch(() => {});
      }

      function showModalAlert(message, type) {
        playSound();
        const iconClass = {
          success: 'fas fa-check-circle',
          error: 'fas fa-times-circle',
          info: 'fas fa-info-circle'
        }[type] || 'fas fa-info-circle';

        const alertClasses = {
          success: 'bg-accent-green/10 text-accent-green border border-accent-green/30',
          error: 'bg-danger-red/10 text-danger-red border border-danger-red/30',
          info: 'bg-blue-100 text-blue-600 border border-blue-200'
        }[type] || 'bg-blue-100 text-blue-600 border border-blue-200';

        modalAlertContainer.innerHTML = `
          <div class="modal-alert ${alertClasses}" role="alert">
            <div class="flex items-center gap-2">
              <i class="${iconClass} text-xl flex-shrink-0"></i>
              <span class="text-sm font-medium leading-snug">${message}</span>
            </div>
          </div>
        `;
      }

      function showToast(message, type) {
        playSound(); 
        const toast = document.createElement('div');
        const icon = {
          success: 'fa-check-circle text-white',
          error: 'fa-times-circle text-white',
          info: 'fa-info-circle text-white'
        }[type] || 'fa-info-circle text-white';

        const bg = {
          success: 'bg-green-600',
          error: 'bg-red-600',
          info: 'bg-blue-600'
        }[type] || 'bg-blue-600';

        const borderColor = {
          success: 'border-green-700',
          error: 'border-red-700',
          info: 'border-blue-700'
        }[type] || 'border-blue-700';

        toast.className = `toast ${bg} ${borderColor} border-l-4 text-white rounded-md shadow-md flex justify-between items-center p-3 mb-2 animate-fadeIn`;
        toast.innerHTML = `
          <div class="flex items-center gap-2">
            <i class="fas ${icon} text-xl"></i>
            <div class="font-medium">${message}</div>
          </div>
          <button class="close-toast font-bold text-white hover:opacity-70 transition" aria-label="Close">&times;</button>
        `;

        toastContainer.appendChild(toast);

        toast.querySelector('.close-toast').addEventListener('click', () => {
          toast.style.animation = "fadeOut 0.4s forwards";
          setTimeout(() => toast.remove(), 400);
        });

        const duration = 4000;
        setTimeout(() => {
          toast.style.animation = "fadeOut 0.4s forwards";
          setTimeout(() => toast.remove(), 400);
        }, duration);
      }

      addProductForm.addEventListener('submit', e => {
        e.preventDefault();

        const productName = document.getElementById('product_name').value.trim();
        const category = document.getElementById('category').value.trim();
        const unitPrice = parseFloat(document.getElementById('unit_price').value.trim());
        const productId = document.getElementById('product_id').value.trim();

        if (!productName || !category || isNaN(unitPrice) || unitPrice <= 0) {
          showModalAlert('Please ensure all required fields are filled correctly.', 'error');
          showToast('Fill all required fields correctly.', 'error');
          return;
        }

        saveBtn.disabled = true;
        saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Saving...';
        saveBtn.classList.add('opacity-75');

        setTimeout(() => {
          const success = Math.random() > 0.1;
          if (success) {
            showModalAlert(`Product ${productName} has been successfully registered.`, 'success');
            showToast(`Product "${productName}" saved successfully!`, 'success');
            addProductForm.reset();
          } else {
            showModalAlert('Save Failed: Please try again.', 'error');
            showToast('Failed to save product. Try again.', 'error');
          }

          saveBtn.disabled = false;
          saveBtn.innerHTML = '<i class="fas fa-save mr-2"></i> Save Product';
          saveBtn.classList.remove('opacity-75');
        }, 1500);
      });
    });