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
        }

        if ( !empty($post_id) )
            set_post_thumbnail($post_id, $image);
        return $post_id;
    }

    public function preset_runes($args){
        $sorted = [];
        foreach ($args as $_arg) {
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

    public function handleErrors($data){
        $errors = [];

        // Champion security
        if ( empty($data['champ']) )
            $errors['champ'] = "missing champion";

        // title security
        if ( empty($data['title']) )
            $errors['title'] = "missing title";
        else if ( strlen($data['title']) > 70 )
            $errors['title'] = "title too long";

        // short description security
        if ( empty($data['excerpt']) )
            $errors['excerpt'] = "missing short description";
        else if ( strlen($data['excerpt']) > 260 )
            $errors['excerpt'] = "short description too long ( max : 260 char. )";

        // starter build
        $errors['begin-item'] = "no elements for the starter build";
        for ( $i = 0; $i <= 4; $i ++ )
        {
            if( !empty($data['begin-item-'.$i]) )
             {
               $errors['begin-item'] = "";
               break; 
            }
        }

        // final build
        $errors['end-item'] = "no elements for the core build";
        for ( $i = 0; $i <= 6; $i ++ )
        {
            if( !empty($data['end-item-'.$i]) )
            {
               $errors['end-item'] = "";
               break; 
            }
        }

        // spell order
        // $errors['spell-order'] = "Spell order not complete";
        // for ( $i = 1; $i <= 18; $i ++ )
        // {           
        //     for ( $j = 1; $j <= 5; $j ++)
        //     {
        //         if ( !empty($_POST['order-input-'.$j.'-'.$i]) && $_POST['order-input-'.$j.'-'.$i] == 1 )
        //         {
        //             $errors['spell-order'] = "";
        //             break;   
        //         }
        //     }
        // }

        // summoner spells
        $errors['summoner'] = "";
        for ( $i = 1; $i <= 2; $i++ )
        {           
            if ( empty($_POST['summoner-'.$i]) )
            {
                $errors['summoner'] = "missing one or two summoner spells";
                break;
            }
        }

        // marks / red runes
        $errors['marks'] = "";
        for ( $i =1; $i <= 9; $i ++ )
        {
            if ( empty($_POST['red-runes-'.$i]) ){
                $errors['marks'] = "missing one or more marks";
                break;
            }
        }
        
        // glyphs / blue runes
        $errors['glyphs'] = "";
        for ( $i =1; $i <= 9; $i ++ )
        {
            if ( empty($_POST['blue-runes-'.$i]) ){
                $errors['glyphs'] = "missing one or more glyphs";
                break;
            }
        }

        // seals / yellow runes
        $errors['seals'] = "";
        for ( $i =1; $i <= 9; $i ++ )
        {
            if ( empty($_POST['yellow-runes-'.$i]) ){
                $errors['seals'] = "missing one or more seals";
                break;
            }
        }

        // quintes / black runes
        $errors['quintes'] = "";
        for ( $i =1; $i <= 3; $i ++ )
        {
            if ( empty($_POST['black-runes-'.$i]) ){
                $errors['quintes'] = "missing one or more quintes";
                break;
            }
        }

        foreach ($errors as $error) {
            if ( !empty($error) )
                return $errors;
        }
        return false;
    }


   
}