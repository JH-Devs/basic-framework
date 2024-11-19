<link rel="stylesheet" href="<?=plugin_http_path('assets/css/style.css')?>">
    <div class="row col-md-10 p-4 mx-auto shadow" >                   
        <h1 class="p-0"><?=esc($row->title)?></h1>
        <?php if($row->display_featured_image): ?>
        <label class="text-center">
            <img src="<?= get_image($row->image) ?>" 
                    style="width:100%;max-height:300px;object-fit:cover;" />
        </label>
            <?php endif?>
            
            <div class="d-block">

            <div class="d-flex text-secondary pt-2 pb-3" style="font-size:14px;">
            <small><i class="fa-solid fa-calendar-days mx-2"></i><?=get_date($row->date_created)?></small>
            <small><i class="fa-solid fa-user mx-2"></i>
            <?php if(!empty($row->user_row)):?>
                        <?=$row->user_row->first_name?> 
                    <?php else:?>	
                      <?='Unknown'?>
                    <?php endif?>	
            </small>
             <!--TODO: vyřešit vypisování počtu shlédnutí-->
            <small><i class="fa-solid fa-eye mx-2"></i>58</small>

            </div>
            <?=($row->content)?>

            <div class="">
                <b>Keywords: </b><?=($row->keywords)?>
            </div>
            <div class="d-flex text-secondary pt-2 pb-3" style="font-size:18px;">
                  <!--TODO: vyřešit vypisování lajků-->
            <small><i class="fa-solid fa-thumbs-up mx--2 text-success"></i>108</small>
                   <!--TODO: vyřešit vypisování dislajků-->
                   <small><i class="fa-solid fa-thumbs-down mx-2"></i>2</small>
              <!--TODO: vyřešit vypisování komentářu-->
              <small><i class="fa-solid fa-comments mx-2"></i>28</small>
            </div>

            <!--TODO: vyřešit komentáře-->
            <div class="col-md-12 bootstrap snippets">
                <div class="panel">
                    <div class="panel-body">
                        <textarea class="form-control" rows="2" placeholder="What are you thinking?"></textarea>
                    <div class="mar-top clearfix">
                    <i class="fa-solid fa-video text-secondary mx-2" style="cursor:pointer;" id="icon">
                    </i>
                    <i class="fa-solid fa-camera text-secondary mx-2" style="cursor:pointer;" id="icon">
                    <input type="file" name="" class="d-none" id="file-input">
                    </i>

                    <i class="fa-solid fa-file text-secondary mx-2" style="cursor:pointer;" id="icon">
                    <input type="file" name="" class="d-none" id="file-input">
                    </i>
                        <button class="btn btn-sm btn-info text-light float-end" type="submit"><i class="fa fa-pencil fa-fw" ></i> Comment</button>
                        
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                <!-- Newsfeed Content -->
                <!--===================================================-->
                <div class="media-block">
                <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar1.png"></a>
                <div class="media-body">
                    <div class="mar-btm mx-2">
                    <a href="#" class="btn-link text-semibold media-heading box-inline">Lisa D.</a>
                    <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i> - From Mobile - 11 min ago</p>
                    </div>
                    <p>consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                    <div class="pad-ver">
                    <div class="btn-group">
                        <a class="btn btn-sm btn-default btn-hover-success" href="#"><i class="fa fa-thumbs-up"></i></a>
                        <a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>
                    </div>
                    <a class="btn btn-sm btn-default btn-hover-primary" href="#">Comment</a>
                    </div>
                    <hr>

                    <!-- Comments -->
                    <div>
                    <div class="media-block">
                        <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar2.png"></a>
                        <div class="media-body">
                        <div class="mar-btm mx-2">
                            <a href="#" class="btn-link text-semibold media-heading box-inline">Bobby Marz</a>
                            <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i> - From Mobile - 7 min ago</p>
                        </div>
                        <p>Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                        <div class="pad-ver">
                            <div class="btn-group">
                            <a class="btn btn-sm btn-default btn-hover-success active" href="#"><i class="fa fa-thumbs-up"></i> You Like it</a>
                            <a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>
                            </div>
                            <a class="btn btn-sm btn-default btn-hover-primary" href="#">Comment</a>
                        </div>
                        <hr>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="media-block pad-all">
        <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar1.png"></a>
        <div class="media-body">
            <div class="mar-btm mx-2">
             <a href="#" class="btn-link text-semibold media-heading box-inline">John Doe</a>
            <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i> - From Mobile - 11 min ago</p>
            </div>
            <p>Lorem ipsum dolor sit amet.</p>
            <img class="img-responsive thumbnail mb-2" src="https://www.bootdey.com/image/250x250" alt="Image">
            <div class="pad-ver">
            <span class="tag tag-sm"><i class="fa fa-heart text-danger"></i> 250 Likes</span>
            <div class="btn-group">
                <a class="btn btn-sm btn-default btn-hover-success" href="#"><i class="fa fa-thumbs-up"></i></a>
                <a class="btn btn-sm btn-default btn-hover-danger" href="#"><i class="fa fa-thumbs-down"></i></a>
            </div>
            <a class="btn btn-sm btn-default btn-hover-primary" href="#">Comment</a>
            </div>
            <hr>
                </div>
            </div>
            </div>
        </div>
    </div>

            <!--TODO: sem přidat třeba komentáře nebo fotky nebo obojí + like a share--->
            
            </div>
    </div>
<script src="<?=plugin_http_path('assets/js/plugin.js')?>"></script>

<script>
    // Vyhledání ikony a inputu
    document.getElementById('icon').addEventListener('click', function() {
        // Vyvolání kliknutí na skrytý input při kliknutí na ikonu
        document.getElementById('file-input').click();
    });
</script>