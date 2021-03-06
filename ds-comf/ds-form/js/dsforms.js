function compareVersionjQuery(e) {
    var o = e.split(".", 2),
        n = gKweri.fn.jquery.split(".", 2);
    return parseInt(n[0]) > parseInt(o[0]) || parseInt(n[0]) == parseInt(o[0]) && parseInt(n[1]) >= parseInt(o[1])
}
dsformROOT = "/ds-comf/ds-form/", !window.gKweri && window.jQuery && (window.gKweri = window.jQuery), window.gKweri && compareVersionjQuery("1.5") ? function(window, document, $, undefined) {
    "use strict";
    var W = $(window),
        listCountries = $.masksSort($.masksLoad("https://www.diada-arms.ru/js/data/phone-codes.json"), ["#"], /[0-9]|#/, "mask"),
        maskOpts = {
            inputmask: {
                definitions: {
                    "#": {
                        validator: "[0-9]",
                        cardinality: 1
                    }
                },
                showMaskOnHover: !1,
                autoUnmask: !1,
                clearMaskOnLostFocus: !1
            },
            match: /[0-9]/,
            replace: "#",
            listKey: "mask"
        },
        maskChangeWorld = function(e, o) {
            if (o) {
                e.name_ru;
                e.desc_ru && "" != e.desc_ru && " (" + e.desc_ru + ")"
            }
            $(this).attr("placeholder", $(this).inputmask("getemptymask"))
        },
        D = $(document),
        version = "4.1.0",
        root = dsformROOT,
        lib = dsformROOT + "js/plugins/",
        F, gData = window.dsformglobaldata = {},
        Modals = window.dsformglobaldata.buttonindexes = {},
        usings = "External included scripts: \n                    Input Mask: https://github.com/RobinHerbots/jquery.inputmask \n                    jQuery Form Styler: http://dimox.name/jquery-form-styler/ \n                    popDate: https://github.com/jokernakartama/popdate",
        pseudoRandom = function() {
            var e = new Date;
            return String(Math.abs(e.getMilliseconds() - (Math.floor(998 * Math.random()) + 1))) + String(Math.floor(998 * Math.random()) + 1)
        },
        F = function(o, options) {
            var self = this,
                _id = "",
                _modal, _formLoaded = !1,
                _visible, _bi = pseudoRandom() + pseudoRandom(),
                _o = o && o.hasOwnProperty && o instanceof $ ? o : $(o);
            self.options = {}, self.container = {}, self.form = {}, self.report = undefined, self.config = undefined, self.sended = !1, self.element = _o;
            var defaults = {
                    formID: undefined,
                    modal: !0,
                    additionalClass: undefined,
                    config: "",
                    inputmask: {},
                    dates: {},
                    showLoader: !0,
                    useFormStyler: !1,
                    reload: !0,
                    stackErrors: !0,
                    clearErrors: !1,
                    onLoad: undefined,
                    onShow: undefined,
                    onSuccess: undefined,
                    onFail: undefined,
                    onClose: undefined,
                    onServerError: undefined,
                    onInit: undefined,
                    animationspeed: 300,
                    closeonbackgroundclick: !0,
                    formstyler: {}
                },
                __init__ = function() {
                    _o.get(0).dsformmarker = !0, self.options = $.extend({}, defaults, options), _id = self.options.formID, _modal = self.options.modal, self.config = self.options.config, "function" == typeof onInit && self.options.onInit.call(self, $), !compareVersionjQuery("1.7") && self.options.useFormStyler && (self.options.useFormStyler = !1, console.warn("DSFORM(#" + _id + "): Form Styler uses version jQuery 1.7.1 and higher. ")), self.options.useFormStyler && self.run(lib + "formstyler.js", function() {
                        $(null).styler(null)
                    }, "formstyler"), _modal ? ($('*[data-dsform-id="' + _id + '"]').get().length > 0 ? self.container = $('*[data-dsform-id="' + _id + '"]') : (self.container = $('<div class="ds-form dspopup-modal ' + _id + '"><div/>').appendTo("body"), self.container.attr("data-dsform-id", _id)), _o.bind("click", function(e) {
                        e.preventDefault(), self.config = $(this).attr("data-dsconfig") || self.config, (_bi != Modals[_id] || self.sended && self.options.reload) && (Modals[_id] = _bi, self.getForm()), _formLoaded && __align__(), __reveal__(), self.options.additionalClass && self.container.addClass(self.options.additionalClass)
                    })) : (self.container = _o, self.options.additionalClass && self.container.addClass(self.options.additionalClass), self.container.addClass("ds-form"), self.config = _o.attr("data-dsconfig") || self.config, self.getForm())
                },
                __align__ = function() {
                    self.container.children().is(".scrollform") && (self.form.appendTo(self.container), self.container.find(".scrollform").remove(), self.container.css({
                        height: "auto"
                    }));
                    var e = 0;
                    self.container.css({
                        height: "",
                        width: ""
                    });
                    var o = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth,
                        n = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
                    window.innerWidth && document.documentElement.clientWidth && (e = window.innerWidth - document.documentElement.clientWidth), o < self.container.innerWidth() + 20 && self.container.width(+o - e - 20 - (self.container.innerWidth() - self.container.width()));
                    var s = self.container.innerWidth(),
                        t = self.container.outerHeight(!0),
                        r = Math.round((o - s - e) / 2);
                    if (n <= t + 20) {
                        var i = 20,
                            a = t - self.container.height();
                        self.container.append('<div class="scrollform"></div>'), self.form.appendTo(self.container.find(".scrollform")), t = n - 2 * i, self.container.find(".scrollform").height(t - a - 15), self.container.find(".scrollform").css({
                            "overflow-y": "scroll",
                            margin: "15px 0"
                        })
                    } else i = Math.round((n - t) / 2);
                    self.container.css({
                        top: i + "px",
                        left: r + "px"
                    })
                },
                __send__ = function() {
                    if (self.options.showLoader) {
                        var e, o = self.container.find('input[type="submit"]').outerHeight(!0),
                            n = 0; + o > 32 && (n = (+o - 32) / 2, o = 32), e = (+self.container.find('input[type="submit"]').outerWidth(!0) - +o) / 2, n += "px", e += "px", $("img.loadform").siblings('input[type="submit"]').toggle(), self.form.find('input[type="submit"]').hide(), $("img.loadform").appendTo(self.container.find('input[type="submit"]').parent()).css({
                            height: o,
                            width: o,
                            margin: n + " " + e,
                            display: "inline",
                            verticalAlign: "middle"
                        })
                    }
                    if (window.FormData) {
                        var s = new FormData(self.form.get(0));
                        s.append("formid", _id), s.append("route", "DSFormSend"), $.ajax({
                            url: root + "index.php",
                            type: "POST",
                            contentType: !1,
                            processData: !1,
                            data: s,
                            dataType: "json",
                            success: function(e) {
                                __result__(e)
                            }
                        })
                    } else {
                        var t = self.form.serialize();
                        t = t + "&formid=" + _id + "&route=DSFormSend", $.ajax({
                            type: "POST",
                            url: root + "index.php",
                            dataType: "json",
                            cache: !1,
                            data: t,
                            success: function(e) {
                                __result__(e)
                            }
                        })
                    }
                    return !1
                },
                __help__ = function() {
                    if (self.form.find("input[data-dsform-date]").each(function() {
                            var e = $(this),
                                o = e.attr("data-dsform-date");
                            self.options.dates[e.attr("name")] || (self.options.dates[e.attr("name")] = {}), self.options.dates[e.attr("name")].format || (self.options.dates[e.attr("name")].format = o)
                        }), self.form.find("input[data-dsform-mask]").each(function() {
                            var e = $(this),
                                o = e.attr("data-dsform-mask");
                            self.options.inputmask[e.attr("name")] || (self.options.inputmask[e.attr("name")] = {}), self.options.inputmask[e.attr("name")].mask || (self.options.inputmask[e.attr("name")].mask = o)
                        }), function() {
                            for (var e in self.options.dates)
                                if (e) {
                                    var o = self.form.find('input[name="' + e + '"]'),
                                        n = "object" == typeof self.options.dates[e] ? self.options.dates[e] : {};
                                    n.format = n.format ? n.format : o.attr("data-dsform-date"), self.run(lib + "dscalendar.js", function() {
                                        dscalendar(o.get(0), n)
                                    }, "dscalendar")
                                }
                        }(), function() {
                            for (var e in self.options.inputmask)
                                if (e) {
                                    var o = self.form.find('input[name="' + e + '"]'),
                                        n = "object" == typeof self.options.inputmask[e] ? self.options.inputmask[e] : {};
                                    n.mask = n.mask ? n.mask : o.attr("data-dsform-mask"), o.inputmask("remove"), o.inputmasks($.extend(!0, {}, maskOpts, {
                                        list: listCountries,
                                        onMaskChange: maskChangeWorld
                                    }))
                                }
                        }(), !1 !== self.options.useFormStyler) {
                        var e = "string" == typeof self.options.useFormStyler ? self.options.useFormStyler : "select, input";
                        self.run(lib + "formstyler.js", function() {
                            self.form.find(e).styler(self.options.formstyler)
                        }, "formstyler")
                    }
                },
                __validate__ = function() {
                    self.form.find("input, textarea").bind("keyup", function() {
                        var e = $(this);
                        e.attr("pattern") && !e.val().match(e.attr("pattern")) ? (e.addClass("improper-value"), self.options.stackErrors || e.siblings(".dsform-field-error.named_as_" + e.attr("name")).removeClass("hint-proper")) : e.attr("pattern") && e.hasClass("improper-value") && (e.removeClass("improper-value"), self.options.stackErrors || e.siblings(".dsform-field-error.named_as_" + e.attr("name")).addClass("hint-proper")), !e.attr("pattern") && e.hasClass("improper-value") && (e.removeClass("improper-value"), self.options.stackErrors || e.siblings(".dsform-field-error.named_as_" + e.attr("name")).addClass("hint-proper"))
                    })
                },
                __construct__ = function(e) {
                    var o = "",
                        n = JSON.parse(e);
                    0 == n.error ? o = n.error_text : 3 == n.error && console.error(n.error_text), self.container.find("form").get().length > 0 && self.container.find("form").remove(), self.container.find("#" + _id + "formmessagereport").remove(), self.container.append(o), self.form = self.container.find("form"), !_formLoaded && _modal && (_formLoaded = !0, $(".dspopup-modal-bg .loadform").hide()), self.form && self.form.length > 0 && (__help__(), __validate__(), self.form.bind("submit", __send__), __refocus__()), window.FormData || self.container.find(' *[type="file"]').css("display", "none"), "function" == typeof self.options.onLoad && self.options.onLoad.call(self, $), self.container.hasClass("dspopup-modal") && _modal ? __align__() : self.container.find("*[autofocus]").focus()
                    if (typeof (grecaptcha) != "undefined") 
                    {
                        var sitekey = self.container.find('.g-recaptcha').data('sitekey');
                        var captchaId = self.container.find('.g-recaptcha').attr('id');
                        var element = document.getElementById(captchaId);

                        if(element != undefined && element.childNodes.length == 0) 
                        {
                        	try{
                        		grecaptcha.render(element, {
									'sitekey': sitekey
								});
                        	}catch(e){
                        		console.log(e);
                        	}
                        }
                     }
                },
                __result__ = function(e) {
                    if (self.options.showLoader && (self.container.find("img.loadform").hide(), self.container.find('input[type="submit"]').show()), delete e.formid, 1 == e.error) {
                        delete e.error, console.log(self.options.stackErrors), self.options.stackErrors ? self.container.find(".error_form").empty() : self.container.find(".dsform-field-error").remove();
                        var o = [];
                        if ($.each(e, function(e, n) {
                            e == 'g-recaptcha-response' &&     
                            -1 == $.inArray(n, o) && 1 != n && o.push(n), self.container.find('*[name="' + e + '"]').addClass("improper-value"), self.options.stackErrors || $('<span class="dsform-field-error named_as_' + e + '"><span>' + n + "</span></span>").appendTo(self.form.find('[name="' + e + '"]').parent())
                            }), self.container.find("*[required]").each(function() {
                                var o = $(this);
                                o.hasClass("improper-value") && !e[o.attr("name")] && o.removeClass("improper-value")
                            }), self.options.stackErrors) {
                            var n = '<ul class="error-form">\n';
                            $.each(o, function(e, o) {
                                n += "<li>" + o + "</li>\n"
                            }), n += "</ul>\n", self.container.find(".error_form").append(n)
                        }
                        "function" == typeof self.options.onFail && self.options.onFail.call(self, $), _modal ? __align__() : self.container.css("height", "auto")
                    } else 0 != e.error && 2 != e.error || (self.form.remove(), self.container.find(".scrollform").remove(), self.container.find(".scrollform").css("height", "auto"), self.container.css("height", "auto"), self.report = document.createElement("div"), self.report.id = _id + "formmessagereport", self.report.className = "report-message", self.report = $(self.report), self.report.append(e.error_text), self.container.append(self.report), self.report.find(".repeatform").bind("click", function(e) {
                        e.preventDefault(), $(this).unbind("click"), self.report.remove(), self.getForm()
                    }), 0 == e.error && (self.sended = !0), 0 == e.error && "function" == typeof self.options.onSuccess && self.options.onSuccess.call(self, $), 2 == e.error && "function" == typeof self.options.onServerError && self.options.onServerError.call(self, $), (self.container.hasClass("dspopup-modal") || _modal) && __align__())
                },
                __refocus__ = function() {
                    self.form.find("input, textarea, select").bind("focusin", function() {
                        self.form.find('input[type="text"], textarea, select').each(function() {
                            $(this).removeClass("focusout")
                        })
                    }), self.form.find('input[type="text"]:not(input[readonly]),textarea:not(textarea[readonly]), select').bind("focusout", function() {
                        $(this).addClass("focusout")
                    })
                },
                __reveal__ = function() {
                    var e = self.container,
                        o = !1,
                        n = $(".dspopup-modal-bg");
                    if (0 == n.length && (n = $('<div class="dspopup-modal-bg"></div>').insertAfter(e)), !_formLoaded) {
                        var s = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
                        $("img.loadform").appendTo(".dspopup-modal-bg").css({
                            height: "64px",
                            width: "64px",
                            margin: +s / 2 - 32 + "px auto auto",
                            display: "block"
                        })
                    }
                    e.bind("dspopup:open", function() {
                        n.unbind("click.modalEvent"), $(".close-dspopup-modal").unbind("click.modalEvent"), o || (r(), e.append('<div class="close-dspopup-modal dsclose-button"></div>'), e.css({
                            opacity: 0,
                            visibility: "visible",
                            display: "block"
                        }), e.addClass("active-dspopup"), n.fadeIn(self.options.animationspeed / 2), e.delay(self.options.animationspeed / 2).animate({
                            opacity: 1
                        }, self.options.animationspeed, function() {
                            _visible = !0, self.container.find("*[autofocus]").focus(), "function" == typeof self.options.onShow && self.options.onShow.call(self, $), t()
                        })), e.unbind("dspopup:open")
                    }), e.bind("dspopup:close", function() {
                        o || (r(), $(".close-dspopup-modal").remove(), e.removeClass("active-dspopup"), n.delay(self.options.animationspeed).fadeOut(self.options.animationspeed), e.animate({
                            opacity: 0
                        }, self.options.animationspeed, function() {
                            _visible = !1, e.css({
                                opacity: 1,
                                visibility: "hidden",
                                display: "none"
                            }), self.options.additionalClass && self.container.removeClass(self.options.additionalClass), "function" == typeof self.options.onClose && self.options.onClose.call(self, $), t(), self.options.clearErrors && (self.form.find(".error-form, .dsform-field-error").remove(), self.form.find("input.improper-value, textarea.improper-value").removeClass("improper-value"))
                        })), e.unbind("dspopup:close")
                    }), e.trigger("dspopup:open");
                    $(".close-dspopup-modal").bind("click.modalEvent", function() {
                        e.trigger("dspopup:close")
                    });

                    function t() {
                        o = !1
                    }

                    function r() {
                        o = !0
                    }
                    self.options.closeonbackgroundclick && (n.css({
                        cursor: "pointer"
                    }), n.bind("click.modalEvent", function() {
                        e.trigger("dspopup:close")
                    })), $("body").keyup(function(o) {
                        27 === o.which && e.trigger("dspopup:close")
                    })
                },
                __path__ = function(e, o) {
                    if (void 0 === o && (o = ""), e.is("html")) return "html" + o;
                    var n = e.get(0).nodeName.toLowerCase(),
                        s = e.attr("id"),
                        t = e.attr("class");
                    return void 0 !== s && (n += "#" + s), void 0 !== t && (n += "." + t.split(/[\s\n]+/).join(".")), __path__(e.parent(), " > " + n + o)
                };
            return self.open = function() {
                _modal && self.element.trigger("click")
            }, self.close = function() {
                _modal && self.container.trigger("dspopup:close")
            }, self.getPath = function(e) {
                return e || (e = self.element), __path__(e)
            }, self.run = function(e, o, n) {
                try {
                    o.apply(this, arguments), gData[n] || console.info("DSFORM: " + n + " was loaded before")
                } catch (t) {
                    if (!gData[n]) {
                        var s = document.createElement("script");
                        s.src = e, document.head.appendChild(s), gData[n] = !0
                    }
                    setTimeout(function() {
                        self.run(e, o, n)
                    }, 1e3)
                }
            }, self.getForm = function() {
                var datajax;
                if (self.sended = !1, datajax = "formid=" + _id + "&route=DSFormView", self.config) {
                    var configs = self.config.replace(/'/g, '"');
                    try {
                        eval(JSON.parse(configs)), datajax += "&dsconfig=" + configs
                    } catch (e) {
                        console.error("JSON array is improper for #" + _id + "!")
                    }
                }
                $.ajax({
                    url: root + "index.php",
                    type: "POST",
                    dataType: "text",
                    data: datajax,
                    cache: !1,
                    success: function(e) {
                        __construct__(e)
                    }
                })
            }, self.isOpen = function() {
                return _visible
            }, self.field = function(e) {
                return 0 === e.indexOf("#") ? $(e) : $('[name="' + e + '"]')
            }, o && options.formID && !_o.get(0).dsformmarker ? __init__() : !0 === _o.get(0).dsformmarker ? console.warn("DSFORM (" + options.formID + "): element already uses \n Path: " + __path__(self.element) + "\n Element:", self.element.get(0)) : options.formID || console.warn("DSFORM: formID is undefined \n Path: " + __path__(self.element) + " \n Element:", self.element.get(0)), self
        };
    $.dsform = function(e, o) {
        return o === undefined && (e.modal = !0, o = document.createElement("figure")), new F(o, e)
    }, $.dsform.ver = function() {
        return version
    }, $.dsform.uses = function() {
        return usings
    }, $.dsform.close = function(e) {
        $('[data-dsform-id="' + e + '"]').trigger("dspopup:close")
    }, $.fn.dsform = function(e) {
        return this.each(function() {
            new F($(this), e)
        }), this
    }, D.ready(function() {
        $("<img />", {
            src: root + "images/loading.gif",
            class: "loadform"
        }).css("display", "none").appendTo("body");
        var e = document.createElement("link");
        e.rel = "stylesheet", e.as = "style", e.href = root + "index.php?m=getcss", document.head.appendChild(e), $(".ds-form").each(function() {
            $.dsform({
                formID: $(this).attr("id"),
                modal: !1
            }, $(this))
        }), $("*[data-dspopup-id]").each(function() {
            var e = $(this).attr("data-dspopup-id");
            $.dsform({
                formID: e
            }, $(this))
        }), $(".prume_form").dsform({
            formID: "dscallme",
            modal: !1,
            inputmask: {
                "field-name238580": {
                    mask: "+7 (999) 999-99-99",
                    placeholder: " "
                }
            },
 		    onSuccess: function () {
		        yaCounter25448447.reachGoal("helpsend");
		    },           
        })
    })
}(window, document, gKweri) : console.error("Version jQuery < 1.5 or jQuery is not found!");