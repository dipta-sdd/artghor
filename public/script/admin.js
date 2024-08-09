$(`.sidebar.con .con a`).each(function () {
    let linkUrl = $(this).attr("href");
    let curUrl = window.location.href;
    let parsedUrl = new URL(curUrl);
    let path = parsedUrl.pathname;
    path += "";
    linkUrl += "";
    // console.log(linkUrl);
    // console.log(path);
    if (path == linkUrl) {
        // console.log("path");
        $(this).addClass("active");
    }
});
