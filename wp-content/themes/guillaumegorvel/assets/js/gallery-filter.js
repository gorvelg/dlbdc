document.addEventListener("DOMContentLoaded", () => {
    const filterWrap = document.querySelector(".gg-gallery-filters");
    const items = document.querySelectorAll(".gg-gallery-item");

    if (!filterWrap || !items.length) return;

    const buttons = filterWrap.querySelectorAll("[data-filter]");

    buttons.forEach((button) => {
        button.addEventListener("click", () => {
            const filter = button.dataset.filter;

            buttons.forEach((btn) => btn.classList.remove("is-active"));
            button.classList.add("is-active");

            items.forEach((item) => {
                const categories = item.dataset.category
                    ? item.dataset.category.split(" ")
                    : [];

                const shouldShow =
                    filter === "all" || categories.includes(filter);

                item.hidden = !shouldShow;
            });
        });
    });
});