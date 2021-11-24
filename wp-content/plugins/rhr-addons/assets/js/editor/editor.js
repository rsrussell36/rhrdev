; (function ($) {
	$(document).ready(function () {
		if (window.elementor) {
			elementor.hooks.addFilter("element/view", function (groups_prototype, element) {
				return groups_prototype.extend({
					getContextMenuGroups: function () {
						return groups_prototype.prototype.getContextMenuGroups.apply(this, arguments);
					},
				});
			});
			elementor.hooks.addFilter("elements/column/contextMenuGroups", rhrtemToContextMenu);
		}
	});
	function rhrtemToContextMenu(groups, element) {
		var clipboard_index = groups.findIndex(function (item) {
			return "addNew" === item.name;
		});
		groups[clipboard_index].actions.push({
			name: "rhr-add-nested-section",
			title: "RHR Nested Section",
			icon: "no-absulate",
			callback: function () {
				rhrInsertNestedSection(element);
			},
			isEnabled: function () {
				return true;
			},
		});
		return groups;
	}
	function rhrInsertNestedSection(element) {
		var element_view = element.getContainer().view;
		if (element_view.getElementType() === "column") {
			element_view.addElement({ elType: "section", isInner: true, settings: {}, elements: [{ id: elementor.helpers.getUniqueID(), elType: "column", isInner: true, settings: { _column_size: 100 }, elements: [] }] });
		}
	}
})(jQuery);

