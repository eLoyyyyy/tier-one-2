<?php

if ( !defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

/* rating system */
add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');

function post_like()
{
    // Check for nonce security
    $nonce = $_POST['nonce'];
  
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');
     
    if(isset($_POST['post_like']))
    {
        // Retrieve user IP address
        $ip = $_SERVER['REMOTE_ADDR'];
        $post_id = $_POST['post_id'];
         
        // Get voters'IPs for the current post
        $meta_IP = get_post_meta($post_id, "voted_IP");
        $voted_IP = $meta_IP[0];
 
        if(!is_array($voted_IP))
            $voted_IP = array();
         
        // Get votes count for the current post
        $meta_count = get_post_meta($post_id, "votes_count", true);
 
        // Use has already voted ?
        if(!hasAlreadyVoted($post_id))
        {
            $voted_IP[$ip] = time();
 
            // Save IP and increase votes count
            update_post_meta($post_id, "voted_IP", $voted_IP);
            update_post_meta($post_id, "votes_count", ++$meta_count);
             
            // Display count (ie jQuery return value)
            echo $meta_count;
        }
        else
            echo "already";
    }
    exit;
}

$timebeforerevote = 120; // 120 = 2 hours

function hasAlreadyVoted($post_id)
{
    global $timebeforerevote;
 
    // Retrieve post votes IPs
    $meta_IP = get_post_meta($post_id, "voted_IP");
    $voted_IP = $meta_IP[0];
     
    if(!is_array($voted_IP))
        $voted_IP = array();
         
    // Retrieve current user IP
    $ip = $_SERVER['REMOTE_ADDR'];
     
    // If user has already voted
    if(in_array($ip, array_keys($voted_IP)))
    {
        $time = $voted_IP[$ip];
        $now = time();
         
        // Compare between current time and vote time
        if(round(($now - $time) / 60) > $timebeforerevote)
            return false;
             
        return true;
    }
     
    return false;
}

function setPostLike($post_id)
{
    $themename = "tieronetwo";
 
    $vote_count = get_post_meta($post_id, "votes_count", true);

    if (empty($vote_count)) {

        $vote_count = 0;

    }
 
    if( hasAlreadyVoted($post_id) ){
        $output .= '<a class="blue-grey darken-4 btn-large btn post-like disabled" href="#" data-post_id="'.$post_id.'">
                        <i class="fa fa-heart"></i> <span class="count">' . $vote_count .'</span>
                    </a>';
    }
    else {
        $output .= '<a class="blue-grey darken-4 btn-large btn post-like" href="#" data-post_id="'.$post_id.'">
                        <i class="fa fa-heart"></i> <span class="count">'. $vote_count .'</span>
                    </a>';
    }
    
    
    return $output;
}

function getPostLike($post_id){
    $themename = "tieronetwo";
 
    $vote_count = get_post_meta($post_id, "votes_count", true);

    if (empty($vote_count)) {

        $vote_count = 0;

    }
 
    $output = $vote_count . (( $vote_count == 0 ) ? ' Like' : ' Likes');
    
    return $output;
}