<?php 
class Create_build 
{
	public function __construct($wpdb)
	{
		$this->wpdb = $wpdb;
	}



    public function create_post($title,$content,$type,$excerpt,$image){

        if (  get_page_by_title( $title, OBJECT, $type ) == null )
        {
            $my_post = array(
            'post_title'    => $title,
            'post_content'  => $content,
            'post_status'   => 'publish',
            'post_excerpt'  => $excerpt,
            'post_type' => $type
            );

            $post_id = wp_insert_post( $my_post );
        } else {
            $existed = get_page_by_title( $title, OBJECT, $type );
            $post_id = $existed->ID;
        }

        if ( !empty($post_id) )
            set_post_thumbnail($post_id, $image);
        return $post_id;
    }

    public function preset_runes($args){
        $sorted = [];
        foreach ($args as $_arg) {
            echo $_arg;
            $exist = 0;

            for ( $i = 0; $i < count($sorted); $i ++ )
            {
                if ( $_arg == $sorted[$i]['rune'] )
                {
                    $sorted[$i]['quantity'] ++;
                    $exist = 1;
                    break;
                }
            }
            if ( $exist != 1 )
            {
                $y = count($sorted);
                $sorted[$y]['rune'] = $_arg;
                $sorted[$y]['quantity'] = 1;
            }

        }
        return $sorted;
    }


   
}