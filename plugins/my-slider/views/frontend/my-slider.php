<link rel="stylesheet" href="<?= plugin_http_path('assets/css/style.css') ?>">

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

  <!-- Ukazatele slideru (pouze pokud chcete ukazatele podle počtu obrázků) -->
  <div class="carousel-indicators">
    <?php if(!empty($rows)): ?>
      <?php foreach($rows as $index => $row): ?>
        <?php if (!empty($row->image)): ?>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $index ?>" class="<?= $index == 0 ? 'active' : '' ?>" aria-current="true" aria-label="Slide <?= $index + 1 ?>"></button>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- Obsah slideru -->
  <div class="carousel-inner">
    <?php if(!empty($rows)): ?>
      <?php foreach($rows as $index => $row): ?>
        <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
          <a href="<?=esc($row->link)?>">
          <img src="<?= get_image($row->image) ?>" class="img-fluid" alt="<?= esc($row->caption) ?>" style="width:100%;max-width:1920px;max-height:600px;object-fit:cover;" >         
          </a>
          <div class="carousel-caption d-none d-md-block">
            <h1><?=esc($row->caption)?></h1>
            <?php if (!empty($row->description)): ?>
              <p><?=esc($row->description)?></p>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="carousel-item active">
        
      </div>
    <?php endif; ?>
  </div>
  
</div>
