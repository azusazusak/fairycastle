<header class="pageTitle">
    <div class="handle">
        <h1>Hello <?=$this->state["loggedUser"]["firstName"]?>!</h1>
        <a href="index.php?controller=process&action=processLogout"><i class="fas fa-sign-out-alt"></i></a>
    </div>
</header>

<section>
    <div class="handle">

    <article class="accountInfo">
        <div class="header">
            <h2>Account Info</h2>
        </div>
        <div class="information">
            <div class="container">
                <p class="bold">Email:</p>
                <p><?=$this->state["loggedUser"]["email"]?></p>                
            </div>
            <div class="container">
                <p class="bold">Username:</p>
                <p><?=$this->state["loggedUser"]["username"]?></p>
            </div>
            <div class="container">
                <p class="bold">First Name:</p>
                <p><?=$this->state["loggedUser"]["firstName"]?></p>                
            </div>
            <div class="container">
                <p class="bold">Last Name:</p>
                <p><?=$this->state["loggedUser"]["lastName"]?></p>                
            </div>
        </div>
    </article>

    <article class="bookings">
        <div class="header">
            <h2>Bookings</h2>
        </div>
        <div class="bookingList">
        <?php
        foreach ($this->state["reservations"] as $reservation) {
            $review = ReviewModel::getOneByReservation($reservation->id);
            ?>
            <div class="bookingCard">
                <h3><?=$reservation->propertyName?></h3>
                <?php
                $image_1 = PropertyModel::getOneImage($reservation->property_id);
                ?>
                <div class="photo" data-backgroundimage="assets/<?=$image_1["image_1"]?>"></div>
                <div class="details">
                    <div class="container">
                        <div class="date">
                            <p class="bold">Check-in:</p>
                            <p><?=$reservation->checkIn?></p>                    
                        </div>
                        <div class="date">
                            <p class="bold">Check-out:</p>
                            <p><?=$reservation->checkOut?></p>
                        </div>
                        <div class="guests">
                            <p class="bold">Guests:</p>
                            <p><?=$reservation->numGuests?></p>
                        </div>
                        <div class="price">
                            <p class="bold">Price per night:</p>
                            <p>&#036;<?=$reservation->pricePerNight?></p>
                        </div>
                        <div class="price">
                            <p class="bold">Total price:</p>
                            <p>&#036;<?=$reservation->totalPrice?></p>
                        </div>           
                    </div>
                    
                    <?php
                    if($reservation->note){
                        ?>
                        <div class="container">
                            <div class="note">
                                <p class="bold">Note:</p>
                                <p><?=$reservation->note?></p>
                            </div>                    
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <?php
                if($review->rating){
                    ?>
                    <h4>Your Review</h4>
                    <p class="star"><i class="fas fa-star"></i><?=$review->rating?></p>
                    <p><?=$review->comment?></p>
                    <?php

                } else {
                    ?>
                    <a href="index.php?controller=pages&action=writeReview&reservationId=<?=$reservation->id?>" class="btn-1">Write Review</a>
                    <?php
                }
                ?>
            </div>
            <?php
        }      
        ?>
        </div>
    </article>

    </div>
</section>

<script type="text/javascript" src="js/backgroundimage.js"></script>