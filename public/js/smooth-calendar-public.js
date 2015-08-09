jQuery(document).ready(function ($) {
	var SmoothCalendar = function () {
		this.init();
		this.events();
	}

	SmoothCalendar.prototype.vars = {
		cal: $('#js-smooth-cal'),
		month: 0,
		year: 0,
		numDays: 0,
		daysList: $('#js-smooth-cal-days'),
		prev: $('#js-smooth-cal-prev'),
		next: $('#js-smooth-cal-next'),
		dateObj: new Date(),
		monthEl: $('#js-smooth-cal-month'),
		yearEl: $('#js-smooth-cal-year'),
		monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
		],
		firstMonthDay: 0,
		leftOverDays: 0
	}

	// Kick things off with current month
	SmoothCalendar.prototype.init = function () {
		var self = this;

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

		// Get number of days in month
		var daysInMonth = function (month,year) {
			return new Date(year, month, 0).getDate();
		}

		var firstDayOfMonth = function () {
			var day = self.vars.dateObj.getDay() + 1;

			if (day == 7) {
				return 0;
			} else {
				return self.vars.dateObj.getDay() + 1;
			}
		}

		// Number of days in current month
		this.vars.numDays = daysInMonth(this.vars.dateObj.getMonth() + 1, this.vars.dateObj.getFullYear());

		// First day of the month
		this.vars.firstMonthDay = firstDayOfMonth();

		// Leftover days in month
		this.vars.leftOverDays = this.vars.numDays - (this.vars.numDays - this.vars.firstMonthDay);
		
		// Current month
		this.vars.month = formatMonth(this.vars.dateObj)

		// Current month
		this.vars.year = this.vars.dateObj.getFullYear();

		// Update header month and year
		this.vars.monthEl.text(this.vars.monthNames[this.vars.dateObj.getMonth()]);
		this.vars.yearEl.text(this.vars.year);

		// Build the calendar
		this.buildDays();
	}

	// Watch for month changes
	SmoothCalendar.prototype.events = function () {
		var self = this;

		this.vars.prev.on('click', function (e) {
			e.preventDefault();

			// Subtract a month
			self.vars.dateObj.setMonth(self.vars.dateObj.getMonth() - 1);

			self.init();
		});

		this.vars.next.on('click', function (e) {
			e.preventDefault();

			// Add a month
			self.vars.dateObj.setMonth(self.vars.dateObj.getMonth() + 1);

			self.init();
		});
	}

	// Output list items for days in month
	SmoothCalendar.prototype.buildDays = function () {
		var self = this,
			dateAttr,
			// Number of days in month + first day of month offset
			length = (this.vars.numDays + 1) + this.vars.firstMonthDay,
			colCount = 7,
			cellCount;

		if ((length - 1) > 35) {
			cellCount = 43;
		} else {
			cellCount = 36;
		}

		// Clear out list
		this.vars.daysList.empty();

		// Append 0 to month
		var formatMonth = function (date) {
			if (date < 10) {
				return '0' + date;
			} else {
				return date;
			}
		}

		for (var i = 1; i < cellCount; i++) {
			if (i <= this.vars.firstMonthDay) {
				// Fill beginning empty days
				self.vars.daysList.append('<li></li>');
			} else if (i < length) {
				// Fill days

				// Set data attr for date comparison
				dateAttr = self.vars.year + '-' + self.vars.month + '-' + formatMonth(i - 1);

				self.vars.daysList.append('<li data-date="' + dateAttr + '"><span class="smooth-cal__day">' + (i - self.vars.firstMonthDay) + '</span><div class="smooth-cal__inner"></div></li>');
			} else {
				// Fill ending empty days
				self.vars.daysList.append('<li></li>');
			}
		}

		// Fetch data
		this.getData();
	}

	// Fetch the data from the REST API
	SmoothCalendar.prototype.getData = function () {
		var self = this;

		$.ajax({
			url: '/wp-json/posts?type=calendar&filter[meta_value][month]=' + this.vars.month + '&filter[meta_value][year]=' + this.vars.year,
			success: function (events) {
				self.updateDom(events);
			}
		});
	}

	// Update the calendar in the DOM
	SmoothCalendar.prototype.updateDom = function (events) {
		var self = this;

		$.each(events, function (index, event) {
			var title = event.title,
				date = event.calendar.date,
				dateFormatted = event.calendar.dateFormatted,
				location = event.calendar.location,
				time = event.calendar.start,
				description = event.calendar.description,
				matchingItem = self.vars.cal.find('li[data-date="' + date + '"] .smooth-cal__inner');

			var buildPopup = function () {
				return '<div class="smooth-cal__event">' +
					'<a class="smooth-cal__link" href="#">' + title + '</a>' +
					'<div class="smooth-cal__deets">' +
						'<h4>' + title + '</h4>' +
						'<p><strong>Date: </strong>' + dateFormatted + '</p>' +
						'<p><strong>Location: </strong>' + location + '</p>' +
						'<p><strong>Time: </strong>' + time + '</p>' +
						'<p><strong>Description: </strong>' + description + '</p>' +
					'</div>' +
				'</div>'
			}

			matchingItem.append(buildPopup());
			
		});
	}

	// Initialize only if calendar present
	if ($('#js-smooth-cal').length) {
		new SmoothCalendar();
	}
});