function init() {
	$('#create').show();
	$('#success').hide();
	$('#progress').hide();
}

function GUID() { // NotMoreThan1million
	return ("0000" + (Math.random() * Math.pow(36, 4) << 0).toString(36))
			.substr(-4);
}

function addQuestion() {

}

function addOption() {
	var options = $('#option-group');
	var n = options.children().length;
	var nextOption = '<div class="form-group"><label for="option#">Option '
			+ (n + 1)
			+ ':</label><input type="text" class="form-control" id="option_'
			+ (n + 1) + '_input"placeholder="" /></div>';
	options.append(nextOption);
}

/**
 * Improve this function by adding more functionality inside
 * 
 * @returns {The json encoding poll}
 */
function encodePoll() {

	/*
	 * Collect the question
	 */
	var question = $('#question').val().replace(/[']/g, "&#39;");

	/*
	 * Collect all the answers
	 */
	var answers = [];
	var options = $("[id^='option_']").filter("[id$='_input']");
	for (var i = 0; i < options.length; i++) {
		if (options[i].value != null) {
			answers.push(options[i].value.replace("/[']/g", "&#39;"));
		}
	}

	var json = {
		question : question,
		answer : answers
	}

	return json;
}

function newPoll() {

	if (!validate()) {
		return;
	}

	var emails = $('#recipient').val().replace(/\s+/g, '').split(',');

	var json = encodePoll();

	var guid = GUID();

	// TODO to be removed
	var pwd = askForPwd();

	// TODO Magic here, how did you get me
	$.ajax({
		type : "POST",
		url : $('#create').attr('action'),
		data : {
			id : guid,
			recipient : emails,
			data : json,
			me : $('#emailHidden').val(),
			pwd : pwd
		},
		success : function(data) {
			alert(data);
			$('#create').hide();
			$('#progress').hide();
			$('#success').show();
			$('#seeResult').attr('href', 'stat.php?id=' + guid);
		}
	});

	$('#create').hide();
	$('#success').hide();
	$('#progress').show();
}

function validate() {
	if ($('#recipient').val() == '') {
		alert('you cannot have empty recipients');
		return false;
	}

	if ($('#question').val() == '') {
		alert('you cannot have empty question');
		return false;
	}

	var options = $("[id^='option_']").filter("[id$='_input']");
	for (var i = 0; i < options.length; i++) {
		if (options[i].value == '') {
			alert('you cannot have empty option ' + (i + 1));
			return false;
		}
	}

	return true;
}

function askForPwd() {
	var pwd = prompt("Please enter your password", "");
	return pwd;
}
