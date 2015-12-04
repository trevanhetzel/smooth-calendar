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
		leftOverDays: 0,
		single: false
	}

	// Kick things off with current month
	SmoothCalendar.prototype.init = function () {
		var self = this;

		if (this.vars.cal.data('single')) {
			this.vars.single = true;
		}

		// Append 0 to month
		var formatMonth = function (date) {
			if (date.getMonth() < 9) {
				var zeroPrepended = '0' + date.getMonth(),
					addOne = Number(zeroPrepended) + 1;

				return '0' + addOne;
			} else {
				return Number(date.getMonth()) + 1;
			}
		}

		// Get number of days in month
		var daysInMonth = function (month,year) {
			return new Date(year, month, 0).getDate();
		}

		// Number of days in current month
		this.vars.numDays = daysInMonth(this.vars.dateObj.getMonth() + 1, this.vars.dateObj.getFullYear());

		// First day of the month
		this.vars.firstMonthDay = new Date(this.vars.dateObj.getFullYear(), this.vars.dateObj.getMonth(), 1).getDay();

		// Last day of the month
		this.vars.lastMonthDay = new Date(this.vars.dateObj.getFullYear(), this.vars.dateObj.getMonth() + 1, 0).getDay();

		// Leftover days in month
		this.vars.leftOverDays = 6 - this.vars.lastMonthDay;
		
		// Current month
		this.vars.month = formatMonth(this.vars.dateObj);

		// Current year
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
			self.vars.dateObj.setMonth(self.vars.dateObj.getMonth() - 1, 1);

			self.init();
		});

		this.vars.next.on('click', function (e) {
			e.preventDefault();

			// Add a month
			self.vars.dateObj.setMonth(self.vars.dateObj.getMonth() + 1, 1);

			self.init();
		});

		// Show events on small screens
		$(document)
			.on('click', function () {
				$('.smooth-cal__days li').removeClass('expanded');
			})
			.on('click', '.smooth-cal__trigger', function (e) {
				e.preventDefault();
				e.stopPropagation();

				if ($(this).parent().hasClass('expanded')) {
					$(this).parent().removeClass('expanded');
					$('.smooth-cal__days li').removeClass('expanded');
				} else {
					$('.smooth-cal__days li').removeClass('expanded');
					$(this).parent().addClass('expanded');
				}
			})
	}

	// Output list items for days in month
	SmoothCalendar.prototype.buildDays = function () {
		// Clear out list
		this.vars.daysList.empty();

		var cellCount = this.vars.numDays + this.vars.firstMonthDay + this.vars.leftOverDays + 1
			excRemaining = this.vars.numDays + this.vars.firstMonthDay + 1;

		// Append 0 to day
		var formatDay = function (date) {
			if (date < 10) {
				return '0' + date;
			} else {
				return date;
			}
		}

		for (var i = 1; i < cellCount; i++) {
			if (i <= this.vars.firstMonthDay) {
				this.vars.daysList.append('<li></li>');
			} else if (i < excRemaining) {
				dateAttr = this.vars.year + '-' + this.vars.month + '-' + formatDay(i - this.vars.firstMonthDay);

				this.vars.daysList.append('<li data-date="' + dateAttr + '"><span class="smooth-cal__day">' + (i - this.vars.firstMonthDay) + '</span><div class="smooth-cal__inner"></div></li>');
			} else {
				this.vars.daysList.append('<li></li>');
			}
		}

		// Fetch data
		this.getData();
	}

	// Fetch the data from the REST API
	SmoothCalendar.prototype.getData = function () {
		var self = this;

		$.ajax({
			url: '/wp-json/wp/v2/calendar?&filter[posts_per_page]=100&filter[meta_key]=meta_calendar_month&filter[meta_value]=' + self.vars.month,
			success: function (events) {
				self.updateDom(events);
			}
		});
	}

	// Update the calendar in the DOM
	SmoothCalendar.prototype.updateDom = function (events) {
		var self = this,
			maxChar = 25;

		var truncate = function (text) {
			if (text.length > 25) {
				return text.substring(0, 25) + '...';
			} else {
				return text;
			}
		}

		$.each(events, function (index, event) {
			var title = event.title.rendered,
				truncatedTitle = truncate(title),
				date = event.meta_calendar_date,
				dateFormatted = event.meta_calendar_dateFormatted,
				location = event.meta_calendar_location,
				startTime = event.meta_calendar_start,
				endTime = event.meta_calendar_end,
				description = event.meta_calendar_description,
				excerpt = description.substring(0, 100),
				matchingItem = self.vars.cal.find('li[data-date="' + date + '"]');

			var buildPopup = function () {
				content = '';

				content += '<div class="smooth-cal__event">';
				content += '<a class="smooth-cal__link" href="#">' + truncatedTitle + '</a>';
				content += '<div class="smooth-cal__deets">';
				content += '<h4>' + title + '</h4>';

				if (dateFormatted) {
					content += '<p><strong>Date: </strong>' + dateFormatted + '</p>';
				}

				if (location) {
					content += '<p><strong>Location: </strong>' + location + '</p>';
				}

				if (startTime) {
					content += '<p><strong>Time: </strong>' + startTime;
				}

				if (endTime) {
					content += ' - ' + endTime + '</p>';
				} else if (startTime) {
					content += '</p>';
				}

				if (description) {
					content += '<p><strong>Description: </strong>' + excerpt + '...</p>';
				}

				if (self.vars.single) {
					content += '<p><a href="' + event.link + '" class="smooth-cal__btn">More information &raquo;</a></p>';
				}

				content += '</div>';
				content += '</div>';

				return content;
			}

			if (matchingItem.length) {
				if (matchingItem.find('.smooth-cal__trigger').length < 1) {
					matchingItem.prepend('<a href="#" class="smooth-cal__trigger"></a>');
				}

				matchingItem.find('.smooth-cal__inner').append(buildPopup());
			}
			
		});
	}

	// Initialize only if calendar present
	if ($('#js-smooth-cal').length) {
		new SmoothCalendar();
	}
});
