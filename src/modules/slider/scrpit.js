jQuery(document).ready(function ($) {

    $(".grid").on("click", "a.add_buy_option", function (event) {
        event.preventDefault();
        var i = +$("input[name=counter]").val(),
            $i = i + 1,
            html = "<div class=\"col-1-3\"><h4>Slide Option " + $i + "</h4><p><label>title</label><input type=\"text\"  name=\"title_" + $i + "\" value=\"\"></p><p><label>description</label><input type=\"text\" step=\"any\" name=\"description_" + $i + "\" value=\"\"></p><p><label>slide image</label><input type=\"text\" step=\"any\" name=\"slide_image_" + $i + "\" value=\"\"><button class=\"image-button\"></button></p><p><a href=\"#\" class=\"delete_buy_option\">Delete Buy Option</a></p></div><!-- /col-1-3 -->";
        $("input[name=counter]").val($i);
        $(this).closest(".grid").prevAll(".grid").first().append(html);
        return false;
    });

    $(".grid").on("click", ".delete_buy_option", function (event) {
        event.preventDefault();
        var countEl = $("input[name=counter]");
        var itemCount = +countEl.val() - 1;
        $(this).closest(".col-1-3").find("p > input").each(function () {
            $(this).attr("value", "");
            $(this).closest(".col-1-3").fadeOut();
        });
        countEl.val(itemCount);
        var el = $(this).closest(".col-1-3").siblings(".col-1-3");
        function changeH4() {
            $(el[i]).find("h4").each(function () {
                var h4Text = $(this).text(),
                    newH4Text = h4Text.replace(/\d$/gi, (i + 1));
                $(this).text(newH4Text);
            });
        }

        function changeInpName() {
            $(el[i]).find("input").each(function () {
                var inpName = $(this).attr("name");
                var newName = inpName.replace(/_\d$/gi, "_" + (i + 1));
                $(this).attr("name", newName);
            });
        }
        for (var i = 0; i < el.length; i++) {
            changeH4();
            changeInpName();
        }
    });

    /**
     *
     * This is for image upload funcitonality
     *
     **/

     var meta_image_frame;
    $("#product_meta").on("click", ".image-button", function (e) {
       e.preventDefault();
        img = $(e.target) || '';
        if (meta_image_frame) {
            meta_image_frame.open();
            return;
        }
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: meta_image.title,
            button: {
                text: meta_image.button
            },
            library: {
                type: 'image'
            }
        });
        meta_image_frame.on('select', function() {
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
            img.prev().val(media_attachment.url);
        });
        meta_image_frame.open();
        
    });

});
