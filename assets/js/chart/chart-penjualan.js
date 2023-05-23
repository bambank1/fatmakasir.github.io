// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function load_chart_desain(bulan){
	bulan = bulan?bulan:'';
	$.ajax({
		url: base_url +"penjualan/grafik_desain/",
		method: "POST",
		data:{bulan:bulan},
		beforeSend: function () {
			$("#LoadingGrafikDesain").loading();
		},
		success: myCallbackDesain,
		error: function(data) {
			$("#LoadingGrafikDesain").loading('stop');
		}
	});	
}
function myCallbackDesain (data)
{
	
	var objarr = JSON.parse(data);
	var obj = objarr['omset'];
	$("#nama_bulan_pendapatan").html('Grafik Desain Bulan '+objarr.bulan);
	var tanggal = [];
	var hasil = [];
	for(var i in obj) {
		tanggal.push(obj[i].tanggal);
		hasil.push(obj[i].total);
	}
	
	var lineChartData  = {
		datasets: [{
			data: hasil,
			lineTension: 0.3,
			backgroundColor: "rgba(78, 115, 223, 0.5)",
			borderColor: "rgba(78, 115, 223, 1)",
			pointRadius: 3,
			pointBackgroundColor: "rgba(78, 115, 223, 1)",
			pointBorderColor: "rgba(78, 115, 223, 1)",
			pointHoverRadius: 3,
			pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
			pointHoverBorderColor: "rgba(78, 115, 223, 1)",
			pointHitRadius: 10,
			pointBorderWidth: 2,
			label: 'Total'
		}],
		labels: tanggal
	};
	
	var ctx = $("#myAreaChartDesain");
	var myLineChart = new Chart(ctx, {
		id: 'myAreaChartDesain',
		type: 'line',
		data: lineChartData,
		options: {
			responsive: true,
			legend: {
				display: false,
			},
			title: {
				display: false,
				text: 'Rekapitulasi'
			},
			animation: {
				animateScale: true,
				animateRotate: true
			},
			scales: {
				xAxes: [{
					time: {
						unit: 'date'
					},
					gridLines: {
						display: false,
						drawBorder: false
					},
					ticks: {
						maxTicksLimit: 7
					}
				}],
				yAxes: [{
					ticks: {
						maxTicksLimit: 5,
						padding: 10,
						// Include a dollar sign in the ticks
						callback: function(value, index, values) {
							return 'Total.' + number_format(value);
						}
					},
					gridLines: {
						color: "rgb(234, 236, 244)",
						zeroLineColor: "rgb(234, 236, 244)",
						drawBorder: false,
						borderDash: [2],
						zeroLineBorderDash: [2]
					}
				}],
			},
			tooltips: {
				backgroundColor: "rgb(255,255,255)",
				bodyFontColor: "#858796",
				titleMarginBottom: 10,
				titleFontColor: '#6e707e',
				titleFontSize: 14,
				borderColor: '#dddfeb',
				borderWidth: 1,
				xPadding: 15,
				yPadding: 15,
				displayColors: false,
				intersect: true,
				mode: 'index',
				caretPadding: 10,
				callbacks: {
					label: function(tooltipItem, chart) {
						var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
						return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
					}
				}
			}
		}
		
	}).draw();
	
	$("#LoadingGrafikDesain").loading('stop');
}
function load_chart(bulan){
	bulan = bulan?bulan:'';
	$.ajax({
		url: base_url +"penjualan/grafik/",
		method: "POST",
		data:{bulan:bulan},
		beforeSend: function () {
			$("#LoadingGrafik").loading();
		},
		success: myCallback,
		error: function(data) {
			$("#LoadingGrafik").loading('stop');
		}
	});	
}
var myLineChart=null;
function myCallback (data)
{
	
	var objarr = JSON.parse(data);
	
	var obj = objarr['omset'];
	$("#nama_bulan_pendapatan").html('Grafik Pendapatan Bulan '+objarr.bulan);
	var tanggal = [];
	var hasil = [];
	for(var i in obj) {
		tanggal.push(obj[i].tanggal);
		hasil.push(obj[i].total);
	}
	
	$(".myAreaChart").attr("id",objarr.bulan);
	var lineChartData  = {
		datasets: [{
			data: hasil,
			lineTension: 0.3,
			backgroundColor: "rgba(78, 115, 223, 0.5)",
			borderColor: "rgba(78, 115, 223, 1)",
			pointRadius: 3,
			pointBackgroundColor: "rgba(78, 115, 223, 1)",
			pointBorderColor: "rgba(78, 115, 223, 1)",
			pointHoverRadius: 3,
			pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
			pointHoverBorderColor: "rgba(78, 115, 223, 1)",
			pointHitRadius: 10,
			pointBorderWidth: 2,
			label: 'Total'
		}],
		labels: tanggal
	};
	if (myLineChart!=null){
		myLineChart.destroy();
	}
	
	var ctx = $("#"+objarr.bulan);
	
	myLineChart = new Chart(ctx, {
		id: objarr.bulan,
		type: 'line',
		data: lineChartData,
		options: {
			responsive: true,
			legend: {
				display: false,
			},
			title: {
				display: false,
				text: 'Rekapitulasi'
			},
			animation: {
				animateScale: true,
				animateRotate: true
			},
			scales: {
				xAxes: [{
					time: {
						unit: 'date'
					},
					gridLines: {
						display: false,
						drawBorder: false
					},
					ticks: {
						maxTicksLimit: 7
					}
				}],
				yAxes: [{
					ticks: {
						maxTicksLimit: 5,
						padding: 10,
						// Include a dollar sign in the ticks
						callback: function(value, index, values) {
							return 'Rp.' + number_format(value);
						}
					},
					gridLines: {
						color: "rgb(234, 236, 244)",
						zeroLineColor: "rgb(234, 236, 244)",
						drawBorder: false,
						borderDash: [2],
						zeroLineBorderDash: [2]
					}
				}],
			},
			legend: {
				onHover: function(e) {
					e.target.style.cursor = 'pointer';
				}
			},
			hover: {
				onHover: function(e) {
					var point = this.getElementAtEvent(e);
					if (point.length) e.target.style.cursor = 'pointer';
					else e.target.style.cursor = 'default';
				}
			}
		}
	});
	
	$("#LoadingGrafik").loading('stop');
}	

