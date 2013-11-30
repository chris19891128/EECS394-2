$(function() {
	var err = $('#err').attr('value');
	var question = '';
	var answer = [];

	switch (err) {
	case '1':
		$('div.container').hide();
		$('#errStr').html('Broken URL, Missing survey id or responder!');
		$('#fv').show();
		break;
	case '2':
		$('div.container').hide();
		$('#errStr').html('You have no authentication to see this poll');
		$('#fv').show();
		break;
	default:
		$('div.container').hide();
		$('#l1a').attr(
				'href',
				'answer.php?id=' + $('#sid').val() + '&responder='
						+ $('#rid').val());
		$('#nav').show();
		loadQuestion();
		loadRecipients();
		loadStats();
	}

});

function loadQuestion() {
	$.ajax({
		type : "GET",
		url : 'server/surveyapi.php?f=survey&id=' + $('#sid').val(),
		success : function(data) {
			var question = $.parseJSON(data).question;
			$('#qt').html('Question: ' + question);
			$('#infov').show();
		}
	});
}

function loadRecipients() {
	$.ajax({
		type : "GET",
		url : 'server/surveyapi.php?f=recipient&id=' + $('#sid').val(),
		success : function(data) {
			$('#ar').html('(Other Recipients: ');
			var emails = $.parseJSON(data);
			var i = 0;
			for (; i < emails.length - 1; i++) {
				$('#ar').append(emails[i] + ', ');
			}
			$('#ar').append(emails[i] + ')');
			$('#infov').show();
		}
	});
}

function loadStats() {
	$
			.ajax({
				type : "GET",
				url : 'server/surveyapi.php?f=result&id=' + $('#sid').val(),
				success : function(data) {
					var root = $.parseJSON(data);
					var answer = root.answer;
					var replies = root.reply;

					var max = 0;
					for (var i = 0; i < replies.length; i++) {
						if (replies[i].length > max) {
							max = replies[i].length;
						}
					}

					if (max == 0) {
						max = 1;
					}

					for (var i = 0; i < replies.length; i++) {
						// new row
						$row = $('<tr></tr>');

						// choice cell
						$td1 = $('<td>' + answer[i] + '</td>');

						// Bar graph
						var per = Math.floor((replies[i].length / max) * 100)
								+ "%";
						$td2 = $('<td style="width:100%;"><a style="display: block; width:'
								+ per
								+ '; height: 20px; background-color: #428bca;" data-toggle="modal" data-target="#voters'
								+ i + '" href="#"> </a></td>');

						// count cell
						$td3 = $('<td>' + replies[i].length + '</td>');

						// Create the div now from the template
						$td4 = $('<td></td>');
						$div_clone = $('#voters_sample').clone().attr('id',
								'voters' + i);
						$div_clone.find('h4').append('Voters for ' + answer[i]);

						var html_str = '';
						for (var j = 0; j < replies[i].length; j++) {
							html_str = html_str + replies[i][j] + '</br>';
						}
						$div_clone.find('.modal-body').prepend(html_str);
						$td4.append($div_clone);

						// append
						$row.append($td1).append($td2).append($td3)
								.append($td4);
						$('#stats_graph').append($row);
					}

					$('#vv').show();
				}
			});
}