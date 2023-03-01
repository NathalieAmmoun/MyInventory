$("#addProductTypeModal").on("shown.bs.modal", function () {
    console.log("add Product");
});
$("#deleteModal").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);

    //Button that triggered the modal
    var recipient = button.data("id");
    var item = document.getElementById("deleteId");
    item.setAttribute("value", recipient);

    var durl = button.data("url");
    var item2 = document.getElementById("formSection");
    item2.setAttribute("action", durl);
});

$("#updateProductTypeModal").on("show.bs.modal", function (event) {
    const button = $(event.relatedTarget);

    const id = button.data("id");
    $("#productTypeId").val(id);

    const name = button.data("name");
    $("#productName").val(name);
    const desc = button.data("description");
    $("#productDesc").val(desc);

    const url = button.data("url");
    const item = document.getElementById("updateProductTypeForm");
    item.setAttribute("action", url);
});

$("#updateProductItemModal").on("show.bs.modal", function (event) {
    const button = $(event.relatedTarget);

    const serialNumber = button.data("number");
    $("#serialNumber").val(serialNumber);
    const url = button.data("url");
    const item = document.getElementById("updateProductItemForm");
    item.setAttribute("action", url);
});

function inputItemsNumber(id) {
    itemsNumber = $("#productItemNumber").val();

    let items = "";
    for (let i = 0; i < itemsNumber; i++) {
        items += ` <div class="form-group">
      <label for="itemSerialNumber">Serial Number ${i + 1}</label>
      <input type="text" class="form-control" id="itemSerialNumber"
          name="serial_number[]" placeholder="ABC123">
      </div>`;
    }

    let form = `
      
      <div class="modal-body">
      ${items}
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary"
          data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
    `;
    const url = "/dashboard/product-items/" + id + "/add";
    const item = document.getElementById("addItemsForm");
    item.setAttribute("action", url);
    $("#addItems").remove();
    $("#addItemsForm").append(form);
    $("#addItemsForm").show();
}

function toggleSold(id) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "get",
        url: "/dashboard/product-items/is-sold/" + id,

        success: function (data) {
            console.log(data);
        },
    });
}
$().ready(function () {
    $(".clickable-row").click(function () {
        window.location = $(this).data("href");
    });
});
