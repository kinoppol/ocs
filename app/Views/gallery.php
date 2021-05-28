<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header"><?php
                           print $galleryName;
                        ?>
                        </div>
                        <div class="body">
                                        <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                            <?php
                                foreach($pictures as $pic){
                                    ?>
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                <a href="<?php print $pic['url']; ?>" data-sub-html="Demo Description">
                                                    <img class="img-responsive thumbnail" src="<?php print $pic['url']; ?>">
                                                </a>
                                            </div>
                                    <?php
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
</div>