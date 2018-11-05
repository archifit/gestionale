
var warning = '<span class="glyphicon glyphicon-warning-sign text-error"></span>';
var okSymbol = '&ensp;<span class="glyphicon glyphicon-ok text-success"></span>';

function getHtmlNum(value) {
	return '&emsp;' + ((value >= 10) ? value : '&ensp;' + value);
}

function getHtmlNumAndPrevisteVisual(value, total) {
	var numString = (value >= 10) ? value : '&ensp;' + value;
	var diff = total - value;
	if (diff > 0) {
		numString += '&ensp;<span class="label label-warning">- '+ diff +'</span>';
	} else if (diff < 0) {
			numString += '&ensp;<span class="label label-danger">+ '+ (-diff) +'</span>';
	} else {
		numString += okSymbol;
	}
	return '&emsp;' + numString;
}

function getHtmlNumAndFatteVisual(value, total) {
	return '&emsp;' + ((value >= 10) ? value : '&ensp;' + value);
}
