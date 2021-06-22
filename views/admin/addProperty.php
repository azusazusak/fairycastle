<header class="pageTitle">
    <div class="handle">
        <h1>Add New Property</h1>
    </div>
</header>

<section>
    <div class="handle">
        <article class="addPropertyForm">
            <form method="post" action="index.php?controller=process&action=processAddProperty" enctype="multipart/form-data">
                <div class="fieldset required half">
                    <label>Property Name</label>
                    <input type="text" name="name"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset required half">
                    <label>Property type</label>
                    <select name="type_id" id="type_id">
                        <option value="">- Select -</option>
                        <?php
                        foreach($this->state["poropertyTypes"] as $type) {
                        ?>
                        <option value="<?=$type["type_id"]?>"><?=$type["type"]?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset required third">
                    <label>Occupancy</label>
                    <input type="number" min="1" step="1" name="occupancy"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>  
                </div>
                <div class="fieldset required third">
                    <label># of Bedrooms</label>
                    <input type="number" min="0" step="1" name="bedrooms"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>  
                </div>
                <div class="fieldset required third">
                    <label># of Bathrooms</label>
                    <input type="number" min="0" step="1" name="bathrooms"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>  
                </div>
                <div class="fieldset required">
                    <label>Description</label>
                    <textarea name="description"></textarea>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>  
                </div>
                <div class="fieldset required half">
                    <label>Street</label>
                    <input type="text" name="street"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset required half">
                    <label>City</label>
                    <input type="text" name="city"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset required half">
                    <label>Province</label>
                    <input type="text" name="province"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset required half">
                    <label>Country</label>
                    <input type="text" name="country"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset required half">
                    <label>Price per Night (CA&#036;)</label>
                    <input type="number" name="pricePerNight" min="0" class="noArrows"/>
                    <div class="errorMsg">
                        <p>This field is required.</p>
                    </div>
                </div>
                <div class="fieldset half"></div>
                <div class="fieldset required third">
                    <label>Wi-Fi</label>
                    <select name="wifi">
                        <option value="">- Select -</option>
                        <option value="1">Available</option>
                        <option value="0">Not available</option>
                    </select>
                    <div class="errorMsg">
                        <p>Please select one.</p>
                    </div>
                </div>
                <div class="fieldset required third">
                    <label>Kitchen</label>
                    <select name="kitchen">
                        <option value="">- Select -</option>
                        <option value="1">Available</option>
                        <option value="0">Not available</option>
                    </select>
                    <div class="errorMsg">
                        <p>Please select one.</p>
                    </div>
                </div>
                <div class="fieldset required third">
                    <label>Microwave</label>
                    <select name="microwave">
                        <option value="">- Select -</option>
                        <option value="1">Available</option>
                        <option value="0">Not available</option>
                    </select>
                    <div class="errorMsg">
                        <p>Please select one.</p>
                    </div>
                </div>
                <div class="fieldset required third">
                    <label>Refrigerator</label>
                    <select name="refrigerator">
                        <option value="">- Select -</option>
                        <option value="1">Available</option>
                        <option value="0">Not available</option>
                    </select>
                    <div class="errorMsg">
                        <p>Please select one.</p>
                    </div>
                </div>
                <div class="fieldset required third">
                    <label>Washer</label>
                    <select name="washer">
                        <option value="">- Select -</option>
                        <option value="1">Available</option>
                        <option value="0">Not available</option>
                    </select>
                    <div class="errorMsg">
                        <p>Please select one.</p>
                    </div>
                </div>
                <div class="fieldset required third">
                    <label>Dryer</label>
                    <select name="dryer">
                        <option value="">- Select -</option>
                        <option value="1">Available</option>
                        <option value="0">Not available</option>
                    </select>
                    <div class="errorMsg">
                        <p>Please select one.</p>
                    </div>
                </div>
                <div class="fieldset required third">
                    <label>Heating</label>
                    <select name="heating">
                        <option value="">- Select -</option>
                        <option value="1">Available</option>
                        <option value="0">Not available</option>
                    </select>
                    <div class="errorMsg">
                        <p>Please select one.</p>
                    </div>
                </div>
                <div class="fieldset required third">
                    <label>TV</label>
                    <select name="tv">
                        <option value="">- Select -</option>
                        <option value="1">Available</option>
                        <option value="0">Not available</option>
                    </select>
                    <div class="errorMsg">
                        <p>Please select one.</p>
                    </div>
                </div>
                <div class="fieldset required third">
                    <label>Parking</label>
                    <select name="parking">
                        <option value="">- Select -</option>
                        <option value="1">Available</option>
                        <option value="0">Not available</option>
                    </select>
                    <div class="errorMsg">
                        <p>Please select one.</p>
                    </div>
                </div>
                <?php
                if(isset($_GET["formatError"])){
                    ?>
                    <div class="fieldset alertMsg" id="formatError">
                        <p>ERROR: File format must be JPEG, GIF, or PNG.</p>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="fieldset alertMsg">
                        <p>File format must be JPEG, GIF, or PNG.</p>
                    </div>
                    <?php                    
                }
                ?>
                <div class="fieldset half">
                    <label>Image 01</label>
                    <div class="chooseFileConteiner">
                        <input type="file" name="image_1"/>
                    </div>
                </div>
                <div class="fieldset half">
                    <label>Image 02</label>
                    <div class="chooseFileConteiner">
                        <input type="file" name="image_2"/>
                    </div>
                </div>
                <div class="fieldset half">
                    <label>Image 03</label>
                    <div class="chooseFileConteiner">
                        <input type="file" name="image_3"/>
                    </div>
                </div>
                <div class="fieldset half">
                    <label>Image 04</label>
                    <div class="chooseFileConteiner">
                        <input type="file" name="image_4"/>
                    </div>
                </div>
                <div class="fieldset half">
                    <label>Image 05</label>
                    <div class="chooseFileConteiner">
                        <input type="file" name="image_5"/>
                    </div>
                </div>
                <div class="fieldset submit">
                    <input type="submit" value="Register" class="btn-1"/>
                </div>         
            </form>
        </article>
    </div>
</section>

<script type="text/javascript" src="js/form_validator.js"></script>