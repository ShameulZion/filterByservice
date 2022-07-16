var $jscomp = $jscomp || {};
$jscomp.scope = {};
$jscomp.checkStringArgs = function(a, b, d) {
    if (null == a) throw new TypeError("The 'this' value for String.prototype." + d + " must not be null or undefined");
    if (b instanceof RegExp) throw new TypeError("First argument to String.prototype." + d + " must not be a regular expression");
    return a + ""
};
$jscomp.ASSUME_ES5 = !1;
$jscomp.ASSUME_NO_NATIVE_MAP = !1;
$jscomp.ASSUME_NO_NATIVE_SET = !1;
$jscomp.defineProperty = $jscomp.ASSUME_ES5 || "function" == typeof Object.defineProperties ? Object.defineProperty : function(a, b, d) {
    a != Array.prototype && a != Object.prototype && (a[b] = d.value)
};
$jscomp.getGlobal = function(a) {
    return "undefined" != typeof window && window === a ? a : "undefined" != typeof global && null != global ? global : a
};
$jscomp.global = $jscomp.getGlobal(this);
$jscomp.polyfill = function(a, b, d, f) {
    if (b) {
        d = $jscomp.global;
        a = a.split(".");
        for (f = 0; f < a.length - 1; f++) {
            var g = a[f];
            g in d || (d[g] = {});
            d = d[g]
        }
        a = a[a.length - 1];
        f = d[a];
        b = b(f);
        b != f && null != b && $jscomp.defineProperty(d, a, {
            configurable: !0,
            writable: !0,
            value: b
        })
    }
};
$jscomp.polyfill("String.prototype.startsWith", function(a) {
    return a ? a : function(a, d) {
        var b = $jscomp.checkStringArgs(this, a, "startsWith");
        a += "";
        var g = b.length,
            h = a.length;
        d = Math.max(0, Math.min(d | 0, b.length));
        for (var l = 0; l < h && d < g;)
            if (b[d++] != a[l++]) return !1;
        return l >= h
    }
}, "es6", "es3");
$jscomp.findInternal = function(a, b, d) {
    a instanceof String && (a = String(a));
    for (var f = a.length, g = 0; g < f; g++) {
        var h = a[g];
        if (b.call(d, h, g, a)) return {
            i: g,
            v: h
        }
    }
    return {
        i: -1,
        v: void 0
    }
};
$jscomp.polyfill("Array.prototype.find", function(a) {
    return a ? a : function(a, d) {
        return $jscomp.findInternal(this, a, d).v
    }
}, "es6", "es3");
$jscomp.polyfill("String.prototype.endsWith", function(a) {
    return a ? a : function(a, d) {
        var b = $jscomp.checkStringArgs(this, a, "endsWith");
        a += "";
        void 0 === d && (d = b.length);
        d = Math.max(0, Math.min(d | 0, b.length));
        for (var g = a.length; 0 < g && 0 < d;)
            if (b[--d] != a[--g]) return !1;
        return 0 >= g
    }
}, "es6", "es3");
(function() {
    function a() {
        h = !0;
        d.removeEventListener("DOMContentLoaded", a);
        f.removeEventListener("load", a);
        g.forEach(function(c) {
            c()
        })
    }

    function b(c) {
        return parseFloat(c ? c : 0)
    }
    var d = document,
        f = window,
        g = [],
        h = !1;
    "complete" === d.readyState ? a() : (d.addEventListener("DOMContentLoaded", a), f.addEventListener("load", a));
    var l = Array.prototype.slice;
    String.prototype.startsWith || (String.prototype.startsWith = function(c, a) {
        return this.substr(!a || 0 > a ? 0 : +a, c.length) === c
    });
    String.prototype.endsWith || (String.prototype.endsWith =
        function(c, a) {
            if (void 0 === a || a > this.length) a = this.length;
            return this.substring(a - c.length, a) === c
        });
    f.$ = function(c, a) {
        if (c instanceof Function) return h ? c() : g.push(c), d;
        if (c instanceof NodeList) return new JQLite(l.call(c));
        if (c instanceof Node && 1 === c.nodeType) return new JQLite([c]);
        var k;
        if (k = "string" === typeof c) k = c.trim(), k = "<" === k[0] && ">" === k[k.length - 1] && 3 <= k.length;
        if (k) {
            c = c.trim();
            if (k = c.match(/^<([\w-]+)\s*\/?>(?:<\/\1>|)$/)) {
                a = a || {};
                c = d.createElement(k[1]);
                for (var b in a) a.hasOwnProperty(b) &&
                    c.setAttribute(b, a[b]);
                c = [c]
            } else c.startsWith("<!DOCTYPE") || c.startsWith("<!doctype") ? c = [(new DOMParser).parseFromString(c, "text/html").documentElement] : (a = d.createElement("div"), a.innerHTML = c, c = l.call(a.childNodes));
            return new JQLite(c)
        }
        if ("string" === typeof c) return new JQLite(l.call(d.querySelectorAll(c)));
        if (c instanceof Document) return new JQLite([c.documentElement])
    };
    f.JQLite = function(c) {
        this.elements = c;
        return this
    };
    var e = $.fn = JQLite.prototype;
    e.html = function(c) {
        if ("undefined" !== typeof c) {
            var a =
                "";
            c instanceof JQLite ? c.each(function() {
                a += this.outerHTML
            }) : a = c;
            this.elements.forEach(function(c) {
                c.innerHTML = a
            });
            return this
        }
        return this.elements[0].innerHTML
    };
    e.empty = function() {
        this.html("");
        return this
    };
    e.prevSiblings = function() {
        for (var c = [], a = this.get(0); a = a.previousElementSibling;) c.push(a);
        return new JQLite(c)
    };
    e.nextSiblings = function() {
        for (var c = [], a = this.get(0); a = a.nextElementSibling;) c.push(a);
        return new JQLite(c)
    };
    e.siblings = function(c) {
        var a = this.prevSiblings().elements.concat(this.nextSiblings().elements),
            b = [];
        c ? a.forEach(function(a) {
            $(a).is(c) && b.push(a)
        }) : b = a;
        return new JQLite(b)
    };
    e.appendToFirst = function(c) {
        this.elements[0].appendChild(c)
    };
    e.prepend = function(c) {
        c instanceof JQLite ? c.elements.forEach(function(c) {
            this.elements[0].prepend(c)
        }.bind(this)) : this.elements[0].prepend(c);
        return this
    };
    e.append = function(c) {
        c instanceof JQLite ? c.elements.forEach(function(c) {
            this.elements[0].appendChild(c)
        }.bind(this)) : c instanceof HTMLElement ? this.elements[0].appendChild(c) : "string" === typeof c && this.elements.forEach(function(a) {
            a.innerHTML +=
                c
        });
        return this
    };
    e.before = function(c) {
        var a = 1 < this.size();
        this.elements.forEach(function(b) {
            var d = b.parentNode;
            "string" === typeof c && (c = $(c));
            c.each(function() {
                var c = a ? this.cloneNode(!0) : this;
                d.insertBefore(c, b)
            })
        })
    };
    e.after = function(c) {
        var a = 1 < this.size();
        this.elements.forEach(function(b) {
            var d = b.parentNode,
                k = b.nextSibling;
            "string" === typeof c && (c = $(c));
            c.each(function() {
                var c = a ? this.cloneNode(!0) : this;
                k ? d.insertBefore(c, k) : d.appendChild(c)
            })
        })
    };
    e.attr = function(c, a) {
        if ("undefined" !== typeof a) return this.elements.forEach(function(b) {
            b.setAttribute(c,
                a)
        }), this;
        var b = this.elements[0];
        return b ? b.getAttribute(c) : null
    };
    e.removeAttr = function(c) {
        this.elements.forEach(function(a) {
            a.removeAttribute(c)
        })
    };
    e.get = function(c) {
        return this.elements[c]
    };
    e.hasClass = function(c) {
        var a = this.get(0);
        return (new RegExp(" " + c + " ")).test(" " + a.className + " ")
    };
    e.addClass = function(c) {
        this.elements.forEach(function(a) {
            a.classList ? a.classList.add(c) : $(a).hasClass(c) || (a.className += " " + c)
        });
        return this
    };
    e.removeClass = function(c) {
        this.elements.forEach(function(a) {
            if (a.classList) a.classList.remove(c);
            else {
                var b = " " + a.className.replace(/[\t\r\n]/g, " ") + " ";
                if ($(a).hasClass(c)) {
                    for (; 0 <= b.indexOf(" " + c + " ");) b = b.replace(" " + c + " ", " ");
                    a.className = b.replace(/^\s+|\s+$/g, "")
                }
            }
        });
        return this
    };
    e.toggleClass = function(c) {
        this.each(function(a, b) {
            b = $(b);
            b.hasClass(c) ? b.removeClass(c) : b.addClass(c)
        })
    };
    e.hasClass = function(c) {
        return (new RegExp(" " + c + " ")).test(" " + this.get(0).className + " ")
    };
    e.children = function() {
        var c = [],
            a;
        this.elements.forEach(function(b) {
            a = Array.prototype.slice.call(b.children);
            c = c.concat(a)
        });
        return new JQLite(c)
    };
    e.val = function(c) {
        if (void 0 !== c) this.each(function() {
            this.value = c
        });
        else {
            var a = this.get(0);
            return a ? a.value : null
        }
    };
    e.parent = function() {
        var c = [],
            a;
        this.elements.forEach(function(b) {
            (a = b.parentElement) && -1 === c.indexOf(a) && c.push(a)
        });
        return new JQLite(c)
    };
    e.parents = function(a) {
        if (!a) return this.parent();
        for (var c = $(this.get(0).parentElement); c.size() && !c.is(a);) c = c.parent();
        return c
    };
    e.find = function(a) {
        var c = [],
            b, d;
        this.elements.forEach(function(f) {
            b = f.querySelectorAll(a);
            d = Array.prototype.slice.call(b);
            d.forEach(function(a) {
                -1 === c.indexOf(a) && c.push(a)
            })
        });
        return new JQLite(c)
    };
    e.is = function(a) {
        if (0 === this.elements.length) return !1;
        var c = !0;
        this.elements.forEach(function(b) {
            var f = !1;
            if (a.nodeType) f = b === a;
            else
                for (var k = "string" === typeof a ? d.querySelectorAll(a) : a.elements, n = k.length; n--;) k[n] === b && (f = !0);
            c = f && c
        });
        return c
    };
    e.has = function(a) {
        var c = [];
        a = a instanceof Node ? a : a.get(0);
        this.each(function() {
            this.contains(a) && c.push(this)
        });
        return new JQLite(c)
    };
    e.remove = function() {
        this.elements.forEach(function(a) {
            try {
                a.remove()
            } catch (k) {
                a.parentNode.removeChild(a)
            }
        })
    };
    e.on = function(a, b) {
        this.elements.forEach(function(c) {
            c.addEventListener(a, b)
        });
        return this
    };
    e.delegate = function(a, b, d) {
        this.on(b, function(c) {
            $(c.target).is(a) && d.apply(c.target, arguments)
        })
    };
    e.off = function(a, b) {
        this.elements.forEach(function(c) {
            c.removeEventListener(a, b)
        });
        return this
    };
    e.trigger = function(a) {
        try {
            var c = new Event(a)
        } catch (p) {
            c = d.createEvent("Event"), c.initCustomEvent(a, !0, !0)
        }
        this.elements.forEach(function(a) {
            a.dispatchEvent(c)
        })
    };
    e.each = function(a) {
        this.elements.forEach(function(c,
            b) {
            a.call(c, b, c)
        })
    };
    e.hide = function() {
        this.originalDisplay = this.css("display");
        this.css("display", "none");
        return this
    };
    e.show = function() {
        this.css("display", this.originalDisplay && "none" !== this.originalDisplay ? this.originalDisplay : "block");
        return this
    };
    e.css = function(a, b) {
        if (a && "string" !== typeof a)
            for (var c in a) this.elements.forEach(function(b) {
                b.style[c] = a[c]
            });
        else {
            if ("undefined" === typeof b) return this.elements[0].style.getPropertyValue(a);
            this.elements.forEach(function(c) {
                c.style[a] = b
            });
            return this
        }
    };
    e.outerHeight = function() {
        var a = b(this.css("marginTop")) + b(this.css("marginBottom"));
        return Math.ceil(this.get(0).offsetHeight + a)
    };
    e.offset = function() {
        var a = this.get(0);
        var b = a && a.ownerDocument;
        var d = b.documentElement;
        a = a.getBoundingClientRect();
        b = b.defaultView;
        return {
            top: a.top + b.pageYOffset - d.clientTop,
            left: a.left + b.pageXOffset - d.clientLeft
        }
    };
    e.position = function() {
        var a = this.get(0);
        var d = {
            top: 0,
            left: 0
        };
        if ("fixed" === this.css("position")) a = a.getBoundingClientRect();
        else {
            var f = new JQLite([a.offsetParent]);
            a = this.offset();
            "html" !== this.get(0).nodeName && (d = f.offset());
            d.top += b(f.css("borderTopWidth"));
            d.left += b(f.css("borderLeftWidth"))
        }
        return {
            top: a.top - d.top - this.css("marginTop"),
            left: a.left - d.left - this.css("marginLeft")
        }
    };
    e.text = function(a) {
        if ("undefined" !== typeof a) return this.elements.forEach(function(c) {
            c.innerText = a
        }), this;
        text = "";
        this.elements.forEach(function(a) {
            text += a.innerText
        });
        return text
    };
    e.size = function() {
        return this.elements.length
    };
    e.data = function(a, b) {
        var c = this.get(0).dataset;
        c = c || {};
        if (a && b) c[a] = b;
        else return a ? c[a] : c
    };
    e.scrollTop = function(a) {
        var c = this.get(0);
        if (!c) return null;
        void 0 !== a && (this.get(0).scrollTop = a);
        return c.scrollTop
    };
    $.extend = function(a) {
        Array.prototype.slice.call(arguments, 1).forEach(function(c) {
            for (var b in c) a[b] = c[b]
        });
        return a
    };
    var q = function(a) {
        var c = a.method.toUpperCase().trim(),
            b = a.data,
            d = a.url;
        if (b instanceof JQLite) {
            var e = b.elements;
            b = {};
            e.forEach(function(a) {
                a.name && (b[a.name] = a.value)
            })
        }
        if ("string" !== typeof b && !(f.FormData && b instanceof FormData)) {
            e = [];
            for (var n in b) "GET" === c ? d = updateURLVar(d, n, b[n]) : e.push(n + "=" + encodeURIComponent(b[n]));
            b = e.join("&")
        }
        var m = new XMLHttpRequest;
        m.onreadystatechange = function() {
            if (m.readyState === XMLHttpRequest.DONE) {
                if (200 === m.status) {
                    var c = m.response || m.responseText;
                    "json" === a.dataType && (c = JSON.parse(c));
                    a.success(c)
                } else a.error(m, m.status, m.response);
                a.complete()
            }
        };
        m.open(c, d, !0);
        "GET" !== c && a.contentType && m.setRequestHeader("Content-type", a.contentType);
        a.beforeSend(a);
        m.send(b)
    };
    $.ajax = function(a) {
        var c = {
            success: function() {},
            error: function() {},
            url: f.location.href,
            method: "GET",
            complete: function() {},
            beforeSend: function() {},
            dataType: "html",
            data: "",
            contentType: "application/x-www-form-urlencoded"
        };
        $.extend(c, a);
        q(c)
    };
    e.load = function(a, b, d) {
        var c, f = this,
            e = a.indexOf(" ");
        if (-1 < e) {
            var m = a.slice(e).trim();
            a = a.slice(0, e)
        }
        b && "object" === typeof b && (c = "POST");
        $.ajax({
            url: a,
            method: c || "GET",
            dataType: "html",
            data: b,
            success: function(a) {
                f.html(m ? $("<div>").append(a).find(m) : a);
                d && d(a)
            }
        })
    };
    $.get = function(a, b, d) {
        $.ajax($.extend({
                url: a,
                success: b
            },
            d))
    };
    $.post = function(a, b, d) {
        $.ajax({
            url: a,
            data: b,
            method: "POST",
            success: d
        })
    }
})();
var app = window.app || {};
app.event = function() {
    function a() {
        this.events = {}
    }
    var b = a.prototype;
    b.on = function(a, b) {
        var d = this.events[a] || [];
        d.push(b);
        this.events[a] = d
    };
    b.trigger = function(a, b) {
        (this.events[a] || []).forEach(function(a) {
            a.apply(null, b)
        })
    };
    return new a
}();
Number.prototype.toCommaFormat = function() {
    var a = this.toString().split(".");
    a[0] = a[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return a.join(".")
};
String.prototype.replaceAll = function(a, b) {
    return this.replace(new RegExp(a, "g"), b)
};

function getURLVar(a) {
    var b = {},
        d = String(document.location).split("?");
    if (d[1]) {
        d = d[1].split("&");
        for (i = 0; i < d.length; i++) {
            var f = d[i].split("=");
            f[0] && f[1] && (b[f[0]] = f[1])
        }
        if (b[a]) return b[a]
    }
    return ""
}

function updateURLVar(a, b, d) {
    var f = new RegExp("([?&])" + b + "=.*?(&|$)", "i"),
        g = -1 !== a.indexOf("?") ? "&" : "?";
    a.match(f) && d ? a = a.replace(f, "$1" + b + "=" + d + "$2") : a.match(f) && !d ? a = a.replace(f, "$1") : d && (a = a + g + b + "=" + d);
    if (a.endsWith("&") || a.endsWith("?")) a = a.substr(0, a.length - 1);
    return a
}

function shareOnSocialMedea(a, b, d, f) {
    switch (a) {
        case "twitter":
            window.open("https://twitter.com/intent/tweet?text=" + d + " " + encodeURIComponent(b), "sharertwt", "toolbar=0,status=0,width=640,height=445");
            break;
        case "facebook":
            window.open("http://www.facebook.com/sharer.php?u=" + b, "sharer", "toolbar=0,status=0,width=660,height=445");
            break;
        case "linkedin":
            window.open("https://www.linkedin.com/shareArticle?mini=true&url=" + b + "title=" + d, "sharer", "toolbar=0,status=0,width=660,height=445");
            break;
        case "google-plus":
            window.open("https://plus.google.com/share?url=" +
                b, "sharer", "toolbar=0,status=0,width=660,height=445");
            break;
        case "pinterest":
            window.open("http://www.pinterest.com/pin/create/button/?media=" + f + "&url=" + b, "sharerpinterest", "toolbar=0,status=0,width=660,height=445")
    }
}

function isMobile() {
    return 768 > window.innerWidth
}

function showMsg(a, b, d) {
    b || (b = "success");
    d = d || {};
    mgs_type = d.mgs_type ? d.mgs_type : app.mgs_type;
    "popup" === mgs_type ? (b = new Popup(a, "mgs-popup " + b), d = d.duration || 5, b.render(), setTimeout(function() {}, 1E3 * d)) : ($(".alert, .text-danger").remove(), d = $(".container.alert-container"), 0 === d.size() && (d = $('<div class="container alert-container"></div>'), $(".after-header").after(d)), a = $('<div class="alert alert-' + b + '">' + a + '<button type="button" class="close" data-dismiss="alert">x</button></div>'), d.append(a), a.find(".close").on("click",
        function() {
            a.remove()
        }), $("body, html").scrollTo(0, 600))
}
$(function() {
    $(".text-danger").each(function() {
        $(this).parents(".form-group").addClass("has-error")
    });
    var a = $("#search input[name='search']");
    a.parent().find("button").on("click", function() {
        var b = $("base").attr("href") + "product/search",
            d = a.val(),
            h = [];
        d && h.push("search=" + encodeURIComponent(d));
        (d = $("#search select[name='category_id']").val()) && h.push("category_id=" + d);
        h && (b = b + "?" + h.join("&"));
        location = b;
        fbq("track", "Search")
    });
    a.on("keydown", function(b) {
        13 === b.keyCode && a.parent().find("button").trigger("click")
    });
    $(document).delegate(".checkout-btn", "click", function() {
        try {
            fbq("track", "InitiateCheckout")
        } catch (f) {}
    });
    var b = $(".mc-toggler");
    b.on("click", function() {
        b.is(".loaded") || (cart.reload(), b.addClass("loaded"))
    });
    var d = $(".cmpr-toggler");
    d.on("click", function() {
        d.is(".loaded") || (compare.reload(), d.addClass("loaded"))
    })
});
var cart = {
        add: function(a, b) {
            var d = this;
            $.ajax({
                url: "checkout/cart/add",
                method: "post",
                data: "product_id=" + a + "&quantity=" + ("undefined" != typeof b ? b : 1),
                dataType: "json",
                beforeSend: function() {
                    $("#cart > button").button("loading")
                },
                complete: function() {
                    $("#cart > button").button("reset")
                },
                success: function(b) {
                    b.redirect && (location = b.redirect);
                    b.success && (showMsg(b.success), setTimeout(function() {
                        $(".mc-toggler .text").html(b.total);
                        $(".mc-toggler .counter").text(b.count).attr("data-count", b.count);
                        $(".mc-toggler").attr("title",
                            b.total)
                    }, 100), d.reload(), app.event.trigger("addToCart", b), fbq("track", "AddToCart", {
                        content_ids: [a],
                        content_type: "product",
                        value: b.item_total,
                        currency: "BDT"
                    }))
                }
            })
        },
        update: function(a, b) {
            var d = this;
            $.ajax({
                url: "checkout/cart/edit",
                method: "post",
                data: "ajax=true&quantity[" + encodeURIComponent(a) + "]=" + ("undefined" != typeof b ? b : 1),
                dataType: "json",
                beforeSend: function() {
                    $("#cart > button").button("loading")
                },
                complete: function() {
                    $("#cart > button").button("reset")
                },
                success: function(a) {
                    "checkout/cart" == getURLVar("route") ||
                        "checkout/checkout" == getURLVar("route") ? location = "checkout/cart" : ($(".mc-toggler .text").html(a.total), $(".mc-toggler .counter").text(a.count).attr("data-count", a.count), $(".mc-toggler").attr("title", a.total), d.reload())
                }
            })
        },
        remove: function(a, b) {
            var d = this;
            $.ajax({
                url: "checkout/cart/remove",
                method: "post",
                data: "key=" + a,
                dataType: "json",
                beforeSend: function() {
                    $("#cart > button").button("loading")
                },
                complete: function() {
                    $("#cart > button").button("reset")
                },
                success: function(a) {
                    setTimeout(function() {
                        $(".mc-toggler .text").html(a.total);
                        $(".mc-toggler .counter").text(a.count).attr("data-count", a.count);
                        $(".mc-toggler").attr("title", a.total)
                    }, 100);
                    b ? location = "checkout/cart" : d.reload()
                }
            })
        },
        reload: function() {
            var a = $("#m-cart");
            a.append($("<div class='mask'></div>"));
            $.get("common/cart/info", function(b) {
                b = $(b);
                a.find(".content").size() ? (a.find(".content").html(b.find(".content").html()), a.find(".footer").html(b.find(".footer").html())) : a.html(b);
                a.find(".mask").remove();
                app.event.trigger("cart_load", [a])
            })
        }
    },
    voucher = {
        add: function() {},
        remove: function(a) {
            $.ajax({
                url: "checkout/cart/remove",
                method: "post",
                data: "key=" + a,
                dataType: "json",
                beforeSend: function() {
                    $("#cart > button").button("loading")
                },
                complete: function() {
                    $("#cart > button").button("reset")
                },
                success: function(a) {
                    setTimeout(function() {
                        $("#cart > button").html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + a.total + "</span>")
                    }, 100);
                    "checkout/cart" == getURLVar("route") || "checkout/checkout" == getURLVar("route") ? location = "checkout/cart" : cart.reload()
                }
            })
        }
    },
    wishlist = {
        add: function(a) {
            $.ajax({
                url: "account/wishlist/add",
                method: "post",
                data: "product_id=" + a,
                dataType: "json",
                success: function(a) {
                    $(".alert").remove();
                    a.success && showMsg(a.success);
                    a.info && showMsg(a.info, "error");
                    $("#wishlist-total span").html(a.total);
                    $("#wishlist-total").attr("title", a.total);
                    fbq("track", "AddToWishlist")
                }
            })
        },
        remove: function() {}
    },
    compare = {
        add: function(a) {
            $.ajax({
                url: "common/compare/add",
                method: "post",
                data: "ajax=true&product_id=" + a,
                dataType: "json",
                success: function(a) {
                    $(".alert").remove();
                    a.success && (showMsg(a.success), $(".cmpr-toggler .text").html(a.total),
                        $(".cmpr-toggler .counter").text(a.count), compare.reload())
                }
            })
        },
        remove: function(a) {
            var b = this;
            $.ajax({
                url: "common/compare/remove",
                method: "post",
                data: "product_id=" + a,
                dataType: "json",
                success: function(a) {
                    setTimeout(function() {
                        $(".cmpr-toggler .text").html(a.total);
                        $(".cmpr-toggler .counter").text(a.count)
                    }, 100);
                    b.reload()
                }
            })
        },
        clear: function() {
            $.ajax({
                url: "common/compare/clear",
                method: "post",
                dataType: "json",
                success: function(a) {
                    setTimeout(function() {
                            $(".cmpr-toggler .text").html(a.total);
                            $(".cmpr-toggler .counter").text(a.count)
                        },
                        100);
                    compare.reload()
                }
            })
        },
        reload: function() {
            var a = $("#cmpr-panel");
            a.append($("<div class='mask'></div>"));
            $.get("common/compare/index", function(b) {
                b = $(b);
                a.find(".content").html(b.find(".content").html());
                a.find(".footer").html(b.find(".footer").html());
                a.find(".mask").remove()
            })
        }
    },
    stock_request = {
        add: function(a) {
            $.ajax({
                url: "checkout/stock_request/add",
                method: "post",
                data: {
                    product_id: a,
                    referrer: location.href
                },
                dataType: "json",
                beforeSend: function() {},
                complete: function() {},
                success: function(a) {
                    a.redirect &&
                        (location = a.redirect);
                    a.success && showMsg(a.success, "success");
                    a.error && showMsg(a.error, "error")
                }
            })
        }
    };
$.fn.autocomplete = function(a) {
    return this.each(function() {
        var b = $(this),
            d = this;
        this.timer = null;
        this.items = [];
        this.wrap = '<ul class="dropdown-menu"></ul>';
        $.extend(this, a);
        b.attr("autocomplete", "off");
        b.on("focus", function() {
            d.request()
        });
        b.on("blur", function() {
            setTimeout(function(a) {
                a.hide()
            }, 200, this)
        });
        b.on("keydown", function(a) {
            switch (a.keyCode) {
                case 27:
                    d.hide();
                    break;
                default:
                    d.request()
            }
        });
        d.click = function(a) {
            (value = $(a.target).parent().attr("data-value")) && this.items[value] && (a.preventDefault(),
                this.select(this.items[value]))
        };
        d.show = function() {
            var a = b.position(),
                d = b.siblings(".dropdown-menu");
            d.css({
                top: a.top + b.outerHeight() + "px",
                left: a.left + "px"
            });
            d.show()
        };
        d.hide = function() {
            b.siblings(".dropdown-menu").hide()
        };
        this.request = function() {
            clearTimeout(d.timer);
            d.timer = setTimeout(function(a) {
                a.source($(a).val(), a.response.bind(a))
            }, 500, this)
        };
        d.response = function(a) {
            var f = "";
            if (a.length) {
                for (i = 0; i < a.length; i++) d.items[a[i].value] = a[i];
                for (i = 0; i < a.length; i++) a[i].category || (f += '<li data-value="' +
                    a[i].value + '"><a href="#">' + a[i].label + "</a></li>")
            }
            f ? d.show() : d.hide();
            b.siblings(".dropdown-menu").html(f)
        };
        b.after(this.wrap);
        b.siblings(".dropdown-menu").delegate("a", "click", this.click.bind(this))
    })
};
$.fn.button = function(a) {
    0 !== this.size() && ("loading" === a ? (this.addClass("disabled"), this.attr("disabled", ""), this.data("old_text", this.text()), this.text("Loading...")) : (this.removeClass("disabled"), this.removeAttr("disabled"), this.text(this.data("old_text"))))
};
$.fn._scrollTo = function(a, b) {
    var d = this,
        f = null;
    if (1 < d.size()) {
        for (var g = 0; g < d.size(); g++) {
            var h = d.elements[g];
            if (h.scrollHeight > h.clientHeight) {
                f = h;
                break
            }
        }
        f && (d = $(f))
    } else f = d.get(0);
    if (null == f) this.each(function() {
        this.scrollTop = a
    });
    else if (!(0 >= b || 0 === d.size())) {
        var l = (a - f.scrollTop) / b * 10;
        setTimeout(function() {
            f.scrollTop += l;
            f.scrollTop !== a && this._scrollTo(a, b - 10)
        }.bind(d), 10)
    }
};
$.fn.scrollTo = function(a, b) {
    try {
        window.scroll({
            top: a,
            behavior: "smooth"
        })
    } catch (d) {
        window.scroll(0, a)
    }
};

function Popup(a, b) {
    var d = this;
    this.el = a = $('<div class="popup ' + b + '"><div class="popup-inner">' + a + '<span class="popup-close"></span></div></div>');
    a.find(".popup-close,.close").on("click", function() {
        d.close()
    });
    a.on("click", function(a) {
        $(a.target).is(".popup") && d.close()
    })
}
var _p = Popup.prototype;
_p.render = function() {
    this.timer && clearTimeout(this.timer);
    this.el.addClass("f-in").removeClass("f-out");
    $("body").append(this.el)
};
_p.close = function() {
    var a = this;
    a.el.addClass("f-out").removeClass("f-in");
    a.timer = setTimeout(function() {
        a.el.remove()
    }, 2E3)
};

function Tab(a) {
    var b = this;
    b.elm = a;
    b.headers = a.find("li");
    var d = null;
    b.headers.each(function() {
        var f = $(this);
        a.find("#" + f.attr("data-tab")).hide();
        f.on("click", function() {
            b.activate(f)
        });
        f.is(".active") && (d = f)
    });
    null == d && (d = $(b.headers.get(0)));
    b.activate(d)
}
var _t = Tab.prototype;
_t.activate = function(a) {
    this.active && (this.active.removeClass("active"), this.elm.find("#" + this.active.attr("data-tab")).hide());
    this.elm.find("#" + a.attr("data-tab")).show();
    a.addClass("active");
    this.active = a
};
(function() {
    function a(a, b) {
        var d = new Image,
            e = a.getAttribute("data-src");
        d.onload = function() {
            a.parent ? a.parent.replaceChild(d, a) : a.src = e;
            b ? b() : null
        };
        d.src = e
    }

    function b(a) {
        a = a.getBoundingClientRect();
        return 0 <= a.top && 0 <= a.left && a.top <= (window.innerHeight || document.documentElement.clientHeight)
    }
    var d = [],
        f = function() {
            for (var f = [], h = 0; h < d.length; h++) b(d[h]) && (a(d[h]), f.push(d[h]));
            f.forEach(function(a) {
                a = d.indexOf(a); - 1 < a && d.splice(a, 1)
            })
        };
    $(function() {
        $("img.lazy").each(function() {
            d.push(this)
        });
        f();
        window.addEventListener("scroll", f)
    })
})();
$(function() {
    function a(a) {
        var b = "";
        a.forEach(function(a) {
            b = "remainder_cnt" === a.type ? b + ('<div class="search-item remainder-count"><a href="' + a.href + '">' + a.label + "</a></div>") : b + ('<div class="search-item"><a href="' + a.href + '"><div class="image"><img src="' + a.thumb + '"></div><div class="name">' + a.label + "</div>" + (a.price ? a.special ? '<div class="price"><ins>' + a.special + "</ins> &nbsp; <del>" + a.price + "</del></div>" : '<div class="price">' + a.price + "</div>" : "") + "</a></div>")
        });
        return b
    }
    var b = $('#search input[name="search"]'),
        d = $('<div class="dropdown-menu">\n\t\t<div class="search-details">\n\t\t    <ul class="nav nav-tabs">\n                <li data-tab="tab-prod">Products</li>\n                <li data-tab="tab-cat">Categories</li>\n            </ul>\n            <div id="tab-prod" class="search-results"></div>\n            <div id="tab-cat" class="search-results"></div>\n\t\t</div>\n\t</div>');
    b.autocomplete({
        wrap: d,
        source: function(b, g) {
            var c = this;
            b ? $.ajax({
                url: "common/search_suggestion/index?keyword=" + encodeURIComponent(b),
                dataType: "json",
                success: function(b) {
                    var e = a(b.categories);
                    d.find("#tab-cat").html(e ? e : '<div class="search-item empty">No results found for query</div>');
                    e && f.activate(d.find("[data-tab=tab-cat]"));
                    e = a(b.products);
                    d.find("#tab-prod").html(e ? e : '<div class="search-item empty">No results found for query</div>');
                    e && f.activate(d.find("[data-tab=tab-prod]"));
                    e ? c.show() : c.hide();
                    d.scrollTop(0)
                }
            }) : c.hide()
        },
        select: function(a) {}
    });
    var f = new Tab(d),
        g = !1,
        h = b.get(0),
        l = h.hide;
    h.hide = function() {
        g || l()
    };
    $(document).on("click",
        function(a) {
            a = $(a.target);
            d.has(a).size() || b.is(a) ? g = !0 : (g = !1, h.hide())
        })
});
$(function() {
    function a(a) {
        var b = this;
        a.forEach(function(a) {
            var c = $(a.toggle);
            c.on("click", function() {
                c.hasClass("close") ? b.hide(a) : b.show(a)
            })
        })
    }

    function b(a) {
        var b = this;
        b.elm = a;
        b.slides = [];
        b.dots = [];
        var c = $("<div>", {
            "class": "slider-dot"
        });
        a.find(".slide").each(function(a, d) {
            d = $(d);
            b.slides[a] = d;
            var e = $("<span>", {
                "class": "dot"
            });
            c.append(e);
            b.dots[a] = e;
            d.hide();
            e.on("click", function() {
                b.showSlides(a)
            })
        });
        0 !== b.slides.length && (a.append(c), b.index = 0, b.showSlides(0))
    }

    function d(a) {
        var b = a.position,
            d = '<a href="' + a.url + '"><img src="' + a.image + '" alt="' + a.title + '" class="img-responsive"></a>';
        1 == b ? setTimeout(function() {
            var a = new Popup(d);
            a.render();
            localStorage.showed = c;
            setTimeout(function() {
                a.close()
            }, 14E3)
        }, 6E3) : $(".ads-pos-" + b).html(d)
    }

    function f(a) {
        var b = this;
        b.elm = a;
        b.date = (new Date(a.data("date"))).getTime();
        var c = setInterval(function() {
            var a = (new Date).getTime();
            a = b.date - a;
            0 > a ? clearInterval(c) : b.update(a)
        }, 1E3)
    }
    var g = $("html"),
        h = $("body"),
        l = $(".overlay"),
        e = a.prototype;
    e.show = function(a) {
        this.active &&
            this.hide(this.active);
        var b = $(a.target),
            c = $(a.toggle);
        a.overlay && l.addClass("open");
        a.no_scroll && $("body").addClass("no-scroll");
        c.addClass("close");
        b.addClass("open");
        this.active = a
    };
    e.hide = function(a) {
        if (a = a || this.active) {
            var b = $(a.target);
            $(a.toggle).removeClass("close");
            b.removeClass("open");
            l.removeClass("open");
            $("body").removeClass("no-scroll");
            this.active = a
        }
    };
    var q = new a([{
        toggle: "#nav-toggler",
        target: "#main-nav",
        overlay: !0,
        no_scroll: !0
    }, {
        toggle: ".mc-toggler",
        target: "#m-cart"
    }, {
        toggle: ".cmpr-toggler",
        target: "#cmpr-panel"
    }, {
        toggle: ".search-toggler",
        target: "#search"
    }, {
        toggle: "#lc-toggle, .lc-close",
        target: "#column-left",
        overlay: !0,
        no_scroll: !0
    }]);
    l.on("click", function() {
        q.hide()
    });
    app.event.on("cart_load", function(a) {
        a.find(".button-coupon").on("click", function() {
            var a = $(this),
                b = $(a.data("target"));
            $.ajax({
                url: "checkout/coupon/coupon",
                method: "post",
                data: "coupon=" + encodeURIComponent(b.val()),
                dataType: "json",
                beforeSend: function() {
                    a.button("loading", "Applying ...")
                },
                complete: function() {
                    a.button("reset")
                },
                success: function(a) {
                    a.error && showMsg('<div class="msg-wrap">' + a.error + "</div>", "error");
                    a.success && cart.reload()
                }
            })
        })
    });
    app.event.on("addToCart", function() {
        $(".mc-toggler").addClass("bounce");
        setTimeout(function() {
            $(".mc-toggler").removeClass("bounce")
        }, 900)
    });
    $(".has-child a").on("click", function(a) {
        $(this).parent().toggleClass("open");
        var b = $(a.target);
        (isMobile() && b.is(".has-child > a") || b.is(".responsive-menu > .has-child > a")) && a.preventDefault()
    });
    "" == $(".category-description").text() && $(".category-description").remove();
    b.prototype.showSlides = function(a) {
        this.timer && clearTimeout(this.timer);
        a >= this.slides.length && (a = 0);
        this.slides[this.index].hide();
        this.slides[a].show();
        this.dots[this.index].removeClass("active");
        this.dots[a].addClass("active");
        this.index = a;
        this.timer = setTimeout(this.showSlides.bind(this, ++a), 5E3)
    };
    $(".home-slider").each(function() {
        new b($(this))
    });
    window.addClearFix = function() {};
    window.addEventListener("scroll", function() {
        132 < g.scrollTop() ? h.addClass("on-scroll") : h.removeClass("on-scroll")
    });
    $(".to-top").on("click",
        function(a) {
            a.preventDefault();
            $("html").scrollTo(0, 600)
        });
    $(".alert .close").on("click", function() {
        $(this).parent(".alert").remove()
    });
    var c = (new Date).getTime();
    e = localStorage.showed;
    var k = localStorage.lastVisited,
        p = [];
    e = parseInt(e);
    e = isNaN(e) ? null : e;
    k = parseInt(k);
    k = isNaN(k) ? null : k;
    var t = app.popupDuration ? app.popupDuration : 12;
    app.enablePopup && k && 36E4 > c - k && (!e || c - e > 36E5 * t) && p.push(1);
    $(".ads:not(.loaded)").each(function() {
        p.push($(this).attr("data-position"))
    });
    if (p.length) {
        var r = "device_type=" +
            (isMobile() ? 1 : 3);
        p.forEach(function(a) {
            r += "&ads_position[]=" + a
        });
        $.ajax({
            url: "api/ads",
            data: r,
            method: "post",
            dataType: "json",
            success: function(a) {
                a.forEach(function(a) {
                    d(a)
                });
                (a = a[1]) && a.image && d(a.image, a.title, a.url)
            }
        })
    }
    e = (new Date).getHours();
    9 <= e && 21 >= e && $(".svg-icon svg").show();
    localStorage.lastVisited = c;
    $(".cmpr-product").autocomplete({
        source: function(a, b) {
            $.ajax({
                url: "common/search_suggestion/product?keyword=" + encodeURIComponent(a),
                dataType: "json",
                success: b
            })
        },
        select: function(a) {
            var b = $(this),
                c = b.siblings("input");
            b.val(a.label);
            c.val(a.value);
            c.trigger("change")
        }
    });
    $(".form-cmpr").on("submit", function(a) {
        var b = $(this),
            c = [];
        b.find(".prod-id").each(function() {
            var b = $(this);
            b.val() ? c.push(b.val()) : (a.preventDefault(), b.siblings("input").addClass("error"))
        });
        b.find("[name=product_id]").val(c.join(","))
    });
    e = f.prototype;
    e.setGroupVal = function(a, b) {
        b = b.toString();
        1 === b.length && (b = "0" + b);
        var c = this.elm.find("." + a);
        c.find(".digit").remove();
        b.split("").forEach(function(a) {
            c.find(".tag").before('<span class="digit">' +
                a + "</span>")
        })
    };
    e.update = function(a) {
        this.setGroupVal("days", Math.floor(a / 864E5));
        this.setGroupVal("hours", Math.floor(a % 864E5 / 36E5));
        this.setGroupVal("minutes", Math.floor(a % 36E5 / 6E4));
        this.setGroupVal("seconds", Math.floor(a % 6E4 / 1E3))
    };
    $(".countdown").each(function() {
        new f($(this))
    })
});