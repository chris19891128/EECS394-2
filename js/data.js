function getFullUserInfo() {
	$.ajax({
		type : "GET",
		url : '/server/myapi.php?f=user',
		success : function(data) {
			var user = $.parseJSON(data);
			
		}
	});
}