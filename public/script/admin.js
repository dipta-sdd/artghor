const sidebarCon = document.querySelector(".sidebar.con .con");
const links = sidebarCon.querySelectorAll("a");

links.forEach((link) => {
    const linkUrl = link.getAttribute("href");
    const curUrl = window.location.href;
    const parsedUrl = new URL(curUrl);
    const path = parsedUrl.pathname;

    if (path === linkUrl) {
        link.classList.add("active");

        const ul = link.parentElement.parentElement;
        const li = ul.parentElement;
        if (li.classList.contains("drop-down")) {
            ul.classList.add("show");
        }
    }
});

// // drop down toggle
// const dropAElement = document.querySelectorAll(".drop-a");

// dropAElement.addEventListener("click", (e) => {
//     e.preventDefault();
//     const parent = e.target.parentElement;
//     console.log(parent);
//     const ul = parent.querySelector("ul");
//     ul.classList.toggle("show");
// });

$(".sidebar .drop-a").click(function (e) {
    e.preventDefault();
    const parent = e.target.parentElement;
    const ul = parent.querySelector("ul");
    ul.classList.toggle("show");
});
function collectData(selector) {
    const data = {};
    $(selector).each(function () {
        data[$(this).attr("name")] = $(this).val();
    });

    return data;
}
// border red for any error
function labelErrors(selector, e) {
    $(selector).each(function () {
        // let name = $(this).attr('name');
        if (e[$(this).attr("name")]) {
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
        }
    });
}
