/* 10.03.2010
 * datepicker v1.1
 * rev.5
 * by IonDen
 * tnx Rpsl
 * UTF-8
 */

$(document).ready(function(){
	var dpOff = 0;
	var dpHeight = 0;
	var dpOver = false;
	var tempID = "";
	
	$("input.datepicker").click(function(){
		tempID = $(this).attr("id");
		$(this).removeAttr("id");
		$(this).attr("id","changeTime")
		dpOff = $(this).offset();
		dpHeight = $(this).outerHeight();
		goTime();
	});
	
	var months = ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"];
    var date = new Date();
	var year = date.getFullYear();
	var month = date.getMonth();
	var weekDay = date.getDay(); if(weekDay === 0) {weekDay = 7};
	var day = date.getDate();
	var daysNum = calcDays();
	
	var currentDay = day;
	var currentMonth = month;
	var currentYear = year;
	
	var allHTML;
	var spacer = "";
	var days = "";
	
	function generateHTML() {
		$("#datepicker").remove();
		
		allHTML = '<div id="datepicker" style="left:' + dpOff.left + 'px; top:' + (dpOff.top + dpHeight + 2) + 'px;">';
		allHTML += '<div id="dateheader">';
		allHTML += '<span>' + months[month] + ' ' + year + '</span>';
		allHTML += '<a href="#" id="dpLeft"><b>&larr;</b></a><a href="#" id="dpRight"><b>&rarr;</b></a>';
		allHTML += '</div>';
		allHTML += '<div id="dateweek"><div><b><span>пн</span></b><b><span>вт</span></b><b><span>ср</span></b><b><span>чт</span></b><b><span>пт</span></b><b><span>сб</span></b><b><span>вс</span></b></div></div><div id="dates"><div>';
		allHTML += spacer;
		allHTML += days;
		allHTML += '</div></div><div id="dateSp"></div></div>';
		
		$("body").append(allHTML);
		
		$("#dpLeft").click(function(event){
			event.preventDefault();
			$(this).blur(0);
			if(month > 0) {
				date.setMonth(month - 1);
			} else {
				date.setFullYear(year - 1);
				date.setMonth(11);
			};
			
			goTime();
		});
		
		$("#dpRight").click(function(event){
			event.preventDefault();
			$(this).blur(0);
			if(month < 11) {
				date.setMonth(month + 1);
			} else {
				date.setFullYear(year + 1);
				date.setMonth(0);
			};

			goTime();
		});
		
		$("#dates a").click(function(event){
			event.preventDefault();
			var selectedDay = $(this).attr("id").slice(3);
			if(selectedDay < 10) {selectedDay = "0" + selectedDay};
			
			if(month < 9) {month = "0" + (month - 0 + 1)} else {month = (month - 0 + 1)};
			$("#changeTime").attr("value", selectedDay + "." + month + "." + year);
			$("#changeTime").removeAttr("id").attr("id",tempID);
			$("#datepicker").hide(100);
		});
		
		$(".datepicker").mouseenter(function(){
			dpOver = true;
		});
		$(".datepicker").mouseleave(function(){
			dpOver = false;
		});
		$("#datepicker").mouseenter(function(){
			dpOver = true;
		});
		$("#datepicker").mouseleave(function(){
			dpOver = false;
		});
		
		$("body").mousedown(function() {
			if(dpOver === false) {
				$("#changeTime").attr("id",tempID);
				$("#datepicker").hide(100);
			}
		});
	}
	
	function goTime() {
		date.setDate(1);
		day = date.getDate();
		year = date.getFullYear();
		month = date.getMonth();
		weekDay = date.getDay();
		if(weekDay === 0) {weekDay = 7};
		
		for(var i = 0; i < weekDay; i++) {
			if(i > 0) {
				spacer += "<b></b>";
			}
		}
		
		daysNum = calcDays();
		for(var i = 1; i <= daysNum; i++) {
			if(i === currentDay && month === currentMonth && year === currentYear) {
				days += '<a href="#" class="on" id="day' + i + '"><span>' + i + '</span></a>';
			} else {
				days += '<a href="#" id="day' + i + '"><span>' + i + '</span></a>';
			}
		}
		
		generateHTML();
		spacer = "";
		days = "";
	};
	
	function calcDays() {
		if(month === 0) {
			return 31;
		} else if(month === 1) {
			if(year / 4 === Math.round(year / 4)) {
				return 29;
			} else {
				return 28;
			}
		} else if(month === 2) {
			return 31;
		} else if(month === 3) {
			return 30;
		} else if(month === 4) {
			return 31;
		} else if(month === 5) {
			return 30;
		} else if(month === 6) {
			return 31;
		} else if(month === 7) {
			return 31;
		} else if(month === 8) {
			return 30;
		} else if(month === 9) {
			return 31;
		} else if(month === 10) {
			return 30;
		} else if(month === 11) {
			return 31;
		}
	}
});