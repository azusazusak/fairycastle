<header class="pageTitle">
    <div class="handle">
        <h1>Property Types</h1>
    </div>
</header>

<section>
    <div class="handle">
        <article>
            <div class="addButton">
                <a href="index.php?controller=admin&action=addType" class="btn-1">Add new type</a>
            </div>
            <table class="table">
                <tr>
                    <th class="tableHeader">ID</th>
                    <th class="tableHeader">Type</th>
                </tr>                
                <?php
                foreach ($this->state["poropertyTypes"] as $type) {
                    ?>
                    <tr>
                        <td class="tableData"><?=$type["type_id"]?></td>
                        <td class="tableData"><?=$type["type"]?></td>
                    </tr>
                    <?php
                }
                ?>                
            </table>
        </article>
    </div>
</section>