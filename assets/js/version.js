'use strict';
/** @type {(Element|null)} */
var version = document.getElementById("version-pospercetakan");
/**
	* @param {string} filename
	* @param {!Function} callback
	* @return json
*/
function readTextFile(filename, callback) 
{
	/** @type {!XMLHttpRequest} */
	var xobj = new XMLHttpRequest;
	xobj.overrideMimeType("application/json");
	xobj.open("GET", filename, true);
	/**
		* @return {undefined}
	*/
	xobj.onreadystatechange = function() {
		if (xobj.readyState === 4 && xobj.status == "200") 
		{
			callback(xobj.responseText);
			}else{
			return;
		}
	};
	xobj.send(null);
}
loadnotif();
version_local();
/**
	* @return json
*/
function version_local() 
{
	var srcxml = base_url + "version.json";
	readTextFile(srcxml, function(permissions) 
		{
			/** @type {*} */
			var groupPermissionsRef = JSON.parse(permissions);
			var url = groupPermissionsRef["aplikasi"][0]["product"];
			var version_local = groupPermissionsRef["aplikasi"][0]["version"];
			console.log(version_local)
			/** @type {string} */
			version.innerHTML = url + " Version " + version_local;
			Cookies.set("version_local", version_local, 
				{
					expires : 1
				});
		});
}
// console.log(Cookies.get("version_local"));
window.addEventListener("online", () => {
	return loadnotif();
});

window.addEventListener("offline", () => {
	return version_local();
});

if (navigator.onLine) 
{
	
	if (Cookies.get("version") == Cookies.get("version_local")) 
	{
		version.innerHTML = Cookies.get("product") + " Version " + Cookies.get("version");
	} 
	else 
	{
		readTextFile("https://mywidget.github.io/update_checker_kasir.json", function(permissions) 
			{
				/** @type {*} */
				var groupPermissionsRef = JSON.parse(permissions);
				console.log( groupPermissionsRef.aplikasi.reverse()[0].version );
				var data_produk = groupPermissionsRef.aplikasi.reverse()[0].product;
				var data_versi = groupPermissionsRef.aplikasi.reverse()[0].version;
				//set cookie produk form api
				Cookies.set("product", data_produk, 
					{
						expires : 1
					});
					//set cookie version from api
					Cookies.set("version", data_versi, 
						{
							expires : 1
						});
			});
	}
} 
else 
{
	//cek cookie version from app
	if (Cookies.get("version")) 
	{
		version.innerHTML = Cookies.get("product") + " Version " + Cookies.get("version");
	} 
	else 
	{
		readTextFile(base_url + "version.json", function(permissions) 
			{
				/** @type {*} */
				var groupPermissionsRef = JSON.parse(permissions);
				var product = groupPermissionsRef["aplikasi"][0]["product"];
				var data_version = groupPermissionsRef["aplikasi"][0]["version"];
				/** @type {string} */
				version.innerHTML = product + " Version " + data_version;
				Cookies.set("product", product, 
					{
						expires : 1
					});
					Cookies.set("version", data_version, 
						{
							expires : 1
						});
			});
	}
}

/**
	* @return {html}
*/

function loadnotif() 
{
	
	if (Cookies.get("notif") == null || Cookies.get("notif") == "") 
	{
		
		if (navigator.onLine == true) 
		{
			// console.log('online')
			var fileUrl = base_url + "updateversi/cek_notifikasi";
			$(".cek, .download, .update").removeAttr("disabled");
			$.ajax({
				type : "POST",
				url : fileUrl,
				data : {
					tipe : "cek_notif"
				},
				cache : false,
				success : function(data) 
				{
					if (data == "error") 
					{
						$(".load-notif").html("");
						} else {
						Cookies.set("notif", data, {
							expires :1
						});
						
						$(".load-notif").html(data);
					}
				}
			});
			
		}
	} 
	else 
	{
		if (Cookies.get("version") != Cookies.get("version_local")) 
		{
			$(".load-notif").html(Cookies.get("notif"));
		}
	}
}

// Cookies.remove('version_local');
// Cookies.remove('notif');
// Cookies.remove('product');
// Cookies.remove('version');

$(document).on("click", ".badge-counter", function() {
	location.reload();
	deleteCookies();
});

function deleteCookies()
{
	Cookies.remove('version_local');
	Cookies.remove('notif');
	Cookies.remove('product');
	Cookies.remove('version');
}