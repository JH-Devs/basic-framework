<link rel="stylesheet" href="<?=ROOT?>/assets/css/custom.css">
<nav>
    <div class="wrapper z-3">
        <div class="logo"><a href="<?=ROOT?>"><?=APP_NAME?> </a></div>
        <input type="radio" name="slider" id="menu-btn">
        <input type="radio" name="slider" id="close-btn">
        <ul class="menu-nav-links">
            <label for="close-btn" class="btn close-btn"><i class="fas fa-times"></i></label>
            <?php $links = $data['links'] ?>
            <?php if (!empty($links)): ?>

                <?php 
                // order links
                usort($links, function($a, $b) {
                    $a = $a->list_order ?? 10;
                    $b = $b->list_order ?? 10;

                    if ($a == $b) return 0;
                    return $a > $b ? 1 : -1;
                });
                ?>

                <?php 
                // Získání aktuální URL (bez domény a cesty)
                $current_url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'); 
                // Odstranění prefixu '/Basic-framework' z aktuální URL
                $current_url = str_replace('Basic-framework/', '', $current_url);
                ?>

                <?php foreach ($links as $link): ?>
                    <?php if(user_can($link->permission)): ?>
                        <?php 
                        // Získání URL odkazu (bez domény) pro porovnání
                        $link_url = trim($link->slug, '/'); // Odstranění nepotřebných lomítek
                        $is_active = ($current_url == $link_url) ? 'active' : ''; // kontrola aktivního odkazu
                        ?>
                        <li>
                            <a class="<?= !empty($link->children) ? 'desktop-item' : '' ?> mx-2 <?= $is_active ?>" href="<?=ROOT?>/<?=$link->slug?>">
                                <i class="<?= $link->icon ?> mx-2"></i>

                                <?php if (!empty($link->show_image) || (!empty($link->image) && file_exists($link->image))) : ?>
                                    <img src="<?=get_image($link->image)?>" class="rounded-circle" style="width:30px;height:30px;object-fit:cover;"/>
                                <?php endif ?>
                                <?= (ucfirst($link->title)) ?>
                            </a>

                            <?php if(!empty($link->children) && empty($link->is_mega)): ?>
                                <input type="checkbox" id="showDrop<?=$link->id?>" class="showDrop">
                                <label for="showDrop<?=$link->id?>" class="mobile-item showDrop"><?=ucfirst($link->title)?></label>
                                <ul class="drop-menu">
                                    <?php foreach($link->children as $child): ?>
                                        <li><a href="<?=ROOT?>/<?=$child->slug?>"><i class="<?= $child->icon ?> p-0"></i><?=ucfirst($child->title)?></a></li>
                                    <?php endforeach ?>
                                </ul>
                            <?php elseif(!empty($link->children) && !empty($link->is_mega)): ?>
                                <input type="checkbox" id="showMega<?=$link->id?>" class="showMega">
                                <label for="showMega<?=$link->id?>" class="mobile-item shopMega">
                                    <?php if (!empty($link->image) && file_exists($link->image)) : ?>
                                        <img src="<?=get_image($link->image)?>" class="rounded-circle" style="width:30px;height:30px;object-fit:cover;"/>
                                    <?php endif ?>
                                    <?=ucfirst($link->title)?>
                                </label>
                                <div class="mega-box">
                                    <div class="content">
                                        <div class="row">
                                            <?php if(!empty($link->mega_image) && file_exists($link->mega_image)) : ?>
                                                <img src="<?=get_image($image->get_thumbnail($link->mega_image,240,240, true))?>" alt="">
                                            <?php endif ?> 
                                        </div>

                                        <?php foreach($link->children as $child): ?>
                                            <div class="row">
                                                <header><?=ucfirst($child->title)?></header>

                                                <?php if(!empty($child->grandchildren)) : ?>
                                                    <ul class="mega-links">
                                                        <?php foreach($child->grandchildren as $grandchild): ?>
                                                            <li><a href="<?=ROOT?>/<?=$grandchild->slug?>"><?=ucfirst($grandchild->title)?></a></li>
                                                        <?php endforeach ?> 
                                                    </ul>
                                                <?php endif ?> 

                                            </div>
                                        <?php endforeach ?> 

                                    </div>
                                </div> 
                            <?php endif ?>    
                        </li>
                    <?php endif ?>
                <?php endforeach ?>
            <?php endif ?>       
        </ul>
        <label for="menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
    </div>
</nav>
