$("#main_con .btn").click(function (e) {
    e.preventDefault();
    var formData = new FormData($("#main_con")[0]);
    $.ajax({
        type: "post",
        url: "/api/product/create",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            showToast("Product successfully added.", "primary", true);
            $("#main_con .form-control").val("");
        },
        error: (e) => {
            e = e.responseJSON;
            if (e.errors) labelErrors("#main_con .form-control", e.errors);
            else toastError();
        },
    });
});
// load all categories
$.ajax({
    type: "get",
    url: "/api/category/index",
    success: function (cats) {
        $.each(cats, function (indexInArray, cat) {
            $("select.form-control[name=category_id]").append(`
            <option value="${cat.id}">${cat.name}</option>    
            `);
            $.each(cat.subcategories, function (indexInArray, sub) {
                $("select.form-control[name=subcategory_id]").append(`
                    <option class="d-none cat cat${cat.id}" value="${sub.id}">${sub.name}</option>    
                    `);
            });
        });
        on_page_load("");
    },
    error: (e) => {
        toastError();
    },
});
//  load sub category on category change
$("select.form-control[name=category_id]").change(function (e) {
    e.preventDefault();
    $("select.form-control[name=subcategory_id] option.cat").addClass("d-none");
    $(`select.form-control option.cat${$(this).val()}`).removeClass("d-none");
});
