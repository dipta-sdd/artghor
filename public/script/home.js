prod_con_resize();
$(document).ready(function () {
    $(".carousel").carousel({ interval: 3000 });
});
$(window).on("resize", function () {
    prod_con_resize();
});
function prod_con_resize() {
    let prod_con_width = $("#prod_con .container").width();
    console.log(prod_con_width);
    prod_con_width -= prod_con_width % 260;
    $("#prod_con .container .d-flex").width(prod_con_width);
}
