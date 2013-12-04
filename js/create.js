var myEmail;
var spinner;

$(function() {
	$("#e1").select2();
	loadUser();
	loadContact();
	$('#root').show();
	$("#create").submit(function(event) {
		event.preventDefault();
		newPoll();
	});
});

function loadContact() {
	$.ajax({
		type : "GET",
		url : 'server/googleapi.php?f=contact',
		success : function(data) {
			var contacts = $.parseJSON(data);
			for (var i = 0; i < contacts.length; i++) {
				var name = contacts[i][0];
				var email = contacts[i][1];
				$option = $('<option></option>');
				$option.attr('value', email).html(
						name + '&#60;' + email + '&#62;').appendTo($('#e1'));
			}
			$("#e1").select2();
		}
	});
}

function loadUser() {
	$.ajax({
		type : "GET",
		url : 'server/googleapi.php?f=user',
		success : function(data) {
			var user = $.parseJSON(data);
			myEmail = user.email;
		}
	});
}

function GUID() { // NotMoreThan1million
	return ("0000" + (Math.random() * Math.pow(36, 4) << 0).toString(36))
			.substr(-4);
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
		answers.push(options[i].value.replace("/[']/g", "&#39;"));
	}

	var json = {
		question : question,
		answer : answers
	}

	return json;
}

/**
 * 
 */
function extractRecipients() {
	var recipients = [];
	$('li.select2-search-choice div:first-child').each(function(index) {
		var str = $(this).text();
		recipients.push(str.substring(str.indexOf("<") + 1, str.indexOf(">")));
	});
	return recipients;
}

function processPoll(emails, poll) {

}

function newPoll() {
	// Disable UI preventing bad things happening
	frozeUI();

	// Extract emails
	var emails = extractRecipients();

	// Extract poll content
	var poll = encodePoll();

	if (!validate(emails, poll)) {
		unFrozeUI();
	} else {
		// UI
		startSpinner();

		// New GUID
		var guid = GUID();

		// Post everything to post-create-poll.php
		$.ajax({
			type : "POST",
			url : 'server/process-poll.php',
			data : {
				id : guid,
				recipient : emails,
				data : poll,
				me : myEmail
			},
			success : function(data) {
				if (data == "Email send out success") {
					alert("Your poll has been sent");

					var baseUrl = document.URL.substring(0, document.URL
							.lastIndexOf("/"));
					location.replace(baseUrl + "/post-create-poll.php?id="
							+ guid);

				} else {
					console.log(data);
					alert("Error happens, Sorry that's all we know now.");
					unFrozeUI();
					stopSpinner();
				}
			}
		});
	}

}

function validate(emails, poll) {
	// Validation
	if (emails.length == 0) {
		alert('You did not enter recipients');
		return false;
	} else if (poll['question'] == null || poll['question'] == '') {
		alert('You cannot have empty question');
		return false;
	}

	for (var i = 0; i < poll['answer'].length; i++) {
		if (poll['answer'][i] == null || poll['answer'][i] == '') {
			alert('You cannot have empty option ' + (i + 1));
			return false;
		}
	}
	return true;
}

/**
 * Add option function
 */
function addOption() {
	var options = $('#option-group');
	var n = options.children().length;
	var nextOption = '<div class="form-group"><label for="option#">Option '
			+ (n + 1)
			+ ':</label><input type="text" class="form-control" id="option_'
			+ (n + 1) + '_input"placeholder="" /></div>';
	options.append(nextOption);
}

function frozeUI() {
	$('button[class="btn btn-default"]').attr('disabled', '');
	$('input.form-control').attr('disabled', '');
}

function unFrozeUI() {
	$('button[class="btn btn-default"]').removeAttr('disabled');
	$('input.form-control').removeAttr('disabled');
}

function startSpinner() {
	var opts = {
		lines : 13, // The number of lines to draw
		length : 5, // The length of each line
		width : 3, // The line thickness
		radius : 7, // The radius of the inner circle
		corners : 1, // Corner roundness (0..1)
		rotate : 0, // The rotation offset
		direction : 1, // 1: clockwise, -1: counterclockwise
		color : '#000', // #rgb or #rrggbb or array of colors
		speed : 1, // Rounds per second
		trail : 60, // Afterglow percentage
		shadow : false, // Whether to render a shadow
		hwaccel : false, // Whether to use hardware acceleration
		className : 'spinner', // The CSS class to assign to the spinner
		zIndex : 2e9, // The z-index (defaults to 2000000000)
		top : 'auto', // Top position relative to parent in px
		left : '5%' // Left position relative to parent in px
	};
	var target = document.getElementById('spinDiv');
	spinner = new Spinner(opts).spin(target);
}

function stopSpinner() {
	if (spinner !== undefined)
		spinner.stop();
}