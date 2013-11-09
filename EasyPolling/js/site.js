document.write('<script src="http://' + (location.host || 'localhost')
.split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')

Parse.initialize("bTDmLFfmSgCg6MAf5RmTKZ7874ZyOJH0z2i2Sede", "aYsmQ1XiPXF6V6wXGIYWjw1AGaJnl9jfc8vkpmGy");

var TestObject = Parse.Object.extend("TestObject");
var testObject = new TestObject();
  testObject.save({foo: "bar"}, {
  success: function(object) {
    // $(".success").show();
  },
  error: function(model, error) {
    // $(".error").show();
  }
});

function GUID() { //NotMoreThan1million
    return ("0000" + (Math.random()*Math.pow(36,4) << 0).toString(36)).substr(-4);
}

function addOption () {
	var options = $('#options');
	var n = options.children().length;
	var template = '<div class="form-group"><label for="option#">Option count:</label><input type="text" class="form-control" id="optioncount" placeholder="" /></div>';
	var nextOption = template.replace('count', n);
	options.append(nextOption);
}

function newPoll() {
	var options = $('#options');
	var question = $('#question').val().replace(/[']/g, "&#39;");
	console.log(question);
	var n = options.children().length-1;
	var answer = '';
	for (i = 0; i < n; i++) {
		answer = answer + ', "' + options.children().eq(i+1).children().eq(-1).val().replace(/[']/g, "&#39;") + '"';
	}
	var json = '{question: "' + question + '", answer:[' + answer.slice(2) + ']}';
	var guid = GUID();

	$.ajax({
        type: "POST",
        url: "new.php",
        data: {
        	id: guid,
        	data: json
        },
        success:function(data){
        	$('#create').hide();
        	$('#url').val('http://orange394.cloudapp.net/' + guid);
        	$('#success').show();
    	}
    });
}

