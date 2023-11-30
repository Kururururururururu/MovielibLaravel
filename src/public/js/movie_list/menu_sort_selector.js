const radioButtons = document.getElementsByName("sortby");

const params = new URLSearchParams(window.location.search);

if (params.has("sort")) {
    const sort = params.get("sort");
    radioButtons.forEach((radio) => {
        if (radio.value === sort) {
            radio.checked = true;
        }
    });
}

radioButtons.forEach((radio) => {
    radio.addEventListener("change", () => {
        const params = new URLSearchParams(window.location.search);
        params.set("sort", radio.value);
        window.location.search = params.toString();
    });
});
