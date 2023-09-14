const html = document.getElementsByTagName("html")[0];

const theme = localStorage.getItem("theme");
if (theme) {
    html.classList.add(theme);
} else {
    const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
    if (prefersDarkScheme.matches) {
        html.classList.add("dark");
    } else {
        html.classList.add("light");
    }
}

const button = document.getElementById("theme-toggle");
const moon = document.getElementById("theme-toggle-moon");
const sun = document.getElementById("theme-toggle-sun");

switch (html.classList.contains("dark") ? "dark" : "light") {
    case "dark":
        moon.style.display = "block";
        sun.style.display = "none";
        break;
    case "light":
        moon.style.display = "none";
        sun.style.display = "block";
        break;
}

button.addEventListener("click", () => {
    const isDarkMode = html.classList.contains("dark");

    const iconFadeOut = [{ opacity: 1 }, { opacity: 0 }];
    const iconFadeIn = [{ opacity: 0 }, { opacity: 1 }];

    if (isDarkMode) {
        moon.animate(iconFadeOut, {
            duration: 200,
        }).finished.then(() => {
            moon.style.display = "none";
            sun.style.display = "block";
        });
        sun.animate(iconFadeIn, {
            duration: 200,
        });
    } else {
        sun.animate(iconFadeOut, {
            duration: 200,
        }).finished.then(() => {
            moon.style.display = "block";
            sun.style.display = "none";
        });

        moon.animate(iconFadeIn, {
            duration: 200,
        });
    }

    html.classList.toggle("dark");
    html.classList.toggle("light");
    localStorage.setItem("theme", isDarkMode ? "light" : "dark");
});
