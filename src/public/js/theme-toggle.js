const html = document.getElementsByTagName("html")[0];

const theme = localStorage.getItem("theme");
if (theme) {
    html.className = theme;
} else {
    const prefersDarkMode = matchMedia('(prefers-color-scheme: dark)').matches
    html.className = prefersDarkMode ? 'dark' : 'light'
}

const button = document.getElementById('theme-toggle')
const moon = document.getElementById('theme-toggle-moon')
const sun = document.getElementById('theme-toggle-sun')

switch (html.className) {
    case 'dark':
        moon.style.display = 'none'
        sun.style.display = 'block'
        break;
    case 'light':
        moon.style.display = 'block'
        sun.style.display = 'none'
        break;
    default:
        moon.style.display = 'block'
        sun.style.display = 'none'
}

button.addEventListener('click', () => {
    html.className = html.className === 'dark' ? 'light' : 'dark'
    localStorage.setItem("theme", html.className);
    switch (html.className) {
        case 'dark':
            anime({
                targets: moon,
                opacity: 0,
                complete: function() {
                    moon.style.display = 'none'
                    anime({
                        targets: sun,
                        opacity: 100,
                        complete: function() {
                            sun.style.display = 'block'
                        }
                    })
                }
            })

            break;
        case 'light':
            anime({
                targets: moon,
                opacity: 100,
                complete: function() {
                    moon.style.display = 'block'
                    anime({
                        targets: sun,
                        opacity: 0,
                        complete: function() {
                            sun.style.display = 'none'
                        }
                    })
                }
            })
            break;
        default:
            moon.style.display = 'block'
            sun.style.display = 'none'
            break;
    }
})
