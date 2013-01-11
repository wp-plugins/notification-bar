(function ($) {
    $.fn.notifybar = function (options) {
        var defaults = {
            "staytime": "6000"
        };
        var options = $.extend(defaults, options);
        return this.each(function () {
            var opts = options;
            obj = $(this);
            objDwn = $(obj.find(".nbar_downArr").attr("href"));
            objPush = $(".notifybar_push");
            var stayTimer;

			function clearAll(){
			    clearTimeout(stayTimer);
			}
			
            function staytime() {
				objPush.css("height",41).show();
                stayTimer = setTimeout(function () {
                    obj.slideUp("fast");
                    objDwn.slideDown();
                    pullObj();
                }, opts.staytime)
            }
			staytime();
            function pushObj() {
                var obj_pushHt = 1;
                objPush.css("height", obj_pushHt + 40);
                objPush.slideDown("fast")
            }
            function pullObj() {
                objPush.css("height", "");
                objPush.slideUp("fast")
            }
            obj.find("a.notifybar_close").click(function () {
                clearAll();
                obj.slideUp("fast");
                objDwn.slideDown();
                pullObj()
            });
            objDwn.click(function () {
                $(this).hide();
				clearAll();
                obj.slideDown("fast");
                pushObj();
            })
        })
    }
})(jQuery);