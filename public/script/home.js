prod_con_resize();
$(document).ready(function () {
    $(".carousel").carousel({ interval: 3000 });
});
$(window).on("resize", function () {
    prod_con_resize();
});
function prod_con_resize() {
    let prod_con_width = $("#prod_con .container").width();

    let extra = prod_con_width % 250;
    let items = (prod_con_width - extra) / 250 - 1;
    let gap = extra / items;
    if (gap < 10) {
        gap = (extra + 250) / items;
    }
    $("#prod_con .container .d-flex").css("column-gap", gap + "px");
}
