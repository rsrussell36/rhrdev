!(function () {
    "use strict";
    let r = "",
        a = "",
        l = !1;
    function i(e) {
        e.target && (e.target.style.color = "#000");
    }
    function d(e) {
        var t;
        e.target &&
            ((t = document.getElementById("rhr-original-permalink")),
                (document.getElementById("rhr_permalink").value = e.target.value),
                ("" !== e.target.value && e.target.value !== t.value) || ((e.target.value = t.value), (e.target.style.color = "#ddd")));
    }
    function c() {
        if (r && wpApiSettings && wpApiSettings.nonce) {
            const o = document.getElementsByClassName("edit-post-post-link__preview-label");
            var t,
                n = document.getElementById("rhr_permalinks_home_url");
            let e = "";
            o && o[0] && o[0].parentNode.classList.add("cp-permalink-hidden"),
                (a = r.isSavingMetaBoxes()),
                a === l ||
                a ||
                ((t = wp.data.select("core/editor").getEditedPostAttribute("id")),
                    (e = new XMLHttpRequest()),
                    (l = a),
                    (e.onreadystatechange = function () {
                        4 === e.readyState &&
                            200 === e.status &&
                            (function (e) {
                                var t = document.getElementById("rhr_permalinks_home_url"),
                                    n = document.getElementById("rhr-permalinks-add");
                                let o = "",
                                    a = "";
                                if (
                                    ((document.getElementById("rhr_permalink").value = e.rhr_permalink),
                                        "" === e.rhr_permalink && (e.rhr_permalink = e.original_permalink),
                                        (o = e.preview_permalink ? t.value + e.preview_permalink : t.value + e.rhr_permalink),
                                        (document.getElementById("rhr-modify-permalinks-post-slug").value = e.rhr_permalink),
                                        (document.getElementById("rhr-original-permalink").value = e.original_permalink),
                                        document.querySelector("#view-post-btn a") && ((a = document.querySelector("#view-post-btn a").href), (document.querySelector("#view-post-btn a").href = o)),
                                        document.querySelector("a.editor-post-preview") && (document.querySelector("a.editor-post-preview").href = o),
                                        "" !== a)
                                ) {
                                    a = a.replace(/\//g, "/");
                                    let e = 0;
                                    const r = document.querySelectorAll("body a");
                                    for (var l = new RegExp(a, "g"), s = r.length; e < s;) r[e] && r[e].href && (r[e].href = r[e].href.replace(l, o)), (e += 1);
                                }
                                n && "add" === n.value && (document.getElementById("rhr-modify-permalinks-edit-box").style.display = ""),
                                    document.querySelector(".components-notice__content a") && (document.querySelector(".components-notice__content a").href = "/" + e.rhr_permalink);
                            })(JSON.parse(e.responseText));
                    }),
                    e.open("GET", n.value + "wp-json/rhr-permalinks/v1/get-permalink/" + t, !0),
                    e.setRequestHeader("Cache-Control", "private, max-age=0, no-cache"),
                    e.setRequestHeader("X-WP-NONCE", wpApiSettings.nonce),
                    e.send()),
                (l = a);
        }
    }
    function m() {
        const e = document.getElementsByClassName("edit-post-post-link__preview-label");
        e && e[0] && e[0].parentNode.classList.add("cp-permalink-hidden");
    }
    document.addEventListener("DOMContentLoaded", function () {
        const e = document.getElementsByClassName("edit-post-post-link__preview-label");
        let t = 0;
        var n;
        const o = document.getElementById("rhr-modify-permalinks-edit-box"),
            a = document.getElementById("rhr-modify-permalinks-post-slug");
        let l = "",
            s = 0;
        if ((a && (a.addEventListener("focus", i), a.addEventListener("blur", d)), o && "" === document.querySelector("#rhr-modify-permalinks-edit-box .inside").innerHTML.trim() && (o.style.display = "none"), wp.data))
            for (
                n = document.getElementById("rhr-permalinks-add"),
                l = document.querySelectorAll(".edit-post-sidebar .components-panel__header"),
                l && l.length && (s = l.length),
                n && "add" === n.value && (o.style.display = "none"),
                r = wp.data.select("core/edit-post"),
                wp.data.subscribe(c),
                e && e[0] && e[0].parentNode.classList.add("cp-permalink-hidden"),
                o.classList.contains("closed") && o.classList.remove("closed");
                t < s;
            )
                l[t].addEventListener("click", m), (t += 1);
    });
})();
