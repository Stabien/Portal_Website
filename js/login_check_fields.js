function check_user_infos() {
	var fields = $('input');
	var error_msg = $('p');

	if (fields[0].value.length < 1) {
		error_msg[0].style.display = 'block';
		return false;
	} 
	if (fields[1].value.length < 1) {
		error_msg[1].style.display = 'block';
		return false;
	}	
}