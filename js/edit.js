var myEmail;

$(function() {
	$("#e1").select2();

	loadUser();
	loadContact();

	loadQuestionOptions();

	$('#root').show();

	$("#create").submit(function(event) {
		event.preventDefault();
		editPoll();
	});
});

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
			loadSent();
		}
	});
}

function loadSent() {
	$.ajax({
		type : "GET",
		url : 'server/surveyapi.php',
		data : {
			f : 'recipient',
			id : $('#sid').val()
		},
		success : function(data) {
			var sent = $.parseJSON(data);
			for (var i = 0; i < sent.length; i++) {
				var front = sent[i].split('@')[0];
				var end = sent[i].split('@')[1];
				$('option[value^=\'' + front + '\']').filter(
						'option[value$=\'' + end + '\']').remove();
			}
			$("#e1").select2();

			for (var i = 0; i < sent.length; i++) {
				$li = $('<li class="select2-search-choice"></li>');
				$innerdiv = $('<div>&lt;' + sent[i] + '&gt;</div>');
				$li.append($innerdiv);
				$('#recipient-group').find('ul.select2-choices:first').prepend(
						$li);
			}

		}
	});
}

function loadQuestionOptions() {

	$
			.ajax({
				type : "GET",
				url : 'server/surveyapi.php',
				data : {
					f : 'survey',
					id : $('#sid').val()
				},
				success : function(data) {
					var survey = $.parseJSON(data);
					$('#question').val(survey.question);
					for (var i = 0; i < survey.answer.length; i++) {
						var ans = survey.answer[i];
						$input = $(
								'<label for="option#">Option '
										+ (i + 1)
										+ ':</label><input type="text" class="form-control" id="option_'
										+ (i + 1) + '_input" readonly/>').val(
								ans);
						$nextOption = $('<div class="form-group"></div>')
								.append($input);

						$('#option-group').append($nextOption);
					}
				}
			});

}

/**
 * 
 */
function extractRecipients() {
	var recipients = [];
	$('li.select2-search-choice div:first-child').each(
			function(index) {
				if ($(this).parent().find('a').length > 0) {
					var str = $(this).text();
					recipients.push(str.substring(str.indexOf("<") + 1, str
							.indexOf(">")));
				}
			});
	return recipients;
}

function askForPwd() {
	var pwd = prompt("Please enter your password", "");
	return pwd;
}

function fakePoll() {
	$.ajax({
		type : "POST",
		url : 'server/process-poll.php?edit',
		data : {
			id : '7v34',
			recipient : [ 'chris19891128@gmail.com' ],
			me : 'chris19891128@gmail.com',
			pwd : 'chris1989d'
		},
		success : function(data) {
			alert(data);
			var baseUrl = document.URL.substring(0, document.URL
					.lastIndexOf("/"));
			location.replace(baseUrl + "/post-create-poll.php?id="
					+ $('#sid').val());
		}
	});
}

function editPoll() {

	// Extract emails
	var emails = extractRecipients();

	// TODO to be removed
	var pwd = askForPwd();

	// Post everything to post-create-poll.php
	$.ajax({
		type : "POST",
		url : 'server/process-poll.php?edit',
		data : {
			id : $('#sid').val(),
			recipient : emails,
			me : myEmail,
			pwd : pwd
		},
		success : function(data) {
			var baseUrl = document.URL.substring(0, document.URL
					.lastIndexOf("/"));
			location.replace(baseUrl + "/post-create-poll.php?id="
					+ $('#sid').val());
		}
	});
}