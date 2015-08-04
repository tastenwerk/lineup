<?php



  function add_ess_feed(){

    $type = 'lineupentry';
    $args=array(
      'post_type' => $type,
    //   'meta_query'=> array(
    //     array(
    //       'key' => 'venue_kukuk'
    //     )
    //   ),
      // 'orderby'   => 'title',
      // 'order'     => 'ASC'
    );


    $my_query = null;
    $my_query = new WP_Query($args); 

      
    include(dirname( __FILE__)."/lib/ess/FeedWriter.php");

    $current_url = get_site_url();
    $feed_url   =  str_replace( 'localhost', '127.0.0.0', $current_url).'/feed/ess';
    // echo $feed_url;
    global $current_site;
    // == Create the ESS Feed ================
    $essFeed = new FeedWriter( 'en', array(
        'title'     => 'Lineupentriesfeed',
        'link'      => $feed_url,
        'published' => $post->date,
        'rights'    => get_bloginfo( 'name' )
    ));


    while ($my_query->have_posts()) : 
      $my_query->the_post();
      $post = get_post( get_the_ID() );

      global $wp;
        $current_url = home_url(add_query_arg(array(),$wp->request));


      $event_page = get_the_permalink();
     
      $dates = get_post_meta($post->ID, 'lineupentry_dates', TRUE );


      // == Create an Event =====================
      $newEvent = $essFeed->newEventFeed( array(
          'title'         => $post->post_title,
          'uri'           => $event_page,
          'published'     => 'now',
          'access'        => 'PUBLIC',
          'description'   => $post->post_content,
          'tags'          => array( 'music', 'pop', '80s', 'Madonna', 'concert' )
      ));
      // -- Define event's category(s) --------------------------------
      $newEvent->addCategory( 'concert', array(
          'name' => 'Rock Music'
      ));

      foreach ($dates as $event ) {

          // -- Define event's date(s) ------------------------------------
          $newEvent->addDate('recurrent', 'year', 3, null,null,null,array(
              'name'      => 'Aufführung',
              'start'     => 'strtotime( $event[1] )',
              'duration'  => get_post_meta( $post->ID, 'lineupentry_duration', TRUE )
          ));

      }

          // -- Define event's place(s) -----------------------------------
          $newEvent->addPlace( 'fixed', null,array(
              'name'          => 'Stadium',
              'latitude'      => '40.71675',
              'longitude'     => '-74.00674',
              'address'       => 'Ave of Americas, 871',
              'city'          => 'New York',
              'zip'           => '10001',
              'state'         => 'New York',
              'state_code'    => 'NY',
              'country'       => 'United States of America',
              'country_code'  => 'US'
          ));

      // -- Define event's media files (images, sounds, videos, websites) -------------------
      $newEvent->addMedia('image',array('name'=>'Photo 01','uri'=>'http://madonna.com/i.png'));
      $newEvent->addMedia('video',array('name'=>'Video 02','uri'=>'http://madonna.com/v.ogg'));

      // == Add the event to the Feed
      $essFeed->addItem( $newEvent );

    endwhile;

      // == Display the ESS Feed generated.
      $essFeed->genarateFeed();

  }

?>