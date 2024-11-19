
  <!-- Section: Links -->
    <section>
   <!-- Grid row -->
   <div class="row">
      <?php if (!empty($links)): ?>
      
        <?php 
        // Seřazení hlavních odkazů podle pořadí
        usort($links, callback: function($a, $b) {
            $a_order = $a->list_order ?? 10;
            $b_order = $b->list_order ?? 10;
            return $a_order <=> $b_order;
        });
        ?>

        <!-- Výpis hlavních odkazů a jejich sub odkazů -->
        <?php foreach ($links as $link): ?>
          <?php if (user_can($link->permission)): ?>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
              <h5>
                <a href="<?=ROOT?>/<?=$link->slug?>">
                  <i class="<?= $link->icon ?> mx-2"></i>
                  <?= ucfirst($link->title) ?>
                </a>
              </h5>

              <?php if (!empty($link->children)): ?>
                <ul class="list-unstyled mb-0">
                  <?php foreach ($link->children as $child): ?>
                    <?php if (user_can($child->permission)): ?>
                      <li style="line-height:30px;">

                      <?php
                            $href = $link->list_order == 999 ? '#' : ROOT . '/' . htmlspecialchars($link->slug, ENT_QUOTES, 'UTF-8');
                        ?>
                        <a class="text-body" href="<?=ROOT?>/<?=$child->slug?>" class="<?= $link->list_order == 999 ? 'disabled-link' : '' ?>">

                        <?php if (!empty($link->show_image) || (!empty($child->image) && file_exists($child->image))) :?>
                            <img src="<?=get_image($child->image)?>" class="rounded-circle" style="width:20px;height:20px;object-fit:cover;"/>
                            <?php endif?>
                          
                          <i class="<?= $child->icon ?> mx-2"></i>
                          <?= ucfirst($child->title) ?>
                        </a>
                      </li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
    <!-- Grid row -->
    </section>
    <!-- Section: Links -->
    </div>
  <!-- Grid container -->

</footer>