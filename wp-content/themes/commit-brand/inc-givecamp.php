<?php
/**
 * custom code for the small C2C info on the home page
 */
?>



<div class="c2c-accordion c2c-item">
    <ul>
        <li>
            
                <a id="a1" href="<?php the_field('button_1_url'); ?>">
                    <div class="c2c-business-card">
                        <div class="c2c-div-left early-years-card">
                            <img src="<?php the_field('image1'); ?>" alt="" />
                            <h3><?php the_field('title1'); ?></h3>
                            <p><?php the_field('description1'); ?></p>
                        </div>

                        <div class="c2c-div-right">
                            <div class="div-right-inner">
                                <div class="c2c-content-container">
                                <?php the_field('content1'); ?>

                                </div>
                                <div class="c2c-button-container">
                                    <input class="button" value="<?php the_field('button_1_text'); ?>" />
                                </div>

                                <div class="c2c-right-arrow"></div>
                            </div>
                        </div>
                    </div>
                </a>
             
        </li>
        <li>
            <a href="<?php the_field('button_2_url'); ?>">
                <div class="c2c-business-card">
                    <div class="c2c-div-left middle-years-card">
                        <img src="<?php the_field('image2'); ?>" alt="" />
                        <h3><?php the_field('title2'); ?></h3>
                        <p><?php the_field('description2'); ?></p>
                    </div>

                    <div class="c2c-div-right">
                        <div class="div-right-inner">
                            <div class="c2c-content-container">
                                <?php the_field('content2'); ?>
                            </div>
                            <div class="c2c-button-container">
                                <input class="button" value="<?php the_field('button_2_text'); ?>" />
                            </div>
                        
                            <div class="c2c-right-arrow"></div>
                        </div>
                    </div>

                </div>
            </a>
        </li>
        <li>
            <a href="<?php the_field('button_3_url'); ?>">
                <div class="c2c-business-card">
                    <div class="c2c-div-left late-years-card">
                        <img src="<?php the_field('image3'); ?>" alt="" />
                        <h3><?php the_field('title3'); ?></h3>
                        <p><?php the_field('description3'); ?></p>
                    </div>

                    <div class="c2c-div-right">
                        <div class="div-right-inner">
                            <div class="c2c-content-container">
                                <?php the_field('content3'); ?>
                            </div>
                            <div class="c2c-button-container">
                                <input class="button" value="<?php the_field('button_3_text'); ?>" />
                            </div>
                        
                            <div class="c2c-right-arrow"></div>
                        </div>
                    </div>
                </div>
            </a>                
        </li>        
    </ul>
</div>


<script type="text/javascript" >
    $(document).ready(function () {
        lastBlock = $("#a1");
        maxWidth = 610;
        minWidth = 230;

        $("ul li a").hover(
        function () {
            $(lastBlock).animate({ width: minWidth + "px" }, { queue: false, duration: 750 });
            $(this).animate({ width: maxWidth + "px" }, { queue: false, duration: 750 });
            lastBlock = this;

            $(this).find('.c2c-div-right').fadeIn();
            $(this).parent().siblings().find('.c2c-div-right').fadeOut();

        });
    });
</script>

