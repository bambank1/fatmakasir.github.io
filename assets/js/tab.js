$(document).ready(function() {
  $("#keyword_cari").on("click", function() {
  });
  $(".tabs").click(function() {
    $(".tabs").removeClass("active");
    $(".tabs h6").removeClass("font-weight-bold");
    $(".tabs h6").addClass("text-muted");
    $(this).children("h6").removeClass("text-muted");
    $(this).children("h6").addClass("font-weight-bold");
    $(this).addClass("active");
    current_fs = $(".active");
    next_fs = $(this).attr("id");
    $("#cari_order").val("");
    $("#keyword_cari").val("");
    $("#cari_desain").val("");
    $("#form-desain").find("input,textarea,select").val("").end().find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
    $("#hasil_cari").hide();
    $("#hasil_cari_order").hide();
    $("#hasil_cari_desain").hide();
    $("#detail_cetak").hide();
    /** @type {string} */
    next_fs = "#" + next_fs + "1";
    $("fieldset").removeClass("show");
    $(next_fs).addClass("show");
    current_fs.animate({}, {
      step : function() {
        current_fs.css({
          "display" : "none",
          "position" : "relative"
        });
        next_fs.css({
          "display" : "block"
        });
      }
    });
    $("#tab01_").addClass("display-none");
    current_fs1 = $(".display-block");
    next_fs1 = $(this).attr("id");
    /** @type {string} */
    next_fs1 = "#" + next_fs1 + "_";
    $(current_fs1).addClass("display-none");
    $("#keyword_cari").val("");
    $("#hasil_cari").hide();
    $(next_fs1).removeClass("display-none").addClass("display-block");
  });
});