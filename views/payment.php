<header class="pageTitle">
    <div class="handle">
        <h1>Payment</h1>
    </div>
</header>

<section>
    <div class="handle">
        <div class="container">

            <article class="tripDetails">
                <div class="heading">
                    <h2>Your Trip</h2>
                </div>
                <div class="propertyInfo">
                    <h3><?=$this->state["property"]->name?></h3>
                    <div class="date">
                        <div class="checkDate">
                            <p>Check-in</p>
                            <p class="bold"><span><?=$_POST["checkIn"]?></span></p>
                        </div>
                        <div class="checkDate">
                            <p>Check-out</p>
                            <p class="bold"><span><?=$_POST["checkOut"]?></span></p>
                        </div>                      
                    </div>
                    <div class="guests">
                        <p>Guests</p>
                        <p class="bold"><span><?=$_POST["numGuests"]?></span> people</p>
                    </div>
                </div>
                <div class="priceDetail">
                    <table>
                        <tr>
                            <?php
                            if($this->state["stay"] > 1){
                                ?>
                                <td class="item">&#036;<?=$this->state["property"]->pricePerNight?> X <?=$this->state["stay"]?> nights</td>
                                <?php
                            } else {
                                ?>
                                <td class="item">&#036;<?=$this->state["property"]->pricePerNight?> X <?=$this->state["stay"]?> night</td>
                                <?php                                
                            }
                            ?>                            
                            <td class="price">&#036;<?=($this->state["property"]->pricePerNight)*$this->state["stay"]?></td>
                        </tr>
                        <tr class="line">
                            <td>Service fee</td>
                            <td class="price">&#036; 0</td>
                        </tr>
                        <tr class="total">
                            <td class="item">Total</td>
                            <td class="price">&#036;<?=($this->state["property"]->pricePerNight)*$this->state["stay"]?></td>
                        </tr>
                    </table>
                </div>
            </article>

            <article class="paymentDatails">
                <div class="heading">
                    <h2>Enter your details</h2>
                </div>
                <div class="searchForm">
                    <form action="index.php?controller=pages&action=thankyou" method="post">
                        <input type="hidden" name="userId" value="<?=$this->state["loggedUser"]["id"]?>">
                        <input type="hidden" name="email" value="<?=$this->state["loggedUser"]["email"]?>">
                        <input type="hidden" name="username" value="<?=$this->state["loggedUser"]["username"]?>">
                        <input type="hidden" name="firstName" value="<?=$this->state["loggedUser"]["firstName"]?>">
                        <input type="hidden" name="lastName" value="<?=$this->state["loggedUser"]["lastName"]?>">
                        <input type="hidden" name="propertyId" value="<?=$this->state["property"]->id?>">
                        <input type="hidden" name="propertyName" value="<?=$this->state["property"]->name?>">
                        <input type="hidden" name="checkIn" value="<?=$_POST["checkIn"]?>">
                        <input type="hidden" name="checkOut" value="<?=$_POST["checkOut"]?>">
                        <input type="hidden" name="numGuests" value="<?=$_POST["numGuests"]?>">
                        <input type="hidden" name="pricePerNight" value="<?=$this->state["property"]->pricePerNight?>">
                        <input type="hidden" name="numOfNights" value="<?=$this->state["stay"]?>">
                        <input type="hidden" name="totalPrice" value="<?=($this->state["property"]->pricePerNight)*$this->state["stay"]?>">
                        <?php
                            date_default_timezone_set('America/Vancouver');
                            $today = date('Y-m-d');
                        ?>  
                        <input type="hidden" name="creationDate" value="<?=$today?>">
                        
                        <div class="fieldset payWith">
                            <h3>Pay with</h3>
                        </div>                        
                        <div class="fieldset required half">
                            <label>Credit card number</label>
                            <input type="text" name="cardNumber" id="cardNumber" value=""/>
                            <div class="errorMsg">
                                <p>This field is required.</p>
                            </div>
                        </div>
                        <div class="fieldset required half">
                            <label>Card holder name</label>
                            <input type="text" name="cardholderName" id="cardholderName" value=""/>
                            <div class="errorMsg">
                                <p>This field is required.</p>
                            </div>
                        </div>
                        <div class="fieldset required half">
                            <label>Expiration date (MM/YY)</label>
                            <input type="text" name="expirationDate" id="expirationDate" value=""/>
                            <div class="errorMsg">
                                <p>This field is required.</p>
                            </div>
                        </div>
                        <div class="fieldset required half">
                            <label>CVC</label>
                            <input type="text" name="cvc" id="cvc" value=""/>
                            <div class="errorMsg">
                                <p>This field is required.</p>
                            </div>
                        </div>
                        <div class="fieldset spacial">
                            <label>Special Requests</label>
                            <p>Please write your requests. Special requests cannot be guaranteed but the property will do its best to meet your needs.</p>
                            <textarea name="note"></textarea>
                        </div>
                        <div class="fieldset submit">
                            <input type="submit" value="Reserve" class="btn-1">
                        </div><!-- fieldset -->
                    
                    </form>
                </div>

            </article>

        </div>
    </div>

</section>

<script type="text/javascript" src="js/form_validator.js"></script>