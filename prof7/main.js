function render_cart() {
  //РЕНДЕР КОРЗИНЫ
  let check_size = true;
  let subTotal = 0;
  document.getElementById("get_cart").innerHTML = `<div class="cart_btns">
  <button class="cart_btn" onclick="delCart()">CLEAR SHOPPING CART</button>
  <a href="index.php" class="cart_btn">CONTINUE SHOPPING</a>
  </div>`;
  if (localStorage.getItem("cart")) {
    let arr_set = JSON.parse(localStorage.getItem("cart"));
    arr_set.forEach((item, i) => {
      let st = "background: #ffffff";
      if (item.size == "") {
        check_size = false;
        st = "background: #F16D7F";
      }
      subTotal = subTotal + item.price * item.quantity;
      document.getElementById("get_cart").insertAdjacentHTML(
        "afterbegin",
        `<div  id="for_size_${i}" class="cart_change_item">
                <a href="catalog.php?type=${item.gend}"><img class="img_cart" src="img/${item.some_gender}/${item.photo_name}" alt="product"></a>
                  <div class="cart_change_item_info">
                      <svg onClick="delGood(${i})" class="cart_close" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.2453 9L17.5302 2.71516C17.8285 2.41741 17.9962 2.01336 17.9966 1.59191C17.997 1.17045 17.8299 0.76611 17.5322 0.467833C17.2344 0.169555 16.8304 0.00177586 16.4089 0.00140366C15.9875 0.00103146 15.5831 0.168097 15.2848 0.465848L9 6.75069L2.71516 0.465848C2.41688 0.167571 2.01233 0 1.5905 0C1.16868 0 0.764125 0.167571 0.465848 0.465848C0.167571 0.764125 0 1.16868 0 1.5905C0 2.01233 0.167571 2.41688 0.465848 2.71516L6.75069 9L0.465848 15.2848C0.167571 15.5831 0 15.9877 0 16.4095C0 16.8313 0.167571 17.2359 0.465848 17.5342C0.764125 17.8324 1.16868 18 1.5905 18C2.01233 18 2.41688 17.8324 2.71516 17.5342L9 11.2493L15.2848 17.5342C15.5831 17.8324 15.9877 18 16.4095 18C16.8313 18 17.2359 17.8324 17.5342 17.5342C17.8324 17.2359 18 16.8313 18 16.4095C18 15.9877 17.8324 15.5831 17.5342 15.2848L11.2453 9Z" fill="#575757" />
                      </svg>
                      <p class="cart_tittle">${item.name}</p>
                    <div class="cart_tittle_info">
                        <div>Price: <span class="cart_price_pink">$${item.price}</span></div>
                        <div class="quant">
                            <p>Quantity:</p>
                            <div class="render_quant_form">
                                <p class="render_quant">${item.quantity}</p>
                                <div class="render_waves">
                                    <div onClick="upQuantity(${i})">
                                        <button class="render_w"></button>
                                    </div>
                                    <div onClick="downQuantity(${i})">
                                        <button class="render_w"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <details class="render_details">
                            <summary class="list_summary add_width" style = "${st}">
                                Size: ${item.size}
                                <svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.00214 5.00214C4.83521 5.00247 4.67343 4.94433 4.54488 4.83782L0.258102 1.2655C0.112196 1.14422 0.0204417 0.969958 0.00302325 0.781035C-0.0143952 0.592112 0.0439493 0.404007 0.165221 0.258101C0.286493 0.112196 0.460759 0.0204417 0.649682 0.00302327C0.838605 -0.0143952 1.02671 0.043949 1.17262 0.165221L5.00214 3.36602L8.83167 0.279536C8.90475 0.220188 8.98884 0.175869 9.0791 0.149125C9.16937 0.122382 9.26403 0.113741 9.35764 0.1237C9.45126 0.133659 9.54198 0.162021 9.6246 0.207156C9.70722 0.252292 9.7801 0.313311 9.83906 0.386705C9.90449 0.460167 9.95405 0.546351 9.98462 0.639855C10.0152 0.733359 10.0261 0.83217 10.0167 0.930097C10.0073 1.02802 9.97784 1.12296 9.93005 1.20895C9.88227 1.29494 9.81723 1.37013 9.73904 1.42982L5.45225 4.88068C5.32002 4.97036 5.16154 5.01312 5.00214 5.00214Z" fill="#6F6E6E" />
                                </svg>
                            </summary>
                            <div class="input_render">
                                <div onClick="changeSize(${i}, 'XS')"><input class="check_box" name="in_size" type="radio" value="XS"> XS</div>
                                <div onClick="changeSize(${i}, 'S')"><input class="check_box" name="in_size" type="radio" value="S"> S</div>
                                <div onClick="changeSize(${i}, 'M')"><input class="check_box" name="in_size" type="radio" value="M"> M</div>
                                <div onClick="changeSize(${i}, 'L')"><input class="check_box" name="in_size" type="radio" value="L"> L</div>
                                <div onClick="changeSize(${i}, 'XL')"><input class="check_box" name="in_size" type="radio" value="XL"> XL</div>
                                <div onClick="changeSize(${i}, 'XXL')"><input class="check_box" name="in_size" type="radio" value="XXL"> XXL</div>
                            </div>
                        </details>
                    </div>
                  </div>
            </div>`
      );
    });
  }
  if (!check_size) {
    document.getElementById("go_to_pay").type = "button";
    document.getElementById("go_to_pay_text").innerHTML = "CHECK SIZE!";
  } else {
    document.getElementById("get_order").value = localStorage.getItem("cart");
    document.getElementById("go_to_pay").type = "submit";
    document.getElementById("go_to_pay_text").innerHTML = "PROCEED TO CHECKOUT";
    document.getElementById("go_to_pay_text").className = "minus";
    /*let el = document.querySelectorAll(".add_width");
    for (let item of el) {
      item.style.boxShadow = "0px 0px 0px red";
    }*/
  }
  let total = subTotal * 1.08;
  document.getElementById("sub_total").innerHTML = "$" + subTotal.toFixed(2);
  document.getElementById("grand_total").innerHTML = "$" + total.toFixed(2);
  cart_index();
}
function close_menu() {
  document.getElementById("header_menu").open = false;
}

function addToCart(
  gend,
  id,
  name,
  size,
  price,
  photo_name,
  quantity,
  some_gender
) {
  let arr_set = [];
  if (localStorage.getItem("cart")) {
    arr_set = JSON.parse(localStorage.getItem("cart"));
  }
  const arr_assoc = {
    gend: gend,
    id: id,
    name: name,
    size: size,
    price: price,
    photo_name: photo_name,
    quantity: quantity,
    some_gender: some_gender,
  };
  arr_set.push(arr_assoc);
  localStorage.setItem("cart", JSON.stringify(arr_set));
  cart_index();
}

function upQuantity(i) {
  arr_set = JSON.parse(localStorage.getItem("cart"));
  arr_set[i].quantity++;
  localStorage.setItem("cart", JSON.stringify(arr_set));
  render_cart();
}

function downQuantity(i) {
  arr_set = JSON.parse(localStorage.getItem("cart"));
  if (arr_set[i].quantity > 1) {
    arr_set[i].quantity--;
  }
  localStorage.setItem("cart", JSON.stringify(arr_set));
  render_cart();
}

function delCart() {
  localStorage.clear();
  document.getElementById("cart_include_index").innerHTML = "";
  render_cart();
}
function delGood(i) {
  let arr_set = JSON.parse(localStorage.getItem("cart"));
  arr_set.splice(i, 1);
  localStorage.setItem("cart", JSON.stringify(arr_set));
  render_cart();
}

function changeSize(i, s) {
  let arr_set = JSON.parse(localStorage.getItem("cart"));
  arr_set[i].size = s;
  localStorage.setItem("cart", JSON.stringify(arr_set));
  render_cart();
}
function cart_index() {
  if (localStorage.getItem("cart")) {
    let cartGoods = 0;
    let arr_set = JSON.parse(localStorage.getItem("cart"));
    arr_set.forEach((item) => {
      cartGoods = cartGoods + 1 * item.quantity;
    });
    document.getElementById("cart_include_index").innerHTML = cartGoods;
    if (cartGoods == 0) {
      document.getElementById("cart_include_index").innerHTML = "";
      localStorage.clear();
      document.getElementById("get_order").value = "";
    }
  }
}

$(function () {
  $("#more_goods")
    .unbind("submit")
    .submit(function (e) {
      e.preventDefault();
      let data = $(this).serialize();
      let i = parseInt($("#more_goods_input").val());
      i += 9;
      $.ajax({
        type: "POST",
        url: "ajax.php?c=ajax",
        data: data,
        success: function (result) {
          $("#box_for_goods").append(result);
          $("#more_goods_input").val(i);
          if ($(".uniq_input").val() == $("#more_goods_input").val()) {
            $("#more_goods").hide();
          }
        },
      });
    });
});

$(function () {
  $("#more_goods_admin")
    .unbind("submit")
    .submit(function (e) {
      e.preventDefault();
      let data = $(this).serialize();
      let i = parseInt($("#more_goods_input_admin").val());
      i += 9;
      $.ajax({
        type: "POST",
        url: "ajax_admin.php?c=ajax",
        data: data,
        success: function (result) {
          $("#box_for_goods_admin").append(result);
          $("#more_goods_input_admin").val(i);
          if ($(".uniq_input").val() == $("#more_goods_input_admin").val()) {
            $("#more_goods_admin").hide();
          }
        },
      });
    });
});
function showMore() {
  console.log("Hello!!!");
}

if (document.getElementById("get_cart")) {
  render_cart();
  cart_index();
}

cart_index();
