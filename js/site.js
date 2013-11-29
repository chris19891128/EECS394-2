var myEmail;

$(function() {
	loadUser();
	loadContact();
	$("#e1").select2();
	$("#create").submit(function(event) {
		event.preventDefault();
		newPoll();
	});
});

function loadContact() {
	$.ajax({
		type : "GET",
		url : 'server/myapi.php?f=contact',
		success : function(data) {
			var contacts = $.parseJSON(data);
			for (var i = 0; i < contacts.length; i++) {
				var name = contacts[i][0];
				var email = contacts[i][1];
				$option = $('<option></option>');
				$option.attr('value', email).html(
						name + '&#60;' + email + '&#62;').appendTo($('#e1'));
			}
		}
	});
}

function loadUser() {
	$.ajax({
		type : "GET",
		url : 'server/myapi.php?f=user',
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

function newPoll() {

	// Extract emails
	var emails = extractRecipients();

	// Extract poll content
	var poll = encodePoll();

	// Validation
	if (emails.length == 0) {
		alert('You did not enter recipients');
		return false;
	}

	if (poll['question'] == null || poll['question'] == '') {
		alert('You cannot have empty question');
		return false;
	}

	for (var i = 0; i < poll['answer'].length; i++) {
		if (poll['answer'][i] == null || poll['answer'][i] == '') {
			alert('You cannot have empty option ' + (i + 1));
			return false;
		}
	}

	// New GUID
	var guid = GUID();

	// TODO to be removed
	var pwd = askForPwd();

	// Post everything to post-create-poll.php
	$.ajax({
		type : "POST",
		url : 'server/process-poll.php',
		data : {
			id : guid,
			recipient : emails,
			data : poll,
			me : myEmail,
			pwd : pwd
		},
		success : function(data) {
			var baseUrl = document.URL.substring(0, document.URL.lastIndexOf("/"));
			location.replace( baseUrl + "/post-create-poll.php?id="
					+ guid);
		}
	});

	$('#create').hide();
	$('#success').hide();
	$('#progress').show();
}

// function validate() {
//
// if ($('li.select2-search-choice div:first-child').length == 0) {
// alert('You did not enter recipients');
// }
//
// if ($('#question').val() == '') {
// alert('You cannot have empty question');
// return false;
// }
//
// var options = $("[id^='option_']").filter("[id$='_input']");
// for (var i = 0; i < options.length; i++) {
// if (options[i].value == '') {
// alert('You cannot have empty option ' + (i + 1));
// return false;
// }
// }
//
// return true;
// }

function askForPwd() {
	var pwd = prompt("Please enter your password", "");
	return pwd;
}

/**
 * To be implemented
 */
function addQuestion() {

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
            
                                        
