$("body").on("shown.bs.modal", "#add-data", function () {
  $("input:visible:enabled:first", this).focus();
});
