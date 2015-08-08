jQuery(document).ready(function ($) {
	var SmoothCalendar = function () {
		this.init();
		this.events();
	}

	SmoothCalendar.prototype.vars = {
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
		]
	}

	// Kick things off with current month
	SmoothCalendar.prototype.init = function () {
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
		function daysInMonth (month,year) {
			return new Date(year, month, 0).getDate();
		}

		// Number of days in current month
		this.vars.numDays = daysInMonth(this.vars.dateObj.getMonth() + 1, this.vars.dateObj.getFullYear());

		// Current month
		this.vars.month = formatMonth(this.vars.dateObj)
		// Current month
		this.vars.year = this.vars.dateObj.getFullYear();

		// Update header month and year
		this.vars.monthEl.text(this.vars.monthNames[this.vars.dateObj.getMonth()]);
		this.vars.yearEl.text(this.vars.year);

		// Build the calendar
		this.buildDays();
		// Fetch events
		this.getData();
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
		var self = this;

		// Clear out list
		self.vars.daysList.empty();

		for (var i = 1; i < this.vars.numDays + 1; i++) {
			self.vars.daysList.append('<li><span class="smooth-cal__day">' + i + '</span></li>')
		}
	}

	// Fetch the data from the REST API
	SmoothCalendar.prototype.getData = function () {
		var self = this;

		$.ajax({
			url: '/wp-json/posts?type=calendar&filter[meta_value][month]=' + this.vars.month,
			success: function (events) {
				self.updateDom(events);
			}
		});
	}

	// Update the calendar in the DOM
	SmoothCalendar.prototype.updateDom = function (events) {
		$.each(events, function (index, event) {
			console.log(event);
		});
	}

	if ($('#js-smooth-cal').length) {
		new SmoothCalendar();
	}
});