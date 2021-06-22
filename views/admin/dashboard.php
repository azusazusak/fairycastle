<header class="pageTitle">
    <div class="handle">
        <h1>Reservation List</h1>
    </div>
</header>

<section>

    <div class="handle">
        <article class="reservationList">
            <div class="searchForm">
                <div class="heading">
                    <h3>Search by</h3>
                </div>
                <form action="index.php?controller=admin&action=dashboard" method="post">
                    <div class="fieldset third">
                        <label>Reservation ID</label>
                        <input type="number" name="orderId" value="<?=isset($_POST["orderId"]) ? $_POST["orderId"] : ''?>" min="1" step="1" class="noArrows">
                    </div>
                    <div class="fieldset third">
                        <label>Email Address</label>
                        <input type="email"name="email" value="<?=isset($_POST["email"]) ? $_POST["email"] : ''?>">
                    </div>
                    <div class="fieldset submit third">
                        <input type="submit" value="Search" class="btn-1">
                    </div>
                </form>
            </div>                            
            <?php
            if($this->state["reservations"]){
                ?>
                <div class="instruction">
                    <h3>To validate the reservation, click on the Approve button.</h3>
                </div>                
                <div class="listTable">
                    <table class="table">
                        <tr>
                            <th class="tableHeader">Status</th>
                            <th class="tableHeader">ID</th>
                            <th class="tableHeader">Email</th>
                            <th class="tableHeader">Username</th>
                            <th class="tableHeader">Property Name</th>
                            <th class="tableHeader">Check-in</th>
                            <th class="tableHeader">Check-out</th>
                            <th class="tableHeader">Guests</th>
                            <th class="tableHeader cutText">Note</th>
                            <th class="tableHeader">Price/night</th>
                            <th class="tableHeader">Nights</th>
                            <th class="tableHeader">Total Price</th>
                            <th class="tableHeader">Date</th>
                        </tr>
                        <?php
                        foreach ($this->state["reservations"] as $reservation) {
                            ?>
                            <tr>
                                <?php
                                if($reservation->status_id == 2){
                                    ?>
                                    <td class="tableData colored">Approved</td>
                                    <?php
                                } else {
                                    ?>
                                    <td class="tableData"><a href="index.php?controller=process&action=processApproval&reservationId=<?=$reservation->id?>" class="btn-3">Approve</a></td>
                                    <?php
                                }
                                ?>                                
                                <td class="tableData"><?=$reservation->id?></td>
                                <td class="tableData"><?=$reservation->email?></td>
                                <td class="tableData"><?=$reservation->username?></td>
                                <td class="tableData"><?=$reservation->propertyName?></td>
                                <td class="tableData"><?=$reservation->checkIn?></td>
                                <td class="tableData"><?=$reservation->checkOut?></td>
                                <td class="tableData"><?=$reservation->numGuests?></td>
                                <td class="tableData cutText"><?=$reservation->note?></td>
                                <td class="tableData">&#036;<?=$reservation->pricePerNight?></td>
                                <td class="tableData"><?=$reservation->numOfNights?></td>
                                <td class="tableData">&#036;<?=$reservation->totalPrice?></td>
                                <td class="tableData"><?=$reservation->creationDate?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <?php
            } else {
                ?>
                <h2>No Data Found</h2>
                <?php
            }            
            ?>            
        </article>
    </div>

</section>

