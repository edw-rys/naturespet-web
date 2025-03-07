<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

/* Customized script - Added column class for all fields */

?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<h2 class="woocommerce-Reviews-title">
			<?php
			$count = $product->get_review_count();
			if ( $count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'petszone-shop' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
				echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
			} else {
				esc_html_e( 'Reviews', 'petszone-shop' );
			}
			?>
		</h2>

		<?php if ( have_comments() ) : ?>
			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => '&larr;',
							'next_text' => '&rarr;',
							'type'      => 'list',
						)
					)
				);
				echo '</nav>';
			endif;
			?>
		<?php else : ?>
			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'petszone-shop' ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
				$commenter    = wp_get_current_commenter();
				$comment_form = array(
					/* translators: %s is product title */
					'title_reply'         => have_comments() ? esc_html__( 'Add a review', 'petszone-shop' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'petszone-shop' ), get_the_title() ),
					/* translators: %s is product title */
					'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'petszone-shop' ),
					'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
					'title_reply_after'   => '</span>',
					'comment_notes_after' => '',
					'label_submit'        => esc_html__( 'Submit', 'petszone-shop' ),
					'logged_in_as'        => '',
					'comment_field'       => '',
				);

				$name_email_required = (bool) get_option( 'require_name_email', 1 );
				$fields              = array(
					'author' => array(
						'label'    => __( 'Name', 'petszone-shop' ),
						'type'     => 'text',
						'value'    => $commenter['comment_author'],
						'required' => $name_email_required,
					),
					'email' => array(
						'label'    => __( 'Email', 'petszone-shop' ),
						'type'     => 'email',
						'value'    => $commenter['comment_author_email'],
						'required' => $name_email_required,
					),
				);

				$comment_form['fields'] = array();

				$i = 0;
				foreach ( $fields as $key => $field ) {
					$first_class = ($i%2 == 0) ? 'first' : '';
					$field_html = '<div class="column wdt-one-half '.$first_class.'">';
					$field_html .= '<p class="comment-form-' . esc_attr( $key ) . '">';
					//$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

					// if ( $field['required'] ) {
					// 	$required .= '&nbsp;<span class="required">*</span>';
					// }

					$field_html .= '<input  placeholder="'.esc_html( $field['label'] ).' *"   id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

					$field_html .= '</div>';

					$comment_form['fields'][ $key ] = $field_html;

					$i++;
				}

				$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'petszone-shop' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}

				if ( wc_review_ratings_enabled() ) {
					$comment_form['comment_field'] = '<div class="column wdt-one-column"><div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'petszone-shop' ) . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'petszone-shop' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'petszone-shop' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'petszone-shop' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'petszone-shop' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'petszone-shop' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'petszone-shop' ) . '</option>
					</select></div></div>';
				}

				$comment_form['comment_field'] .= '<div class="column wdt-one-column"><p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" required placeholder="Your review *"></textarea></p></div>';

				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>
	<?php else : ?>
		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'petszone-shop' ); ?></p>
	<?php endif; ?>

	<div class="clear"></div>
</div>
