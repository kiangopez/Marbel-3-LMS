jQuery(document).ready(function () {
  jQuery("#opt11").hide();
  jQuery("#opt12").hide();
  jQuery("#opt13").hide();

  jQuery("#qtype").change(function () {
    var x = jQuery(this).val();
    if (x == "1") {
      jQuery("#opt11").show();
      jQuery("#opt12").hide();
      jQuery("#opt13").hide();
    } else if (x == "2") {
      jQuery("#opt11").hide();
      jQuery("#opt12").show();
      jQuery("#opt13").hide();
    } else {
      jQuery("#opt11").hide();
      jQuery("#opt12").hide();
      jQuery("#opt13").hide();
    }
  });
});
