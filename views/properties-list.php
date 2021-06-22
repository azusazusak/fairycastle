        <article class="searchResult">
            <div class="propertyList">
            <?php
            if($this->state["properties"]){
                foreach ($this->state["properties"] as $property) {
                    $reviewSammary = ReviewsModel::getSummaryByProperty($property->id);
                ?>
                    <div class="propertyCard">
                        <div class="photoBox">
                            <div class="photo" data-backgroundimage="assets/<?=$property->image_1?>"></div>
                        </div>
                        <div class="textBox">
                            <h3><?=$property->name?></h3>
                            <p>Type: <?=$property->type?></p>
                            <div class="facilities">
                                <?php
                                $bedrooms = ($property->bedrooms > 1) ? "bedrooms" : "bedroom";
                                $bathrooms = ($property->bathrooms > 1) ? "bathrooms" : "bathroom";
                                ?>
                                <p><?=$property->occupancy?> guests / <?=$property->bedrooms?> <?=$bedrooms?> / <?=$property->bathrooms?> <?=$bathrooms?></p>
                            </div>
                            <div class="review">
                                <?php
                                if ($reviewSammary["aveRating"]) {
                                    ?>
                                    <p class="aveRating"><i class="fas fa-star"></i><?=$reviewSammary["aveRating"]?></p>
                                    <?php
                                }
                                if ($reviewSammary["numOfReviews"] > 1) {
                                    ?>
                                    <p class="numOfReviews">(<?=$reviewSammary["numOfReviews"]?> reviews)</p>
                                    <?php
                                } else {
                                    ?>
                                    <p class="numOfReviews">(<?=$reviewSammary["numOfReviews"]?> review)</p>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="price">
                                <p class="pricePerNight">&#036;<?=$property->pricePerNight?>/night</p>
                                <?php
                                if($this->state["stay"] > 0) {
                                    ?>
                                    <p>&#036;<?=($property->pricePerNight)*$this->state["stay"]?> total</p>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                            if(preg_match('/pages/', '/'.$_SERVER['REQUEST_URI'].'/')){
                                ?>
                                <form action="index.php?controller=pages&action=details&propertyId=<?=$property->id?>" method="post" target="_blank">
                                    <input type="hidden" name="location" value="<?=$_POST["location"]?>">
                                    <input type="hidden" name="type_id" value="<?=$_POST["type_id"]?>">
                                    <input type="hidden" name="numGuests" value="<?=$_POST["numGuests"]?>">
                                    <input type="hidden" name="checkIn" value="<?=$_POST["checkIn"]?>">
                                    <input type="hidden" name="checkOut" value="<?=$_POST["checkOut"]?>">
                                    <input type="submit" value="Show detail" class="btn-4">
                                </form>
                                <?php
                            } elseif (preg_match('/admin/', '/'.$_SERVER['REQUEST_URI'].'/')) {
                                ?>
                                <a href="index.php?controller=admin&action=details&propertyId=<?=$property->id?>" class="btn-4">Show detail</a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php
                } 
            } else {
                ?>
                <div class="nodataMsg">
                    <h3>No results found. Change the search criteria.</h3>
                </div>
                <?php               
            }
            ?>
            </div>

        </article>
    </div>
</section>

<script type="text/javascript" src="js/backgroundimage.js"></script>