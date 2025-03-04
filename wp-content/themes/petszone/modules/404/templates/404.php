<?php
    if( isset( $enable_404message ) && ( $enable_404message == 1 || $enable_404message == true )  ) {
        $class = $notfound_style;
        $class .= ( isset( $notfound_darkbg ) && ( $notfound_darkbg == 1 ) ) ? " wdt-dark-bg" :"";
    ?>
    <div class="wrapper <?php echo esc_attr( $class );?>">
        <div class="container">
            <div class="center-content-wrapper">
                <div class="center-content">
                    <div class="center-content-image">
                    <img class="error-image" alt="The Page Not Found" src="<?php echo esc_url(PETSZONE_ROOT_URI.'/assets/images/404-image.png');?>"/>
                    <h2>Oops! That Page Can't Be Found</h2> 
                    </div>
                    <p><?php esc_html_e("We're Really Sorry but we can't seem to find the page you were looking for.", 'petszone'); ?></p>
                    <a class="wdt-button filled small" target="_self" href="<?php echo esc_url(home_url('/'));?>"><?php esc_html_e("Back to Home",'petszone');?></a>
                </div>
            </div>
        </div>
    </div><?php
}?>