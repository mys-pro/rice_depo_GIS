(function ($) {
    "use strict";
    let wh = {};

    wh.avatar = () => {
        $(document).on("input", "#user-image", function (e) {
            const file = e.target.files[0];
            if (file != null) {
                let imageURL = URL.createObjectURL(file);
                $(".user-avatar img").attr("src", imageURL);
            }
        });
    };

    $(document).ready(function() {
        wh.avatar();
    });
    
})(jQuery);
