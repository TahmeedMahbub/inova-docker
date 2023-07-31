//load category

$(document).ready(function () {
  $("#loadcat1").click(function (e) {
    $("#loadcat1").addClass("clicked");
    $("#loadcat2").removeClass("clicked");
    $("#loadcat3").removeClass("clicked");
    $("#htmlData").load("databoot.html #cat1");
  });
});

$(document).ready(function () {
  $("#loadcat2").click(function (e) {
    $("#loadcat1").removeClass("clicked");
    $("#loadcat2").addClass("clicked");
    $("#loadcat3").removeClass("clicked");
    $("#htmlData").load("databoot.html #cat2");
  });
});

$(document).ready(function () {
  $("#loadcat3").click(function (e) {
    $("#loadcat1").removeClass("clicked");
    $("#loadcat2").removeClass("clicked");
    $("#loadcat3").addClass("clicked");
    $("#htmlData").load("databoot.html #cat3");
  });
});

$(document).ready(function () {
  $("#edituser1").click(function (e) {
    $("#userbox").removeClass("d-none");
    $("#userbox").addClass("d-block");
    $("#addbox").removeClass("d-block");
    $("#addbox").addClass("d-none");
    $("#cart-list").load("databoot.html #cart1");
  });
});

$(document).ready(function () {
  $("#cart-confirm").click(function (e) {
    location.reload();
  });
});


$(document).ready(function () {
  $("#cartclear").click(function (e) {
    location.reload();
  });
});

//add to list

$(document).on("click", "#add2", function () {
  // alert($("#add1").attr("value"));
  // alert("#price1");
  var price = $("#add2").attr("value");
  var name = $("#add2").attr("name");
  $("#cart-list").append(
    '<li class="border rounded p-2" style="">' +
      '<div class="d-flex justify-content-between align-items-center">' +
      '        <div class="d-flex justify-content-between align-items-center">' +
      '            <h4 class="rounded-circle m-1 me-3 p-2 fw-bold qtn-box">2</h4>' +
      '            <div class="d-flex justify-content-between align-items-center mt-2">' +
      '                <h5 class="text-secondary">Samsung S9</h5>' +
      "            </div>" +
      "        </div>" +
      '        <div class="d-flex mt-2">' +
      '            <h5 class="">666$</h5>' +
      '            <div class="d-flex ms-3">' +
      '                <div class="me-2" style="color: #6b93d3 "' +
      '                id="edit1" onclick="dltItem()"><i class="fas fa-pen fa-lg"></i></i></div>' +
      '                <div class="me-2" style="color: #6b93d3 "' +
      '                onclick="dltItem()"><i class="fas fa-times fa-lg"></i></i></div>' +
      "            </div>" +
      "        </div>" +
      "        </div>" +
      "    </li>"
  );

  //   '<li><div class= "md-list-content cartflex" ><div class="md-list-heading">' +
  //     name +
  //     '</div><div class="uk-text-small uk-padding-small">' +
  //     "$ " +
  //     price +
  //     "</div></ ></li >"
  // );
  updateScroll();
  calculation(price);
  // $(document).ready(function () {
  //     $(document).on("click", '#add2', function () {
  //         var price = $("#add2").attr("value");
  //         var name = $("#add2").attr("name");
  //         $("#cart-list").append('<li><div class= "md-list-content cartflex" ><div class="md-list-heading">' + name + '</div><div class="uk-text-small">' + '$ ' + price + '</div></ ></li >');
  //         calculation(price);
  //     });
});

// $(document).on("click", "#add1", function () {
//   var price = $("#add1").attr("value");
//   var name = $("#add1").attr("name");
//   var sku = $("#add1").attr("sku");

//   $("#canvas-price").empty();
//   $("#canvas-name").empty();
//   $("#canvas-sku").empty();

//   $("#canvas-price").append(price);
//   $("#canvas-name").append(name);
//   $("#canvas-sku").append(sku);

//   document.getElementById("offcanvas-btn").click();
//   updateScroll();
// });

function updateScroll() {
  var cartElement = document.getElementById("cart-list");
  cartElement.scrollTop = cartElement.scrollHeight;
}

//Calculation Functions
function calculation(cost) {
  cost = parseInt(cost);

  var subtotalelement = document.getElementById("subtotal");
  var subtotalnumber = subtotalelement.innerHTML.match(/\d+/g); // Get numbers from element's content.

  // var subtotalnumber = subtotalelement.value; // Get numbers from element's content.
  console.log(subtotalnumber);
  subtotal = parseInt(subtotalnumber);

  //subtotal

  subtotal = subtotal + cost;
  console.log("subtotal" + subtotal);
  document.getElementById("subtotal").innerHTML = subtotal;

  //tax

  var taxelement = document.getElementById("tax");
  var taxnumber = taxelement.innerHTML.match(/\d+/g); // Get numbers from element's content.
  tax = parseInt(taxnumber);
  tax = parseFloat(subtotal * 0.1).toFixed(2); //10% tax
  console.log("tax " + tax);
  document.getElementById("tax").innerHTML = tax;
  document.getElementById("taxinput").value = tax;

  //tax

  var shipelement = document.getElementById("ship");
  var shipnumber = shipelement.innerHTML.match(/\d+/g); // Get numbers from element's content.
  ship = parseInt(shipnumber);
  ship = ship + 30;
  console.log("ship " + ship);

  document.getElementById("shipinput").value = ship;

  //discount

  var discountelement = document.getElementById("discount");
  var discountnumber = discountelement.innerHTML.match(/\d+/g); // Get numbers from element's content.
  discount = parseInt(discountnumber);
  discount = parseFloat(subtotal * 0.2).toFixed(2); //20% discount
  console.log("discount " + discount);
  document.getElementById("discount").innerHTML = discount;
  console.log("discount " + discount);

  //total
  var totalelement = document.getElementById("total");
  var totalnumber = totalelement.innerHTML.match(/\d+/g); // Get numbers from element's content.
  total = parseInt(totalnumber);
  console.log(total, subtotal, tax, discount, totalnumber);
  total = parseFloat(subtotal + parseFloat(tax) - parseFloat(discount)).toFixed(
    2
  );
  //total
  console.log("total " + total);
  document.getElementById("total").innerHTML = total;
}

//Click function

function productclick() {
  console.log("switch");
  document.getElementById("style_switcher").click();
}

$(document).ready(function () {
  $("button").on("click", function () {
    $("button").removeClass("active");
    $(this).addClass("active");
  });
});
function dltItem() {
  console.log("dlted");
  let el = this.parentElement;
  console.log(el.innerHTML);
}

$(document).on("click", "#addcanvas", function () {
  var totalnumelElement = document.getElementById("totalshow");
  var price = totalnumelElement.innerHTML.match(/\d+/g);
  //   var name = $("#canvas-name").innerText;
  var name = "Samsung S9";
  var qtnElement = document.getElementById("qtninput");
  var qtn = parseInt(qtnElement.value);
  calculation(price);
  $("#cart-list").append(
    '<li class="border rounded p-2" style="">' +
      '<div class="d-flex justify-content-between align-items-center">' +
      '        <div class="d-flex justify-content-between align-items-center">' +
      '            <h4 class="rounded-circle m-1 me-3 p-2 fw-bold qtn-box">' +
      qtn +
      "</h4>" +
      '            <div class="d-flex justify-content-between align-items-center mt-2">' +
      '                <h5 class="text-secondary">' +
      name +
      "</h5>" +
      "            </div>" +
      "        </div>" +
      '        <div class="d-flex mt-2">' +
      '            <h5 class="">' +
      price +
      " $</h5>" +
      '            <div class="d-flex ms-3">' +
      '                <div class="me-2" style="color: #6b93d3 ;"' +
      '                onclick="dltItem()"><i class="fas fa-pen fa-lg"></i></i></div>' +
      '                <div class="me-2" style="color: #6b93d3 ;"' +
      '                onclick="dltItem()"><i class="fas fa-times fa-lg"></i></i></div>' +
      "            </div>" +
      "        </div>" +
      "        </div>" +
      "    </li>"
  );
  updateScroll();
  document.getElementById("close-btn").click();
  //   calculation(price);
  // $(document).ready(function () {
  //     $(document).on("click", '#add2', function () {
  //         var price = $("#add2").attr("value");
  //         var name = $("#add2").attr("name");
  //         $("#cart-list").append('<li><div class= "md-list-content cartflex" ><div class="md-list-heading">' + name + '</div><div class="uk-text-small">' + '$ ' + price + '</div></ ></li >');
  //         calculation(price);
  //     });
});

// Get the input field
$(document).on("keyup", "#qtninput", function () {
  var value = $(this).val();
  console.log(value);
  getqtnValue();
});

function getqtnValue() {
  console.log("getqtnValue()");
  var qtnElement = document.getElementById("qtninput");
  var qtn = parseInt(qtnElement.value);
  var totalnumelElement = document.getElementById("totalshow");
  var totalnum = totalnumelElement.innerHTML.match(/\d+/g);
  var totalcost = parseInt(totalnum);
  totalcost = 555 * qtn;
  document.getElementById("totalshow").innerHTML = totalcost;
  console.log(qtn, totalcost);
}

$(document).on("click", "#edit1", function () {
  console.log(price);
  var price = $("#edit1").attr("value");
  var name = $("#edit1").attr("name");
  var sku = $("#edit1").attr("sku");

  $("#canvas-price").empty();
  $("#canvas-name").empty();
  $("#canvas-sku").empty();

  $("#canvas-price").append(price);
  $("#canvas-name").append(name);
  $("#canvas-sku").append(sku);

  document.getElementById("offcanvas-btn").click();
});
// var qtninput = document.getElementById("qtninput");

// // Execute a function when the user releases a key on the keyboard
// qtninput.addEventListener("keyup", function (event) {
//   console.log("sdsfasdfew3");
//   // Number 13 is the "Enter" key on the keyboard
//   if (event.keyCode === 13) {
//     // Cancel the default action, if needed
//     // event.preventDefault();
//     // Trigger the button element with a click
//     console.log("clicked qtn");
//     document.getElementById("qtnBtn").click();
//   }
// });

//offcanvas button
// $("#qtninput").keyup(function (event) {
//   if (event.keyCode === 13) {
//     $("#qtnbtn").click();
//   }
// });

// var input = document.getElementById("qtninput");
// input.addEventListener("keyup", function (event) {
//   if (event.keyCode === 13) {
//     event.preventDefault();
//     document.getElementById("qtnbtn").click();
//   }
// });

$(document).on("click", "#cart-confirm", function () {
  let cartEl = document.getElementById("cart").innerHTML;
  console.log(cartEl);
});

$(document).on("load", "#cart-confirm", function () {
  console.log("cartget");
  $("#takecart").load("homeboot.html #cart");
});
