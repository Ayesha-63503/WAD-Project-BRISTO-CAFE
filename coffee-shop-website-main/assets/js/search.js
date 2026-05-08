console.log("search.js loaded");

window.addEventListener("load", function () {

    const searchBtn = document.getElementById("search-btn");
    const searchForm = document.querySelector(".search-form");
    const searchBox = document.getElementById("search-box");

    if (!searchBtn || !searchForm || !searchBox) {
        console.log("Search elements missing");
        return;
    }

    // toggle search box
    searchBtn.addEventListener("click", function () {
        searchForm.classList.toggle("active");
        searchBox.focus();
    });

    // enter search
    searchBox.addEventListener("keydown", function (e) {
        if (e.key === "Enter") {

            let query = this.value.trim();

            console.log("Searching:", query);

            if (query !== "") {
                window.location.href = "menu.php?search=" + encodeURIComponent(query);
            }
        }
    });

});