(function ($) {
    "use strict";
    var lib = {};
    var uiProjects = [];

    /****************************
     * Begin: SELECT 2
     *****************************/

    lib.select2 = () => {
        if ($(".use-select2").length) {
            $(".use-select2").select2({
                theme: "bootstrap-5",
                width: $(this).data("width")
                    ? $(this).data("width")
                    : $(this).hasClass("w-100")
                    ? "100%"
                    : "style",
            });
        }
    };

    lib.modalSelect2 = () => {
        $(document).on("shown.bs.modal", ".modal", function () {
            if ($(this).find(".modal-use-select2").length) {
                const modal = "#" + $(this).attr("id");
                $(this)
                    .find(".modal-use-select2")
                    .select2({
                        theme: "bootstrap-5",
                        width: $(this).data("width")
                            ? $(this).data("width")
                            : $(this).hasClass("w-100")
                            ? "100%"
                            : "style",
                        dropdownParent: $(modal + " .modal-content"),
                    });
            }
        });
    };

    lib.select2Main = () => {
        lib.select2();
        lib.modalSelect2();
    };

    /****************************
     * DROP IMAGE
     *****************************/

    lib.chooseImage = () => {
        $(document).on("input", ".input-image", function (e) {
            lib.uploadImage(e.target.files[0]);
        });
    };

    lib.dropImage = () => {
        $(document).on("dragover", ".drop-image", function (e) {
            e.preventDefault();
        });

        $(document).on("drop", ".drop-image", function (e) {
            e.preventDefault();
            const image = e.originalEvent.dataTransfer.files[0];
            const inputFile = $(document).find(".drop-image .input-image")[0];
            const dataTransfer = new DataTransfer();

            if (image) {
                dataTransfer.items.add(image);
                lib.uploadImage(image);
                inputFile.files = dataTransfer.files;
            }
        });
    };

    lib.uploadImage = (file) => {
        var imageView = $(document).find(".image-view");

        if (file != null) {
            let imageURL = URL.createObjectURL(file);
            imageView.css("backgroundImage", `url(${imageURL})`);
            imageView.addClass("has-image");
        }
    };

    lib.dropImageMain = () => {
        lib.chooseImage();
        lib.dropImage();
    };

    /****************************
     * MAPBOX
     *****************************/

    let map = null;
    const markers = [];

    lib.setup = () => {
        mapboxgl.accessToken =
            "pk.eyJ1IjoidGhvbWFzZGFuZzE4MTIwMDMiLCJhIjoiY20xNGFoM2RrMWp1NTJvcjN1NG85eXppaSJ9.6wDcBNlpyKQnQqOvb5AUxA";
        map = new mapboxgl.Map({
            container: "map", // container ID
            style: "mapbox://styles/mapbox/streets-v12",
            center: [105.14434709756426, 9.914565453807697],
            zoom: 14,
        });

        map.addControl(new mapboxgl.NavigationControl(), "bottom-right");

        map.addControl(
            new mapboxgl.GeolocateControl({
                positionOptions: {
                    enableHighAccuracy: true,
                },
                trackUserLocation: true,
            }),
            "bottom-right"
        );

        map.on("load", () => {
            map.setFog({});
        });
    };

    lib.load = (marker) => {
        $.ajax({
            url: "ajax/map/getMarker",
            dataType: "json",
            success: function (res) {
                res.data.forEach(function (val, index) {
                    const popup = new mapboxgl.Popup({
                        closeButton: false,
                    }).setHTML(res.popupList[index]);
                    const marker = new mapboxgl.Marker()
                        .setPopup(popup)
                        .setLngLat([val.longitude, val.latitude])
                        .addTo(map);

                    markers[val.id] = marker;

                    uiProjects.push({
                        index: index,
                        id: val.id,
                        value: val.longitude + "," + val.latitude,
                        label: val.name,
                        desc: val.address,
                    });
                });
            },

            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    };

    lib.getLocation = (marker) => {
        $(document).on("click", "#warehouse-list > li", function () {
            const coordinates = $(this).data("coordinates").split(",");
            const warehouseId = $(this).data("id");
            map.flyTo({
                center: [coordinates[0], coordinates[1]],
                zoom: 14,
                essential: true,
            });

            $(markers[warehouseId].getElement()).trigger("click");
            $("#sidebar-start").offcanvas("hide");
        });
    };

    lib.point = (marker) => {
        map.on("click", function (e) {
            var coordinates = e.lngLat;

            marker.setLngLat([coordinates.lng, coordinates.lat]).addTo(map);

            $(document).find("#warehouse-longitude").val(coordinates.lng);
            $(document).find("#warehouse-latitude").val(coordinates.lat);
        });

        $(document).on("input", "#warehouse-longitude", function () {
            var longitude = $(this).val();
            var latitude = $(document).find("#warehouse-latitude").val();

            if (longitude && latitude) {
                marker.setLngLat([longitude, latitude]).addTo(map);
            }
        });

        $(document).on("input", "#warehouse-latitude", function () {
            var longitude = $(document).find("#warehouse-longitude").val();
            var latitude = $(this).val();

            if (longitude && latitude) {
                marker.setLngLat([longitude, latitude]).addTo(map);
            }
        });
    };

    lib.loadPoint = (marker) => {
        var longitude = $(document).find("#warehouse-longitude").val();
        var latitude = $(document).find("#warehouse-latitude").val();
        if (longitude != "" && latitude != "") {
            marker.setLngLat([longitude, latitude]).addTo(map);
            map.setCenter([longitude, latitude]);
        }
    };

    lib.locationDetail = () => {
        $(document).on("click", ".warehouse-info-btn", function () {
            const id = $(this).data("id");
            $("#sidebar-start").empty();
            $.ajax({
                url: "ajax/map/statistical/" + id,
                type: "GET",
                success: function (res) {
                    const sidebarStart = $(document).find("#sidebar-start");
                    sidebarStart.html(res);

                    $("#sidebar-start").offcanvas("show");
                    lib.inputDate(id);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });
        });
    };

    lib.inputDate = (id) => {
        $(document).on("input", "#date-from", function () {
            const from = $(this).val();
            const to = $(document).find("#date-to").val();
            $.ajax({
                url: "ajax/map/statistical/" + id,
                type: "GET",
                data: {
                    from: from,
                    to: to,
                },
                success: function (res) {
                    const sidebarStart = $(document).find("#sidebar-start");
                    sidebarStart
                        .find(".statistical-content")
                        .html($(res).find(".statistical-content").html());
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });
        });

        $(document).on("input", "#date-to", function () {
            const from = $(document).find("#date-from").val();
            const to = $(this).val();
            $.ajax({
                url: "ajax/map/statistical/" + id,
                type: "GET",
                data: {
                    from: from,
                    to: to,
                },
                success: function (res) {
                    const sidebarStart = $(document).find("#sidebar-start");
                    sidebarStart
                        .find(".statistical-content")
                        .html($(res).find(".statistical-content").html());
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });
        });
    };

    lib.mapboxInit = () => {
        if ($(document).find("#map").length) {
            let marker = new mapboxgl.Marker();
            lib.setup();
            if (!$("#map").hasClass("map-form")) {
                lib.load(marker);
                lib.getLocation(marker);
                lib.locationDetail();
            } else {
                lib.point(marker);
                lib.loadPoint(marker);
            }
        }
    };

    /****************************
     * jQuery UI
     *****************************/

    lib.uiSetup = () => {
        const searchInput = $(document).find("#dashboard-search");
        searchInput
            .autocomplete({
                minLength: 0,
                source: function (request, response) {
                    const filteredProjects = uiProjects.filter(function (item) {
                        return item.label
                            .toLowerCase()
                            .includes(request.term.toLowerCase());
                    });

                    response(filteredProjects.slice(0, 5));
                    lib.inputSearch(uiProjects);
                },

                focus: function (event, ui) {
                    searchInput.val(ui.item.label);
                    return false;
                },

                select: function (event, ui) {
                    searchInput.val(ui.item.label);
                    const coordinates = ui.item.value.split(",");

                    map.flyTo({
                        center: [coordinates[0], coordinates[1]],
                        zoom: 14,
                        essential: true,
                    });
                    $(markers[ui.item.id].getElement()).trigger("click");
                    return false;
                },
            })
            .autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                .append(
                    `<div class="text-secondary text-truncate py-3">
                            <i class="bi bi-geo-alt mx-2"></i>
                            ${item.label} - <span>${item.desc}</span>
                        </div>`
                )
                .appendTo(ul);
        };
    };

    lib.inputSearch = (project) => {
        $(document).on("keydown", "#dashboard-search", function (e) {
            if (e.keyCode === 13) {
                let result = project.filter((item) => {
                    return item.label
                        .toLowerCase()
                        .includes($(this).val().toLowerCase());
                });

                if (result.length === 1) {
                    const coordinates = result[0].value.split(",");
                    $(this).val(result[0].label);

                    map.flyTo({
                        center: [coordinates[0], coordinates[1]],
                        zoom: 14,
                        essential: true,
                    });

                    $(markers[result[0].id].getElement()).trigger("click");
                    $(this).autocomplete("close");
                } else if (result.length > 1) {
                    $.ajax({
                        url: "ajax/map/search",
                        type: "GET",
                        data: { name: $(this).val() },
                        success: function (res) {
                            const sidebarStart =
                                $(document).find("#sidebar-start");
                            sidebarStart.html(res);
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                        },
                    });
                    $(this).autocomplete("close");
                    $("#sidebar-start").offcanvas("show");
                }

                result = null;
                return false;
            }
        });
    };

    lib.warehouseInfo = (id) => {
        $.ajax({
            url: "warehouse/info/" + id,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                const sidebarStart = $(document).find("#sidebar-start");
                sidebarStart.html(res);
            },

            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
        $("#sidebar-start").offcanvas("show");
    };

    lib.getList = () => {
        $(document).on("click", "#warehouse-list-btn", function () {
            const sidebarStart = $(document).find("#sidebar-start");
            $.ajax({
                url: "ajax/map/search",
                type: "GET",
                success: function (response) {
                    sidebarStart.html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });
        });
    };

    lib.uiMain = () => {
        if ($(document).find("#dashboard-search").length) {
            lib.uiSetup();
            lib.getList();
        }
    };

    lib.sidebarStart = () => {
        $(document).on("hidden.bs.offcanvas", "#sidebar-start", function () {
            $("#warehouse-list-btn").html('<i class="bi bi-bookmark"></i>');
        });

        $(document).on("shown.bs.offcanvas", "#sidebar-start", function () {
            $("#warehouse-list-btn").html('<i class="bi bi-x-lg"></i>');
        });
    };

    /****************************
     * format money
     *****************************/

    lib.formatInit = () => {
        $(document).on("input", ".input-format", function (evt) {
            const charCode = evt.which ? evt.which : evt.keyCode;
            if (charCode != 8 && (charCode < 48 || charCode > 57)) {
                evt.preventDefault();
            } else {
                const value = $(this)
                    .val()
                    .replace(/[^0-9]/g, "");

                $(this).val(new Intl.NumberFormat("vi-VN").format(value));
            }
        });
    };

    /****************************
     * search
     *****************************/

    lib.search = () => {
        $(document).on("input", "#search", function (e) {
            let search = $(this).val();
            const url = $(this).data("url");
            let data = {};

            data["search"] = search;
            let filter = $(document).find(".filter-item");
            filter.each((index, element) => {
                const title = $(element).data("name");
                const value = $(element).val();
                data[title] = value;
            });

            $.ajax({
                url: url,
                method: "GET",
                data: data,
                success: function (res) {
                    var content = $(res).find(".card-content").html();
                    $(document).find(".card-content").html(content);
                },
            });
        });
    };

    lib.filter = () => {
        $(document).on("change", ".filter-item", function (e) {
            let search = $(document).find("#search").val();
            const url = $(this).data("url");
            let data = {};

            data["search"] = search;
            let filter = $(document).find(".filter-item");
            filter.each((index, element) => {
                const title = $(element).data("name");
                const value = $(element).val();
                data[title] = value;
            });

            $.ajax({
                url: url,
                method: "GET",
                data: data,
                success: function (res) {
                    var content = $(res).find(".card-content").html();
                    $(document).find(".card-content").html(content);
                },
            });
        });
    };

    lib.paginate = () => {
        $(document).on("click", ".page-link", function (e) {
            e.preventDefault();
            const url = $(this).attr("href");
            const search = $(document).find("#search").val();

            $.ajax({
                url: url,
                type: "GET",
                data: { search: search },
                success: function (res) {
                    var content = $(res).find(".card-content").html();
                    $(document).find(".card-content").html(content);
                    $(window).scrollTop(0);
                },

                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });
        });
    };

    /****************************
     * quantity
     *****************************/

    lib.weight = () => {
        if ($(document).find(".input-weight").length) {
            $(document).on(
                "click",
                ".input-weight > .input-dash",
                function (e) {
                    e.preventDefault();
                    const input = $(this).siblings("input");
                    let val = Number(input.val()) || 0;

                    if (val > 0) {
                        input.val(--val);
                        lib.totalPrice();
                    }
                }
            );

            $(document).on(
                "click",
                ".input-weight > .input-plus",
                function (e) {
                    e.preventDefault();
                    const input = $(this).siblings("input");
                    let val = Number(input.val()) || 0;
                    input.val(++val);
                    lib.totalPrice();
                }
            );
        }
    };

    lib.totalPrice = () => {
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

    $(document).ready(function () {
        lib.select2Main();
        lib.dropImageMain();
        lib.mapboxInit();
        lib.uiMain();
        lib.sidebarStart();
        lib.formatInit();
        lib.search();
        lib.filter();
        lib.paginate();
        lib.weight();
    });
})(jQuery);
