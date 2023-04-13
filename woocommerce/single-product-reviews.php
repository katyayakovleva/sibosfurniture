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
 * @package WooCommerce\Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
global $post;
$comments = get_comments(array(
    'post_id' => $post->ID,
    'status' => 'approve'
));

if ( ! comments_open() ) {
    return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
    <div id="comments">
<!--        <h2 class="woocommerce-Reviews-title">-->
<!--            --><?php
//            $count = $product->get_review_count();
//            if ( $count && wc_review_ratings_enabled() ) {
//                /* translators: 1: reviews count 2: product name */
//                $reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
//                echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
//            } else {
//                esc_html_e( 'Reviews', 'woocommerce' );
//            }
//            ?>
<!--        </h2>-->

        <?php if ( have_comments() ) : ?>
        <div id="tab-feedback" class="description-info__block">
            <div class="swiper-per-view">
                <div class="swiper-wrapper">
                    <?php foreach ($comments as $comment){
                        $rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );?>
                        <div class="swiper-slide comment">
                            <figure>
                                <?php echo get_avatar( $comment, 22)?>
                            </figure>
                            <div>
                                <div>
                                    <?php for ($i = 1; $i <= $rating; $i++){ ?>
                                        <span class="checked"></span>
                                    <?php }
                                    for ($i = 1; $i <= 5-$rating; $i++){?>
                                        <span class="unchecked"></span>
                                    <?php }?>
                                </div>
                                <p class="ff-ms fs-5 fc-blue-2 mobile-comment-text"><?php echo $comment->comment_content?></p>
                            </div>
                        </div>
                    <?php }?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
        <?php else : ?>
            <p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>
        <?php endif; ?>
    </div>

    <?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
       <article id="review_form_wrapper " class="header-block mt-3">
        <header><h2>Add a review</h2></header>
           <section id="review_form " class="header-block__body">
            <?php
               $commenter    = wp_get_current_commenter();
               $comment_form = array(
                   /* translators: %s is product title */
                   'title_reply'         => ' ',
                   /* translators: %s is product title */
                   'title_reply_to'      => ' ',
                   'title_reply_before'  => ' ',
                   'title_reply_after'   => ' ',
                   'comment_notes_after' => '',
                   'label_submit'        =>'ADD',
                   'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class=" btn" value="%4$s">ADD</button>',
                   'submit_field'      => '<div class="submit_div">%1$s %2$s</div>',
                   'logged_in_as'        => '',
                   'comment_field'       => '',
               );

               $name_email_required = (bool) get_option( 'require_name_email', 1 );
               $fields              = array(
                   'author' => array(
                       'label'    => __( 'Name', 'woocommerce' ),
                       'type'     => 'text',
                       'value'    => $commenter['comment_author'],
                       'required' => $name_email_required,
                   ),
                   'email'  => array(
                       'label'    => __( 'Email', 'woocommerce' ),
                       'type'     => 'email',
                       'value'    => $commenter['comment_author_email'],
                       'required' => $name_email_required,
                   ),
               );

               $comment_form['fields'] = array();

               foreach ( $fields as $key => $field ) {
                   $field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
                   $field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

                   if ( $field['required'] ) {
                       $field_html .= '&nbsp;<span class="required">*</span>';
                   }

                   $field_html .= '</label><input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

                   $comment_form['fields'][ $key ] = $field_html;
               }

               $account_page_url = wc_get_page_permalink( 'myaccount' );
               if ( $account_page_url ) {
                   /* translators: %s opening and closing link tags respectively */
                  // $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
               }

               if ( wc_review_ratings_enabled() ) {
                   $comment_form['comment_field'] = '<div class="comment-form-rating">
                   <label for="rating">' . esc_html__( 'Rating', 'woocommerce' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label>
                   <select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
					</select></div>';
               }

               $comment_form['comment_field'] .= '<div class="comment-form-comment">
               <label for="comment">' . esc_html__( 'Review', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label>
               <textarea id="comment" name="comment" cols="45" rows="8" required></textarea></div>';

               comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
//                ?>
           </section>
       </article>
  <?php else : ?>
  <?php endif; ?>
<!---->
   <div class="clear"></div>
</div>