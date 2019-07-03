<?php
/**
 * The template for displaying search results.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<main id="main" class="site-main" role="main">

	<header class="page-header">
		<h1 class="entry-title">
			<?php esc_html_e( 'Search results for: ', 'hello-elementor' ); ?>
			<span><?php echo get_search_query(); ?></span>
		</h1>
	</header>

	<div class="page-content">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) : the_post();
				printf( '<h2><a href="%s">%s</a></h2>', esc_url( get_permalink() ), get_the_title() );
				the_post_thumbnail();
				the_excerpt();
			endwhile;
			?>
		<?php else : ?>
			<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for.', 'hello-elementor' ); ?></p>
		<?php endif; ?>
	</div>

	<div class="entry-links"><?php wp_link_pages(); ?></div>

	<?php global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="nav-below" class="navigation" role="navigation">
            <?php /* Translators: HTML arrow */ ?>
			<div class="nav-previous"><?php next_posts_link( sprintf( __( '%s older', 'hello-elementor' ), '<span class="meta-nav">&larr;</span>' ) ); ?></div>
			<?php /* Translators: HTML arrow */ ?>
            <div class="nav-next"><?php previous_posts_link( sprintf( __( 'newer %s', 'hello-elementor' ), '<span class="meta-nav">&rarr;</span>' ) ); ?></div>
		</nav>
	<?php endif; ?>
</main>
