jQuery(document).ready(function ($) {
	if ($('#js-smooth-cal').length) {
		// Current date
		var dateObj = new Date();

		// Append 0 to month
		var formatMonth = function (date) {
			if (date.getMonth() < 10) {
				var zeroPrepended = '0' + date.getMonth(),
					addOne = Number(zeroPrepended) + 1;

				return '0' + addOne;
			} else {
				return date.getMonth() + 1;
			}
		}

		var thisMonth = formatMonth(dateObj),
			thisYear = dateObj.getFullYear();

		$.ajax({
			url: '/wp-json/posts?type=calendar&filter[meta_value][month]=' + thisMonth,
			success: function (result) {
				console.log(result);
			}
		})
	}

});