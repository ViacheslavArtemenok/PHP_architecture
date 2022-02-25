    <article>
        <div class="main_tittle_box">
            <div class="main_tittle_mini">
                <h3 class="pink_tittle">SHOPPING CART</h3>
            </div>
        </div>
    </article>

    <div class="wrap_cart">
        <div id="get_cart" class="cart_change">

            <div class="cart_btns">
                <button class="cart_btn" onclick="delCart()">CLEAR SHOPPING CART</button>
                <a href="index.php" class="cart_btn">CONTINUE SHOPPING</a>
            </div>
        </div>
        <form class="cart_form_box" action="index.php" method="POST" enctype="multipart/form-data">
            <div class="cart_form_box_left" action="cart.html" method="POST" enctype="multipart/form-data">
                <p class="cart_form_tittle">SHIPPING ADRESS</p>
                <input name="country" class="cart_form_input" required type="text" placeholder="Country">
                <input name="adress" class="cart_form_input" required type="text" placeholder="State, City, Street, Building, Apt">
                <input name="zip" class="cart_form_input" required type="text" placeholder="Postcode / Zip">
                <br>
            </div>

            <div class="checkout_box">
                <div class="sub_total">
                    <p>SUB TOTAL</p>
                    <p id="sub_total">$</p>
                </div>
                <div class="grand_total">
                    <p>GRAND TOTAL</p>
                    <p class="cart_price_pink" id="grand_total">$</p>
                </div>

                <svg class="checkout_line" width="275" height="1" viewBox="0 0 275 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M275 0H0V1H275V0Z" fill="#E2E2E2" />
                </svg>
                <input id="get_order" hidden name="order" type="text" value="empty">
                <label id="go_to_pay_label" for="go_to_pay" class="checkout_href">
                    <button id="go_to_pay" type="submit" hidden></button>
                    <p id="go_to_pay_text">PROCEED TO CHECKOUT</p>
                </label>
            </div>
        </form>
    </div>