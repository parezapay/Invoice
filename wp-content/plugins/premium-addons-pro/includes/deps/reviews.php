<?php

if ( ! defined('ABSPATH') ) exit;

define('PREMIUM_FB_REV_GRAPH_API', 'https://graph.facebook.com/');

define('PREMIUM_GOOGLE_PLACE_API', 'https://maps.googleapis.com/maps/api/place/');

define('PREMIUM_FB_REV_AVATAR', PREMIUM_ADDONS_URL . 'assets/images/person-image.jpg');

/**
 * Gets JSON Data from Facebook
 * @since 1.0.0
 */
function premium_fb_rev_api_rating( $page_id, $page_access_token ) { 

    $api_url = PREMIUM_FB_REV_GRAPH_API . $page_id . "?access_token=" . $page_access_token . "&fields=ratings.limit(9999)";
      
    $api_response = rplg_urlopen( $api_url );
    
    return $api_response;
}

/**
 * Gets Page Data from Facebook
 * @since 1.0.0
 */
function premium_fb_rev_page( $page_id, $page_name, $rating, $fill_color,$empty_color, $show_stars,$star_size,$page_rate, $custom_image ) {
    
    if( empty( $custom_image ) ) {
        $page_img = 'https://graph.facebook.com/' . $page_id .'/picture';
    } else {
        $page_img = $custom_image;
    }
    
    $page_link = sprintf( '<a class="premium-fb-rev-page-link" href="https://fb.com/%s" target="_blank" title="%2$s" ><span>%2$s</span></a>', $page_id, $page_name );
?>

    <div class="premium-fb-rev-page-left">
        <img class="premium-fb-rev-img" src="<?php echo esc_attr( $page_img ); ?>" alt="<?php echo $page_name; ?>">
    </div>
    <div class="premium-fb-rev-page-right">
        <?php if( ! empty( $page_name ) ) : ?>
        <div class="premium-fb-rev-page-link-wrapper"><?php
            echo $page_link;
        ?>
       </div>
        <?php endif; ?>
        <div class="premium-fb-rev-page-rating-wrapper">
            <?php if( $page_rate ) : ?>
                <span class="premium-fb-rev-page-rating"><?php echo $rating; ?></span>
            <?php endif; ?>
            <?php if( $show_stars ) : ?>
                <span class="premium-fb-rev-page-stars"><?php premium_fb_rev_stars( $rating, $fill_color,$empty_color,$star_size ); ?></span>
            <?php endif; ?>
        </div>
   </div>
<?php
}

/**
* Gets reviews data from Facebook
* @since 1.0.0
*/
function premium_fb_rev_reviews( $reviews, $fill_color, $empty_color, $show_stars, $star_size, $min_filter, $max_filter, $show_date, $rev_text, $limit, $page_id ) { 
    
    ?>
   <div class="premium-fb-rev-reviews">
    <?php
        if ( count( $reviews ) > 0 ) {
            array_splice( $reviews, $limit );
            foreach ( $reviews as $review ) {
                $rating = isset( $review->rating ) ? $review->rating : 5;
                $image_link = 'https://fb.richplugins.com/picture?pid=' . $page_id . '&psid=' . $review->reviewer->id;
                $name_link = 'https://facebook.com/' . $page_id . '/reviews';
                if( $min_filter <= $rating && $rating <= $max_filter ){ ?>
       <div class="premium-fb-rev-review-wrap">
            <div class="premium-fb-rev-review">
                <div class="premium-fb-rev-review-inner">
                    <div class="premium-fb-rev-content-left">
                        <img class="premium-fb-rev-img" src="<?php echo $image_link; ?>" alt="<?php echo $review->reviewer->name; ?>" onerror=" if( this.src!='<?php echo PREMIUM_FB_REV_AVATAR; ?>' ) this.src='<?php echo PREMIUM_FB_REV_AVATAR; ?>';">
                    </div>
                    <div class="premium-fb-rev-content-right">
                        <?php if( isset( $review->reviewer->id ) ): ?>
                        <div class="premium-fb-rev-content-link-wrapper">
                    <?php
                        $person_link = '<a class="premium-fb-rev-reviewer-link" href="https://facebook.com/'. $page_id . '/reviews" target="_blank"><span>'. $review->reviewer->name .'</span></a>';
                        echo $person_link;
                    ?>
                        </div>
                        <?php endif; ?>
                    <?php if( $show_date ) : ?>
                        <div class="premium-fb-rev-time"><span class="premium-fb-rev-time-text"><?php echo str_replace('-', '/', strtok( $review->created_time, "T" ) ); ?></span></div>
                    <?php endif; ?>
                        <div class="premium-fb-rev-rating">
                            <?php if( $show_stars ) : ?>
                                <div class="premium-fb-rev-stars-container">
                                    <span class="premium-fb-rev-stars"><?php
                                        echo premium_fb_rev_stars( $rating, $fill_color,$empty_color,$star_size ); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                    <?php if ( isset( $review->review_text ) && $rev_text ) { ?>
                        <div class="premium-fb-rev-text-wrapper">
                            <span class="premium-fb-rev-text"><?php
                                echo premium_fb_rev_trim_text($review->review_text, 0); ?>
                            </span>
                        </div>
                    <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <?php }
        }
    }
?>
    </div>
<?php }

/**
 * Gets JSON Data from Google
 * @since 1.0.0
 */
function  premium_google_rev_api_rating ( $api_key,$place_id ){

    $api_url = PREMIUM_GOOGLE_PLACE_API . 'details/json?placeid=' . trim( $place_id )  . '&key=' . trim( $api_key );
    
    $api_response = rplg_urlopen( $api_url );

    return $api_response;

}

/**
 * Gets place data from Google
 * @since 1.0.0
 */
function premium_google_rev_place( $place, $custom_image, $rating, $fill_color, $empty_color, $show_stars, $star_size, $page_rate, $api_key, $id ) { ?>

    <div class="premium-fb-rev-page-left">
        <?php  if( empty( $custom_image ) ) {
            
            $image = premium_place_avatar( $place, $api_key );

            //$place->photo = substr( $image , 0 , strpos( $image, '-w50' ) );

            if ( ! empty ( $image ) ) {
                $place_img = $image;
            } elseif ( ! empty ( $place-> icon ) ) {
                $place_img = $place->icon;
            } else {
                $place_img = '';
            }
            
            if( isset( $place_img ) ) {
                update_option('premium_google_img-' . $id , $place_img );
            } else {
                $place_img = get_option('premium_google_img-' . $id );
            }
            
        } else {
            
            $place_img = $custom_image;
            
        } ?>
        
        <img class="premium-fb-rev-img" src="<?php echo $place_img; ?>" alt="<?php echo $place->name; ?>">
    </div>
    <div class="premium-fb-rev-page-right">
        <?php if( !empty( $place->name ) ) : ?>
        <div class="premium-fb-rev-page-link-wrapper"><?php
            $place_link = '<a class="premium-fb-rev-page-link" href="' . $place->url . '" target="_blank"><span>'. $place->name .'</span></a>';
            echo $place_link; ?>
       </div>
        <?php endif; ?>
        <div class="premium-fb-rev-page-rating-wrapper">
            <?php if( $page_rate ) : ?>
                <span class="premium-fb-rev-page-rating"><?php echo $rating; ?></span>
            <?php endif; ?>
            <?php if( $show_stars ) : ?>
                <span class="premium-fb-rev-page-stars"><?php premium_fb_rev_stars( $rating, $fill_color,$empty_color,$star_size ); ?></span>
            <?php endif; ?>
        </div>
   </div>
<?php
}

/**
 * Gets place image from Google
 * @since 1.0.0
 */
function premium_place_avatar( $response_result_json, $api_key ) {
    if( isset( $response_result_json->photos ) ) {
        $request_url = add_query_arg(
            array(
                'photoreference' => $response_result_json->photos[0]->photo_reference,
                'key'            => $api_key,
                'maxwidth'       => '800',
                'maxheight'      => '800',
            ),
            'https://maps.googleapis.com/maps/api/place/photo'
        );

        $response = rplg_urlopen( $request_url );

        foreach ( $response['headers'] as $header ) {
            if ( strpos( $header, 'Location: ') !== false ) {
                return str_replace('Location: ', '', $header);
            }
        }
    }
    return null;
}

/**
 * Gets reviews data from Google
 * @since 1.0.0
 */
function premium_google_rev_reviews( $reviews, $fill_color, $empty_color, $show_stars, $star_size, $min_filter, $max_filter, $show_date, $date_format, $limit, $rev_text, $language, $prefix ) {
 ?>

   <div class="premium-fb-rev-reviews">
    <?php if ( count( $reviews ) > 0) {
        array_splice( $reviews, $limit );
        foreach ( $reviews as $review ) {
            $rev_lang = $review->language;
            if( empty( $prefix ) || ( $language && $rev_lang == $prefix ) ) {
                if( $min_filter <= $review->rating && $review->rating <= $max_filter ) { ?>
                    <div class="premium-fb-rev-review-wrap">
                        <div class="premium-fb-rev-review">
                            <div class="premium-fb-rev-review-inner">
                                <div class="premium-fb-rev-content-left">
                                    <?php if ( strlen( $review->profile_photo_url ) > 0 ) {
                                        $author_photo = $review->profile_photo_url;
                                    } else {
                                        $author_photo = PREMIUM_FB_REV_AVATAR;
                                    }
                                    ?>
                                 <img class="premium-fb-rev-img" src="<?php echo $author_photo; ?>" alt="<?php echo $review->author_name; ?>" onerror="if( this.src!='<?php echo PREMIUM_FB_REV_AVATAR; ?>' ) this.src='<?php echo PREMIUM_FB_REV_AVATAR; ?>';">
                             </div>
                             <div class="premium-fb-rev-content-right">
                                 <div class="premium-fb-rev-content-link-wrapper">
                         <?php $person_link = '<a class="premium-fb-rev-reviewer-link" href="'. $review->author_url . '" target="_blank"><span>'. $review->author_name .'</span></a>';
                             echo $person_link;
                         ?>
                                 </div>
                             <?php if( $show_date ) : ?>
                                 <div class="premium-fb-rev-time"><span class="premium-fb-rev-time-text"><?php echo date( $date_format, $review->time );?></span></div>
                             <?php endif; ?>
                                 <div class="premium-fb-rev-rating">
                                     <?php if($show_stars) : ?>
                                         <div class="premium-fb-rev-stars-container">
                                             <span class="premium-fb-rev-stars"><?php
                                     echo premium_fb_rev_stars($review->rating, $fill_color,$empty_color,$star_size); ?></span>
                                         </div>
                                     <?php endif; ?>
                                     <?php if (isset( $review->text ) && $rev_text) { ?>
                                 <div class="premium-fb-rev-text-wrapper">
                                     <span class="premium-fb-rev-text"><?php
                                    echo premium_fb_rev_trim_text( $review->text, 0 ); ?></span>
                                 </div>
                             <?php } ?>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            }
        }
    }
?>
   </div>
<?php }

/**
* Gets rating stars SVG
* @since 1.0.0
*/
function premium_fb_rev_stars( $rating, $fill_color, $empty_color, $star_size ) { 
    ?>
    <span class="premium-fb-rev-stars">
    <?php
        foreach (array( 1, 2, 3, 4, 5 ) as $val) {
            $score = $rating - $val;
            if ( $score >= 0 ) { ?>
            <span class="premium-fb-rev-star"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="<?php echo esc_attr($star_size); ?>" height="<?php echo esc_attr($star_size); ?>" viewBox="0 0 1792 1792"><path d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z" fill="<?php echo esc_attr($fill_color);?>"></path></svg></span>
            <?php } else if ($score > -1 && $score < 0) { ?>
            <span class="premium-fb-rev-star"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="<?php echo esc_attr($star_size); ?>" height="<?php echo esc_attr($star_size); ?>" viewBox="0 0 1792 1792"><path d="M1250 957l257-250-356-52-66-10-30-60-159-322v963l59 31 318 168-60-355-12-66zm452-262l-363 354 86 500q5 33-6 51.5t-34 18.5q-17 0-40-12l-449-236-449 236q-23 12-40 12-23 0-34-18.5t-6-51.5l86-500-364-354q-32-32-23-59.5t54-34.5l502-73 225-455q20-41 49-41 28 0 49 41l225 455 502 73q45 7 54 34.5t-24 59.5z" fill="<?php echo esc_attr($fill_color);?>"></path></svg></span>
            <?php } else { ?>
            <span class="premium-fb-rev-star"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="<?php echo esc_attr($star_size); ?>" height="<?php echo esc_attr($star_size); ?>" viewBox="0 0 1792 1792"><path d="M1201 1004l306-297-422-62-189-382-189 382-422 62 306 297-73 421 378-199 377 199zm527-357q0 22-26 48l-363 354 86 500q1 7 1 20 0 50-41 50-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z" fill="<?php echo esc_attr($empty_color); ?>"></path></svg></span>
            <?php
        }
    }
?>
    </span>
<?php }

function premium_fb_rev_rstrpos($haystack, $needle, $offset) {
    
    $size = strlen($haystack);
    
    $pos  = strpos(strrev($haystack), $needle, $size - $offset);
    
    if ( $pos === false )
        return false;
    
    return $size - $pos;
}

function premium_fb_rev_trim_text( $text, $size ) {
    if ( $size > 0 && strlen( $text ) > $size ) {
        $visible_text   = $text;
        $invisible_text = '';
        $idx            = premium_fb_rev_rstrpos($text, ' ', $size);
        if( $idx < 1 ) {
            $idx = $size;
        }
        if( $idx > 0 ) {
            $visible_text   = substr( $text, 0, $idx );
            $invisible_text = substr( $text, $idx, strlen( $text ) );
        }
        echo $visible_text;
        if( strlen( $invisible_text ) > 0) { ?>
        <span class="wp-more"><?php echo $invisible_text;?></span>
        <span class="wp-more-toggle" onclick="this.previousSibling.className='';this.textContent='';"><?php echo __('read more','premium-addons-pro'); ?></span><?php
        }
    } else {
        echo $text;
    }
}