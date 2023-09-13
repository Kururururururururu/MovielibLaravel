const html = document.getElementsByTagName("html")[0];

const theme = localStorage.getItem("theme");
if (theme) {
    html.className = theme;
} else {
    const prefersDarkMode = matchMedia('(prefers-color-scheme: dark)').matches
    html.className = prefersDarkMode ? 'dark' : 'light'
}

const button = document.getElementById('theme-toggle')
const handleThemeToggle = () => {
    html.className = html.className === 'dark' ? 'light' : 'dark'
    localStorage.setItem("theme", html.className);
}

button.addEventListener('click', handleThemeToggle)
