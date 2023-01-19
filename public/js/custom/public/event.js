$(function () {

  var start_date  = '';
  var end_date    = '';


    // $('input[name="start_date"]').daterangepicker({
    //     singleDatePicker: true,
    //     showDropdowns: true,
    //     // autoUpdateInput: false,
    //     minYear: 1901,
    //     maxYear: parseInt(moment().format("YYYY"), 10),
    //     autoApply: true,
    //     locale: { format: "DD-MM-YYYY" },
    // });

    // $('input[name="end_date"]').daterangepicker({
    //     singleDatePicker: true,
    //     showDropdowns: true,
    //     // autoUpdateInput: false,
    //     minYear: 1901,
    //     maxYear: parseInt(moment().format("YYYY"), 10),
    //     autoApply: true,
    //     locale: { format: "DD-MM-YYYY" },
    // });

    $('input[name="dateRange"]').daterangepicker({
        autoUpdateInput: false,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format("YYYY"), 10),
        locale: {
            cancelLabel: "Clear",
            format: "DD-MM-YYYY",
        },
    });

    $('input[name="dateRange"]').on(
        "apply.daterangepicker",
        function (ev, picker) {
            $(this).val(
                picker.startDate.format("MM/DD/YYYY") +
                    " - " +
                    picker.endDate.format("MM/DD/YYYY")
            );
            $("#start_date").val(picker.startDate.format("YYYY-MM-DD"));
            $("#end_date").val(picker.endDate.format("YYYY-MM-DD"));
            fetch_data(null);
        }
    );

    $('input[name="dateRange"]').on(
        "cancel.daterangepicker",
        function (ev, picker) {
            $(this).val("");
            $("#start_date").val('');
            $("#end_date").val('');
        }
    );
});



  function fetch_data(page) {
    var query       = $("#search").val();
    var page        = (page == null) ? $("#hidden_page").val() : page;
    start_date      = $("#start_date").val();
    end_date        = $("#end_date").val();

      $.ajax({
          url: "/events/fetch_data?page=" + page + "&query=" + query + "&start_date=" + start_date + "&end_date=" + end_date,
          success: function (data) {
              $("tbody").html("");
              $("tbody").html(data);
          },
      });
  }

  $(document).on("keyup", "#search", function () {
      fetch_data(null);
  });

  $(document).on("click", ".pagination a", function (e) {
      e.preventDefault();
      var page = $(this).attr("href").split("page=")[1];
      $("#hidden_page").val(page);
      var query = $("#search").val();

      $("li").removeClass("active");
      $(this).parent().addClass("active");
      fetch_data(page);
  });


