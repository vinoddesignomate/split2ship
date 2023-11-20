document.addEventListener("DOMContentLoaded", function () {
  var inputField = document.getElementById("order_number_val");
  var inputField2 = document.getElementById("order_email_val");
  inputField.addEventListener("input", getinpoutdata);
  inputField2.addEventListener("input", getinpoutdata);

  document
    .getElementById("split_exchng")
    .addEventListener("click", function () {
      var ordernum = document.getElementById("order_number_val");
      var emailfields = document.getElementById("order_email_val");
      var orderf = "";
      var emailf = "";
      if (ordernum) {
        orderf = ordernum.value;
      }
      if (emailfields) {
        emailf = emailfields.value;
      }
      var send_data = JSON.stringify({
        shopname: shopname,
        ordernum: orderf,
        emailf: emailf,
      });

      fetch("https://app.payxnowandrestondelivery.com/fetch-order", {
        method: "POST",
        body: send_data,
      })
        .then((response) => response.json())
        .then((response) => {
          //console.log(response);
          const exhcshow_orders = document.querySelector(
            ".Polaris-Layout__Section"
          );
          if (exhcshow_orders) {
            exhcshow_orders.style.display = "block";
          }
          document.getElementById("input_start_process").style.display = "none";

          document.getElementById("ordif").value = response.order_id;
          document.getElementById("Polaris-Heading_head").innerHTML =
            "Order number: #" + response.order_num;
          document.getElementById("Polaris-Heading_date").innerHTML =
            response.order_date;
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });

  // Get a reference to your checkbox element
  // var plorischeckbox = document.querySelector('.Polaris-Checkbox__Input');

  // Add an event listener to the checkbox
  document.querySelector("body").addEventListener("click", function (event) {
    if (event.target.classList.contains("Polaris-Checkbox__Input")) {
      var idattr = event.target.getAttribute("idattr");
      if (event.target.checked) {
        console.log(idattr);

        document.getElementById("reason_" + idattr).style.display =
          "inline-block";
        document.getElementById("setva_" + event.target.id).value =
          event.target.id;
        // alert('Checkbox is checked!');

        // var popup = document.getElementById("popup_config");
        // popup.style.display = "block";
        // var body = document.body;
        // body.classList.add("package_popup_visible");
      } else {
        document.getElementById("reason_" + idattr).style.display = "none";
        document.getElementById("setva_" + event.target.id).value = "";
        //alert('Checkbox is unchecked!');
      }
    }
  });

  // var form = document.getElementById('ordertrackfrm');
  // form.addEventListener('submit', function(e) {
  document
    .getElementById("ordertrackfrm")
    .addEventListener("submit", function (e) {
      e.preventDefault(); // Prevent the default form submission

      // Get the form data using FormData
      var formData = new FormData(this);
      //e.preventDefault(); // Prevent the default form submission
      // console.log(form.innerHTML);
      // var formnew = document.getElementById('ordertrackfrm');
      // var formData_content = new FormData(formnew);
      console.log(formData);
      const selectElements = document.querySelectorAll(
        'select[name="get_reason[]"]'
      );
      const selectedOptionValues = [];

      selectElements.forEach(function (selectElement) {
        const options = selectElement.options;

        for (let j = 0; j < options.length; j++) {
          const option = options[j];
          if (option.value != "") {
            if (option.selected) {
              selectedOptionValues.push(option.value);
            }
          }
        }
      });

      const hiddenInputElements = document.querySelectorAll(
        'input[name="getid[]"]'
      );
      const hiddenInputValues = [];

      hiddenInputElements.forEach(function (hiddenInput) {
        if (hiddenInput.value != "") {
          hiddenInputValues.push(hiddenInput.value);
        }
      });
      var orderid = document.getElementById("ordif").value;
      //console.log('prctidvalValues');
      //console.log(prctidvalValues);
      //return false;
      var send_data = JSON.stringify({
        shopname: shopname,
        reason: selectedOptionValues,
        productid: hiddenInputValues,
        orderid: orderid,
      });
      fetch("https://app.payxnowandrestondelivery.com/fetch-track-return", {
        method: "POST",
        body: send_data,
      })
        .then((response) => response.json())
        .then((response) => {
          if (response == "done") {
            document.getElementById("exchange_reason_process").style.display =
              "block";
            document.getElementById("ordertrackfrm").style.display = "none";
          } else {
            alert(response);
          }
        })
        .catch((error) => {
          //console.error('Error:', error);
        });
    });

  //select order info by order id
  document
    .getElementById("getorderinfo")
    .addEventListener("click", function () {
      var orderid = document.getElementById("ordif").value;

      var send_data = JSON.stringify({
        shopname: shopname,
        orderid: orderid,
      });

      fetch("https://app.payxnowandrestondelivery.com/fetch-order-info", {
        method: "POST",
        body: send_data,
      })
        .then((response) => response.json())
        .then((response) => {
          var infiohtm = "";
          const exhcshow_orders = document.querySelector(
            ".Polaris-Layout__Section"
          );
          if (exhcshow_orders) {
            exhcshow_orders.style.display = "none";
          }
          document.getElementById("input_start_process").style.display = "none";
          var lpid = 1;
          for (var i = 0; i < response.length; i++) {
            infiohtm +=
              '<input type="hidden" name="getid[]" id="setva_' +
              response[i]["varient_id"] +
              '" value=""><div class="boxesMain09"><div class="forIMGpurpose"><img src="' +
              response[i]["product_image"] +
              '" /></div><div class="forTextpurpose"><h4>' +
              response[i]["product_name"] +
              "</h4><h5>" +
              response[i]["product_price"] +
              " x " +
              response[i]["product_qty"] +
              '</h5></div><div class="reasonDefine"><h6>Non Reason: <span>Unfulfilled</span></h6></div><span><input id="' +
              response[i]["varient_id"] +
              '" type="checkbox" idattr="' +
              lpid +
              '" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" name="checkbox_name[]" aria-checked="false" value=""></span><select id="reason_' +
              lpid +
              '" style="display:none;" name="get_reason[]"><option value="">Select Reason</option><option value="arrive_late">Arrive too late</option><option value="poor_qlty">Poor Quality</option><option value="looks_diffferent">Looks Different</option><option value="des_suit_me">Does suit me</option><option value="parcel_damge">Parcel damaged on arrival</option><option>Poor Quality</option></select></div>';
            lpid++;
          }
          document.getElementById("order_info").innerHTML = infiohtm;
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
});

function getinpoutdata() {
  var inputField = document.getElementById("order_number_val");
  var inputField2 = document.getElementById("order_email_val");
  var split_exchngButton = document.getElementById("split_exchng");
  var enteredText = inputField.value;
  var enteredText2 = inputField2.value;

  if (enteredText !== "" && enteredText2 !== "") {
    split_exchngButton.removeAttribute("disabled");
  } else {
    split_exchngButton.setAttribute("disabled", "disabled");
  }
}
