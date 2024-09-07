const offCanvas = new bootstrap.Offcanvas("#offcanvasRight");
const offCanvasEdit = new bootstrap.Offcanvas("#offcanvasEdit");
const offCanvasAddSub = new bootstrap.Offcanvas("#offCanAddSub");
const offCanvasEditSub = new bootstrap.Offcanvas("#offCanEditSub");
const modal = new bootstrap.Modal("#modal1");

$.ajax({
    type: "get",
    url: "/api/category/index",
    success: function (cats) {
        $.each(cats, function (indexInArray, cat) {
            showCat(cat);
        });
        on_page_load("");
    },
    error: (e) => {
        toastError();
    },
});

function showCat(cat) {
    $(".offcanvas-body select").append(
        `<option value="${cat.id}">${cat.name}</option>`
    );
    const ul = document.createElement("ul");
    $.each(cat.subcategories, function (indexInArray, sub_cat) {
        const li = document.createElement("li");
        li.setAttribute("id", "sub" + sub_cat.id);
        li.innerHTML = `
            <span class="d-flex"> 
                <div class="flex-1 d-flex"  target="${sub_cat.id}">
                    <img src="/assets/uploades/${sub_cat.logo}" alt="Color icon" srcset="">
                    <span class="flex-1">${sub_cat.name}</span>

                <i class="fa-solid fa-pencil" target-type="subCategory"  target-cat="${sub_cat.category_id}" target-name="${sub_cat.name}" target-desc="${sub_cat.description}" target="${sub_cat.id}"></i>
                <i class="fa-solid fa-trash" target-type="subCategory" target-name="${sub_cat.name}" target-desc="${sub_cat.description}" target="${sub_cat.id}"></i>
            </span>
        `;
        ul.appendChild(li);
    });

    $(".float").append(`

                <div class="cat" id="cat${cat.id}">
                    <div class="cat-con d-flex">
                        <div class="p-1 cat-icon-name flex-1 d-flex">
                            <img src="${"/assets/uploades/" + cat.logo}" alt="${
        cat.name
    } icon" srcset=""> 
                            <span >${cat.name}</span>
                        </div>
                        
                        <i class="fa-solid fa-pencil" target-type="category" target-name="${
                            cat.name
                        }" target-desc="${cat.description}"  target="${
        cat.id
    }"></i>
                        <i class="fa-solid fa-trash" target-type="category" target-name="${
                            cat.name
                        }" target-desc="${cat.description}" target="${
        cat.id
    }"></i>
                        <i class="fa-solid fa-plus"  target-type="category" target-name="${
                            cat.name
                        }" target-desc="${cat.description}" target="${
        cat.id
    }"></i>
                    </div>
${cat.subcategories ? "<ul>" + ul.innerHTML + "</ul>" : ""}
                </div>

        `);
}

function updateCat(cat) {
    const ul = document.createElement("ul");
    $.each(cat.subcategories, function (indexInArray, sub_cat) {
        const li = document.createElement("li");
        li.setAttribute("id", "sub" + sub_cat.id);
        li.innerHTML = `
            <span class="d-flex"> 
                <div class="flex-1 d-flex"  target="${sub_cat.id}">
                    <img src="/assets/uploades/${sub_cat.logo}" alt="Color icon" srcset="">
                    <span class="flex-1">${sub_cat.name}</span>

                <i class="fa-solid fa-pencil" target-type="subCategory" target-cat="${sub_cat.category_id}" target-name="${sub_cat.name}" target-desc="${sub_cat.description}" target="${sub_cat.id}"></i>
                <i class="fa-solid fa-trash" target-type="subCategory" target-name="${sub_cat.name}" target-desc="${sub_cat.description}" target="${sub_cat.id}"></i>
            </span>
        `;
        ul.appendChild(li);
    });

    $("#cat" + cat.id).html(`

                
                    <div class="cat-con d-flex">
                        <div class="p-1 cat-icon-name flex-1 d-flex">
                            <img src="${"/assets/uploades/" + cat.logo}" alt="${
        cat.name
    } icon" srcset=""> 
                            <span >${cat.name}</span>
                        </div>
                        
                        <i class="fa-solid fa-pencil" target-type="category" target-name="${
                            cat.name
                        }" target-desc="${cat.description}"  target="${
        cat.id
    }"></i>
                        <i class="fa-solid fa-trash" target-type="category" target-name="${
                            cat.name
                        }" target-desc="${cat.description}" target="${
        cat.id
    }"></i>
                        <i class="fa-solid fa-plus"  target-type="category" target-name="${
                            cat.name
                        }" target-desc="${cat.description}" target="${
        cat.id
    }"></i>
                    </div>
${cat.subcategories ? "<ul>" + ul.innerHTML + "</ul>" : ""}
              

        `);
}

function updateSub(sub_cat) {
    // console.log(sub_cat);
    $("#sub" + sub_cat.id).html(`
                    <span class="d-flex"> 
                <div class="flex-1 d-flex"  target="${sub_cat.id}">
                    <img src="/assets/uploades/${sub_cat.logo}" alt="Color icon" srcset="">
                    <span class="flex-1">${sub_cat.name}</span>

                <i class="fa-solid fa-pencil" target-type="subCategory" target-cat="${sub_cat.category_id}" target-name="${sub_cat.name}" target-desc="${sub_cat.description}" target="${sub_cat.id}"></i>
                <i class="fa-solid fa-trash" target-type="subCategory" target-name="${sub_cat.name}" target-desc="${sub_cat.description}" target="${sub_cat.id}"></i>
            </span>
        `);
}
function addSub(sub_cat) {
    // console.log(sub_cat);
    $("#cat" + sub_cat.category_id + " ul").append(`
        <li id="sub${sub_cat.id}">
            <span class="d-flex"> 
                <div class="flex-1 d-flex"  target="${sub_cat.id}">
                    <img src="/assets/uploades/${sub_cat.logo}" alt="Color icon" srcset="">
                    <span class="flex-1">${sub_cat.name}</span>

                <i class="fa-solid fa-pencil" target-type="subCategory" target-cat="${sub_cat.category_id}" target-name="${sub_cat.name}" target-desc="${sub_cat.description}" target="${sub_cat.id}"></i>
                <i class="fa-solid fa-trash" target-type="subCategory" target-name="${sub_cat.name}" target-desc="${sub_cat.description}" target="${sub_cat.id}"></i>
            </span>
        </li>
        `);
}
function getTarget(e) {
    let target = [];
    target["name"] = e.getAttribute("target-name");
    target["type"] = e.getAttribute("target-type");
    target["desc"] = e.getAttribute("target-desc");
    target["id"] = e.getAttribute("target");
    return target;
}

// category add
$("#offcanvasRight .offcanvas-body button.btn").click(function (e) {
    e.preventDefault();
    var formData = new FormData($("#offcanvasRight form.offcanvas-body")[0]);
    $.ajax({
        type: "post",
        url: "/api/category/create",
        data: formData,
        processData: false, //if file uploaded
        contentType: false,
        success: function (response) {
            showToast("Category Succefully Added.", "primary", true);
            $("#offcanvasRight form.offcanvas-body .form-control").val("");
            offCanvas.hide();
        },
        error: (e) => {
            e = e.responseJSON;
            if (!errors) {
                toastError();
            }
            labelErrors(
                "#offcanvasRight form.offcanvas-body .form-control",
                e.errors
            );
        },
    });
});
// sub category add
$("#offCanAddSub .offcanvas-body button.btn").click(function (e) {
    e.preventDefault();
    var formData = new FormData($("#offCanAddSub form.offcanvas-body")[0]);
    $.ajax({
        type: "post",
        url: "/api/subCategory/create",
        data: formData,
        processData: false, //if file uploaded
        contentType: false,
        success: function (response) {
            showToast("Sub-Category Succefully Added.", "primary", true);
            addSub(response);
            $("#offCanAddSub form.offcanvas-body .form-control").val("");
            offCanvasAddSub.hide();
        },
        error: (e) => {
            e = e.responseJSON;
            if (!e.errors) {
                toastError();
            }
            labelErrors(
                "#offCanAddSub form.offcanvas-body .form-control",
                e.errors
            );
        },
    });
});

// category edit save
$("#offcanvasEdit .offcanvas-body button.btn").click(function (e) {
    e.preventDefault();
    var formData = new FormData($("#offcanvasEdit form.offcanvas-body")[0]);
    $.ajax({
        type: "post",
        url:
            "/api/category/update/" +
            $("#offcanvasEdit .offcanvas-body button.btn").attr("target"),
        data: formData,
        processData: false, //if file uploaded
        contentType: false,
        success: function (cat) {
            showToast("Category Succefully Updated.", "primary", true);
            $("#offcanvasEdit form.offcanvas-body .form-control").val("");
            updateCat(cat);
            offCanvasEdit.hide();
        },
        error: (e) => {
            e = e.responseJSON;
            if (!e.errors) {
                toastError();
            }
            labelErrors(
                "#offcanvasEdit form.offcanvas-body .form-control",
                e.errors
            );
        },
    });
});

// edit category canvas open
$(document).on("click", ".cat-con i.fa-pencil", function (e) {
    e.preventDefault();
    let target = getTarget(e.target);
    $("#offcanvasEdit input[name=name]").val(target.name);
    target.desc != "null"
        ? $("#offcanvasEdit textarea[name=description]").val(target.desc)
        : $("#offcanvasEdit textarea[name=description]").val("");
    $("#offcanvasEdit .offcanvas-body button.btn").attr("target", target.id);
    offCanvasEdit.show();
    console.log(target);
});
// sub category edit save
$("#offCanEditSub .offcanvas-body button.btn").click(function (e) {
    e.preventDefault();
    var formData = new FormData($("#offCanEditSub form.offcanvas-body")[0]);
    $.ajax({
        type: "post",
        url:
            "/api/subCategory/update/" +
            $("#offCanEditSub .offcanvas-body button.btn").attr("target"),
        data: formData,
        processData: false, //if file uploaded
        contentType: false,
        success: function (sub) {
            showToast("Category Succefully Updated.", "primary", true);
            $("#offCanEditSub form.offcanvas-body .form-control").val("");
            updateSub(sub);
            offCanvasEditSub.hide();
        },
        error: (e) => {
            e = e.responseJSON;
            if (!e.errors) {
                toastError();
            }
            labelErrors(
                "#offCanEditSub form.offcanvas-body .form-control",
                e.errors
            );
        },
    });
});

// edit sub category canvas open
$(document).on("click", "li i.fa-pencil", function (e) {
    e.preventDefault();
    let target = getTarget(e.target);
    $("#offCanEditSub input[name=name]").val(target.name);
    $("#offCanEditSub select").val(e.target.getAttribute("target-cat"));
    target.desc != "null"
        ? $("#offCanEditSub textarea[name=description]").val(target.desc)
        : $("#offCanEditSub textarea[name=description]").val("");
    $("#offCanEditSub .offcanvas-body button.btn").attr("target", target.id);
    offCanvasEditSub.show();
});
// add sub category canvas open
$(document).on("click", "i.fa-plus", function (e) {
    e.preventDefault();
    $("#offCanAddSub select").val(e.target.getAttribute("target"));
    offCanvasAddSub.show();
});

// delete sub/ category modal open
$(document).on("click", "i.fa-trash", function (e) {
    e.preventDefault();
    let target = getTarget(e.target);
    console.log(target);
    $("#modal1 .modal-title").text("Delete " + target.name);
    $("#modal1 .modal-body").text(
        `All product under this ${
            target.type == "category" ? "category" : "sub-category"
        } will be deleted permanently ?`
    );
    $("#modal1 .btn.btn-primary").attr("target-type", target.type);
    $("#modal1 .btn.btn-primary").attr("target", target.id);
    modal.show();
});
// click on del modal confirmation
$(document).on("click", "#modal1 .btn.btn-primary", function (e) {
    e.preventDefault();
    let id = e.target.getAttribute("target");
    let type = e.target.getAttribute("target-type");
    $.ajax({
        type: "delete",
        url: "/api/" + type + "/delete/" + id,
        success: function (res) {
            showToast(res.message, "primary", true);
            if (type == "category") {
                $("#cat" + id).remove();
            } else {
                $("#sub" + id).remove();
            }
            modal.hide();
        },
        error: (e) => {
            e = e.responseJSON;
            if (!e.message) {
                toastError();
            } else {
                showToast(e.message, "danger", true);
            }
            modal.hide();
        },
    });
});

// add sub cat canvas open
$(document).on("click", ".cat-con i.fa-pencil", function (e) {
    target = getTarget(e.target);
});
