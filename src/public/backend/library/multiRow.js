(function ($) {
    "use strict";
    let rd = {};

    rd.addRow = () => {
        $(document).on("click", "#import_detail-add-btn, #export_detail-add-btn", function (e) {
            e.preventDefault();
            inputIndex++;
            let riceOption = "";
            rice_data.forEach((val) => {
                riceOption += `<option value="${val.id}">${val.name}</option>\n`;
            });

            const html =
                "<tr>" +
                `<th data-title="#" class="table-index align-middle tw-50" scope="row">${
                    inputIndex + 1
                }</th>` +
                '<td data-title="Lúa" class="align-middle">' +
                `<select class="form-select use-select2" name="inputs[${inputIndex}][rice_id]">` +
                '<option value="0">Chọn lúa</option>' +
                riceOption +
                "</select>" +
                "</td>" +
                '<td data-title="Khối lượng (kg)" class="align-middle tw-50">' +
                '<div class="input-weight">' +
                '<button class="btn btn-primary input-dash"><i class="bi bi-dash"></i></button>' +
                `<input type="number" class="form-control border-0 shadow-none hide-spin" name="inputs[${inputIndex}][weight]" value="1">` +
                '<button class="btn btn-primary input-plus"><i class="bi bi-plus"></i></button>' +
                "</div>" +
                "</td>" +
                '<td data-title="Đơn giá" class="align-middle tw-50">' +
                '<div class="input-group">' +
                `<input name="inputs[${inputIndex}][price]" type="text"` +
                'class="form-control input-format input-price border-end-0 pe-0" value="0">' +
                '<span class="input-group-text bg-transparent border-start-0">₫</span>' +
                "</div>" +
                "</td>" +
                '<td class="table-action text-end align-middle tw-50">' +
                '<button class="import_detail-delete border-0 bg-transparent"><i class="bi bi-trash3 text-danger"></i></button>' +
                "</td>" +
                "</tr>";

            $(".table").find("tbody").append(html);

            $(`.use-select2[name^='inputs[${inputIndex}]']`).select2({
                theme: "bootstrap-5",
                width: $(this).data("width")
                    ? $(this).data("width")
                    : $(this).hasClass("w-100")
                    ? "100%"
                    : "style",
                dropdownParent: $("#import-form, #export-form"),
            });

            rd.totalPrice();
        });
    };

    rd.deleteRow = () => {
        $(document).on("click", ".import_detail-delete, .export_detail-delete", function (e) {
            e.preventDefault();
            if (inputIndex > 0) {
                inputIndex--;
                $(this).closest("tr").remove();
                rd.loadIndex();
                rd.totalPrice();
            }
        });
    };

    rd.loadIndex = () => {
        const detailList = $(".table tbody tr");
        detailList.each((index, val) => {
            $(val)
                .find("th")
                .text(index + 1);

            $(val)
                .find('select[name^="inputs"][name$="[rice_id]"]')
                .attr("name", `inputs[${index}][rice_id]`);

            $(val)
                .find('input[name^="inputs"][name$="[weight]"]')
                .attr("name", `inputs[${index}][weight]`);

            $(val)
                .find('input[name^="inputs"][name$="[price]"]')
                .attr("name", `inputs[${index}][price]`);
        });
    };

    rd.totalPrice = () => {
        let total = 0;
        const detailList = $(".table tbody tr");

        detailList.each((index, val) => {
            const weight = $(val).find(
                `input[name="inputs[${index}][weight]"]`
            );
            const weightVal = parseInt(weight.val()) || 0;

            const price = $(val).find(`input[name="inputs[${index}][price]"]`);
            const priceVal = parseInt(price.val().replace(/[^0-9]/g, "")) || 0;

            total += weightVal * priceVal;
        });

        $(".total-price .price").html(
            new Intl.NumberFormat("vi-VN").format(total)
        );
    };

    rd.weightInput = () => {
        $(document).on(
            "input",
            'input[name^="inputs"][name$="[weight]"]',
            function () {
                rd.totalPrice();
            }
        )
    };

    rd.priceInput = () => {
        $(document).on(
            "input",
            'input[name^="inputs"][name$="[price]"]',
            function () {
                rd.totalPrice();
            }
        );
    };

    $(document).ready(function () {
        rd.addRow();
        rd.deleteRow();
        rd.weightInput();
        rd.priceInput();
    });
})(jQuery);
