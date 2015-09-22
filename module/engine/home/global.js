function total (tag, ajax) {
	$.getJSON(ajax, {ac: 'total'}, function(json) {
		if (json.stat) {
			$(tag).html(json.total);
		} else{
			$(tag).html(0);
		};
	});
}