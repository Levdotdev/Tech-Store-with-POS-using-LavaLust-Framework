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