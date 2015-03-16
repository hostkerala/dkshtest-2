﻿/*
 Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license
 */
CKEDITOR.dialog.add("uicolor", function (b) {
    function h(a) {
        /^#/.test(a) && (a = window.YAHOO.util.Color.hex2rgb(a.substr(1)));
        c.setValue(a, !0);
        c.refresh(e)
    }

    function f(a, j) {
        (j || d._.contents.tab1.livePeview.getValue()) && b.setUiColor(a);
        d._.contents.tab1.configBox.setValue('config.uiColor = "#' + c.get("hex") + '"')
    }

    var d, c, g = b.getUiColor(), e = "cke_uicolor_picker" + CKEDITOR.tools.getNextNumber(), i = !0;
    return{title: b.lang.uicolor.title, minWidth: 360, minHeight: 320, onLoad: function () {
        d = this;
        this.setupContent();
        CKEDITOR.env.ie7Compat &&
        d.parts.contents.setStyle("overflow", "hidden")
    }, contents: [
        {id: "tab1", label: "", title: "", expand: !0, padding: 0, elements: [
            {id: "yuiColorPicker", type: "html", html: "<div id='" + e + "' class='cke_uicolor_picker' style='width: 360px; height: 200px; position: relative;'></div>", onLoad: function () {
                var a = CKEDITOR.getUrl("plugins/uicolor/yui/");
                c = new window.YAHOO.widget.ColorPicker(e, {showhsvcontrols: !0, showhexcontrols: !0, images: {PICKER_THUMB: a + "assets/picker_thumb.png", HUE_THUMB: a + "assets/hue_thumb.png"}});
                g && h(g);
                c.on("rgbChange", function () {
                    d._.contents.tab1.predefined.setValue("");
                    f("#" + c.get("hex"))
                });
                for (var a = new CKEDITOR.dom.nodeList(c.getElementsByTagName("input")), b = 0; b < a.count(); b++)a.getItem(b).addClass("cke_dialog_ui_input_text")
            }},
            {id: "tab1", type: "vbox", children: [
                {id: "livePeview", type: "checkbox", label: b.lang.uicolor.preview, "default": 1, onLoad: function () {
                    i = !0
                }, onChange: function () {
                    if (!i) {
                        var a = this.getValue() ? "#" + c.get("hex") : g;
                        f(a, !0)
                    }
                }},
                {type: "hbox", children: [
                    {id: "predefined", type: "select", "default": "",
                        label: b.lang.uicolor.predefined, items: [
                        [""],
                        ["Light blue", "#9AB8F3"],
                        ["Sand", "#D2B48C"],
                        ["Metallic", "#949AAA"],
                        ["Purple", "#C2A3C7"],
                        ["Olive", "#A2C980"],
                        ["Happy green", "#9BD446"],
                        ["Jezebel Blue", "#14B8C4"],
                        ["Burn", "#FF893A"],
                        ["Easy red", "#FF6969"],
                        ["Pisces 3", "#48B4F2"],
                        ["Aquarius 5", "#487ED4"],
                        ["Absinthe", "#A8CF76"],
                        ["Scrambled Egg", "#C7A622"],
                        ["Hello monday", "#8E8D80"],
                        ["Lovely sunshine", "#F1E8B1"],
                        ["Recycled air", "#B3C593"],
                        ["Down", "#BCBCA4"],
                        ["Mark Twain", "#CFE91D"],
                        ["Specks of dust", "#D1B596"],
                        ["Lollipop", "#F6CE23"]
                    ], onChange: function () {
                        var a = this.getValue();
                        a ? (h(a), f(a), CKEDITOR.document.getById("predefinedPreview").setStyle("background", a)) : CKEDITOR.document.getById("predefinedPreview").setStyle("background", "")
                    }, onShow: function () {
                        var a = b.getUiColor();
                        a && this.setValue(a)
                    }},
                    {id: "predefinedPreview", type: "html", html: '<div id="cke_uicolor_preview" style="border: 1px solid black; padding: 3px; width: 30px;"><div id="predefinedPreview" style="width: 30px; height: 30px;">&nbsp;</div></div>'}
                ]},
                {id: "configBox", type: "text", label: b.lang.uicolor.config, onShow: function () {
                    var a = b.getUiColor();
                    a && this.setValue('config.uiColor = "' + a + '"')
                }}
            ]}
        ]}
    ], buttons: [CKEDITOR.dialog.okButton]}
});