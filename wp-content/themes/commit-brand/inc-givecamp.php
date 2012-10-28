<?php
/**
 * custom code for the small C2C info on the home page
 */
?>



<div class="c2c-accordion c2c-item">
    <ul>
        <li>
            
                <a id="a1">
                    <div class="c2c-business-card">
                        <div class="c2c-div-left">
                            <h3><?php the_field('title1'); ?></h3>
                            <img src="<?php the_field('image1'); ?>" alt="" />
                        </div>

                        <div class="c2c-div-right">
                            <?php the_field('content1'); ?>
                        </div>
                    </div>
                </a>
             
        </li>
        <li>
                <a>
                    <div class="c2c-business-card">
                        <div class="c2c-div-left">
                            <h3><?php the_field('title2'); ?></h3>
                            <img src="<?php the_field('image2'); ?>" alt="" />
                        </div>

                        <div class="c2c-div-right">
                            <?php the_field('content2'); ?>
                        </div>
                    </div>
                </a>
        </li>
        <li>
                <a>
                    <div class="c2c-business-card">
                        <div class="c2c-div-left">
                            <h3><?php the_field('title2'); ?></h3>
                            <img src="<?php the_field('image2'); ?>" alt="" />
                        </div>

                        <div class="c2c-div-right">
                            <div class="c2c-content-container">
                                <?php the_field('content3'); ?>
                            </div>
                            <div class="c2c-button-container">
                                <input class="button" value="Solving the Problem" />
                            </div>

                        </div>
                    </div>
                </a>

                
        </li>        
    </ul>
</div>


<script type="text/javascript" >
    $(document).ready(function(){
        lastBlock = $("#a1");
        maxWidth = 660;
        minWidth = 205; 

        $("ul li a").hover(
        function(){
            $(lastBlock).animate({width: minWidth+"px"}, { queue:false, duration:400 });
            $(this).animate({width: maxWidth+"px"}, { queue:false, duration:400});
            lastBlock = this;

            $(this).find('.c2c-div-right').show();
            $(this).parent().siblings().find('.c2c-div-right').hide(); 

        });
    });
</script>

