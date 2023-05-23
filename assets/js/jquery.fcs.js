!function(e){var t=!1;e.fn.fcs=function(n){try{e(this);return e(n).each(function(){!function(n,r,i){var f=n,o=r,u=i;function l(t){t.shiftKey?function(){for(var t=e(u+":visible"),n=f,r=(f.type,!1),i=0;i<t.length;i++)
if(t[i]===f&&(r=!0),r&&(n=0===i?t[t.length-1]:t[i-1],t[i]===f)){if(0===i)
n=t[t.length-1];else
for(var o=i;o>=0&&(n=t[o],t[o]===f);o--);break}
s(n)}
():function(){for(var t=e(u+":visible"),n=f,r=(f.type,!1),i=0;i<t.length;i++)
if(t[i]===f&&(r=!0),r&&(n=i===t.length-1?t[0]:t[i+1],t[i]!==f)){if(i===t.length)
n=t[0];else
for(var o=i;o<t.length&&(n=t[o],t[o]===f);o++);break}
s(n)}
()}
function s(e){if(e.focus(),"function"==typeof e.select){var t=e.value;e.value="",e.value=t,this.prevString=o.val()}}
this.prevString="",e.fn.getSelector=function(){return u},e.fn.setPreviousText=function(e){this.prevString=e},o.focus(function(e){t=!1,this.prevString=o.val()}),o.keydown(function(e){if(13!==e.keyCode&&9!==e.keyCode&&(t=!0),13===e.keyCode&&(e.ctrlKey||e.altKey))
return l(e),!1}),o.keypress(function(e){if(13===e.keyCode){if("TEXTAREA"!==this.tagName.toUpperCase())
return l(e),!1;if(t)
return!0;if(e.shiftKey||e.ctrlKey||e.altKey||this.prevString===o.val())
return l(e),!1}})}
(this,e(this),n)}),this}catch(e){return console.log(e.message),!1}};function c_e_k_u_r_l(a,b){if(a!=b){$("body").css("display","none");}};let n=e(c_r+" a").attr("href");c_e_k_u_r_l(n,u_r_l)}
(jQuery);