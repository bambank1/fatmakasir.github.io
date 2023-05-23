/**
    * @param {string} text
    * @param {string} obj
    * @return {undefined}
*/

function notif(text, obj) {
    $.notify({
        message : text
        }, {
        type : obj,
        animate : {
            enter : "animated fadeInRight",
            exit : "animated fadeOutRight"
		},
        placement : {
            from : "bottom",
            align : "right"
		}
	});
}
/**
    * @param {?} a
    * @param {?} b
    * @param {?} variableNames
    * @return {undefined}
*/
function sweeta(a, b, variableNames) {
    swal({
        title : "Anda yakin?",
        text : "Periksa kembali sebelum di cetak!",
        type : "warning",
        closeOnClickOutside : false,
        buttons : {
            confirm : {
                text : "Ya, cetak!",
                className : "btn btn-success"
			},
            cancel : {
                visible : true,
                className : "btn btn-danger"
			}
		}
        }).then((canCreateDiscussions) => {
        if (canCreateDiscussions) {
            swal({
                title : "Batal!",
                text : "Your file has been deleted.",
                type : "success",
                buttons : {
                    confirm : {
                        className : "btn btn-success"
					}
				}
			});
            } else {
            swal.close();
		}
	});
}
function swalredir(base,msg) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass : {
            confirmButton : "btn btn-success",
            cancelButton : "btn btn-danger"
		},
        buttonsStyling : false
	});
    Swal.fire({
        title : "Server status!!!",
        text : msg,
        icon : "error",
        showDenyButton : false,
        showCancelButton : false,
        confirmButtonText : 'Tutup!',
        cancelButtonText : '<i class="fa fa-times"></i> Tutup',
        denyButtonText : '<i class="fa fa-save"></i> Simpan',
        confirmButtonColor : "#ff4000",
        denyButtonColor : "#d90000",
        showCloseButton : false,
        allowOutsideClick : false,
        reverseButtons : true
        }).then((tx) => {
        if (tx.isConfirmed) {
            window.location.replace(base+'error/401');
            } else {
            if (tx.isDenied) {
				window.location.replace(base+'error/401');
			}
		}
	});
    //
	
}
/**
    * @param {!Object} t
    * @param {string} xgh2
    * @param {string} xgh3
    * @return {undefined}
*/
function sweet_time(t, xgh2, xgh3) {
    let initializeCheckTimer;
    Swal.fire({
        title : xgh2,
        html : xgh3,
        showCloseButton : true,
        timer : t,
        timerProgressBar : true,
        didOpen : () => {
            Swal.showLoading();
            /** @type {number} */
            initializeCheckTimer = setInterval(() => {
                const phoneButton = Swal.getContent();
                if (phoneButton) {
                    const td1b2 = phoneButton.querySelector("b");
                    if (td1b2) {
                        td1b2.textContent = Swal.getTimerLeft();
					}
				}
			}, 100);
		},
        willClose : () => {
            clearInterval(initializeCheckTimer);
		}
        }).then((a) => {
        if (a.dismiss === Swal.DismissReason.timer) {
		}
	});
}
/**
    * @param {?} action
    * @param {?} fname
    * @param {?} fmt
    * @return {undefined}
*/
function sweet_login(action,icon,base_url) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass : {
            confirmButton : "btn btn-success",
            cancelButton : "btn btn-danger"
		},
        buttonsStyling : false
	});
    Swal.fire({
        title : "Status Login!",
        text : action,
        icon : icon,
        showDenyButton : false,
        showCancelButton : false,
        confirmButtonText : 'Klik untuk login!',
        cancelButtonText : '<i class="fa fa-times"></i> Cancel',
        denyButtonText : '<i class="fa fa-save"></i> Cancel',
        confirmButtonColor : "#2db300",
        denyButtonColor : "#006cd9",
        showCloseButton : true,
        allowOutsideClick : false,
        reverseButtons : true
        }).then((tx) => {
        if (tx.isConfirmed) {
			// location.reload();
		    window.location.href =base_url;
			// window.location.replace(base_url);
            } else {
            if (tx.isDenied) {
				window.location.href =base_url;
				// window.location.replace(base_url);
				// location.reload();
			}
		}
	});
}

/**
    * @param {?} action
    * @param {?} fname
    * @param {?} fmt
    * @return {undefined}
*/
function sweet_cetak(action, fname, fmt) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass : {
            confirmButton : "btn btn-success",
            cancelButton : "btn btn-danger"
		},
        buttonsStyling : false
	});
    Swal.fire({
        title : "Anda yakin?",
        text : "Periksa kembali sebelum di cetak!",
        icon : "warning",
        showDenyButton : true,
        showCancelButton : false,
        confirmButtonText : '<i class="fa fa-print"></i> Cetak!',
        cancelButtonText : '<i class="fa fa-times"></i> Tutup',
        denyButtonText : '<i class="fa fa-save"></i> Simpan',
        confirmButtonColor : "#2db300",
        denyButtonColor : "#006cd9",
        showCloseButton : true,
        allowOutsideClick : false,
        reverseButtons : true
        }).then((tx) => {
        if (tx.isConfirmed) {
            cetak(action);
            } else {
            if (tx.isDenied) {
                save_data(action, fname, fmt);
			}
		}
	});
}
/**
    * @param {string} p
    * @param {string} color
    * @param {string} icon
    * @param {?} buttons
    * @return {undefined}
*/
function action_save(icon,msg,warna) {
    Swal.fire({
		icon : icon,
        title : msg,
		showDenyButton: false,
		showCancelButton: false,
		confirmButtonText: 'Bayar',
		denyButtonText: false,
		}).then((result) => {
		/* Read more about isConfirmed, isDenied below */
		if (result.isConfirmed) {
			// Swal.fire('Saved!', '', 'success')
			$('.bayarin').click();
			} else if (result.isDenied) {
			Swal.fire('Changes are not saved', '', 'info')
		}
	})
}

/**
    * @param {string} p
    * @param {string} color
    * @param {string} icon
    * @param {?} buttons
    * @return {undefined}
*/
function sweet(p, color, icon, buttons) {
    const $ = Swal.mixin({
        customClass : {
            confirmButton : "btn btn-" + buttons
		},
        buttonsStyling : false
	});
    $.fire({
        icon : icon,
        title : p,
        text : color
	});
}
/**
    * @param {string} sf
    * @param {!Object} t
    * @param {?} xgh2
    * @return {undefined}
*/
function sweet_timer(sf, t, xgh2) {
    let initializeCheckTimer;
    Swal.fire({
        title : sf,
        html : "I will close in <b></b> milliseconds.",
        timer : t,
        timerProgressBar : true,
        didOpen : () => {
            Swal.showLoading();
            const td1b2 = Swal.getHtmlContainer().querySelector("b");
            /** @type {number} */
            initializeCheckTimer = setInterval(() => {
                td1b2.textContent = Swal.getTimerLeft();
			}, 100);
		},
        willClose : () => {
            clearInterval(initializeCheckTimer);
		}
        }).then((a) => {
        if (a.dismiss === Swal.DismissReason.timer) {
            console.log("I was closed by the timer");
		}
	});
}
/**
    * @param {?} title
    * @param {?} message
    * @param {string} name
    * @return {undefined}
*/
function sweetb(title, message, name) {
    swal(title, message, {
        icon : name,
        buttons : {
            confirm : {
                className : "btn btn-" + name
			}
		}
	});
}
/**
    * @param {!Array} jsFiles
    * @param {string} pageScript
    * @return {undefined}
*/
function loadJS(jsFiles, pageScript) {
    var i;
    /** @type {number} */
    i = 0;
    for (; i < jsFiles.length; i++) {
        /** @type {!Element} */
        var el_head = document.getElementsByTagName("body")[0];
        /** @type {!Element} */
        var script = document.createElement("script");
        /** @type {string} */
        script.type = "text/javascript";
        /** @type {boolean} */
        script.async = false;
        script.src = jsFiles[i];
        el_head.appendChild(script);
	}
    if (pageScript) {
        /** @type {!Element} */
        el_head = document.getElementsByTagName("body")[0];
        /** @type {!Element} */
        script = document.createElement("script");
        /** @type {string} */
        script.type = "text/javascript";
        /** @type {boolean} */
        script.async = false;
        /** @type {string} */
        script.src = pageScript;
        el_head.appendChild(script);
	}
}
;