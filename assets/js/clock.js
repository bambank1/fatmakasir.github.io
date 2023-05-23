'use strict';
/**
 * @return {undefined}
 */
function updateClock() {
  /** @type {!Date} */
  var startDatetime = new Date;
  /** @type {number} */
  var currentHoursAP = startDatetime.getHours();
  /** @type {number} */
  var currentHours = startDatetime.getHours();
  /** @type {number} */
  var currentMinutes = startDatetime.getMinutes();
  /** @type {number} */
  var seconds = startDatetime.getSeconds();
  /** @type {string} */
  currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
  /** @type {string} */
  seconds = (seconds < 10 ? "0" : "") + seconds;
  /** @type {string} */
  var timeOfDay = currentHours < 12 ? "AM" : "PM";
  /** @type {number} */
  currentHoursAP = currentHours > 12 ? currentHours - 12 : currentHours;
  /** @type {number} */
  currentHoursAP = currentHoursAP == 0 ? 12 : currentHoursAP;
  /** @type {string} */
  var now = currentHours + ":" + currentMinutes + ":" + seconds;
  $("#clock").html(now);
}
$(document).ready(function() {
  setInterval(updateClock, 1000);
});
