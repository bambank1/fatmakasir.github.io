function gload(str){
	if(str=='show'){
		$.LoadingOverlay(str, {
			background  : "rgba(165, 190, 100, 0.7)",
			fade:500,
			zIndex:100
		});
		}else{
		$.LoadingOverlay(str);
	}
}

// document.onreadystatechange = function() {
	// if (document.readyState !== "complete") {
		// $('body').loading();
	// } else {
		// $('body').loading('stop');
	// }
// };
 
var start = moment();
var end = moment();

function cb(start, end) {
	$('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
}

$('#reportrange').daterangepicker({
	startDate: start,
	endDate: end,
	ranges: {
		'Today': [moment(), moment()],
		'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		'Last 7 Days': [moment().subtract(6, 'days'), moment()],
		'Last 30 Days': [moment().subtract(29, 'days'), moment()],
		'This Month': [moment().startOf('month'), moment().endOf('month')],
		'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	}
}, cb);

cb(start, end);