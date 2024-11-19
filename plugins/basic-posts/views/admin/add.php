<?php if (user_can('add_post')): ?>
<form onsubmit="page.submit(event)" method="post" enctype="multipart/form-data">

    <div class="row g-3  shadow rounded p-3 mt-3">

    <?=csrf()?>

        <h4 id="add_record">Add Post</h4>
        <div class="row">
            <label class="text-center  mb-3 col-md-3">
                <img src="<?=get_image('')?>" class="img-thumbnail" style="cursor:pointer;width:100%;max-width:600px;max-height:400px;object-fit:cover;"/>
                <input onchange="display_image(event)" type="file" name="image" class="d-none">

                <?php if (!empty($errors['image'])): ?>
                    <small class="text-danger px-2"><?= $errors['image'] ?></small>
                <?php endif ?>
            </label>
            <?php $errors = get_value('errors') ?? [];?>

        <div class="col-md-9">
            <div class="mb-3 col-md-12">
                <label for="title" class="form-label">Title</label>
                <input value="<?= old_value('title') ?>" type="text" class="form-control" name="title" id="title" >

                <?php if (!empty($errors['title'])): ?>
                    <small class="text-danger px-2"><?= $errors['title'] ?></small>
                <?php endif ?>
            </div>

            <div class="mb-3 col-md-12">
                <label for="slug" class="form-label">Slug</label>
                <input value="<?=old_value('slug')?>" type="text" class="form-control" name="slug" id="slug">

                <?php if (!empty($errors['slug'])): ?>
                <small class="text-danger px-2"><?= $errors['slug'] ?></small>
            <?php endif ?>
            </div>

            <div class="mb-3 col-md-12">
                <label for="keywords" class="form-label">Keywords</label>
                <input value="<?=old_value('keywords')?>" type="text" class="form-control" name="keywords" id="keywords">
                
                <?php if (!empty($errors['keywords'])): ?>
            <small class="text-danger px-2"><?= $errors['keywords'] ?></small>
        <?php endif ?>
            </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="content" class="form-label">Display Featured Image</label>
                <select name="display_featured_image" class="form-select">
                    <option <?=old_select('display_featured_image','1')?> value="1">Yes</option>
                    <option <?=old_select('display_featured_image','0')?> value="0">No</option>
                </select>
            </div>
                        
            <div class="mb-2 col-md-6">
                <label for="active" class="form-label">Public</label>
                <select class="form-select" name="disabled">
                    <option <?= old_select('disabled', '0') ?>  value="0"><?= esc('Yes') ?></option>
                    <option <?= old_select('disabled', '1') ?> value="1"><?= esc('No') ?></option>
                </select>
            </div>
        </div> 

    </div>
</div>
        <div class="mb-3 col-md-12">
            <label for="slug" class="form-label">Content</label>
            <textarea rows="20" name="content" id="content" class=" summernote form-control"><?=old_value('content')?></textarea>

            <?php if (!empty($errors['content'])): ?>
            <small class="text-danger px-2"><?= $errors['content'] ?></small>
        <?php endif ?>
        </div>


		<div class="mb-3 col-md-12 ">
                <label for="categories" class="form-label" >Categories</label>
                <div class="row g-2 border p-2 form-control">
				<?php 
					$query = "select * from categories where disabled = 0";
					$categories = $post->query($query); 
				?>

				<?php if(!empty($categories)):$num = 0?>
					<?php foreach($categories as $category):$num++?>
						<div class="form-check col-md-6">
						  <input name="category[]" class="form-check-input" type="checkbox" value="<?=$category->id?>" id="check<?=$num?>">
						  <label class="form-check-label" for="check<?=$num?>" style="cursor:pointer;">
						    <?=esc(str_replace("_", " ", $category->category))?>
						  </label>
						</div>
					<?php endforeach?>
				<?php endif?>
                </div>
            </div>

        <!-- zde možnost přidání dalšího obsahu, jako např obrázky, atributy, atd. -->

        <span class="border-bottom col-md-12 border-5"></span>

		<div class="mb-3 col-md-12">
			<label for="seo_title" class="form-label">Title (SEO)</label>
			    <input name="seo_title" value="<?=old_value('seo_title')?>" type="text" class="form-control" id="seo_title">
					
			<?php if(!empty($errors['keywords'])):?>
					  <small class="text-danger"><?=$errors['keywords']?></small>
			<?php endif?>
		</div>

        <div class="mb-3 col-md-12">
			<label for="seo_description" class="form-label">Description (SEO)</label>
            <textarea rows="3" name="seo_description" id="seo_description" class="form-control"><?=old_value('seo_description')?></textarea>

					
			<?php if(!empty($errors['seo_description'])):?>
					  <small class="text-danger"><?=$errors['seo_description']?></small>
			<?php endif?>
		</div>
    
        <div class="row mb-2">
            <div class="progress my-1 d-none">
                <div class="progress-bar col-md-12" style="width:0%;">0%</div>
            </div>
        </div>


        <div class="mb-3 col-md-6">
            <a href="<?=ROOT?>/<?=$admin_route?>/<?=$plugin_route?>">
                <button type="button" class="btn btn-secondary text-light"><i class="fa-solid fa-angles-left"></i> <span id="back"> Back</span></button>
                </a>
            </div>
        <div class="mb-3 col-md-6">
                <button type="submit" class="btn btn-lime text-light float-end"><span id="save">Save </span> <i class="fa-solid fa-save"></i></button>
        </div>
    </div>
</form>

<script type="text/javascript">

		var valid_image = true;
		var image_added = false;
		function display_image(e)
		{
			let allowed = ['image/jpeg','image/png','image/webp'];
			let file = e.currentTarget.files[0];

			if(!allowed.includes(file.type)){
				alert("Only files of this type allowed: " + allowed.toString().replaceAll('image/',''));
				valid_image = false;
				image_added = false;
				return;
			}
			valid_image = true;
			image_added = true;
			e.currentTarget.parentNode.querySelector('img').src = URL.createObjectURL(file);
		}

		function submit_form(e)
		{
			if(!valid_image)
			{
				e.preventDefault()
				alert("Please add a valid image");
				return;
			}
		}


		const page = {

			uploading: false,

			submit: function(e)
			{
				e.preventDefault();

				if(page.uploading){
					alert("Please wait while we upload");
					return;
				}

				let inputs = e.currentTarget.querySelectorAll("input,select,textarea");

 				document.querySelector('.progress').style.width = '0%';
 				document.querySelector('.progress').innerHTML = 'Saving...' + '0%';
 				document.querySelector('.progress').classList.remove('d-none');

				let myform = new FormData();
				for (var i = 0; i < inputs.length; i++) {

					if(inputs[i].type == 'file'){
						if(image_added)
							myform.append(inputs[i].name,inputs[i].files[0]);
					}else if(inputs[i].type == 'checkbox' || inputs[i].type == 'radio'){
						if(inputs[i].checked)
							myform.append(inputs[i].name,inputs[i].value);
					}else{

						if(inputs[i].name == 'title' && inputs[i].value.trim() == ''){

							alert("A title is required!");
							return;
						}
						myform.append(inputs[i].name,inputs[i].value);
					}
				}

				page.uploading = true;
				let xhr = new XMLHttpRequest();

				xhr.addEventListener('readystatechange',function(e){

					if(xhr.readyState == 4)
					{
						page.uploading = false;

						if(xhr.status == 200)
						{
							page.handleResult(xhr.responseText);
						}
					}
				});

				xhr.upload.addEventListener('progress',function(e){

					let percent = Math.round((e.loaded / e.total) * 100);
					let prog = document.querySelector('.progress-bar');
					prog.style.width = percent + '%';
					prog.innerHTML = 'Saving...' + percent + '%';
				});
 
				xhr.open('post','',true);
				xhr.send(myform);
			},

			handleResult: function(result)
			{
				let obj = JSON.parse(result);
				if(typeof obj == 'object')
				{
					//alert(obj.message);
					if(obj.success)
					{
						window.location.href = '<?=ROOT?>/<?=$vars['admin_route']?>/<?=$vars['plugin_route']?>';
					}else{
						for(key in obj.errors)
						{
							alert(obj.errors[key]);
						}
					}
				}else{
					console.log(result);
				}
			},
 
		}
	</script>
	<script src="<?=plugin_http_path('/assets/js/jquery-3.7.1.min.js')?>"></script>
	<!-- include summernote css/js --path: path: path: path: -->
	<link href="<?=plugin_http_path('summernote-0.8.18-dist/summernote-lite.min.css')?>" rel="stylesheet">
	<script src="<?=plugin_http_path('summernote-0.8.18-dist/summernote-lite.min.js')?>"></script>
	
	<!-- include summernote-en-US If I want this in English, I don't need to add it now. I'm storing it here for when framework translations into other languages are needed. Translations need to be fine-tuned, as not everything has been translated. -->
	<script src="<?=plugin_http_path('lang/summernote-en-US.js')?>"></script>
	<script>
		window.addEventListener('load', function(){

			$(document).ready(function() {
				$('.summernote').summernote({
					tabsize: 2,
        			height: 400,
					lang: 'en-US', // change language
					toolbar: [
					['style', ['bold', 'italic', 'underline', 'clear']],
					['font', ['strikethrough', 'superscript', 'subscript']],
					['fontsize', ['fontsize']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['height', ['height']],
					['insert', ['link', 'picture', 'video']],
					['view', ['codeview']]  // Přidá režim kódu
				],
				codeviewFilter: false, // Vypne escapování HTML
				codeviewIframeFilter: true // Volitelně povolí sandbox iframe pro bezpečnost
				});
			});
		});
  </script>

<?php else: ?>

<div class="alert alert-danger text-center">
    Access denied. You dont have permission for this action
</div>

<?php endif ?>