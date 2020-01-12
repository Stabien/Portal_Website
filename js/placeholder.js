$(document).ready(function() {
	$('input').focus(function() {
		$(this).data('placeholder', $(this).attr('placeholder')).attr('placeholder', '');
	}).blur(function () {
		$(this).attr('placeholder', $(this).data('placeholder'));
	});
});