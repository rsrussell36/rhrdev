(function ($) {
    $.ui.timepicker = $.ui.timepicker || {}; if ($.ui.timepicker.version) { return; }
    $.extend($.ui, { timepicker: { version: "1.5.0" } }); var Timepicker = function () { this.regional = []; this.regional[''] = { currentText: 'Now', closeText: 'Done', amNames: ['AM', 'A'], pmNames: ['PM', 'P'], timeFormat: 'HH:mm', timeSuffix: '', timeOnlyTitle: 'Choose Time', timeText: 'Time', hourText: 'Hour', minuteText: 'Minute', secondText: 'Second', millisecText: 'Millisecond', microsecText: 'Microsecond', timezoneText: 'Time Zone', isRTL: false }; this._defaults = { showButtonPanel: true, timeOnly: false, timeOnlyShowDate: false, showHour: null, showMinute: null, showSecond: null, showMillisec: null, showMicrosec: null, showTimezone: null, showTime: true, stepHour: 1, stepMinute: 1, stepSecond: 1, stepMillisec: 1, stepMicrosec: 1, hour: 0, minute: 0, second: 0, millisec: 0, microsec: 0, timezone: null, hourMin: 0, minuteMin: 0, secondMin: 0, millisecMin: 0, microsecMin: 0, hourMax: 23, minuteMax: 59, secondMax: 59, millisecMax: 999, microsecMax: 999, minDateTime: null, maxDateTime: null, maxTime: null, minTime: null, onSelect: null, hourGrid: 0, minuteGrid: 0, secondGrid: 0, millisecGrid: 0, microsecGrid: 0, alwaysSetTime: true, separator: ' ', altFieldTimeOnly: true, altTimeFormat: null, altSeparator: null, altTimeSuffix: null, altRedirectFocus: true, pickerTimeFormat: null, pickerTimeSuffix: null, showTimepicker: true, timezoneList: null, addSliderAccess: false, sliderAccessArgs: null, controlType: 'slider', defaultValue: null, parse: 'strict' }; $.extend(this._defaults, this.regional['']); }; $.extend(Timepicker.prototype, {
        $input: null, $altInput: null, $timeObj: null, inst: null, hour_slider: null, minute_slider: null, second_slider: null, millisec_slider: null, microsec_slider: null, timezone_select: null, maxTime: null, minTime: null, hour: 0, minute: 0, second: 0, millisec: 0, microsec: 0, timezone: null, hourMinOriginal: null, minuteMinOriginal: null, secondMinOriginal: null, millisecMinOriginal: null, microsecMinOriginal: null, hourMaxOriginal: null, minuteMaxOriginal: null, secondMaxOriginal: null, millisecMaxOriginal: null, microsecMaxOriginal: null, ampm: '', formattedDate: '', formattedTime: '', formattedDateTime: '', timezoneList: null, units: ['hour', 'minute', 'second', 'millisec', 'microsec'], support: {}, control: null, setDefaults: function (settings) { extendRemove(this._defaults, settings || {}); return this; }, _newInst: function ($input, opts) {
            var tp_inst = new Timepicker(), inlineSettings = {}, fns = {}, overrides, i; for (var attrName in this._defaults) { if (this._defaults.hasOwnProperty(attrName)) { var attrValue = $input.attr('time:' + attrName); if (attrValue) { try { inlineSettings[attrName] = eval(attrValue); } catch (err) { inlineSettings[attrName] = attrValue; } } } }
            overrides = {
                beforeShow: function (input, dp_inst) { if ($.isFunction(tp_inst._defaults.evnts.beforeShow)) { return tp_inst._defaults.evnts.beforeShow.call($input[0], input, dp_inst, tp_inst); } }, onChangeMonthYear: function (year, month, dp_inst) { tp_inst._updateDateTime(dp_inst); if ($.isFunction(tp_inst._defaults.evnts.onChangeMonthYear)) { tp_inst._defaults.evnts.onChangeMonthYear.call($input[0], year, month, dp_inst, tp_inst); } }, onClose: function (dateText, dp_inst) {
                    if (tp_inst.timeDefined === true && $input.val() !== '') { tp_inst._updateDateTime(dp_inst); }
                    if ($.isFunction(tp_inst._defaults.evnts.onClose)) { tp_inst._defaults.evnts.onClose.call($input[0], dateText, dp_inst, tp_inst); }
                }
            }; for (i in overrides) { if (overrides.hasOwnProperty(i)) { fns[i] = opts[i] || null; } }
            tp_inst._defaults = $.extend({}, this._defaults, inlineSettings, opts, overrides, { evnts: fns, timepicker: tp_inst }); tp_inst.amNames = $.map(tp_inst._defaults.amNames, function (val) { return val.toUpperCase(); }); tp_inst.pmNames = $.map(tp_inst._defaults.pmNames, function (val) { return val.toUpperCase(); }); tp_inst.support = detectSupport(tp_inst._defaults.timeFormat +
                (tp_inst._defaults.pickerTimeFormat ? tp_inst._defaults.pickerTimeFormat : '') +
                (tp_inst._defaults.altTimeFormat ? tp_inst._defaults.altTimeFormat : '')); if (typeof (tp_inst._defaults.controlType) === 'string') {
                    if (tp_inst._defaults.controlType === 'slider' && typeof ($.ui.slider) === 'undefined') { tp_inst._defaults.controlType = 'select'; }
                    tp_inst.control = tp_inst._controls[tp_inst._defaults.controlType];
                }
            else { tp_inst.control = tp_inst._defaults.controlType; }
            var timezoneList = [-720, -660, -600, -570, -540, -480, -420, -360, -300, -270, -240, -210, -180, -120, -60, 0, 60, 120, 180, 210, 240, 270, 300, 330, 345, 360, 390, 420, 480, 525, 540, 570, 600, 630, 660, 690, 720, 765, 780, 840]; if (tp_inst._defaults.timezoneList !== null) { timezoneList = tp_inst._defaults.timezoneList; }
            var tzl = timezoneList.length, tzi = 0, tzv = null; if (tzl > 0 && typeof timezoneList[0] !== 'object') { for (; tzi < tzl; tzi++) { tzv = timezoneList[tzi]; timezoneList[tzi] = { value: tzv, label: $.timepicker.timezoneOffsetString(tzv, tp_inst.support.iso8601) }; } }
            tp_inst._defaults.timezoneList = timezoneList; tp_inst.timezone = tp_inst._defaults.timezone !== null ? $.timepicker.timezoneOffsetNumber(tp_inst._defaults.timezone) : ((new Date()).getTimezoneOffset() * -1); tp_inst.hour = tp_inst._defaults.hour < tp_inst._defaults.hourMin ? tp_inst._defaults.hourMin : tp_inst._defaults.hour > tp_inst._defaults.hourMax ? tp_inst._defaults.hourMax : tp_inst._defaults.hour; tp_inst.minute = tp_inst._defaults.minute < tp_inst._defaults.minuteMin ? tp_inst._defaults.minuteMin : tp_inst._defaults.minute > tp_inst._defaults.minuteMax ? tp_inst._defaults.minuteMax : tp_inst._defaults.minute; tp_inst.second = tp_inst._defaults.second < tp_inst._defaults.secondMin ? tp_inst._defaults.secondMin : tp_inst._defaults.second > tp_inst._defaults.secondMax ? tp_inst._defaults.secondMax : tp_inst._defaults.second; tp_inst.millisec = tp_inst._defaults.millisec < tp_inst._defaults.millisecMin ? tp_inst._defaults.millisecMin : tp_inst._defaults.millisec > tp_inst._defaults.millisecMax ? tp_inst._defaults.millisecMax : tp_inst._defaults.millisec; tp_inst.microsec = tp_inst._defaults.microsec < tp_inst._defaults.microsecMin ? tp_inst._defaults.microsecMin : tp_inst._defaults.microsec > tp_inst._defaults.microsecMax ? tp_inst._defaults.microsecMax : tp_inst._defaults.microsec; tp_inst.ampm = ''; tp_inst.$input = $input; if (tp_inst._defaults.altField) { tp_inst.$altInput = $(tp_inst._defaults.altField); if (tp_inst._defaults.altRedirectFocus === true) { tp_inst.$altInput.css({ cursor: 'pointer' }).focus(function () { $input.trigger("focus"); }); } }
            if (tp_inst._defaults.minDate === 0 || tp_inst._defaults.minDateTime === 0) { tp_inst._defaults.minDate = new Date(); }
            if (tp_inst._defaults.maxDate === 0 || tp_inst._defaults.maxDateTime === 0) { tp_inst._defaults.maxDate = new Date(); }
            if (tp_inst._defaults.minDate !== undefined && tp_inst._defaults.minDate instanceof Date) { tp_inst._defaults.minDateTime = new Date(tp_inst._defaults.minDate.getTime()); }
            if (tp_inst._defaults.minDateTime !== undefined && tp_inst._defaults.minDateTime instanceof Date) { tp_inst._defaults.minDate = new Date(tp_inst._defaults.minDateTime.getTime()); }
            if (tp_inst._defaults.maxDate !== undefined && tp_inst._defaults.maxDate instanceof Date) { tp_inst._defaults.maxDateTime = new Date(tp_inst._defaults.maxDate.getTime()); }
            if (tp_inst._defaults.maxDateTime !== undefined && tp_inst._defaults.maxDateTime instanceof Date) { tp_inst._defaults.maxDate = new Date(tp_inst._defaults.maxDateTime.getTime()); }
            tp_inst.$input.bind('focus', function () { tp_inst._onFocus(); }); return tp_inst;
        }, _addTimePicker: function (dp_inst) { var currDT = (this.$altInput && this._defaults.altFieldTimeOnly) ? this.$input.val() + ' ' + this.$altInput.val() : this.$input.val(); this.timeDefined = this._parseTime(currDT); this._limitMinMaxDateTime(dp_inst, false); this._injectTimePicker(); }, _parseTime: function (timeString, withDate) {
            if (!this.inst) { this.inst = $.datepicker._getInst(this.$input[0]); }
            if (withDate || !this._defaults.timeOnly) {
                var dp_dateFormat = $.datepicker._get(this.inst, 'dateFormat'); try {
                    var parseRes = parseDateTimeInternal(dp_dateFormat, this._defaults.timeFormat, timeString, $.datepicker._getFormatConfig(this.inst), this._defaults); if (!parseRes.timeObj) { return false; }
                    $.extend(this, parseRes.timeObj);
                } catch (err) { $.timepicker.log("Error parsing the date/time string: " + err + "\ndate/time string = " + timeString + "\ntimeFormat = " + this._defaults.timeFormat + "\ndateFormat = " + dp_dateFormat); return false; }
                return true;
            } else {
                var timeObj = $.datepicker.parseTime(this._defaults.timeFormat, timeString, this._defaults); if (!timeObj) { return false; }
                $.extend(this, timeObj); return true;
            }
        }, _injectTimePicker: function () {
            var $dp = this.inst.dpDiv, o = this.inst.settings, tp_inst = this, litem = '', uitem = '', show = null, max = {}, gridSize = {}, size = null, i = 0, l = 0; if ($dp.find("div.ui-timepicker-div").length === 0 && o.showTimepicker) {
                var noDisplay = ' style="display:none;"', html = '<div class="ui-timepicker-div' + (o.isRTL ? ' ui-timepicker-rtl' : '') + '"><dl>' + '<dt class="ui_tpicker_time_label"' + ((o.showTime) ? '' : noDisplay) + '>' + o.timeText + '</dt>' + '<dd class="ui_tpicker_time"' + ((o.showTime) ? '' : noDisplay) + '></dd>'; for (i = 0, l = this.units.length; i < l; i++) {
                    litem = this.units[i]; uitem = litem.substr(0, 1).toUpperCase() + litem.substr(1); show = o['show' + uitem] !== null ? o['show' + uitem] : this.support[litem]; max[litem] = parseInt((o[litem + 'Max'] - ((o[litem + 'Max'] - o[litem + 'Min']) % o['step' + uitem])), 10); gridSize[litem] = 0; html += '<dt class="ui_tpicker_' + litem + '_label"' + (show ? '' : noDisplay) + '>' + o[litem + 'Text'] + '</dt>' + '<dd class="ui_tpicker_' + litem + '"><div class="ui_tpicker_' + litem + '_slider"' + (show ? '' : noDisplay) + '></div>'; if (show && o[litem + 'Grid'] > 0) {
                        html += '<div style="padding-left: 1px"><table class="ui-tpicker-grid-label"><tr>'; if (litem === 'hour') { for (var h = o[litem + 'Min']; h <= max[litem]; h += parseInt(o[litem + 'Grid'], 10)) { gridSize[litem]++; var tmph = $.datepicker.formatTime(this.support.ampm ? 'hht' : 'HH', { hour: h }, o); html += '<td data-for="' + litem + '">' + tmph + '</td>'; } }
                        else { for (var m = o[litem + 'Min']; m <= max[litem]; m += parseInt(o[litem + 'Grid'], 10)) { gridSize[litem]++; html += '<td data-for="' + litem + '">' + ((m < 10) ? '0' : '') + m + '</td>'; } }
                        html += '</tr></table></div>';
                    }
                    html += '</dd>';
                }
                var showTz = o.showTimezone !== null ? o.showTimezone : this.support.timezone; html += '<dt class="ui_tpicker_timezone_label"' + (showTz ? '' : noDisplay) + '>' + o.timezoneText + '</dt>'; html += '<dd class="ui_tpicker_timezone" ' + (showTz ? '' : noDisplay) + '></dd>'; html += '</dl></div>'; var $tp = $(html); if (o.timeOnly === true) { $tp.prepend('<div class="ui-widget-header ui-helper-clearfix ui-corner-all">' + '<div class="ui-datepicker-title">' + o.timeOnlyTitle + '</div>' + '</div>'); $dp.find('.ui-datepicker-header, .ui-datepicker-calendar').hide(); }
                for (i = 0, l = tp_inst.units.length; i < l; i++) {
                    litem = tp_inst.units[i]; uitem = litem.substr(0, 1).toUpperCase() + litem.substr(1); show = o['show' + uitem] !== null ? o['show' + uitem] : this.support[litem]; tp_inst[litem + '_slider'] = tp_inst.control.create(tp_inst, $tp.find('.ui_tpicker_' + litem + '_slider'), litem, tp_inst[litem], o[litem + 'Min'], max[litem], o['step' + uitem]); if (show && o[litem + 'Grid'] > 0) {
                        size = 100 * gridSize[litem] * o[litem + 'Grid'] / (max[litem] - o[litem + 'Min']); $tp.find('.ui_tpicker_' + litem + ' table').css({ width: size + "%", marginLeft: o.isRTL ? '0' : ((size / (-2 * gridSize[litem])) + "%"), marginRight: o.isRTL ? ((size / (-2 * gridSize[litem])) + "%") : '0', borderCollapse: 'collapse' }).find("td").click(function (e) {
                            var $t = $(this), h = $t.html(), n = parseInt(h.replace(/[^0-9]/g), 10), ap = h.replace(/[^apm]/ig), f = $t.data('for'); if (f === 'hour') {
                                if (ap.indexOf('p') !== -1 && n < 12) { n += 12; }
                                else { if (ap.indexOf('a') !== -1 && n === 12) { n = 0; } }
                            }
                            tp_inst.control.value(tp_inst, tp_inst[f + '_slider'], litem, n); tp_inst._onTimeChange(); tp_inst._onSelectHandler();
                        }).css({ cursor: 'pointer', width: (100 / gridSize[litem]) + '%', textAlign: 'center', overflow: 'hidden' });
                    }
                }
                this.timezone_select = $tp.find('.ui_tpicker_timezone').append('<select></select>').find("select"); $.fn.append.apply(this.timezone_select, $.map(o.timezoneList, function (val, idx) { return $("<option />").val(typeof val === "object" ? val.value : val).text(typeof val === "object" ? val.label : val); })); if (typeof (this.timezone) !== "undefined" && this.timezone !== null && this.timezone !== "") { var local_timezone = (new Date(this.inst.selectedYear, this.inst.selectedMonth, this.inst.selectedDay, 12)).getTimezoneOffset() * -1; if (local_timezone === this.timezone) { selectLocalTimezone(tp_inst); } else { this.timezone_select.val(this.timezone); } } else { if (typeof (this.hour) !== "undefined" && this.hour !== null && this.hour !== "") { this.timezone_select.val(o.timezone); } else { selectLocalTimezone(tp_inst); } }
                this.timezone_select.change(function () { tp_inst._onTimeChange(); tp_inst._onSelectHandler(); }); var $buttonPanel = $dp.find('.ui-datepicker-buttonpane'); if ($buttonPanel.length) { $buttonPanel.before($tp); } else { $dp.append($tp); }
                this.$timeObj = $tp.find('.ui_tpicker_time'); if (this.inst !== null) { var timeDefined = this.timeDefined; this._onTimeChange(); this.timeDefined = timeDefined; }
                if (this._defaults.addSliderAccess) { var sliderAccessArgs = this._defaults.sliderAccessArgs, rtl = this._defaults.isRTL; sliderAccessArgs.isRTL = rtl; setTimeout(function () { if ($tp.find('.ui-slider-access').length === 0) { $tp.find('.ui-slider:visible').sliderAccess(sliderAccessArgs); var sliderAccessWidth = $tp.find('.ui-slider-access:eq(0)').outerWidth(true); if (sliderAccessWidth) { $tp.find('table:visible').each(function () { var $g = $(this), oldWidth = $g.outerWidth(), oldMarginLeft = $g.css(rtl ? 'marginRight' : 'marginLeft').toString().replace('%', ''), newWidth = oldWidth - sliderAccessWidth, newMarginLeft = ((oldMarginLeft * newWidth) / oldWidth) + '%', css = { width: newWidth, marginRight: 0, marginLeft: 0 }; css[rtl ? 'marginRight' : 'marginLeft'] = newMarginLeft; $g.css(css); }); } } }, 10); }
                tp_inst._limitMinMaxDateTime(this.inst, true);
            }
        }, _limitMinMaxDateTime: function (dp_inst, adjustSliders) {
            var o = this._defaults, dp_date = new Date(dp_inst.selectedYear, dp_inst.selectedMonth, dp_inst.selectedDay); if (!this._defaults.showTimepicker) { return; }
            if ($.datepicker._get(dp_inst, 'minDateTime') !== null && $.datepicker._get(dp_inst, 'minDateTime') !== undefined && dp_date) {
                var minDateTime = $.datepicker._get(dp_inst, 'minDateTime'), minDateTimeDate = new Date(minDateTime.getFullYear(), minDateTime.getMonth(), minDateTime.getDate(), 0, 0, 0, 0); if (this.hourMinOriginal === null || this.minuteMinOriginal === null || this.secondMinOriginal === null || this.millisecMinOriginal === null || this.microsecMinOriginal === null) { this.hourMinOriginal = o.hourMin; this.minuteMinOriginal = o.minuteMin; this.secondMinOriginal = o.secondMin; this.millisecMinOriginal = o.millisecMin; this.microsecMinOriginal = o.microsecMin; }
                if (dp_inst.settings.timeOnly || minDateTimeDate.getTime() === dp_date.getTime()) {
                    this._defaults.hourMin = minDateTime.getHours(); if (this.hour <= this._defaults.hourMin) {
                        this.hour = this._defaults.hourMin; this._defaults.minuteMin = minDateTime.getMinutes(); if (this.minute <= this._defaults.minuteMin) {
                            this.minute = this._defaults.minuteMin; this._defaults.secondMin = minDateTime.getSeconds(); if (this.second <= this._defaults.secondMin) {
                                this.second = this._defaults.secondMin; this._defaults.millisecMin = minDateTime.getMilliseconds(); if (this.millisec <= this._defaults.millisecMin) { this.millisec = this._defaults.millisecMin; this._defaults.microsecMin = minDateTime.getMicroseconds(); } else {
                                    if (this.microsec < this._defaults.microsecMin) { this.microsec = this._defaults.microsecMin; }
                                    this._defaults.microsecMin = this.microsecMinOriginal;
                                }
                            } else { this._defaults.millisecMin = this.millisecMinOriginal; this._defaults.microsecMin = this.microsecMinOriginal; }
                        } else { this._defaults.secondMin = this.secondMinOriginal; this._defaults.millisecMin = this.millisecMinOriginal; this._defaults.microsecMin = this.microsecMinOriginal; }
                    } else { this._defaults.minuteMin = this.minuteMinOriginal; this._defaults.secondMin = this.secondMinOriginal; this._defaults.millisecMin = this.millisecMinOriginal; this._defaults.microsecMin = this.microsecMinOriginal; }
                } else { this._defaults.hourMin = this.hourMinOriginal; this._defaults.minuteMin = this.minuteMinOriginal; this._defaults.secondMin = this.secondMinOriginal; this._defaults.millisecMin = this.millisecMinOriginal; this._defaults.microsecMin = this.microsecMinOriginal; }
            }
            if ($.datepicker._get(dp_inst, 'maxDateTime') !== null && $.datepicker._get(dp_inst, 'maxDateTime') !== undefined && dp_date) {
                var maxDateTime = $.datepicker._get(dp_inst, 'maxDateTime'), maxDateTimeDate = new Date(maxDateTime.getFullYear(), maxDateTime.getMonth(), maxDateTime.getDate(), 0, 0, 0, 0); if (this.hourMaxOriginal === null || this.minuteMaxOriginal === null || this.secondMaxOriginal === null || this.millisecMaxOriginal === null) { this.hourMaxOriginal = o.hourMax; this.minuteMaxOriginal = o.minuteMax; this.secondMaxOriginal = o.secondMax; this.millisecMaxOriginal = o.millisecMax; this.microsecMaxOriginal = o.microsecMax; }
                if (dp_inst.settings.timeOnly || maxDateTimeDate.getTime() === dp_date.getTime()) {
                    this._defaults.hourMax = maxDateTime.getHours(); if (this.hour >= this._defaults.hourMax) {
                        this.hour = this._defaults.hourMax; this._defaults.minuteMax = maxDateTime.getMinutes(); if (this.minute >= this._defaults.minuteMax) {
                            this.minute = this._defaults.minuteMax; this._defaults.secondMax = maxDateTime.getSeconds(); if (this.second >= this._defaults.secondMax) {
                                this.second = this._defaults.secondMax; this._defaults.millisecMax = maxDateTime.getMilliseconds(); if (this.millisec >= this._defaults.millisecMax) { this.millisec = this._defaults.millisecMax; this._defaults.microsecMax = maxDateTime.getMicroseconds(); } else {
                                    if (this.microsec > this._defaults.microsecMax) { this.microsec = this._defaults.microsecMax; }
                                    this._defaults.microsecMax = this.microsecMaxOriginal;
                                }
                            } else { this._defaults.millisecMax = this.millisecMaxOriginal; this._defaults.microsecMax = this.microsecMaxOriginal; }
                        } else { this._defaults.secondMax = this.secondMaxOriginal; this._defaults.millisecMax = this.millisecMaxOriginal; this._defaults.microsecMax = this.microsecMaxOriginal; }
                    } else { this._defaults.minuteMax = this.minuteMaxOriginal; this._defaults.secondMax = this.secondMaxOriginal; this._defaults.millisecMax = this.millisecMaxOriginal; this._defaults.microsecMax = this.microsecMaxOriginal; }
                } else { this._defaults.hourMax = this.hourMaxOriginal; this._defaults.minuteMax = this.minuteMaxOriginal; this._defaults.secondMax = this.secondMaxOriginal; this._defaults.millisecMax = this.millisecMaxOriginal; this._defaults.microsecMax = this.microsecMaxOriginal; }
            }
            if (dp_inst.settings.minTime !== null) { var tempMinTime = new Date("01/01/1970 " + dp_inst.settings.minTime); if (this.hour < tempMinTime.getHours()) { this.hour = this._defaults.hourMin = tempMinTime.getHours(); this.minute = this._defaults.minuteMin = tempMinTime.getMinutes(); } else if (this.hour === tempMinTime.getHours() && this.minute < tempMinTime.getMinutes()) { this.minute = this._defaults.minuteMin = tempMinTime.getMinutes(); } else { if (this._defaults.hourMin < tempMinTime.getHours()) { this._defaults.hourMin = tempMinTime.getHours(); this._defaults.minuteMin = tempMinTime.getMinutes(); } else if (this._defaults.hourMin === tempMinTime.getHours() === this.hour && this._defaults.minuteMin < tempMinTime.getMinutes()) { this._defaults.minuteMin = tempMinTime.getMinutes(); } else { this._defaults.minuteMin = 0; } } }
            if (dp_inst.settings.maxTime !== null) { var tempMaxTime = new Date("01/01/1970 " + dp_inst.settings.maxTime); if (this.hour > tempMaxTime.getHours()) { this.hour = this._defaults.hourMax = tempMaxTime.getHours(); this.minute = this._defaults.minuteMax = tempMaxTime.getMinutes(); } else if (this.hour === tempMaxTime.getHours() && this.minute > tempMaxTime.getMinutes()) { this.minute = this._defaults.minuteMax = tempMaxTime.getMinutes(); } else { if (this._defaults.hourMax > tempMaxTime.getHours()) { this._defaults.hourMax = tempMaxTime.getHours(); this._defaults.minuteMax = tempMaxTime.getMinutes(); } else if (this._defaults.hourMax === tempMaxTime.getHours() === this.hour && this._defaults.minuteMax > tempMaxTime.getMinutes()) { this._defaults.minuteMax = tempMaxTime.getMinutes(); } else { this._defaults.minuteMax = 59; } } }
            if (adjustSliders !== undefined && adjustSliders === true) {
                var hourMax = parseInt((this._defaults.hourMax - ((this._defaults.hourMax - this._defaults.hourMin) % this._defaults.stepHour)), 10), minMax = parseInt((this._defaults.minuteMax - ((this._defaults.minuteMax - this._defaults.minuteMin) % this._defaults.stepMinute)), 10), secMax = parseInt((this._defaults.secondMax - ((this._defaults.secondMax - this._defaults.secondMin) % this._defaults.stepSecond)), 10), millisecMax = parseInt((this._defaults.millisecMax - ((this._defaults.millisecMax - this._defaults.millisecMin) % this._defaults.stepMillisec)), 10), microsecMax = parseInt((this._defaults.microsecMax - ((this._defaults.microsecMax - this._defaults.microsecMin) % this._defaults.stepMicrosec)), 10); if (this.hour_slider) { this.control.options(this, this.hour_slider, 'hour', { min: this._defaults.hourMin, max: hourMax, step: this._defaults.stepHour }); this.control.value(this, this.hour_slider, 'hour', this.hour - (this.hour % this._defaults.stepHour)); }
                if (this.minute_slider) { this.control.options(this, this.minute_slider, 'minute', { min: this._defaults.minuteMin, max: minMax, step: this._defaults.stepMinute }); this.control.value(this, this.minute_slider, 'minute', this.minute - (this.minute % this._defaults.stepMinute)); }
                if (this.second_slider) { this.control.options(this, this.second_slider, 'second', { min: this._defaults.secondMin, max: secMax, step: this._defaults.stepSecond }); this.control.value(this, this.second_slider, 'second', this.second - (this.second % this._defaults.stepSecond)); }
                if (this.millisec_slider) { this.control.options(this, this.millisec_slider, 'millisec', { min: this._defaults.millisecMin, max: millisecMax, step: this._defaults.stepMillisec }); this.control.value(this, this.millisec_slider, 'millisec', this.millisec - (this.millisec % this._defaults.stepMillisec)); }
                if (this.microsec_slider) { this.control.options(this, this.microsec_slider, 'microsec', { min: this._defaults.microsecMin, max: microsecMax, step: this._defaults.stepMicrosec }); this.control.value(this, this.microsec_slider, 'microsec', this.microsec - (this.microsec % this._defaults.stepMicrosec)); }
            }
        }, _onTimeChange: function () {
            if (!this._defaults.showTimepicker) { return; }
            var hour = (this.hour_slider) ? this.control.value(this, this.hour_slider, 'hour') : false, minute = (this.minute_slider) ? this.control.value(this, this.minute_slider, 'minute') : false, second = (this.second_slider) ? this.control.value(this, this.second_slider, 'second') : false, millisec = (this.millisec_slider) ? this.control.value(this, this.millisec_slider, 'millisec') : false, microsec = (this.microsec_slider) ? this.control.value(this, this.microsec_slider, 'microsec') : false, timezone = (this.timezone_select) ? this.timezone_select.val() : false, o = this._defaults, pickerTimeFormat = o.pickerTimeFormat || o.timeFormat, pickerTimeSuffix = o.pickerTimeSuffix || o.timeSuffix; if (typeof (hour) === 'object') { hour = false; }
            if (typeof (minute) === 'object') { minute = false; }
            if (typeof (second) === 'object') { second = false; }
            if (typeof (millisec) === 'object') { millisec = false; }
            if (typeof (microsec) === 'object') { microsec = false; }
            if (typeof (timezone) === 'object') { timezone = false; }
            if (hour !== false) { hour = parseInt(hour, 10); }
            if (minute !== false) { minute = parseInt(minute, 10); }
            if (second !== false) { second = parseInt(second, 10); }
            if (millisec !== false) { millisec = parseInt(millisec, 10); }
            if (microsec !== false) { microsec = parseInt(microsec, 10); }
            if (timezone !== false) { timezone = timezone.toString(); }
            var ampm = o[hour < 12 ? 'amNames' : 'pmNames'][0]; var hasChanged = (hour !== parseInt(this.hour, 10) || minute !== parseInt(this.minute, 10) || second !== parseInt(this.second, 10) || millisec !== parseInt(this.millisec, 10) || microsec !== parseInt(this.microsec, 10) || (this.ampm.length > 0 && (hour < 12) !== ($.inArray(this.ampm.toUpperCase(), this.amNames) !== -1)) || (this.timezone !== null && timezone !== this.timezone.toString())); if (hasChanged) {
                if (hour !== false) { this.hour = hour; }
                if (minute !== false) { this.minute = minute; }
                if (second !== false) { this.second = second; }
                if (millisec !== false) { this.millisec = millisec; }
                if (microsec !== false) { this.microsec = microsec; }
                if (timezone !== false) { this.timezone = timezone; }
                if (!this.inst) { this.inst = $.datepicker._getInst(this.$input[0]); }
                this._limitMinMaxDateTime(this.inst, true);
            }
            if (this.support.ampm) { this.ampm = ampm; }
            this.formattedTime = $.datepicker.formatTime(o.timeFormat, this, o); if (this.$timeObj) {
                if (pickerTimeFormat === o.timeFormat) { this.$timeObj.text(this.formattedTime + pickerTimeSuffix); }
                else { this.$timeObj.text($.datepicker.formatTime(pickerTimeFormat, this, o) + pickerTimeSuffix); }
            }
            this.timeDefined = true; if (hasChanged) { this._updateDateTime(); }
        }, _onSelectHandler: function () { var onSelect = this._defaults.onSelect || this.inst.settings.onSelect; var inputEl = this.$input ? this.$input[0] : null; if (onSelect && inputEl) { onSelect.apply(inputEl, [this.formattedDateTime, this]); } }, _updateDateTime: function (dp_inst) {
            dp_inst = this.inst || dp_inst; var dtTmp = (dp_inst.currentYear > 0 ? new Date(dp_inst.currentYear, dp_inst.currentMonth, dp_inst.currentDay) : new Date(dp_inst.selectedYear, dp_inst.selectedMonth, dp_inst.selectedDay)), dt = $.datepicker._daylightSavingAdjust(dtTmp), dateFmt = $.datepicker._get(dp_inst, 'dateFormat'), formatCfg = $.datepicker._getFormatConfig(dp_inst), timeAvailable = dt !== null && this.timeDefined; this.formattedDate = $.datepicker.formatDate(dateFmt, (dt === null ? new Date() : dt), formatCfg); var formattedDateTime = this.formattedDate; if (dp_inst.lastVal === "") { dp_inst.currentYear = dp_inst.selectedYear; dp_inst.currentMonth = dp_inst.selectedMonth; dp_inst.currentDay = dp_inst.selectedDay; }
            if (this._defaults.timeOnly === true && this._defaults.timeOnlyShowDate === false) { formattedDateTime = this.formattedTime; } else if ((this._defaults.timeOnly !== true && (this._defaults.alwaysSetTime || timeAvailable)) || (this._defaults.timeOnly === true && this._defaults.timeOnlyShowDate === true)) { formattedDateTime += this._defaults.separator + this.formattedTime + this._defaults.timeSuffix; }
            this.formattedDateTime = formattedDateTime; if (!this._defaults.showTimepicker) { this.$input.val(this.formattedDate); } else if (this.$altInput && this._defaults.timeOnly === false && this._defaults.altFieldTimeOnly === true) { this.$altInput.val(this.formattedTime); this.$input.val(this.formattedDate); } else if (this.$altInput) {
                this.$input.val(formattedDateTime); var altFormattedDateTime = '', altSeparator = this._defaults.altSeparator !== null ? this._defaults.altSeparator : this._defaults.separator, altTimeSuffix = this._defaults.altTimeSuffix !== null ? this._defaults.altTimeSuffix : this._defaults.timeSuffix; if (!this._defaults.timeOnly) {
                    if (this._defaults.altFormat) { altFormattedDateTime = $.datepicker.formatDate(this._defaults.altFormat, (dt === null ? new Date() : dt), formatCfg); }
                    else { altFormattedDateTime = this.formattedDate; }
                    if (altFormattedDateTime) { altFormattedDateTime += altSeparator; }
                }
                if (this._defaults.altTimeFormat !== null) { altFormattedDateTime += $.datepicker.formatTime(this._defaults.altTimeFormat, this, this._defaults) + altTimeSuffix; }
                else { altFormattedDateTime += this.formattedTime + altTimeSuffix; }
                this.$altInput.val(altFormattedDateTime);
            } else { this.$input.val(formattedDateTime); }
            this.$input.trigger("change");
        }, _onFocus: function () { if (!this.$input.val() && this._defaults.defaultValue) { this.$input.val(this._defaults.defaultValue); var inst = $.datepicker._getInst(this.$input.get(0)), tp_inst = $.datepicker._get(inst, 'timepicker'); if (tp_inst) { if (tp_inst._defaults.timeOnly && (inst.input.val() !== inst.lastVal)) { try { $.datepicker._updateDatepicker(inst); } catch (err) { $.timepicker.log(err); } } } } }, _controls: {
            slider: {
                create: function (tp_inst, obj, unit, val, min, max, step) { var rtl = tp_inst._defaults.isRTL; return obj.prop('slide', null).slider({ orientation: "horizontal", value: rtl ? val * -1 : val, min: rtl ? max * -1 : min, max: rtl ? min * -1 : max, step: step, slide: function (event, ui) { tp_inst.control.value(tp_inst, $(this), unit, rtl ? ui.value * -1 : ui.value); tp_inst._onTimeChange(); }, stop: function (event, ui) { tp_inst._onSelectHandler(); } }); }, options: function (tp_inst, obj, unit, opts, val) {
                    if (tp_inst._defaults.isRTL) {
                        if (typeof (opts) === 'string') {
                            if (opts === 'min' || opts === 'max') {
                                if (val !== undefined) { return obj.slider(opts, val * -1); }
                                return Math.abs(obj.slider(opts));
                            }
                            return obj.slider(opts);
                        }
                        var min = opts.min, max = opts.max; opts.min = opts.max = null; if (min !== undefined) { opts.max = min * -1; }
                        if (max !== undefined) { opts.min = max * -1; }
                        return obj.slider(opts);
                    }
                    if (typeof (opts) === 'string' && val !== undefined) { return obj.slider(opts, val); }
                    return obj.slider(opts);
                }, value: function (tp_inst, obj, unit, val) {
                    if (tp_inst._defaults.isRTL) {
                        if (val !== undefined) { return obj.slider('value', val * -1); }
                        return Math.abs(obj.slider('value'));
                    }
                    if (val !== undefined) { return obj.slider('value', val); }
                    return obj.slider('value');
                }
            }, select: {
                create: function (tp_inst, obj, unit, val, min, max, step) {
                    var sel = '<select class="ui-timepicker-select ui-state-default ui-corner-all" data-unit="' + unit + '" data-min="' + min + '" data-max="' + max + '" data-step="' + step + '">', format = tp_inst._defaults.pickerTimeFormat || tp_inst._defaults.timeFormat; for (var i = min; i <= max; i += step) {
                        sel += '<option value="' + i + '"' + (i === val ? ' selected' : '') + '>'; if (unit === 'hour') { sel += $.datepicker.formatTime($.trim(format.replace(/[^ht ]/ig, '')), { hour: i }, tp_inst._defaults); }
                        else if (unit === 'millisec' || unit === 'microsec' || i >= 10) { sel += i; }
                        else { sel += '0' + i.toString(); }
                        sel += '</option>';
                    }
                    sel += '</select>'; obj.children('select').remove(); $(sel).appendTo(obj).change(function (e) { tp_inst._onTimeChange(); tp_inst._onSelectHandler(); }); return obj;
                }, options: function (tp_inst, obj, unit, opts, val) {
                    var o = {}, $t = obj.children('select'); if (typeof (opts) === 'string') {
                        if (val === undefined) { return $t.data(opts); }
                        o[opts] = val;
                    }
                    else { o = opts; }
                    return tp_inst.control.create(tp_inst, obj, $t.data('unit'), $t.val(), o.min || $t.data('min'), o.max || $t.data('max'), o.step || $t.data('step'));
                }, value: function (tp_inst, obj, unit, val) {
                    var $t = obj.children('select'); if (val !== undefined) { return $t.val(val); }
                    return $t.val();
                }
            }
        }
    }); $.fn.extend({
        timepicker: function (o) {
            o = o || {}; var tmp_args = Array.prototype.slice.call(arguments); if (typeof o === 'object') { tmp_args[0] = $.extend(o, { timeOnly: true }); }
            return $(this).each(function () { $.fn.datetimepicker.apply($(this), tmp_args); });
        }, datetimepicker: function (o) { o = o || {}; var tmp_args = arguments; if (typeof (o) === 'string') { if (o === 'getDate' || (o === 'option' && tmp_args.length === 2 && typeof (tmp_args[1]) === 'string')) { return $.fn.datepicker.apply($(this[0]), tmp_args); } else { return this.each(function () { var $t = $(this); $t.datepicker.apply($t, tmp_args); }); } } else { return this.each(function () { var $t = $(this); $t.datepicker($.timepicker._newInst($t, o)._defaults); }); } }
    }); $.datepicker.parseDateTime = function (dateFormat, timeFormat, dateTimeString, dateSettings, timeSettings) {
        var parseRes = parseDateTimeInternal(dateFormat, timeFormat, dateTimeString, dateSettings, timeSettings); if (parseRes.timeObj) { var t = parseRes.timeObj; parseRes.date.setHours(t.hour, t.minute, t.second, t.millisec); parseRes.date.setMicroseconds(t.microsec); }
        return parseRes.date;
    }; $.datepicker.parseTime = function (timeFormat, timeString, options) {
        var o = extendRemove(extendRemove({}, $.timepicker._defaults), options || {}), iso8601 = (timeFormat.replace(/\'.*?\'/g, '').indexOf('Z') !== -1); var strictParse = function (f, s, o) {
            var getPatternAmpm = function (amNames, pmNames) {
                var markers = []; if (amNames) { $.merge(markers, amNames); }
                if (pmNames) { $.merge(markers, pmNames); }
                markers = $.map(markers, function (val) { return val.replace(/[.*+?|()\[\]{}\\]/g, '\\$&'); }); return '(' + markers.join('|') + ')?';
            }; var getFormatPositions = function (timeFormat) {
                var finds = timeFormat.toLowerCase().match(/(h{1,2}|m{1,2}|s{1,2}|l{1}|c{1}|t{1,2}|z|'.*?')/g), orders = { h: -1, m: -1, s: -1, l: -1, c: -1, t: -1, z: -1 }; if (finds) { for (var i = 0; i < finds.length; i++) { if (orders[finds[i].toString().charAt(0)] === -1) { orders[finds[i].toString().charAt(0)] = i + 1; } } }
                return orders;
            }; var regstr = '^' + f.toString().replace(/([hH]{1,2}|mm?|ss?|[tT]{1,2}|[zZ]|[lc]|'.*?')/g, function (match) { var ml = match.length; switch (match.charAt(0).toLowerCase()) { case 'h': return ml === 1 ? '(\\d?\\d)' : '(\\d{' + ml + '})'; case 'm': return ml === 1 ? '(\\d?\\d)' : '(\\d{' + ml + '})'; case 's': return ml === 1 ? '(\\d?\\d)' : '(\\d{' + ml + '})'; case 'l': return '(\\d?\\d?\\d)'; case 'c': return '(\\d?\\d?\\d)'; case 'z': return '(z|[-+]\\d\\d:?\\d\\d|\\S+)?'; case 't': return getPatternAmpm(o.amNames, o.pmNames); default: return '(' + match.replace(/\'/g, "").replace(/(\.|\$|\^|\\|\/|\(|\)|\[|\]|\?|\+|\*)/g, function (m) { return "\\" + m; }) + ')?'; } }).replace(/\s/g, '\\s?') +
                o.timeSuffix + '$', order = getFormatPositions(f), ampm = '', treg; treg = s.match(new RegExp(regstr, 'i')); var resTime = { hour: 0, minute: 0, second: 0, millisec: 0, microsec: 0 }; if (treg) {
                    if (order.t !== -1) { if (treg[order.t] === undefined || treg[order.t].length === 0) { ampm = ''; resTime.ampm = ''; } else { ampm = $.inArray(treg[order.t].toUpperCase(), o.amNames) !== -1 ? 'AM' : 'PM'; resTime.ampm = o[ampm === 'AM' ? 'amNames' : 'pmNames'][0]; } }
                    if (order.h !== -1) { if (ampm === 'AM' && treg[order.h] === '12') { resTime.hour = 0; } else { if (ampm === 'PM' && treg[order.h] !== '12') { resTime.hour = parseInt(treg[order.h], 10) + 12; } else { resTime.hour = Number(treg[order.h]); } } }
                    if (order.m !== -1) { resTime.minute = Number(treg[order.m]); }
                    if (order.s !== -1) { resTime.second = Number(treg[order.s]); }
                    if (order.l !== -1) { resTime.millisec = Number(treg[order.l]); }
                    if (order.c !== -1) { resTime.microsec = Number(treg[order.c]); }
                    if (order.z !== -1 && treg[order.z] !== undefined) { resTime.timezone = $.timepicker.timezoneOffsetNumber(treg[order.z]); }
                    return resTime;
                }
            return false;
        }; var looseParse = function (f, s, o) {
            try {
                var d = new Date('2012-01-01 ' + s); if (isNaN(d.getTime())) { d = new Date('2012-01-01T' + s); if (isNaN(d.getTime())) { d = new Date('01/01/2012 ' + s); if (isNaN(d.getTime())) { throw "Unable to parse time with native Date: " + s; } } }
                return { hour: d.getHours(), minute: d.getMinutes(), second: d.getSeconds(), millisec: d.getMilliseconds(), microsec: d.getMicroseconds(), timezone: d.getTimezoneOffset() * -1 };
            }
            catch (err) {
                try { return strictParse(f, s, o); }
                catch (err2) { $.timepicker.log("Unable to parse \ntimeString: " + s + "\ntimeFormat: " + f); }
            }
            return false;
        }; if (typeof o.parse === "function") { return o.parse(timeFormat, timeString, o); }
        if (o.parse === 'loose') { return looseParse(timeFormat, timeString, o); }
        return strictParse(timeFormat, timeString, o);
    }; $.datepicker.formatTime = function (format, time, options) {
        options = options || {}; options = $.extend({}, $.timepicker._defaults, options); time = $.extend({ hour: 0, minute: 0, second: 0, millisec: 0, microsec: 0, timezone: null }, time); var tmptime = format, ampmName = options.amNames[0], hour = parseInt(time.hour, 10); if (hour > 11) { ampmName = options.pmNames[0]; }
        tmptime = tmptime.replace(/(?:HH?|hh?|mm?|ss?|[tT]{1,2}|[zZ]|[lc]|'.*?')/g, function (match) { switch (match) { case 'HH': return ('0' + hour).slice(-2); case 'H': return hour; case 'hh': return ('0' + convert24to12(hour)).slice(-2); case 'h': return convert24to12(hour); case 'mm': return ('0' + time.minute).slice(-2); case 'm': return time.minute; case 'ss': return ('0' + time.second).slice(-2); case 's': return time.second; case 'l': return ('00' + time.millisec).slice(-3); case 'c': return ('00' + time.microsec).slice(-3); case 'z': return $.timepicker.timezoneOffsetString(time.timezone === null ? options.timezone : time.timezone, false); case 'Z': return $.timepicker.timezoneOffsetString(time.timezone === null ? options.timezone : time.timezone, true); case 'T': return ampmName.charAt(0).toUpperCase(); case 'TT': return ampmName.toUpperCase(); case 't': return ampmName.charAt(0).toLowerCase(); case 'tt': return ampmName.toLowerCase(); default: return match.replace(/'/g, ""); } }); return tmptime;
    }; $.datepicker._base_selectDate = $.datepicker._selectDate; $.datepicker._selectDate = function (id, dateStr) { var inst = this._getInst($(id)[0]), tp_inst = this._get(inst, 'timepicker'), was_inline; if (tp_inst && inst.settings.showTimepicker) { tp_inst._limitMinMaxDateTime(inst, true); was_inline = inst.inline; inst.inline = inst.stay_open = true; this._base_selectDate(id, dateStr); inst.inline = was_inline; inst.stay_open = false; this._notifyChange(inst); this._updateDatepicker(inst); } else { this._base_selectDate(id, dateStr); } }; $.datepicker._base_updateDatepicker = $.datepicker._updateDatepicker; $.datepicker._updateDatepicker = function (inst) {
        var input = inst.input[0]; if ($.datepicker._curInst && $.datepicker._curInst !== inst && $.datepicker._datepickerShowing && $.datepicker._lastInput !== input) { return; }
        if (typeof (inst.stay_open) !== 'boolean' || inst.stay_open === false) { this._base_updateDatepicker(inst); var tp_inst = this._get(inst, 'timepicker'); if (tp_inst) { tp_inst._addTimePicker(inst); } }
    }; $.datepicker._base_doKeyPress = $.datepicker._doKeyPress; $.datepicker._doKeyPress = function (event) {
        var inst = $.datepicker._getInst(event.target), tp_inst = $.datepicker._get(inst, 'timepicker'); if (tp_inst) {
            if ($.datepicker._get(inst, 'constrainInput')) {
                var ampm = tp_inst.support.ampm, tz = tp_inst._defaults.showTimezone !== null ? tp_inst._defaults.showTimezone : tp_inst.support.timezone, dateChars = $.datepicker._possibleChars($.datepicker._get(inst, 'dateFormat')), datetimeChars = tp_inst._defaults.timeFormat.toString().replace(/[hms]/g, '').replace(/TT/g, ampm ? 'APM' : '').replace(/Tt/g, ampm ? 'AaPpMm' : '').replace(/tT/g, ampm ? 'AaPpMm' : '').replace(/T/g, ampm ? 'AP' : '').replace(/tt/g, ampm ? 'apm' : '').replace(/t/g, ampm ? 'ap' : '') + " " + tp_inst._defaults.separator +
                    tp_inst._defaults.timeSuffix +
                    (tz ? tp_inst._defaults.timezoneList.join('') : '') +
                    (tp_inst._defaults.amNames.join('')) + (tp_inst._defaults.pmNames.join('')) +
                    dateChars, chr = String.fromCharCode(event.charCode === undefined ? event.keyCode : event.charCode); return event.ctrlKey || (chr < ' ' || !dateChars || datetimeChars.indexOf(chr) > -1);
            }
        }
        return $.datepicker._base_doKeyPress(event);
    }; $.datepicker._base_updateAlternate = $.datepicker._updateAlternate; $.datepicker._updateAlternate = function (inst) {
        var tp_inst = this._get(inst, 'timepicker'); if (tp_inst) {
            var altField = tp_inst._defaults.altField; if (altField) {
                var altFormat = tp_inst._defaults.altFormat || tp_inst._defaults.dateFormat, date = this._getDate(inst), formatCfg = $.datepicker._getFormatConfig(inst), altFormattedDateTime = '', altSeparator = tp_inst._defaults.altSeparator ? tp_inst._defaults.altSeparator : tp_inst._defaults.separator, altTimeSuffix = tp_inst._defaults.altTimeSuffix ? tp_inst._defaults.altTimeSuffix : tp_inst._defaults.timeSuffix, altTimeFormat = tp_inst._defaults.altTimeFormat !== null ? tp_inst._defaults.altTimeFormat : tp_inst._defaults.timeFormat; altFormattedDateTime += $.datepicker.formatTime(altTimeFormat, tp_inst, tp_inst._defaults) + altTimeSuffix; if (!tp_inst._defaults.timeOnly && !tp_inst._defaults.altFieldTimeOnly && date !== null) {
                    if (tp_inst._defaults.altFormat) { altFormattedDateTime = $.datepicker.formatDate(tp_inst._defaults.altFormat, date, formatCfg) + altSeparator + altFormattedDateTime; }
                    else { altFormattedDateTime = tp_inst.formattedDate + altSeparator + altFormattedDateTime; }
                }
                $(altField).val(inst.input.val() ? altFormattedDateTime : "");
            }
        }
        else { $.datepicker._base_updateAlternate(inst); }
    }; $.datepicker._base_doKeyUp = $.datepicker._doKeyUp; $.datepicker._doKeyUp = function (event) {
        var inst = $.datepicker._getInst(event.target), tp_inst = $.datepicker._get(inst, 'timepicker'); if (tp_inst) { if (tp_inst._defaults.timeOnly && (inst.input.val() !== inst.lastVal)) { try { $.datepicker._updateDatepicker(inst); } catch (err) { $.timepicker.log(err); } } }
        return $.datepicker._base_doKeyUp(event);
    }; $.datepicker._base_gotoToday = $.datepicker._gotoToday; $.datepicker._gotoToday = function (id) { var inst = this._getInst($(id)[0]), $dp = inst.dpDiv; this._base_gotoToday(id); var tp_inst = this._get(inst, 'timepicker'); selectLocalTimezone(tp_inst); var now = new Date(); this._setTime(inst, now); this._setDate(inst, now); }; $.datepicker._disableTimepickerDatepicker = function (target) {
        var inst = this._getInst(target); if (!inst) { return; }
        var tp_inst = this._get(inst, 'timepicker'); $(target).datepicker('getDate'); if (tp_inst) { inst.settings.showTimepicker = false; tp_inst._defaults.showTimepicker = false; tp_inst._updateDateTime(inst); }
    }; $.datepicker._enableTimepickerDatepicker = function (target) {
        var inst = this._getInst(target); if (!inst) { return; }
        var tp_inst = this._get(inst, 'timepicker'); $(target).datepicker('getDate'); if (tp_inst) { inst.settings.showTimepicker = true; tp_inst._defaults.showTimepicker = true; tp_inst._addTimePicker(inst); tp_inst._updateDateTime(inst); }
    }; $.datepicker._setTime = function (inst, date) { var tp_inst = this._get(inst, 'timepicker'); if (tp_inst) { var defaults = tp_inst._defaults; tp_inst.hour = date ? date.getHours() : defaults.hour; tp_inst.minute = date ? date.getMinutes() : defaults.minute; tp_inst.second = date ? date.getSeconds() : defaults.second; tp_inst.millisec = date ? date.getMilliseconds() : defaults.millisec; tp_inst.microsec = date ? date.getMicroseconds() : defaults.microsec; tp_inst._limitMinMaxDateTime(inst, true); tp_inst._onTimeChange(); tp_inst._updateDateTime(inst); } }; $.datepicker._setTimeDatepicker = function (target, date, withDate) {
        var inst = this._getInst(target); if (!inst) { return; }
        var tp_inst = this._get(inst, 'timepicker'); if (tp_inst) {
            this._setDateFromField(inst); var tp_date; if (date) {
                if (typeof date === "string") { tp_inst._parseTime(date, withDate); tp_date = new Date(); tp_date.setHours(tp_inst.hour, tp_inst.minute, tp_inst.second, tp_inst.millisec); tp_date.setMicroseconds(tp_inst.microsec); } else { tp_date = new Date(date.getTime()); tp_date.setMicroseconds(date.getMicroseconds()); }
                if (tp_date.toString() === 'Invalid Date') { tp_date = undefined; }
                this._setTime(inst, tp_date);
            }
        }
    }; $.datepicker._base_setDateDatepicker = $.datepicker._setDateDatepicker; $.datepicker._setDateDatepicker = function (target, _date) {
        var inst = this._getInst(target); var date = _date; if (!inst) { return; }
        if (typeof (_date) === 'string') { date = new Date(_date); if (!date.getTime()) { this._base_setDateDatepicker.apply(this, arguments); date = $(target).datepicker('getDate'); } }
        var tp_inst = this._get(inst, 'timepicker'); var tp_date; if (date instanceof Date) { tp_date = new Date(date.getTime()); tp_date.setMicroseconds(date.getMicroseconds()); } else { tp_date = date; }
        if (tp_inst && tp_date) {
            if (!tp_inst.support.timezone && tp_inst._defaults.timezone === null) { tp_inst.timezone = tp_date.getTimezoneOffset() * -1; }
            date = $.timepicker.timezoneAdjust(date, tp_inst.timezone); tp_date = $.timepicker.timezoneAdjust(tp_date, tp_inst.timezone);
        }
        this._updateDatepicker(inst); this._base_setDateDatepicker.apply(this, arguments); this._setTimeDatepicker(target, tp_date, true);
    }; $.datepicker._base_getDateDatepicker = $.datepicker._getDateDatepicker; $.datepicker._getDateDatepicker = function (target, noDefault) {
        var inst = this._getInst(target); if (!inst) { return; }
        var tp_inst = this._get(inst, 'timepicker'); if (tp_inst) {
            if (inst.lastVal === undefined) { this._setDateFromField(inst, noDefault); }
            var date = this._getDate(inst); if (date && tp_inst._parseTime($(target).val(), tp_inst.timeOnly)) {
                date.setHours(tp_inst.hour, tp_inst.minute, tp_inst.second, tp_inst.millisec); date.setMicroseconds(tp_inst.microsec); if (tp_inst.timezone != null) {
                    if (!tp_inst.support.timezone && tp_inst._defaults.timezone === null) { tp_inst.timezone = date.getTimezoneOffset() * -1; }
                    date = $.timepicker.timezoneAdjust(date, tp_inst.timezone);
                }
            }
            return date;
        }
        return this._base_getDateDatepicker(target, noDefault);
    }; $.datepicker._base_parseDate = $.datepicker.parseDate; $.datepicker.parseDate = function (format, value, settings) {
        var date; try { date = this._base_parseDate(format, value, settings); } catch (err) { if (err.indexOf(":") >= 0) { date = this._base_parseDate(format, value.substring(0, value.length - (err.length - err.indexOf(':') - 2)), settings); $.timepicker.log("Error parsing the date string: " + err + "\ndate string = " + value + "\ndate format = " + format); } else { throw err; } }
        return date;
    }; $.datepicker._base_formatDate = $.datepicker._formatDate; $.datepicker._formatDate = function (inst, day, month, year) {
        var tp_inst = this._get(inst, 'timepicker'); if (tp_inst) { tp_inst._updateDateTime(inst); return tp_inst.$input.val(); }
        return this._base_formatDate(inst);
    }; $.datepicker._base_optionDatepicker = $.datepicker._optionDatepicker; $.datepicker._optionDatepicker = function (target, name, value) {
        var inst = this._getInst(target), name_clone; if (!inst) { return null; }
        var tp_inst = this._get(inst, 'timepicker'); if (tp_inst) {
            var min = null, max = null, onselect = null, overrides = tp_inst._defaults.evnts, fns = {}, prop, ret, oldVal, $target; if (typeof name === 'string') {
                if (name === 'minDate' || name === 'minDateTime') { min = value; } else if (name === 'maxDate' || name === 'maxDateTime') { max = value; } else if (name === 'onSelect') { onselect = value; } else if (overrides.hasOwnProperty(name)) {
                    if (typeof (value) === 'undefined') { return overrides[name]; }
                    fns[name] = value; name_clone = {};
                }
            } else if (typeof name === 'object') {
                if (name.minDate) { min = name.minDate; } else if (name.minDateTime) { min = name.minDateTime; } else if (name.maxDate) { max = name.maxDate; } else if (name.maxDateTime) { max = name.maxDateTime; }
                for (prop in overrides) { if (overrides.hasOwnProperty(prop) && name[prop]) { fns[prop] = name[prop]; } }
            }
            for (prop in fns) {
                if (fns.hasOwnProperty(prop)) {
                    overrides[prop] = fns[prop]; if (!name_clone) { name_clone = $.extend({}, name); }
                    delete name_clone[prop];
                }
            }
            if (name_clone && isEmptyObject(name_clone)) { return; }
            if (min) {
                if (min === 0) { min = new Date(); } else { min = new Date(min); }
                tp_inst._defaults.minDate = min; tp_inst._defaults.minDateTime = min;
            } else if (max) {
                if (max === 0) { max = new Date(); } else { max = new Date(max); }
                tp_inst._defaults.maxDate = max; tp_inst._defaults.maxDateTime = max;
            } else if (onselect) { tp_inst._defaults.onSelect = onselect; }
            if (min || max) { $target = $(target); oldVal = $target.datetimepicker('getDate'); ret = this._base_optionDatepicker.call($.datepicker, target, name_clone || name, value); $target.datetimepicker('setDate', oldVal); return ret; }
        }
        if (value === undefined) { return this._base_optionDatepicker.call($.datepicker, target, name); }
        return this._base_optionDatepicker.call($.datepicker, target, name_clone || name, value);
    }; var isEmptyObject = function (obj) {
        var prop; for (prop in obj) { if (obj.hasOwnProperty(prop)) { return false; } }
        return true;
    }; var extendRemove = function (target, props) {
        $.extend(target, props); for (var name in props) { if (props[name] === null || props[name] === undefined) { target[name] = props[name]; } }
        return target;
    }; var detectSupport = function (timeFormat) { var tf = timeFormat.replace(/'.*?'/g, '').toLowerCase(), isIn = function (f, t) { return f.indexOf(t) !== -1 ? true : false; }; return { hour: isIn(tf, 'h'), minute: isIn(tf, 'm'), second: isIn(tf, 's'), millisec: isIn(tf, 'l'), microsec: isIn(tf, 'c'), timezone: isIn(tf, 'z'), ampm: isIn(tf, 't') && isIn(timeFormat, 'h'), iso8601: isIn(timeFormat, 'Z') }; }; var convert24to12 = function (hour) {
        hour %= 12; if (hour === 0) { hour = 12; }
        return String(hour);
    }; var computeEffectiveSetting = function (settings, property) { return settings && settings[property] ? settings[property] : $.timepicker._defaults[property]; }; var splitDateTime = function (dateTimeString, timeSettings) {
        var separator = computeEffectiveSetting(timeSettings, 'separator'), format = computeEffectiveSetting(timeSettings, 'timeFormat'), timeParts = format.split(separator), timePartsLen = timeParts.length, allParts = dateTimeString.split(separator), allPartsLen = allParts.length; if (allPartsLen > 1) { return { dateString: allParts.splice(0, allPartsLen - timePartsLen).join(separator), timeString: allParts.splice(0, timePartsLen).join(separator) }; }
        return { dateString: dateTimeString, timeString: '' };
    }; var parseDateTimeInternal = function (dateFormat, timeFormat, dateTimeString, dateSettings, timeSettings) {
        var date, parts, parsedTime; parts = splitDateTime(dateTimeString, timeSettings); date = $.datepicker._base_parseDate(dateFormat, parts.dateString, dateSettings); if (parts.timeString === '') { return { date: date }; }
        parsedTime = $.datepicker.parseTime(timeFormat, parts.timeString, timeSettings); if (!parsedTime) { throw 'Wrong time format'; }
        return { date: date, timeObj: parsedTime };
    }; var selectLocalTimezone = function (tp_inst, date) { if (tp_inst && tp_inst.timezone_select) { var now = date || new Date(); tp_inst.timezone_select.val(-now.getTimezoneOffset()); } }; $.timepicker = new Timepicker(); $.timepicker.timezoneOffsetString = function (tzMinutes, iso8601) {
        if (isNaN(tzMinutes) || tzMinutes > 840 || tzMinutes < -720) { return tzMinutes; }
        var off = tzMinutes, minutes = off % 60, hours = (off - minutes) / 60, iso = iso8601 ? ':' : '', tz = (off >= 0 ? '+' : '-') + ('0' + Math.abs(hours)).slice(-2) + iso + ('0' + Math.abs(minutes)).slice(-2); if (tz === '+00:00') { return 'Z'; }
        return tz;
    }; $.timepicker.timezoneOffsetNumber = function (tzString) {
        var normalized = tzString.toString().replace(':', ''); if (normalized.toUpperCase() === 'Z') { return 0; }
        if (!/^(\-|\+)\d{4}$/.test(normalized)) { return tzString; }
        return ((normalized.substr(0, 1) === '-' ? -1 : 1) * ((parseInt(normalized.substr(1, 2), 10) * 60) +
            parseInt(normalized.substr(3, 2), 10)));
    }; $.timepicker.timezoneAdjust = function (date, toTimezone) {
        var toTz = $.timepicker.timezoneOffsetNumber(toTimezone); if (!isNaN(toTz)) { date.setMinutes(date.getMinutes() + -date.getTimezoneOffset() - toTz); }
        return date;
    }; $.timepicker.timeRange = function (startTime, endTime, options) { return $.timepicker.handleRange('timepicker', startTime, endTime, options); }; $.timepicker.datetimeRange = function (startTime, endTime, options) { $.timepicker.handleRange('datetimepicker', startTime, endTime, options); }; $.timepicker.dateRange = function (startTime, endTime, options) { $.timepicker.handleRange('datepicker', startTime, endTime, options); }; $.timepicker.handleRange = function (method, startTime, endTime, options) {
        options = $.extend({}, { minInterval: 0, maxInterval: 0, start: {}, end: {} }, options); var timeOnly = false; if (method === 'timepicker') { timeOnly = true; method = 'datetimepicker'; }
        function checkDates(changed, other) {
            var startdt = startTime[method]('getDate'), enddt = endTime[method]('getDate'), changeddt = changed[method]('getDate'); if (startdt !== null) {
                var minDate = new Date(startdt.getTime()), maxDate = new Date(startdt.getTime()); minDate.setMilliseconds(minDate.getMilliseconds() + options.minInterval); maxDate.setMilliseconds(maxDate.getMilliseconds() + options.maxInterval); if (options.minInterval > 0 && minDate > enddt) { endTime[method]('setDate', minDate); }
                else if (options.maxInterval > 0 && maxDate < enddt) { endTime[method]('setDate', maxDate); }
                else if (startdt > enddt) { other[method]('setDate', changeddt); }
            }
        }
        function selected(changed, other, option) {
            if (!changed.val()) { return; }
            var date = changed[method].call(changed, 'getDate'); if (date !== null && options.minInterval > 0) {
                if (option === 'minDate') { date.setMilliseconds(date.getMilliseconds() + options.minInterval); }
                if (option === 'maxDate') { date.setMilliseconds(date.getMilliseconds() - options.minInterval); }
            }
            if (date.getTime) { other[method].call(other, 'option', option, date); }
        }
        $.fn[method].call(startTime, $.extend({ timeOnly: timeOnly, onClose: function (dateText, inst) { checkDates($(this), endTime); }, onSelect: function (selectedDateTime) { selected($(this), endTime, 'minDate'); } }, options, options.start)); $.fn[method].call(endTime, $.extend({ timeOnly: timeOnly, onClose: function (dateText, inst) { checkDates($(this), startTime); }, onSelect: function (selectedDateTime) { selected($(this), startTime, 'maxDate'); } }, options, options.end)); checkDates(startTime, endTime); selected(startTime, endTime, 'minDate'); selected(endTime, startTime, 'maxDate'); return $([startTime.get(0), endTime.get(0)]);
    }; $.timepicker.log = function () { if (window.console) { window.console.log.apply(window.console, Array.prototype.slice.call(arguments)); } }; $.timepicker._util = { _extendRemove: extendRemove, _isEmptyObject: isEmptyObject, _convert24to12: convert24to12, _detectSupport: detectSupport, _selectLocalTimezone: selectLocalTimezone, _computeEffectiveSetting: computeEffectiveSetting, _splitDateTime: splitDateTime, _parseDateTimeInternal: parseDateTimeInternal }; if (!Date.prototype.getMicroseconds) { Date.prototype.microseconds = 0; Date.prototype.getMicroseconds = function () { return this.microseconds; }; Date.prototype.setMicroseconds = function (m) { this.setMilliseconds(this.getMilliseconds() + Math.floor(m / 1000)); this.microseconds = m % 1000; return this; }; }
    $.timepicker.version = "1.5.0";
})(jQuery);

// Easy Responsive Tabs Plugin
// Author: Samson.Onna <Email : samson3d@gmail.com>
!function (a) { a.fn.extend({ easyResponsiveTabs: function (t) { var e = { type: "default", width: "auto", fit: !0, closed: !1, activate: function () { } }, t = a.extend(e, t), s = t, i = s.type, n = s.fit, r = s.width, c = "vertical", o = "accordion", d = window.location.hash, l = !(!window.history || !history.replaceState); a(this).bind("tabactivate", function (a, e) { "function" == typeof t.activate && t.activate.call(e, a) }), this.each(function () { function e() { i == c && s.addClass("resp-vtabs"), 1 == n && s.css({ width: "100%", margin: "0px" }), i == o && (s.addClass("resp-easy-accordion"), s.find(".resp-tabs-list").css("display", "none")) } var s = a(this), p = s.find("ul.resp-tabs-list"), b = s.attr("id"); s.find("ul.resp-tabs-list li").addClass("resp-tab-item"), s.css({ display: "block", width: r }), s.find(".resp-tabs-container > div").addClass("resp-tab-content"), e(); var v; s.find(".resp-tab-content").before("<h2 class='resp-accordion' role='tab'><span class='resp-arrow'></span></h2>"); var f = 0; s.find(".resp-accordion").each(function () { v = a(this); var t = s.find(".resp-tab-item:eq(" + f + ")"), e = s.find(".resp-accordion:eq(" + f + ")"); e.append(t.html()), e.data(t.data()), v.attr("aria-controls", "tab_item-" + f), f++ }); var h, u = 0; s.find(".resp-tab-item").each(function () { $tabItem = a(this), $tabItem.attr("aria-controls", "tab_item-" + u), $tabItem.attr("role", "tab"); var t = 0; s.find(".resp-tab-content").each(function () { h = a(this), h.attr("aria-labelledby", "tab_item-" + t), t++ }), u++ }); var C = 0; if ("" != d) { var m = d.match(new RegExp(b + "([0-9]+)")); null !== m && 2 === m.length && (C = parseInt(m[1], 10) - 1, C > u && (C = 0)) } a(s.find(".resp-tab-item")[C]).addClass("resp-tab-active"), t.closed === !0 || "accordion" === t.closed && !p.is(":visible") || "tabs" === t.closed && p.is(":visible") ? a(s.find(".resp-tab-content")[C]).addClass("resp-tab-content-active resp-accordion-closed") : (a(s.find(".resp-accordion")[C]).addClass("resp-tab-active"), a(s.find(".resp-tab-content")[C]).addClass("resp-tab-content-active").attr("style", "display:block")), s.find("[role=tab]").each(function () { var t = a(this); t.click(function () { var t = a(this), e = t.attr("aria-controls"); if (t.hasClass("resp-accordion") && t.hasClass("resp-tab-active")) return s.find(".resp-tab-content-active").slideUp("", function () { a(this).addClass("resp-accordion-closed") }), t.removeClass("resp-tab-active"), !1; if (!t.hasClass("resp-tab-active") && t.hasClass("resp-accordion") ? (s.find(".resp-tab-active").removeClass("resp-tab-active"), s.find(".resp-tab-content-active").slideUp().removeClass("resp-tab-content-active resp-accordion-closed"), s.find("[aria-controls=" + e + "]").addClass("resp-tab-active"), s.find(".resp-tab-content[aria-labelledby = " + e + "]").slideDown().addClass("resp-tab-content-active")) : (s.find(".resp-tab-active").removeClass("resp-tab-active"), s.find(".resp-tab-content-active").removeAttr("style").removeClass("resp-tab-content-active").removeClass("resp-accordion-closed"), s.find("[aria-controls=" + e + "]").addClass("resp-tab-active"), s.find(".resp-tab-content[aria-labelledby = " + e + "]").addClass("resp-tab-content-active").attr("style", "display:block")), t.trigger("tabactivate", t), l) { var i = window.location.hash, n = b + (parseInt(e.substring(9), 10) + 1).toString(); if ("" != i) { var r = new RegExp(b + "[0-9]+"); n = null != i.match(r) ? i.replace(r, n) : i + "|" + n } else n = "#" + n; history.replaceState(null, null, n) } }) }), a(window).resize(function () { s.find(".resp-accordion-closed").removeAttr("style") }) }) } }) }(jQuery);

!function (e, t) { "object" == typeof exports && "undefined" != typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define(t) : e.moment = t() }(this, function () { "use strict"; var e, i; function c() { return e.apply(null, arguments) } function o(e) { return e instanceof Array || "[object Array]" === Object.prototype.toString.call(e) } function u(e) { return null != e && "[object Object]" === Object.prototype.toString.call(e) } function l(e) { return void 0 === e } function d(e) { return "number" == typeof e || "[object Number]" === Object.prototype.toString.call(e) } function h(e) { return e instanceof Date || "[object Date]" === Object.prototype.toString.call(e) } function f(e, t) { var n, s = []; for (n = 0; n < e.length; ++n)s.push(t(e[n], n)); return s } function m(e, t) { return Object.prototype.hasOwnProperty.call(e, t) } function _(e, t) { for (var n in t) m(t, n) && (e[n] = t[n]); return m(t, "toString") && (e.toString = t.toString), m(t, "valueOf") && (e.valueOf = t.valueOf), e } function y(e, t, n, s) { return Ot(e, t, n, s, !0).utc() } function g(e) { return null == e._pf && (e._pf = { empty: !1, unusedTokens: [], unusedInput: [], overflow: -2, charsLeftOver: 0, nullInput: !1, invalidMonth: null, invalidFormat: !1, userInvalidated: !1, iso: !1, parsedDateParts: [], meridiem: null, rfc2822: !1, weekdayMismatch: !1 }), e._pf } function p(e) { if (null == e._isValid) { var t = g(e), n = i.call(t.parsedDateParts, function (e) { return null != e }), s = !isNaN(e._d.getTime()) && t.overflow < 0 && !t.empty && !t.invalidMonth && !t.invalidWeekday && !t.weekdayMismatch && !t.nullInput && !t.invalidFormat && !t.userInvalidated && (!t.meridiem || t.meridiem && n); if (e._strict && (s = s && 0 === t.charsLeftOver && 0 === t.unusedTokens.length && void 0 === t.bigHour), null != Object.isFrozen && Object.isFrozen(e)) return s; e._isValid = s } return e._isValid } function v(e) { var t = y(NaN); return null != e ? _(g(t), e) : g(t).userInvalidated = !0, t } i = Array.prototype.some ? Array.prototype.some : function (e) { for (var t = Object(this), n = t.length >>> 0, s = 0; s < n; s++)if (s in t && e.call(this, t[s], s, t)) return !0; return !1 }; var r = c.momentProperties = []; function w(e, t) { var n, s, i; if (l(t._isAMomentObject) || (e._isAMomentObject = t._isAMomentObject), l(t._i) || (e._i = t._i), l(t._f) || (e._f = t._f), l(t._l) || (e._l = t._l), l(t._strict) || (e._strict = t._strict), l(t._tzm) || (e._tzm = t._tzm), l(t._isUTC) || (e._isUTC = t._isUTC), l(t._offset) || (e._offset = t._offset), l(t._pf) || (e._pf = g(t)), l(t._locale) || (e._locale = t._locale), 0 < r.length) for (n = 0; n < r.length; n++)l(i = t[s = r[n]]) || (e[s] = i); return e } var t = !1; function M(e) { w(this, e), this._d = new Date(null != e._d ? e._d.getTime() : NaN), this.isValid() || (this._d = new Date(NaN)), !1 === t && (t = !0, c.updateOffset(this), t = !1) } function S(e) { return e instanceof M || null != e && null != e._isAMomentObject } function D(e) { return e < 0 ? Math.ceil(e) || 0 : Math.floor(e) } function k(e) { var t = +e, n = 0; return 0 !== t && isFinite(t) && (n = D(t)), n } function a(e, t, n) { var s, i = Math.min(e.length, t.length), r = Math.abs(e.length - t.length), a = 0; for (s = 0; s < i; s++)(n && e[s] !== t[s] || !n && k(e[s]) !== k(t[s])) && a++; return a + r } function Y(e) { !1 === c.suppressDeprecationWarnings && "undefined" != typeof console && console.warn && console.warn("Deprecation warning: " + e) } function n(i, r) { var a = !0; return _(function () { if (null != c.deprecationHandler && c.deprecationHandler(null, i), a) { for (var e, t = [], n = 0; n < arguments.length; n++) { if (e = "", "object" == typeof arguments[n]) { for (var s in e += "\n[" + n + "] ", arguments[0]) e += s + ": " + arguments[0][s] + ", "; e = e.slice(0, -2) } else e = arguments[n]; t.push(e) } Y(i + "\nArguments: " + Array.prototype.slice.call(t).join("") + "\n" + (new Error).stack), a = !1 } return r.apply(this, arguments) }, r) } var s, O = {}; function T(e, t) { null != c.deprecationHandler && c.deprecationHandler(e, t), O[e] || (Y(t), O[e] = !0) } function x(e) { return e instanceof Function || "[object Function]" === Object.prototype.toString.call(e) } function b(e, t) { var n, s = _({}, e); for (n in t) m(t, n) && (u(e[n]) && u(t[n]) ? (s[n] = {}, _(s[n], e[n]), _(s[n], t[n])) : null != t[n] ? s[n] = t[n] : delete s[n]); for (n in e) m(e, n) && !m(t, n) && u(e[n]) && (s[n] = _({}, s[n])); return s } function P(e) { null != e && this.set(e) } c.suppressDeprecationWarnings = !1, c.deprecationHandler = null, s = Object.keys ? Object.keys : function (e) { var t, n = []; for (t in e) m(e, t) && n.push(t); return n }; var W = {}; function H(e, t) { var n = e.toLowerCase(); W[n] = W[n + "s"] = W[t] = e } function R(e) { return "string" == typeof e ? W[e] || W[e.toLowerCase()] : void 0 } function C(e) { var t, n, s = {}; for (n in e) m(e, n) && (t = R(n)) && (s[t] = e[n]); return s } var F = {}; function L(e, t) { F[e] = t } function U(e, t, n) { var s = "" + Math.abs(e), i = t - s.length; return (0 <= e ? n ? "+" : "" : "-") + Math.pow(10, Math.max(0, i)).toString().substr(1) + s } var N = /(\[[^\[]*\])|(\\)?([Hh]mm(ss)?|Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Qo?|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|kk?|mm?|ss?|S{1,9}|x|X|zz?|ZZ?|.)/g, G = /(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g, V = {}, E = {}; function I(e, t, n, s) { var i = s; "string" == typeof s && (i = function () { return this[s]() }), e && (E[e] = i), t && (E[t[0]] = function () { return U(i.apply(this, arguments), t[1], t[2]) }), n && (E[n] = function () { return this.localeData().ordinal(i.apply(this, arguments), e) }) } function A(e, t) { return e.isValid() ? (t = j(t, e.localeData()), V[t] = V[t] || function (s) { var e, i, t, r = s.match(N); for (e = 0, i = r.length; e < i; e++)E[r[e]] ? r[e] = E[r[e]] : r[e] = (t = r[e]).match(/\[[\s\S]/) ? t.replace(/^\[|\]$/g, "") : t.replace(/\\/g, ""); return function (e) { var t, n = ""; for (t = 0; t < i; t++)n += x(r[t]) ? r[t].call(e, s) : r[t]; return n } }(t), V[t](e)) : e.localeData().invalidDate() } function j(e, t) { var n = 5; function s(e) { return t.longDateFormat(e) || e } for (G.lastIndex = 0; 0 <= n && G.test(e);)e = e.replace(G, s), G.lastIndex = 0, n -= 1; return e } var Z = /\d/, z = /\d\d/, $ = /\d{3}/, q = /\d{4}/, J = /[+-]?\d{6}/, B = /\d\d?/, Q = /\d\d\d\d?/, X = /\d\d\d\d\d\d?/, K = /\d{1,3}/, ee = /\d{1,4}/, te = /[+-]?\d{1,6}/, ne = /\d+/, se = /[+-]?\d+/, ie = /Z|[+-]\d\d:?\d\d/gi, re = /Z|[+-]\d\d(?::?\d\d)?/gi, ae = /[0-9]{0,256}['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFF07\uFF10-\uFFEF]{1,256}|[\u0600-\u06FF\/]{1,256}(\s*?[\u0600-\u06FF]{1,256}){1,2}/i, oe = {}; function ue(e, n, s) { oe[e] = x(n) ? n : function (e, t) { return e && s ? s : n } } function le(e, t) { return m(oe, e) ? oe[e](t._strict, t._locale) : new RegExp(de(e.replace("\\", "").replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g, function (e, t, n, s, i) { return t || n || s || i }))) } function de(e) { return e.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&") } var he = {}; function ce(e, n) { var t, s = n; for ("string" == typeof e && (e = [e]), d(n) && (s = function (e, t) { t[n] = k(e) }), t = 0; t < e.length; t++)he[e[t]] = s } function fe(e, i) { ce(e, function (e, t, n, s) { n._w = n._w || {}, i(e, n._w, n, s) }) } var me = 0, _e = 1, ye = 2, ge = 3, pe = 4, ve = 5, we = 6, Me = 7, Se = 8; function De(e) { return ke(e) ? 366 : 365 } function ke(e) { return e % 4 == 0 && e % 100 != 0 || e % 400 == 0 } I("Y", 0, 0, function () { var e = this.year(); return e <= 9999 ? "" + e : "+" + e }), I(0, ["YY", 2], 0, function () { return this.year() % 100 }), I(0, ["YYYY", 4], 0, "year"), I(0, ["YYYYY", 5], 0, "year"), I(0, ["YYYYYY", 6, !0], 0, "year"), H("year", "y"), L("year", 1), ue("Y", se), ue("YY", B, z), ue("YYYY", ee, q), ue("YYYYY", te, J), ue("YYYYYY", te, J), ce(["YYYYY", "YYYYYY"], me), ce("YYYY", function (e, t) { t[me] = 2 === e.length ? c.parseTwoDigitYear(e) : k(e) }), ce("YY", function (e, t) { t[me] = c.parseTwoDigitYear(e) }), ce("Y", function (e, t) { t[me] = parseInt(e, 10) }), c.parseTwoDigitYear = function (e) { return k(e) + (68 < k(e) ? 1900 : 2e3) }; var Ye, Oe = Te("FullYear", !0); function Te(t, n) { return function (e) { return null != e ? (be(this, t, e), c.updateOffset(this, n), this) : xe(this, t) } } function xe(e, t) { return e.isValid() ? e._d["get" + (e._isUTC ? "UTC" : "") + t]() : NaN } function be(e, t, n) { e.isValid() && !isNaN(n) && ("FullYear" === t && ke(e.year()) && 1 === e.month() && 29 === e.date() ? e._d["set" + (e._isUTC ? "UTC" : "") + t](n, e.month(), Pe(n, e.month())) : e._d["set" + (e._isUTC ? "UTC" : "") + t](n)) } function Pe(e, t) { if (isNaN(e) || isNaN(t)) return NaN; var n, s = (t % (n = 12) + n) % n; return e += (t - s) / 12, 1 === s ? ke(e) ? 29 : 28 : 31 - s % 7 % 2 } Ye = Array.prototype.indexOf ? Array.prototype.indexOf : function (e) { var t; for (t = 0; t < this.length; ++t)if (this[t] === e) return t; return -1 }, I("M", ["MM", 2], "Mo", function () { return this.month() + 1 }), I("MMM", 0, 0, function (e) { return this.localeData().monthsShort(this, e) }), I("MMMM", 0, 0, function (e) { return this.localeData().months(this, e) }), H("month", "M"), L("month", 8), ue("M", B), ue("MM", B, z), ue("MMM", function (e, t) { return t.monthsShortRegex(e) }), ue("MMMM", function (e, t) { return t.monthsRegex(e) }), ce(["M", "MM"], function (e, t) { t[_e] = k(e) - 1 }), ce(["MMM", "MMMM"], function (e, t, n, s) { var i = n._locale.monthsParse(e, s, n._strict); null != i ? t[_e] = i : g(n).invalidMonth = e }); var We = /D[oD]?(\[[^\[\]]*\]|\s)+MMMM?/, He = "January_February_March_April_May_June_July_August_September_October_November_December".split("_"); var Re = "Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_"); function Ce(e, t) { var n; if (!e.isValid()) return e; if ("string" == typeof t) if (/^\d+$/.test(t)) t = k(t); else if (!d(t = e.localeData().monthsParse(t))) return e; return n = Math.min(e.date(), Pe(e.year(), t)), e._d["set" + (e._isUTC ? "UTC" : "") + "Month"](t, n), e } function Fe(e) { return null != e ? (Ce(this, e), c.updateOffset(this, !0), this) : xe(this, "Month") } var Le = ae; var Ue = ae; function Ne() { function e(e, t) { return t.length - e.length } var t, n, s = [], i = [], r = []; for (t = 0; t < 12; t++)n = y([2e3, t]), s.push(this.monthsShort(n, "")), i.push(this.months(n, "")), r.push(this.months(n, "")), r.push(this.monthsShort(n, "")); for (s.sort(e), i.sort(e), r.sort(e), t = 0; t < 12; t++)s[t] = de(s[t]), i[t] = de(i[t]); for (t = 0; t < 24; t++)r[t] = de(r[t]); this._monthsRegex = new RegExp("^(" + r.join("|") + ")", "i"), this._monthsShortRegex = this._monthsRegex, this._monthsStrictRegex = new RegExp("^(" + i.join("|") + ")", "i"), this._monthsShortStrictRegex = new RegExp("^(" + s.join("|") + ")", "i") } function Ge(e) { var t = new Date(Date.UTC.apply(null, arguments)); return e < 100 && 0 <= e && isFinite(t.getUTCFullYear()) && t.setUTCFullYear(e), t } function Ve(e, t, n) { var s = 7 + t - n; return -((7 + Ge(e, 0, s).getUTCDay() - t) % 7) + s - 1 } function Ee(e, t, n, s, i) { var r, a, o = 1 + 7 * (t - 1) + (7 + n - s) % 7 + Ve(e, s, i); return o <= 0 ? a = De(r = e - 1) + o : o > De(e) ? (r = e + 1, a = o - De(e)) : (r = e, a = o), { year: r, dayOfYear: a } } function Ie(e, t, n) { var s, i, r = Ve(e.year(), t, n), a = Math.floor((e.dayOfYear() - r - 1) / 7) + 1; return a < 1 ? s = a + Ae(i = e.year() - 1, t, n) : a > Ae(e.year(), t, n) ? (s = a - Ae(e.year(), t, n), i = e.year() + 1) : (i = e.year(), s = a), { week: s, year: i } } function Ae(e, t, n) { var s = Ve(e, t, n), i = Ve(e + 1, t, n); return (De(e) - s + i) / 7 } I("w", ["ww", 2], "wo", "week"), I("W", ["WW", 2], "Wo", "isoWeek"), H("week", "w"), H("isoWeek", "W"), L("week", 5), L("isoWeek", 5), ue("w", B), ue("ww", B, z), ue("W", B), ue("WW", B, z), fe(["w", "ww", "W", "WW"], function (e, t, n, s) { t[s.substr(0, 1)] = k(e) }); I("d", 0, "do", "day"), I("dd", 0, 0, function (e) { return this.localeData().weekdaysMin(this, e) }), I("ddd", 0, 0, function (e) { return this.localeData().weekdaysShort(this, e) }), I("dddd", 0, 0, function (e) { return this.localeData().weekdays(this, e) }), I("e", 0, 0, "weekday"), I("E", 0, 0, "isoWeekday"), H("day", "d"), H("weekday", "e"), H("isoWeekday", "E"), L("day", 11), L("weekday", 11), L("isoWeekday", 11), ue("d", B), ue("e", B), ue("E", B), ue("dd", function (e, t) { return t.weekdaysMinRegex(e) }), ue("ddd", function (e, t) { return t.weekdaysShortRegex(e) }), ue("dddd", function (e, t) { return t.weekdaysRegex(e) }), fe(["dd", "ddd", "dddd"], function (e, t, n, s) { var i = n._locale.weekdaysParse(e, s, n._strict); null != i ? t.d = i : g(n).invalidWeekday = e }), fe(["d", "e", "E"], function (e, t, n, s) { t[s] = k(e) }); var je = "Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"); var Ze = "Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"); var ze = "Su_Mo_Tu_We_Th_Fr_Sa".split("_"); var $e = ae; var qe = ae; var Je = ae; function Be() { function e(e, t) { return t.length - e.length } var t, n, s, i, r, a = [], o = [], u = [], l = []; for (t = 0; t < 7; t++)n = y([2e3, 1]).day(t), s = this.weekdaysMin(n, ""), i = this.weekdaysShort(n, ""), r = this.weekdays(n, ""), a.push(s), o.push(i), u.push(r), l.push(s), l.push(i), l.push(r); for (a.sort(e), o.sort(e), u.sort(e), l.sort(e), t = 0; t < 7; t++)o[t] = de(o[t]), u[t] = de(u[t]), l[t] = de(l[t]); this._weekdaysRegex = new RegExp("^(" + l.join("|") + ")", "i"), this._weekdaysShortRegex = this._weekdaysRegex, this._weekdaysMinRegex = this._weekdaysRegex, this._weekdaysStrictRegex = new RegExp("^(" + u.join("|") + ")", "i"), this._weekdaysShortStrictRegex = new RegExp("^(" + o.join("|") + ")", "i"), this._weekdaysMinStrictRegex = new RegExp("^(" + a.join("|") + ")", "i") } function Qe() { return this.hours() % 12 || 12 } function Xe(e, t) { I(e, 0, 0, function () { return this.localeData().meridiem(this.hours(), this.minutes(), t) }) } function Ke(e, t) { return t._meridiemParse } I("H", ["HH", 2], 0, "hour"), I("h", ["hh", 2], 0, Qe), I("k", ["kk", 2], 0, function () { return this.hours() || 24 }), I("hmm", 0, 0, function () { return "" + Qe.apply(this) + U(this.minutes(), 2) }), I("hmmss", 0, 0, function () { return "" + Qe.apply(this) + U(this.minutes(), 2) + U(this.seconds(), 2) }), I("Hmm", 0, 0, function () { return "" + this.hours() + U(this.minutes(), 2) }), I("Hmmss", 0, 0, function () { return "" + this.hours() + U(this.minutes(), 2) + U(this.seconds(), 2) }), Xe("a", !0), Xe("A", !1), H("hour", "h"), L("hour", 13), ue("a", Ke), ue("A", Ke), ue("H", B), ue("h", B), ue("k", B), ue("HH", B, z), ue("hh", B, z), ue("kk", B, z), ue("hmm", Q), ue("hmmss", X), ue("Hmm", Q), ue("Hmmss", X), ce(["H", "HH"], ge), ce(["k", "kk"], function (e, t, n) { var s = k(e); t[ge] = 24 === s ? 0 : s }), ce(["a", "A"], function (e, t, n) { n._isPm = n._locale.isPM(e), n._meridiem = e }), ce(["h", "hh"], function (e, t, n) { t[ge] = k(e), g(n).bigHour = !0 }), ce("hmm", function (e, t, n) { var s = e.length - 2; t[ge] = k(e.substr(0, s)), t[pe] = k(e.substr(s)), g(n).bigHour = !0 }), ce("hmmss", function (e, t, n) { var s = e.length - 4, i = e.length - 2; t[ge] = k(e.substr(0, s)), t[pe] = k(e.substr(s, 2)), t[ve] = k(e.substr(i)), g(n).bigHour = !0 }), ce("Hmm", function (e, t, n) { var s = e.length - 2; t[ge] = k(e.substr(0, s)), t[pe] = k(e.substr(s)) }), ce("Hmmss", function (e, t, n) { var s = e.length - 4, i = e.length - 2; t[ge] = k(e.substr(0, s)), t[pe] = k(e.substr(s, 2)), t[ve] = k(e.substr(i)) }); var et, tt = Te("Hours", !0), nt = { calendar: { sameDay: "[Today at] LT", nextDay: "[Tomorrow at] LT", nextWeek: "dddd [at] LT", lastDay: "[Yesterday at] LT", lastWeek: "[Last] dddd [at] LT", sameElse: "L" }, longDateFormat: { LTS: "h:mm:ss A", LT: "h:mm A", L: "MM/DD/YYYY", LL: "MMMM D, YYYY", LLL: "MMMM D, YYYY h:mm A", LLLL: "dddd, MMMM D, YYYY h:mm A" }, invalidDate: "Invalid date", ordinal: "%d", dayOfMonthOrdinalParse: /\d{1,2}/, relativeTime: { future: "in %s", past: "%s ago", s: "a few seconds", ss: "%d seconds", m: "a minute", mm: "%d minutes", h: "an hour", hh: "%d hours", d: "a day", dd: "%d days", M: "a month", MM: "%d months", y: "a year", yy: "%d years" }, months: He, monthsShort: Re, week: { dow: 0, doy: 6 }, weekdays: je, weekdaysMin: ze, weekdaysShort: Ze, meridiemParse: /[ap]\.?m?\.?/i }, st = {}, it = {}; function rt(e) { return e ? e.toLowerCase().replace("_", "-") : e } function at(e) { var t = null; if (!st[e] && "undefined" != typeof module && module && module.exports) try { t = et._abbr, require("./locale/" + e), ot(t) } catch (e) { } return st[e] } function ot(e, t) { var n; return e && ((n = l(t) ? lt(e) : ut(e, t)) ? et = n : "undefined" != typeof console && console.warn && console.warn("Locale " + e + " not found. Did you forget to load it?")), et._abbr } function ut(e, t) { if (null !== t) { var n, s = nt; if (t.abbr = e, null != st[e]) T("defineLocaleOverride", "use moment.updateLocale(localeName, config) to change an existing locale. moment.defineLocale(localeName, config) should only be used for creating a new locale See http://momentjs.com/guides/#/warnings/define-locale/ for more info."), s = st[e]._config; else if (null != t.parentLocale) if (null != st[t.parentLocale]) s = st[t.parentLocale]._config; else { if (null == (n = at(t.parentLocale))) return it[t.parentLocale] || (it[t.parentLocale] = []), it[t.parentLocale].push({ name: e, config: t }), null; s = n._config } return st[e] = new P(b(s, t)), it[e] && it[e].forEach(function (e) { ut(e.name, e.config) }), ot(e), st[e] } return delete st[e], null } function lt(e) { var t; if (e && e._locale && e._locale._abbr && (e = e._locale._abbr), !e) return et; if (!o(e)) { if (t = at(e)) return t; e = [e] } return function (e) { for (var t, n, s, i, r = 0; r < e.length;) { for (t = (i = rt(e[r]).split("-")).length, n = (n = rt(e[r + 1])) ? n.split("-") : null; 0 < t;) { if (s = at(i.slice(0, t).join("-"))) return s; if (n && n.length >= t && a(i, n, !0) >= t - 1) break; t-- } r++ } return et }(e) } function dt(e) { var t, n = e._a; return n && -2 === g(e).overflow && (t = n[_e] < 0 || 11 < n[_e] ? _e : n[ye] < 1 || n[ye] > Pe(n[me], n[_e]) ? ye : n[ge] < 0 || 24 < n[ge] || 24 === n[ge] && (0 !== n[pe] || 0 !== n[ve] || 0 !== n[we]) ? ge : n[pe] < 0 || 59 < n[pe] ? pe : n[ve] < 0 || 59 < n[ve] ? ve : n[we] < 0 || 999 < n[we] ? we : -1, g(e)._overflowDayOfYear && (t < me || ye < t) && (t = ye), g(e)._overflowWeeks && -1 === t && (t = Me), g(e)._overflowWeekday && -1 === t && (t = Se), g(e).overflow = t), e } function ht(e, t, n) { return null != e ? e : null != t ? t : n } function ct(e) { var t, n, s, i, r, a = []; if (!e._d) { var o, u; for (o = e, u = new Date(c.now()), s = o._useUTC ? [u.getUTCFullYear(), u.getUTCMonth(), u.getUTCDate()] : [u.getFullYear(), u.getMonth(), u.getDate()], e._w && null == e._a[ye] && null == e._a[_e] && function (e) { var t, n, s, i, r, a, o, u; if (null != (t = e._w).GG || null != t.W || null != t.E) r = 1, a = 4, n = ht(t.GG, e._a[me], Ie(Tt(), 1, 4).year), s = ht(t.W, 1), ((i = ht(t.E, 1)) < 1 || 7 < i) && (u = !0); else { r = e._locale._week.dow, a = e._locale._week.doy; var l = Ie(Tt(), r, a); n = ht(t.gg, e._a[me], l.year), s = ht(t.w, l.week), null != t.d ? ((i = t.d) < 0 || 6 < i) && (u = !0) : null != t.e ? (i = t.e + r, (t.e < 0 || 6 < t.e) && (u = !0)) : i = r } s < 1 || s > Ae(n, r, a) ? g(e)._overflowWeeks = !0 : null != u ? g(e)._overflowWeekday = !0 : (o = Ee(n, s, i, r, a), e._a[me] = o.year, e._dayOfYear = o.dayOfYear) }(e), null != e._dayOfYear && (r = ht(e._a[me], s[me]), (e._dayOfYear > De(r) || 0 === e._dayOfYear) && (g(e)._overflowDayOfYear = !0), n = Ge(r, 0, e._dayOfYear), e._a[_e] = n.getUTCMonth(), e._a[ye] = n.getUTCDate()), t = 0; t < 3 && null == e._a[t]; ++t)e._a[t] = a[t] = s[t]; for (; t < 7; t++)e._a[t] = a[t] = null == e._a[t] ? 2 === t ? 1 : 0 : e._a[t]; 24 === e._a[ge] && 0 === e._a[pe] && 0 === e._a[ve] && 0 === e._a[we] && (e._nextDay = !0, e._a[ge] = 0), e._d = (e._useUTC ? Ge : function (e, t, n, s, i, r, a) { var o = new Date(e, t, n, s, i, r, a); return e < 100 && 0 <= e && isFinite(o.getFullYear()) && o.setFullYear(e), o }).apply(null, a), i = e._useUTC ? e._d.getUTCDay() : e._d.getDay(), null != e._tzm && e._d.setUTCMinutes(e._d.getUTCMinutes() - e._tzm), e._nextDay && (e._a[ge] = 24), e._w && void 0 !== e._w.d && e._w.d !== i && (g(e).weekdayMismatch = !0) } } var ft = /^\s*((?:[+-]\d{6}|\d{4})-(?:\d\d-\d\d|W\d\d-\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?::\d\d(?::\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/, mt = /^\s*((?:[+-]\d{6}|\d{4})(?:\d\d\d\d|W\d\d\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?:\d\d(?:\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/, _t = /Z|[+-]\d\d(?::?\d\d)?/, yt = [["YYYYYY-MM-DD", /[+-]\d{6}-\d\d-\d\d/], ["YYYY-MM-DD", /\d{4}-\d\d-\d\d/], ["GGGG-[W]WW-E", /\d{4}-W\d\d-\d/], ["GGGG-[W]WW", /\d{4}-W\d\d/, !1], ["YYYY-DDD", /\d{4}-\d{3}/], ["YYYY-MM", /\d{4}-\d\d/, !1], ["YYYYYYMMDD", /[+-]\d{10}/], ["YYYYMMDD", /\d{8}/], ["GGGG[W]WWE", /\d{4}W\d{3}/], ["GGGG[W]WW", /\d{4}W\d{2}/, !1], ["YYYYDDD", /\d{7}/]], gt = [["HH:mm:ss.SSSS", /\d\d:\d\d:\d\d\.\d+/], ["HH:mm:ss,SSSS", /\d\d:\d\d:\d\d,\d+/], ["HH:mm:ss", /\d\d:\d\d:\d\d/], ["HH:mm", /\d\d:\d\d/], ["HHmmss.SSSS", /\d\d\d\d\d\d\.\d+/], ["HHmmss,SSSS", /\d\d\d\d\d\d,\d+/], ["HHmmss", /\d\d\d\d\d\d/], ["HHmm", /\d\d\d\d/], ["HH", /\d\d/]], pt = /^\/?Date\((\-?\d+)/i; function vt(e) { var t, n, s, i, r, a, o = e._i, u = ft.exec(o) || mt.exec(o); if (u) { for (g(e).iso = !0, t = 0, n = yt.length; t < n; t++)if (yt[t][1].exec(u[1])) { i = yt[t][0], s = !1 !== yt[t][2]; break } if (null == i) return void (e._isValid = !1); if (u[3]) { for (t = 0, n = gt.length; t < n; t++)if (gt[t][1].exec(u[3])) { r = (u[2] || " ") + gt[t][0]; break } if (null == r) return void (e._isValid = !1) } if (!s && null != r) return void (e._isValid = !1); if (u[4]) { if (!_t.exec(u[4])) return void (e._isValid = !1); a = "Z" } e._f = i + (r || "") + (a || ""), kt(e) } else e._isValid = !1 } var wt = /^(?:(Mon|Tue|Wed|Thu|Fri|Sat|Sun),?\s)?(\d{1,2})\s(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s(\d{2,4})\s(\d\d):(\d\d)(?::(\d\d))?\s(?:(UT|GMT|[ECMP][SD]T)|([Zz])|([+-]\d{4}))$/; function Mt(e, t, n, s, i, r) { var a = [function (e) { var t = parseInt(e, 10); { if (t <= 49) return 2e3 + t; if (t <= 999) return 1900 + t } return t }(e), Re.indexOf(t), parseInt(n, 10), parseInt(s, 10), parseInt(i, 10)]; return r && a.push(parseInt(r, 10)), a } var St = { UT: 0, GMT: 0, EDT: -240, EST: -300, CDT: -300, CST: -360, MDT: -360, MST: -420, PDT: -420, PST: -480 }; function Dt(e) { var t, n, s, i = wt.exec(e._i.replace(/\([^)]*\)|[\n\t]/g, " ").replace(/(\s\s+)/g, " ").trim()); if (i) { var r = Mt(i[4], i[3], i[2], i[5], i[6], i[7]); if (t = i[1], n = r, s = e, t && Ze.indexOf(t) !== new Date(n[0], n[1], n[2]).getDay() && (g(s).weekdayMismatch = !0, !(s._isValid = !1))) return; e._a = r, e._tzm = function (e, t, n) { if (e) return St[e]; if (t) return 0; var s = parseInt(n, 10), i = s % 100; return (s - i) / 100 * 60 + i }(i[8], i[9], i[10]), e._d = Ge.apply(null, e._a), e._d.setUTCMinutes(e._d.getUTCMinutes() - e._tzm), g(e).rfc2822 = !0 } else e._isValid = !1 } function kt(e) { if (e._f !== c.ISO_8601) if (e._f !== c.RFC_2822) { e._a = [], g(e).empty = !0; var t, n, s, i, r, a, o, u, l = "" + e._i, d = l.length, h = 0; for (s = j(e._f, e._locale).match(N) || [], t = 0; t < s.length; t++)i = s[t], (n = (l.match(le(i, e)) || [])[0]) && (0 < (r = l.substr(0, l.indexOf(n))).length && g(e).unusedInput.push(r), l = l.slice(l.indexOf(n) + n.length), h += n.length), E[i] ? (n ? g(e).empty = !1 : g(e).unusedTokens.push(i), a = i, u = e, null != (o = n) && m(he, a) && he[a](o, u._a, u, a)) : e._strict && !n && g(e).unusedTokens.push(i); g(e).charsLeftOver = d - h, 0 < l.length && g(e).unusedInput.push(l), e._a[ge] <= 12 && !0 === g(e).bigHour && 0 < e._a[ge] && (g(e).bigHour = void 0), g(e).parsedDateParts = e._a.slice(0), g(e).meridiem = e._meridiem, e._a[ge] = function (e, t, n) { var s; if (null == n) return t; return null != e.meridiemHour ? e.meridiemHour(t, n) : (null != e.isPM && ((s = e.isPM(n)) && t < 12 && (t += 12), s || 12 !== t || (t = 0)), t) }(e._locale, e._a[ge], e._meridiem), ct(e), dt(e) } else Dt(e); else vt(e) } function Yt(e) { var t, n, s, i, r = e._i, a = e._f; return e._locale = e._locale || lt(e._l), null === r || void 0 === a && "" === r ? v({ nullInput: !0 }) : ("string" == typeof r && (e._i = r = e._locale.preparse(r)), S(r) ? new M(dt(r)) : (h(r) ? e._d = r : o(a) ? function (e) { var t, n, s, i, r; if (0 === e._f.length) return g(e).invalidFormat = !0, e._d = new Date(NaN); for (i = 0; i < e._f.length; i++)r = 0, t = w({}, e), null != e._useUTC && (t._useUTC = e._useUTC), t._f = e._f[i], kt(t), p(t) && (r += g(t).charsLeftOver, r += 10 * g(t).unusedTokens.length, g(t).score = r, (null == s || r < s) && (s = r, n = t)); _(e, n || t) }(e) : a ? kt(e) : l(n = (t = e)._i) ? t._d = new Date(c.now()) : h(n) ? t._d = new Date(n.valueOf()) : "string" == typeof n ? (s = t, null === (i = pt.exec(s._i)) ? (vt(s), !1 === s._isValid && (delete s._isValid, Dt(s), !1 === s._isValid && (delete s._isValid, c.createFromInputFallback(s)))) : s._d = new Date(+i[1])) : o(n) ? (t._a = f(n.slice(0), function (e) { return parseInt(e, 10) }), ct(t)) : u(n) ? function (e) { if (!e._d) { var t = C(e._i); e._a = f([t.year, t.month, t.day || t.date, t.hour, t.minute, t.second, t.millisecond], function (e) { return e && parseInt(e, 10) }), ct(e) } }(t) : d(n) ? t._d = new Date(n) : c.createFromInputFallback(t), p(e) || (e._d = null), e)) } function Ot(e, t, n, s, i) { var r, a = {}; return !0 !== n && !1 !== n || (s = n, n = void 0), (u(e) && function (e) { if (Object.getOwnPropertyNames) return 0 === Object.getOwnPropertyNames(e).length; var t; for (t in e) if (e.hasOwnProperty(t)) return !1; return !0 }(e) || o(e) && 0 === e.length) && (e = void 0), a._isAMomentObject = !0, a._useUTC = a._isUTC = i, a._l = n, a._i = e, a._f = t, a._strict = s, (r = new M(dt(Yt(a))))._nextDay && (r.add(1, "d"), r._nextDay = void 0), r } function Tt(e, t, n, s) { return Ot(e, t, n, s, !1) } c.createFromInputFallback = n("value provided is not in a recognized RFC2822 or ISO format. moment construction falls back to js Date(), which is not reliable across all browsers and versions. Non RFC2822/ISO date formats are discouraged and will be removed in an upcoming major release. Please refer to http://momentjs.com/guides/#/warnings/js-date/ for more info.", function (e) { e._d = new Date(e._i + (e._useUTC ? " UTC" : "")) }), c.ISO_8601 = function () { }, c.RFC_2822 = function () { }; var xt = n("moment().min is deprecated, use moment.max instead. http://momentjs.com/guides/#/warnings/min-max/", function () { var e = Tt.apply(null, arguments); return this.isValid() && e.isValid() ? e < this ? this : e : v() }), bt = n("moment().max is deprecated, use moment.min instead. http://momentjs.com/guides/#/warnings/min-max/", function () { var e = Tt.apply(null, arguments); return this.isValid() && e.isValid() ? this < e ? this : e : v() }); function Pt(e, t) { var n, s; if (1 === t.length && o(t[0]) && (t = t[0]), !t.length) return Tt(); for (n = t[0], s = 1; s < t.length; ++s)t[s].isValid() && !t[s][e](n) || (n = t[s]); return n } var Wt = ["year", "quarter", "month", "week", "day", "hour", "minute", "second", "millisecond"]; function Ht(e) { var t = C(e), n = t.year || 0, s = t.quarter || 0, i = t.month || 0, r = t.week || 0, a = t.day || 0, o = t.hour || 0, u = t.minute || 0, l = t.second || 0, d = t.millisecond || 0; this._isValid = function (e) { for (var t in e) if (-1 === Ye.call(Wt, t) || null != e[t] && isNaN(e[t])) return !1; for (var n = !1, s = 0; s < Wt.length; ++s)if (e[Wt[s]]) { if (n) return !1; parseFloat(e[Wt[s]]) !== k(e[Wt[s]]) && (n = !0) } return !0 }(t), this._milliseconds = +d + 1e3 * l + 6e4 * u + 1e3 * o * 60 * 60, this._days = +a + 7 * r, this._months = +i + 3 * s + 12 * n, this._data = {}, this._locale = lt(), this._bubble() } function Rt(e) { return e instanceof Ht } function Ct(e) { return e < 0 ? -1 * Math.round(-1 * e) : Math.round(e) } function Ft(e, n) { I(e, 0, 0, function () { var e = this.utcOffset(), t = "+"; return e < 0 && (e = -e, t = "-"), t + U(~~(e / 60), 2) + n + U(~~e % 60, 2) }) } Ft("Z", ":"), Ft("ZZ", ""), ue("Z", re), ue("ZZ", re), ce(["Z", "ZZ"], function (e, t, n) { n._useUTC = !0, n._tzm = Ut(re, e) }); var Lt = /([\+\-]|\d\d)/gi; function Ut(e, t) { var n = (t || "").match(e); if (null === n) return null; var s = ((n[n.length - 1] || []) + "").match(Lt) || ["-", 0, 0], i = 60 * s[1] + k(s[2]); return 0 === i ? 0 : "+" === s[0] ? i : -i } function Nt(e, t) { var n, s; return t._isUTC ? (n = t.clone(), s = (S(e) || h(e) ? e.valueOf() : Tt(e).valueOf()) - n.valueOf(), n._d.setTime(n._d.valueOf() + s), c.updateOffset(n, !1), n) : Tt(e).local() } function Gt(e) { return 15 * -Math.round(e._d.getTimezoneOffset() / 15) } function Vt() { return !!this.isValid() && (this._isUTC && 0 === this._offset) } c.updateOffset = function () { }; var Et = /^(\-|\+)?(?:(\d*)[. ])?(\d+)\:(\d+)(?:\:(\d+)(\.\d*)?)?$/, It = /^(-|\+)?P(?:([-+]?[0-9,.]*)Y)?(?:([-+]?[0-9,.]*)M)?(?:([-+]?[0-9,.]*)W)?(?:([-+]?[0-9,.]*)D)?(?:T(?:([-+]?[0-9,.]*)H)?(?:([-+]?[0-9,.]*)M)?(?:([-+]?[0-9,.]*)S)?)?$/; function At(e, t) { var n, s, i, r = e, a = null; return Rt(e) ? r = { ms: e._milliseconds, d: e._days, M: e._months } : d(e) ? (r = {}, t ? r[t] = e : r.milliseconds = e) : (a = Et.exec(e)) ? (n = "-" === a[1] ? -1 : 1, r = { y: 0, d: k(a[ye]) * n, h: k(a[ge]) * n, m: k(a[pe]) * n, s: k(a[ve]) * n, ms: k(Ct(1e3 * a[we])) * n }) : (a = It.exec(e)) ? (n = "-" === a[1] ? -1 : (a[1], 1), r = { y: jt(a[2], n), M: jt(a[3], n), w: jt(a[4], n), d: jt(a[5], n), h: jt(a[6], n), m: jt(a[7], n), s: jt(a[8], n) }) : null == r ? r = {} : "object" == typeof r && ("from" in r || "to" in r) && (i = function (e, t) { var n; if (!e.isValid() || !t.isValid()) return { milliseconds: 0, months: 0 }; t = Nt(t, e), e.isBefore(t) ? n = Zt(e, t) : ((n = Zt(t, e)).milliseconds = -n.milliseconds, n.months = -n.months); return n }(Tt(r.from), Tt(r.to)), (r = {}).ms = i.milliseconds, r.M = i.months), s = new Ht(r), Rt(e) && m(e, "_locale") && (s._locale = e._locale), s } function jt(e, t) { var n = e && parseFloat(e.replace(",", ".")); return (isNaN(n) ? 0 : n) * t } function Zt(e, t) { var n = { milliseconds: 0, months: 0 }; return n.months = t.month() - e.month() + 12 * (t.year() - e.year()), e.clone().add(n.months, "M").isAfter(t) && --n.months, n.milliseconds = +t - +e.clone().add(n.months, "M"), n } function zt(s, i) { return function (e, t) { var n; return null === t || isNaN(+t) || (T(i, "moment()." + i + "(period, number) is deprecated. Please use moment()." + i + "(number, period). See http://momentjs.com/guides/#/warnings/add-inverted-param/ for more info."), n = e, e = t, t = n), $t(this, At(e = "string" == typeof e ? +e : e, t), s), this } } function $t(e, t, n, s) { var i = t._milliseconds, r = Ct(t._days), a = Ct(t._months); e.isValid() && (s = null == s || s, a && Ce(e, xe(e, "Month") + a * n), r && be(e, "Date", xe(e, "Date") + r * n), i && e._d.setTime(e._d.valueOf() + i * n), s && c.updateOffset(e, r || a)) } At.fn = Ht.prototype, At.invalid = function () { return At(NaN) }; var qt = zt(1, "add"), Jt = zt(-1, "subtract"); function Bt(e, t) { var n = 12 * (t.year() - e.year()) + (t.month() - e.month()), s = e.clone().add(n, "months"); return -(n + (t - s < 0 ? (t - s) / (s - e.clone().add(n - 1, "months")) : (t - s) / (e.clone().add(n + 1, "months") - s))) || 0 } function Qt(e) { var t; return void 0 === e ? this._locale._abbr : (null != (t = lt(e)) && (this._locale = t), this) } c.defaultFormat = "YYYY-MM-DDTHH:mm:ssZ", c.defaultFormatUtc = "YYYY-MM-DDTHH:mm:ss[Z]"; var Xt = n("moment().lang() is deprecated. Instead, use moment().localeData() to get the language configuration. Use moment().locale() to change languages.", function (e) { return void 0 === e ? this.localeData() : this.locale(e) }); function Kt() { return this._locale } function en(e, t) { I(0, [e, e.length], 0, t) } function tn(e, t, n, s, i) { var r; return null == e ? Ie(this, s, i).year : ((r = Ae(e, s, i)) < t && (t = r), function (e, t, n, s, i) { var r = Ee(e, t, n, s, i), a = Ge(r.year, 0, r.dayOfYear); return this.year(a.getUTCFullYear()), this.month(a.getUTCMonth()), this.date(a.getUTCDate()), this }.call(this, e, t, n, s, i)) } I(0, ["gg", 2], 0, function () { return this.weekYear() % 100 }), I(0, ["GG", 2], 0, function () { return this.isoWeekYear() % 100 }), en("gggg", "weekYear"), en("ggggg", "weekYear"), en("GGGG", "isoWeekYear"), en("GGGGG", "isoWeekYear"), H("weekYear", "gg"), H("isoWeekYear", "GG"), L("weekYear", 1), L("isoWeekYear", 1), ue("G", se), ue("g", se), ue("GG", B, z), ue("gg", B, z), ue("GGGG", ee, q), ue("gggg", ee, q), ue("GGGGG", te, J), ue("ggggg", te, J), fe(["gggg", "ggggg", "GGGG", "GGGGG"], function (e, t, n, s) { t[s.substr(0, 2)] = k(e) }), fe(["gg", "GG"], function (e, t, n, s) { t[s] = c.parseTwoDigitYear(e) }), I("Q", 0, "Qo", "quarter"), H("quarter", "Q"), L("quarter", 7), ue("Q", Z), ce("Q", function (e, t) { t[_e] = 3 * (k(e) - 1) }), I("D", ["DD", 2], "Do", "date"), H("date", "D"), L("date", 9), ue("D", B), ue("DD", B, z), ue("Do", function (e, t) { return e ? t._dayOfMonthOrdinalParse || t._ordinalParse : t._dayOfMonthOrdinalParseLenient }), ce(["D", "DD"], ye), ce("Do", function (e, t) { t[ye] = k(e.match(B)[0]) }); var nn = Te("Date", !0); I("DDD", ["DDDD", 3], "DDDo", "dayOfYear"), H("dayOfYear", "DDD"), L("dayOfYear", 4), ue("DDD", K), ue("DDDD", $), ce(["DDD", "DDDD"], function (e, t, n) { n._dayOfYear = k(e) }), I("m", ["mm", 2], 0, "minute"), H("minute", "m"), L("minute", 14), ue("m", B), ue("mm", B, z), ce(["m", "mm"], pe); var sn = Te("Minutes", !1); I("s", ["ss", 2], 0, "second"), H("second", "s"), L("second", 15), ue("s", B), ue("ss", B, z), ce(["s", "ss"], ve); var rn, an = Te("Seconds", !1); for (I("S", 0, 0, function () { return ~~(this.millisecond() / 100) }), I(0, ["SS", 2], 0, function () { return ~~(this.millisecond() / 10) }), I(0, ["SSS", 3], 0, "millisecond"), I(0, ["SSSS", 4], 0, function () { return 10 * this.millisecond() }), I(0, ["SSSSS", 5], 0, function () { return 100 * this.millisecond() }), I(0, ["SSSSSS", 6], 0, function () { return 1e3 * this.millisecond() }), I(0, ["SSSSSSS", 7], 0, function () { return 1e4 * this.millisecond() }), I(0, ["SSSSSSSS", 8], 0, function () { return 1e5 * this.millisecond() }), I(0, ["SSSSSSSSS", 9], 0, function () { return 1e6 * this.millisecond() }), H("millisecond", "ms"), L("millisecond", 16), ue("S", K, Z), ue("SS", K, z), ue("SSS", K, $), rn = "SSSS"; rn.length <= 9; rn += "S")ue(rn, ne); function on(e, t) { t[we] = k(1e3 * ("0." + e)) } for (rn = "S"; rn.length <= 9; rn += "S")ce(rn, on); var un = Te("Milliseconds", !1); I("z", 0, 0, "zoneAbbr"), I("zz", 0, 0, "zoneName"); var ln = M.prototype; function dn(e) { return e } ln.add = qt, ln.calendar = function (e, t) { var n = e || Tt(), s = Nt(n, this).startOf("day"), i = c.calendarFormat(this, s) || "sameElse", r = t && (x(t[i]) ? t[i].call(this, n) : t[i]); return this.format(r || this.localeData().calendar(i, this, Tt(n))) }, ln.clone = function () { return new M(this) }, ln.diff = function (e, t, n) { var s, i, r; if (!this.isValid()) return NaN; if (!(s = Nt(e, this)).isValid()) return NaN; switch (i = 6e4 * (s.utcOffset() - this.utcOffset()), t = R(t)) { case "year": r = Bt(this, s) / 12; break; case "month": r = Bt(this, s); break; case "quarter": r = Bt(this, s) / 3; break; case "second": r = (this - s) / 1e3; break; case "minute": r = (this - s) / 6e4; break; case "hour": r = (this - s) / 36e5; break; case "day": r = (this - s - i) / 864e5; break; case "week": r = (this - s - i) / 6048e5; break; default: r = this - s }return n ? r : D(r) }, ln.endOf = function (e) { return void 0 === (e = R(e)) || "millisecond" === e ? this : ("date" === e && (e = "day"), this.startOf(e).add(1, "isoWeek" === e ? "week" : e).subtract(1, "ms")) }, ln.format = function (e) { e || (e = this.isUtc() ? c.defaultFormatUtc : c.defaultFormat); var t = A(this, e); return this.localeData().postformat(t) }, ln.from = function (e, t) { return this.isValid() && (S(e) && e.isValid() || Tt(e).isValid()) ? At({ to: this, from: e }).locale(this.locale()).humanize(!t) : this.localeData().invalidDate() }, ln.fromNow = function (e) { return this.from(Tt(), e) }, ln.to = function (e, t) { return this.isValid() && (S(e) && e.isValid() || Tt(e).isValid()) ? At({ from: this, to: e }).locale(this.locale()).humanize(!t) : this.localeData().invalidDate() }, ln.toNow = function (e) { return this.to(Tt(), e) }, ln.get = function (e) { return x(this[e = R(e)]) ? this[e]() : this }, ln.invalidAt = function () { return g(this).overflow }, ln.isAfter = function (e, t) { var n = S(e) ? e : Tt(e); return !(!this.isValid() || !n.isValid()) && ("millisecond" === (t = R(l(t) ? "millisecond" : t)) ? this.valueOf() > n.valueOf() : n.valueOf() < this.clone().startOf(t).valueOf()) }, ln.isBefore = function (e, t) { var n = S(e) ? e : Tt(e); return !(!this.isValid() || !n.isValid()) && ("millisecond" === (t = R(l(t) ? "millisecond" : t)) ? this.valueOf() < n.valueOf() : this.clone().endOf(t).valueOf() < n.valueOf()) }, ln.isBetween = function (e, t, n, s) { return ("(" === (s = s || "()")[0] ? this.isAfter(e, n) : !this.isBefore(e, n)) && (")" === s[1] ? this.isBefore(t, n) : !this.isAfter(t, n)) }, ln.isSame = function (e, t) { var n, s = S(e) ? e : Tt(e); return !(!this.isValid() || !s.isValid()) && ("millisecond" === (t = R(t || "millisecond")) ? this.valueOf() === s.valueOf() : (n = s.valueOf(), this.clone().startOf(t).valueOf() <= n && n <= this.clone().endOf(t).valueOf())) }, ln.isSameOrAfter = function (e, t) { return this.isSame(e, t) || this.isAfter(e, t) }, ln.isSameOrBefore = function (e, t) { return this.isSame(e, t) || this.isBefore(e, t) }, ln.isValid = function () { return p(this) }, ln.lang = Xt, ln.locale = Qt, ln.localeData = Kt, ln.max = bt, ln.min = xt, ln.parsingFlags = function () { return _({}, g(this)) }, ln.set = function (e, t) { if ("object" == typeof e) for (var n = function (e) { var t = []; for (var n in e) t.push({ unit: n, priority: F[n] }); return t.sort(function (e, t) { return e.priority - t.priority }), t }(e = C(e)), s = 0; s < n.length; s++)this[n[s].unit](e[n[s].unit]); else if (x(this[e = R(e)])) return this[e](t); return this }, ln.startOf = function (e) { switch (e = R(e)) { case "year": this.month(0); case "quarter": case "month": this.date(1); case "week": case "isoWeek": case "day": case "date": this.hours(0); case "hour": this.minutes(0); case "minute": this.seconds(0); case "second": this.milliseconds(0) }return "week" === e && this.weekday(0), "isoWeek" === e && this.isoWeekday(1), "quarter" === e && this.month(3 * Math.floor(this.month() / 3)), this }, ln.subtract = Jt, ln.toArray = function () { var e = this; return [e.year(), e.month(), e.date(), e.hour(), e.minute(), e.second(), e.millisecond()] }, ln.toObject = function () { var e = this; return { years: e.year(), months: e.month(), date: e.date(), hours: e.hours(), minutes: e.minutes(), seconds: e.seconds(), milliseconds: e.milliseconds() } }, ln.toDate = function () { return new Date(this.valueOf()) }, ln.toISOString = function (e) { if (!this.isValid()) return null; var t = !0 !== e, n = t ? this.clone().utc() : this; return n.year() < 0 || 9999 < n.year() ? A(n, t ? "YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]" : "YYYYYY-MM-DD[T]HH:mm:ss.SSSZ") : x(Date.prototype.toISOString) ? t ? this.toDate().toISOString() : new Date(this.valueOf() + 60 * this.utcOffset() * 1e3).toISOString().replace("Z", A(n, "Z")) : A(n, t ? "YYYY-MM-DD[T]HH:mm:ss.SSS[Z]" : "YYYY-MM-DD[T]HH:mm:ss.SSSZ") }, ln.inspect = function () { if (!this.isValid()) return "moment.invalid(/* " + this._i + " */)"; var e = "moment", t = ""; this.isLocal() || (e = 0 === this.utcOffset() ? "moment.utc" : "moment.parseZone", t = "Z"); var n = "[" + e + '("]', s = 0 <= this.year() && this.year() <= 9999 ? "YYYY" : "YYYYYY", i = t + '[")]'; return this.format(n + s + "-MM-DD[T]HH:mm:ss.SSS" + i) }, ln.toJSON = function () { return this.isValid() ? this.toISOString() : null }, ln.toString = function () { return this.clone().locale("en").format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ") }, ln.unix = function () { return Math.floor(this.valueOf() / 1e3) }, ln.valueOf = function () { return this._d.valueOf() - 6e4 * (this._offset || 0) }, ln.creationData = function () { return { input: this._i, format: this._f, locale: this._locale, isUTC: this._isUTC, strict: this._strict } }, ln.year = Oe, ln.isLeapYear = function () { return ke(this.year()) }, ln.weekYear = function (e) { return tn.call(this, e, this.week(), this.weekday(), this.localeData()._week.dow, this.localeData()._week.doy) }, ln.isoWeekYear = function (e) { return tn.call(this, e, this.isoWeek(), this.isoWeekday(), 1, 4) }, ln.quarter = ln.quarters = function (e) { return null == e ? Math.ceil((this.month() + 1) / 3) : this.month(3 * (e - 1) + this.month() % 3) }, ln.month = Fe, ln.daysInMonth = function () { return Pe(this.year(), this.month()) }, ln.week = ln.weeks = function (e) { var t = this.localeData().week(this); return null == e ? t : this.add(7 * (e - t), "d") }, ln.isoWeek = ln.isoWeeks = function (e) { var t = Ie(this, 1, 4).week; return null == e ? t : this.add(7 * (e - t), "d") }, ln.weeksInYear = function () { var e = this.localeData()._week; return Ae(this.year(), e.dow, e.doy) }, ln.isoWeeksInYear = function () { return Ae(this.year(), 1, 4) }, ln.date = nn, ln.day = ln.days = function (e) { if (!this.isValid()) return null != e ? this : NaN; var t, n, s = this._isUTC ? this._d.getUTCDay() : this._d.getDay(); return null != e ? (t = e, n = this.localeData(), e = "string" != typeof t ? t : isNaN(t) ? "number" == typeof (t = n.weekdaysParse(t)) ? t : null : parseInt(t, 10), this.add(e - s, "d")) : s }, ln.weekday = function (e) { if (!this.isValid()) return null != e ? this : NaN; var t = (this.day() + 7 - this.localeData()._week.dow) % 7; return null == e ? t : this.add(e - t, "d") }, ln.isoWeekday = function (e) { if (!this.isValid()) return null != e ? this : NaN; if (null != e) { var t = (n = e, s = this.localeData(), "string" == typeof n ? s.weekdaysParse(n) % 7 || 7 : isNaN(n) ? null : n); return this.day(this.day() % 7 ? t : t - 7) } return this.day() || 7; var n, s }, ln.dayOfYear = function (e) { var t = Math.round((this.clone().startOf("day") - this.clone().startOf("year")) / 864e5) + 1; return null == e ? t : this.add(e - t, "d") }, ln.hour = ln.hours = tt, ln.minute = ln.minutes = sn, ln.second = ln.seconds = an, ln.millisecond = ln.milliseconds = un, ln.utcOffset = function (e, t, n) { var s, i = this._offset || 0; if (!this.isValid()) return null != e ? this : NaN; if (null != e) { if ("string" == typeof e) { if (null === (e = Ut(re, e))) return this } else Math.abs(e) < 16 && !n && (e *= 60); return !this._isUTC && t && (s = Gt(this)), this._offset = e, this._isUTC = !0, null != s && this.add(s, "m"), i !== e && (!t || this._changeInProgress ? $t(this, At(e - i, "m"), 1, !1) : this._changeInProgress || (this._changeInProgress = !0, c.updateOffset(this, !0), this._changeInProgress = null)), this } return this._isUTC ? i : Gt(this) }, ln.utc = function (e) { return this.utcOffset(0, e) }, ln.local = function (e) { return this._isUTC && (this.utcOffset(0, e), this._isUTC = !1, e && this.subtract(Gt(this), "m")), this }, ln.parseZone = function () { if (null != this._tzm) this.utcOffset(this._tzm, !1, !0); else if ("string" == typeof this._i) { var e = Ut(ie, this._i); null != e ? this.utcOffset(e) : this.utcOffset(0, !0) } return this }, ln.hasAlignedHourOffset = function (e) { return !!this.isValid() && (e = e ? Tt(e).utcOffset() : 0, (this.utcOffset() - e) % 60 == 0) }, ln.isDST = function () { return this.utcOffset() > this.clone().month(0).utcOffset() || this.utcOffset() > this.clone().month(5).utcOffset() }, ln.isLocal = function () { return !!this.isValid() && !this._isUTC }, ln.isUtcOffset = function () { return !!this.isValid() && this._isUTC }, ln.isUtc = Vt, ln.isUTC = Vt, ln.zoneAbbr = function () { return this._isUTC ? "UTC" : "" }, ln.zoneName = function () { return this._isUTC ? "Coordinated Universal Time" : "" }, ln.dates = n("dates accessor is deprecated. Use date instead.", nn), ln.months = n("months accessor is deprecated. Use month instead", Fe), ln.years = n("years accessor is deprecated. Use year instead", Oe), ln.zone = n("moment().zone is deprecated, use moment().utcOffset instead. http://momentjs.com/guides/#/warnings/zone/", function (e, t) { return null != e ? ("string" != typeof e && (e = -e), this.utcOffset(e, t), this) : -this.utcOffset() }), ln.isDSTShifted = n("isDSTShifted is deprecated. See http://momentjs.com/guides/#/warnings/dst-shifted/ for more information", function () { if (!l(this._isDSTShifted)) return this._isDSTShifted; var e = {}; if (w(e, this), (e = Yt(e))._a) { var t = e._isUTC ? y(e._a) : Tt(e._a); this._isDSTShifted = this.isValid() && 0 < a(e._a, t.toArray()) } else this._isDSTShifted = !1; return this._isDSTShifted }); var hn = P.prototype; function cn(e, t, n, s) { var i = lt(), r = y().set(s, t); return i[n](r, e) } function fn(e, t, n) { if (d(e) && (t = e, e = void 0), e = e || "", null != t) return cn(e, t, n, "month"); var s, i = []; for (s = 0; s < 12; s++)i[s] = cn(e, s, n, "month"); return i } function mn(e, t, n, s) { "boolean" == typeof e ? d(t) && (n = t, t = void 0) : (t = e, e = !1, d(n = t) && (n = t, t = void 0)), t = t || ""; var i, r = lt(), a = e ? r._week.dow : 0; if (null != n) return cn(t, (n + a) % 7, s, "day"); var o = []; for (i = 0; i < 7; i++)o[i] = cn(t, (i + a) % 7, s, "day"); return o } hn.calendar = function (e, t, n) { var s = this._calendar[e] || this._calendar.sameElse; return x(s) ? s.call(t, n) : s }, hn.longDateFormat = function (e) { var t = this._longDateFormat[e], n = this._longDateFormat[e.toUpperCase()]; return t || !n ? t : (this._longDateFormat[e] = n.replace(/MMMM|MM|DD|dddd/g, function (e) { return e.slice(1) }), this._longDateFormat[e]) }, hn.invalidDate = function () { return this._invalidDate }, hn.ordinal = function (e) { return this._ordinal.replace("%d", e) }, hn.preparse = dn, hn.postformat = dn, hn.relativeTime = function (e, t, n, s) { var i = this._relativeTime[n]; return x(i) ? i(e, t, n, s) : i.replace(/%d/i, e) }, hn.pastFuture = function (e, t) { var n = this._relativeTime[0 < e ? "future" : "past"]; return x(n) ? n(t) : n.replace(/%s/i, t) }, hn.set = function (e) { var t, n; for (n in e) x(t = e[n]) ? this[n] = t : this["_" + n] = t; this._config = e, this._dayOfMonthOrdinalParseLenient = new RegExp((this._dayOfMonthOrdinalParse.source || this._ordinalParse.source) + "|" + /\d{1,2}/.source) }, hn.months = function (e, t) { return e ? o(this._months) ? this._months[e.month()] : this._months[(this._months.isFormat || We).test(t) ? "format" : "standalone"][e.month()] : o(this._months) ? this._months : this._months.standalone }, hn.monthsShort = function (e, t) { return e ? o(this._monthsShort) ? this._monthsShort[e.month()] : this._monthsShort[We.test(t) ? "format" : "standalone"][e.month()] : o(this._monthsShort) ? this._monthsShort : this._monthsShort.standalone }, hn.monthsParse = function (e, t, n) { var s, i, r; if (this._monthsParseExact) return function (e, t, n) { var s, i, r, a = e.toLocaleLowerCase(); if (!this._monthsParse) for (this._monthsParse = [], this._longMonthsParse = [], this._shortMonthsParse = [], s = 0; s < 12; ++s)r = y([2e3, s]), this._shortMonthsParse[s] = this.monthsShort(r, "").toLocaleLowerCase(), this._longMonthsParse[s] = this.months(r, "").toLocaleLowerCase(); return n ? "MMM" === t ? -1 !== (i = Ye.call(this._shortMonthsParse, a)) ? i : null : -1 !== (i = Ye.call(this._longMonthsParse, a)) ? i : null : "MMM" === t ? -1 !== (i = Ye.call(this._shortMonthsParse, a)) ? i : -1 !== (i = Ye.call(this._longMonthsParse, a)) ? i : null : -1 !== (i = Ye.call(this._longMonthsParse, a)) ? i : -1 !== (i = Ye.call(this._shortMonthsParse, a)) ? i : null }.call(this, e, t, n); for (this._monthsParse || (this._monthsParse = [], this._longMonthsParse = [], this._shortMonthsParse = []), s = 0; s < 12; s++) { if (i = y([2e3, s]), n && !this._longMonthsParse[s] && (this._longMonthsParse[s] = new RegExp("^" + this.months(i, "").replace(".", "") + "$", "i"), this._shortMonthsParse[s] = new RegExp("^" + this.monthsShort(i, "").replace(".", "") + "$", "i")), n || this._monthsParse[s] || (r = "^" + this.months(i, "") + "|^" + this.monthsShort(i, ""), this._monthsParse[s] = new RegExp(r.replace(".", ""), "i")), n && "MMMM" === t && this._longMonthsParse[s].test(e)) return s; if (n && "MMM" === t && this._shortMonthsParse[s].test(e)) return s; if (!n && this._monthsParse[s].test(e)) return s } }, hn.monthsRegex = function (e) { return this._monthsParseExact ? (m(this, "_monthsRegex") || Ne.call(this), e ? this._monthsStrictRegex : this._monthsRegex) : (m(this, "_monthsRegex") || (this._monthsRegex = Ue), this._monthsStrictRegex && e ? this._monthsStrictRegex : this._monthsRegex) }, hn.monthsShortRegex = function (e) { return this._monthsParseExact ? (m(this, "_monthsRegex") || Ne.call(this), e ? this._monthsShortStrictRegex : this._monthsShortRegex) : (m(this, "_monthsShortRegex") || (this._monthsShortRegex = Le), this._monthsShortStrictRegex && e ? this._monthsShortStrictRegex : this._monthsShortRegex) }, hn.week = function (e) { return Ie(e, this._week.dow, this._week.doy).week }, hn.firstDayOfYear = function () { return this._week.doy }, hn.firstDayOfWeek = function () { return this._week.dow }, hn.weekdays = function (e, t) { return e ? o(this._weekdays) ? this._weekdays[e.day()] : this._weekdays[this._weekdays.isFormat.test(t) ? "format" : "standalone"][e.day()] : o(this._weekdays) ? this._weekdays : this._weekdays.standalone }, hn.weekdaysMin = function (e) { return e ? this._weekdaysMin[e.day()] : this._weekdaysMin }, hn.weekdaysShort = function (e) { return e ? this._weekdaysShort[e.day()] : this._weekdaysShort }, hn.weekdaysParse = function (e, t, n) { var s, i, r; if (this._weekdaysParseExact) return function (e, t, n) { var s, i, r, a = e.toLocaleLowerCase(); if (!this._weekdaysParse) for (this._weekdaysParse = [], this._shortWeekdaysParse = [], this._minWeekdaysParse = [], s = 0; s < 7; ++s)r = y([2e3, 1]).day(s), this._minWeekdaysParse[s] = this.weekdaysMin(r, "").toLocaleLowerCase(), this._shortWeekdaysParse[s] = this.weekdaysShort(r, "").toLocaleLowerCase(), this._weekdaysParse[s] = this.weekdays(r, "").toLocaleLowerCase(); return n ? "dddd" === t ? -1 !== (i = Ye.call(this._weekdaysParse, a)) ? i : null : "ddd" === t ? -1 !== (i = Ye.call(this._shortWeekdaysParse, a)) ? i : null : -1 !== (i = Ye.call(this._minWeekdaysParse, a)) ? i : null : "dddd" === t ? -1 !== (i = Ye.call(this._weekdaysParse, a)) ? i : -1 !== (i = Ye.call(this._shortWeekdaysParse, a)) ? i : -1 !== (i = Ye.call(this._minWeekdaysParse, a)) ? i : null : "ddd" === t ? -1 !== (i = Ye.call(this._shortWeekdaysParse, a)) ? i : -1 !== (i = Ye.call(this._weekdaysParse, a)) ? i : -1 !== (i = Ye.call(this._minWeekdaysParse, a)) ? i : null : -1 !== (i = Ye.call(this._minWeekdaysParse, a)) ? i : -1 !== (i = Ye.call(this._weekdaysParse, a)) ? i : -1 !== (i = Ye.call(this._shortWeekdaysParse, a)) ? i : null }.call(this, e, t, n); for (this._weekdaysParse || (this._weekdaysParse = [], this._minWeekdaysParse = [], this._shortWeekdaysParse = [], this._fullWeekdaysParse = []), s = 0; s < 7; s++) { if (i = y([2e3, 1]).day(s), n && !this._fullWeekdaysParse[s] && (this._fullWeekdaysParse[s] = new RegExp("^" + this.weekdays(i, "").replace(".", ".?") + "$", "i"), this._shortWeekdaysParse[s] = new RegExp("^" + this.weekdaysShort(i, "").replace(".", ".?") + "$", "i"), this._minWeekdaysParse[s] = new RegExp("^" + this.weekdaysMin(i, "").replace(".", ".?") + "$", "i")), this._weekdaysParse[s] || (r = "^" + this.weekdays(i, "") + "|^" + this.weekdaysShort(i, "") + "|^" + this.weekdaysMin(i, ""), this._weekdaysParse[s] = new RegExp(r.replace(".", ""), "i")), n && "dddd" === t && this._fullWeekdaysParse[s].test(e)) return s; if (n && "ddd" === t && this._shortWeekdaysParse[s].test(e)) return s; if (n && "dd" === t && this._minWeekdaysParse[s].test(e)) return s; if (!n && this._weekdaysParse[s].test(e)) return s } }, hn.weekdaysRegex = function (e) { return this._weekdaysParseExact ? (m(this, "_weekdaysRegex") || Be.call(this), e ? this._weekdaysStrictRegex : this._weekdaysRegex) : (m(this, "_weekdaysRegex") || (this._weekdaysRegex = $e), this._weekdaysStrictRegex && e ? this._weekdaysStrictRegex : this._weekdaysRegex) }, hn.weekdaysShortRegex = function (e) { return this._weekdaysParseExact ? (m(this, "_weekdaysRegex") || Be.call(this), e ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex) : (m(this, "_weekdaysShortRegex") || (this._weekdaysShortRegex = qe), this._weekdaysShortStrictRegex && e ? this._weekdaysShortStrictRegex : this._weekdaysShortRegex) }, hn.weekdaysMinRegex = function (e) { return this._weekdaysParseExact ? (m(this, "_weekdaysRegex") || Be.call(this), e ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex) : (m(this, "_weekdaysMinRegex") || (this._weekdaysMinRegex = Je), this._weekdaysMinStrictRegex && e ? this._weekdaysMinStrictRegex : this._weekdaysMinRegex) }, hn.isPM = function (e) { return "p" === (e + "").toLowerCase().charAt(0) }, hn.meridiem = function (e, t, n) { return 11 < e ? n ? "pm" : "PM" : n ? "am" : "AM" }, ot("en", { dayOfMonthOrdinalParse: /\d{1,2}(th|st|nd|rd)/, ordinal: function (e) { var t = e % 10; return e + (1 === k(e % 100 / 10) ? "th" : 1 === t ? "st" : 2 === t ? "nd" : 3 === t ? "rd" : "th") } }), c.lang = n("moment.lang is deprecated. Use moment.locale instead.", ot), c.langData = n("moment.langData is deprecated. Use moment.localeData instead.", lt); var _n = Math.abs; function yn(e, t, n, s) { var i = At(t, n); return e._milliseconds += s * i._milliseconds, e._days += s * i._days, e._months += s * i._months, e._bubble() } function gn(e) { return e < 0 ? Math.floor(e) : Math.ceil(e) } function pn(e) { return 4800 * e / 146097 } function vn(e) { return 146097 * e / 4800 } function wn(e) { return function () { return this.as(e) } } var Mn = wn("ms"), Sn = wn("s"), Dn = wn("m"), kn = wn("h"), Yn = wn("d"), On = wn("w"), Tn = wn("M"), xn = wn("y"); function bn(e) { return function () { return this.isValid() ? this._data[e] : NaN } } var Pn = bn("milliseconds"), Wn = bn("seconds"), Hn = bn("minutes"), Rn = bn("hours"), Cn = bn("days"), Fn = bn("months"), Ln = bn("years"); var Un = Math.round, Nn = { ss: 44, s: 45, m: 45, h: 22, d: 26, M: 11 }; var Gn = Math.abs; function Vn(e) { return (0 < e) - (e < 0) || +e } function En() { if (!this.isValid()) return this.localeData().invalidDate(); var e, t, n = Gn(this._milliseconds) / 1e3, s = Gn(this._days), i = Gn(this._months); t = D((e = D(n / 60)) / 60), n %= 60, e %= 60; var r = D(i / 12), a = i %= 12, o = s, u = t, l = e, d = n ? n.toFixed(3).replace(/\.?0+$/, "") : "", h = this.asSeconds(); if (!h) return "P0D"; var c = h < 0 ? "-" : "", f = Vn(this._months) !== Vn(h) ? "-" : "", m = Vn(this._days) !== Vn(h) ? "-" : "", _ = Vn(this._milliseconds) !== Vn(h) ? "-" : ""; return c + "P" + (r ? f + r + "Y" : "") + (a ? f + a + "M" : "") + (o ? m + o + "D" : "") + (u || l || d ? "T" : "") + (u ? _ + u + "H" : "") + (l ? _ + l + "M" : "") + (d ? _ + d + "S" : "") } var In = Ht.prototype; return In.isValid = function () { return this._isValid }, In.abs = function () { var e = this._data; return this._milliseconds = _n(this._milliseconds), this._days = _n(this._days), this._months = _n(this._months), e.milliseconds = _n(e.milliseconds), e.seconds = _n(e.seconds), e.minutes = _n(e.minutes), e.hours = _n(e.hours), e.months = _n(e.months), e.years = _n(e.years), this }, In.add = function (e, t) { return yn(this, e, t, 1) }, In.subtract = function (e, t) { return yn(this, e, t, -1) }, In.as = function (e) { if (!this.isValid()) return NaN; var t, n, s = this._milliseconds; if ("month" === (e = R(e)) || "year" === e) return t = this._days + s / 864e5, n = this._months + pn(t), "month" === e ? n : n / 12; switch (t = this._days + Math.round(vn(this._months)), e) { case "week": return t / 7 + s / 6048e5; case "day": return t + s / 864e5; case "hour": return 24 * t + s / 36e5; case "minute": return 1440 * t + s / 6e4; case "second": return 86400 * t + s / 1e3; case "millisecond": return Math.floor(864e5 * t) + s; default: throw new Error("Unknown unit " + e) } }, In.asMilliseconds = Mn, In.asSeconds = Sn, In.asMinutes = Dn, In.asHours = kn, In.asDays = Yn, In.asWeeks = On, In.asMonths = Tn, In.asYears = xn, In.valueOf = function () { return this.isValid() ? this._milliseconds + 864e5 * this._days + this._months % 12 * 2592e6 + 31536e6 * k(this._months / 12) : NaN }, In._bubble = function () { var e, t, n, s, i, r = this._milliseconds, a = this._days, o = this._months, u = this._data; return 0 <= r && 0 <= a && 0 <= o || r <= 0 && a <= 0 && o <= 0 || (r += 864e5 * gn(vn(o) + a), o = a = 0), u.milliseconds = r % 1e3, e = D(r / 1e3), u.seconds = e % 60, t = D(e / 60), u.minutes = t % 60, n = D(t / 60), u.hours = n % 24, o += i = D(pn(a += D(n / 24))), a -= gn(vn(i)), s = D(o / 12), o %= 12, u.days = a, u.months = o, u.years = s, this }, In.clone = function () { return At(this) }, In.get = function (e) { return e = R(e), this.isValid() ? this[e + "s"]() : NaN }, In.milliseconds = Pn, In.seconds = Wn, In.minutes = Hn, In.hours = Rn, In.days = Cn, In.weeks = function () { return D(this.days() / 7) }, In.months = Fn, In.years = Ln, In.humanize = function (e) { if (!this.isValid()) return this.localeData().invalidDate(); var t, n, s, i, r, a, o, u, l, d, h, c = this.localeData(), f = (n = !e, s = c, i = At(t = this).abs(), r = Un(i.as("s")), a = Un(i.as("m")), o = Un(i.as("h")), u = Un(i.as("d")), l = Un(i.as("M")), d = Un(i.as("y")), (h = r <= Nn.ss && ["s", r] || r < Nn.s && ["ss", r] || a <= 1 && ["m"] || a < Nn.m && ["mm", a] || o <= 1 && ["h"] || o < Nn.h && ["hh", o] || u <= 1 && ["d"] || u < Nn.d && ["dd", u] || l <= 1 && ["M"] || l < Nn.M && ["MM", l] || d <= 1 && ["y"] || ["yy", d])[2] = n, h[3] = 0 < +t, h[4] = s, function (e, t, n, s, i) { return i.relativeTime(t || 1, !!n, e, s) }.apply(null, h)); return e && (f = c.pastFuture(+this, f)), c.postformat(f) }, In.toISOString = En, In.toString = En, In.toJSON = En, In.locale = Qt, In.localeData = Kt, In.toIsoString = n("toIsoString() is deprecated. Please use toISOString() instead (notice the capitals)", En), In.lang = Xt, I("X", 0, 0, "unix"), I("x", 0, 0, "valueOf"), ue("x", se), ue("X", /[+-]?\d+(\.\d{1,3})?/), ce("X", function (e, t, n) { n._d = new Date(1e3 * parseFloat(e, 10)) }), ce("x", function (e, t, n) { n._d = new Date(k(e)) }), c.version = "2.22.1", e = Tt, c.fn = ln, c.min = function () { return Pt("isBefore", [].slice.call(arguments, 0)) }, c.max = function () { return Pt("isAfter", [].slice.call(arguments, 0)) }, c.now = function () { return Date.now ? Date.now() : +new Date }, c.utc = y, c.unix = function (e) { return Tt(1e3 * e) }, c.months = function (e, t) { return fn(e, t, "months") }, c.isDate = h, c.locale = ot, c.invalid = v, c.duration = At, c.isMoment = S, c.weekdays = function (e, t, n) { return mn(e, t, n, "weekdays") }, c.parseZone = function () { return Tt.apply(null, arguments).parseZone() }, c.localeData = lt, c.isDuration = Rt, c.monthsShort = function (e, t) { return fn(e, t, "monthsShort") }, c.weekdaysMin = function (e, t, n) { return mn(e, t, n, "weekdaysMin") }, c.defineLocale = ut, c.updateLocale = function (e, t) { if (null != t) { var n, s, i = nt; null != (s = at(e)) && (i = s._config), (n = new P(t = b(i, t))).parentLocale = st[e], st[e] = n, ot(e) } else null != st[e] && (null != st[e].parentLocale ? st[e] = st[e].parentLocale : null != st[e] && delete st[e]); return st[e] }, c.locales = function () { return s(st) }, c.weekdaysShort = function (e, t, n) { return mn(e, t, n, "weekdaysShort") }, c.normalizeUnits = R, c.relativeTimeRounding = function (e) { return void 0 === e ? Un : "function" == typeof e && (Un = e, !0) }, c.relativeTimeThreshold = function (e, t) { return void 0 !== Nn[e] && (void 0 === t ? Nn[e] : (Nn[e] = t, "s" === e && (Nn.ss = t - 1), !0)) }, c.calendarFormat = function (e, t) { var n = e.diff(t, "days", !0); return n < -6 ? "sameElse" : n < -1 ? "lastWeek" : n < 0 ? "lastDay" : n < 1 ? "sameDay" : n < 2 ? "nextDay" : n < 7 ? "nextWeek" : "sameElse" }, c.prototype = ln, c.HTML5_FMT = { DATETIME_LOCAL: "YYYY-MM-DDTHH:mm", DATETIME_LOCAL_SECONDS: "YYYY-MM-DDTHH:mm:ss", DATETIME_LOCAL_MS: "YYYY-MM-DDTHH:mm:ss.SSS", DATE: "YYYY-MM-DD", TIME: "HH:mm", TIME_SECONDS: "HH:mm:ss", TIME_MS: "HH:mm:ss.SSS", WEEK: "YYYY-[W]WW", MONTH: "YYYY-MM" }, c });
/**
* @version: 3.1
* @author: Dan Grossman http://www.dangrossman.info/
* @copyright: Copyright (c) 2012-2019 Dan Grossman. All rights reserved.
* @license: Licensed under the MIT license. See http://www.opensource.org/licenses/mit-license.php
* @website: http://www.daterangepicker.com/
*/
// Following the UMD template https://github.com/umdjs/umd/blob/master/templates/returnExportsGlobal.js
(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Make globaly available as well
        define(['moment', 'jquery'], function (moment, jquery) {
            if (!jquery.fn) jquery.fn = {}; // webpack server rendering
            if (typeof moment !== 'function' && moment.hasOwnProperty('default')) moment = moment['default']
            return factory(moment, jquery);
        });
    } else if (typeof module === 'object' && module.exports) {
        // Node / Browserify
        //isomorphic issue
        var jQuery = (typeof window != 'undefined') ? window.jQuery : undefined;
        if (!jQuery) {
            jQuery = require('jquery');
            if (!jQuery.fn) jQuery.fn = {};
        }
        var moment = (typeof window != 'undefined' && typeof window.moment != 'undefined') ? window.moment : require('moment');
        module.exports = factory(moment, jQuery);
    } else {
        // Browser globals
        root.daterangepicker = factory(root.moment, root.jQuery);
    }
}(typeof window !== 'undefined' ? window : this, function (moment, $) {
    var DateRangePicker = function (element, options, cb) {

        //default settings for options
        this.parentEl = 'body';
        this.element = $(element);
        this.startDate = moment().startOf('day');
        this.endDate = moment().endOf('day');
        this.minDate = false;
        this.maxDate = false;
        this.maxSpan = false;
        this.autoApply = false;
        this.singleDatePicker = false;
        this.showDropdowns = false;
        this.minYear = moment().subtract(100, 'year').format('YYYY');
        this.maxYear = moment().add(100, 'year').format('YYYY');
        this.showWeekNumbers = false;
        this.showISOWeekNumbers = false;
        this.showCustomRangeLabel = true;
        this.timePicker = false;
        this.timePicker24Hour = false;
        this.timePickerIncrement = 1;
        this.timePickerSeconds = false;
        this.linkedCalendars = true;
        this.autoUpdateInput = true;
        this.alwaysShowCalendars = false;
        this.ranges = {};

        this.opens = 'right';
        if (this.element.hasClass('pull-right'))
            this.opens = 'left';

        this.drops = 'down';
        if (this.element.hasClass('dropup'))
            this.drops = 'up';

        this.buttonClasses = 'btn btn-sm';
        this.applyButtonClasses = 'btn-primary';
        this.cancelButtonClasses = 'btn-default';

        this.locale = {
            direction: 'ltr',
            format: moment.localeData().longDateFormat('L'),
            separator: ' - ',
            applyLabel: 'Apply',
            cancelLabel: 'Cancel',
            weekLabel: 'W',
            customRangeLabel: 'Custom Range',
            daysOfWeek: moment.weekdaysMin(),
            monthNames: moment.monthsShort(),
            firstDay: moment.localeData().firstDayOfWeek()
        };

        this.callback = function () { };

        //some state information
        this.isShowing = false;
        this.leftCalendar = {};
        this.rightCalendar = {};

        //custom options from user
        if (typeof options !== 'object' || options === null)
            options = {};

        //allow setting options with data attributes
        //data-api options will be overwritten with custom javascript options
        options = $.extend(this.element.data(), options);

        //html template for the picker UI
        if (typeof options.template !== 'string' && !(options.template instanceof $))
            options.template =
                '<div class="daterangepicker">' +
                '<div class="ranges"></div>' +
                '<div class="drp-calendar left">' +
                '<div class="calendar-table"></div>' +
                '<div class="calendar-time"></div>' +
                '</div>' +
                '<div class="drp-calendar right">' +
                '<div class="calendar-table"></div>' +
                '<div class="calendar-time"></div>' +
                '</div>' +
                '<div class="drp-buttons">' +
                '<span class="drp-selected"></span>' +
                '<button class="cancelBtn" type="button"></button>' +
                '<button class="applyBtn" disabled="disabled" type="button"></button> ' +
                '</div>' +
                '</div>';

        this.parentEl = (options.parentEl && $(options.parentEl).length) ? $(options.parentEl) : $(this.parentEl);
        this.container = $(options.template).appendTo(this.parentEl);

        //
        // handle all the possible options overriding defaults
        //

        if (typeof options.locale === 'object') {

            if (typeof options.locale.direction === 'string')
                this.locale.direction = options.locale.direction;

            if (typeof options.locale.format === 'string')
                this.locale.format = options.locale.format;

            if (typeof options.locale.separator === 'string')
                this.locale.separator = options.locale.separator;

            if (typeof options.locale.daysOfWeek === 'object')
                this.locale.daysOfWeek = options.locale.daysOfWeek.slice();

            if (typeof options.locale.monthNames === 'object')
                this.locale.monthNames = options.locale.monthNames.slice();

            if (typeof options.locale.firstDay === 'number')
                this.locale.firstDay = options.locale.firstDay;

            if (typeof options.locale.applyLabel === 'string')
                this.locale.applyLabel = options.locale.applyLabel;

            if (typeof options.locale.cancelLabel === 'string')
                this.locale.cancelLabel = options.locale.cancelLabel;

            if (typeof options.locale.weekLabel === 'string')
                this.locale.weekLabel = options.locale.weekLabel;

            if (typeof options.locale.customRangeLabel === 'string') {
                //Support unicode chars in the custom range name.
                var elem = document.createElement('textarea');
                elem.innerHTML = options.locale.customRangeLabel;
                var rangeHtml = elem.value;
                this.locale.customRangeLabel = rangeHtml;
            }
        }
        this.container.addClass(this.locale.direction);

        if (typeof options.startDate === 'string')
            this.startDate = moment(options.startDate, this.locale.format);

        if (typeof options.endDate === 'string')
            this.endDate = moment(options.endDate, this.locale.format);

        if (typeof options.minDate === 'string')
            this.minDate = moment(options.minDate, this.locale.format);

        if (typeof options.maxDate === 'string')
            this.maxDate = moment(options.maxDate, this.locale.format);

        if (typeof options.startDate === 'object')
            this.startDate = moment(options.startDate);

        if (typeof options.endDate === 'object')
            this.endDate = moment(options.endDate);

        if (typeof options.minDate === 'object')
            this.minDate = moment(options.minDate);

        if (typeof options.maxDate === 'object')
            this.maxDate = moment(options.maxDate);

        // sanity check for bad options
        if (this.minDate && this.startDate.isBefore(this.minDate))
            this.startDate = this.minDate.clone();

        // sanity check for bad options
        if (this.maxDate && this.endDate.isAfter(this.maxDate))
            this.endDate = this.maxDate.clone();

        if (typeof options.applyButtonClasses === 'string')
            this.applyButtonClasses = options.applyButtonClasses;

        if (typeof options.applyClass === 'string') //backwards compat
            this.applyButtonClasses = options.applyClass;

        if (typeof options.cancelButtonClasses === 'string')
            this.cancelButtonClasses = options.cancelButtonClasses;

        if (typeof options.cancelClass === 'string') //backwards compat
            this.cancelButtonClasses = options.cancelClass;

        if (typeof options.maxSpan === 'object')
            this.maxSpan = options.maxSpan;

        if (typeof options.dateLimit === 'object') //backwards compat
            this.maxSpan = options.dateLimit;

        if (typeof options.opens === 'string')
            this.opens = options.opens;

        if (typeof options.drops === 'string')
            this.drops = options.drops;

        if (typeof options.showWeekNumbers === 'boolean')
            this.showWeekNumbers = options.showWeekNumbers;

        if (typeof options.showISOWeekNumbers === 'boolean')
            this.showISOWeekNumbers = options.showISOWeekNumbers;

        if (typeof options.buttonClasses === 'string')
            this.buttonClasses = options.buttonClasses;

        if (typeof options.buttonClasses === 'object')
            this.buttonClasses = options.buttonClasses.join(' ');

        if (typeof options.showDropdowns === 'boolean')
            this.showDropdowns = options.showDropdowns;

        if (typeof options.minYear === 'number')
            this.minYear = options.minYear;

        if (typeof options.maxYear === 'number')
            this.maxYear = options.maxYear;

        if (typeof options.showCustomRangeLabel === 'boolean')
            this.showCustomRangeLabel = options.showCustomRangeLabel;

        if (typeof options.singleDatePicker === 'boolean') {
            this.singleDatePicker = options.singleDatePicker;
            if (this.singleDatePicker)
                this.endDate = this.startDate.clone();
        }

        if (typeof options.timePicker === 'boolean')
            this.timePicker = options.timePicker;

        if (typeof options.timePickerSeconds === 'boolean')
            this.timePickerSeconds = options.timePickerSeconds;

        if (typeof options.timePickerIncrement === 'number')
            this.timePickerIncrement = options.timePickerIncrement;

        if (typeof options.timePicker24Hour === 'boolean')
            this.timePicker24Hour = options.timePicker24Hour;

        if (typeof options.autoApply === 'boolean')
            this.autoApply = options.autoApply;

        if (typeof options.autoUpdateInput === 'boolean')
            this.autoUpdateInput = options.autoUpdateInput;

        if (typeof options.linkedCalendars === 'boolean')
            this.linkedCalendars = options.linkedCalendars;

        if (typeof options.isInvalidDate === 'function')
            this.isInvalidDate = options.isInvalidDate;

        if (typeof options.isCustomDate === 'function')
            this.isCustomDate = options.isCustomDate;

        if (typeof options.alwaysShowCalendars === 'boolean')
            this.alwaysShowCalendars = options.alwaysShowCalendars;

        // update day names order to firstDay
        if (this.locale.firstDay != 0) {
            var iterator = this.locale.firstDay;
            while (iterator > 0) {
                this.locale.daysOfWeek.push(this.locale.daysOfWeek.shift());
                iterator--;
            }
        }

        var start, end, range;

        //if no start/end dates set, check if an input element contains initial values
        if (typeof options.startDate === 'undefined' && typeof options.endDate === 'undefined') {
            if ($(this.element).is(':text')) {
                var val = $(this.element).val(),
                    split = val.split(this.locale.separator);

                start = end = null;

                if (split.length == 2) {
                    start = moment(split[0], this.locale.format);
                    end = moment(split[1], this.locale.format);
                } else if (this.singleDatePicker && val !== "") {
                    start = moment(val, this.locale.format);
                    end = moment(val, this.locale.format);
                }
                if (start !== null && end !== null) {
                    this.setStartDate(start);
                    this.setEndDate(end);
                }
            }
        }

        if (typeof options.ranges === 'object') {
            for (range in options.ranges) {

                if (typeof options.ranges[range][0] === 'string')
                    start = moment(options.ranges[range][0], this.locale.format);
                else
                    start = moment(options.ranges[range][0]);

                if (typeof options.ranges[range][1] === 'string')
                    end = moment(options.ranges[range][1], this.locale.format);
                else
                    end = moment(options.ranges[range][1]);

                // If the start or end date exceed those allowed by the minDate or maxSpan
                // options, shorten the range to the allowable period.
                if (this.minDate && start.isBefore(this.minDate))
                    start = this.minDate.clone();

                var maxDate = this.maxDate;
                if (this.maxSpan && maxDate && start.clone().add(this.maxSpan).isAfter(maxDate))
                    maxDate = start.clone().add(this.maxSpan);
                if (maxDate && end.isAfter(maxDate))
                    end = maxDate.clone();

                // If the end of the range is before the minimum or the start of the range is
                // after the maximum, don't display this range option at all.
                if ((this.minDate && end.isBefore(this.minDate, this.timepicker ? 'minute' : 'day'))
                    || (maxDate && start.isAfter(maxDate, this.timepicker ? 'minute' : 'day')))
                    continue;

                //Support unicode chars in the range names.
                var elem = document.createElement('textarea');
                elem.innerHTML = range;
                var rangeHtml = elem.value;

                this.ranges[rangeHtml] = [start, end];
            }

            var list = '<ul>';
            for (range in this.ranges) {
                list += '<li data-range-key="' + range + '">' + range + '</li>';
            }
            if (this.showCustomRangeLabel) {
                list += '<li data-range-key="' + this.locale.customRangeLabel + '">' + this.locale.customRangeLabel + '</li>';
            }
            list += '</ul>';
            this.container.find('.ranges').prepend(list);
        }

        if (typeof cb === 'function') {
            this.callback = cb;
        }

        if (!this.timePicker) {
            this.startDate = this.startDate.startOf('day');
            this.endDate = this.endDate.endOf('day');
            this.container.find('.calendar-time').hide();
        }

        //can't be used together for now
        if (this.timePicker && this.autoApply)
            this.autoApply = false;

        if (this.autoApply) {
            this.container.addClass('auto-apply');
        }

        if (typeof options.ranges === 'object')
            this.container.addClass('show-ranges');

        if (this.singleDatePicker) {
            this.container.addClass('single');
            this.container.find('.drp-calendar.left').addClass('single');
            this.container.find('.drp-calendar.left').show();
            this.container.find('.drp-calendar.right').hide();
            if (!this.timePicker && this.autoApply) {
                this.container.addClass('auto-apply');
            }
        }

        if ((typeof options.ranges === 'undefined' && !this.singleDatePicker) || this.alwaysShowCalendars) {
            this.container.addClass('show-calendar');
        }

        this.container.addClass('opens' + this.opens);

        //apply CSS classes and labels to buttons
        this.container.find('.applyBtn, .cancelBtn').addClass(this.buttonClasses);
        if (this.applyButtonClasses.length)
            this.container.find('.applyBtn').addClass(this.applyButtonClasses);
        if (this.cancelButtonClasses.length)
            this.container.find('.cancelBtn').addClass(this.cancelButtonClasses);
        this.container.find('.applyBtn').html(this.locale.applyLabel);
        this.container.find('.cancelBtn').html(this.locale.cancelLabel);

        //
        // event listeners
        //

        this.container.find('.drp-calendar')
            .on('click.daterangepicker', '.prev', $.proxy(this.clickPrev, this))
            .on('click.daterangepicker', '.next', $.proxy(this.clickNext, this))
            .on('mousedown.daterangepicker', 'td.available', $.proxy(this.clickDate, this))
            .on('mouseenter.daterangepicker', 'td.available', $.proxy(this.hoverDate, this))
            .on('change.daterangepicker', 'select.yearselect', $.proxy(this.monthOrYearChanged, this))
            .on('change.daterangepicker', 'select.monthselect', $.proxy(this.monthOrYearChanged, this))
            .on('change.daterangepicker', 'select.hourselect,select.minuteselect,select.secondselect,select.ampmselect', $.proxy(this.timeChanged, this));

        this.container.find('.ranges')
            .on('click.daterangepicker', 'li', $.proxy(this.clickRange, this));

        this.container.find('.drp-buttons')
            .on('click.daterangepicker', 'button.applyBtn', $.proxy(this.clickApply, this))
            .on('click.daterangepicker', 'button.cancelBtn', $.proxy(this.clickCancel, this));

        if (this.element.is('input') || this.element.is('button')) {
            this.element.on({
                'click.daterangepicker': $.proxy(this.show, this),
                'focus.daterangepicker': $.proxy(this.show, this),
                'keyup.daterangepicker': $.proxy(this.elementChanged, this),
                'keydown.daterangepicker': $.proxy(this.keydown, this) //IE 11 compatibility
            });
        } else {
            this.element.on('click.daterangepicker', $.proxy(this.toggle, this));
            this.element.on('keydown.daterangepicker', $.proxy(this.toggle, this));
        }

        //
        // if attached to a text input, set the initial value
        //

        this.updateElement();

    };

    DateRangePicker.prototype = {

        constructor: DateRangePicker,

        setStartDate: function (startDate) {
            if (typeof startDate === 'string')
                this.startDate = moment(startDate, this.locale.format);

            if (typeof startDate === 'object')
                this.startDate = moment(startDate);

            if (!this.timePicker)
                this.startDate = this.startDate.startOf('day');

            if (this.timePicker && this.timePickerIncrement)
                this.startDate.minute(Math.round(this.startDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);

            if (this.minDate && this.startDate.isBefore(this.minDate)) {
                this.startDate = this.minDate.clone();
                if (this.timePicker && this.timePickerIncrement)
                    this.startDate.minute(Math.round(this.startDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);
            }

            if (this.maxDate && this.startDate.isAfter(this.maxDate)) {
                this.startDate = this.maxDate.clone();
                if (this.timePicker && this.timePickerIncrement)
                    this.startDate.minute(Math.floor(this.startDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);
            }

            if (!this.isShowing)
                this.updateElement();

            this.updateMonthsInView();
        },

        setEndDate: function (endDate) {
            if (typeof endDate === 'string')
                this.endDate = moment(endDate, this.locale.format);

            if (typeof endDate === 'object')
                this.endDate = moment(endDate);

            if (!this.timePicker)
                this.endDate = this.endDate.endOf('day');

            if (this.timePicker && this.timePickerIncrement)
                this.endDate.minute(Math.round(this.endDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);

            if (this.endDate.isBefore(this.startDate))
                this.endDate = this.startDate.clone();

            if (this.maxDate && this.endDate.isAfter(this.maxDate))
                this.endDate = this.maxDate.clone();

            if (this.maxSpan && this.startDate.clone().add(this.maxSpan).isBefore(this.endDate))
                this.endDate = this.startDate.clone().add(this.maxSpan);

            this.previousRightTime = this.endDate.clone();

            this.container.find('.drp-selected').html(this.startDate.format(this.locale.format) + this.locale.separator + this.endDate.format(this.locale.format));

            if (!this.isShowing)
                this.updateElement();

            this.updateMonthsInView();
        },

        isInvalidDate: function () {
            return false;
        },

        isCustomDate: function () {
            return false;
        },

        updateView: function () {
            if (this.timePicker) {
                this.renderTimePicker('left');
                this.renderTimePicker('right');
                if (!this.endDate) {
                    this.container.find('.right .calendar-time select').prop('disabled', true).addClass('disabled');
                } else {
                    this.container.find('.right .calendar-time select').prop('disabled', false).removeClass('disabled');
                }
            }
            if (this.endDate)
                this.container.find('.drp-selected').html(this.startDate.format(this.locale.format) + this.locale.separator + this.endDate.format(this.locale.format));
            this.updateMonthsInView();
            this.updateCalendars();
            this.updateFormInputs();
        },

        updateMonthsInView: function () {
            if (this.endDate) {

                //if both dates are visible already, do nothing
                if (!this.singleDatePicker && this.leftCalendar.month && this.rightCalendar.month &&
                    (this.startDate.format('YYYY-MM') == this.leftCalendar.month.format('YYYY-MM') || this.startDate.format('YYYY-MM') == this.rightCalendar.month.format('YYYY-MM'))
                    &&
                    (this.endDate.format('YYYY-MM') == this.leftCalendar.month.format('YYYY-MM') || this.endDate.format('YYYY-MM') == this.rightCalendar.month.format('YYYY-MM'))
                ) {
                    return;
                }

                this.leftCalendar.month = this.startDate.clone().date(2);
                if (!this.linkedCalendars && (this.endDate.month() != this.startDate.month() || this.endDate.year() != this.startDate.year())) {
                    this.rightCalendar.month = this.endDate.clone().date(2);
                } else {
                    this.rightCalendar.month = this.startDate.clone().date(2).add(1, 'month');
                }

            } else {
                if (this.leftCalendar.month.format('YYYY-MM') != this.startDate.format('YYYY-MM') && this.rightCalendar.month.format('YYYY-MM') != this.startDate.format('YYYY-MM')) {
                    this.leftCalendar.month = this.startDate.clone().date(2);
                    this.rightCalendar.month = this.startDate.clone().date(2).add(1, 'month');
                }
            }
            if (this.maxDate && this.linkedCalendars && !this.singleDatePicker && this.rightCalendar.month > this.maxDate) {
                this.rightCalendar.month = this.maxDate.clone().date(2);
                this.leftCalendar.month = this.maxDate.clone().date(2).subtract(1, 'month');
            }
        },

        updateCalendars: function () {

            if (this.timePicker) {
                var hour, minute, second;
                if (this.endDate) {
                    hour = parseInt(this.container.find('.left .hourselect').val(), 10);
                    minute = parseInt(this.container.find('.left .minuteselect').val(), 10);
                    if (isNaN(minute)) {
                        minute = parseInt(this.container.find('.left .minuteselect option:last').val(), 10);
                    }
                    second = this.timePickerSeconds ? parseInt(this.container.find('.left .secondselect').val(), 10) : 0;
                    if (!this.timePicker24Hour) {
                        var ampm = this.container.find('.left .ampmselect').val();
                        if (ampm === 'PM' && hour < 12)
                            hour += 12;
                        if (ampm === 'AM' && hour === 12)
                            hour = 0;
                    }
                } else {
                    hour = parseInt(this.container.find('.right .hourselect').val(), 10);
                    minute = parseInt(this.container.find('.right .minuteselect').val(), 10);
                    if (isNaN(minute)) {
                        minute = parseInt(this.container.find('.right .minuteselect option:last').val(), 10);
                    }
                    second = this.timePickerSeconds ? parseInt(this.container.find('.right .secondselect').val(), 10) : 0;
                    if (!this.timePicker24Hour) {
                        var ampm = this.container.find('.right .ampmselect').val();
                        if (ampm === 'PM' && hour < 12)
                            hour += 12;
                        if (ampm === 'AM' && hour === 12)
                            hour = 0;
                    }
                }
                this.leftCalendar.month.hour(hour).minute(minute).second(second);
                this.rightCalendar.month.hour(hour).minute(minute).second(second);
            }

            this.renderCalendar('left');
            this.renderCalendar('right');

            //highlight any predefined range matching the current start and end dates
            this.container.find('.ranges li').removeClass('active');
            if (this.endDate == null) return;

            this.calculateChosenLabel();
        },

        renderCalendar: function (side) {

            //
            // Build the matrix of dates that will populate the calendar
            //

            var calendar = side == 'left' ? this.leftCalendar : this.rightCalendar;
            var month = calendar.month.month();
            var year = calendar.month.year();
            var hour = calendar.month.hour();
            var minute = calendar.month.minute();
            var second = calendar.month.second();
            var daysInMonth = moment([year, month]).daysInMonth();
            var firstDay = moment([year, month, 1]);
            var lastDay = moment([year, month, daysInMonth]);
            var lastMonth = moment(firstDay).subtract(1, 'month').month();
            var lastYear = moment(firstDay).subtract(1, 'month').year();
            var daysInLastMonth = moment([lastYear, lastMonth]).daysInMonth();
            var dayOfWeek = firstDay.day();

            //initialize a 6 rows x 7 columns array for the calendar
            var calendar = [];
            calendar.firstDay = firstDay;
            calendar.lastDay = lastDay;

            for (var i = 0; i < 6; i++) {
                calendar[i] = [];
            }

            //populate the calendar with date objects
            var startDay = daysInLastMonth - dayOfWeek + this.locale.firstDay + 1;
            if (startDay > daysInLastMonth)
                startDay -= 7;

            if (dayOfWeek == this.locale.firstDay)
                startDay = daysInLastMonth - 6;

            var curDate = moment([lastYear, lastMonth, startDay, 12, minute, second]);

            var col, row;
            for (var i = 0, col = 0, row = 0; i < 42; i++, col++, curDate = moment(curDate).add(24, 'hour')) {
                if (i > 0 && col % 7 === 0) {
                    col = 0;
                    row++;
                }
                calendar[row][col] = curDate.clone().hour(hour).minute(minute).second(second);
                curDate.hour(12);

                if (this.minDate && calendar[row][col].format('YYYY-MM-DD') == this.minDate.format('YYYY-MM-DD') && calendar[row][col].isBefore(this.minDate) && side == 'left') {
                    calendar[row][col] = this.minDate.clone();
                }

                if (this.maxDate && calendar[row][col].format('YYYY-MM-DD') == this.maxDate.format('YYYY-MM-DD') && calendar[row][col].isAfter(this.maxDate) && side == 'right') {
                    calendar[row][col] = this.maxDate.clone();
                }

            }

            //make the calendar object available to hoverDate/clickDate
            if (side == 'left') {
                this.leftCalendar.calendar = calendar;
            } else {
                this.rightCalendar.calendar = calendar;
            }

            //
            // Display the calendar
            //

            var minDate = side == 'left' ? this.minDate : this.startDate;
            var maxDate = this.maxDate;
            var selected = side == 'left' ? this.startDate : this.endDate;
            var arrow = this.locale.direction == 'ltr' ? { left: 'chevron-left', right: 'chevron-right' } : { left: 'chevron-right', right: 'chevron-left' };

            var html = '<table class="table-condensed">';
            html += '<thead>';
            html += '<tr>';

            // add empty cell for week number
            if (this.showWeekNumbers || this.showISOWeekNumbers)
                html += '<th></th>';

            if ((!minDate || minDate.isBefore(calendar.firstDay)) && (!this.linkedCalendars || side == 'left')) {
                html += '<th class="prev available"><span></span></th>';
            } else {
                html += '<th></th>';
            }

            var dateHtml = this.locale.monthNames[calendar[1][1].month()] + calendar[1][1].format(" YYYY");

            if (this.showDropdowns) {
                var currentMonth = calendar[1][1].month();
                var currentYear = calendar[1][1].year();
                var maxYear = (maxDate && maxDate.year()) || (this.maxYear);
                var minYear = (minDate && minDate.year()) || (this.minYear);
                var inMinYear = currentYear == minYear;
                var inMaxYear = currentYear == maxYear;

                var monthHtml = '<select class="monthselect">';
                for (var m = 0; m < 12; m++) {
                    if ((!inMinYear || (minDate && m >= minDate.month())) && (!inMaxYear || (maxDate && m <= maxDate.month()))) {
                        monthHtml += "<option value='" + m + "'" +
                            (m === currentMonth ? " selected='selected'" : "") +
                            ">" + this.locale.monthNames[m] + "</option>";
                    } else {
                        monthHtml += "<option value='" + m + "'" +
                            (m === currentMonth ? " selected='selected'" : "") +
                            " disabled='disabled'>" + this.locale.monthNames[m] + "</option>";
                    }
                }
                monthHtml += "</select>";

                var yearHtml = '<select class="yearselect">';
                for (var y = minYear; y <= maxYear; y++) {
                    yearHtml += '<option value="' + y + '"' +
                        (y === currentYear ? ' selected="selected"' : '') +
                        '>' + y + '</option>';
                }
                yearHtml += '</select>';

                dateHtml = monthHtml + yearHtml;
            }

            html += '<th colspan="5" class="month">' + dateHtml + '</th>';
            if ((!maxDate || maxDate.isAfter(calendar.lastDay)) && (!this.linkedCalendars || side == 'right' || this.singleDatePicker)) {
                html += '<th class="next available"><span></span></th>';
            } else {
                html += '<th></th>';
            }

            html += '</tr>';
            html += '<tr>';

            // add week number label
            if (this.showWeekNumbers || this.showISOWeekNumbers)
                html += '<th class="week">' + this.locale.weekLabel + '</th>';

            $.each(this.locale.daysOfWeek, function (index, dayOfWeek) {
                html += '<th>' + dayOfWeek + '</th>';
            });

            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //adjust maxDate to reflect the maxSpan setting in order to
            //grey out end dates beyond the maxSpan
            if (this.endDate == null && this.maxSpan) {
                var maxLimit = this.startDate.clone().add(this.maxSpan).endOf('day');
                if (!maxDate || maxLimit.isBefore(maxDate)) {
                    maxDate = maxLimit;
                }
            }

            for (var row = 0; row < 6; row++) {
                html += '<tr>';

                // add week number
                if (this.showWeekNumbers)
                    html += '<td class="week">' + calendar[row][0].week() + '</td>';
                else if (this.showISOWeekNumbers)
                    html += '<td class="week">' + calendar[row][0].isoWeek() + '</td>';

                for (var col = 0; col < 7; col++) {

                    var classes = [];

                    //highlight today's date
                    if (calendar[row][col].isSame(new Date(), "day"))
                        classes.push('today');

                    //highlight weekends
                    if (calendar[row][col].isoWeekday() > 5)
                        classes.push('weekend');

                    //grey out the dates in other months displayed at beginning and end of this calendar
                    if (calendar[row][col].month() != calendar[1][1].month())
                        classes.push('off', 'ends');

                    //don't allow selection of dates before the minimum date
                    if (this.minDate && calendar[row][col].isBefore(this.minDate, 'day'))
                        classes.push('off', 'disabled');

                    //don't allow selection of dates after the maximum date
                    if (maxDate && calendar[row][col].isAfter(maxDate, 'day'))
                        classes.push('off', 'disabled');

                    //don't allow selection of date if a custom function decides it's invalid
                    if (this.isInvalidDate(calendar[row][col]))
                        classes.push('off', 'disabled');

                    //highlight the currently selected start date
                    if (calendar[row][col].format('YYYY-MM-DD') == this.startDate.format('YYYY-MM-DD'))
                        classes.push('active', 'start-date');

                    //highlight the currently selected end date
                    if (this.endDate != null && calendar[row][col].format('YYYY-MM-DD') == this.endDate.format('YYYY-MM-DD'))
                        classes.push('active', 'end-date');

                    //highlight dates in-between the selected dates
                    if (this.endDate != null && calendar[row][col] > this.startDate && calendar[row][col] < this.endDate)
                        classes.push('in-range');

                    //apply custom classes for this date
                    var isCustom = this.isCustomDate(calendar[row][col]);
                    if (isCustom !== false) {
                        if (typeof isCustom === 'string')
                            classes.push(isCustom);
                        else
                            Array.prototype.push.apply(classes, isCustom);
                    }

                    var cname = '', disabled = false;
                    for (var i = 0; i < classes.length; i++) {
                        cname += classes[i] + ' ';
                        if (classes[i] == 'disabled')
                            disabled = true;
                    }
                    if (!disabled)
                        cname += 'available';

                    html += '<td class="' + cname.replace(/^\s+|\s+$/g, '') + '" data-title="' + 'r' + row + 'c' + col + '">' + calendar[row][col].date() + '</td>';

                }
                html += '</tr>';
            }

            html += '</tbody>';
            html += '</table>';

            this.container.find('.drp-calendar.' + side + ' .calendar-table').html(html);

        },

        renderTimePicker: function (side) {

            // Don't bother updating the time picker if it's currently disabled
            // because an end date hasn't been clicked yet
            if (side == 'right' && !this.endDate) return;

            var html, selected, minDate, maxDate = this.maxDate;

            if (this.maxSpan && (!this.maxDate || this.startDate.clone().add(this.maxSpan).isBefore(this.maxDate)))
                maxDate = this.startDate.clone().add(this.maxSpan);

            if (side == 'left') {
                selected = this.startDate.clone();
                minDate = this.minDate;
            } else if (side == 'right') {
                selected = this.endDate.clone();
                minDate = this.startDate;

                //Preserve the time already selected
                var timeSelector = this.container.find('.drp-calendar.right .calendar-time');
                if (timeSelector.html() != '') {

                    selected.hour(!isNaN(selected.hour()) ? selected.hour() : timeSelector.find('.hourselect option:selected').val());
                    selected.minute(!isNaN(selected.minute()) ? selected.minute() : timeSelector.find('.minuteselect option:selected').val());
                    selected.second(!isNaN(selected.second()) ? selected.second() : timeSelector.find('.secondselect option:selected').val());

                    if (!this.timePicker24Hour) {
                        var ampm = timeSelector.find('.ampmselect option:selected').val();
                        if (ampm === 'PM' && selected.hour() < 12)
                            selected.hour(selected.hour() + 12);
                        if (ampm === 'AM' && selected.hour() === 12)
                            selected.hour(0);
                    }

                }

                if (selected.isBefore(this.startDate))
                    selected = this.startDate.clone();

                if (maxDate && selected.isAfter(maxDate))
                    selected = maxDate.clone();

            }

            //
            // hours
            //

            html = '<select class="hourselect">';

            var start = this.timePicker24Hour ? 0 : 1;
            var end = this.timePicker24Hour ? 23 : 12;

            for (var i = start; i <= end; i++) {
                var i_in_24 = i;
                if (!this.timePicker24Hour)
                    i_in_24 = selected.hour() >= 12 ? (i == 12 ? 12 : i + 12) : (i == 12 ? 0 : i);

                var time = selected.clone().hour(i_in_24);
                var disabled = false;
                if (minDate && time.minute(59).isBefore(minDate))
                    disabled = true;
                if (maxDate && time.minute(0).isAfter(maxDate))
                    disabled = true;

                if (i_in_24 == selected.hour() && !disabled) {
                    html += '<option value="' + i + '" selected="selected">' + i + '</option>';
                } else if (disabled) {
                    html += '<option value="' + i + '" disabled="disabled" class="disabled">' + i + '</option>';
                } else {
                    html += '<option value="' + i + '">' + i + '</option>';
                }
            }

            html += '</select> ';

            //
            // minutes
            //

            html += ': <select class="minuteselect">';

            for (var i = 0; i < 60; i += this.timePickerIncrement) {
                var padded = i < 10 ? '0' + i : i;
                var time = selected.clone().minute(i);

                var disabled = false;
                if (minDate && time.second(59).isBefore(minDate))
                    disabled = true;
                if (maxDate && time.second(0).isAfter(maxDate))
                    disabled = true;

                if (selected.minute() == i && !disabled) {
                    html += '<option value="' + i + '" selected="selected">' + padded + '</option>';
                } else if (disabled) {
                    html += '<option value="' + i + '" disabled="disabled" class="disabled">' + padded + '</option>';
                } else {
                    html += '<option value="' + i + '">' + padded + '</option>';
                }
            }

            html += '</select> ';

            //
            // seconds
            //

            if (this.timePickerSeconds) {
                html += ': <select class="secondselect">';

                for (var i = 0; i < 60; i++) {
                    var padded = i < 10 ? '0' + i : i;
                    var time = selected.clone().second(i);

                    var disabled = false;
                    if (minDate && time.isBefore(minDate))
                        disabled = true;
                    if (maxDate && time.isAfter(maxDate))
                        disabled = true;

                    if (selected.second() == i && !disabled) {
                        html += '<option value="' + i + '" selected="selected">' + padded + '</option>';
                    } else if (disabled) {
                        html += '<option value="' + i + '" disabled="disabled" class="disabled">' + padded + '</option>';
                    } else {
                        html += '<option value="' + i + '">' + padded + '</option>';
                    }
                }

                html += '</select> ';
            }

            //
            // AM/PM
            //

            if (!this.timePicker24Hour) {
                html += '<select class="ampmselect">';

                var am_html = '';
                var pm_html = '';

                if (minDate && selected.clone().hour(12).minute(0).second(0).isBefore(minDate))
                    am_html = ' disabled="disabled" class="disabled"';

                if (maxDate && selected.clone().hour(0).minute(0).second(0).isAfter(maxDate))
                    pm_html = ' disabled="disabled" class="disabled"';

                if (selected.hour() >= 12) {
                    html += '<option value="AM"' + am_html + '>AM</option><option value="PM" selected="selected"' + pm_html + '>PM</option>';
                } else {
                    html += '<option value="AM" selected="selected"' + am_html + '>AM</option><option value="PM"' + pm_html + '>PM</option>';
                }

                html += '</select>';
            }

            this.container.find('.drp-calendar.' + side + ' .calendar-time').html(html);

        },

        updateFormInputs: function () {

            if (this.singleDatePicker || (this.endDate && (this.startDate.isBefore(this.endDate) || this.startDate.isSame(this.endDate)))) {
                this.container.find('button.applyBtn').prop('disabled', false);
            } else {
                this.container.find('button.applyBtn').prop('disabled', true);
            }

        },

        move: function () {
            var parentOffset = { top: 0, left: 0 },
                containerTop,
                drops = this.drops;

            var parentRightEdge = $(window).width();
            if (!this.parentEl.is('body')) {
                parentOffset = {
                    top: this.parentEl.offset().top - this.parentEl.scrollTop(),
                    left: this.parentEl.offset().left - this.parentEl.scrollLeft()
                };
                parentRightEdge = this.parentEl[0].clientWidth + this.parentEl.offset().left;
            }

            switch (drops) {
                case 'auto':
                    containerTop = this.element.offset().top + this.element.outerHeight() - parentOffset.top;
                    if (containerTop + this.container.outerHeight() >= this.parentEl[0].scrollHeight) {
                        containerTop = this.element.offset().top - this.container.outerHeight() - parentOffset.top;
                        drops = 'up';
                    }
                    break;
                case 'up':
                    containerTop = this.element.offset().top - this.container.outerHeight() - parentOffset.top;
                    break;
                default:
                    containerTop = this.element.offset().top + this.element.outerHeight() - parentOffset.top;
                    break;
            }

            // Force the container to it's actual width
            this.container.css({
                top: 0,
                left: 0,
                right: 'auto'
            });
            var containerWidth = this.container.outerWidth();

            this.container.toggleClass('drop-up', drops == 'up');

            if (this.opens == 'left') {
                var containerRight = parentRightEdge - this.element.offset().left - this.element.outerWidth();
                if (containerWidth + containerRight > $(window).width()) {
                    this.container.css({
                        top: containerTop,
                        right: 'auto',
                        left: 9
                    });
                } else {
                    this.container.css({
                        top: containerTop,
                        right: containerRight,
                        left: 'auto'
                    });
                }
            } else if (this.opens == 'center') {
                var containerLeft = this.element.offset().left - parentOffset.left + this.element.outerWidth() / 2
                    - containerWidth / 2;
                if (containerLeft < 0) {
                    this.container.css({
                        top: containerTop,
                        right: 'auto',
                        left: 9
                    });
                } else if (containerLeft + containerWidth > $(window).width()) {
                    this.container.css({
                        top: containerTop,
                        left: 'auto',
                        right: 0
                    });
                } else {
                    this.container.css({
                        top: containerTop,
                        left: containerLeft,
                        right: 'auto'
                    });
                }
            } else {
                var containerLeft = this.element.offset().left - parentOffset.left;
                if (containerLeft + containerWidth > $(window).width()) {
                    this.container.css({
                        top: containerTop,
                        left: 'auto',
                        right: 0
                    });
                } else {
                    this.container.css({
                        top: containerTop,
                        left: containerLeft,
                        right: 'auto'
                    });
                }
            }
        },

        show: function (e) {
            if (this.isShowing) return;

            // Create a click proxy that is private to this instance of datepicker, for unbinding
            this._outsideClickProxy = $.proxy(function (e) { this.outsideClick(e); }, this);

            // Bind global datepicker mousedown for hiding and
            $(document)
                .on('mousedown.daterangepicker', this._outsideClickProxy)
                // also support mobile devices
                .on('touchend.daterangepicker', this._outsideClickProxy)
                // also explicitly play nice with Bootstrap dropdowns, which stopPropagation when clicking them
                .on('click.daterangepicker', '[data-toggle=dropdown]', this._outsideClickProxy)
                // and also close when focus changes to outside the picker (eg. tabbing between controls)
                .on('focusin.daterangepicker', this._outsideClickProxy);

            // Reposition the picker if the window is resized while it's open
            $(window).on('resize.daterangepicker', $.proxy(function (e) { this.move(e); }, this));

            this.oldStartDate = this.startDate.clone();
            this.oldEndDate = this.endDate.clone();
            this.previousRightTime = this.endDate.clone();

            this.updateView();
            this.container.show();
            this.move();
            this.element.trigger('show.daterangepicker', this);
            this.isShowing = true;
        },

        hide: function (e) {
            if (!this.isShowing) return;

            //incomplete date selection, revert to last values
            if (!this.endDate) {
                this.startDate = this.oldStartDate.clone();
                this.endDate = this.oldEndDate.clone();
            }

            //if a new date range was selected, invoke the user callback function
            if (!this.startDate.isSame(this.oldStartDate) || !this.endDate.isSame(this.oldEndDate))
                this.callback(this.startDate.clone(), this.endDate.clone(), this.chosenLabel);

            //if picker is attached to a text input, update it
            this.updateElement();

            $(document).off('.daterangepicker');
            $(window).off('.daterangepicker');
            this.container.hide();
            this.element.trigger('hide.daterangepicker', this);
            this.isShowing = false;
        },

        toggle: function (e) {
            if (this.isShowing) {
                this.hide();
            } else {
                this.show();
            }
        },

        outsideClick: function (e) {
            var target = $(e.target);
            // if the page is clicked anywhere except within the daterangerpicker/button
            // itself then call this.hide()
            if (
                // ie modal dialog fix
                e.type == "focusin" ||
                target.closest(this.element).length ||
                target.closest(this.container).length ||
                target.closest('.calendar-table').length
            ) return;
            this.hide();
            this.element.trigger('outsideClick.daterangepicker', this);
        },

        showCalendars: function () {
            this.container.addClass('show-calendar');
            this.move();
            this.element.trigger('showCalendar.daterangepicker', this);
        },

        hideCalendars: function () {
            this.container.removeClass('show-calendar');
            this.element.trigger('hideCalendar.daterangepicker', this);
        },

        clickRange: function (e) {
            var label = e.target.getAttribute('data-range-key');
            this.chosenLabel = label;
            if (label == this.locale.customRangeLabel) {
                this.showCalendars();
            } else {
                var dates = this.ranges[label];
                this.startDate = dates[0];
                this.endDate = dates[1];

                if (!this.timePicker) {
                    this.startDate.startOf('day');
                    this.endDate.endOf('day');
                }

                if (!this.alwaysShowCalendars)
                    this.hideCalendars();
                this.clickApply();
            }
        },

        clickPrev: function (e) {
            var cal = $(e.target).parents('.drp-calendar');
            if (cal.hasClass('left')) {
                this.leftCalendar.month.subtract(1, 'month');
                if (this.linkedCalendars)
                    this.rightCalendar.month.subtract(1, 'month');
            } else {
                this.rightCalendar.month.subtract(1, 'month');
            }
            this.updateCalendars();
        },

        clickNext: function (e) {
            var cal = $(e.target).parents('.drp-calendar');
            if (cal.hasClass('left')) {
                this.leftCalendar.month.add(1, 'month');
            } else {
                this.rightCalendar.month.add(1, 'month');
                if (this.linkedCalendars)
                    this.leftCalendar.month.add(1, 'month');
            }
            this.updateCalendars();
        },

        hoverDate: function (e) {

            //ignore dates that can't be selected
            if (!$(e.target).hasClass('available')) return;

            var title = $(e.target).attr('data-title');
            var row = title.substr(1, 1);
            var col = title.substr(3, 1);
            var cal = $(e.target).parents('.drp-calendar');
            var date = cal.hasClass('left') ? this.leftCalendar.calendar[row][col] : this.rightCalendar.calendar[row][col];

            //highlight the dates between the start date and the date being hovered as a potential end date
            var leftCalendar = this.leftCalendar;
            var rightCalendar = this.rightCalendar;
            var startDate = this.startDate;
            if (!this.endDate) {
                this.container.find('.drp-calendar tbody td').each(function (index, el) {

                    //skip week numbers, only look at dates
                    if ($(el).hasClass('week')) return;

                    var title = $(el).attr('data-title');
                    var row = title.substr(1, 1);
                    var col = title.substr(3, 1);
                    var cal = $(el).parents('.drp-calendar');
                    var dt = cal.hasClass('left') ? leftCalendar.calendar[row][col] : rightCalendar.calendar[row][col];

                    if ((dt.isAfter(startDate) && dt.isBefore(date)) || dt.isSame(date, 'day')) {
                        $(el).addClass('in-range');
                    } else {
                        $(el).removeClass('in-range');
                    }

                });
            }

        },

        clickDate: function (e) {

            if (!$(e.target).hasClass('available')) return;

            var title = $(e.target).attr('data-title');
            var row = title.substr(1, 1);
            var col = title.substr(3, 1);
            var cal = $(e.target).parents('.drp-calendar');
            var date = cal.hasClass('left') ? this.leftCalendar.calendar[row][col] : this.rightCalendar.calendar[row][col];

            //
            // this function needs to do a few things:
            // * alternate between selecting a start and end date for the range,
            // * if the time picker is enabled, apply the hour/minute/second from the select boxes to the clicked date
            // * if autoapply is enabled, and an end date was chosen, apply the selection
            // * if single date picker mode, and time picker isn't enabled, apply the selection immediately
            // * if one of the inputs above the calendars was focused, cancel that manual input
            //

            if (this.endDate || date.isBefore(this.startDate, 'day')) { //picking start
                if (this.timePicker) {
                    var hour = parseInt(this.container.find('.left .hourselect').val(), 10);
                    if (!this.timePicker24Hour) {
                        var ampm = this.container.find('.left .ampmselect').val();
                        if (ampm === 'PM' && hour < 12)
                            hour += 12;
                        if (ampm === 'AM' && hour === 12)
                            hour = 0;
                    }
                    var minute = parseInt(this.container.find('.left .minuteselect').val(), 10);
                    if (isNaN(minute)) {
                        minute = parseInt(this.container.find('.left .minuteselect option:last').val(), 10);
                    }
                    var second = this.timePickerSeconds ? parseInt(this.container.find('.left .secondselect').val(), 10) : 0;
                    date = date.clone().hour(hour).minute(minute).second(second);
                }
                this.endDate = null;
                this.setStartDate(date.clone());
            } else if (!this.endDate && date.isBefore(this.startDate)) {
                //special case: clicking the same date for start/end,
                //but the time of the end date is before the start date
                this.setEndDate(this.startDate.clone());
            } else { // picking end
                if (this.timePicker) {
                    var hour = parseInt(this.container.find('.right .hourselect').val(), 10);
                    if (!this.timePicker24Hour) {
                        var ampm = this.container.find('.right .ampmselect').val();
                        if (ampm === 'PM' && hour < 12)
                            hour += 12;
                        if (ampm === 'AM' && hour === 12)
                            hour = 0;
                    }
                    var minute = parseInt(this.container.find('.right .minuteselect').val(), 10);
                    if (isNaN(minute)) {
                        minute = parseInt(this.container.find('.right .minuteselect option:last').val(), 10);
                    }
                    var second = this.timePickerSeconds ? parseInt(this.container.find('.right .secondselect').val(), 10) : 0;
                    date = date.clone().hour(hour).minute(minute).second(second);
                }
                this.setEndDate(date.clone());
                if (this.autoApply) {
                    this.calculateChosenLabel();
                    this.clickApply();
                }
            }

            if (this.singleDatePicker) {
                this.setEndDate(this.startDate);
                if (!this.timePicker && this.autoApply)
                    this.clickApply();
            }

            this.updateView();

            //This is to cancel the blur event handler if the mouse was in one of the inputs
            e.stopPropagation();

        },

        calculateChosenLabel: function () {
            var customRange = true;
            var i = 0;
            for (var range in this.ranges) {
                if (this.timePicker) {
                    var format = this.timePickerSeconds ? "YYYY-MM-DD HH:mm:ss" : "YYYY-MM-DD HH:mm";
                    //ignore times when comparing dates if time picker seconds is not enabled
                    if (this.startDate.format(format) == this.ranges[range][0].format(format) && this.endDate.format(format) == this.ranges[range][1].format(format)) {
                        customRange = false;
                        this.chosenLabel = this.container.find('.ranges li:eq(' + i + ')').addClass('active').attr('data-range-key');
                        break;
                    }
                } else {
                    //ignore times when comparing dates if time picker is not enabled
                    if (this.startDate.format('YYYY-MM-DD') == this.ranges[range][0].format('YYYY-MM-DD') && this.endDate.format('YYYY-MM-DD') == this.ranges[range][1].format('YYYY-MM-DD')) {
                        customRange = false;
                        this.chosenLabel = this.container.find('.ranges li:eq(' + i + ')').addClass('active').attr('data-range-key');
                        break;
                    }
                }
                i++;
            }
            if (customRange) {
                if (this.showCustomRangeLabel) {
                    this.chosenLabel = this.container.find('.ranges li:last').addClass('active').attr('data-range-key');
                } else {
                    this.chosenLabel = null;
                }
                this.showCalendars();
            }
        },

        clickApply: function (e) {
            this.hide();
            this.element.trigger('apply.daterangepicker', this);
        },

        clickCancel: function (e) {
            this.startDate = this.oldStartDate;
            this.endDate = this.oldEndDate;
            this.hide();
            this.element.trigger('cancel.daterangepicker', this);
        },

        monthOrYearChanged: function (e) {
            var isLeft = $(e.target).closest('.drp-calendar').hasClass('left'),
                leftOrRight = isLeft ? 'left' : 'right',
                cal = this.container.find('.drp-calendar.' + leftOrRight);

            // Month must be Number for new moment versions
            var month = parseInt(cal.find('.monthselect').val(), 10);
            var year = cal.find('.yearselect').val();

            if (!isLeft) {
                if (year < this.startDate.year() || (year == this.startDate.year() && month < this.startDate.month())) {
                    month = this.startDate.month();
                    year = this.startDate.year();
                }
            }

            if (this.minDate) {
                if (year < this.minDate.year() || (year == this.minDate.year() && month < this.minDate.month())) {
                    month = this.minDate.month();
                    year = this.minDate.year();
                }
            }

            if (this.maxDate) {
                if (year > this.maxDate.year() || (year == this.maxDate.year() && month > this.maxDate.month())) {
                    month = this.maxDate.month();
                    year = this.maxDate.year();
                }
            }

            if (isLeft) {
                this.leftCalendar.month.month(month).year(year);
                if (this.linkedCalendars)
                    this.rightCalendar.month = this.leftCalendar.month.clone().add(1, 'month');
            } else {
                this.rightCalendar.month.month(month).year(year);
                if (this.linkedCalendars)
                    this.leftCalendar.month = this.rightCalendar.month.clone().subtract(1, 'month');
            }
            this.updateCalendars();
        },

        timeChanged: function (e) {

            var cal = $(e.target).closest('.drp-calendar'),
                isLeft = cal.hasClass('left');

            var hour = parseInt(cal.find('.hourselect').val(), 10);
            var minute = parseInt(cal.find('.minuteselect').val(), 10);
            if (isNaN(minute)) {
                minute = parseInt(cal.find('.minuteselect option:last').val(), 10);
            }
            var second = this.timePickerSeconds ? parseInt(cal.find('.secondselect').val(), 10) : 0;

            if (!this.timePicker24Hour) {
                var ampm = cal.find('.ampmselect').val();
                if (ampm === 'PM' && hour < 12)
                    hour += 12;
                if (ampm === 'AM' && hour === 12)
                    hour = 0;
            }

            if (isLeft) {
                var start = this.startDate.clone();
                start.hour(hour);
                start.minute(minute);
                start.second(second);
                this.setStartDate(start);
                if (this.singleDatePicker) {
                    this.endDate = this.startDate.clone();
                } else if (this.endDate && this.endDate.format('YYYY-MM-DD') == start.format('YYYY-MM-DD') && this.endDate.isBefore(start)) {
                    this.setEndDate(start.clone());
                }
            } else if (this.endDate) {
                var end = this.endDate.clone();
                end.hour(hour);
                end.minute(minute);
                end.second(second);
                this.setEndDate(end);
            }

            //update the calendars so all clickable dates reflect the new time component
            this.updateCalendars();

            //update the form inputs above the calendars with the new time
            this.updateFormInputs();

            //re-render the time pickers because changing one selection can affect what's enabled in another
            this.renderTimePicker('left');
            this.renderTimePicker('right');

        },

        elementChanged: function () {
            if (!this.element.is('input')) return;
            if (!this.element.val().length) return;

            var dateString = this.element.val().split(this.locale.separator),
                start = null,
                end = null;

            if (dateString.length === 2) {
                start = moment(dateString[0], this.locale.format);
                end = moment(dateString[1], this.locale.format);
            }

            if (this.singleDatePicker || start === null || end === null) {
                start = moment(this.element.val(), this.locale.format);
                end = start;
            }

            if (!start.isValid() || !end.isValid()) return;

            this.setStartDate(start);
            this.setEndDate(end);
            this.updateView();
        },

        keydown: function (e) {
            //hide on tab or enter
            if ((e.keyCode === 9) || (e.keyCode === 13)) {
                this.hide();
            }

            //hide on esc and prevent propagation
            if (e.keyCode === 27) {
                e.preventDefault();
                e.stopPropagation();

                this.hide();
            }
        },

        updateElement: function () {
            if (this.element.is('input') && this.autoUpdateInput) {
                var newValue = this.startDate.format(this.locale.format);
                if (!this.singleDatePicker) {
                    newValue += this.locale.separator + this.endDate.format(this.locale.format);
                }
                if (newValue !== this.element.val()) {
                    this.element.val(newValue).trigger('change');
                }
            }
        },

        remove: function () {
            this.container.remove();
            this.element.off('.daterangepicker');
            this.element.removeData();
        }

    };

    $.fn.daterangepicker = function (options, callback) {
        var implementOptions = $.extend(true, {}, $.fn.daterangepicker.defaultOptions, options);
        this.each(function () {
            var el = $(this);
            if (el.data('daterangepicker'))
                el.data('daterangepicker').remove();
            el.data('daterangepicker', new DateRangePicker(el, implementOptions, callback));
        });
        return this;
    };

    return DateRangePicker;

}));

