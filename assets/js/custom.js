var BASE_URL = "http://localhost/p_market/";
// function get_dashboard() {
//   $.ajax({
//     type: "GET",
//     url: BASE_URL + "dashboard",
//     dataType: "html",
//     async: false,
//     success: function (data) {
//       //    alert(data)
//       $("#dashboard_body").html("");
//       $("#dashboard_body").html(data);
//     },
//   });
// }

$(document).ready(function(){
  $(".openmodal").click(function() {
      var id = $(this).attr("data-value");
      $.ajax({
        type: "GET",
        url: BASE_URL + "modaldata.php?id="+id,
        dataType: "html",
        async: false,
        success: function (data) {
          //    alert(data)
          $("#modalbody").html("");
          $("#modalbody").html(data);
        },
      });
    });

    $(".paidproducts").click(function() {
      $.ajax({
        type: "GET",
        url: BASE_URL + "paidproducts.php",
        dataType: "html",
        async: false,
        success: function (data) {
          //    alert(data)
          $("#modal_body").html("");
          $("#modal_body").html(data);
        },
      });
    });


    $(".paynow").click(function() {
      var id = $('#product_id').val();
      var check_paid = $('#check_paid').val();
      
      if(id == ''){
        alert('Something went wrong. Refresh the page.');
      }else if(check_paid >0){
        alert("This product is already paid!");
      }else{
        window.location.href = BASE_URL + "paymentform.php?id="+id;
      }
    })
      
});
