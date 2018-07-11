$(function() {
	function disableDates(date) {
		var noTuesday = date.getDay() !=2,
		noSunday = date.getDay() !=0;
		disableDates = ['01-05', '01-11', '25-12']
		stringDate = $.datepicker.formDate('dd-mm', date);
		
	return [noTuesday && noSunday && disableDates.indexOf(stringDate) == -1, ''];
	}
	
	function setupDatepicker() {
		$("#orderForm_date").datepicker({
			altField: "yy-mm-dd",
			minDate: 0,
			beforeShowDay: disableDates
		});
		
		$("#orderForm_date").attr({
			name: ''
		});
	}
	
	setupDatepicker();
});