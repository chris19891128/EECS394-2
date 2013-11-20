function GUID() { // NotMoreThan1million
	return ("0000" + (Math.random() * Math.pow(36, 4) << 0).toString(36))
			.substr(-4);
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

	/*
	 * Collect all the emails
	 */
	var emails = $('#recepient').val().replace(/\s+/g, '').split(',');

	var json = encodePoll();

	var guid = GUID();

	// TODO to be removed
	var pwd = askForPwd();

	$.ajax({
		type : "POST",
		url : "create-poll.php",
		data : {
			id : guid,
			recepient : emails,
			data : json,
			pwd : pwd
		},
		success : function(data) {

		}
	});
}

function sendEmail(guid, emails, me, pwd) {
	$.ajax({
		type : "POST",
		url : "naive-email.php",
		data : {
			id : guid,
			recepient : emails,
			me : me,
			pwd : pwd
		},
		success : function(data) {
			alert("Your email has been sent out");
		}
	});
}

function askForPwd() {
	var pwd = prompt("Please enter your password", "");
	return pwd;
}
