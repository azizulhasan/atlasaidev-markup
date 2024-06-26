<?php

namespace AtlasAiDev\MarkUp\Engine\Article;

use AtlasAiDev\MarkUp\Inc\BaseEngine;

class Article extends BaseEngine {

    /**
     * @var mixed|null
     */
    private $post_id;

    /**
     * Article schema constructor
     *
     * @param $post_id
     */
    public function __construct( $post_id = null ) {


        $this->schema_file      = 'article.json';

        parent::__construct();

        $this->schema_type      = 'article';
        $this->post_id          = $post_id;
    }

    /**
     * Update the Article schema with real time data
     *
     * @return mixed|null
     */
    protected function update_schema() {

        $this->schema            = json_encode( $this->single_article( $this->schema_structure ) );

        return apply_filters( "markup_{$this->schema_type}_update_schema", $this->schema );
    }

    /**
     * Update the single article data
     *
     * @param $article_arr
     * @return mixed
     */
    protected function single_article( $article_arr ) {


        /**
         * article schema type key
         */
        $type = $this->type();
        if ( isset( $article_arr['@type'] ) && ! empty( $type ) ) {
            $article_arr['@type']                       = $type;
        }else {
            unset( $article_arr['@type'] );
        }

        /**
         * article schema mainEntityOfPage key
         */
        if ( isset( $article_arr['mainEntityOfPage'] ) ) {
            $mainEntityOfPage                           = $this->mainEntityOfPage( $article_arr['mainEntityOfPage'] );
            if ( ! empty( $mainEntityOfPage ) ) {
                $article_arr['mainEntityOfPage']        = $mainEntityOfPage;
            } else {
                unset( $article_arr['mainEntityOfPage'] );
            }
        }

        /**
         * article schema headline key
         */
        if( isset( $article_arr['headline'] ) ) {
            $headline                                   = get_the_title( $this->post_id );
            if ( ! empty( $headline ) ) {
                $article_arr['headline']                = $headline;
            } else {
                unset( $article_arr['headline'] );
            }
        }

        /**
         * article schema description key
         */
        if ( isset( $article_arr['description'] ) ) {
            $description                                = get_the_excerpt($this->post_id);
            if ( !empty( $description ) ) {
                $article_arr['description']             = $description;
            } else {
                unset( $article_arr['description'] );
            }
        }

        /**
         * article schema image key
         */
        if ( isset( $article_arr['image'] ) ) {
            $images                                     = $this->image();
            if ( ! empty( $images ) ) {
                $article_arr['image']                   = $images;
            }else {
                unset( $article_arr['image'] );
            }
        }

        /**
         * article schema datePublished key
         */
        if ( isset( $article_arr['datePublished'] ) ) {
            $datePublished                              = $this->datePublished();
            if ( !empty( $datePublished ) ) {
                $article_arr['datePublished']           = $datePublished;
            } else {
                unset( $datePublished );
            }
        }

        /**
         * article schema dateModified key
         */
        if ( isset( $article_arr['dateModified'] ) ) {
            $dateModified                               = $this->dateModified();
            if ( !empty( $dateModified ) ) {
                $article_arr['dateModified']            = $dateModified;
            } else {
                unset( $article_arr['dateModified'] );
            }
        }

        /**
         * article schema author key
         */

        if ( isset( $article_arr['author'] ) ) {

            $author                                     = $this->author( $article_arr['author'] );
            if ( ! empty( $author ) ) {
                $article_arr['author']                  = $author;
            } else {
                unset( $article_arr['author'] );
            }
        }

        /**
         * article schema editor key
         */

        if ( isset( $article_arr['editor'] ) ) {

            $editor                                     = $this->editor( $article_arr['editor'] );
            if ( ! empty( $editor ) ) {
                $article_arr['editor']                  = $editor;
            } else {
                unset( $article_arr['editor'] );
            }
        }

        /**
         * article schema publisher key
         */
        if ( isset( $article_arr['publisher'] ) ) {
            $publisher                                  = $this->publisher( $article_arr['publisher'] );
            if ( ! empty( $publisher ) ) {
                $article_arr['publisher']               = $publisher;
            } else {
                unset( $article_arr['publisher'] );
            }
        }

        /**
         * article schema articleBody key
         */
        if ( isset($article_arr['articleBody']) ) {
            $articleBody                                = $this->articleBody();
            if ( !empty($articleBody)) {
                $article_arr['articleBody']             = $articleBody;
            } else {
                unset( $article_arr['articleBody'] );
            }
        }

        /**
         * article schema keywords key
         */
        if ( isset( $article_arr['keywords'] ) ) {
            $keywords                                   = $this->keywords();
            if ( ! empty( $keywords ) ) {
                $article_arr['keywords']                = $keywords;
            } else {
                unset( $article_arr['keywords'] );
            }
        }

        /**
         * article schema articleSection key
         */
        if ( isset( $article_arr['articleSection'] ) ) {
            $articleSection                             = $this->articleSection();
            if ( !empty( $articleSection ) ) {
                $article_arr['articleSection']          = $articleSection;
            } else {
                unset( $article_arr['articleSection'] );
            }
        }

        /**
         * article schema commentCount key
         */
        if ( isset( $article_arr['commentCount'] ) ) {
            $commentCount                               = $this->commentCount();
            if ( !empty( $commentCount ) ) {
                $article_arr['commentCount']            = $commentCount;
            } else {
                unset( $article_arr['commentCount'] );
            }
        }

        /**
         * article schema wordCount key
         */
        if ( isset( $article_arr['wordCount'] ) ) {
            $wordCount                                  = $this->wordCount();
            if ( ! empty( $wordCount ) ) {
                $article_arr['wordCount']               = $wordCount;
            } else {
                unset( $article_arr['wordCount'] );
            }
        }

        /**
         * article schema thumbnailUrl key
         */
        if ( isset( $article_arr['thumbnailUrl'] ) ) {
            $thumbnailUrl                               = $this->thumbnailUrl();
            if ( ! empty( $thumbnailUrl ) ) {
                $article_arr['thumbnailUrl']            = $thumbnailUrl;
            } else {
                unset( $article_arr['thumbnailUrl'] );
            }
        }

        /**
         * article schema isAccessibleForFree key
         */
        if ( isset( $article_arr['isAccessibleForFree'] ) ) {
            $article_arr['isAccessibleForFree']         = $this->isAccessibleForFree();
        }

        /**
         * article schema copyrightHolder key
         */
        if ( isset( $article_arr['copyrightHolder'] ) ) {
            $copyrightHolder                            = $this->copyrightHolder( $article_arr['copyrightHolder'] );
            if ( ! empty( $copyrightHolder ) ) {
                $article_arr['copyrightHolder']         = $copyrightHolder;
            } else {
                unset( $article_arr['copyrightHolder'] );
            }
        }

        /**
         * article schema potentialAction key
         */
        if ( isset( $article_arr['potentialAction'] ) ) {
            $potentialAction                            = $this->potentialAction( $article_arr['potentialAction'] );
            if ( ! empty( $potentialAction ) ) {
                $article_arr['potentialAction']         = $potentialAction;
            } else {
                unset( $article_arr['potentialAction'] );
            }
        }

        /**
         * article schema isPartOf key
         */
        if ( isset( $article_arr['isPartOf'] ) ) {
            $isPartOf                                   = $this->isPartOf( $article_arr['isPartOf'] );
            if ( !empty( $isPartOf ) ) {
                $article_arr['isPartOf']                = $isPartOf;
            } else {
                unset( $article_arr['isPartOf'] );
            }
        }

        /**
         * article schema mentions key
         */
        if ( isset( $article_arr['mentions'] ) ) {
            $mentions                                   = $this->mentions( $article_arr['mentions'] );
            if ( ! empty( $mentions ) ) {
                $article_arr['mentions']                = $mentions;
            } else {
                unset( $article_arr['mentions'] );
            }
        }

        /**
         * article schema publisherImprint key
         */
        if ( isset( $article_arr['publisherImprint'] ) ) {
            $publisherImprint                           = $this->publisherImprint( $article_arr['publisherImprint'] );
            if ( ! empty( $publisherImprint ) ) {
                $article_arr['publisherImprint']        = $publisherImprint;
            } else {
                unset( $article_arr['publisherImprint'] );
            }
        }

        /**
         * article schema alternateName key
         */
        if ( isset( $article_arr['alternateName'] ) ) {
            $alternateName                              = $this->alternateName();
            if ( ! empty( $alternateName ) ) {
                $article_arr['alternateName']           = $alternateName;
            } else {
                unset( $article_arr['alternateName'] );
            }
        }

        /**
         * article schema dateCreated key
         */
        if ( isset( $article_arr['dateCreated'] ) ) {
            $dateCreated                                = $this->dateCreated();
            if ( ! empty( $dateCreated ) ) {
                $article_arr['dateCreated']             = $dateCreated;
            } else {
                unset( $article_arr['dateCreated'] );
            }
        }

        /**
         * article schema comment key
         */
        if ( isset( $article_arr['comment'] ) ) {
            $comment                                    = $this->comment( $article_arr['comment'] );
            if ( !empty( $comment ) ) {
                $article_arr['comment']                 = $comment;
            } else {
                unset( $article_arr['comment'] );
            }
        }

        /**
         * article schema interactionStatistic key
         */
        if ( isset( $article_arr['interactionStatistic'] ) ) {
            $interactionStatistic                       = $this->interactionStatistic( $article_arr['interactionStatistic'] );
            if ( !empty( $interactionStatistic ) ) {
                $article_arr['interactionStatistic']    = $interactionStatistic;
            } else {
                unset( $article_arr['interactionStatistic'] );
            }
        }

        /**
         * article schema blogPost key
         */
        if ( isset( $article_arr['blogPost'] ) ) {
            $blogPost                                   = $this->blogPost( $article_arr['blogPost'] );
            if ( ! empty( $blogPost ) ) {
                $article_arr['blogPost']                = $blogPost;
            } else {
                unset( $article_arr['blogPost'] );
            }
        }

        /**
         * article schema isBasedOn key
         */
        if ( isset( $article_arr['isBasedOn'] ) ) {
            $isBasedOn                                  = $this->isBasedOn( $article_arr['isBasedOn'] );
            if ( ! empty( $isBasedOn ) ) {
                $article_arr['isBasedOn']               = $isBasedOn;
            } else {
                unset( $article_arr['isBasedOn'] );
            }
        }

        /**
         * article schema genre key
         */
        if ( isset( $article_arr['genre'] ) ) {
            $genre                                      = $this->genre();
            if ( !empty( $genre ) ) {
                $article_arr['genre']                   = $genre;
            } else {
                unset( $article_arr['genre'] );
            }
        }

        /**
         * article schema educationalUse key
         */
        if ( isset( $article_arr['educationalUse'] ) ) {
            $educationalUse                             = $this->educationalUse();
            if ( ! empty( $educationalUse ) ) {
                $article_arr['educationalUse']          = $educationalUse;
            } else {
                unset( $article_arr['educationalUse'] );
            }
        }

        /**
         * article schema about key
         */
        if ( isset( $article_arr['about'] ) ) {
            $about                                      = $this->about( $article_arr['about'] );
            if ( ! empty( $about ) ) {
                $article_arr['about']                   = $about;
            } else {
                unset( $article_arr['about'] );
            }
        }

        return apply_filters("markup_{$this->schema_type}_single_article", $article_arr );
    }

    /**
     * Get the Type key
     *
     * @return string
     */
    protected function type() {
        return 'Article';
    }

    /**
     * Get the mainEntityOfPage array data
     *
     * @param $mainEntityOfPage
     * @return array
     */
    protected function mainEntityOfPage( $mainEntityOfPage ) {

        if ( isset( $mainEntityOfPage['@id'] ) ) {
            $mainEntityOfPage['@id']       = get_permalink($this->post_id);
        }else {
            unset( $mainEntityOfPage['@id'] );
        }

        if ( ! empty( $mainEntityOfPage['@id'] ) ) {
            return apply_filters("markup_{$this->schema_type}_mainEntityOfPage", $mainEntityOfPage );
        }

        return [];
    }

    /**
     * Get images
     *
     * @return array
     */
    protected function image() {
        $images = get_attached_media( 'image', $this->post_id );

        $images_arr = [];

        foreach ($images as $image) {

            $images_arr[] = wp_get_attachment_image($image->ID, 'full');
        }

        if ( ! empty( $images_arr ) ) {
            return $images_arr;
        }

        return [];
    }

    /**
     * Get datePublished
     *
     * @return int|string|null
     */
    protected function datePublished() {

        $datePublished = get_the_date('F j, Y', $this->post_id);

        if ( ! empty( $datePublished ) ) {
            return apply_filters("markup_{$this->schema_type}_datePublished", $datePublished );
        }

        return null;
    }

    /**
     * Get dateModified
     *
     * @return mixed|null
     */
    protected function dateModified() {

        $dateModified = get_the_modified_date('F j, Y', $this->post_id);

        if ( ! empty( $dateModified ) ) {
            return apply_filters("markup_{$this->schema_type}_dateModified", $dateModified );
        }

        return null;
    }

    /**
     * Get author
     *
     * @param $author
     * @return array
     */
    protected function author( $author ) {

        $author_id = get_post_field( 'post_author', $this->post_id );

        /**
         * Get author name
         */
        $author_name = get_the_author_meta('display_name', $author_id);

        if ( isset( $author['name'] ) && ! empty( $author_name ) ) {
            $author['name'] = $author_name;
        } else {
            return null;
        }

        /**
         * Get author url
         */
        $author_url = get_author_posts_url( $author_id );
        if ( isset( $author['url'] ) && ! empty( $author_url ) ) {
            $author['url']   = $author_url;
        } else {
            unset( $author['url'] );
        }

        /**
         * Get author logo
         */
        $author_avatar_url = get_avatar_url($author_id, ['size' => '96']);
        if ( isset( $author['logo']['url'] ) && ! empty( $logo ) ) {
            $author['logo']['url'] = $author_avatar_url;
        } else {
            unset( $author['logo'] );
        }

        $sameAs[] = get_site_url();;
        if ( isset( $author['sameAs'] ) && ! empty( $sameAs ) ) {
            $author['sameAs'] = $sameAs;
        } else {
            unset( $author['sameAs'] );
        }

        return apply_filters("markup_{$this->schema_type}_author", $author );
    }


    protected function editor( $editor ) {

        $editor_id = get_post_field( 'post_author', $this->post_id );

        /**
         * Get editor name
         */
        $editor_name = get_the_author_meta('display_name', $editor_id);

        if ( isset( $editor['name'] ) && ! empty( $editor_name ) ) {
            $editor['name'] = $editor_name;
        } else {
            return null;
        }

        /**
         * Get editor url
         */
        $editor_url = get_author_posts_url( $editor_id );
        if ( isset( $editor['url'] ) && ! empty( $editor_url ) ) {
            $editor['url']   = $editor_url;
        } else {
            unset( $editor['url'] );
        }

        /**
         * Get editor logo
         */
        $editor_avatar_url = get_avatar_url($editor_id, ['size' => '96']);
        if ( isset( $editor['logo']['url'] ) && ! empty( $logo ) ) {
            $editor['logo']['url'] = $editor_avatar_url;
        } else {
            unset( $editor['logo'] );
        }

        $sameAs[] = get_site_url();;
        if ( isset( $editor['sameAs'] ) && ! empty( $sameAs ) ) {
            $editor['sameAs'] = $sameAs;
        } else {
            unset( $editor['sameAs'] );
        }

        return apply_filters("markup_{$this->schema_type}_editor", $editor );
    }

    /**
     * Get publisher
     *
     * @param $publisher
     * @return array
     */
    public function publisher( $publisher ) {

        $name = get_bloginfo();
        if ( isset( $publisher['name'] ) && ! empty( $name ) ) {
            $publisher['name'] = $name;
        } else {
            return null;
        }

        $url = get_site_url();
        if ( isset( $publisher['url'] ) && ! empty( $url ) ) {
            $publisher['url']   = $url;
        } else {
            unset( $publisher['url'] );
        }

        $logo = null;
        if ( isset( $publisher['logo']['url'] ) && ! empty( $logo ) ) {
            $publisher['logo']['url'] = $logo;
        } else {
            unset( $publisher['logo'] );
        }

        $sameAs = null;
        if ( isset( $publisher['sameAs'] ) && ! empty( $sameAs ) ) {
            $publisher['sameAs'] = $sameAs;
        } else {
            unset( $publisher['sameAs'] );
        }

        return apply_filters("markup_{$this->schema_type}_publisher", $publisher );
    }

    /**
     * Get articleBody
     *
     * @return mixed|null
     */
    protected function articleBody() {

        $post = get_post( $this->post_id );
        $articleBody = strip_tags( $post->post_content );

        if ( ! empty( $articleBody ) ) {
            return apply_filters("markup_{$this->schema_type}_articleBody", $articleBody );
        }

        return null;
    }

    /**
     * Get the keywords
     *
     * @return mixed|null
     */
    protected function keywords() {

        $post_tags = get_the_tags( $this->post_id );

        $keywords = null;

        if ( $post_tags ) {
            foreach($post_tags as $tag) {
                $keywords =  $tag->name . ' '; // Display the tag name
            }
        } else {
            $keywords = the_tags();
        }

        if ( ! empty( $keywords ) ) {
            return apply_filters("markup_{$this->schema_type}_keywords", $keywords );
        }

        return null;
    }

    /**
     * Get articleSection
     *
     * @return string|null
     */
    protected function articleSection() {

        return null;

        $articleSection = get_the_category( $this->post_id )[0]->name;

        if ( ! empty( $articleSection ) ) {
            return $articleSection;
        }

        return null;
    }

    /**
     * Get commentCount
     *
     * @return mixed|null
     */
    protected function commentCount() {

        $commentCount = get_comments_number( $this->post_id );

        if ( ! empty( $commentCount ) ) {
            return apply_filters( "markup_{ $this->schema_type }_commentCount", $commentCount );
        }

        return null;
    }

    /**
     * Get wordCount
     *
     * @return mixed|null
     */
    protected function wordCount() {

        $content = get_post_field('post_content', $this->post_id);
        $wordCount = str_word_count(strip_tags( $content ) );

        if ( ! empty( $wordCount ) ) {
            return apply_filters( "markup_{ $this->schema_type }_wordCount", $wordCount );
        }

        return null;
    }

    /**
     * Get thumbnailUrl
     *
     * @return mixed|null
     */
    protected function thumbnailUrl() {
        $thumbnailUrl = get_the_post_thumbnail_url( $this->post_id );

        if ( ! empty( $thumbnailUrl ) ) {
            return apply_filters( "markup_{ $this->schema_type }_thumbnailUrl", $thumbnailUrl );
        }

        return null;
    }

    /**
     * Get isAccessibleForFree
     *
     * @return boolean
     */
    protected function isAccessibleForFree() { // TODO incomplete for proper information

        return false;
    }

    /**
     * Get copyrightHolder
     *
     * @return mixed|null
     */
    protected function copyrightHolder( $copyrightHolder ) {

        $name = null;
        if ( isset( $copyrightHolder['name'] ) && ! empty( $name ) ) {
            $copyrightHolder['name'] = $name;
        } else {
            return null;
        }

        $url = null;
        if ( isset( $copyrightHolder['logo']['url'] ) && ! empty( $url ) ) {
            $copyrightHolder['logo']['url'] = $url;

        } else {
            unset( $copyrightHolder['logo'] );
        }

        return apply_filters( "markup_{ $this->schema_type }_copyrightHolder", $copyrightHolder );
    }

    /**
     * Get potentialAction
     *
     * @param $potentialAction
     * @return mixed|null
     */
    protected function potentialAction( $potentialAction ) {

        if ( isset($potentialAction['target'] ) ) {
            $potentialAction['target']      = [];
        }

        if ( ! empty( $potentialAction['target'] ) ) {
            return apply_filters( "markup_{ $this->schema_type }_potentialAction", $potentialAction );
        }

        return null;
    }

    /**
     * Get isPartOf
     *
     * @param $isPartOf
     * @return mixed|null
     */
    protected function isPartOf( $isPartOf ) {

        if ( isset( $isPartOf['name'] ) ) {
            $isPartOf['name']       = null;
        }

        $url = null;
        if( isset( $isPartOf['url'] ) && ! empty( $url ) ) {
            $isPartOf['url']        = $url;
        } else {
            unset( $isPartOf['url'] );
        }

        if ( ! empty( $isPartOf['name'] ) ) {
            return apply_filters( "markup_{ $this->schema_type }_isPartOf", $isPartOf );
        }

        return null;
    }

    /**
     * @param $mentions
     * @return array
     */
    protected function mentions( $mentions ) { // TODO incomplete for proper information

        return [];
    }

    /**
     * @param $publisherImprint
     * @return null
     */
    protected function publisherImprint( $publisherImprint ) {// TODO incomplete for proper information

        return null;
    }

    /**
     * @return null
     */
    protected function alternateName() { // TODO incomplete for proper information

        return null;
    }

    /**
     * Get dateCreated
     *
     * @return mixed|null
     */
    protected function dateCreated() {

        $datePublished = get_the_date('F j, Y', $this->post_id);

        if ( ! empty( $datePublished ) ) {
            return apply_filters("markup_{$this->schema_type}_datePublished", $datePublished );
        }

        return null;
    }

    /**
     * Get comment
     *
     * @return mixed|null
     */
    protected function comment( $comment ) {
        $comment_data = [];

        $args = array(
            'post_id'   => $this->post_id ? $this->post_id : '',
            'status'    => 'approve'
        );

        $review_arr     = get_comments( $args );
        if ( ! empty( $review_arr ) ) {
            foreach ( $review_arr as $key => $review ) {

                $comment_structure   = $comment[0];

                /**
                 * Comment Text
                 */
                $comment_text = $review->comment_content;
                if ( isset( $comment_structure['text'] ) && !empty( $comment_text ) ) {
                    $comment_structure['text']      = $comment_text;
                } else {
                    unset( $comment_structure['text'] );
                }

                /**
                 * comment author name
                 */
                $comment_author_name = $review->comment_author;
                if ( isset( $comment_structure['author'] ) && !empty( $comment_author_name ) ) {
                    $comment_structure['author']['name']     = $comment_author_name;
                } else {
                    unset( $comment_structure['author'] );
                }

                /**
                 * comment author url
                 */
                $comment_author_url = get_comment_author_url( 2 );
                if ( isset( $comment_structure['author']['url'] ) && !empty( $comment_author_url ) ) {
                    $comment_structure['author']['url'] = $comment_author_url;
                } else {
                    unset( $comment_structure['author']['url'] );
                }

                /**
                 * Comment date
                 */
                $comment_datePublished = get_comment_date('Y-m-d H:i:s', $review->comment_ID);
                if ( isset( $comment_structure['datePublished'] ) && !empty( $comment_datePublished )) {
                    $comment_structure['datePublished'] = $comment_datePublished;
                } else {
                    unset( $comment_structure['datePublished'] );
                }

                $comment_data[]                              = $comment_structure;
            }

            if ( empty( $comment_data ) ) {
                return [];
            }

            return apply_filters( "markup_{$this->schema_type}_comment", $comment_data );

        }

        return null;

    }

    /**
     * Get interactionStatistic
     *
     * @param $interactionStatistic
     * @return mixed|null
     */
    protected function interactionStatistic( $interactionStatistic ) { // TODO incomplete for proper information

//        $userInteractionCount = (int) 0;
//
//        if ( isset( $interactionStatistic['interactionType']['userInteractionCount'] ) && $userInteractionCount > 0 ) {
//            $interactionStatistic['interactionType']['userInteractionCount'] = $userInteractionCount;
//        }
//
//        if ( $interactionStatistic['interactionType']['userInteractionCount'] > 0 ) {
//            return apply_filters("markup_{$this->schema_type}_interactionStatistic", $interactionStatistic );
//        }

        return null;
    }

    /**
     * @param $blogPost
     * @return null
     */
    protected function blogPost( $blogPost ) { // TODO incomplete for proper information
        return null;
    }

    /**
     * @param $isBasedOn
     * @return null
     */
    protected function isBasedOn( $isBasedOn ) { // TODO incomplete for proper information

        return null;
    }

    /**
     * @return array
     */
    protected function genre() { // TODO incomplete for proper information
        return [];
    }

    /**
     * @return null
     */
    protected function educationalUse() { // TODO incomplete for proper information
        return null;
    }

    /**
     * Get about
     *
     * @param $about
     * @return null
     */
    protected function about( $about ) {
        return null;
        $about['name'] = get_the_category($this->post_id)[0]->name;

        if ( ! empty( $about['name'] ) ) {
            return $about;
        }
        return null;
    }
}