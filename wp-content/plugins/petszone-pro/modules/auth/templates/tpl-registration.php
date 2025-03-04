<?php get_header(); ?>

<?php
    /*Template Name: Registration Page Template */
?>

<div class="container">
    <div class="petszone-custom-auth-column dt-sc-full-width  wdt-registration-form">
        <div class="petszone-custom-auth-sc-border-title"> <h2><span><?php esc_html_e('Register Form', 'petszone-pro');?></span> </h2></div>
        <div class="petszone-custom-auth-register-alert"></div>

        <p> <strong><?php esc_html_e('Do not have an account?', 'petszone-pro');?></strong> </p>

        <form name="loginform" id="loginform" method="post">

            <p>
                <input type="text" name="first_name"  id="first_name" class="input" value="" size="20" required="required" placeholder="<?php esc_html_e('Firstname *', 'petszone-pro');?>" />
            </p>
            <p>
                <input type="text" name="last_name" id="last_name"  class="input" value="" size="20" placeholder="<?php esc_html_e('Lastname', 'petszone-pro');?>" />
            </p>
            <p>
                <input type="text" name="user_name" id="user_name"  class="input" value="" size="20" required="required" placeholder="<?php esc_html_e('Username *', 'petszone-pro');?>" />
            </p>
            <p>
                <input type="email" name="user_email" id="user_email"  class="input" value="" size="20" required="required" placeholder="<?php esc_html_e('Email Id *', 'petszone-pro');?>" />
            </p>
            <p>
                <input type="password" name="password" id="password"  class="input" value="" size="20" required="required" placeholder="<?php esc_html_e('Password *', 'petszone-pro');?>" />
            </p>
            <p>
                <input type="password" name="cpassword" id="cpassword"  class="input" value="" size="20" required="required" placeholder="<?php esc_html_e('Confirm Password *', 'petszone-pro');?>"/>
                <span class="password-alert"></span>
            </p>
            <?php do_action( 'anr_captcha_form_field' ); ?>
            <p> <?php  echo apply_filters('dt_sc_reg_form_elements', '', array () ); ?> </p>
            <p class="submit">
                <input type="submit" class="button-primary petszone-custom-auth-register-button" id="petszone-custom-auth-register-button" value="<?php esc_attr_e('Register', 'petszone-pro');?>" />
            </p>
            <p>
                <?php echo esc_html__('Already have an account.?', 'petszone-pro'); ?> 
                <a href="#" title=<?php echo esc_html__('Login', 'petszone-pro'); ?> class="petszone-pro-login-link" onclick="return false"><?php echo esc_html__('Login', 'petszone-pro'); ?></a>
            </p>
        </form>
    </div><!-- Registration Form End -->
</div>

<?php get_footer(); ?>