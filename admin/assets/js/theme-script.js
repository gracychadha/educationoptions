// Apply the saved theme settings from local storage
document.querySelector("html").setAttribute("data-theme", localStorage.getItem("theme") || "light");
document.querySelector("html").setAttribute("data-sidebar", localStorage.getItem("sidebarTheme") || "light");
document.querySelector("html").setAttribute("data-color", localStorage.getItem("color") || "primary");
document.querySelector("html").setAttribute("data-topbar", localStorage.getItem("topbar") || "white");

let themesettings = `
  <div class="sidebar-contact ">
      <div class="toggle-theme"  data-bs-toggle="offcanvas" data-bs-target="#theme-setting"><i class="fa fa-cog fa-w-16 fa-spin"></i></div>
      </div>
      <div class="sidebar-themesettings offcanvas offcanvas-end" id="theme-setting">
      <div class="offcanvas-header d-flex align-items-center justify-content-between bg-light-500">
          <div>
              <h4 class="mb-1">Theme Customizer</h4>
              <p>Choose your themes & layouts etc.</p>
          </div>
          <a href="#" class="custom-btn-close d-flex align-items-center justify-content-center text-white"  data-bs-dismiss="offcanvas"><i class="ti ti-x"></i></a>
      </div>
      <div class="themesettings-inner offcanvas-body">
          <div class="accordion accordion-customicon1 accordions-items-seperate" id="settingtheme">
              <div class="accordion-item">
                  <h2 class="accordion-header">
                      <button class="accordion-button text-dark fs-16" type="button" data-bs-toggle="collapse" data-bs-target="#colorsetting" aria-expanded="true">
                          Top Bar Color
                      </button>
                  </h2>
                  <div id="colorsetting" class="accordion-collapse collapse show"	>
                      <div class="accordion-body">
                         <div class="d-flex align-items-center">
                              <div class="theme-colorselect m-1 me-3">
                                  <input type="radio" name="topbar" id="whiteTopbar" value="white" checked>
                                  <label for="whiteTopbar" class="white-topbar"></label>
                              </div>
                              <div class="theme-colorselect m-1 me-3">
                                  <input type="radio" name="topbar" id="darkTopbar" value="dark">
                                  <label for="darkTopbar" class="dark-topbar"></label>
                              </div>
                              <div class="theme-colorselect m-1 me-3">
                                  <input type="radio" name="topbar" id="primaryTopbar" value="primary">
                                  <label for="primaryTopbar" class="primary-topbar"></label>
                              </div>
                              <div class="theme-colorselect m-1">
                              <input type="radio" name="topbar" id="greyTopbar" value="grey">
                              <label for="greyTopbar" class="grey-topbar"></label>
                          </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="accordion-item">
                  <h2 class="accordion-header">
                      <button class="accordion-button text-dark fs-16" type="button" data-bs-toggle="collapse" data-bs-target="#modesetting" aria-expanded="true">
                          Color Mode
                      </button>
                  </h2>
                  <div id="modesetting" class="accordion-collapse collapse show">
                      <div class="accordion-body">
                         <div class="row gx-3">
                              <div class="col-6">
                                  <div class="theme-mode">
                                      <input type="radio" name="theme" id="lightTheme" value="light" checked>
                                      <label for="lightTheme" class="p-2 rounded fw-medium w-100">
                                          <span class="avatar avatar-md d-inline-flex rounded me-2"><i class="ti ti-sun-filled"></i></span>Light Mode
                                      </label>
                                  </div>
                              </div>
                              <div class="col-6">
                                  <div class="theme-mode">
                                      <input type="radio" name="theme" id="darkTheme" value="dark" >
                                      <label for="darkTheme" class="p-2 rounded fw-medium w-100">
                                          <span class="avatar avatar-md d-inline-flex rounded me-2"><i class="ti ti-moon-filled"></i></span>Dark Mode
                                      </label>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="accordion-item">
                  <h2 class="accordion-header">
                      <button class="accordion-button text-dark fs-16" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarsetting" aria-expanded="true">
                          Sidebar Color
                      </button>
                  </h2>
                  <div id="sidebarsetting" class="accordion-collapse collapse show"	 >
                      <div class="accordion-body">
                         <div class="d-flex align-items-center">
                              <div class="theme-colorselect m-1 me-3">
                                  <input type="radio" name="sidebar" id="lightSidebar" value="light" checked>
                                  <label for="lightSidebar" class="d-block rounded mb-2">
                                  </label>
                              </div>
                              <div class="theme-colorselect m-1 me-3">
                                  <input type="radio" name="sidebar" id="darkSidebar" value="dark">
                                  <label for="darkSidebar" class="d-block rounded bg-dark mb-2">
                                  </label>
                              </div>
                              <div class="theme-colorselect m-1 me-3">
                                  <input type="radio" name="sidebar" id="primarySidebar" value="primary">
                                  <label for="primarySidebar" class="d-block rounded bg-primary mb-2">
                                  </label>
                              </div>
                              <div class="theme-colorselect m-1 me-3">
                                  <input type="radio" name="sidebar" id="darkblackSidebar" value="darkblack">
                                  <label for="darkblackSidebar" class="d-block rounded bg-darkblack mb-2">
                                  </label>
                              </div>
                              <div class="theme-colorselect m-1">
                                  <input type="radio" name="sidebar" id="darkblueSidebar" value="darkblue">
                                  <label for="darkblueSidebar" class="d-block rounded bg-darkblue mb-2">
                                  </label>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="accordion-item">
                  <h2 class="accordion-header">
                      <button class="accordion-button text-dark fs-16" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarcolor" aria-expanded="true">
                          Theme Colors
                      </button>
                  </h2>
                  <div id="sidebarcolor" class="accordion-collapse collapse show"	 >
                      <div class="accordion-body pb-2">
                         <div class="d-flex align-items-center">
                              <div class="theme-colorsset me-3 mb-2">
                                  <input type="radio" name="color" id="primaryColor" value="primary" checked>
                                  <label for="primaryColor" class="primary-clr"></label>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="bg-light-500 p-3">
          <div class="row gx-3">
              <div class="col-6">
                  <a href="#" id="resetbutton" class="btn btn-light close-theme w-100">Reset</a>
              </div>
          </div>
      </div>
      </div>
              `;

document.addEventListener("DOMContentLoaded", function () {
  $(".main-wrapper").append(themesettings);
});

document.addEventListener("DOMContentLoaded", function (event) {
  const darkModeToggle = document.getElementById("dark-mode-toggle");
  const lightModeToggle = document.getElementById("light-mode-toggle");
  const darkMode = localStorage.getItem("darkMode");

  function enableDarkMode() {
    document.documentElement.setAttribute("data-theme", "dark");
    darkModeToggle.classList.remove("activate");
    lightModeToggle.classList.add("activate");
    localStorage.setItem("darkMode", "enabled");
  }

  function disableDarkMode() {
    document.documentElement.setAttribute("data-theme", "light");
    lightModeToggle.classList.remove("activate");
    darkModeToggle.classList.add("activate");
    localStorage.removeItem("darkMode");
  }

  // Check if darkModeToggle and lightModeToggle exist before adding event listeners
  if (darkModeToggle && lightModeToggle) {
    // Check the current mode on page load
    if (darkMode === "enabled") {
      enableDarkMode();
    } else {
      disableDarkMode();
    }

    // Add event listeners
    darkModeToggle.addEventListener("click", enableDarkMode);
    lightModeToggle.addEventListener("click", disableDarkMode);
  }
});

document.addEventListener("DOMContentLoaded", function () {
  // Your existing JavaScript code
  const themeRadios = document.querySelectorAll('input[name="theme"]');
  const sidebarRadios = document.querySelectorAll('input[name="sidebar"]');
  const colorRadios = document.querySelectorAll('input[name="color"]');
  const topbarRadios = document.querySelectorAll('input[name="topbar"]');
  const resetButton = document.getElementById("resetbutton");

  function setThemeAndSidebarTheme(theme, sidebarTheme, color, topbar) {
    // Setting data attributes and classes
    document.documentElement.setAttribute("data-theme", theme);
    document.documentElement.setAttribute("data-sidebar", sidebarTheme);
    document.documentElement.setAttribute("data-color", color);
    document.documentElement.setAttribute("data-topbar", topbar);

    // Saving to localStorage
    localStorage.setItem("theme", theme);
    localStorage.setItem("sidebarTheme", sidebarTheme);
    localStorage.setItem("color", color);
    localStorage.setItem("topbar", topbar);
  }

  function handleInputChange() {
    const theme = document.querySelector('input[name="theme"]:checked').value;
    const sidebarTheme = document.querySelector('input[name="sidebar"]:checked').value;
    const color = document.querySelector('input[name="color"]:checked').value;
    const topbar = document.querySelector('input[name="topbar"]:checked').value;

    setThemeAndSidebarTheme(theme, sidebarTheme, color, topbar);
  }

  function resetThemeAndSidebarThemeAndColor() {
    setThemeAndSidebarTheme("light", "light", "primary", "white");

    document.getElementById("lightTheme").checked = true;
    document.getElementById("lightSidebar").checked = true;
    document.getElementById("primaryColor").checked = true;
    document.getElementById("whiteTopbar").checked = true;
  }

  // Adding event listeners
  themeRadios.forEach((radio) =>
    radio.addEventListener("change", handleInputChange)
  );
  sidebarRadios.forEach((radio) =>
    radio.addEventListener("change", handleInputChange)
  );
  colorRadios.forEach((radio) =>
    radio.addEventListener("change", handleInputChange)
  );
  topbarRadios.forEach((radio) =>
    radio.addEventListener("change", handleInputChange)
  );
  resetButton.addEventListener("click", resetThemeAndSidebarThemeAndColor);

  // Initial setup from localStorage
  const savedTheme = localStorage.getItem("theme") || "light";
  const savedSidebarTheme = localStorage.getItem("sidebarTheme") || "light";
  const savedColor = localStorage.getItem("color") || "primary";
  const savedTopbar = localStorage.getItem("topbar") || "white";

  setThemeAndSidebarTheme(savedTheme, savedSidebarTheme, savedColor, savedTopbar);

  // Check and set radio buttons based on saved preferences
  if (document.getElementById(`${savedTheme}Theme`)) {
    document.getElementById(`${savedTheme}Theme`).checked = true;
  }
  if (document.getElementById(`${savedSidebarTheme}Sidebar`)) {
    document.getElementById(`${savedSidebarTheme}Sidebar`).checked = true;
  }
  if (document.getElementById(`${savedColor}Color`)) {
    document.getElementById(`${savedColor}Color`).checked = true;
  }
  if (document.getElementById(`${savedTopbar}Topbar`)) {
    document.getElementById(`${savedTopbar}Topbar`).checked = true;
  }
});
