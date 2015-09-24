$(document).ready(function() {
	$('.off').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: module+'user/ajax.php',
            type: 'post',
            dataType: 'json',
            data: {ac: 'off'},
            success: function (json) {
                if (json.stat) {
                    window.location.href = 'login';
                };
            }
        });
        
    });
});

function total (tag, ajax) {
	$.getJSON(ajax, {ac: 'total'}, function(json) {
		if (json.stat) {
			$(tag).html('Rp.'+json.total);
		} else{
			$(tag).html(0);
		};
	});
}