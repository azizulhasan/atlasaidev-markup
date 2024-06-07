<?php

namespace AtlasAiDev\MarkUp;

use AtlasAiDev\MarkUp\Engine\Article\Article;
use AtlasAiDev\MarkUp\Engine\Article\TechArticle;
use AtlasAiDev\MarkUp\Engine\Audio;
use AtlasAiDev\MarkUp\Engine\Faq;
use AtlasAiDev\MarkUp\Engine\HowTo;
use AtlasAiDev\MarkUp\Engine\Product;
use AtlasAiDev\MarkUp\Engine\Video;
use AtlasAiDev\MarkUp\Engine\Website;
use AtlasAiDev\MarkUp\Inc\Support;

class Init {

    /**
     * Init class constructor for attach the schema in wp_head tag
     */
	public function __construct() {
        add_action('wp_head', [ $this, 'run' ] );
    }

    /**
     * Init Class run method for run the program
     *
     * @return void
     */
	public function run() {
        global $post;

        /**
         * Product Schema
         */
        if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            if ( is_product() ) {
                new Product( $post->ID );
            }
        }

        /**
         * Website Schema
         */
        if ( ! is_admin() ) {
            new Website( $post->ID );
        }

        /**
         * Article Schema
         */
        if ( ( 'docs' === get_post_type( $post->ID ) || 'post' == get_post_type( $post->ID ) ) && ( is_single() || is_singular() ) && ( ! function_exists('is_product')  )  ) {
            if ( 'docs' === get_post_type( $post->ID ) ) {
                new TechArticle( $post->ID ); // this section will move to article folder causes this will run only article or blog runs
            } else {
                new Article( $post->ID );
            }
        }

        /**
         * Support Schemas
         */
        $support_schema = null;
        if ( ! empty( $post ) ) {
            $support_schema = new Support( $post->ID );

            $support_schema_arr = $support_schema->get_support_schema();

            /**
             * Check if the support schema array empty or not
             */
            if ( is_array( $support_schema_arr ) ) {

                /**
                 * Video Schema
                 */
                if ( isset( $support_schema_arr['video'] ) ) {
                    new Video( $support_schema_arr['video'], $post->ID );
                }

                /**
                 * Audio Schema
                 */
                if ( isset( $support_schema_arr['audio'] ) ) {
                    new Audio( $support_schema_arr['audio'], $post->ID );
                }

                /**
                 * HowTo Schema
                 */
                if ( isset( $support_schema_arr['howto'] ) ) {
                    new HowTo( $post->ID );
                }

                /**
                 * Faq Schema
                 */
                if ( isset( $support_schema_arr['faq'] ) ) {
                    new Faq( $post->ID );
                }
            }
        }
	}
}