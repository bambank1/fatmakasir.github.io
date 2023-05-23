'use strict';
var ajaxQueue = $({});
/**
 * @param {!Object} params
 * @return {undefined}
 */
$.ajaxQueue = function(params) {
  var cb = params.complete;
  ajaxQueue.queue(function(afterSaved) {
    /**
     * @return {undefined}
     */
    params.complete = function() {
      if (cb) {
        cb.apply(this, arguments);
      }
      afterSaved();
    };
    $.ajax(params);
  });
};
/**
 * @param {string} number
 * @param {?} decimals
 * @param {string} dec_point
 * @param {string} thousands_sep
 * @return {?}
 */
function number_format(number, decimals, dec_point, thousands_sep) {
  /** @type {string} */
  number = (number + "").replace(",", "").replace(" ", "");
  /** @type {number} */
  var n = !isFinite(+number) ? 0 : +number;
  /** @type {number} */
  var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals);
  var sep = typeof thousands_sep === "undefined" ? "," : thousands_sep;
  var d = typeof dec_point === "undefined" ? "." : dec_point;
  /** @type {string} */
  var s = "";
  /**
   * @param {number} n
   * @param {number} prec
   * @return {?}
   */
  var toFixedFix = function(n, prec) {
    /** @type {number} */
    var k = Math.pow(10, prec);
    return "" + Math.round(n * k) / k;
  };
  s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || "").length < prec) {
    s[1] = s[1] || "";
    s[1] += (new Array(prec - s[1].length + 1)).join("0");
  }
  return s.join(d);
}
var chartColors = {
  red : "rgb(255, 99, 132)",
  orange : "rgb(255, 159, 64)",
  yellow : "rgb(255, 205, 86)",
  green : "rgb(75, 192, 192)",
  blue : "rgb(54, 162, 235)",
  purple : "rgb(153, 102, 255)",
  grey : "rgb(201, 203, 207)"
};
